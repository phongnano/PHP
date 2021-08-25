<?php

if (isset($_GET["username"]) && !empty(trim($_GET["username"]))) {

    require_once "connection.php";

    $username = trim($_GET['username']);

    $sql = "select username, fullname, gender, role from users where username = '" . $username . "'";

    $result = pg_query($con, $query);
    if ($result) {
        while ($row = pg_fetch_array($result)) {
            $username = $row["username"];
            $fullname = $row["fullname"];
            $gender = $row["gender"];
            $role = $row["role"];

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
        }
    }
    pg_close($con);
} else {
    header("location: error.php");
    exit();
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
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-5 mb-3" align="center">Danh Sách Người Dùng</h1>
                <div class="form-group">
                    <label><b style="color: green">Tài khoản</b></label>
                    <p><?php echo $row["username"]; ?></p>
                </div>
                <br>
                <div class="form-group">
                    <label><b style="color: green">Họ và tên</b></label>
                    <p><?php echo $row["fullname"]; ?></p>
                </div>
                <br>
                <div class="form-group">
                    <label><b style="color: green">Giới tính</b></label>
                    <p><?php echo $gender; ?></p>
                </div>
                <br>
                <div class="form-group">
                    <label><b style="color: green">Chức vụ</b></label>
                    <p><?php echo $role; ?></p>
                </div>
                <p><a href="list-user.php" class="btn btn-primary">Quay về</a></p>
            </div>
        </div>
    </div>
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