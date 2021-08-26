<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: login.php');
    exit();
}

require_once 'connection.php';

$username = $old_password = $new_password = $confirm_password = null;
$username_error = $oldpassword_error = $newpassword_error = $confirmpassword_error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty(trim($_POST['old_password']))) {
        $oldpassword_error = 'Xin vui lòng nhập mật khẩu hiện tại';
    } elseif (strlen(trim($_POST['old_password'])) < 6) {
        $oldpassword_error = 'Mật khẩu phải ít nhất 6 ký tự';
    } else {
        $checkPassword = "select password from users where username = '" . $_SESSION['username'] . "'";
        $result = pg_query($con, $checkPassword);
        if (pg_num_rows($result)) {
            $oldpassword_error = 'Mật không không tồn tại';
        } else {
            $old_password = trim($_POST['old_password']);
        }


//        if ($stmt = mysqli_prepare($link, $checkPassword)) {
//            mysqli_stmt_bind_param($stmt, 's', $param_username);
//
//            $param_username = $_SESSION['username'];
//
//            if (mysqli_stmt_execute($stmt)) {
//                mysqli_stmt_store_result($stmt);
//
//                if (mysqli_stmt_num_rows($stmt) == 1) {
//                    mysqli_stmt_bind_result($stmt, $hashed_password);
//                    if (mysqli_stmt_fetch($stmt)) {
//                        $old_password = trim($_POST['old_password']);
//                        if (password_verify($old_password, $hashed_password)) {
//                            $old_password = trim($_POST['old_password']);
//                        } else {
//                            $oldpassword_err = 'Mật không không tồn tại';
//                        }
//                    } else {
//                        echo "Đã xảy ra lỗi. Vui lòng thử lại sau";
//                    }
//                    mysqli_stmt_close($stmt);
//                }
//            }
//        }
    }

    if (empty(trim($_POST['new_password']))) {
        $newpassword_error = 'Xin vui lòng nhập mật khẩu mới';
    } elseif (strlen(trim($_POST['new_password'])) < 6) {
        $newpassword_error = 'Mật khẩu phải ít nhất 6 ký tự';
    } else {
        $new_password = trim($_POST['new_password']);
        if (empty($oldpassword_error) && ($old_password == $new_password)) {
            $newpassword_error = 'Mật khẩu mới không được trùng mật khẩu hiện tại';
        }
    }

    if (empty(trim($_POST['confirm_password']))) {
        $confirmpassword_error = 'Xin vui lòng xác nhận mật khẩu';
    } else {
        $confirm_password = trim($_POST['confirm_password']);
        if (empty($newpassword_error) && ($new_password != $confirm_password)) {
            $confirmpassword_error = 'Mật khẩu không khớp';
        }
    }

    if (empty($oldpassword_error) && empty($newpassword_error) && empty($confirmpassword_error)) {
        $query = "update users set password = ? where username = '" . $_SESSION['username'] . "'";
        $result = pg_query($con, $query);
        if ($result) {
            session_destroy();
            header('location: index.php');
            exit();
        } else {
            echo pg_last_error($con);
        }

//        if ($stmt = mysqli_prepare($link, $sql)) {
//            mysqli_stmt_bind_param($stmt, 'ss', $param_password, $param_username);
//
//            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
//            $param_username = $_SESSION['username'];
//
//            if (mysqli_stmt_execute($stmt)) {
//                session_destroy();
//                header('location: index.php');
//                exit();
//            } else {
//                echo "Đã xảy ra lỗi. Vui lòng thử lại sau";
//            }
//        }
//        mysqli_stmt_close($stmt);
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
    <h2>Cập Nhật Mật Khẩu</h2>
    <p>Vui lòng điền vào biểu mẫu để đổi mật khẩu</p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="form-group">
            <label>Mật khẩu cũ</label>
            <input type="password" name="old_password"
                   class="form-control <?php echo (!empty($oldpassword_error)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $old_password; ?>">
            <span class="invalid-feedback"><?php echo $oldpassword_error; ?></span>
        </div>

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
                   class="form-control <?php echo (!empty($confirmpassword_error)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $confirm_password; ?>">
            <span class="invalid-feedback"><?php echo $confirmpassword_error; ?></span>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary ml-2" value="Cập nhật">
            <a class="btn btn-link ml-2" href="list-user.php">Huỷ</a>
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