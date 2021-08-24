<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <title>TRANG CHỦ</title>-->
<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">-->
<!--    <style>-->
<!--        body {-->
<!--            font: 14px sans-serif;-->
<!--            text-align: center;-->
<!--        }-->
<!--    </style>-->
<!--</head>-->
<!--<body>-->
<!--<h1 class="my-5">Xin chào đến với website của chúng tôi</h1>-->
<!--<nav class="navbar navbar-expand-md navbar-expand bg-light mb-3">-->
<!--    <div class="container-fluid">-->
<!--        <a href="index.php" class="navbar-brand mr-3">ABC</a>-->
<!--        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">-->
<!--            <span class="navbar-toggler-icon"></span>-->
<!--        </button>-->
<!--        <div class="collapse navbar-collapse" id="navbarCollapse">-->
<!--            <div class="navbar-nav">-->
<!--                <a href="index.php" class="nav-item nav-link active">Trang chủ</a>-->
<!--                <a href="#" class="nav-item nav-link">Giới thiệu</a>-->
<!--                <a href="#" class="nav-item nav-link">Dịch vụ</a>-->
<!--                <a href="#" class="nav-item nav-link">Liên hệ</a>-->
<!--            </div>-->
<!--            <div class="navbar-nav ml-auto">-->
<!--                <a href="register.php" class="nav-item nav-link">Đăng ký</a>-->
<!--                <a href="login.php" class="nav-item nav-link">Đăng nhập</a>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</nav>-->
<!--</body>-->
<!--</html>-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Using Heroku Postgres DB locally in PHP</title>

    <link rel="icon" href="https://jitendrazaa.com/favicon.ico" type="image/x-icon"/>

    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</head>
<body class="container">

<div class="page-header">
    <div class="text-center">
        <h1>Heroku Postgres Database<small> <br/> Use it locally in PHP</small></h1>
    </div>
</div>

<div class="well">
    <h3>Prerequisite</h3>
    <ul>
        <li>Local server must be SSL enabled</li>
    </ul>
</div>

<?
/*
    Sample Database String from Heroku
    'postgres://wvvgxgeoriumxg:c4e8612ae286a211a8c94976df0811e9b6fcdacb3ef3e468401e0619b38a1004@ec2-107-22-168-211.compute-1.amazonaws.com:5432/d5siauekbh9qlu'
    */

//$dbconn = pg_connect("host=ec2-107-22-168-211.compute-1.amazonaws.com port=5432 dbname=d5siauekbh9qlu user=wvvgxgeoriumxg password=c4e8612ae286a211a8c94976df0811e9b6fcdacb3ef3e468401e0619b38a1004");
$dbconn = pg_connect('host=ec2-18-214-238-28.compute-1.amazonaws.com port=5432 dbname=d9dhsg5pgvf1n2 user=fksksdukfwopjs password=4b18a5d24d326aebed06fd62df035a9541852c62f7045283483f8f21685718ef');

$username = pg_escape_string($_POST['username']);
$fullname = pg_escape_string($_POST['fullname']);
$gender = pg_escape_string($_POST['gender']);
$password = pg_escape_string($_POST['password']);
$role = pg_escape_string($_POST['role']);

if (!empty($username) && !empty($fullname) && !empty($gender) && !empty($password) && !empty($role)) {

    $sql = "insert into users (username, fullname, gender, password, role) values ('" . $username . "', '" . $fullname . "', '" . $gender . "', '" . $password . "', '" . $role . "')";
    pg_query($dbconn, $sql);
    ?>
    <div class="alert alert-success" role="alert">
        Record Inserted Succesfully in Heroku Postgres Database !!!
    </div>
    <?
    //close sql if statement bracket
}
?>

<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input required type="text" class="form-control" name="username" id="username"
                       placeholder="First Name">
            </div>

            <div class="form-group">
                <label for="fullname">Fullname</label>
                <input required class="form-control" name="fullname" id="fullname"
                       placeholder="Last Name">
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <input required type="number" class="form-control" name="gender" id="gender"
                       placeholder="Last Name">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input required type="password" class="form-control" name="password" id="password"
                       placeholder="Last Name">
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <input required type="number" class="form-control" name="role" id="role"
                       placeholder="Last Name">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

        <table class="table table-striped table-hover table-bordered">
            <thead>
            <tr>
                <th>Username</th>
                <th>Fullname</th>
                <th>Gender</th>
                <th>Password</th>
                <th>Role</th>
            </tr>
            </thead>
            <tbody>
            <?
            /*
            Use below code to create table and insert some sample records if using first time
            $sql = "drop table Person;";
            pg_query($dbconn, $sql);

            $sql = "create table Person (id SERIAL PRIMARY KEY, firstName varchar(15), lastName varchar(15) );";
            pg_query($dbconn, $sql);

            $sql = "INSERT into Person (firstName,lastName) values ('Rudra', 'Zaa')" ;
            pg_query($dbconn, $sql);
            $sql = "INSERT into Person (firstName,lastName) values ('Shivanya', 'Zaa')" ;
            pg_query($dbconn, $sql);
            $sql = "INSERT into Person (firstName,lastName) values ('Minal', 'Zaa')" ;
            pg_query($dbconn, $sql);
            */

            $sql = "select * from users";

            $resultset = pg_query($dbconn, $sql);
            while ($row = pg_fetch_array($resultset)) {
                echo '<tr>
                                        <td>' . $row['username'] . '</td>
                                        <td>' . $row['fullname'] . '</td>
                                        <td>' . $row['gender'] . '</td>
                                        <td>' . $row['password'] . '</td>
                                        <td>' . $row['role'] . '</td>
                                    </tr>';
            }

            //            pg_close($dbconn);
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
