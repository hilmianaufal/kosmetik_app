<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('pos', compact('products'));
    }

    public function checkout(Request $request)
    {
        $transaction = Transaction::create([
            'total' => $request->total,
            'payment' => $request->payment,
            'change' => $request->change,
        ]);

        foreach ($request->items as $item) {

            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id' => $item['id'],
                'qty' => $item['qty'],
                'price' => $item['price'],
                'subtotal' => $item['qty'] * $item['price'],
            ]);

            $product = Product::find($item['id']);

            if ($product) {
                $product->decrement('stock', $item['qty']);
            }
        }

        return response()->json([
            'success' => true
        ]);
    }
}