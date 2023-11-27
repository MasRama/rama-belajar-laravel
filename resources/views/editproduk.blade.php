@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">CRUD - Add Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../index.html">Home</a></li>
              <li class="breadcrumb-item"><a href="./dashboard.html">Dashboard</a></li>
              <li class="breadcrumb-item active">Add Product</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        
        <!-- /.row -->
        <!-- Main row -->
        <div class="row align-items-center justify-content-center">
          <!-- Left col -->
          
           
           
            <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">
               
                <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Produk</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('/produk/' . $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama Produk</label>
                        <input type="text" value="{{ $product->product_name }}" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Produk">
                    </div>
                    <div class="form-group">
                        <label for="kode">Kode Produk</label>
                        <input type="text" value="{{ $product->product_code }}" name="kode" class="form-control" id="kode" placeholder="Masukkan Kode Produk">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga Produk</label>
                        <input type="number" value="{{ $product->price }}" name="harga" class="form-control" id="harga" placeholder="Masukkan Harga Produk">
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok Produk</label>
                        <input type="number" value="{{ $product->stock }}" name="stok" class="form-control" id="stok" placeholder="Masukkan Stok Produk">
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori Produk</label>
                        <select name="kategori" id="kategori" class="form-control" required>
                            @foreach ($categories as $category)
                                @if ($category->id == $product->category_id)
                                    <option value="{{ $category->id }}" selected>{{ $category->category_name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="desc">Deskripsi Produk</label>
                        <input type="text" value="{{ $product->description }}" name="desc" class="form-control" id="desc" placeholder="Masukkan Deskripsi Produk">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Gambar Produk</label>
                      <input type="file" name="upload[]" class="form-control" id="upload" multiple>
                  </div>
                </div>
                <div class="card-footer">
                    <input type="submit" name="submit" class="btn btn-primary">
                </div>
            </form>
            </div>
                  <!-- /.card -->
                </div>
                
              <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
          </section>
              
           
          
         
          
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection