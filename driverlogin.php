<?php //Start the Session
ob_start();
error_reporting(E_ALL);
ini_set('display_errors','On');

session_start();

if(isset($_SESSION['id']))
{
    echo('good');
    header("Location: cardriver.php");
}

include('connexion.php');
//3. If the form is submitted or not.
//3.1 If the form is submitted
if (isset($_POST['username']) and isset($_POST['password'])) {
//3.1.1 Assigning posted values to variables.
    $username = $_POST['username'];
    $pswd = $_POST['password'];
//3.1.2 Checking the values are existing in the database or not
    echo $query = "SELECT * FROM `fluid_driver` WHERE username='$username' and password='$pswd'";
    //echo $query;

    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

    $count = mysqli_num_rows($result);
    //3.1.2 If the posted values are equal to the database values, then session will be created for the user.
    if ($count == 1) {
        $row = mysqli_fetch_array($result);
        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role'];
        $_SESSION['sub_company'] = $row['id_subcompany'];
        $_SESSION['subcompany_name'] = $subcompany_name;

      $sql = "UPDATE fluid_driver SET last_login=NOW() WHERE id=" . $row['id'];
        if (mysqli_query($connection, $sql)) {
            //echo "Record updated successfully";
            header("Location: cardriver.php");
        } else {
            echo "Error updating record: " . mysqli_error($connection);

        }


    } else {
        $msg = "Wrong Username or Password. Please retry";
        header("location:login.php?msg=Wrong Username or Password. Please retry");
    }


}

//3.1.3 If the login credentials doesn't match, he will be shown with an error message.


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Ishyiga</title>
    <!-- BOOTSTRAP STYLES-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

    <link rel="stylesheet" href="assets/css/styles.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>


<form class="form-signin" method="POST">

    <h2 class="form-signin-heading"><?= isset($_GET['msg']) ? $_GET['msg'] : '' ?></h2>
    <h2 class="form-signin-heading text-center">Login</h2>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">@</span>
        <input type="text" name="username" class="form-control" placeholder="Username" required>
    </div>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <button class="btn btn-md btn-primary btn-block" type="submit">Login</button>
    <a href="change.php"><p>Forgot your password?</p>
        <a class="btn btn-md btn-primary btn-block" href="registrationform.php">Register</a>
</form>

</body>
</html>


