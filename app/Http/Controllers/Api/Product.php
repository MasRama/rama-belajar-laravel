<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;

use App\Models\Products;
use App\Models\Category;

class Product extends Controller
{
    public function index()
    {
        $products = Products::all();
        return response()->json([
            'message' => 'Ambil Semua Data',
            'status' => true,
            'data' => $products
        ]);
    }

    public function show($id)
    {
        $product = Products::find($id);

        if ($product) {
            return response()->json([
                'message' => 'Produk Ditemukan',
                'status' => true,
                'data' => $product
            ]);
        } else {
            return response()->json([
                'message' => 'Produk Tidak Ditemukan',
                'status' => false,
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|integer',
            'description' => 'required',
            'image' => 'required',
        ]);

        $product = Products::create($validated);

        if ($product) {
            return response()->json([
                'message' => 'Produk Berhasil Ditambahkan',
                'status' => true,
                'data' => $product
            ]);
        } else {
            return response()->json([
                'message' => 'Produk Gagal Ditambahkan',
                'status' => false,
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {

        $product = Products::find($id);

        if ($product) {
            $product->update($request->all());
            return response()->json([
                'message' => 'Produk Berhasil Diupdate',
                'status' => true,
                'data' => $product
            ]);
        } else {
            return response()->json([
                'message' => 'Produk Gagal Diupdate',
                'status' => false,
            ], 400);
        }
    }

    public function destroy($id)
    {
        $product = Products::find($id);

        if ($product) {
            $product->delete();
            return response()->json([
                'message' => 'Produk Berhasil Dihapus',
                'status' => true,
            ]);
        } else {
            return response()->json([
                'message' => 'Produk Gagal Dihapus',
                'status' => false,
            ], 400);
        }
    }
}
