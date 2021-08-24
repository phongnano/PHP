<?php
session_start();

if (isset($_POST['username']) && !empty($_POST['username'])) {
    require_once 'connection.php';

    $sql = 'delete from users where username = ?';

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $param_username);

        $param_username = trim($_POST['username']);

        if (mysqli_stmt_execute($stmt)) {
            session_destroy();
            header('location: index.php');
            exit();
        } else {
            echo 'Đã xảy ra lỗi. Vui lòng thử lại sau';
        }
    }
    mysqli_stmt_close($stmt);

    mysqli_close($link);
} else {
    if (empty(trim($_GET['username']))) {
        header('location: error.php');
        exit();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>XOÁ NGƯỜI DÙNG</title>
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
                <h2 class="mt-5 mb-3">Xoá người dùng</h2>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="alert alert-danger">
                        <input type="hidden" name="username" value="<?php echo trim($_GET['username']); ?>">
                        <p>Bạn có muốn xoá người dùng này?</p>
                        <p>
                            <input type="submit" class="btn btn-danger" value="Đồng ý">
                            <a href="list-user.php" class="bt btn-secondary">Không</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
