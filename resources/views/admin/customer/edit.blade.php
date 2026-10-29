@extends('admin.layouts.master')

@section('content')

<h2>Sửa khách hàng</h2>

@if ($errors->any())

<div class="alert alert-danger">

    <ul>

        @foreach($errors->all() as $error)

        <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<form action="{{ route('customers.update',$customer) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label>Họ và tên</label>

        <input type="text"
               name="FullName"
               class="form-control"
               value="{{ old('FullName',$customer->FullName) }}">

    </div>

    <div class="mb-3">

        <label>Email</label>

        <input type="email"
               name="Email"
               class="form-control"
               value="{{ old('Email',$customer->Email) }}">

    </div>

    <div class="mb-3">

        <label>Số điện thoại</label>

        <input type="text"
               name="Phone"
               class="form-control"
               value="{{ old('Phone',$customer->Phone) }}">

    </div>

    <div class="mb-3">

        <label>Địa chỉ</label>

        <input type="text"
               name="Address"
               class="form-control"
               value="{{ old('Address',$customer->Address) }}">

    </div>

    <button class="btn btn-primary">

        Cập nhật

    </button>

</form>

@endsection