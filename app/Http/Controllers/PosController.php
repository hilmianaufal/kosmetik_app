<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
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
            foreach ($request->items as $item) {
                $product = Product::find($item['id']);

                if (!$product || $product->stock < $item['qty']) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Stok produk tidak cukup.'
                    ], 422);
                }
            }

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
                    'cost_price' => $product->cost_price,
                    'subtotal' => $item['qty'] * $item['price'],
                    'profit' => ($item['price'] - $product->cost_price) * $item['qty'],
                ]);

                Product::find($item['id'])->decrement('stock', $item['qty']);
                StockMovement::create([
                        'product_id' => $item['id'],
                        'type' => 'out',
                        'qty' => $item['qty'],
                        'note' => 'Penjualan transaksi #' . $transaction->id,
                    ]);
            }

            return response()->json([
                'success' => true
            ]);
        }
}