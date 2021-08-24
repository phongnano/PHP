<?php
// Check existence of id parameter before processing further
if (isset($_GET["username"]) && !empty(trim($_GET["username"]))) {
    // Include config file
    require_once "process/connection.php";

    // Prepare a select statement
    $sql = "SELECT * FROM users WHERE username = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        // Set parameters
        $param_username = trim($_GET["username"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Retrieve individual field value
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
            } else {
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }

        } else {
            echo 'Đã xảy ra lỗi. Vui lòng thử lại sau';
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
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
</body>
</html>
