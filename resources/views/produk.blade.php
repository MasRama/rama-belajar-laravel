@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@php
    $id = request('page');
    $page = empty(request('page')) ? 1 : request('page');
    $offset = ($page - 1) * 5;
    $rowcount = $products->count();
@endphp

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">CRUD - Product Listing</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="./dashboard.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Product Listing</li>
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
      <div class="row">
        <!-- Left col -->
        
         
         
          <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header d-flex justify-content-end">                   
                    <h3 class="card-title col align-self-center">
                      @if (Auth::user()->roles === 'admin')
                        <a href="/produk/tambah" class="btn btn-primary col-sm-2">
                          <i class="nav-icon fas fa-plus mr-2"></i> Tambah Produk
                        </a>
                      @endif
                    </h3>
                    <!-- <div class="col justify-content-md-end"> -->
                   

                <form class="align-self-center" action="newproduct.php" method="GET">
      
                <h5>Cari Produk</h5>
                <div class="input-group input-group-sm" style="width: 150px;">

                  <input type="text" name="search" class="form-control float-right" placeholder="Cari produk">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>

                    
                  </div>
                </div>
                </form>
                    
                                 
                    <!-- </div> -->
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">No</th>
                          <th>Nama</th>
                          <th>Kode</th>
                          <th>Harga</th>
                          <th>Unit</th>
                          <th>Stok</th>
                          <th>Kategori</th>
                          <th>Deskripsi</th>
                          <th>Image</th>
                          @if (Auth::user()->roles === 'admin')
                            <th>Aksi</th>
                          @endif
                        </tr>
                      </thead>
                      <tbody>

                      @php
    $index = $page * 5 - 4;
@endphp

@foreach ($products as $product)
    @php
        //decode json
        $imagenow = json_decode($product->image);
    @endphp

    <tr>
        <td>{{ $index }}</td>
        <td>{{ $product->product_name }}</td>
        <td>{{ $product->product_code }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->unit }}</td>
        <td>{{ $product->stock }}</td>
        <td>{{ $product->category_name }}</td>
        <td>{{ $product->description }}</td>
        <td>
            @if ($imagenow != null)
              @foreach($imagenow as $item)
                  <img src="{{ $item }}" width="100px" height="100px"><br>
              @endforeach
            @endif
        </td>
        @if (Auth::user()->roles === 'admin')
          <td>
            <div class="d-flex">
                <a href="{{ url('produk', ['id' => $product->id]) }}" class="btn btn-info mr-2">
                    <i class="nav-icon fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ url('produk', ['id' => $product->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="nav-icon fas fa-trash-alt mr-2"></i>Delete
                    </button>
                </form>
            </div>
          </td>        
        @endif
    </tr>

    @php
        $index++;
    @endphp
@endforeach

                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                      @php
    $get = isset($_GET['search']) ? $_GET['search'] : null;
@endphp

@if ($page == 1)
    <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
@else
    <li class="page-item"><a class="page-link" href="{{ url('newproduct', ['search' => $get, 'page' => $page - 1]) }}">&laquo;</a></li>
@endif

@for ($i = 1; $i <= ceil($rowcount / 5); $i++)
    @if ($i == $page)
        <li class="page-item"><a class="page-link" style="background-color: #007bff; color: white" href="{{ url('newproduct', ['search' => $get, 'page' => $i]) }}">{{ $i }}</a></li>
    @else
        <li class="page-item"><a class="page-link" href="{{ url('newproduct', ['search' => $get, 'page' => $i]) }}">{{ $i }}</a></li>
    @endif
@endfor

@if ($page == ceil($rowcount / 5))
    <li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>
@else
    <li class="page-item"><a class="page-link" href="{{ url('newproduct', ['search' => $get, 'page' => $page + 1]) }}">&raquo;</a></li>
@endif
                    </ul>
                  </div>
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </section>
            
         
        
       
        <section class="col-lg-5 connectedSortable">

          <!-- Main content -->
      
      
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection