<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blueprints\ResearchBlueprintRequest;
use App\Models\Blueprint;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlueprintsController extends Controller
{
    public function research(ResearchBlueprintRequest $request) 
    {
        $blueprint = Blueprint::where('name', $request->blueprint)->firstOrFail();
        $user = User::findOrFail($request->user);

        $user->blueprints()->syncWithoutDetaching([$blueprint]);

        return redirect()->to('/blueprints');
    }

    public function index()
    {
        $blueprints = Blueprint::whereHas('users', function (Builder $query) {
            $query->whereIn('id', auth()->user()->currentTeam->allUsers()->pluck('id'));
        })->get();

        return Inertia::render('Blueprints', compact('blueprints'));
    }
}
