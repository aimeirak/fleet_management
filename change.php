<?php 
    require_once "Mail.php";
    include('connexion.php');


?>

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
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-5">
                    <form action="change.php" method="POST">

                        E-mail Address: <input type="text" name="email" size="20" /> 
                        <input type="submit" name="ForgotPassword" value=" Request Reset " />

                     </form>
                     </div>
                    </div>

</div></body>
</html>

<?php

if(isset($_POST['email']))
{
    $email= mysqli_real_escape_string($connection,$_POST["email"]);
    $query = "SELECT id FROM `fluid_user` WHERE `email`='".$email."'";
    //echo $query;
    $result=mysqli_query($connection,$query);
    if (mysqli_num_rows ($result )>0) {
        $pwd_reset_hash = bin2hex(openssl_random_pseudo_bytes(32));
        $sql = "UPDATE `fluid_user` SET passreset='".$pwd_reset_hash."' WHERE `email`='".$email."'";
        $result=mysqli_query($connection,$sql);
        if(mysqli_affected_rows($connection)>0)
        {}

        $from = 'Ishyiga';
        $to = $email;
        $subject = "Password reset link";
        $body = 'http://ishyiga.net/fluid/reset.php?token='.$pwd_reset_hash;
        
        $headers = array(
            'From' => $from,
            'To' => $to,
            'Subject' => $subject
        );

        $smtp = Mail::factory('smtp', array(
                'host' => 'ssl://smtp.gmail.com',
                'port' => '465',
                'auth' => true,
                'username' => 'your email',
                'password' => 'your password'
            ));

        $mail = $smtp->send($to, $headers, $body);

        if (PEAR::isError($mail)) {
            echo('<p>' . $mail->getMessage() . '</p>');
        } else {
            echo('<p>Message successfully sent!</p>');
            echo "check your email";
        }

    }else{
        echo "Nop Invalid email!! please try again";
    }
}
?>






