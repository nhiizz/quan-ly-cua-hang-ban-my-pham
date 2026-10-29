@extends('admin.layouts.master')

@section('content')

<h2>Thêm tài khoản</h2>

@if ($errors->any())

<div class="alert alert-danger">

    <ul class="mb-0">

        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<form action="{{ route('accounts.store') }}"
      method="POST">

    @csrf

    <div class="mb-3">

        <label>Tên đăng nhập</label>

        <input type="text"
               name="UserName"
               class="form-control"
               value="{{ old('UserName') }}">

    </div>

    <div class="mb-3">

        <label>Mật khẩu</label>

        <input type="password"
               name="Password"
               class="form-control">

    </div>

  

    <label>Quyền</label>

    <input type="text"
           class="form-control"
           value="Admin"
           readonly>



    <div class="mb-3">

        <label>Trạng thái</label>

        <select name="Status"
                class="form-control">

            <option value="1">Hoạt động</option>

            <option value="0">Khóa</option>

        </select>

    </div>

    <button class="btn btn-success">

        Lưu

    </button>

    <a href="{{ route('accounts.index') }}"
       class="btn btn-secondary">

        Quay lại

    </a>

</form>

@endsection