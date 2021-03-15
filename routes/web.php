<?php

use App\Http\Controllers\BlueprintsController;
use App\Http\Controllers\MapController;
use App\Models\Blueprint;
use App\Models\RustplusData;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/blueprints', [BlueprintsController::class, 'index'])->name('blueprints');

    Route::get('/blueprints/research', function () {
        $blueprints = Blueprint::all();
        $teammates = auth()->user()->currentTeam->allUsers();

        return Inertia::render('BlueprintResearch', compact('blueprints', 'teammates'));
    });

    Route::get('/map', [MapController::class, 'index'])->name('map');

    Route::post('/blueprints/research', [BlueprintsController::class, 'research']);
    Route::delete('/blueprints/{blueprint}', [BlueprintsController::class, 'destroy']);

    Route::get('rustplus/callback', function(Request $request) {
        // $ip      = "188.165.229.79";
        // $port    = 28082;
    
        // ws://188.165.229.79:28082
    
        // dd($token);
    
        // $output = null;
    
        // exec('node ' . base_path('app/Console/Node/RustPlusInfo.js') . ' ' . $ip . ' ' . $port . ' ' . $steamId . ' ' . $token, $output);
    
        // dd($output);
        if(auth()->check()) {
            return redirect('/teams/' . auth()->user()->currentTeam->id)->with('flash.rustPlusSteamData', ['steamId' => $request->steamId, 'token' => $request->token]);
        }
    
        return 'Something went wrong.';
    });

    Route::post('rustplus/pair', function (Request $request) {
        $ip = $request->get('ip', '188.165.229.79');
        $port = $request->get('port', '28015');
        $steamId = $request->get('steamId', "76561198058468382");
        $token = $request->get('token', "eyJzdGVhbUlkIjoiNzY1NjExOTgwNTg0NjgzODIiLCJpc3MiOjE2MTU4MzM1NjgsImV4cCI6MTYxNzA0MzE2OH0=.6J20d5iEv8Yj60QpnAJ3IKheCOJr4d/R1yLeMB/7H+jum8T+Ctbv1olToAS5FLT+/gU64yqyRlff7QFhLUa3BA==");

        $user = auth()->user();
        $user->steam_id = $steamId;
        $user->save();

        $output = null;
        
        exec('node ' . base_path('app/Console/Node/RustPlusPair.js') . ' ' . $ip . ' ' . $port . ' ' . $steamId . ' ' . $token, $output);
    
        $team = auth()->user()->currentTeam;
        $team->server_ip = $ip;
        $team->server_port = $port;
        $team->save();
    
        $response = json_decode($output[8]);
    
        if($response) {
            $rustplusData = RustplusData::where('team_id', $team->id)->where('user_id', auth()->user()->id)->first();
            if (!$rustplusData) {
                $rustplusData = new RustplusData();
            }
            $rustplusData->team_id = $team->id;
            $rustplusData->user_id = auth()->user()->id;
            $rustplusData->server_token = $response->playerToken;
            $team->server_port = $response->port;
            $team->save();
            $rustplusData->updated_at = now();
            $rustplusData->save();
        }
    });

    
});
