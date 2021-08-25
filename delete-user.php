<?php
session_start();

if (isset($_POST['username']) && !empty($_POST['username'])) {
    require_once 'connection.php';

    $username = trim($_POST['username']);

    $query = "delete from users where username = '" . $username . "'";

    $result = pg_query($con, $query);
    if ($result) {
        pg_close($con);
        session_destroy();
        header('location: index.php');
        exit();
    } else {
        $error = pg_last_error();
        echo 'Lỗi ' . $error;
    }

//    if ($stmt = mysqli_prepare($link, $sql)) {
//        mysqli_stmt_bind_param($stmt, 's', $param_username);
//
//        $param_username = trim($_POST['username']);
//
//        if (mysqli_stmt_execute($stmt)) {
//            session_destroy();
//            header('location: index.php');
//            exit();
//        } else {
//            echo 'Đã xảy ra lỗi. Vui lòng thử lại sau';
//        }
//    }
//    mysqli_stmt_close($stmt);
//
//    mysqli_close($link);
//} else {
//    if (empty(trim($_GET['username']))) {
//        header('location: error.php');
//        exit();
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
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5 mb-3">Xoá người dùng</h2>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="alert alert-danger">
                        <input type="hidden" name="username" value="<?php echo trim($_GET['username']); ?>">
                        <p>Bạn có muốn xoá người dùng này?</p>
                        <p>
                            <input type="submit" class="btn btn-danger" value="Đồng ý">
                            <a href="list-user.php" class="btn btn-secondary">Không</a>
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
