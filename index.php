<!doctype html>
<html lang="en">
<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<h1 class="my-5">Xin chào đến với website của chúng tôi</h1>
<nav class="navbar navbar-expand-md navbar-expand bg-light mb-3">
    <div class="container-fluid">
        <a href="index.php" class="navbar-brand mr-3">ABC</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="index.php" class="nav-item nav-link active">Trang chủ</a>
                <a href="#" class="nav-item nav-link">Giới thiệu</a>
                <a href="#" class="nav-item nav-link">Dịch vụ</a>
                <a href="#" class="nav-item nav-link">Liên hệ</a>
            </div>
            <div class="navbar-nav ml-auto">
                <a href="register.php" class="nav-item nav-link">Đăng ký</a>
                <a href="login.php" class="nav-item nav-link">Đăng nhập</a>
            </div>
        </div>
    </div>
</nav>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>

<!--</html>-->
<?php
//$con = pg_connect('host=ec2-18-214-238-28.compute-1.amazonaws.com dbname=d9dhsg5pgvf1n2 user=fksksdukfwopjs password=4b18a5d24d326aebed06fd62df035a9541852c62f7045283483f8f21685718ef');
//if (isset($_POST['submit']) && !empty($_POST['submit'])) {
//    $hashpassword = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
//    $sql = "select *from public.users where username = '" . $_POST['usr'] . "' and password ='" . $hashpassword . "'";
//    $data = pg_query($con, $sql);
//    $login_check = pg_num_rows($data);
//    if ($login_check > 0) {
//        echo "Login Successfully";
//        echo $login_check;
//    } else {
//        echo "Invalid Details";
//        echo $login_check;
//    }
//}
//?>
<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <title>PHP PostgreSQL Registration & Login Example </title>-->
<!--    <meta name="keywords" content="PHP,PostgreSQL,Insert,Login">-->
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
<!--</head>-->
<!--<body>-->
<!--<div class="container">-->
<!--    <h2>Login Here </h2>-->
<!--    <form method="post">-->
<!---->
<!---->
<!--        <div class="form-group">-->
<!--            <label for="usr">Email:</label>-->
<!--            <input type="text" class="form-control" id="usr" placeholder="Enter username" name="usr">-->
<!--        </div>-->
<!---->
<!---->
<!--        <div class="form-group">-->
<!--            <label for="pwd">Password:</label>-->
<!--            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">-->
<!--        </div>-->
<!---->
<!--        <input type="submit" name="submit" class="btn btn-primary" value="Submit">-->
<!--    </form>-->
<!--</div>-->
<!--</body>-->
<!--</html>-->
