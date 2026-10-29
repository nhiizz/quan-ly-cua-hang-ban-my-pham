@extends('admin.layouts.master')

@section('content')

<h2>Thêm thanh toán</h2>

@if ($errors->any())

<div class="alert alert-danger">

    <ul>

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<form action="{{ route('payments.store') }}" method="POST">

    @csrf

    <div class="mb-3">

        <label>Đơn hàng</label>

        <select name="OrderID" id="OrderID" class="form-control">

            <option value="">-- Chọn đơn hàng --</option>

            @foreach($orders as $order)

                <option
                    value="{{ $order->OrderID }}"
                    data-amount="{{ $order->TotalAmount }}">

                    Đơn #{{ $order->OrderID }}
                    -
                    {{ number_format($order->TotalAmount,0,',','.') }} đ

                </option>

            @endforeach

        </select>

    </div>

    <div class="mb-3">

        <label>Phương thức thanh toán</label>

        <select name="Method" class="form-control">

            <option value="COD">

                COD

            </option>

            <option value="Banking">

                Chuyển khoản

            </option>

            <option value="Momo">

                MoMo

            </option>

        </select>

    </div>

    <div class="mb-3">

        <label>Ngày thanh toán</label>

        <input
            type="date"
            name="PaymentDate"
            class="form-control">

    </div>

    <div class="mb-3">

        <label>Số tiền</label>

        <input
            type="text"
            id="Amount"
            class="form-control"
            readonly>

    </div>

    <div class="mb-3">

        <label>Trạng thái</label>

        <select name="Status" class="form-control">

            <option value="Pending">

                Chờ thanh toán

            </option>

            <option value="Paid">

                Đã thanh toán

            </option>

            <option value="Failed">

                Thanh toán thất bại

            </option>

        </select>

    </div>

    <button class="btn btn-success">

        Lưu

    </button>

    <a href="{{ route('payments.index') }}"
       class="btn btn-secondary">

        Quay lại

    </a>

</form>

<script>

document.getElementById('OrderID').addEventListener('change',function(){

    let amount = this.options[this.selectedIndex].dataset.amount;

    if(amount){

        document.getElementById('Amount').value =
            Number(amount).toLocaleString('vi-VN') + ' đ';

    }else{

        document.getElementById('Amount').value='';

    }

});

</script>

@endsection