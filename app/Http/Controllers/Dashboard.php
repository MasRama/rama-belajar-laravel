<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard');
    }

    public function produk()
    {
        $products = DB::table('products')
        ->join('product_categories', 'products.category_id', '=', 'product_categories.id')
        ->select('products.*', 'product_categories.category_name')
        ->get();

        // Mengirim data produk dan kategori ke dalam view
        return view('produk', ['products' => $products]);
    }

    public function buatproduk()
    {
        $categories = DB::table('product_categories')->get();

        return view('tambahproduk', ['categories' => $categories]);
    }

    public function hapusproduk($id)
    {
        $product = DB::table('products')->where('id', $id)->first();

        if (!$product) {
            return redirect()->back();
        }

        DB::table('products')->where('id', $id)->delete();

        return redirect()->back();
    }

    public function editproduk($id)
    {
        $product = DB::table('products')
            ->join('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->select('products.*', 'product_categories.category_name')
            ->where('products.id', $id)
            ->first();

        $categories = DB::table('product_categories')->get();

        if (!$product) {
            return redirect()->back();
        }

        return view('editproduk', ['product' => $product, 'categories' => $categories]);
    }

    public function tambahproduk(Request $request)
    {

        $imagePaths = [];
        if ($request->hasFile('upload')) {
            foreach ($request->file('upload') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $imagePaths[] = 'images/' . $imageName;
            }
        }

        // Insert data produk baru ke dalam database
        DB::table('products')->insert([
            'product_name' => $request->nama,
            'product_code' => $request->kode,
            'price' => $request->harga,
            'stock' => $request->stok,
            'category_id' => $request->kategori,
            'description' => $request->desc,
            'image' => json_encode($imagePaths)
        ]);

        // Redirect ke halaman produk
        return redirect('/produk');
    }

    public function putproduk(Request $request, $id)
    {
        // Upload gambar produk
        $imagePaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $imagePaths[] = 'images/' . $imageName;
            }
        }

        // Update data produk ke dalam database
        DB::table('products')
            ->where('id', $id)
            ->update([
                'product_name' => $request->nama,
                'product_code' => $request->kode,
                'price' => $request->harga,
                'stock' => $request->stok,
                'category_id' => $request->kategori,
                'description' => $request->desc,
                'image' => json_encode($imagePaths)
            ]);

        // Redirect ke halaman produk
        return redirect('/produk');
    }
}
