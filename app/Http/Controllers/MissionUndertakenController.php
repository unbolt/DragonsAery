<?php

namespace App\Http\Controllers;

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
        $missions_undertaken = Auth::user()->activeMissions()->with('mission')->get();

        return response()->json($missions_undertaken);
    }

}
