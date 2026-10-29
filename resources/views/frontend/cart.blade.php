@extends('frontend.layouts.master')

@section('content')

<h2 class="mb-4">Giỏ hàng</h2>

@if(count($cart)>0)

<table class="table table-bordered align-middle">

<thead>

<tr>

<th>Ảnh</th>

<th>Sản phẩm</th>

<th>Đơn giá</th>

<th>Số lượng</th>

<th>Thành tiền</th>

<th></th>

</tr>

</thead>

<tbody>

@php
$total=0;
@endphp

@foreach($cart as $item)

@php
$subtotal=$item['Price']*$item['quantity'];
$total+=$subtotal;
@endphp

<tr>

<td width="120">

@if($item['Image'])

<img src="{{ asset('images/'.$item['Image']) }}"
     width="90">

@endif

</td>

<td>

{{ $item['ProductName'] }}

</td>

<td>

{{ number_format($item['Price']) }} đ

</td>

<td width="170">

<a href="{{ route('cart.decrease',$item['ProductID']) }}"
class="btn btn-sm btn-secondary">

-

</a>

<strong class="mx-3">

{{ $item['quantity'] }}

</strong>

<a href="{{ route('cart.increase',$item['ProductID']) }}"
class="btn btn-sm btn-primary">

+

</a>

</td>

<td>

{{ number_format($subtotal) }} đ

</td>

<td>

<a href="{{ route('cart.remove',$item['ProductID']) }}"
class="btn btn-danger btn-sm">

Xóa

</a>

</td>

</tr>

@endforeach

</tbody>

</table>

<div class="text-end">

<h4>

Tổng tiền:

<strong class="text-danger">

{{ number_format($total) }} đ

</strong>

</h4>

<a href="{{ route('checkout') }}"
class="btn btn-success">

Thanh toán

</a>

</div>

@else

<div class="alert alert-warning">

Giỏ hàng đang trống.

</div>

@endif

@endsection