@extends('frontend.layouts.master')

@section('content')

<div class="page-title">
    <h2>Đăng nhập</h2>
</div>

<div class="form-box">

    <div class="form-header">
        Đăng nhập
    </div>

    <div class="form-body">

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.check') }}" method="POST">

            @csrf

            <input type="text"
                   name="UserName"
                   class="form-control"
                   placeholder="Tên đăng nhập"
                   required>

            <input type="password"
                   name="Password"
                   class="form-control"
                   placeholder="Mật khẩu"
                   required>

            <button type="submit" class="btn-main">
                Đăng nhập
            </button>

        </form>

    </div>

</div>

@endsection