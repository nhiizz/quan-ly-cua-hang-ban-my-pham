<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Login - Cosmetic Store</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>

        body{
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:linear-gradient(135deg,#8EC5FC,#E0F3FF);
            font-family:Arial,Helvetica,sans-serif;
        }

        .login-box{
            width:420px;
            background:#fff;
            border-radius:18px;
            box-shadow:0 15px 35px rgba(0,0,0,.15);
            overflow:hidden;
        }

        .login-header{
            background:linear-gradient(90deg,#8EC5FC,#B8E1FF);
            color:#fff;
            text-align:center;
            padding:25px;
        }

        .login-header h2{
            margin:0;
            font-weight:bold;
        }

        .login-header p{
            margin-top:8px;
            opacity:.9;
        }

        .login-body{
            padding:30px;
        }

        .input-group{
            margin-bottom:18px;
        }

        .input-group-text{
            background:#8EC5FC;
            color:#fff;
            border:none;
        }

        .form-control{
            height:48px;
        }

        .btn-login{
            width:100%;
            height:48px;
            border:none;
            border-radius:10px;
            background:linear-gradient(90deg,#8EC5FC,#B8E1FF);
            color:white;
            font-weight:bold;
            font-size:17px;
        }

        .btn-login:hover{
            opacity:.9;
        }

    </style>

</head>

<body>

<div class="login-box">

    <div class="login-header">

        <h2>Cosmetic Store</h2>

        <p>Đăng nhập Quản trị viên</p>

    </div>

    <div class="login-body">

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.login.check') }}" method="POST">

            @csrf

            <div class="input-group">

                <span class="input-group-text">
                    <i class="fa-solid fa-user"></i>
                </span>

                <input
                    type="text"
                    name="UserName"
                    class="form-control"
                    placeholder="Tên đăng nhập"
                    required>

            </div>

            <div class="input-group">

                <span class="input-group-text">
                    <i class="fa-solid fa-lock"></i>
                </span>

                <input
                    type="password"
name="Password"
                    class="form-control"
                    placeholder="Mật khẩu"
                    required>

            </div>

            <button class="btn-login">

                <i class="fa-solid fa-right-to-bracket"></i>

                Đăng nhập

            </button>

        </form>

    </div>

</div>

</body>

</html>
