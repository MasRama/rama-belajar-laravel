@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Fatqan</b> Rama</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silahkan Masuk</p>

      <form action="/login" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Masuk dengan no telp">
          <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
    
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
      <!-- /.social-auth-links -->
      <p class="mb-0">
        <a href="/register" class="text-center">Daftar akun disini</a>
      </p>
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
@endsection