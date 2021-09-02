<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\MissionCategory;
use App\Models\MissionUndertaken;
use App\Models\MissionReward;

class MissionUndertakenController extends Controller
{
    public function index() 
    {
        $missions_undertaken = Auth::user()->missions->get();
        
        return Inertia::render('MissionUndertaken/Index', [
            'missions_undertaken' => $missions_undertaken
        ]);
    }

    public function list() 
    {
        $missions_undertaken = Auth::user()->missions()->with('mission')->get();

        return response()->json($missions_undertaken);
    }

    public function active()
    {
        $missions_undertaken = Auth::user()->activeMissions()->with(['mission','mission.category'])->get();

        return response()->json($missions_undertaken);
    }

    public function start(Mission $mission)
    {
        // Check user can start any more missions
        if(!Auth::user()->canStartMissions()) {
            return false;
        }

        // Create the mission instance
        $mission_undertaken = Auth::user()->missions()->create([
            'mission_id' => $mission->id,
            'char_id' => Auth::user()->active_char_id,
            'start_time' => now(),
            'end_time' => Carbon::now()->addMinutes($mission->duration)
        ]);

        return true;
    }

}
