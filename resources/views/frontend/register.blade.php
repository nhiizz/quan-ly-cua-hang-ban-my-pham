@extends('frontend.layouts.master')

@section('content')

<div class="page-title">
    <h2>Đăng ký</h2>
</div>

<div class="form-box">

    <div class="form-header">
        Đăng ký
    </div>

    <div class="form-body">
        @if($errors->any())

<div class="alert alert-danger">

    <ul class="mb-0">

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

        <form action="{{ route('register.store') }}" method="POST">

            @csrf

            <input type="text"
                    name="FullName"
                    value="{{ old('FullName') }}"
                    class="form-control"
                    placeholder="Họ và tên"
                    required>

            <input type="text"
                    name="UserName"
                    value="{{ old('UserName') }}"
                   class="form-control"
                   placeholder="Tên đăng nhập"
                   required>

            <input type="email"
                   name="Email"
                   value="{{old('Email')}}"
                   class="form-control"
                   placeholder="Email"
                   required>

            <input type="text"
                   name="Phone"
                   value="{{old('Phone')}}"
                   class="form-control"
                   placeholder="Số điện thoại"
                   required>

            <input type="text"
                   name="Address"
                   value="{{old('Address')}}"
                   class="form-control"
                   placeholder="Địa chỉ"
                   required>

            <input type="password"
                   name="Password"
                   class="form-control"
                   placeholder="Mật khẩu"
                   required>

            <input type="password"
                   name="Password_confirmation"
                   class="form-control"
                   placeholder="Xác nhận mật khẩu"
                   required>

            <button type="submit" class="btn-main">
                Đăng ký
            </button>

        </form>

    </div>

</div>

@endsection