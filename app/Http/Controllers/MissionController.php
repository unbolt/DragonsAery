<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\MissionCategory;

class MissionController extends Controller
{
    public function index() 
    {
        $mission_categories = MissionCategory::orderBy('name')->with('missions')->get();

        return Inertia::render('Mission/Index', [
            'mission_categories' => $mission_categories
        ]);
    }

    public function category($id)
    {
        $category = MissionCategory::where('id', $id)->firstOrFail();
        $missions = Mission::where('mission_category_id', $id)->with(['category', 'rewards', 'rewards.item'])->get();

        return Inertia::render('Mission/Category', [
            'category' => $category,
            'missions' => $missions
        ]);
    }



    public function admin()
    {

    }
}
