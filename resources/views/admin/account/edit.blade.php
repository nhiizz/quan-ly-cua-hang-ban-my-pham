@extends('admin.layouts.master')

@section('content')

<h2>Sửa tài khoản</h2>

@if ($errors->any())

<div class="alert alert-danger">

    <ul class="mb-0">

        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<form action="{{ route('accounts.update',$account) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label>Tên đăng nhập</label>

        <input type="text"
               name="UserName"
               class="form-control"
               value="{{ old('UserName',$account->UserName) }}">

    </div>

    <div class="mb-3">

        <label>Mật khẩu</label>

        <input type="password"
               name="Password"
               class="form-control"
               value="{{ $account->Password }}">

    </div>

    <div class="mb-3">

    <label>Quyền</label>

    <input type="text"
           class="form-control"
           value="{{ $account->Role }}"
           readonly>

</div>

    <div class="mb-3">

        <label>Trạng thái</label>

        <select name="Status"
                class="form-control">

            <option value="1"
                {{ $account->Status == 1 ? 'selected' : '' }}>
                Hoạt động
            </option>

            <option value="0"
                {{ $account->Status == 0 ? 'selected' : '' }}>
                Khóa
            </option>

        </select>

    </div>

    <button class="btn btn-primary">

        Cập nhật

    </button>

    <a href="{{ route('accounts.index') }}"
       class="btn btn-secondary">

        Quay lại

    </a>

</form>

@endsection