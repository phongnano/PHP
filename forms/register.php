<?php
require '../backend/connection.php';

$username = $fullname = $birthday = $gender = $email = $phone = $password = $confirm_password = $role = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = pg_escape_string(($_POST['username']));
    $fullname = pg_escape_string($_POST['fullname']);
    $birthday = pg_escape_string($_POST['birthday']);
    $gender = pg_escape_string($_POST['gender']);
    $email = pg_escape_string($_POST['email']);
    $phone = pg_escape_string($_POST['phone']);
    $password = pg_escape_string($_POST['password']);
    $confirm_password = pg_escape_string($_POST['confirm_password']);

    if (empty($username) && empty($fullname) && empty($birthday) && empty($gender) && empty($email) && empty($phone) && empty($password) && empty($confirm_password)) {
        echo '<div class="alert alert-danger text-center" role="alert">Vui lòng nhập đầy đủ thông tin</div>';
    } else if (empty($username)) {
        echo '<div class="alert alert-danger text-center" role="alert">Vui lòng nhập tài khoản</div>';
    } else if (empty($fullname)) {
        echo '<div class="alert alert-danger text-center" role="alert">Vui lòng nhập họ và tên</div>';
    } else if (empty($birthday)) {
        echo '<div class="alert alert-danger text-center" role="alert">Vui lòng chọn ngày sinh</div>';
    } else if (empty($gender)) {
        echo '<div class="alert alert-danger text-center" role="alert">Vui lòng chọn giới tính</div>';
    } else if (empty($email)) {
        echo '<div class="alert alert-danger text-center" role="alert">Vui lòng nhập email</div>';
    } else if (empty($phone)) {
        echo '<div class="alert alert-danger text-center" role="alert">Vui lòng nhập điện thoại</div>';
    } else if (empty($password)) {
        echo '<div class="alert alert-danger text-center" role="alert">Vui lòng nhập mật khẩu</div>';
    } else if (empty($confirm_password)) {
        echo '<div class="alert alert-danger text-center" role="alert">Vui lòng nhập lại mật khẩu</div>';
    } else {
        $checkExistUsername = "select username from users where username = '" . $username . "'";
        $result = pg_query($con, $checkExistUsername);
        if (pg_num_rows($result)) {
            echo '<div class="alert alert-danger text-center" role="alert">Tài khoản đã tồn tại</div>';
        } else {
            switch ($gender) {
                case 'male':
                {
                    $gender = 0;
                }
                case 'female':
                {
                    $gender = 1;
                }
            }

            $role = 2;

            $birthday = $_POST['birthday'];
            $newbirthday = DateTime::createFromFormat('d/m/Y', $birthday);
            $new_birthday = $newbirthday->format('Y-m-d');

            if ($password == $confirm_password) {
                $query = "insert into users (username, fullname, birthday, gender, email, phone, password, role) values ('" . $username . "', '" . $fullname . "', '" . $new_birthday . "', '" . $gender . "','" . $email . "', '" . $phone . "', '" . md5($password) . "', '" . $role . "')";
                $result = pg_query($con, $query);
                if ($result) {
                    header('location:login.php');
                    exit();
                } else {
                    echo '<div class="alert alert-danger text-center" role="alert">Đăng ký thất bại</div>';
                    echo pg_last_error();
                }
            } else {
                echo '<div class="alert alert-danger text-center" role="alert">Mật khẩu không khớp</div>';
            }
        }
    }

//    $avatar = $_FILES['avatar']['name'];
//    $var_3 = md5($avatar);
//
//    $extension = substr($avatar, strlen($avatar) - 4, strlen($avatar));
//
//    $allowed_extension = array(".jpg", ".png", "jpeg");
//
//    $newavatar = md5($avatar) . $extension;
//    $dst_dir = '../assets/upload_image/' . $newavatar;
//    $dst_img = '../assets/upload_image/' . $newavatar;
//    move_uploaded_file($_FILES['avatar']['tmp_name'], $dst_dir);
//
//    if (!in_array($extension, $allowed_extension)) {
//        echo "<script>alert('Định dạng ảnh không hơp lệ. Định dạng chỉ gồm jpg / jpeg / png');</script>";
//    } else {
////        Insert here
//    }
}
?>

<html lang="en">
<head>
    <title>ABC | Đăng ký</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!--    Custom CSS - JS-->
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
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
                               class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!--                    Fullname-->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input id="fullname" type="text" name="fullname" placeholder="Họ và tên"
                               class="form-control bg-white border-left-0 border-md"">
                    </div>

                    <!--                    Birthday-->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-calendar text-muted"></i>
                            </span>
                        </div>
                        <input id="birthday" name="birthday" placeholder="Ngày sinh"
                               class="form-control bg-white border-left-0 border-md" maxlength="10">
                    </div>

                    <!--                    Gender-->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-venus-mars text-muted"></i>
                            </span>
                        </div>
                        <select id="gender" name="gender"
                                class="form-control bg-white border-left-0 border-md">
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
                               class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!--                    Phone-->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-phone text-muted"></i>
                            </span>
                        </div>
                        <input id="phone" type="tel" name="phone" placeholder="Điện thoại"
                               class="form-control bg-white border-left-0 border-md" maxlength="10">
                    </div>

                    <!--                    Password-->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input id="password" type="password" name="password" placeholder="Mật khẩu"
                               class="form-control bg-white border-left-0 border-md">
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
                               class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!--                    <div class="col-lg-12 mx-auto">-->
                    <!--                    ẢNH CHÂN DUNG-->
                    <!--                        <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">-->
                    <!--                            <input id="avatar" name="avatar" type="file" onchange="readURL(this);"-->
                    <!--                                   class="form-control bg-white border-left-0 border-md" required>-->
                    <!--                            <label id="upload-image" for="avatar" class="font-weight-light text-muted">Chọn-->
                    <!--                                ảnh</label>-->
                    <!--                            <div class="input-group-append">-->
                    <!--                                <label for="avatar" class="btn btn-light m-0 rounded-pill px-4"> <i-->
                    <!--                                            class="fa fa-cloud-upload mr-2 text-muted"></i><small-->
                    <!--                                            class="text-uppercase font-weight-bold text-muted">Chọn-->
                    <!--                                        ảnh</small></label>-->
                    <!--                            </div>-->
                    <!--                        </div>-->

                    <!--                    Khu vực hiển thị ảnh-->
                    <!--                        <div class="image-area mt-4">-->
                    <!--                            <img id="imageResult" src="#" alt=""-->
                    <!--                                 class="img-fluid rounded shadow-sm mx-auto d-block">-->
                    <!--                        </div>-->
                    <!--                    </div>-->

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
                            <span class="font-weight-bold">Quay về trang chủ</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
<script src="/assets/js/mains.js"></script>
</html>