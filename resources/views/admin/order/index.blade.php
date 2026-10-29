@extends('admin.layouts.master')

@section('content')

<h2>Quản lý đơn hàng</h2>

<a href="{{ route('orders.create') }}"
   class="btn btn-success mb-3">

    Thêm đơn hàng

</a>

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<table class="table table-bordered table-hover">

    <thead>

    <tr>

        <th>Mã đơn</th>
        <th>Khách hàng</th>
        <th>Người nhận</th>
        <th>SĐT</th>
        <th>Ngày đặt</th>
        <th>Tổng tiền</th>
        <th>Trạng thái đơn</th>
        <th>Thanh toán</th>
        <th>Chức năng</th>

    </tr>

    </thead>

    <tbody>

    @foreach($orders as $index =>$order)

    <tr>

        <td>{{ $index + 1 }}</td>

        <td>{{ $order->customer->FullName ?? 'Không có khách hàng' }}</td>

        <td>{{ $order->ReceiverName }}</td>

        <td>{{ $order->ReceiverPhone }}</td>

        <td>{{ $order->OrderDate }}</td>

        <td>{{ number_format($order->TotalAmount,0,',','.') }} đ</td>

        <td>

            @if($order->OrderStatus == 'Pending')

                Chờ xác nhận

            @elseif($order->OrderStatus == 'Processing')

                Đang xử lý

            @elseif($order->OrderStatus == 'Shipping')

                Đang giao

            @elseif($order->OrderStatus == 'Completed')

                Hoàn thành

            @elseif($order->OrderStatus == 'Cancelled')

                Đã hủy

            @else

                {{ $order->OrderStatus }}

            @endif

        </td>

        <td>

            @if($order->PaymentStatus == 'Paid')

                Đã thanh toán

            @elseif($order->PaymentStatus == 'Pending')

                Chờ thanh toán

            @elseif($order->PaymentStatus == 'Failed')

                Thanh toán thất bại

            @else

                {{ $order->PaymentStatus }}

            @endif

        </td>

        <td>

            <a href="{{ route('orders.show',$order) }}"
               class="btn btn-info btn-sm">

                Chi tiết

            </a>

            <a href="{{ route('orders.edit',$order) }}"
               class="btn btn-warning btn-sm">

                Cập nhật

            </a>

            <form action="{{ route('orders.destroy',$order) }}"
                  method="POST"
                  style="display:inline;">

                @csrf
                @method('DELETE')

                <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này?')">

                    Xóa

                </button>

            </form>

        </td>

    </tr>

    @endforeach

    </tbody>

</table>

@endsection