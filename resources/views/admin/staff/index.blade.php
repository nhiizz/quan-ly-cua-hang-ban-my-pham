@extends('admin.layouts.master')

@section('content')

<h2>Quản lý nhân viên</h2>

<a href="{{ route('staffs.create') }}" class="btn btn-success mb-3">
    Thêm nhân viên
</a>

<table class="table table-bordered">

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

    @foreach($staffs as $index => $staff)

    <tr>

        <td>{{ $index + 1 }}</td>

        <td>{{ $staff->FullName }}</td>

        <td>{{ $staff->Email }}</td>

        <td>{{ $staff->Phone }}</td>

        <td>{{ $staff->Address }}</td>

        <td>

            <a href="{{ route('staffs.edit',$staff) }}"
               class="btn btn-warning btn-sm">
                Sửa
            </a>

            <form action="{{ route('staffs.destroy',$staff) }}"
                  method="POST"
                  style="display:inline">

                @csrf
                @method('DELETE')

                <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                    Xóa
                </button>

            </form>

        </td>

    </tr>

    @endforeach

    </tbody>

</table>

@endsection