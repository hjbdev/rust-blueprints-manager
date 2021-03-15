<?php

namespace App\Jobs;

use App\Models\RustplusData;
use App\Models\Team;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchMapForUserAndTeam implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Team $team)
    {
        $this->user = $user;
        $this->team = $team;
    }

    protected $user;
    protected $team;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ip = $this->team->server_ip;
        $port = $this->team->server_port;
        $steamId = $this->user->steam_id;
        $token = $this->user->rustplus_current_team_data->server_token;

        $output = null;

        exec('node ' . base_path('app/Console/Node/RustPlusInfo.js') . ' ' . $ip . ' ' . $port . ' ' . $steamId . ' ' . $token, $output);

        if(isset($output[0])) {
            $response = json_decode($output[0]);
        }

        // remove jpg
        unset($response->jpgImage);

        $rustplusData = RustplusData::where('team_id', $this->team->id)->where('user_id', $this->user->id)->first();
        $rustplusData->map_data = $response;
        $rustplusData->save();
    }
}
