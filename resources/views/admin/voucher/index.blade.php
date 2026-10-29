@extends('admin.layouts.master')

@section('content')

<h2>Quản lý Voucher</h2>

<a href="{{ route('vouchers.create') }}" class="btn btn-success mb-3">
    Thêm Voucher
</a>

<table class="table table-bordered table-hover">

    <thead>

    <tr>

        <th>ID</th>
        <th>Mã Voucher</th>
        <th>Loại giảm</th>
        <th>Giá trị</th>
        <th>Ngày bắt đầu</th>
        <th>Ngày kết thúc</th>
        <th>Số lượng</th>
        <th>Trạng thái</th>
        <th>Chức năng</th>

    </tr>

    </thead>

    <tbody>

    @foreach($vouchers as $index => $voucher)

    <tr>

        <td>{{ $index + 1 }}</td>

        <td>{{ $voucher->VoucherCode }}</td>

        <td>
            @if($voucher->DiscountType == 'Percent')
                 Phần trăm (%)
             @elseif($voucher->DiscountType == 'Amount')
                Số tiền
            @endif
        </td>
        <td>{{ $voucher->DiscountValue }}</td>

        <td>{{ $voucher->StartDate }}</td>

        <td>{{ $voucher->EndDate }}</td>

        <td>{{ $voucher->Quantity }}</td>

        <td>
            {{ $voucher->Status ? 'Hoạt động' : 'Khóa' }}
        </td>

        <td>

            <a href="{{ route('vouchers.edit',$voucher) }}"
               class="btn btn-warning btn-sm">
                Sửa
            </a>

            <form action="{{ route('vouchers.destroy',$voucher) }}"
                  method="POST"
                  style="display:inline;">

                @csrf
                @method('DELETE')

                <button class="btn btn-danger btn-sm">
                    Xóa
                </button>

            </form>

        </td>

    </tr>

    @endforeach

    </tbody>

</table>

@endsection