@extends('frontend.layouts.master')

@section('content')

<h2 class="mb-4">Đơn hàng của tôi</h2>

@if($orders->count())

<table class="table table-bordered">

    <thead>

        <tr>

            <th>Mã đơn</th>

            <th>Ngày đặt</th>

            <th>Tổng tiền</th>

            <th>Trạng thái</th>

            <th></th>

        </tr>

    </thead>

    <tbody>

    @foreach($orders as $order)

    <tr>

        <td>#{{ $order->OrderID }}</td>

        <td>{{ $order->OrderDate }}</td>

        <td>{{ number_format($order->TotalAmount) }} đ</td>

        <td>{{ $order->OrderStatus }}</td>

        <td>

            <a href="{{ route('my.order.detail',$order->OrderID) }}"
               class="btn btn-primary btn-sm">

                Xem

            </a>

        </td>

    </tr>

    @endforeach

    </tbody>

</table>

@else

<div class="alert alert-info">

Bạn chưa có đơn hàng nào.

</div>

@endif

@endsection 