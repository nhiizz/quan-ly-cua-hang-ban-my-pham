@extends('admin.layouts.master')

@section('content')

<h2>Thêm đơn hàng</h2>

@if ($errors->any())

<div class="alert alert-danger">

    <ul class="mb-0">

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<form action="{{ route('orders.store') }}" method="POST">

    @csrf

    <div class="mb-3">

        <label>Khách hàng</label>

        <select name="CustomerID" class="form-control">

            <option value="">-- Chọn khách hàng --</option>

            @foreach($customers as $customer)

                <option value="{{ $customer->CustomerID }}">

                    {{ $customer->FullName }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="mb-3">

        <label>Người nhận</label>

        <input type="text"
               name="ReceiverName"
               class="form-control"
               value="{{ old('ReceiverName') }}">

    </div>

    <div class="mb-3">

        <label>Số điện thoại</label>

        <input type="text"
               name="ReceiverPhone"
               class="form-control"
               value="{{ old('ReceiverPhone') }}">

    </div>

    <div class="mb-3">

        <label>Địa chỉ giao hàng</label>

        <input type="text"
               name="ShippingAddress"
               class="form-control"
               value="{{ old('ShippingAddress') }}">

    </div>

    <div class="mb-3">

        <label>Phí vận chuyển</label>

        <input type="number"
               name="ShippingFee"
               class="form-control"
               value="0">

    </div>

    <div class="mb-3">

        <label>Tổng tiền</label>

        <input type="number"
               name="TotalAmount"
               class="form-control">

    </div>

    <div class="mb-3">

        <label>Voucher (nếu có)</label>

        <input type="number"
               name="VoucherID"
               class="form-control">

    </div>

    <div class="mb-3">

        <label>Trạng thái đơn hàng</label>

        <select name="OrderStatus"
                class="form-control">

            <option value="Pending">Chờ xác nhận</option>

            <option value="Processing">Đang xử lý</option>

            <option value="Shipping">Đang giao</option>

            <option value="Completed">Hoàn thành</option>

            <option value="Cancelled">Đã hủy</option>

        </select>

    </div>

    <div class="mb-3">

        <label>Trạng thái thanh toán</label>

        <select name="PaymentStatus"
                class="form-control">

            <option value="Pending">Chờ thanh toán</option>

            <option value="Paid">Đã thanh toán</option>

            <option value="Failed">Thanh toán thất bại</option>

        </select>

    </div>

    <div class="mb-3">

        <label>Ghi chú</label>

        <textarea name="Note"
class="form-control"
                  rows="3"></textarea>

    </div>

    <button class="btn btn-success">

        Thêm đơn hàng

    </button>

    <a href="{{ route('orders.index') }}"
       class="btn btn-secondary">

        Quay lại

    </a>

</form>

@endsection
