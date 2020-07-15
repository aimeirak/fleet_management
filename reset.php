
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simple Responsive Admin</title>
    <!-- BOOTSTRAP STYLES-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

    <link rel="stylesheet" href="assets/css/styles.css" >

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div id="page-wrapper" >
          <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                    </div>
                    </div>
                    </body>
<
</div></div></div></body>
</html>



<?php  //Start the Session
session_start();
 require('connexion.php');
//3. If the form is submitted or not.
//3.1 If the form is submitted
 
if ($_GET['code']){
//3.1.1 Assigning posted values to variables.
	$get_email= $_GET['email'];
	$get_code =$_GET['code'];
$sql="SELECT*FROM fluid_user where email='$get_email'";
$result1=mysqli_query($connection,$sql);
while($row=mysqli_fetch_assoc($result1)){
		$db_code=$row['passreset'];
		$db_username=$row['email'];
}
if ($get_email==$db_email&& $get_code==$db_code) {
	echo time();
	
echo '

<form action="reset.php" method="POST">
email: <input type="text" name="email" size="20" /><br />
New Password: <input type="password" name="newpassword" size="20" /><br />
Confirm Password: <input type="password" name="confirmpassword" size="20" /><br />
<input type="hidden" name="username" value="$db_usename"';
if (isset($_GET["username"])) {
    echo $_GET["username"];

}

    echo '" /><input type="submit" name="ResetPasswordForm" value=" Reset Password " />

</form>';
}




	
}

?>
