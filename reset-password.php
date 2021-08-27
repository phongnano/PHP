<?php

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once "connection.php";

$new_password = $confirm_password = null;
$newpassword_error = $confirmpassword_error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["new_password"]))) {
        $newpassword_error = "Vui lòng nhập mật khẩu mới";
    } elseif (strlen(trim($_POST["new_password"])) < 6) {
        $newpassword_error = "Mật khẩu phải ít nhất 6 ký tự";
    } elseif (!preg_match('/^[a-zA-Z0-9]+$/', trim($_POST["new_password"]))) {
        $newpassword_error = "Mật khẩu chỉ có thể chứa chữ cái, số";
    } else {
        $query = "select password from users u where u.username = '" . $_SESSION['username'] . "'";
        $resutl = pg_query($con, $query);

        if ($row = pg_fetch_assoc($resutl)) {
            if (md5($_POST['new_password']) == $row['password']) {
                $newpassword_error = 'Mật khẩu đã tồn tại';
            } else {
                $new_password = trim($_POST['new_password']);
            }
        }
    }

    if (empty(trim($_POST["confirm_password"]))) {
        $confirmpassword_error = "Vui lòng xác nhận mật khẩu";
    } elseif (!preg_match('/^[a-zA-Z0-9]+$/', trim($_POST["confirm_password"]))) {
        $confirmpassword_error = "Mật khẩu chỉ có thể chứa chữ cái, số";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($newpassword_error) && ($new_password != $confirm_password)) {
            $confirmpassword_error = "Mật khẩu không khớp";
        }
    }
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
    <h2>Khôi Phục Mật Khẩu</h2>
    <p>Vui lòng điền vào biểu mẫu để khôi phục mật khẩu</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Mật khẩu mới</label>
            <input type="password" name="new_password"
                   class="form-control <?php echo (!empty($newpassword_error)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $new_password; ?>">
            <span class="invalid-feedback"><?php echo $newpassword_error; ?></span>
        </div>
        <div class="form-group">
            <label>Xác nhận mật khẩu</label>
            <input type="password" name="confirm_password"
                   class="form-control <?php echo (!empty($confirmpassword_error)) ? 'is-invalid' : ''; ?>">
            <span class="invalid-feedback"><?php echo $confirmpassword_error; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Khôi phục">
            <a class="btn btn-link ml-2" href="welcome.php">Huỷ</a>
        </div>
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