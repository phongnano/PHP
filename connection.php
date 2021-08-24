<?php
$link = mysqli_connect('localhost:3306', 'root', 'phongnano', 'atms');
if (!$link)
    die('Kết nối thất bại ' . mysqli_connect_error());
//define('db_server', 'localhost:3306');
//define('db_username', 'root');
//define('db_passsword', 'phongnano');
//define('db_name', 'atms');
//
//$link = mysqli_connect(db_name, db_username, db_passsword, db_name);
//
//if ($link == false) {
//    die('Lỗi kết nối ' . mysqli_connect_error());
//}
