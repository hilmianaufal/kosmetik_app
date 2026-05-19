<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'barcode' => 'nullable|unique:products,barcode',
            'stock' => 'required|integer|min:0',
            'price' => 'required|integer|min:0',
            'cost_price' => 'nullable|integer|min:0',
            'expired_date' => 'nullable|date',
            'image' => 'nullable|image|max:2048',
        ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('uploads/products'), $filename);

                $uploadPath = '/home/u912812505/domains/keboncinta.com/public_html/matanu/uploads/products';

                    if (!file_exists($uploadPath)) {
                        mkdir($uploadPath, 0755, true);
                    }
                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    $file->storeAs('uploads/products', $filename, 'matanu_public');

                    $data['image'] = 'uploads/products/' . $filename;
                }
            }

        Product::create($data);

        return back()->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
        {
            return view('products.edit', compact('product'));
        }

    public function update(Request $request, Product $product)
        {
            $data = $request->validate([
                'name' => 'required',
                'brand' => 'nullable',
                'category' => 'nullable',
                'barcode' => 'nullable|unique:products,barcode,' . $product->id,
                'stock' => 'required|integer',
                'price' => 'required|integer',
                'cost_price' => 'nullable|integer',
                'expired_date' => 'nullable|date',
                'image' => 'nullable|image',
            ]);

            if ($request->hasFile('image')) {
                if ($product->image && !str_starts_with($product->image, 'http')) {
                    File::delete(public_path($product->image));
                }

                $file = $request->file('image');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('uploads/products'), $filename);

               $uploadPath = '/home/u912812505/domains/keboncinta.com/public_html/matanu/uploads/products';

                    if (!file_exists($uploadPath)) {
                        mkdir($uploadPath, 0755, true);
                    }

                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    $file->storeAs('uploads/products', $filename, 'matanu_public');

                    $data['image'] = 'uploads/products/' . $filename;
                }
            }

            $product->update($data);

            return redirect('/products');
        }

        public function destroy(Product $product)
        {
            if ($product->image && !str_starts_with($product->image, 'http')) {
                $oldImage = '/home/u912812505/domains/keboncinta.com/public_html/matanu/' . $product->image;

                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }

            $product->delete();

            return back()->with('success', 'Produk berhasil dihapus');
        }

        public function restock(Request $request, Product $product)
        {
            $data = $request->validate([
                'qty' => 'required|integer|min:1',
                'note' => 'nullable|string',
            ]);

            $product->increment('stock', $data['qty']);

            StockMovement::create([
                'product_id' => $product->id,
                'type' => 'in',
                'qty' => $data['qty'],
                'note' => $data['note'] ?? 'Restock produk',
            ]);

            return back()->with('success', 'Stok berhasil ditambahkan');
        }

        public function expired()
            {
                $products = Product::whereNotNull('expired_date')
                    ->whereDate('expired_date', '<=', now()->addDays(30))
                    ->orderBy('expired_date')
                    ->get();

                return view('products.expired', compact('products'));
            }

        public function shop()
            {
                $products = Product::where('stock', '>', 0)
                    ->latest()
                    ->get();

                return view('shop.index', compact('products'));
            }
}