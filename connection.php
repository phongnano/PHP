<?php
$link = mysqli_connect('localhost:3306', 'root', 'phongnano', 'atms');
if (!$link)
    die('Kết nối thất bại ' . mysqli_connect_error());
