<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CHÀO MỪNG</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper {
            width: 100%;
            margin: 0 auto;
        }

        table tr td:last-child {
            width: 120px;
        }
    </style>

    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
<h1 class="my-5">Xin chào <b><?php echo htmlspecialchars($_SESSION["fullname"]); ?></b> đến với website của chúng tôi
</h1>
<a href="welcome.php" class="btn btn-danger ml-3">Thoát</a>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="mt-5 mb-3 clearfix">
                    <h2 class="pull-left">Danh sách người dùng</h2>
                    <a href="register.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tạo người dùng
                        mới</a>
                </div>

                <?php
                require_once 'connection.php';

                $sql = 'select username, fullname, gender, role, created_at from users where username = ?';
                if ($stmt = mysqli_prepare($link, $sql)) {
                    mysqli_stmt_bind_param($stmt, 's', $param_username);

                    $param_username = $_SESSION['username'];

                    if (mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);

                        if (mysqli_num_rows($result) == 1) {
                            echo '<table class="table table-bordered table-striped table-hover">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th>Tài khoản</th>';
                            echo '<th>Họ và tên</th>';
                            echo '<th>Giới tính</th>';
                            echo '<th>Chức vụ</th>';
                            echo '<th>Ngày giờ tạo</th>';
                            echo '<th>Hành động</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                            while ($row = mysqli_fetch_array($result)) {
                                $gender = $row['gender'];
                                switch ($gender) {
                                    case 0:
                                    {
                                        $gender = 'Nam';
                                        break;
                                    }
                                    case 1:
                                    {
                                        $gender = 'Nữ';
                                        break;
                                    }
                                }
                                $role = $row['role'];
                                switch ($role) {
                                    case 0:
                                    {
                                        $role = 'Quản trị viên';
                                        break;
                                    }
                                    case 1:
                                    {
                                        $role = 'Nhân viên';
                                        break;
                                    }
                                    case 2:
                                    {
                                        $role = 'Khách hàng';
                                        break;
                                    }
                                }
                                echo '<tr>';
                                echo '<td>' . $row['username'] . '</td>';
                                echo '<td>' . $row['fullname'] . '</td>';
                                echo '<td>' . $gender . '</td>';
                                echo '<td>' . $role . '</td>';
                                echo '<td>' . $row['created_at'] . '</td>';
                                echo '<td>';
                                echo '<a href="select-user.php?username=' . $row['username'] . '" class="mr-3" title="Xem" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                echo '<a href="update-password.php?username=' . $row['username'] . '" class="mr-3" title="Cập nhật" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                echo '<a href="delete-user.php?username=' . $row['username'] . '" class="mr-3" title="Xoá" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                            echo '</tbody>';
                            echo '</table>';

                            mysqli_free_result($result);
                        } else {
                            echo '<div class="alert alert-danger"><em>Không có dữ liệu nào được tìm thấy</em></div>';
                        }
                    } else {
                        echo 'Đã xảy ra lỗi. Vui lòng thử lại sau';
                    }
                }
                mysqli_close($link);
                ?>
            </div>
        </div>
    </div>
</div>
</p>
</body>
</html>