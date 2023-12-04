<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Products;
use App\Models\Category;

use Illuminate\Support\Facades\Storage;

class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalProducts = Products::count();
        $totalCategories = Category::count();
        $totalPrice = Products::sum('price');
        $totalStock = Products::sum('stock');

        $nameCategories = Category::pluck('category_name');

        $allCategory = Category::all();
        $allProduct = Products::all();

        //cek apakah ada kategori yang tidak memiliki produk, dan hitung jumlah produk per kategori
        foreach ($allCategory as $category) {
            $count = 0;
            foreach ($allProduct as $product) {
                if ($product->category_id == $category->id) {
                    $count++;
                }
            }
            $category->count = $count;
        }
        
        //cek apakah ada kategori yang tidak memiliki produk, dan hitung total harga produk per kategori
        foreach ($allCategory as $category) {
            $total = 0;
            foreach ($allProduct as $product) {
                if ($product->category_id == $category->id) {
                    $total += $product->price;
                }
            }
            $category->total = $total;
        }

        //cek apakah ada kategori yang tidak memiliki produk, dan hitung total stok produk per kategori
        foreach ($allCategory as $category) {
            $total = 0;
            foreach ($allProduct as $product) {
                if ($product->category_id == $category->id) {
                    $total += $product->stock;
                }
            }
            $category->totalStock = $total;
        }

        //dd($allCategory);
        
        return view('dashboard', compact('totalProducts', 'totalCategories', 'totalPrice', 'totalStock', 'allCategory'));
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

        // Hapus image
        $oldImagePaths = json_decode($product->image);
        foreach ($oldImagePaths as $path) {
            if (file_exists(public_path($path))) {
                unlink(public_path($path));
            }
        }

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
            'upload.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $product = Products::find($id);
        if (!$product) {
            return redirect()->back();
        }

        // Hapus gambar lama
        $oldImagePaths = json_decode($product->image);
        foreach ($oldImagePaths as $path) {
            if (file_exists(public_path($path))) {
                unlink(public_path($path));
            }
        }

        // Upload gambar
        $imagePaths = [];
        if ($request->hasFile('upload')) {
            foreach ($request->file('upload') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $imagePaths[] = 'images/' . $imageName;
            }
        }

        // Update 
        $product->product_name = $request->nama;
        $product->product_code = $request->kode;
        $product->price = $request->harga;
        $product->stock = $request->stok;
        $product->category_id = $request->kategori;
        $product->description = $request->desc;
        $product->image = json_encode($imagePaths);
        $product->save();

        return redirect('/produk');
    }
}
