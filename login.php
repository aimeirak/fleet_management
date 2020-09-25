<?php //Start the Session
// ob_start();
// error_reporting(E_ALL);
// ini_set('display_errors','On');

session_start();
if(isset($_SESSION['username']) ){
 header('Location:uiupdate.php');
 exit();
}


include('include/header.php'); 
?>
<title>Ishyiga fleet </title>
</head>
<body class="container">
<div class="col-12  align-items-center ">
<center><div class="col-12 col-sm-9 col-md-6 col-lg-4  ">
<form class="form-signin card shadow mt-5" method="POST">

<div class="card-header mb-3">
       <h2 class="form-signin-heading text-center">Login</h2>
        <p  class="text-info" id="response" >             
            </p>
  </div>
   <div class="card-body">
        <div class="input-group mb-3 mt-4">
            <label for="inputUsername" class="sr-only">Username</label>        
                <input type="text" name="username" class="form-control" id='username' placeholder="Username" required>
            </div>

            <div class="input-group mb-3 ">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
            </div>    
     </div> 
        <div class="card-footer p-3">
        <button type="submit" class="btn btn-md btn-info btn-block" id="allow_me_bone" ><span class="d-bock" id="log-content" >Login</span> <span class="d-none" id="progress" ><img src="assets/bootstrap3-editable/img/loading.gif" alt="" srcset=""></span></button>
        <a href="change.php"><p>Forgot your password?</p>
           <a class="btn btn-md btn-primary space-between" href="registrationform.php">Register</a>
           <a class="btn btn-md btn-primary space-between" href="include/verification.php">verify email</a>
        </div>

</form></div>
</center>
</div>

<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/leon/fruid_back_bone.js"></script>
</body>
</html>


