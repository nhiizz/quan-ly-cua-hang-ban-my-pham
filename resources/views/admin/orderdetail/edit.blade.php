@extends('admin.layouts.master')

@section('content')

<h2>Sửa sản phẩm trong đơn hàng</h2>

@if ($errors->any())

<div class="alert alert-danger">

    <ul>

        @foreach($errors->all() as $error)

        <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<form action="{{ route('orderdetails.update',$orderdetail) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label>Sản phẩm</label>

        <input type="text"
               class="form-control"
               value="{{ $orderdetail->product->ProductName }}"
               readonly>

    </div>

    <div class="mb-3">

        <label>Đơn giá</label>

        <input type="text"
               class="form-control"
               value="{{ number_format($orderdetail->UnitPrice,0,',','.') }} đ"
               readonly>

    </div>

    <div class="mb-3">

        <label>Số lượng</label>

        <input type="number"
               name="Quantity"
               class="form-control"
               min="1"
               value="{{ $orderdetail->Quantity }}">

    </div>

    <button class="btn btn-primary">

        Cập nhật

    </button>

    <a href="{{ route('orders.show',$orderdetail->OrderID) }}"
       class="btn btn-secondary">

        Quay lại

    </a>

</form>

@endsection