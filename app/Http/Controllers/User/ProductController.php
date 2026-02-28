<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function product()
    {
        return Inertia::render('Product/index', [
            'products' => Product::with('shop')->get(),
            'shops' => Shop::select('id', 'name')->get(),

        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'shop_id' => 'required', 
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $product = new Product();
        $product->shop_id = $request->shop_id;
        $product->description = $request->description;
        $product->email = $request->email;
        $product->price = $request->price;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

        $product->save();

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

        public function edit($product)
        {
            $product = Product::findOrFail($product);
            return Inertia::render('Product/Edit', [
                'product' => $product,
                'shops' => Shop::select('id', 'name')->get(),
            ]);
        }

 public function update(Request $request, $product)
{
    $product = Product::findOrFail($product);

    $validatedData = $request->validate([
        'shop_id' => 'required|exists:shops,id',
        'email' => 'nullable',
        'description' => 'nullable',
        'price' => 'required|numeric',
        'image' => 'nullable|image|max:2048',
    ]);

    // Image upload check
    if ($request->hasFile('image')) {
        $validatedData['image'] = $request
            ->file('image')
            ->store('products', 'public');
    }

    $product->update($validatedData);

    return redirect()
        ->route('product.index')
        ->with('success', 'Product updated successfully.');
}

        public function destroy($id)
        {
            $product = Product::findOrFail($id);
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->delete();

            return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
        }
}