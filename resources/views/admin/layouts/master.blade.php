<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmetic Store - Admin</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
        body {
            overflow-x: hidden;
            background: #f5f6fa;
        }

        .sidebar {
            min-height: 100vh;
            background: #343a40;
        }

        .sidebar h3 {
            color: white;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
        }

        .sidebar a:hover {
            background: #495057;
        }

        .header {
            height: 70px;
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, .1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
        }

        .content {
            padding: 30px;
        }
    </style>

</head>

<body>

<div class="container-fluid">

    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-2 sidebar">

            <h3 class="text-center mt-4">
                CosmeticStore
            </h3>

            <hr class="text-white">

            <a href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>

            <a href="{{ route('categories.index') }}">
                <i class="fa-solid fa-list"></i>
                Danh mục
            </a>

            <a href="{{ route('brands.index') }}">
                <i class="fa-solid fa-tag"></i>
                Thương hiệu
            </a>

            <a href="{{route('products.index')}}">
                <i class="fa-solid fa-box"></i>
                Sản phẩm
            </a>

            <a href="{{route('productimages.index')}}">
                <i class="fa-solid fa-image"></i>
                Hình ảnh sản phẩm
            </a>

            <a href="{{route('vouchers.index')}}">
                <i class="fa-solid fa-ticket"></i>
                Voucher
            </a>

            <a href="{{route('customers.index')}}">
                <i class="fa-solid fa-user"></i>
                Khách hàng
            </a>

            <a href="{{route('staffs.index')}}">
                <i class="fa-solid fa-user-tie"></i>
                Nhân viên
            </a>

            <a href="{{route('accounts.index')}}">
                <i class="fa-solid fa-users"></i>
                Tài khoản
            </a>

            <a href="{{route('orders.index')}}">
                <i class="fa-solid fa-cart-shopping"></i>
                Đơn hàng
            </a>

            <a href="{{route('payments.index')}}">
                <i class="fa-solid fa-credit-card"></i>
                Thanh toán
            </a>
            <a href="{{route('reviews.index')}}">
                <i class="fa-solid fa-star"></i>
                Đánh giá
            </a>

        </div>

        <!-- Nội dung -->
        <div class="col-md-10">

            <!-- Header -->
            <div class="header">

                <h4>Hệ thống quản trị Cosmetic Store</h4>

                <div>
                    Xin chào, <b>Admin</b>

                    <button class="btn btn-danger btn-sm ms-3">
                        Đăng xuất
                    </button>
                </div>

            </div>

            <!-- Content -->
            <div class="content">

                @yield('content')

            </div>

        </div>

    </div>

</div>

</body>

</html>