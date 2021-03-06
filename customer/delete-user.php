<?php
session_start();

if (isset($_POST['username']) && !empty($_POST['username'])) {
    require_once '../backend/connection.php';

    $username = trim($_POST['username']);

//    $query_select = "select * from users where username = '" . $username . "'";
//    $result_select = pg_query($con, $query_select);
//    $row = pg_fetch_assoc($result_select);
//
//    $avt = $row['avatar'];
//
//    $avatar_dir = $avt;
//
//    if (unlink($avatar_dir)) {
    $query = "delete from users where username = '" . $username . "'";

    $result = pg_query($con, $query);

    if ($result) {
        echo '<script>alert("OK");</script>';
        header('location: ../index.php');
    } else {
        echo '<script>alert("NOT OK");</script>';
    }
//    }
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
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }

        .btn-danger, .btn-secondary, .alert-danger {
            border-radius: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 style="color: darkred" class="mt-5 mb-3 text-center">Xoá người dùng</h2>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="alert alert-danger">
                        <input type="hidden" name="username" value="<?php echo trim($_GET['username']); ?>">
                        <p class="text-center">Bạn có muốn xoá người dùng này?</p>
                        <p>
                            <input type="submit" class="btn btn-danger" value="Đồng ý">
                            <a href="customer-dashboard.php" class="btn btn-secondary">Không</a>
                        </p>
                    </div>
                </form>
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
