@extends('frontend.layouts.master')

@section('content')

<div class="container mt-5">

    <h2 class="mb-4">Thanh toán</h2>

    @php
        $cart = session('cart', []);
        $total = 0;
    @endphp

    @if(count($cart) == 0)

        <div class="alert alert-warning">
            Giỏ hàng của bạn đang trống.
        </div>

    @else

    <form action="{{ route('checkout.store') }}" method="POST">

        @csrf

        <table class="table table-bordered align-middle">

            <thead class="table-light">
                <tr>
                    <th>Ảnh</th>
                    <th>Sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>

            <tbody>

            @foreach($cart as $item)

                @php
                    $subtotal = $item['Price'] * $item['quantity'];
                    $total += $subtotal;
                @endphp

                <tr>

                    <td width="120">
                        <img src="{{ asset('images/'.$item['Image']) }}"
                             width="80"
                             class="img-thumbnail">
                    </td>

                    <td>{{ $item['ProductName'] }}</td>

                    <td>{{ number_format($item['Price'],0,',','.') }} đ</td>

                    <td>{{ $item['quantity'] }}</td>

                    <td>{{ number_format($subtotal,0,',','.') }} đ</td>

                </tr>

            @endforeach

            </tbody>

        </table>

        <div class="text-end mb-3">
            <h4>
                Tổng tiền:
                <span class="text-danger">
                    {{ number_format($total,0,',','.') }} đ
                </span>
            </h4>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">
                Đặt hàng
            </button>
        </div>

    </form>

    @endif

</div>

@endsection