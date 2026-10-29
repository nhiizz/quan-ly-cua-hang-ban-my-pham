@extends('frontend.layouts.master')

@section('content')

<h2 class="mb-4">Chi tiết đơn hàng #{{ $order->OrderID }}</h2>

<div class="card mb-4">
    <div class="card-body">

        <p><strong>Ngày đặt:</strong> {{ $order->OrderDate }}</p>

        <p><strong>Trạng thái:</strong>
            <span class="badge bg-warning">
                {{ $order->OrderStatus }}
            </span>
        </p>

        <p><strong>Thanh toán:</strong>
            @if($order->PaymentStatus == 'Paid')
                Đã thanh toán
            @elseif($order->PaymentStatus == 'Unpaid')
                Chưa thanh toán
            @else
                {{ $order->PaymentStatus }}
            @endif
        </p>

        <p><strong>Người nhận:</strong>
            {{ $order->ReceiverName }}
        </p>

        <p><strong>SĐT:</strong>
            {{ $order->ReceiverPhone }}
        </p>

        <p><strong>Địa chỉ:</strong>
            {{ $order->ShippingAddress }}
        </p>

    </div>
</div>

<table class="table table-bordered">

    <thead>

        <tr>

            <th>Ảnh</th>

            <th>Sản phẩm</th>

            <th>Đơn giá</th>

            <th>Số lượng</th>

            <th>Thành tiền</th>

        </tr>

    </thead>

    <tbody>

        @foreach($order->orderDetails as $item)

        <tr>

            <td width="100">

                @php
                    $image = optional($item->product->images->where('IsMainImage',1)->first())->ImageURL;
                @endphp

                @if($image)
                    <img src="{{ asset('images/'.$image) }}"
                         width="80">
                @endif

            </td>

            <td>

                {{ $item->product->ProductName }}

            </td>

            <td>

                {{ number_format($item->UnitPrice,0,',','.') }} đ

            </td>

            <td>

                {{ $item->Quantity }}

            </td>

            <td>

                {{ number_format($item->Subtotal,0,',','.') }} đ

            </td>

        </tr>

        @endforeach

    </tbody>

</table>

<div class="text-end">

    <h4>

        Tổng tiền:
        <span class="text-danger">

            {{ number_format($order->TotalAmount,0,',','.') }} đ

        </span>

    </h4>

</div>

<a href="{{ route('my.orders') }}"
   class="btn btn-secondary">

    Quay lại

</a>

@endsection