     <?php
          //error_reporting(0);
include('connexion.php');
session_start();

if(!isset($_SESSION["username"])){
    header("Location: uiupdate.php");
    exit(); }

 $sql="SELECT* FROM booking"; 
     $result=mysqli_query($connection,$sql); 
     ?>

    <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simple Responsive Admin</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
<div id="page-wrapper" >
          <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>join booking</h2>
                    </div>
                </div>
                <!-- /. ROW  -->
                
      <?php
          //error_reporting(0);
 

                      $sql = "SELECT *FROM booking inner join booking_row on booking.id=booking_row.id_booking";
                    $result = mysqli_query($connection,$sql );

   

if(isset($_POST['id_booking'])){


        // removes backslashes
    $id_booking = stripslashes($_POST['id_booking']);
    $name_join = stripslashes($_POST['name_join']);
    //$name_join = mysqli_real_escape_string($connection,$name_join);
    //escapes special characters in a string
    $departure = stripslashes($_POST['departure']);
    //$from = mysqli_real_escape_string($connection,$from);
    $destination = stripslashes($_POST['destination']);
    $description = stripslashes($_POST['description']);
    
    //$to = mysql_real_escape_string($connection,$to);

    $strSQL="INSERT into booking_row (id_booking,name_join,departure,destination,description) values('".$id_booking."','".$name_join."','".$departure."','".$destination."','".$description."')";

    var_dump($strSQL);
   // die();
                    //echo $strSQL; 
 $result = mysqli_query($connection, $strSQL);


 var_dump($result);

                     if($result){

        // Redirect user to ui.php
       header("Location: bookinglist.php");
         }
          }else{}
          ?>
      <?php

      if(isset($_GET["id"])){
       $strSQL="SELECT* FROM booking WHERE id='".$_GET["id"]."'"; 
     $rs=mysqli_query($connection,$strSQL);
     $row=mysqli_fetch_array($rs);

     if(!isset($row))
        {
            
        echo 'booking doesn\'t exist';
            die();}
}
else
{
    echo 'booking doesn\'t exist';
            die();
}

        //var_dump($row);
    ?>
        

 
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
<h1>BOOKING</h1>
<div class="input-group">
<form name="join" action="join.php" method="post">
<br><input name="id_booking" type="text" value="<?php echo $_GET['id']; ?>"></br> 
<br><input name="full_name"  type="text"  value="<?php echo $row["full_name"]; ?>"></br> 
<br><input type="text" name="name_join" placeholder="name_join" required /></br>
<br><input type="text" name="departure" placeholder="departure" required /></br>
<br><input type="text" name="destination" placeholder="destination" required /></br>
<br><input type="text" name="description" placeholder="description" required /></br>
<br><input type="submit" name="submit" value="Register"></br>
</form>

   </div>
 