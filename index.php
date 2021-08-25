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
<!--<h1 class="my-5">Xin chào đến với website của chúng tôi</h1>-->
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
$con = pg_connect('host=ec2-18-214-238-28.compute-1.amazonaws.com dbname=d9dhsg5pgvf1n2 user=fksksdukfwopjs password=4b18a5d24d326aebed06fd62df035a9541852c62f7045283483f8f21685718ef');

if (isset($_POST['submit']) && !empty($_POST['submit'])) {

    $hashpassword = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
    $sql = "select * from users where username = '" . pg_escape_string($_POST['usr']) . "' and password ='" . $hashpassword . "'";
    $data = pg_query($con, $sql);
    $login_check = pg_num_rows($data);
    if ($login_check > 0) {
        echo '<div class="alert alert-success" role="alert">OK</div>';
    } else {

        echo '<div class="alert alert-danger" role="alert">NOT OK</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP PostgreSQL Registration & Login Example </title>
    <meta name="keywords" content="PHP,PostgreSQL,Insert,Login">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h2>Login Here </h2>
    <form method="post">


        <div class="form-group">
            <label for="usr">Username:</label>
            <input type="text" class="form-control" id="usr" placeholder="Enter username" name="usr">
        </div>


        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
        </div>

        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
    </form>
</div>
</body>
</html>
