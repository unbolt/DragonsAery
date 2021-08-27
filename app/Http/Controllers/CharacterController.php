<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function list() {

        $characters = Auth::user()
                            ->characters()
                            ->select('charid','charname','nation','pos_zone')
                            ->with([
                                'zone:zoneid,name',
                                'stats'
                            ])
                            ->get();

        return Inertia::render('Character/List', [
            'characters' => $characters
        ]);
    }
}
