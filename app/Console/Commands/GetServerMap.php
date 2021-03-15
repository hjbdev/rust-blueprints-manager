<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use xPaw\SourceQuery\SourceQuery;


class GetServerMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'server:map';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieves the server map';

    protected $query;
    
    protected $requestedNewMap = false;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->query = new SourceQuery();

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $this->query->Connect('188.165.229.79', 28015);

            $info = $this->query->GetRules();


            $this->query->Disconnect();
        } catch (Exception $e) {
            $this->error('Something went wrong when contacting the game server');
        }

        dd($info);

        $seed = $info['world.seed'];
        $seed = 1822656757;
        $size = $info['world.size'];

        
        $this->checkForExistingMap($seed, $size);

        return 0;
    }

    private function checkForExistingMap($seed, $size)
    {
        $this->info('Checking for an existing map');

        $response = Http::withHeaders([
            'ApiKey' => env('RUSTMAPS_KEY')
        ])->get('https://rustmaps.com/api/public/mapexists', [
            'seed' => $seed,
            'size' => $size,
            'staging' => 'false',
            'barren' => 'false'
        ]);

        if($response->successful()) {
            if($response->body() === "true") {
                $this->info('There is an existing map, downloading it');
                $this->downloadMap($seed, $size);
                return true;
            } else {
                $this->info('There isn\'t an existing map');
                if(!$this->requestedNewMap) {
                    $this->info('We\'ve not requested a generation yet, so we\'re requesting one');
                    $this->requestNewMap($seed, $size);
                }
                return false;
            }
        } 

        if($response->failed()) {
            Log::error($response->body());
            $this->error('Attempting to check if map exists failed');
        }
    }

    private function downloadMap($seed, $size)
    {
        $response = Http::withHeaders([
            'ApiKey' => env('RUSTMAPS_KEY')
        ])->get('https://rustmaps.com/api/public/mapdata', [
            'seed' => $seed,
            'size' => $size,
            'staging' => 'false',
            'barren' => 'false'
        ]);

        if($response->successful()) {

            $data = $response->json();

            Cache::put('monuments', $data['monuments']);

            file_put_contents(storage_path('app/map.png'), file_get_contents($data['imageUrl']));

            $this->info('Downloaded new map and data successfully');
        }
    }

    private function requestNewMap($seed, $size)
    {
        $response = Http::withHeaders([
            'ApiKey' => env('RUSTMAPS_KEY')
        ])->post('https://rustmaps.com/api/public/requestmap', [
            'seed' => $seed,
            'size' => $size,
            'staging' => 'false',
            'barren' => 'false'
        ]);

        if($response->successful()) {

            $this->requestedNewMap = true;

            $loop = React\EventLoop\Factory::create();

            $loop->addPeriodicTimer(30, function ($timer) use ($seed, $size, $loop) {
                if($this->checkForExistingMap($seed, $size)) {
                    $loop->cancelTimer($timer);
                    $this->downloadMap($seed, $size);
                }
            });

            $loop->run();
        }

        if($response->failed()) {
            dd($response->json());
            $this->info('Requesting a new map generation failed');
        }
    }
}
