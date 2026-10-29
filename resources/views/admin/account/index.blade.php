@extends('admin.layouts.master')

@section('content')

<h2>Quản lý tài khoản</h2>

<a href="{{ route('accounts.create') }}" class="btn btn-success mb-3">
    Thêm tài khoản
</a>

<table class="table table-bordered table-hover">

    <thead>

    <tr>

        <th>ID</th>
        <th>Tên đăng nhập</th>
        <th>Quyền</th>
        <th>Trạng thái</th>
        <th>Chức năng</th>

    </tr>

    </thead>

    <tbody>

    @foreach($accounts as $index => $account)

    <tr>

        <td>{{ $index + 1 }}</td>

        <td>{{ $account->UserName }}</td>

        <td>{{ $account->Role }}</td>

        <td>
            {{ $account->Status == 1 ? 'Hoạt động' : 'Khóa' }}
        </td>

        <td>

            <a href="{{ route('accounts.edit',$account) }}"
               class="btn btn-warning btn-sm">
                Sửa
            </a>

            <form action="{{ route('accounts.destroy',$account) }}"
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