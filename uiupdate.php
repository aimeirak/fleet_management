<?php 
session_start();
include 'include/header.php' ;
include 'connexion.php';
if( isset($_SESSION['sub_company'] ) ){ ?>


<style>
    #returnB{
    cursor: pointer;
    border-color: skyblue;
    }
    #task div{
    cursor: pointer;
    border: skyblue;
}

  </style>
  <title><?= $_SESSION['blancName'] ?>(<?=$_SESSION['branchLocation']?>)</title>
</head>   
<body id="page-top" >
<!-- navigation  -->

 <div id="wrapper">
   <!--sidbar start -->
  <?php include 'include/navbar.php' ?>
  <!--sidbar end-->

  <!--content-->
  <div id='content-wrapper' class="d-flex flex-column">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow align-items-center d-flex justify-content-between"   >
            <div class="logo">
              
              <a class="navbar-brand" href="#">
                  <img src="assets/img/logo.png" style="width:160px; border-radius: 3px;"/>
              </a></div>
          

                
            <div class="profile-place">
            <ul>  
              <li class="nav-item dropdown no-arrow">
                 <!-- avatar -->
                 <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-sm-inline text-gray-600 small"><?= $_SESSION['username'] ?></span>
                  <img class="img-profile rounded-circle" src="uploads/default/maleavatar.png">
               
                </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                      <span class="dropdown-item" id="profile1">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-700"></i>
                        Profile
                      </span>
                      <a class="dropdown-item" href="#">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-700"></i>
                        Settings
                      </a>
                      <a class="dropdown-item" href="#">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-700"></i>
                        Activity Log
                      </a>
                      <div class="dropdown-divider"></div>
                      <form action='logout.php' method="post"> 
                      <button type="submit" name="logout" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-700"></i>
                        Logout
                      </button>
                    </form>
                      
                     
                    </div>
                  </li>
                </ul>
                </div>
            
          </nav>
            
            
            <div class="row m-2 mb-5">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="card p-3 ">
                      <div class="p-2 align-items-center d-flex justify-content-between">
                          <div class='text-gray-700' >SHORTCUTS</div>  <div id="returnB" class="btn btn-secondary" >CLEAR</div>
                      </div>

                    <div id="page-ground">
            <!--  task -->
                <div class="row" id="task">
              <?php  if($_SESSION['role'] == 20){?>
                
                 
                  <div class="col-12 mt-3  col-sm-6 col-md-3 " id='carList'>
                      <div class="card border-left-success shadow h-100 py-2">
                          <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Cars</div>
                              <div class="row no-gutters align-items-center">
                                              
                              </div>
                              </div>
                              <div class="col-auto">
                              <span class="fa fa-car"></span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>          
                     
                <?php } ?> 
                <!-- driver content -->
                <?php if($_SESSION['role'] == 30){ ?>

                  <div class="col-12 mt-3  col-sm-6 col-md-3 " id='availability'>
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">availability</div>
                            <div class="row no-gutters align-items-center">
                                            
                            </div>
                            </div>
                            <div class="col-auto">
                            <span class="fa fa-car text-success"></span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  <div class="col-12 mt-3  col-sm-6 col-md-3 " id='dailBook'>
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Booking</div>
                            <div class="row no-gutters align-items-center">
                                            
                            </div>
                            </div>
                            <div class="col-auto">
                            <span class="fa fa-calendar text-info"></span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> 
                    <div class="col-12 mt-3  col-sm-6 col-md-3 " id='rejected'>
                      <div class="card border-left-danger shadow h-100 py-2">
                          <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Rejected</div>
                              <div class="row no-gutters align-items-center">
                                              
                              </div>
                              </div>
                              <div class="col-auto">
                              <span class="fa fa-table text-danger"></span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> 
                   
                  <?php } ?> 
                </div>
                <!-- end task -->
            <!-- firstResponse -->
              <div class="row" id="dataRetrival">
              </div>
                <!-- end firstResponse -->

            <!-- secondResponse -->
            <div class="row" id="data2Retrival">
            </div>
              <!-- end secondResponse -->

                        
                          
                          
                          

                        
                          
                                           </div>
                                      </div>
                          
                                                        
                                 </div>
                              
                            </div>
                      </div>
                                      
              </div>
              <!-- end of content wrapper -->              
      
  <!--content end-->


<?php include 'include/footerui.php' ?>

<?php
}
else{
  $msg = '
  <div class="container">
  <div class="card shadow mt-5">
  <div class=" alert alert-warning text-center m-5"><div class" p-5">access denied please! <a  class="btn btn-info" href="login.php">login</a>  </div> </div>
  </div>
  </div>
 ';
  echo '<script> window.open("login.php") </script>';
  exit($msg);
}
?>