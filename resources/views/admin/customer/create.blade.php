@extends('admin.layouts.master')

@section('content')

<h2>Thêm khách hàng</h2>

@if ($errors->any())

<div class="alert alert-danger">

    <ul>

        @foreach($errors->all() as $error)

        <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<form action="{{ route('customers.store') }}" method="POST">

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

    <div class="mb-3">

        <label>Họ và tên</label>

        <input type="text"
               name="FullName"
               class="form-control"
               value="{{ old('FullName') }}">

    </div>

    <div class="mb-3">

        <label>Email</label>

        <input type="email"
               name="Email"
               class="form-control"
               value="{{ old('Email') }}">

    </div>

    <div class="mb-3">

        <label>Số điện thoại</label>

        <input type="text"
               name="Phone"
               class="form-control"
               value="{{ old('Phone') }}">

    </div>

    <div class="mb-3">

        <label>Địa chỉ</label>

        <input type="text"
               name="Address"
               class="form-control"
               value="{{ old('Address') }}">

    </div>

    <button class="btn btn-success">

        Thêm khách hàng

    </button>

</form>

@endsection