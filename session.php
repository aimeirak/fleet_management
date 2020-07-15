<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysqli_connect("localhost", "root", "");
// Selecting Database
$db = mysqli_select_db($connection,"car_scheduler");
//session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['username'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysqli_query("select * from fluid_user where username='$user_check'", $connection);
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['username'];
$id =$row['id'];

if(!isset($login_session)){
mysqli_close($connection); // Closing Connection
header('Location:ui.php'); // Redirecting To Home Page
}
?>