<?php
require 'connection.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $username = $_POST['password'];

    $query = pg_query($link, "select username, password from users u where u.username = '" . $username . "' and password = '" . $password . "'");
    if ($query) {
        echo 'Đăng nhập thành công';
        header('location: index.php');
    } else {
        echo 'Đăng nhập thất bại';
    }
}