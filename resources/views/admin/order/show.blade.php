@extends('admin.layouts.master')

@section('content')

<h2>Chi tiết đơn hàng</h2>

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<div class="card mb-4">

    <div class="card-header">

        <strong>Thông tin đơn hàng</strong>

    </div>

    <div class="card-body">

        <div class="row mb-3">

            <div class="col-md-6">

                <strong>Mã đơn hàng:</strong>

                {{ $order->OrderID }}

            </div>

            <div class="col-md-6">

                <strong>Ngày đặt:</strong>

                {{ $order->OrderDate }}

            </div>

        </div>

        <div class="row mb-3">

            <div class="col-md-6">

                <strong>Khách hàng:</strong>

                {{ $order->customer->FullName ?? '' }}

            </div>

            <div class="col-md-6">

                <strong>Người nhận:</strong>

                {{ $order->ReceiverName }}

            </div>

        </div>

        <div class="row mb-3">

            <div class="col-md-6">

                <strong>Số điện thoại:</strong>

                {{ $order->ReceiverPhone }}

            </div>

            <div class="col-md-6">

                <strong>Địa chỉ:</strong>

                {{ $order->ShippingAddress }}

            </div>

        </div>

        <div class="row mb-3">

            <div class="col-md-6">

                <strong>Phí vận chuyển:</strong>

                {{ number_format($order->ShippingFee,0,',','.') }} đ

            </div>

            <div class="col-md-6">

                <strong>Tổng tiền:</strong>

                {{ number_format($order->TotalAmount,0,',','.') }} đ

            </div>

        </div>

        <div class="row mb-3">

            <div class="col-md-6">

                <strong>Trạng thái đơn:</strong>

                @if($order->OrderStatus=='Pending')

                    Chờ xác nhận

                @elseif($order->OrderStatus=='Processing')

                    Đang xử lý

                @elseif($order->OrderStatus=='Shipping')

                    Đang giao

                @elseif($order->OrderStatus=='Completed')

                    Hoàn thành

                @elseif($order->OrderStatus=='Cancelled')

                    Đã hủy

                @endif

            </div>

            <div class="col-md-6">

                <strong>Thanh toán:</strong>

                @if($order->PaymentStatus=='Pending')

                    Chờ thanh toán

                @elseif($order->PaymentStatus=='Paid')

                    Đã thanh toán

                @elseif($order->PaymentStatus=='Failed')

                    Thanh toán thất bại

                @endif

            </div>

        </div>

        <div class="row">

            <div class="col-md-12">

                <strong>Ghi chú:</strong>
{{ $order->Note }}

            </div>

        </div>

    </div>

</div>

<div class="d-flex justify-content-between mb-3">

    <h4>Danh sách sản phẩm</h4>

    <a href="{{ route('orderdetails.create',['order'=>$order->OrderID]) }}"
       class="btn btn-success">

        + Thêm sản phẩm

    </a>

</div>

<table class="table table-bordered table-hover">

    <thead>

    <tr>

        <th>STT</th>
        <th>Sản phẩm</th>
        <th>Số lượng</th>
        <th>Đơn giá</th>
        <th>Thành tiền</th>
        <th>Chức năng</th>

    </tr>

    </thead>

    <tbody>

    @forelse($order->orderDetails as $detail)

    <tr>

        <td>{{ $loop->iteration }}</td>

        <td>{{ $detail->product->ProductName }}</td>

        <td>{{ $detail->Quantity }}</td>

        <td>{{ number_format($detail->UnitPrice,0,',','.') }} đ</td>

        <td>{{ number_format($detail->Subtotal,0,',','.') }} đ</td>

        <td>

            <a href="{{ route('orderdetails.edit',$detail) }}"
               class="btn btn-warning btn-sm">

                Sửa

            </a>

            <form action="{{ route('orderdetails.destroy',$detail) }}"
                  method="POST"
                  style="display:inline;">

                @csrf
                @method('DELETE')

                <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">

                    Xóa

                </button>

            </form>

        </td>

    </tr>

    @empty

    <tr>

        <td colspan="6" class="text-center">

            Chưa có sản phẩm nào.

        </td>

    </tr>

    @endforelse

    </tbody>

</table>

<a href="{{ route('orders.index') }}"
   class="btn btn-secondary">

    Quay lại

</a>

@endsection
