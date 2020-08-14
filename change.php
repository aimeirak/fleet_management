<?php 
    
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


<?php

if(isset($_POST['email'])){
    $email= mysqli_real_escape_string($connection,$_POST["email"]);
    $query = "SELECT id,email FROM `fluid_user` WHERE `email`= ? ";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s',$_POST['email']);
    $stmt->execute();
    $result = $stmt->get_result();
    $emialExist = $result->num_rows;
    if($emialExist){
        $row = $result->fetch_assoc(); 
        $LOWN = rand(123,70000);
        $date = date('y-d-m');
        $key = $row['email'].$LOWN.$date;
        $resetKey = password_hash($key,PASSWORD_DEFAULT);
        $passrestQ = 'UPDATE   fluid_user SET passreset = ? where id = ?';
        $stmt = $connection->prepare($passrestQ);
        $stmt->bind_param('si',$resetKey,$row['id']);
        $stmt->execute();
        $inserted = $stmt->affected_rows;
        if($inserted){
            $to  = $row['email'];
            $message = 'password rest key is '. $resetKey .'<BR>' ;
            $sender = "ishyigasoftware900@gmail.com";
            $sender_name = " Password reset ";
            $subject= "freet account passwrod verfication key";

            include 'include/deplicatSolver/emailSender.php';
            $emailSent = sendEmail($subject,$sender,$sender_name,$to,$message);
          
            if($emailSent){
                $success ='request is sent ' ;
            header("Location: reset.php?success=$success");
                
            }else{
            $msg ='request not ';
            }     
       
        }else{
            echo 'not inserted ';
        }
        
     
     
        
    }else{
        echo "Your email doesnot exist !! please try again";
    
    }     

    }else{
        echo " Invalid email!! please try again";
    }

?>






