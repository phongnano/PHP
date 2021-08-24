<?php
// Include config file
require_once "connection.php";

// Define variables and initialize with empty values
$username = $fullname = $gender = $birthday = $role = $password = $confirm_password = "";
$username_err = $fullname_err = $gender_err = $birthday_err = $role_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Vui lòng nhập tài khoản";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Tài khoản chỉ có thể chứa chữ cái, số và dấu gạch dưới";
    } else {
        // Prepare a select statement
        $sql = "select username from users where username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "Tài khoản đã tồn tại";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Đã xảy ra lỗi. Vui lòng thử lại sau";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    if (empty(trim($_POST["fullname"]))) {
        $fullname_err = "Vui lòng nhập họ và tên";
    } elseif (!preg_match('/^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]+$/', trim($_POST["fullname"]))) {
        $fullname_err = "Họ tên chỉ có thể chứa chữ cái";
    } else {
        $fullname = $_POST['fullname'];
    }

    if (empty(trim($_POST['gender']))) {
        $gender_err = 'Vui lòng chọn giới tính';
    } else {
        $gender = $_POST['gender'];
        switch ($gender) {
            case 'male':
            {
                $gender = 0;
                break;
            }
            case 'female':
            {
                $gender = 1;
                break;
            }
        }
    }

    if (empty(trim($_POST['role']))) {
        $role_err = 'Vui lòng chọn chức vụ';
    } else {
        $role = $_POST['role'];
        switch ($role) {
            case 'admin':
            {
                $role = 0;
                break;
            }
            case 'staff':
            {
                $role = 1;
                break;
            }
            case 'customer':
            {
                $role = 2;
                break;
            }
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Vui lòng nhập mật khẩu";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Mật khẩu phải ít nhất 6 ký tự";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Vui lòng xác nhận mật khẩu";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Mật khẩu không khớp";
        }
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($fullname_err) && empty($gender_err) && empty($password_err) && empty($confirm_password_err) && empty($role_err)) {

        // Prepare an insert statement
        $sql = "insert into users (username, fullname, gender, password, role) values (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_fullname, $param_gender, $param_password, $param_role);

            // Set parameters
            $param_username = $username;
            $param_fullname = trim($_POST['fullname']);
            $param_gender = $gender;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_role = $role;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: login.php");
            } else {
                echo "Đã xảy ra lỗi. Vui lòng thử lại sau " . mysqli_stmt_error($stmt);
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
    <title>ĐĂNG KÝ</title>
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
    <h2>Đăng Ký</h2>
    <p>Vui lòng điền vào biểu mẫu để tạo tài khoản</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Tài khoản</label>
            <input type="text" name="username" placeholder="Nhập tài khoản"
                   class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $username; ?>">
            <span class="invalid-feedback"><?php echo $username_err; ?></span>
        </div>

        <div class="form-group">
            <label>Họ và tên</label>
            <input type="text" name="fullname" placeholder="Nhập họ và tên"
                   class="form-control <?php echo (!empty($fullname_err)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $fullname; ?>">
            <span class="invalid-feedback"><?php echo $fullname_err; ?></span>
        </div>

        <div class="form-group">
            <label>Giới tính</label>
            <select name="gender"
                    class="custom-select mr-sm-2 <?php echo (!empty($gender_err)) ? 'is-invalid' : ''; ?>">
                <option disabled selected hidden>
                    Chọn giới tính
                </option>
                <option value="male" <?php echo $gender; ?>>Nam</option>
                <option value="female" <?php echo $gender; ?>>Nữ</option>
            </select>
            <span class="invalid-feedback"><?php echo $gender_err; ?></span>
        </div>


        <div class="form-group">
            <label>Mật khẩu</label>
            <input type="password" name="password" placeholder="Nhập mật khẩu"
                   class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $password; ?>">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>

        <div class="form-group">
            <label>Xác nhận mật khẩu</label>
            <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu"
                   class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $confirm_password; ?>">
            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
        </div>

        <div class="form-group">
            <label>Chức vụ</label>
            <select name="role"
                    class="custom-select mr-sm-2 <?php echo (!empty($role_err)) ? 'is-invalid' : ''; ?>">
                <option disabled selected hidden>
                    Chọn chức vụ
                </option>
                <option value="admin" <?php echo $role; ?>>Quản trị viên</option>
                <option value="staff" <?php echo $role; ?>>Nhân viên</option>
                <option value="customer" <?php echo $role; ?>>Khách hàng</option>
            </select>
            <span class="invalid-feedback"><?php echo $role_err; ?></span>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Đăng ký">
            <input type="reset" class="btn btn-secondary ml-2" value="Nhập lại">
        </div>
        <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
    </form>
</div>
</body>
</html>
