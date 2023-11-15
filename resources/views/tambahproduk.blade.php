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
              <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="./dashboard.php">Dashboard</a></li>
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
                <h3 class="card-title">Tambah Produk</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/produk" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Produk</label>
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Produk">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Kode Produk</label>
                    <input type="text" name="kode" class="form-control" id="kode" placeholder="Masukkan Kode Produk">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Harga Produk</label>
                    <input type="number" name="harga" class="form-control" id="harga" placeholder="Masukkan Harga Produk">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Stok Produk</label>
                    <input type="number" name="stok" class="form-control" id="stok" placeholder="Masukkan Stok Produk">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Kategori Produk</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option disabled selected value> Pilih Kategori </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Deskripsi Produk</label>
                    <input type="text" name="desc" class="form-control" id="desc" placeholder="Masukkan Deskripsi Produk">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Gambar Produk</label>
                    <input type="file" name="upload[]" class="form-control" id="upload" multiple>
                  </div>
                </div>
                <!-- /.card-body -->

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