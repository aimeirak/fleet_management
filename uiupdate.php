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
  
<ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="uiupdate.php">
  <div class="sidebar-brand-icon rotate-n-15">
    <img src="assets/img/icon.png" alt="" srcset="">
  </div>
  <div class="sidebar-brand-text mx-3"><?= $_SESSION['blancName'] ?><sup>2</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="uiupdate.php">
    <i class="fas fa-fw fa-forward"></i>
    <span>SHORTCUT</span></a>
</li>

<hr class="sidebar-divider">


<div class="sidebar-heading">
  Modification
</div>

<li class="nav-item">
  <a class="nav-link" href="#" id="Profile" >
    <i class="fas fa-fw fa-user"></i>
    <span>Profile</span></a>
</li>
<?php  if($_SESSION['role'] == 20){ ?>
  <li class="nav-item">
  <a class="nav-link" href="#" >
    <i class="fas fa-fw fa-users"></i>
    <span>Users</span></a>
</li>

<?php } ?>

<!-- Divider -->
<hr class="sidebar-divider">
<?php  if($_SESSION['role'] === 30 ){ ?>
<div class="sidebar-heading">
  Cars
</div>
  <li class="nav-item" style='cursor:pointer'>
  <a class="nav-link" id="LocateCars">
    <i class="fa fa-location-arrow "></i>
    <span> Car location</span></a>
</li>
<li class="nav-item">
  <a class="nav-link" href="#">
    <i class="fa fa-car "></i>
    <span> My Car </span></a>
</li>

<li class="nav-item">
  <a class="nav-link" href="#">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span> KMS count </span></a>
</li>


<?php } ?>

<?php  if($_SESSION['role'] == 10 || $_SESSION['role'] == 20 ){ ?>

  
 <!-- Heading -->
<div class="sidebar-heading">
  Bookings
</div>

<?php if($_SESSION['role'] == 20 ){  ?>
<!-- Nav Item - Bookings -->

<li class="nav-item">
  <a class="nav-link" href="#" id="AllBookings">
    <i class="fas fa-fw fa-table"></i>
    <span>Bookings</span></a>
</li>
<?php } ?>

<li class="nav-item">
  <a class="nav-link" href="#" id="bookRide">
    <i class="fas fa-fw fa-calendar"></i>
    <span>Book</span></a>
</li>


<!-- end of book -->

<hr class="sidebar-divider d-md-block">

<div class="sidebar-heading">
  place & routs
</div>


<!-- Nav Item - company  -->
<li class="nav-item mb-2">
  <a class="nav-link" href="#" id="OurRouts" >
    <i class="fas fa-fw fa-road " ></i>
    <span>Routs</span></a>
</li>

<!-- Nav Item - report -->
<li class="nav-item">
  <a class="nav-link" href="#" id="avaible">
    <i class="fa fa-location-arrow "></i>
    <span>Place </span></a>
</li>
<hr class="sidebar-divider  d-md-block">
<?php if($_SESSION['role'] != 10){ ?>



<div class="sidebar-heading">
  Campany
</div>


<!-- Nav Item - company  -->
<li class="nav-item mb-2">
  <a class="nav-link" href="#">
    <i class="fa fa-building "></i>
    <span>Company</span></a>
</li>

<!-- Nav Item - report -->

<li class="nav-item">
  <a class="nav-link" href="#">
    <i class="fas fa-fw fa-check-square "></i>
    <span>Approave <sup class=" badge badge-danger " >1</sup></span></a>
</li>
<?php } ?>
<hr class="sidebar-divider d-md-block">

<div class="sidebar-heading">
  Cars<?php if($_SESSION['role'] != 10){ ?> & report <?php } ?>
</div>

<!-- Nav Item - report -->
<?php if($_SESSION['role'] != 10){ ?>
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRepo" aria-expanded="true" aria-controls="collapsePages">
    <i class="fas fa-fw fa-database"></i>
    <span>Report</span>
  </a>
  <div id="collapseRepo" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">General</h6>
      <a class="collapse-item" href="#">General report</a>
      <a class="collapse-item" href="#">General report(employees)</a>
      
      <div class="collapse-divider"></div>
      <h6 class="collapse-header">Report</h6>
      
      <a class="collapse-item" href="#">Daily Report </a>
      <a class="collapse-item" href="#">Company Report <sup class="badge badge-danger badge-counter">3</sup><sup></a>
      
    </div>
  </div>
</li>
<?php } ?>
<!-- Nav Item - cars -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
    <i class="fas fa-fw fa-car"></i>
    <span>Cars</span>
  </a>
  <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <?php if($_SESSION['role'] != 10){ ?>
        <h6 class="collapse-header">Cars info:</h6>
        <a class="collapse-item" href="#" id="OurCars">Car list</a>
        <a class="collapse-item" href="#" id="LocateCars" >Car location</a>
        <a class="collapse-item" href="#">Drivers </a>
       
        <div class="collapse-divider"></div>

     <?php } ?>
     <?php if($_SESSION['role'] != 20){ ?>
      <h6 class="collapse-header">Cars info:</h6>
      <a class="collapse-item" href="#" id="OurCars">Car list</a>
      <a class="collapse-item" href="#" id="Drivers" >Drivers </a>

      <?php } ?>
      <h6 class="collapse-header">Car ploblems:</h6>
      <a class="collapse-item" href="#" id="Unavailable" >Unavailable cars <sup class="badge badge-danger badge-counter">3</sup><sup></a>
      
    </div>
  </div>
</li>

<!-- Nav Item - report -->

<?php if($_SESSION['role'] != 10){ ?>
<li class="nav-item">
  <a class="nav-link" href="#">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Fuel management</span></a>
</li>

<?php } ?>


<?php } ?>



<hr class="sidebar-divider mt-2 d-none d-md-block">


</ul>
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
                          <div class='text-gray-700' >SHORTCUTS</div>  <div id="returnB" class="btn btn-secondary" >RETURN</div>
                      </div>
                    <div id="page-ground">
              <?php  if($_SESSION['role'] != 30){?>
                
                <div class="row" id="task">
                  <div class="col-6 mt-3  col-sm-12 col-md-3 " id='bookRide1'>
                      <div class="card border-left-danger shadow h-100 py-2">
                          <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-info text-uppercase mb-1"> Book ride</div>
                              <div class="row no-gutters align-items-center">
                                              
                              </div>
                              </div>
                              <div class="col-auto">
                              <span class="fa fa-plus"></span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      

                      <div class="col-6 mt-3  col-sm-12 col-md-3 " id="task">
                        <div class="card border-left-primary shadow h-100 py-2" id='OurCars1'>
                            <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Our cars</div>
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
                        <div class="col-6 mt-3  col-sm-12 col-md-3 " id="task" >
                          <div class="card border-left-info shadow h-100 py-2" id='OurRouts1'>
                              <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                  <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Our routs</div>
                                  <div class="row no-gutters align-items-center">
                                                  
                                  </div>
                                  </div>
                                  <div class="col-auto">
                                  <span class="fa fa-road"></span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div><br>
                          <?php if($_SESSION['role'] == 20 ){ ?>

                          <div class="col-6 mt-3  col-sm-12 col-md-3 " id="task">
                            <div class="card border-left-success shadow h-100 py-2" id="AllBookings1">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1"> All Bookings</div>
                                    <div class="row no-gutters align-items-center">
                                                    
                                    </div>
                                    </div>
                                    <div class="col-auto">
                                    <span class="fa fa-user"></span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <?php } ?>
                            
                          <div class="col-6 mt-3  col-sm-12 col-md-3 " id="task">
                            <div class="card border-left-info shadow h-100 py-2" id="MyBookings1">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1"> My Bookings</div>
                                    <div class="row no-gutters align-items-center">
                                                    
                                    </div>
                                    </div>
                                    <div class="col-auto">
                                    <span class="fa fa-file"></span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <?php if($_SESSION['role'] == 20 ){ ?>

                              <div class="col-6 mt-3  col-sm-12 col-md-3 " id="task">
                                <div class="card border-left-warning shadow h-100 py-2" id="NewPlace">
                                    <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">New place</div>
                                        <div class="row no-gutters align-items-center">
                                                        
                                        </div>
                                        </div>
                                        <div class="col-auto">
                                        <span class="fa fa-plus"></span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>



                        <?php    }  ?>

                           

                              <div class="col-6 mt-3  col-sm-12 col-md-3 " id="task">
                                <div class="card border-left-secondary shadow h-100 py-2" id="LocateCars1">
                                    <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Locate cars</div>
                                        <div class="row no-gutters align-items-center">
                                                        
                                        </div>
                                        </div>
                                        <div class="col-auto">
                                        <span class="fa fa-location-arrow"></span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
  

                                <div class="col-6 mt-3  col-sm-12 col-md-3 " id="task" > 
                                  <div class="card border-left-warning shadow h-100 py-2" id="avaible1">
                                      <div class="card-body">
                                      <div class="row no-gutters align-items-center">
                                          <div class="col mr-2">
                                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Our place</div>
                                          <div class="row no-gutters align-items-center">
                                                          
                                          </div>
                                          </div>
                                          <div class="col-auto">
                                          <span class="fa fa-chair"></span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                        
                <?php } else{?> 

                  <div class="col-12 mt-3  col-sm-12 col-md-6 " id="task">
                    <div class="card border-left-danger shadow h-100 py-2" id="booked">
                        <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Daily Booked </div>
                            <div class="row no-gutters align-items-center">
                                            
                            </div>
                            </div>
                            <div class="col-auto">
                            <span class="badge badge-counter badge-danger">3</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  

                                <div class="col-12 mt-3  col-sm-12 col-md-6 " id="task">
                                  <div class="card border-left-warning shadow h-100 py-2" id="carstate">
                                      <div class="card-body">
                                      <div class="row no-gutters align-items-center">
                                          <div class="col mr-2">
                                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Car state</div>
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

                                 

                              </div>
                  
                  
                  <?php } ?>
                  
                  

                        
                          
                          
                          

                        
                          
                          </div>
                      </div>
                          
                                                        
                              </div>
                              <div class="col-12 text-center">
                              <center>  <div class="col-6 col-sm-6 col-md-8 ">
                                   <a href="logout.php" class="btn btn-success  btn-block mt-5" role="button"><span class="glyphicon glyphicon-"></span> Sign out</a>
                                  </div></center>
                              </div>
                              </div>
                      </div>
                      <footer class="sticky-footer bg-white mt-5">
                        <div class="container my-auto">
                          <div class="copyright text-center my-auto">
                            <span>Copyright © AlGORITHIM .inc 2020</span>
                          </div>
                        </div>
                      </footer>
                
              </div>
              <!-- end of content wrapper -->              
     </div>   
          

   

  </div>
  
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