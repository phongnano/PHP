<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../login.php");
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

    <!--    Font awesome-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .wrapper {
            width: 100%;
            margin: 0 auto;
        }

        table tr td:last-child {
            width: 120px;
        }

        .btn-danger, .btn-success {
            border-radius: 10px;
        }
    </style>
</head>
<body>
<h1 class="my-5">Xin chào <b><?php echo htmlspecialchars($_SESSION["fullname"]); ?></b> đến với website của chúng tôi
</h1>
<a href="../index.php" class="btn btn-danger ml-3">Thoát</a>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="mt-5 mb-3 clearfix">
                    <h2 class="pull-left">Danh sách người dùng</h2>
                    <a href="../forms/register.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tạo
                        người dùng
                        mới</a>
                </div>

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Tài khoản</th>
                        <th>Họ và tên</th>
                        <th>Giới tính</th>
                        <th>Ngày sinh</th>
                        <th>Ảnh đại diện</th>
                        <th>Chức vụ</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    require '../backend/connection.php';

                    $query = "select * from users order by role asc";
                    $result = pg_query($con, $query);
                    while ($row = pg_fetch_array($result)) {
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
                        ?>
                        <tr>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['fullname']; ?></td>
                            <td><?php echo $row['gender'] ? 'Nữ' : 'Nam'; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($row['birthday'])); ?></td>
                            <td><img src="<?php echo $row['avatar']; ?>" width="100" height="100"></td>
                            <td><?php echo $role; ?></td>
                            <td><?php echo date('d/m/Y, h:i:s', strtotime($row['created_at'])); ?></td>
                            <td>
                                <a href="select-user.php?username=<?php echo $row['username']; ?>" class="mr-3"
                                   title="Xem"
                                   data-toggle="tooltip"><span class="fa fa-eye"></span></a>
                                <a href="update-password.php?username=<?php echo $row['username']; ?>" class="mr-3"
                                   title="Cập nhật" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>
                                <a href="delete-user.php?username= <?php echo $row['username']; ?>" class="mr-3"
                                   title="Xoá"
                                   data-toggle="tooltip"><span class="fa fa-trash"></span></a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
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