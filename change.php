<?php     
    include('connexion.php');
?>


<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Password reset</title>
    <link rel="shortcut icon" href="assets/img/icon.png" />
    <link rel="stylesheet" href="assets/css/sb-admin-2.min.css" >
    <script src="assets/js/sb-admin-2.min.js"></script>
</head>
<body>
<div id="page-wrapper" >
          <div id="page-inner">
                <div class="row">
                   
                    <div class="card o-hidden border-0 shadow-lg my-5 col-12 col-sm-4" style="margin:auto">
                        <div class="card-body p-0">
                           
                          <div class="row">
                            
                            <div class="col-12">
                              <div class="p-5">
                              <div id="ms"></div>
                                <div class="text-center">
                                  <h1 class="h4 text-info mb-4">Resetting password</h1>
                                </div>
                                <form  action="change.php" method="POST">
                                  <div class="form-group row">                                  
                                    
                                 <div class="col-sm-12">
                                  E-mail Address:
                                   <input type="email" name="email"  class="form-control " id="Reset" placeholder="example@mail.com">
                                 </div>
                               </div>                               
                              
                               <div class="form-group row">
                               <div class="col-12">
                                                 
                                     <input type="submit" name="ForgotPassword" value=" Request Reset " class="btn btn-sm btn-info col-12"/>

                                    </div>              
                                
                               </div>
                           
                              
                             </form>
                             <hr>
                             
                           
                           </div>
                         </div>
                       </div>
                     </div>
                   </div> 
                   </div>               
            </div>
        </div>
</body>
</html>



<?php

if(isset($_POST['ForgotPassword'])){
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
            $message = 'password rest key  <code> '. $resetKey .'  </code><BR>' ;
            $sender = "ishyigasoftware900@gmail.com";
            $sender_name = " Password reset ";
            $subject= "fleet account passwrod reset verfication key";

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
        echo "Your email does not exist !! please try again";
    
    }    

    }

?>






