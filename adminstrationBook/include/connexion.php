<?php

$connection = mysqli_connect('localhost', 'root', '');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'ishyiga_fuit');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($select_db));
}

$GLOBALS['conn'] = $connection;
date_default_timezone_set("Africa/Kigali");
