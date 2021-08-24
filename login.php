<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: welcome.php");
    exit;
}

require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $username = $_POST['password'];

    $query = pg_query($link, "select username, password from users u where u.username = '" . $username . "' and password = '" . $password . "'");
    if ($query) {
        echo "<script>alert('<?php echo $password;?>');</script>";
        header('location: index.php');
    } else {
        echo pg_result_error($query);
    }
}

//// Include config file
//require_once "process/connection.php";
//
//// Define variables and initialize with empty values
//$username = $password = null;
//$username_err = $password_err = $login_err = null;
//
//// Processing form data when form is submitted
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//
//    // Check if username is empty
//    if (empty(trim($_POST["username"]))) {
//        $username_err = "Vui lòng nhập tài khoản";
//    } else {
//        $username = trim($_POST["username"]);
//    }
//
//    // Check if password is empty
//    if (empty(trim($_POST["password"]))) {
//        $password_err = "Vui lòng nhập mật khẩu";
//    } else {
//        $password = trim($_POST["password"]);
//    }
//
//    // Validate credentials
//    if (empty($username_err) && empty($password_err)) {
//        // Prepare a select statement
//        $sql = "select username, fullname, password, role from users where username = ?";
//
//        if ($stmt = mysqli_prepare($link, $sql)) {
//            // Bind variables to the prepared statement as parameters
//            mysqli_stmt_bind_param($stmt, "s", $param_username);
//
//            // Set parameters
//            $param_username = $username;
//
//            // Attempt to execute the prepared statement
//            if (mysqli_stmt_execute($stmt)) {
//                // Store result
//                mysqli_stmt_store_result($stmt);
//
//                // Check if username exists, if yes then verify password
//                if (mysqli_stmt_num_rows($stmt) == 1) {
//                    // Bind result variables
//
//                    mysqli_stmt_bind_result($stmt, $username, $fullname, $hashed_password, $role);
//                    if (mysqli_stmt_fetch($stmt)) {
//                        if (password_verify($password, $hashed_password)) {
//                            // Password is correct, so start a new session
//
//                            session_start();
//
//                            // Store data in session variables
//                            $_SESSION["loggedin"] = true;
//                            $_SESSION["username"] = $username;
//                            $_SESSION["fullname"] = $fullname;
//                            $_SESSION["role"] = $role;
//                            $_SESSION["password"] = $password;
//
////                            $permission = $_SESSION['role'];
////
////                            switch ($permission) {
////                                case 0:
////                                {
////                                    header("location: welcome.php");
////                                    break;
////                                }
////                                case 1:
////                                {
////                                    session_destroy();
////                                    header("location: index.php");
////                                    break;
////                                }
////                            }
//
//                            // Redirect user to welcome page
//                            header("location: welcome.php");
//                        } else {
//                            // Password is not valid, display a generic error message
//                            $login_err = "Mật khẩu không hợp lệ";
//                        }
//                    }
//                } else {
//                    // Username doesn't exist, display a generic error message
//                    $login_err = "Tài khoản không tồn tại";
//                }
//            } else {
//                echo "Đã xảy ra lỗi. Vui lòng thử lại sau";
//            }
//
//            // Close statement
//            mysqli_stmt_close($stmt);
//        }
//    }
//
//    // Close connection
//    mysqli_close($link);
//}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ĐĂNG NHẬP</title>
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
    <h2>Đăng Nhập</h2>
    <p>Vui lòng điền vào biểu mẫu để đăng nhập</p>

    <?php
    if (!empty($login_err)) {
        echo '<div class="alert alert-danger">' . $login_err . '</div>';
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="form-group">
            <label>Tài khoản</label>
            <input type="text" name="username" class="form-control">
            <!--            <span class="invalid-feedback">--><?php //echo $username_err; ?><!--</span>-->
        </div>
        <div class="form-group">
            <label>Mật khẩu</label>
            <input type="password" name="password" class="form-control">
            <!--            <span class="invalid-feedback">--><?php //echo $password_err; ?><!--</span>-->
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Đăng nhập">
            <a class="btn btn-danger ml-5" href="index.php" role="button" id="login">Quay về</a>
        </div>
        <p>Bạn chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
    </form>
</div>
</body>
</html>
