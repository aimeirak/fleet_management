<?php
include('../connexion.php');

function wrongData($msg){
    echo '<div class="alert alert-danger" > '.$msg.' </div>';
}
function warning($msg){
    echo '<div class="alert alert-warning" > '.$msg.' </div>';
}
function success($msg){
    echo '<div class="alert alert-success" > '.$msg.' </div>';
}

function validateUser($userName,$password){
   
    if($userName == ''){
        wrongData('please enter your username');
    }
    elseif($password == ''){
        wrongData('please enter your password'); 
    }
    elseif($userName == '' && $password == ''){
        wrongData('your password and username field is empty');
    }
   else{
       $sql  = "SELECT * FROM  fluid_user WHERE username = ? ";
       if($stmt = $GLOBALS['conn']->prepare($sql)){
            $stmt->bind_param('s',$userName);
            $stmt->execute();
            $result = $stmt->get_result();
            $rowReturned = $result->num_rows;
          
            //if user found
            if($rowReturned == 1 ){                
                $fetchUser = $result->fetch_assoc();
                //=========================userinfo from db=====
                $usernameR  = $fetchUser['username']; 
                $passwordR  = $fetchUser['password']; 
               
                //==hashed password
                $haPassword = md5($password);
                $passwordMatch = $passwordR == $haPassword;
                if($passwordMatch){
                    $live = 1;
                    $allDataQuery = "SELECT *  FROM fluid_user  where username = ? and password = ?  and verfied = ? ";
                   if($stmt = $GLOBALS['conn']->prepare($allDataQuery)){

                    $stmt->bind_param('ssi',$usernameR,$passwordR,$live);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $NotDismisedVerfied = $result->num_rows;
                    $fetchUser = $result->fetch_assoc();
                    if($fetchUser['verfied'] !== 1  || $fetchUser['verfied'] == 0){
                        warning('please verify your email. we  sent you a link on email you gave us ');
                        
                        }else{
                            if($fetchUser['live'] !== 1 ){
                                warning('please wait for adminstrator authorization ');
                                
                            }else{
                                //if a lebour is not dismised and  verified
                    if($NotDismisedVerfied && $NotDismisedVerfied == 1  ){
                        //fetch user sbcompany
                        $userId = $fetchUser['id'];
                        $notO = 0;
                        $subComp  = " SELECT fluid_user.username,fluid_sub_company.subcompany_name,fluid_company.location as 'head_location' ,fluid_sub_company.location,fluid_sub_company.id as sub_comp_id from fluid_user inner join fluid_sub_company on 
                        fluid_user.id_subcompany = fluid_sub_company.id inner join fluid_company on fluid_sub_company.id_company = fluid_company.id where fluid_user.id = ? and  fluid_user.id_subcompany != ? ";
                        if($stmt  = $GLOBALS['conn']->prepare($subComp)){
                            $stmt->bind_param('ii',$userId,$notO);  
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $rows   = $result->num_rows;
                            if($rows == 1){
                                session_start(); 
                                $fetchCompany = $result->fetch_assoc(); 
                                //===initilizing session===     
                                //user sessions 
                                $_SESSION['id']         = $fetchUser['id']; 
                                $_SESSION['userStatus'] = $fetchUser['status']; 
                                $_SESSION['role']       = $fetchUser['role']; 
                                $_SESSION['username']   = $fetchUser['username']; 
                                $_SESSION['email']      = $fetchUser['email']; 
                                $_SESSION['role']      = $fetchUser['role']; 
                                //user compony and subcamp sessions  
                                  
                                $_SESSION['blancName']  = $fetchCompany['subcompany_name']; 
                                
                                                  
                         
                                if($_SESSION['username'] && $_SESSION['blancName']){
                                    $setLogInStatusQuery = "UPDATE fluid_user set  last_login = NOW() where id = ?  ";
                                    $stmt = $GLOBALS['conn']->prepare($setLogInStatusQuery);
                                    $stmt->bind_param('i',$fetchUser['id']); 
                                    $stmt->execute();
                                    $loggedin = $stmt->affected_rows;                                  
                                    
                                    if($loggedin){

                                        $_SESSION['branchLocation'] = $fetchCompany['location']; 
                                        $_SESSION['sub_company'] = $fetchCompany['sub_comp_id'];  
                                         
                                    
                                        success('you are now  logged in! please wait a sec');
                                        $stmt->close();
                                          }else{
                                        wrongData('you are not logged in please try again');
                                    }


                                  }
                           //===========================     

                            }
                            //if user does not yet been assinged for anysubcompony
                            else{
                                warning('You are not assigned for any work');                               
                            }                         

                        }else{
                          
                        }
 
                                             
                    }else{                        
                        warning('You need to wait the approval  from administrator');
                    }

                            }
                   
                        }

                    

                   } else{                    
                     wrongData('it is not prepared');
                } 
                }
                else{
                  
                    wrongData('wrong password');
                }
            }else{
            
             wrongData('Unknown user ');
            
            }
        }
        else{
            wrongData('it is not prepared');
        }
      
        
   }

} 


//=================================================================

//========= if the submit button is  clicked ==========

if(isset($_POST['run']) && $_POST['run'] == 1){
     $username = $_POST['userName'];
     $password = $_POST['passWord'];
     validateUser($username,$password);


      }
?>



