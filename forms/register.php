<?php
require '../backend/connection.php';

$username = $fullname = $gender = $email = $birthday = $cmnd = $phone = $password = $confirm_password = $role = null;
$username_error = $fullname_error = $gender_error = $email_error = $birthday_error = $cmnd_error = $phone_error = $password_error = $confirmpassword_error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //    Validation username
    if (empty(trim($_POST['username']))) {
        $username_error = 'Vui lòng nhập tài khoản';
    } else {
        $checkExistUsername = "select username from users where username = '" . trim($_POST['username']) . "'";
        $result = pg_query($con, $checkExistUsername);
        if (pg_num_rows($result)) {
            $username_error = 'Tài khoản đã tồn tại';
        } else {
            $username = trim($_POST['username']);
        }
    }

    //    Validation fullname
    if (empty(trim($_POST['fullname']))) {
        $fullname_error = 'Vui lòng nhập họ và tên';
    } else {
        $fullname = trim($_POST['fullname']);
    }

    //    Validation gender
    if (empty(trim($_POST['gender']))) {
        $gender_error = 'Vui lòng chọn giới tính';
    } else {
        $gender = trim($_POST['gender']);
    }

    //    Validation email
    if (empty(trim($_POST['email']))) {
        $email_error = 'Vui lòng nhập email';
    } else {
        $email = trim($_POST['email']);
    }

    //    Validation cmnd
    if (empty(trim($_POST['cmnd']))) {
        $cmnd_error = 'Vui lòng nhập cmnd';
    } else {
        $cmnd = trim($_POST['cmnd']);
    }

    //    Validation birthday
    if (empty(trim($_POST['birthday']))) {
        $birthday_error = 'Vui lòng chọn ngày sinh';
    } else {
        $birthday = trim($_POST['birthday']);
    }

    //    Validation phone
    if (empty(trim($_POST['phone']))) {
        $phone_error = 'Vui lòng nhập sô điện thoại';
    } else {
        $phone = trim($_POST['phone']);
    }

    //    Validation password
    if (empty(trim($_POST['password']))) {
        $password_error = 'Vui lòng nhập mật khẩu';
    } else {
        $password = trim($_POST['password']);
    }

    //    Validation confirm_password
    if (empty(trim($_POST['confirm_password']))) {
        $confirmpassword_error = 'Vui lòng nhập lại mật khẩu';
    } else {
        $confirm_password = trim($_POST['confirm_password']);
        if (empty($password_error) && ($password != $confirm_password)) {
            $confirmpassword_error = 'Mật khẩu không khớp';
        }
    }

    //    Validation all
    if (empty($username_error) && empty($fullname_error) && empty($gender_error) && empty($email_error) && empty($cmnd_error) && empty($birthday_error) && empty($phone_error) && empty($password_error) && empty($confirmpassword_error)) {
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

        $role = 2;
        $query = "insert into users (username, fullname, gender, password, role) values ('" . $username . "', '" . $fullname . "', '" . $gender . "', '" . md5($password) . "', '" . $role . "')";
        $result = pg_query($con, $query);
        if ($result) {
            header('location: login.php');
            exit();
        } else {
            echo '<div class="alert alert-danger" role="alert">Đăng ký thất bại</div>';
        }
        pg_close($con);
    }
}
?>

<html lang="en">
<head>
    <title>ABC | Đăng ký</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.css">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

    <!--    Custom CSS - JS-->
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="../assets/js/mains.js"></script>
</head>
<body>
<div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="row py-5 mt-4 align-items-center">
            <!--        Title-->
            <div class="col-md-5 pr-lg-5 mb-5 mb-md-0">
                <img src="../assets/img/loginregister.png" alt=""
                     class="img-fluid mb-3 d-none d-md-block">
                <h1><b style="color: chocolate;">ĐĂNG KÝ</b></h1>
            </div>
            <!--            Register form-->
            <div class="col-md-7 col-lg-6 ml-auto">
                <div class="row">
                    <!--                    Username-->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input id="username" type="text" name="username" placeholder="Tài khoản"
                               class="form-control <?php echo (!empty($username_error)) ? 'is-invalid' : null; ?> bg-white border-left-0 border-md"
                               value="<?php echo $username; ?>">
                    </div>

                    <!--                    Fullname-->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input id="fullname" type="text" name="fullname" placeholder="Họ và tên"
                               class="form-control <?php echo (!empty($fullname_error)) ? 'is-invalid' : null; ?> bg-white border-left-0 border-md"
                               value="<?php echo $fullname; ?>">
                    </div>

                    <!--                    Birthday-->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-calendar text-muted"></i>
                            </span>
                        </div>
                        <input id="birthday" type="text" name="birthday" placeholder="Ngày sinh"
                               class="form-control <?php echo (!empty($birthday_error)) ? 'is-invalid' : null; ?> bg-white border-left-0 border-md"
                               value="<?php echo $birthday; ?>">
                    </div>

                    <!--                    CMND-->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input id="cmnd" type="tel" name="cmnd" placeholder="CMND"
                               class="form-control <?php echo (!empty($cmnd_error)) ? 'is-invalid' : null; ?> bg-white border-left-0 border-md"
                               value="<?php echo $cmnd; ?>">
                    </div>

                    <!--                    Gender-->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-venus-mars text-muted"></i>
                            </span>
                        </div>
                        <select id="gender" name="gender"
                                class="form-control <?php echo (!empty($gender_error)) ? 'is-invalid' : null; ?> bg-white border-left-0 border-md"
                                value="<?php echo $gender; ?>">
                            <option selected disabled hidden>Giới tính</option>
                            <option value="male">Nam</option>
                            <option value="female">Nữ</option>
                        </select>
                    </div>

                    <!--                    Enail address-->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-envelope text-muted"></i>
                            </span>
                        </div>
                        <input id="email" type="email" name="email" placeholder="Email"
                               class="form-control <?php echo (!empty($email_error)) ? 'is-invalid' : null; ?> bg-white border-left-0 border-md"
                               value="<?php echo $email; ?>">
                    </div>

                    <!--                    Phone-->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-phone text-muted"></i>
                            </span>
                        </div>
                        <input id="phone" type="tel" name="phone" placeholder="Điện thoại"
                               class="form-control <?php echo (!empty($phone_error)) ? 'is-invalid' : null; ?> bg-white border-left-0 border-md"
                               value="<?php echo $phone; ?>">
                    </div>

                    <!--                    Password-->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input id="password" type="password" name="password" placeholder="Mật khẩu"
                               class="form-control <?php echo (!empty($password_error)) ? 'is-invalid' : null; ?> bg-white border-left-0 border-md"
                               value="<?php echo $password; ?>">
                    </div>

                    <!--                    Password Confirmation-->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input id="confirm_password" type="password" name="confirm_password"
                               placeholder="Xác nhận mật khẩu"
                               class="form-control <?php echo (!empty($confirmpassword_error)) ? 'is-invalid' : null; ?> bg-white border-left-0 border-md"
                               value="<?php echo $confirm_password; ?>">
                    </div>

                    <div class="col-lg-12 mx-auto">
                        <!--                    ẢNH CHÂN DUNG-->
                        <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                            <input id="avatar" type="file" onchange="readURL(this);"
                                   class="form-control bg-white border-left-0 border-md">
                            <label id="upload-image" for="avatar" class="font-weight-light text-muted">Chọn
                                ảnh</label>
                            <div class="input-group-append">
                                <label for="avatar" class="btn btn-light m-0 rounded-pill px-4"> <i
                                            class="fa fa-cloud-upload mr-2 text-muted"></i><small
                                            class="text-uppercase font-weight-bold text-muted">Chọn
                                        ảnh</small></label>
                            </div>
                        </div>

                        <!--                    Khu vực hiển thị ảnh-->
                        <div class="image-area mt-4">
                            <img id="imageResult" src="#" alt=""
                                 class="img-fluid rounded shadow-sm mx-auto d-block">
                        </div>
                    </div>

                    <!--                    Register button-->
                    <div class="form-group col-lg-12 mx-auto mb-0">
                        <button type="submit" class="btn btn-outline-success btn-block py-2 font-weight-bold">Đăng
                            ký
                        </button>
                    </div>
                    <!--                    Divider line-->
                    <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-4">
                        <div class="border-bottom w-100 m-lg-auto"></div>
                    </div>
                    <!--                    Have account-->
                    <div class="text-center w-100">
                        <p class="text-muted font-weight-bold">Bạn đã có tài khoản?<a href="../forms/login.php"
                                                                                      class="text-primary ml-2">Đăng
                                nhập ngay</a>
                        </p>
                    </div>
                    <!--                    Back home-->
                    <div class="form-group col-lg-12 mx-auto">
                        <a href="../index.php" class="btn btn-services btn-block py-2">
                            <i class="fa fa-arrow-left mr-2"></i>
                            <span class="font-weight-bold">Quay về</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>