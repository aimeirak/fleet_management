<?php
ob_start();
include 'include/deplicatSolver/emailSender.php';
include('connexion.php');
error_reporting(E_ALL);
ini_set('display_errors', 'On');

?>


<?php
$sent = 0; 
// If form submitted, insert values into the database.
if (isset($_REQUEST['username'])) {
    // removes backslashes
    //escapes special characters in a strin
    $id_subcompany = stripslashes($_REQUEST['subcompany_name']);

    $username = stripslashes($_REQUEST['username']);
    //$username = mysqli_real_escape_string($username);
    $full_name = stripslashes($_REQUEST['full_name']);
    //$full_name = mysqli_real_escape_string($full_name);
    $phone_number = stripslashes($_REQUEST['phone_number']);
    //$phone_number = mysql_real_escape_string($phone_number);
    $password = stripslashes($_REQUEST['password']);
    //$password =(mysqli_real_escape_string($password));
    $email = stripslashes($_REQUEST['email']);
    
    //prevent sql injection

   
    
        $msg="";
        if(empty($id_subcompany)||empty($username)||empty($full_name)||empty($phone_number)||empty($password)||empty($email)){
            $msg = 'you have empty field';
          }else{
              $query_check_username ="SELECT * FROM fluid_user where  username = ? ";
              $stmt = $connection->prepare($query_check_username);
              $stmt->bind_param('s',$username);
              $stmt->execute();
              $result = $stmt->get_result();
              
              if($result->num_rows > 0){
                $stmt->close();
                $status = 0;
                $msg.="Username already taken "."</br>";
                
                                              
                    
              }  
              $query_check_email ="SELECT * FROM fluid_user where email = ? ";
              $stmt = $connection->prepare($query_check_email);
              $stmt->bind_param('s',$email);
              $stmt->execute();
              $result = $stmt->get_result();
                          
              if($result->num_rows > 0){
                $status = 0; 
                $msg.="Email already exist "."</br>";               
                 
              }
                  else{
                    $round = rand(100,900);
                    $values = time().$round;
                    
                    $passwordh = md5($password);
                    $passreset = md5(time().$round);
                    $roundn = rand(10,700);
                    $varKey = md5(time().$username.$roundn.$email);
                    $verfied= 0;
                    $id =  '';
                    $subject = "ishyiga freet user verification ";
                    $sender = "ishyigasoftware900@gmail.com";
                    $sender_name = "ishyiga Freet Managiment system ";
                    $m   = password_hash($email,PASSWORD_DEFAULT);
                    $to  = $email;
                    $contents = ''.$varKey.'  copy and past in you verfication input';
                    $isSent = sendEmail($subject,$sender,$sender_name,$to,$contents);
                    //will be changed manuel               
                   
                    
                    if($isSent){
                        $query  = "INSERT into fluid_user(id,id_subcompany,username,full_name,phone_number,password,passreset,email,vercod)  values (?,?,?,?,?,?,?,?,?)";
                        $sent = 1;
                        if ( $stmt   = $connection->prepare($query)) {
                            $stmt->bind_param('iisssssss',$id,$id_subcompany,$username,$full_name,$phone_number,$passwordh,$passreset,$email,$varKey);
                            $stmt->execute();       
                            $sent = 1;                 
        
                        }else{
                        $sent = 0;  
                        $success =''; 
                        $msg.="You have not yet been  registered "."</br>";
                        }
                    }else{
                        $msg ="Please verify your email or network"."</br>";
                    }   
                    if($sent){
                        $success = 'please check the link we sent to your email and verify your self , thank you!';
                         header('location:include/verification.php');
    
                    }

                 }
                       
      
             
                 
             
      
          }

    
  

    

}

include 'include/header.php'
?>

<body class="container" >

    <div class="col-12 col-sm-9 col-md-6 col-lg-4 mt-3 ">
    <div  class="card shadow "  >
    <div class='card-body' >
        <div class="row">
            <div class="col-12 align-items-center  " >
                <?php if(isset($msg) and $msg!=""): ?>

                    <div class="alert alert-danger">
                        <strong>Errors!</strong></br> <?=$msg?>
                    </div>

                <?php endif;?>
                <?php if(isset($success) and $success!=""): ?>

                    <div class="alert alert-success">
                        <strong>SUCCESS!</strong></br> <?=$success?>
                    </div>

                    <?php endif;?>
                <div class=" card-header mb-3">
                    <h3>Sign Up</h3>
                </div>
                  <form class=" " name="registration" action="registrationform.php" method="post">
                    <div class="span3">
                        <?php
                        $sqlu = "SELECT * FROM fluid_sub_company inner join  fluid_company  on fluid_sub_company.id_company = fluid_company.id where  fluid_company.live = 1";
                        $rst = mysqli_query($connection, $sqlu); ?>

                        <label>Company</label>
                        <select name="subcompany_name" class="form-control" placeholder="company" required>
                            <?php
                            while ($row = mysqli_fetch_array($rst)) {
                                echo '<option value=' . $row['id'] . ' > ' . $row['subcompany_name'] . '</option>';
                            }
                            echo '</select>'; ?>


                            <label>Username</label><br>

                            <input class="form-control" type="text" name="username" required class="span5" value="<?=isset($username)?$username:''?>">
                            <label>Full name</label><br>
                            <input class="form-control" type="text" name="full_name" required class="span5" value="<?=isset($full_name)?$full_name:''?>">
                            <label>Phone number</label><br>
                            <input class="form-control" type="text" name="phone_number" class="span3" value="<?=isset($phone_number)?$phone_number:''?>">
                            <label>Password</label><br>
                            <input class="form-control" type="password" name="password" required class="span3" value="<?=isset($password)?$password:''?>">
                            <label>E-mail</label><br>
                            <input class="form-control" type="text" name="email" required class="span3" value="<?=isset($email)?$email:''?>">

                            <div class="d-flex justify-content-between mt-2">
                            <input type="submit" value="Sign up" class="btn btn-success ">
                            <a class="btn btn-info btn-sm" href="login.php">login</a>
                            
                            </div>
                           

                </form>
               
            </div>
        </div>
    </div>
</div>


    </div>




</body>
</html>

