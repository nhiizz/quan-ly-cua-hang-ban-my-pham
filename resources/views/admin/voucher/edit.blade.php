@extends('admin.layouts.master')

@section('content')

<h2>Sửa Voucher</h2>

<form action="{{ route('vouchers.update',$voucher) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Mã Voucher</label>

        <input type="text"
               name="VoucherCode"
               class="form-control"
               value="{{ $voucher->VoucherCode }}">
    </div>

    <div class="mb-3">

        <label>Loại giảm giá</label>

        <select name="DiscountType" class="form-control">

            <option value="Percent"
                {{ $voucher->DiscountType=='Percent' ? 'selected' : '' }}>
                Percent
            </option>

            <option value="Amount"
                {{ $voucher->DiscountType=='Amount' ? 'selected' : '' }}>
                Amount
            </option>

        </select>

    </div>

    <div class="mb-3">
        <label>Giá trị giảm</label>

        <input type="number"
               name="DiscountValue"
               class="form-control"
               value="{{ $voucher->DiscountValue }}">
    </div>

    <div class="mb-3">
        <label>Ngày bắt đầu</label>

        <input type="date"
               name="StartDate"
               class="form-control"
               value="{{ $voucher->StartDate }}">
    </div>

    <div class="mb-3">
        <label>Ngày kết thúc</label>

        <input type="date"
               name="EndDate"
               class="form-control"
               value="{{ $voucher->EndDate }}">
    </div>

    <div class="mb-3">
        <label>Số lượng</label>

        <input type="number"
               name="Quantity"
               class="form-control"
               value="{{ $voucher->Quantity }}">
    </div>

    <div class="mb-3">

        <label>Trạng thái</label>

        <select name="Status" class="form-control">

            <option value="1"
                {{ $voucher->Status==1 ? 'selected' : '' }}>
                Hoạt động
            </option>

            <option value="0"
                {{ $voucher->Status==0 ? 'selected' : '' }}>
                Khóa
            </option>

        </select>

    </div>

    <button class="btn btn-primary">
        Cập nhật
    </button>

    <a href="{{ route('vouchers.index') }}"
       class="btn btn-secondary">
        Quay lại
    </a>

</form>

@endsection