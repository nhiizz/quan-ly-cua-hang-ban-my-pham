@extends('admin.layouts.master')

@section('content')

<h2>Thêm sản phẩm vào đơn hàng</h2>

@if ($errors->any())

<div class="alert alert-danger">

    <ul class="mb-0">

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<form action="{{ route('orderdetails.store') }}"
      method="POST">

    @csrf

    <input type="hidden"
           name="OrderID"
           value="{{ $order->OrderID }}">

    <div class="mb-3">

        <label>Mã đơn hàng</label>

        <input type="text"
               class="form-control"
               value="{{ $order->OrderID }}"
               readonly>

    </div>

    <div class="mb-3">

        <label>Sản phẩm</label>

        <select name="ProductID"
                class="form-control">

            <option value="">-- Chọn sản phẩm --</option>

            @foreach($products as $product)

                <option value="{{ $product->ProductID }}">

                    {{ $product->ProductName }}
                    ({{ number_format($product->Price,0,',','.') }} đ)

                </option>

            @endforeach

        </select>

    </div>

    <div class="mb-3">

        <label>Số lượng</label>

        <input type="number"
               name="Quantity"
               class="form-control"
               min="1"
               value="1">

    </div>

    <button class="btn btn-success">

        Lưu

    </button>

    <a href="{{ route('orders.show',$order) }}"
       class="btn btn-secondary">

        Quay lại

    </a>

</form>

@endsection