@extends('admin.layouts.master')

@section('content')

<h2>Cập nhật đơn hàng</h2>

@if ($errors->any())

<div class="alert alert-danger">

    <ul>

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<form action="{{ route('orders.update',$order) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label>Trạng thái đơn hàng</label>

        <select name="OrderStatus" class="form-control">

            <option value="Pending"
                {{ $order->OrderStatus=='Pending' ? 'selected' : '' }}>
                Chờ xác nhận
            </option>

            <option value="Processing"
                {{ $order->OrderStatus=='Processing' ? 'selected' : '' }}>
                Đang xử lý
            </option>

            <option value="Shipping"
                {{ $order->OrderStatus=='Shipping' ? 'selected' : '' }}>
                Đang giao
            </option>

            <option value="Completed"
                {{ $order->OrderStatus=='Completed' ? 'selected' : '' }}>
                Hoàn thành
            </option>

            <option value="Cancelled"
                {{ $order->OrderStatus=='Cancelled' ? 'selected' : '' }}>
                Đã hủy
            </option>

        </select>

    </div>

    <div class="mb-3">

        <label>Trạng thái thanh toán</label>

        <select name="PaymentStatus" class="form-control">

            <option value="Pending"
                {{ $order->PaymentStatus=='Pending' ? 'selected' : '' }}>
                Chờ thanh toán
            </option>

            <option value="Paid"
                {{ $order->PaymentStatus=='Paid' ? 'selected' : '' }}>
                Đã thanh toán
            </option>

            <option value="Failed"
                {{ $order->PaymentStatus=='Failed' ? 'selected' : '' }}>
                Thanh toán thất bại
            </option>

        </select>

    </div>

    <button class="btn btn-primary">

        Cập nhật

    </button>

    <a href="{{ route('orders.index') }}"
       class="btn btn-secondary">

        Quay lại

    </a>

</form>

@endsection