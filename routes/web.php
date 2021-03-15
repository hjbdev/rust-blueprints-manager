<?php

use App\Http\Controllers\BlueprintsController;
use App\Models\Blueprint;
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
});
