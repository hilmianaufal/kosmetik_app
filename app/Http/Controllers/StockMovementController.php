<?php

namespace App\Http\Controllers;

use App\Models\StockMovement;

class StockMovementController extends Controller
{
    public function index()
    {
        $query = StockMovement::with('product')->latest();

        if (request('search')) {
            $query->whereHas('product', function ($q) {
                $q->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('brand', 'like', '%' . request('search') . '%');
            });
        }

        if (request('type')) {
            $query->where('type', request('type'));
        }

        $movements = $query->get();

        return view('stock-movements.index', compact('movements'));
    }
}