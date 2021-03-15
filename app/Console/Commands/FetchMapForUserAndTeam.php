<?php

namespace App\Console\Commands;

use App\Jobs\FetchMapForUserAndTeam as JobsFetchMapForUserAndTeam;
use App\Models\Team;
use App\Models\User;
use Illuminate\Console\Command;

class FetchMapForUserAndTeam extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'map:fetch {userId} {teamId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::findOrFail($this->argument('userId'));
        $team = Team::findOrFail($this->argument('teamId'));

        JobsFetchMapForUserAndTeam::dispatch($user, $team);
    }
}
