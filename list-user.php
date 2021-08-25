<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

</body>
</html>

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
<h1 class="my-5">Xin chào <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b> đến với website của chúng tôi
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

                $query = "select username, fullname, gender, role from users where username = '" . $_SESSION["username"] . "'";
                $result = pg_query($con, $query);
                if ($result) {
                    echo '<table class="table table-bordered table-striped table-hover">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Tài khoản</th>';
                    echo '<th>Họ và tên</th>';
                    echo '<th>Giới tính</th>';
                    echo '<th>Chức vụ</th>';
                    echo '<th>Hành động</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = pg_fetch_all($result)) {
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
                        echo '<td>';
                        echo '<a href="select-user.php?username=' . $row['username'] . '" class="mr-3" title="Xem" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                        echo '<a href="update-password.php?username=' . $row['username'] . '" class="mr-3" title="Cập nhật" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                        echo '<a href="delete-user.php?username=' . $row['username'] . '" class="mr-3" title="Xoá" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
</p>
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