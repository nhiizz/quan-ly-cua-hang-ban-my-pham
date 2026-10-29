@extends('admin.layouts.master')

@section('content')

<h2>Thêm Voucher</h2>

<form action="{{ route('vouchers.store') }}" method="POST">

    @csrf

    <div class="mb-3">
        <label>Mã Voucher</label>
        <input type="text" name="VoucherCode" class="form-control">
    </div>

    <div class="mb-3">
        <label>Loại giảm giá</label>

        <select name="DiscountType" class="form-control">

            <option value="Percent">Giảm theo phần trăm</option>
            <option value="Amount">Giảm theo số tiền</option>

        </select>

    </div>

    <div class="mb-3">
        <label>Giá trị giảm</label>
        <input type="number" name="DiscountValue" class="form-control">
    </div>

    <div class="mb-3">
        <label>Ngày bắt đầu</label>
        <input type="date" name="StartDate" class="form-control">
    </div>

    <div class="mb-3">
        <label>Ngày kết thúc</label>
        <input type="date" name="EndDate" class="form-control">
    </div>

    <div class="mb-3">
        <label>Số lượng</label>
        <input type="number" name="Quantity" class="form-control">
    </div>

    <div class="mb-3">

        <label>Trạng thái</label>

        <select name="Status" class="form-control">

            <option value="1">Hoạt động</option>
            <option value="0">Khóa</option>

        </select>

    </div>

    <button class="btn btn-success">
        Lưu
    </button>

</form>

@endsection