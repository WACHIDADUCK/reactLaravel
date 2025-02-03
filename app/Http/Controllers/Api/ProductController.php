<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;

use App\Http\Resources\ProductResource;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        // return response()->json($products);

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // return response()->json(['message' => 'Metodo destroy'], 200);

        try {
            Gate::authorize("delete", $product);
            $product->delete();
            return response()->json(['message' => 'Producto eliminado correctamente'], 200);
        }
        catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el producto'], 500);
        }
    }
}
