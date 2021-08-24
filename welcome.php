<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
else{

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CHÀO MỪNG</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>
<body>
<h1 class="my-5">Xin chào <b><?php echo htmlspecialchars($_SESSION["fullname"]); ?></b> đến với website của chúng tôi
</h1>
<p>
    <a href="list-user.php" class="btn btn-success ml-3">Xem danh sách người dùng</a>
    <a href="reset-password.php" class="btn btn-warning ml-3">Khôi phục mật khẩu</a>
    <a href="logout.php" class="btn btn-danger ml-3">Đăng xuất</a>
</p>
</body>
</html>