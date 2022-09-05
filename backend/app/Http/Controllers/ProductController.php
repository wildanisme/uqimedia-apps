<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();

        return response()->json([
            'message' => 'Products List',
            'status' => 'success',
            'products' => $products
        ], 200);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if(!$product){
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Product detail',
            'status' => 'success',
            'product' => $product
        ], 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'price' => ['required', 'numeric'],
        ]);

        Product::create([
            'name' => $request->input('name'),
            'detail' => $request->input('detail'),
            'price' => $request->input('price'),
            'unit' => $request->input('unit'),
        ]);

        return response()->json([
            'message' => 'Product added',
            'status' => 'success'
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $this->validate($request, [
            'name' => ['required'],
            'price' => ['required', 'numeric'],
        ]);

        $product->update([
            'name' => $request->input('name'),
            'detail' => $request->input('detail'),
            'price' => $request->input('price'),
            'unit' => $request->input('unit'),
        ]);

        return response()->json([
            'message' => 'Product updated',
            'status' => 'success'
        ], 200);
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json([
            'message' => 'Product deleted',
            'status' => 'success',
        ], 200);
    }
}
