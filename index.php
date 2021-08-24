<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <title>TRANG CHỦ</title>-->
<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">-->
<!--    <style>-->
<!--        body {-->
<!--            font: 14px sans-serif;-->
<!--            text-align: center;-->
<!--        }-->
<!--    </style>-->
<!--</head>-->
<!--<body>-->
<!--<!--<h1 class="my-5">Xin chào đến với website của chúng tôi</h1>-->-->
<!--<!--<p>-->-->
<!--<!--    <a href="register.php" class="btn btn-primary ml-3">Đăng ký</a>-->-->
<!--<!--    <a href="login.php" class="btn btn-success ml-3">Đăng nhập</a>-->-->
<!--<!--</p>-->-->
<!--<nav class="navbar navbar-expand-md navbar-expand bg-light mb-3">-->
<!--    <div class="container-fluid">-->
<!--        <a href="index.php" class="navbar-brand mr-3">ABC</a>-->
<!--        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">-->
<!--            <span class="navbar-toggler-icon"></span>-->
<!--        </button>-->
<!--        <div class="collapse navbar-collapse" id="navbarCollapse">-->
<!--            <div class="navbar-nav">-->
<!--                <a href="index.php" class="nav-item nav-link active">Trang chủ</a>-->
<!--                <a href="#" class="nav-item nav-link">Giới thiệu</a>-->
<!--                <a href="#" class="nav-item nav-link">Dịch vụ</a>-->
<!--                <a href="#" class="nav-item nav-link">Liên hệ</a>-->
<!--            </div>-->
<!--            <div class="navbar-nav ml-auto">-->
<!--                <a href="register.php" class="nav-item nav-link">Đăng ký</a>-->
<!--                <a href="login.php" class="nav-item nav-link">Đăng nhập</a>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</nav>-->
<!--</body>-->
<!--</html>-->
<?php

require 'connection.php';

$query = "insert into users (username, fullname, gender, password, role) values ('admin', N'Nguyễn Hoàng Phong', 0, 'phongnano', 0)";
$result = pg_query($link, $query);
if ($result) {
    echo 'OK';
} else {
    echo 'NOT OK';
}
