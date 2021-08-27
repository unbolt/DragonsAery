<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function list() {

        $items = Item::take(500)->get();

        return Inertia::render('Item/List', [
            'items' => $items
        ]);
    }
}
