<?php 
session_start();
if(!isset($_SESSION['username'])){
    $msg = '
    <div class="container">
        <div class="card shadow mt-5">
        <div class=" alert alert-warning text-center m-5"><div class" p-5">access denied.  <a  class="btn btn-info" href="login.php">login</a> please!  </div> </div>
        </div>
    </div>
  
   ';
    echo '<script> window.open("login.php","_self") </script>';
    exit($msg);
  
  }
  include 'connexion.php';
  if(isset($_SESSION['role'])){ 
    $now = new DateTime();
    $id = $_SESSION['id'];
  $stmt = $connection->prepare('SELECT last_login from fluid_user where id = ?');
  $stmt->bind_param('i',$id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $lastLogin = new DateTime($row['last_login']);
  // echo ;
  // echo '<br>';
  // echo ;
  if($lastLogin->format('Y m d') < $now->format('Y m d')){
    $msg = '
    <div class="container">
    <div class="card shadow mt-5">
    <div class=" alert alert-warning text-center m-5"><div class" p-5">Please login again </div> </div>
    </div>
    </div>
   ';
    session_destroy();
    exit($msg);
   
  }
  
  }else{
    $msg = '
    <div class="container">
    <div class="card shadow mt-5">
    <div class=" alert alert-warning text-center m-5"><div class" p-5">Please login again </div> </div>
    </div>
    </div>
   ';
   
   exit($msg);
  
   
  }  


?>