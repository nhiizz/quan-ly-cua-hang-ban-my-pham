@extends('admin.layouts.master')

@section('content')

<h2>Sửa nhân viên</h2>

@if ($errors->any())

<div class="alert alert-danger">

    <ul class="mb-0">

        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<form action="{{ route('staffs.update',$staff) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label>Họ và tên</label>

        <input type="text"
               name="FullName"
               class="form-control"
               value="{{ old('FullName',$staff->FullName) }}">

    </div>

    <div class="mb-3">

        <label>Email</label>

        <input type="email"
               name="Email"
               class="form-control"
               value="{{ old('Email',$staff->Email) }}">

    </div>

    <div class="mb-3">

        <label>Số điện thoại</label>

        <input type="text"
               name="Phone"
               class="form-control"
               value="{{ old('Phone',$staff->Phone) }}">

    </div>

    <div class="mb-3">

        <label>Địa chỉ</label>

        <input type="text"
               name="Address"
               class="form-control"
               value="{{ old('Address',$staff->Address) }}">

    </div>

    <button class="btn btn-primary">

        Cập nhật

    </button>

    <a href="{{ route('staffs.index') }}"
       class="btn btn-secondary">

        Quay lại

    </a>

</form>

@endsection