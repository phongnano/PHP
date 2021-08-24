<?php
// Initialize the session
session_start();

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include config file
require_once "connection.php";

// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate new password
    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "Vui lòng nhập mật khẩu mới";
    } elseif (strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "Mật khẩu phải ít nhất 6 ký tự";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["new_password"]))) {
        $new_password_err = "Mật khẩu chỉ có thể chứa chữ cái, số";
    } else {
//        $checkPassword = "select password from users where username = ?";
//        if ($stmt = mysqli_prepare($link, $checkPassword)) {
//            mysqli_stmt_bind_param($stmt, "s", $param_username);
//
//            $param_username = $_SESSION["username"];
//
//            if (mysqli_stmt_execute($stmt)) {
//                mysqli_stmt_store_result($stmt);
//
//                if (mysqli_stmt_num_rows($stmt) == 1) {
//                    mysqli_stmt_bind_result($stmt, $hashed_password);
//                    if (mysqli_stmt_fetch($stmt)) {
//                        $new_password = trim($_POST["new_password"]);
//                        if (password_verify($new_password, $hashed_password)) {
//                            $new_password_err = 'Mật khẩu đã tồn tại';
//                        } else {
//                            $new_password = trim($_POST["new_password"]);
//                        }
//                    } else {
//                        echo "Đã xảy ra lỗi. Vui lòng thử lại sau";
//                    }
//                    mysqli_stmt_close($stmt);
//                }
//            }
//        }
        $new_password = trim($_POST['new_password']);
    }

// Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Vui lòng xác nhận mật khẩu";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "Mật khẩu không khớp";
        }
    }

// Check input errors before updating the database
    if (empty($new_password_err) && empty($confirm_password_err)) {
        // Prepare an update statement
        $sql = "update users set password = ? where username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_password, $param_username);

            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_username = $_SESSION["username"];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else {
                echo "Đã xảy ra lỗi. Vui lòng thử lại sau";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

// Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KHÔI PHỤC MẬT KHẨU</title>
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
    <h2>Khôi Phục Mật Khẩu</h2>
    <p>Vui lòng điền vào biểu mẫu để khôi phục mật khẩu</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Mật khẩu mới</label>
            <input type="password" name="new_password"
                   class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $new_password; ?>">
            <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
        </div>
        <div class="form-group">
            <label>Xác nhận mật khẩu</label>
            <input type="password" name="confirm_password"
                   class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Khôi phục">
            <a class="btn btn-link ml-2" href="welcome.php">Huỷ</a>
        </div>
    </form>
</div>
</body>
</html>