<?php 
  $msg = '';
  $success = '';
  $read = '';
  $already = ''; 
  if(isset($_POST['verify']) ){
    if(isset($_POST['verKey']) && $_POST['verKey'] !== '' && !empty($_POST['verKey'])  ){
        include '../connexion.php';
        $verKey = $_POST['verKey'];
        $m      = $_POST['email'];
        $sql  = 'SELECT live,email,verfied FROM fluid_user where vercod = ? and email =?';
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('ss',$verKey,$m);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $fetchUser = $result->fetch_assoc();
        $row     = $result->num_rows;  
        $isVerfied = $fetchUser['verfied']; 
      if($isVerfied){
        $success .= 'you have been already verfied! login'; 
        $already = 1; 

      }else{          
        if($row){        
            $emailVerify = $m == $fetchUser['email'];
            if($emailVerify){
                $ver = 1;
                $verify ='UPDATE fluid_user set verfied = ? where email = ? and vercod = ?' ;
                $stmt   = $connection->prepare($verify);
                $stmt->bind_param('iss',$ver,$m,$verKey);
                $stmt->execute();
                $affected = $stmt->affected_rows;  
                if($affected){                    
                    $success .= 'you\'re now verified. wait for  administration authorize you thank you !';  
                    $read = 1;

                }else{
                    $msg = 'Techinical ploblem try again or contuct us ec(500k)!';
                }      
                                              
               
                
            }else{
                $msg = 'your email is not valid';
            }
    
        }else{
            $msg = 'you verification code is not valid';
        }
      }  
       
    
    }
    else{
        $msg = 'Your verification code in not valid or is empty';
    
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   

     <!-- Custom styles for this template-->
     <link rel="shortcut icon" href="../assets/img/icon.png" />
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    </head>
<body class = "container">
<div id="page-wrapper">
    <div id="page-inner" class="container">
        <div class="row">
            <div class="col-md-6 offset-md-6 center" >
              <div class="card shadow p-3 mt-5">
               <div class="card-header">
               <h2>Verification</h2>
               
               </div>
               
                <?php if(isset($msg) and $msg!=""): ?>

                    <div class="alert alert-danger mt-2">
                        <strong>Errors!</strong></br> <?=$msg?>
                    </div>

                <?php endif;?>
                <?php if(isset($success) and $success!=""): ?>

                    <div class="alert alert-success mt-2">
                        <strong>SUCCESS!</strong></br> <?=$success?>
                    </div>

                    <?php endif;?>
                
                <form class="form" name="registration" action="verification.php" method="post">
                    <div class="card-body" >
                       
                            <br><label>E-mail</label><br>
                            <input class="form-control" type="email" name="email" required class="span3" value="<?=isset($email)?$email:''?>"> 
                            <br><label>Verfication code</label><br>
                            <input class="form-control" type="text" name="verKey" required class="span3" value="<?=isset($_GET['verKey'])?$_GET['verKey']:''?>">
                            </div>  
                            <div class="card-footer justify-content-space-bettwen">
                              <button type="submit" class="btn btn-primary" name='verify'>verify</button> 
                            </div>
                                
                                              
                </form>
               
                </div>
            </div>
        </div>
    </div>
</div> 


<?php 
if($already || $read){ ?>

  <script>
      setInterval(() => {
            window.open('../login.php');
        }, 2000);
  </script>

<?php } ?>

<?php
include 'footer.php';

