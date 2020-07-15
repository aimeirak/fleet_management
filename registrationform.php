<?php
ob_start();
include 'include/emailSender.php';
include('connexion.php');
error_reporting(E_ALL);
ini_set('display_errors', 'On');

?>


<?php
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
              $query_check_username ="SELECT * FROM fluid_user ";
              $stmt = $connection->prepare($query_check_username);
              $stmt->execute();
              $result = $stmt->get_result();
              $status = 0;
              while($fetcUser = $result->fetch_assoc()){
                  $usernameTaken = $fetcUser['username'] == $username;
                  $emailTaken    = $fetcUser['email'] == $email;
                  $fullNameExist = $fetcUser['full_name'] == $full_name;
                  if($usernameTaken){
                      $msg.="Username already taken "."</br>";
                     
                  }
                  
                 elseif($emailTaken){
                      $msg.="Email already exist "."</br>";
                    
                  } 
      
                 elseif($fullNameExist){
                     $msg.="please change your full name already exist "."</br>";
                    
                 } else{
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
                    $contents = ''.$varKey.'  copy and past in you verfication in put';
                    $isSent = sendEmail($subject,$sender,$sender_name,$to,$contents);
                    //will be changed manuel 
                   
                    $sent = 0;
                    $id_subcompany = '';
                    if($isSent){
                        $query  = "INSERT into fluid_user(id,id_subcompany,username,full_name,phone_number,password,passreset,email,vercod)  values (?,?,?,?,?,?,?,?,?)";
            
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

    
  

    

}

include 'include/header.php'
?>

<body class="container" >
<div class="col-12  ">
    <div class="col-12 col-sm-6 m-md-5 ">
    <div  class="card shadow ml-5 mt-5 mr-4"  >
    <div class='card-body' >
        <div class="row">
            <div class="col-12 " >
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
                <form class="form " name="registration" action="registrationform.php" method="post">
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

                            
                            <input type="submit" value="Sign up" class="btn btn-primary pull-right"><br>
                            <br><a class="btn btn-success pull-right" href="login.php">login</a>

                </form>
            </div>
        </div>
    </div>
</div>


    </div>

</div>


</body>
</html>

