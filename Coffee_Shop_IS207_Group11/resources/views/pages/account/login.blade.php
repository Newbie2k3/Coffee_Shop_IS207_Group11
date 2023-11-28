@extends('layouts.user')

@section('title', 'Sign In')

@section('page-style')
    <!-- Sign In -->
    <link rel="stylesheet" href="{{ asset('assets/css/pages/login.css') }}">
@endsection

@section('content')
    <section class="login-page">
        <form class="form-signin">
            <div class="text-center mb-4">
                <h1 class="h3 mb-3 font-weight-normal">Đăng nhập</h1>
                <p>Đăng nhập</p>
            </div>

            <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="Tài khoản" required=""
                    autofocus="">
                <label for="inputEmail">Tài khoản</label>
            </div>

            <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" placeholder="Mật khẩu" required="@*">
                <label for="inputPassword">Mật khẩu</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Lưu tài khoản
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Đăng nhập</button>
            <p class="mt-5 mb-3 text-muted text-center">© Coffee Shop</p>
        </form>
    </section>
@endsection
