<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cosmetic Store</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        body{
            margin:0;
            font-family:Arial, Helvetica, sans-serif;
            background:#f5f9ff;
        }

        .navbar{
            background:linear-gradient(90deg,#8EC5FC,#B8E1FF);
            box-shadow:0 2px 12px rgba(0,0,0,.08);
        }

        .logo{
            color:#fff;
            font-size:30px;
            font-weight:bold;
            text-decoration:none;
        }

        .navbar-nav .nav-link{
            color:white;
            font-weight:600;
            margin-left:18px;
            transition:.3s;
        }

        .navbar-nav .nav-link:hover{
            color:#eef8ff;
        }

        .page-title{
            text-align:center;
            margin:45px 0 30px;
        }

        .page-title h2{
            color:#4b6584;
            font-weight:bold;
        }

        .form-box{
            width:460px;
            margin:auto;
            background:white;
            border-radius:16px;
            overflow:hidden;
            box-shadow:0 10px 30px rgba(0,0,0,.08);
        }

        .form-header{
            background:linear-gradient(90deg,#8EC5FC,#B8E1FF);
            color:white;
            text-align:center;
            font-size:30px;
            font-weight:bold;
            padding:18px;
        }

        .form-body{
            padding:30px;
        }

        .form-control{
            height:48px;
            border-radius:10px;
            border:1px solid #dbe8ff;
            margin-bottom:18px;
        }

        .form-control:focus{
            border-color:#8EC5FC;
            box-shadow:0 0 8px rgba(142,197,252,.3);
        }

        .btn-main{
            width:100%;
            height:48px;
            border:none;
            border-radius:10px;
            background:linear-gradient(90deg,#8EC5FC,#B8E1FF);
            color:white;
            font-size:18px;
            font-weight:bold;
        }

        .btn-main:hover{
            transform:translateY(-2px);
            box-shadow:0 6px 15px rgba(142,197,252,.35);
        }

        footer{
            margin-top:70px;
            background:#dff2ff;
            color:#4b6584;
            text-align:center;
            padding:25px;
            font-weight:600;
        }
    </style>

</head>

<body>

<nav class="navbar navbar-expand-lg">

    <div class="container">

        <a class="logo" href="{{ route('home') }}">
            Cosmetic Store
        </a>

        <ul class="navbar-nav ms-auto">
             <li class="nav-item">
                    <span class="nav-link">
                        <i class="fa-solid fa-user"></i>
                        Xin chào, {{ session('UserName') }}
                    </span>
                </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                Trang chủ
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('products.front') }}">
                    Sản phẩm
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('cart') }}">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Giỏ hàng

                    @if(session('cart'))
                        <span class="badge bg-danger">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>
            </li>

            @if(session()->has('AccountID'))

               

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('frontend.orders') }}">
                        <i class="fa-solid fa-box"></i>
                        Đơn hàng của tôi
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-danger" href="{{ route('logout') }}">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Đăng xuất
                    </a>
                </li>

            @else

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        Đăng nhập
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">
                        Đăng ký
                    </a>
                </li>

            @endif

        </ul>

    </div>

</nav>

<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>
    @endif

    @yield('content')

</div>

<footer>

    © 2026 Cosmetic Store

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
