<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function list()
    {
        $items = $this->findItems();
        //$items = Item::where('log_name_singular', 'petrov ring')->take(500)->get();

        return Inertia::render('Item/List', [
            'items' => $items
        ]);
    }

    public function search($query)
    {
        $items = $this->findItems($query);

        return response()->json($items);
    }

    private function findItems($name = null)
    {
        return Item::where('en_name', '!=', '.')
                    ->where(function($query) use ($name) {
                        $query->where('en_name', 'like', '%' . $name . '%')
                            ->orWhere('log_name_singular', 'like', '%' . $name . '%');
                    })
                    ->orderBy('level', 'ASC')
                    ->take(100)
                    ->get();
    }
}
