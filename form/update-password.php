<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: login.php');
    exit();
}

require_once 'connection.php';

$username = $old_password = $new_password = $confirm_password = '';
$username_err = $oldpassword_err = $newpassword_err = $confirmpassword_err = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty(trim($_POST['old_password']))) {
        $oldpassword_err = 'Xin vui lòng nhập mật khẩu hiện tại';
    } elseif (strlen(trim($_POST['old_password'])) < 6) {
        $oldpassword_err = 'Mật khẩu phải ít nhất 6 ký tự';
    } else {
        $checkPassword = 'select password from users where username = ?';
        if ($stmt = mysqli_prepare($link, $checkPassword)) {
            mysqli_stmt_bind_param($stmt, 's', $param_username);

            $param_username = $_SESSION['username'];

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        $old_password = trim($_POST['old_password']);
                        if (password_verify($old_password, $hashed_password)) {
                            $old_password = trim($_POST['old_password']);
                        } else {
                            $oldpassword_err = 'Mật không không tồn tại';
                        }
                    } else {
                        echo "Đã xảy ra lỗi. Vui lòng thử lại sau";
                    }
                    mysqli_stmt_close($stmt);
                }
            }
        }
    }

    if (empty(trim($_POST['new_password']))) {
        $newpassword_err = 'Xin vui lòng nhập mật khẩu mới';
    } elseif (strlen(trim($_POST['new_password'])) < 6) {
        $newpassword_err = 'Mật khẩu phải ít nhất 6 ký tự';
    } else {
        $new_password = trim($_POST['new_password']);
        if (empty($oldpassword_err) && ($old_password == $new_password)) {
            $newpassword_err = 'Mật khẩu mới không được trùng mật khẩu hiện tại';
        }
    }

    if (empty(trim($_POST['confirm_password']))) {
        $confirmpassword_err = 'Xin vui lòng xác nhận mật khẩu';
    } else {
        $confirm_password = trim($_POST['confirm_password']);
        if (empty($newpassword_err) && ($new_password != $confirm_password)) {
            $confirmpassword_err = 'Mật khẩu không khớp';
        }
    }

    if (empty($oldpassword_err) && empty($newpassword_err) && empty($confirmpassword_err)) {
        $sql = 'update users set password = ? where username = ?';

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, 'ss', $param_password, $param_username);

            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_username = $_SESSION['username'];

            if (mysqli_stmt_execute($stmt)) {
                session_destroy();
                header('location: index.php');
                exit();
            } else {
                echo "Đã xảy ra lỗi. Vui lòng thử lại sau";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CẬP NHẬT MẬT KHẨU</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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
    <h2>Cập Nhật Mật Khẩu</h2>
    <p>Vui lòng điền vào biểu mẫu để đổi mật khẩu</p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="form-group">
            <label>Mật khẩu cũ</label>
            <input type="password" name="old_password"
                   class="form-control <?php echo (!empty($oldpassword_err)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $old_password; ?>">
            <span class="invalid-feedback"><?php echo $oldpassword_err; ?></span>
        </div>

        <div class="form-group">
            <label>Mật khẩu mới</label>
            <input type="password" name="new_password"
                   class="form-control <?php echo (!empty($newpassword_err)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $new_password; ?>">
            <span class="invalid-feedback"><?php echo $newpassword_err; ?></span>
        </div>

        <div class="form-group">
            <label>Xác nhận mật khẩu</label>
            <input type="password" name="confirm_password"
                   class="form-control <?php echo (!empty($confirmpassword_err)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $confirm_password; ?>">
            <span class="invalid-feedback"><?php echo $confirmpassword_err; ?></span>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary ml-2" value="Cập nhật">
            <a class="btn btn-link ml-2" href="list-user.php">Huỷ</a>
        </div>
    </form>
</div>
</body>
</html>
