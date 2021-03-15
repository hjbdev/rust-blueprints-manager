<?php

namespace App\Http\Controllers;

use App\Models\RustplusData;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MapController extends Controller
{
    public function index()
    {
        $mapData = RustplusData::where('team_id', auth()->user()->currentTeam->id)->where('user_id', auth()->user()->id)->first();
        $mapUrl  = '/storage/maps/' . str_replace('.', '-', auth()->user()->currentTeam->server_ip) . '.jpg';
        return Inertia::render('Map', compact('mapData', 'mapUrl'));
    }
}
