<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
require 'backend/connection.php';

//$data = file_get_contents("assets/img/atm.jpg");
//
//$escaped = pg_escape_bytea($data);
//pg_query("insert into demo (name, image) values ('demo', '{$escaped}')");

$result = pg_query("select image from demo where name = 'demo'");
while ($row=pg_fetch_aa)

$image = pg_unescape_bytea($row);
?>
</body>
</html>