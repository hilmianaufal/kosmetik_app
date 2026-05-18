<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
            'name' => 'required',
            'brand' => 'nullable',
            'category' => 'nullable',
            'barcode' => 'nullable|unique:products,barcode',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'cost_price' => 'nullable|integer',
            'expired_date' => 'nullable|date',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return back();
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
                $data['image'] = $request->file('image')->store('products', 'public');
            }

            $product->update($data);

            return redirect('/products');
        }

    public function destroy(Product $product)
    {
        $product->delete();
        return back();
    }
}