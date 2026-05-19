<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrder;
use App\Models\CustomerOrderItem;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerOrderController extends Controller
{

       public function index()
    {
        $orders = CustomerOrder::with('items.product')
            ->latest()
            ->get();

        return view('customer-orders.index', compact('orders'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'payment_proof' => 'required|image|max:2048',
            'items' => 'required|string',
        ]);

        $items = json_decode($request->items, true);

        $total = 0;

        foreach ($items as $item) {
            $product = Product::findOrFail($item['id']);
            $total += $product->price * $item['qty'];
        }

        $paymentProof = $request->file('payment_proof')->store('payment-proofs', 'public');

        $order = CustomerOrder::create([
            'customer_name' => $data['customer_name'],
            'customer_phone' => $data['customer_phone'],
            'customer_address' => $data['customer_address'],
            'total' => $total,
            'status' => 'pending',
            'payment_method' => 'qris',
            'payment_proof' => $paymentProof,
        ]);

        foreach ($items as $item) {
            $product = Product::findOrFail($item['id']);

            CustomerOrderItem::create([
                'customer_order_id' => $order->id,
                'product_id' => $product->id,
                'qty' => $item['qty'],
                'price' => $product->price,
                'subtotal' => $product->price * $item['qty'],
            ]);
        }

        return redirect('/shop')->with('success', 'Pesanan berhasil dikirim. Menunggu konfirmasi admin.');
    }

    public function confirm(CustomerOrder $order)
    {
        if ($order->status !== 'pending') {
            return back()->with('error', 'Pesanan sudah diproses.');
        }

        try {
            DB::transaction(function () use ($order) {
                $order->load('items.product');

                foreach ($order->items as $item) {
                    $product = $item->product;

                    if (!$product || $product->stock < $item->qty) {
                        throw new \Exception('Stok produk tidak cukup.');
                    }

                    $product->decrement('stock', $item->qty);

                    StockMovement::create([
                        'product_id' => $product->id,
                        'type' => 'out',
                        'qty' => $item->qty,
                        'note' => 'Pesanan online #' . $order->id,
                    ]);
                }

                $order->update([
                    'status' => 'confirmed',
                ]);
            });

            return back()->with('success', 'Pesanan berhasil dikonfirmasi.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function reject(CustomerOrder $order)
    {
        if ($order->status !== 'pending') {
            return back()->with('error', 'Pesanan sudah diproses.');
        }

        $order->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Pesanan berhasil ditolak.');
    }
 
    public function status()
    {
        $orders = collect();

        if (request('phone')) {
            $orders = CustomerOrder::with('items.product')
                ->where('customer_phone', request('phone'))
                ->latest()
                ->get();
        }

        return view('shop.status', compact('orders'));
    }


    public function checkout(Request $request)
    {
        $items = json_decode($request->items, true);

        if (!$items || count($items) === 0) {
            return redirect('/shop');
        }

        return view('shop.checkout', [
            'items' => $items,
        ]);
    }
}