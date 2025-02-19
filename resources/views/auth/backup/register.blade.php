@extends('layouts.backup.app')
@section('content')
    <div class="mt-16">
        <h2>Đăng ký tài khoản</h2>
        <form action="{{route('register')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Tên</label>
                <input type="text" class="form-control" name="name">
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="email" class="form-control" name="email">
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" name="password">
                @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Nhập lại mật khẩu</label>
                <input type="password" class="form-control" name="password_confirmation">
            </div>
            <button type="submit" class="btn btn-primary">Đăng ký</button>
        </form>
    </div>
@endsection
