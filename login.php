<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: welcome.php");
    exit;
}

require_once 'connection.php';

$username = $password = null;
$username_error = $password_error = $login_error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty(trim($_POST['username']))) {
        $username_error = 'Vui lòng nhập tài khoản';
    } else {
        $username = trim($_POST['username']);
    }

    if (empty(trim($_POST['password']))) {
        $password_error = 'Vui lòng nhập mật khẩu';
    } else {
        $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    }

    if (empty($username_error) && empty($password_error)) {
        $query = "select username, password from users where username = '" . $username . "' and password = '" . $password . "'";
        $result = pg_query($con, $query);
        $checkLogin = pg_num_rows($result);
        if ($checkLogin > 0) {
            echo '<div class="alert alert-danger" role="alert">Đăng nhập thành công</div>';
            header('location: welcome.php');
            exit();
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Đăng nhập thất bại</div>';
    }
    pg_close($con);
}
?>

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

    <style>
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 360px;
            padding: 20px;
        }
    </style>
</head>

<body>
<div class="wrapper">
    <h2>Đăng Nhập</h2>
    <p>Vui lòng điền vào biểu mẫu để đăng nhập</p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="form-group">
            <label>Tài khoản</label>
            <input type="text" name="username" placeholder="Nhập tài khoản"
                   class="form-control <?php echo (!empty($username_error)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $username; ?>">
            <span class="invalid-feedback"><?php echo $username_error; ?></span>
        </div>

        <div class="form-group">
            <label>Mật khẩu</label>
            <input type="password" name="password" placeholder="Nhập mật khẩu"
                   class="form-control <?php echo (!empty($password_error)) ? 'is-invalid' : ''; ?>">
            <span class="invalid-feedback"><?php echo $password_error; ?></span>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Đăng ký">
            <input type="reset" class="btn btn-secondary ml-2" value="Nhập lại">
        </div>
        <p>Bạn đã chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
    </form>
</div>
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
