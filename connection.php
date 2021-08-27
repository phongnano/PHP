<?php
$con = pg_connect('host=localhost dbname=postgres user=postgres password=phongnano');
if (!$con)
    die('Kết nối thất bại');

