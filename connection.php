<?php
$link = mysqli_connect('ec2-18-214-238-28.compute-1.amazonaws.com
', 'fksksdukfwopjs', '4b18a5d24d326aebed06fd62df035a9541852c62f7045283483f8f21685718ef', 'd9dhsg5pgvf1n2','5432');
if (!$link)
    die('Kết nối thất bại ' . mysqli_connect_error());
