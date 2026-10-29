@extends('admin.layouts.master')

@section('content')

<h2>Cập nhật thanh toán</h2>

@if ($errors->any())

<div class="alert alert-danger">

    <ul>

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<form action="{{ route('payments.update',$payment) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label>Đơn hàng</label>

        <input
            type="text"
            class="form-control"
            value="Đơn hàng #{{ $payment->OrderID }}"
            readonly>

    </div>

    <div class="mb-3">

        <label>Phương thức thanh toán</label>

        <select name="Method" class="form-control">

            <option value="COD"
                {{ $payment->Method=='COD' ? 'selected' : '' }}>
                COD
            </option>

            <option value="Banking"
                {{ $payment->Method=='Banking' ? 'selected' : '' }}>
                Chuyển khoản
            </option>

            <option value="Momo"
                {{ $payment->Method=='Momo' ? 'selected' : '' }}>
                MoMo
            </option>

        </select>

    </div>

    <div class="mb-3">

        <label>Ngày thanh toán</label>

        <input
            type="date"
            name="PaymentDate"
            class="form-control"
            value="{{ \Carbon\Carbon::parse($payment->PaymentDate)->format('Y-m-d') }}">

    </div>

    <div class="mb-3">

        <label>Số tiền</label>

        <input
            type="text"
            class="form-control"
            value="{{ number_format($payment->Amount,0,',','.') }} đ"
            readonly>

    </div>

    <div class="mb-3">

        <label>Trạng thái</label>

        <input
            type="text"
            class="form-control"
            value="
            @if($payment->Status=='Pending')
                Chờ thanh toán
            @elseif($payment->Status=='Paid')
                Đã thanh toán
            @else
                Thanh toán thất bại
            @endif
             "
            readonly>

            <option value="Pending"
                {{ $payment->Status=='Pending' ? 'selected' : '' }}>
                Chờ thanh toán
            </option>

            <option value="Paid"
                {{ $payment->Status=='Paid' ? 'selected' : '' }}>
                Đã thanh toán
            </option>

            <option value="Failed"
                {{ $payment->Status=='Failed' ? 'selected' : '' }}>
                Thanh toán thất bại
            </option>

        </select>

    </div>

    <button class="btn btn-primary">

        Cập nhật

    </button>

    <a href="{{ route('payments.index') }}"
       class="btn btn-secondary">

        Quay lại

    </a>

</form>

@endsection