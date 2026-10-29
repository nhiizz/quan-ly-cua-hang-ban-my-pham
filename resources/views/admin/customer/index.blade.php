@extends('admin.layouts.master')

@section('content')

<h2>Quản lý khách hàng</h2>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif



<table class="table table-bordered table-hover">

    <thead>

    <tr>

        <th>ID</th>
        <th>Họ và tên</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Địa chỉ</th>
        <th>Chức năng</th>

    </tr>

    </thead>

    <tbody>

    @foreach($customers as $index=>$customer)

    <tr>

        <td>{{ $index + 1 }}</td>

        <td>{{ $customer->FullName }}</td>

        <td>{{ $customer->Email }}</td>

        <td>{{ $customer->Phone }}</td>

        <td>{{ $customer->Address }}</td>

        <td>

            <a href="{{ route('customers.edit',$customer) }}"
               class="btn btn-warning btn-sm">

                Sửa

            </a>

            <form action="{{ route('customers.destroy',$customer) }}"
                  method="POST"
                  style="display:inline;">

                @csrf
                @method('DELETE')

                <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Bạn có chắc muốn xóa?')">

                    Xóa

                </button>

            </form>

        </td>

    </tr>

    @endforeach

    </tbody>

</table>

@endsection