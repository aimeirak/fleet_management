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
    echo '<script> window.open("login.php") </script>';
    exit($msg);
  
  }


?>