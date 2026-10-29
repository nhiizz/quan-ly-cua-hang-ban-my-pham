@extends('admin.layouts.master')

@section('content')

<h2>Quản lý thanh toán</h2>

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif



<table class="table table-bordered table-hover">

    <thead>

    <tr>

        <th>Mã TT</th>
        <th>Mã đơn</th>
        <th>Phương thức</th>
        <th>Ngày thanh toán</th>
        <th>Số tiền</th>
        <th>Trạng thái</th>

    </tr>

    </thead>

    <tbody>

    @forelse($payments as $index => $payment)

    <tr>

        <td>{{ $index + 1 }}</td>

        <td>{{ $payment->OrderID }}</td>

        <td>{{ $payment->Method }}</td>

        <td>{{ $payment->PaymentDate }}</td>

        <td>{{ number_format($payment->Amount,0,',','.') }} đ</td>

        <td>

            @if($payment->order->PaymentStatus == 'Pending')

                <span class="badge bg-warning text-dark">

                    Chờ thanh toán

                </span>

            @elseif($payment->order->PaymentStatus == 'Paid')

                <span class="badge bg-success">

                    Đã thanh toán

                </span>

            @elseif($payment->order->PaymentStatus == 'Failed')

                <span class="badge bg-danger">

                    Thanh toán thất bại

                </span>

            @else

                {{ $payment->order->PaymentStatus }}

            @endif

        </td>

        
    </tr>

    @empty

    <tr>

        <td colspan="8" class="text-center">

            Chưa có dữ liệu thanh toán.

        </td>

    </tr>

    @endforelse

    </tbody>

</table>

@endsection