<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blueprints\ResearchBlueprintRequest;
use App\Models\Blueprint;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class BlueprintsController extends Controller
{
    public function research(ResearchBlueprintRequest $request) 
    {
        $blueprint = Blueprint::where('name', $request->blueprint)->firstOrFail();
        $user = User::findOrFail($request->user);

        // // check if it already exists
        // $existingLink = Blueprint::whereHas('users', function (Builder $query) use ($user) {
        //     $query->wherePivot('team_id', auth()->user()->currentTeam->id);
        //     $query->where('id', $user->id);
        // })->count();

        $existingLink = $blueprint->users()->wherePivot('team_id', auth()->user()->currentTeam->id)->where('id', $user->id)->count();


        if(!$existingLink) {
            $user->blueprints()->attach($blueprint, [
                'team_id' => auth()->user()->currentTeam->id
            ]);
            return redirect()->to('/blueprints')->with('flash.banner', 'Blueprint added.');
        }

        return redirect()->to('/blueprints')->with('flash.banner', 'You already know this blueprint.')->with('flash.bannerStyle', 'danger');
    }

    public function index()
    {
        $blueprints = Blueprint::whereHas('users', function (Builder $query) {
            $query->whereIn('id', auth()->user()->currentTeam->allUsers()->pluck('id'));
            $query->where('blueprint_user.team_id', auth()->user()->currentTeam->id);
        })->get();

        return Inertia::render('Blueprints', compact('blueprints'));
    }

    public function destroy($id)
    {
        DB::table('blueprint_user')
            ->where('blueprint_id', $id)
            ->where('user_id', auth()->user()->id)
            ->where('team_id', auth()->user()->currentTeam->id)
            ->delete();

        return redirect()->to('/blueprints')->with('flash.banner', 'You have unlearned this blueprint');
    }
}
