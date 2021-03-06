<?php
require '../backend/connection.php';
$username = $password = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = pg_escape_string($_POST['username']);
    $password = pg_escape_string($_POST['password']);

    if (empty($username) && empty($password)) {
        echo '<div class="alert alert-danger text-center">Tài khoản và mật khẩu không được bỏ trống</div>';
    } elseif (empty($username)) {
        echo '<div class="alert alert-danger text-center">Tài khoản không được bỏ trống</div>';
    } elseif (empty($password)) {
        echo '<div class="alert alert-danger text-center">Mật khẩu không được bỏ trống</div>';
    } else {
        $query = "select * from users where username = '" . $username . "' and password = '" . md5($password) . "'";
        $result = pg_query($con, $query);
        $row = pg_fetch_assoc($result);
        if (pg_num_rows($result) == 1) {

            session_start();

            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['role'] = $row['role'];
            $role = $_SESSION['role'];
            if ($role == 0) {
                header('location:../../admin/admin-dashboard.php');
                exit();
            }
            if ($role == 1) {
                header('location:../../employee/employee-dashboard.php');
                exit();
            }
            if ($role == 2) {
                header('location:../../customer/customer-dashboard.php');
                exit();
            }
        } else {
            //echo '<script>alert("Tài khoản hoặc mật khẩu không đúng");</script>';
            echo pg_last_error();
        }
    }
}
?>

<html lang="en">
<head>
    <title>ABC | Đăng nhập</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        .border-md {
            border-width: 2px;
            border-radius: 15px;
        }

        body {
            min-height: 100%;
        }

        .form-control:not(select) {
            padding: 1.5rem 0.5rem;
        }

        select.form-control {
            height: 52px;
            padding-left: 0.5rem;
        }

        .form-control::placeholder {
            color: #ccc;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .form-control:focus {
            box-shadow: none;
        }

        .btn-outline-primary {
            border-width: 2px;
            height: 52px;
            border-radius: 15px;
        }

        input {
            border-radius: 50px;
        }

        label.error
    </style>
</head>
<body>
<div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="row py-5 mt-4 align-items-center">
            <!--        Title-->
            <div class="col-md-5 pr-lg-5 mb-5 mb-md-0">
                <img src="../assets/img/loginregister.png" alt=""
                     class="img-fluid mb-3 d-none d-md-block">
                <h1><b style="color: chocolate;">ĐĂNG NHẬP</b></h1>
            </div>

            <!--            Login form-->
            <div class="col-md-7 col-lg-6 ml-auto">
                <div class="row">
                    <!--                    Username-->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend"><span
                                    class="input-group-text bg-white px-4 border-md border-right-0"><i
                                        class="fa fa-user text-muted"></i></span></div>
                        <input id="username" type="text" name="username" placeholder="Tài khoản"
                               class="form-control bg-white border-left-0 border-md">
                    </div>
                    <!--                    <div class="form-group col-lg-6 mb-4">-->
                    <!--                        <input id="username" type="text" name="username" placeholder="Nhập tài khoản"-->
                    <!--                               class="form-control bg-white border-md">-->
                    <!--                    </div>-->

                    <!--                    Password-->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend"><span
                                    class="input-group-text bg-white px-4 border-md border-right-0"><i
                                        class="fa fa-lock text-muted"></i></span></div>
                        <input id="password" type="password" name="password" placeholder="Mật khẩu"
                               class="form-control bg-white border-left-0 border-md">
                    </div>
                    <!--                    <div class="form-group col-lg-6 mb-4">-->
                    <!--                        <input id="password" type="password" name="password" placeholder="Nhập mật khẩu"-->
                    <!--                               class="form-control bg-white border-md">-->
                    <!--                    </div>-->

                    <!--                    Login button-->
                    <div class="form-group col-lg-12 mx-auto mb-0">
                        <button type="submit" class="btn btn-outline-primary btn-block py-2 font-weight-bold">Đăng
                            nhập
                        </button>
                    </div>

                    <!--                    Divider line-->
                    <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-4">
                        <div class="border-bottom w-100 m-lg-auto"></div>
                    </div>

                    <!--                    No account-->
                    <div class="text-center w-100">
                        <p class="text-muted font-weight-bold">Bạn chưa có tài khoản?<a href="../forms/register.php"
                                                                                        class="text-primary ml-2">Đăng
                                ký ngay</a>
                        </p>
                    </div>

                    <!--                    Back home-->
                    <div class="form-group col-lg-12 mx-auto">
                        <a href="../index.php" class="btn btn-services btn-block py-2">
                            <i class="fa fa-arrow-left mr-2"></i>
                            <span class="font-weight-bold">Quay về trang chủ</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
<script src="/assets/js/mains.js"></script>
</html>