<?php

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<html lang="en">
<head>
    <title>ABC | Chào mừng</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<h1 class="my-5">Xin chào <b><?php echo htmlspecialchars($_SESSION["fullname"]); ?></b> đến với website của chúng tôi
</h1>
<p>
    <a href="#" class="btn btn-success ml-3">Xem danh sách người dùng</a>
    <a href="#" class="btn btn-warning ml-3">Khôi phục mật khẩu</a>
    <a href="#" class="btn btn-danger ml-3">Đăng xuất</a>
</p>
</body>
</html>
