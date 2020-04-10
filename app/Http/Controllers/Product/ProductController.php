<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->paginate(10);
        return view('product.product', ['products' => $products]);
    }

    public function create()
    {
        return view('product.product_create');
    }

    public function store(Request $request)
    {
        $data['name'] = $request->input('name');
        $data['description'] = $request->input('description');
        Product::query()->create($data);
        return redirect('product')->withSuccess('new product successfully !!');
    }

    public function view()
    {
        return view('product.product_show');
    }

    public function edit($product_id)
    {
        $product = Product::query()->find($product_id);
        return view('product.product_edit', ['product' => $product]);
    }

    public function update(Request $request, $product_id)
    {
        $product = Product::query()->find($product_id);
        if (!$product)
            return redirect('product')->withErrors('can not update product !!');
        $product = $product->update($request->all());
        if (!$product)
            return redirect('product')->withErrors('update product fail !!');
        return redirect('product')->withSuccess('update product successfully !!');
    }

    public function destroy($product_id)
    {
        $product = Product::query()->find($product_id);
        if (!$product)
            return redirect('product')->withErrors('can not update product !!');
        $product = $product->delete($product_id);
        if (!$product)
            return redirect('product')->withErrors('delete product fail !!');
        return redirect('product')->withSuccess('delete product successfully !!');
    }
}
