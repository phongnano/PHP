<?php
require 'connection.php';

$username = $fullname = $gender = $password = $confirm_password = $role = null;
$username_error = $fullname_error = $gender_error = $password_error = $confirmpassword_error = $role_error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty(trim($_POST['username']))) {
        $username_error = 'Vui lòng nhập tài khoản';
    } else {
        $username = trim($_POST['username']);
    }

    if (empty(trim($_POST['fullname']))) {
        $fullname_error = 'Vui lòng nhập họ tên';
    } else {
        $fullname = trim($_POST['fullname']);
    }

    if (empty(trim($_POST['gender']))) {
        $gender_error = 'Vui lòng chọn giới tính';
    } else {
        $gender = trim($_POST['gender']);
    }

    if (empty(trim($_POST['password']))) {
        $password_error = 'Vui lòng nhập mật khẩu';
    } else {
        $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    }

    if (empty(trim($_POST['confirm_password']))) {
        $confirmpassword_error = 'Vui lòng xác nhận mật khẩu';
    } else {
        $confirm_password = trim($_POST['confirm_password']);
    }

    if (empty(trim($_POST['role']))) {
        $role_error = 'Vui lòng chọn chức vụ';
    } else {
        $role = trim($_POST['role']);
    }

    if (empty($username_error) && empty($fullname_error) && empty($gender_error) && empty($password_error) && empty($confirmpassword_error) && empty($role_error)) {
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

        $query = "insert into users (username, fullname, gender, password, role) values ('" . $username . "','" . $fullname . "','" . $gender . "','" . $password . "','" . $role . "')";
        $result = pg_query($con, $query);
        if ($result) {
            echo '<div class="alert alert-success" role="alert">Đăng ký thành công</div>';
            header('location: login.php');
            exit();
        } else {
            echo '<div class="alert alert-danger" role="alert">Đăng ký thất bại></div>';
        }
        pg_close($con);
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
    <h2>Đăng Ký</h2>
    <p>Vui lòng điền vào biểu mẫu để tạo tài khoản</p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="form-group">
            <label>Tài khoản</label>
            <input type="text" name="username" placeholder="Nhập tài khoản"
                   class="form-control <?php echo (!empty($username_error)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $username; ?>">
            <span class="invalid-feedback"><?php echo $username_error; ?></span>
        </div>

        <div class="form-group">
            <label>Họ và tên</label>
            <input type="text" name="fullname" placeholder="Nhập họ và tên"
                   class="form-control <?php echo (!empty($fullname_error)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $fullname; ?>">
            <span class="invalid-feedback"><?php echo $fullname_error; ?></span>
        </div>

        <div class="form-group">
            <label>Giới tính</label>
            <select name="gender"
                    class="custom-select mr-sm-2 <?php echo (!empty($gender_error)) ? 'is-invalid' : ''; ?>">
                <option disabled selected hidden>
                    Chọn giới tính
                </option>
                <option value="male">Nam</option>
                <option value="female">Nữ</option>
            </select>
            <span class="invalid-feedback"><?php echo $gender_error; ?></span>
        </div>


        <div class="form-group">
            <label>Mật khẩu</label>
            <input type="password" name="password" placeholder="Nhập mật khẩu"
                   class="form-control <?php echo (!empty($password_error)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $password; ?>">
            <span class="invalid-feedback"><?php echo $password_error; ?></span>
        </div>

        <div class="form-group">
            <label>Xác nhận mật khẩu</label>
            <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu"
                   class="form-control <?php echo (!empty($confirmpassword_error)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $confirm_password; ?>">
            <span class="invalid-feedback"><?php echo $confirmpassword_error ?></span>
        </div>

        <div class="form-group">
            <label>Chức vụ</label>
            <select name="role"
                    class="custom-select mr-sm-2 <?php echo (!empty($role_error)) ? 'is-invalid' : ''; ?>">
                <option disabled selected hidden>
                    Chọn chức vụ
                </option>
                <option value="admin">Quản trị viên</option>
                <option value="staff">Nhân viên</option>
                <option value="customer">Khách hàng</option>
            </select>
            <span class="invalid-feedback"><?php echo $role_error; ?></span>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Đăng ký">
            <input type="reset" class="btn btn-secondary ml-2" value="Nhập lại">
        </div>
        <p>Bạn đã có tài khoản? <a href="#">Đăng nhập ngay</a></p>
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
