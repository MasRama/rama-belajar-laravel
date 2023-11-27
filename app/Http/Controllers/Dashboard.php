<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Products;
use App\Models\Category;

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
        $products = Products::join('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->select('products.*', 'product_categories.category_name')
            ->get();

        // kirim data produk ke view
        return view('produk', ['products' => $products]);
    }

    public function buatproduk()
    {
        $categories = Category::all();

        return view('tambahproduk', ['categories' => $categories]);
    }

    public function hapusproduk($id)
    {
        $product = Products::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Produk Tidak ditemukan');
        }
        
        $product->delete();

        return redirect()->back()->with('success', 'Produk Berhasil dihapus');
    }

    public function editproduk($id)
    {
        $product = Products::join('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->select('products.*', 'product_categories.category_name')
            ->where('products.id', $id)
            ->first();

        $categories = Category::all();

        if (!$product) {
            return redirect()->back();
        }

        return view('editproduk', ['product' => $product, 'categories' => $categories]);
    }

    public function tambahproduk(Request $request)
    {

        $request->validate([
            'nama' => 'required|max:255',
            'kode' => 'required|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'kategori' => 'required|numeric',
            'desc' => 'required',
            'upload.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imagePaths = [];
        if ($request->hasFile('upload')) {
            foreach ($request->file('upload') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $imagePaths[] = 'images/' . $imageName;
            }
        }

        // Insert data produk baru ke dalam database
        $product = new Products;
        $product->product_name = $request->nama;
        $product->product_code = $request->kode;
        $product->price = $request->harga;
        $product->stock = $request->stok;
        $product->category_id = $request->kategori;
        $product->description = $request->desc;
        $product->image = json_encode($imagePaths);
        $product->save();

        // Redirect ke halaman produk
        return redirect('/produk');
    }

    public function putproduk(Request $request, $id)
    {

        $request->validate([
            'nama' => 'required|max:255',
            'kode' => 'required|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'kategori' => 'required|numeric',
            'desc' => 'required',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imagePaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $imagePaths[] = 'images/' . $imageName;
            }
        }

        // Update data produk ke dalam database
        $product = Products::find($id);
        if (!$product) {
            return redirect()->back();
        }

        $product->product_name = $request->nama;
        $product->product_code = $request->kode;
        $product->price = $request->harga;
        $product->stock = $request->stok;
        $product->category_id = $request->kategori;
        $product->description = $request->desc;
        $product->image = json_encode($imagePaths);
        $product->save();

        // Redirect ke halaman produk
        return redirect('/produk');
    }
}
