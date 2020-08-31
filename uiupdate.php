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
  <?php include 'include/topbon.php' ?>    
  
            
            <div id="content" >
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
                              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Cars</div>
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
                      <div class="col-12 mt-3  col-sm-6 col-md-3 " id='DriverProg'>
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Driver progress</div>
                                <div class="row no-gutters align-items-center">
                                                
                                </div>
                                </div>
                                <div class="col-auto">
                                <span class="fas fa-fw fa-chart-area text-info"></span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php   if($_SESSION['userStatus'] =='MASTER' || $_SESSION['userStatus'] =='admin'){ ?> 
                          <div class="col-12 mt-3  col-sm-6 col-md-3 " >
                            <a href="adminstrationBook/adminBook.php" class="card ">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Organization </div>
                                    <div class="row no-gutters align-items-center">
                                                    
                                    </div>
                                    </div>
                                    <div class="col-auto">
                                    <span class="fas fa-fw fa-user text-danger"></span>
                                    </div>
                                  </div>
                                </div>
                              </a>
                            </div>
                          <?php  }?> 

                     <?php   if($_SESSION['userStatus'] =='MASTER' ){ ?> 
                               
                      <div class="col-12 mt-3  col-sm-6 col-md-3 " id='newCompany'>
                        <div class="card border-left-secondary shadow h-100 py-2">
                            <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-gray-900 text-uppercase mb-1">New company</div>
                                <div class="row no-gutters align-items-center">
                                                
                                </div>
                                </div>
                                <div class="col-auto">
                                <span class="fas fa-fw fa-building"></span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> 
                        <div class="col-12 mt-3  col-sm-6 col-md-3 " id='newSub'>
                          <div class="card border-left-info shadow h-100 py-2">
                              <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                  <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">New sub</div>
                                  <div class="row no-gutters align-items-center">
                                                  
                                  </div>
                                  </div>
                                  <div class="col-auto">
                                  <span class="fas fa-fw fa-chart-area"></span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>   
                      
                        <div class="col-12 mt-3  col-sm-6 col-md-3" id='newCaptain'>
                          <div class="card border-left-info shadow h-100 py-2">
                              <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                  <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Adminstration</div>
                                  <div class="row no-gutters align-items-center">
                                                  
                                  </div>
                                  </div>
                                  <div class="col-auto">
                                  <span class="fas fa-fw fa-users"></span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>  
                         
                        
                      <?php } ?> 
                     
                <?php } 
                //driver content ?> 
                
                <?php if($_SESSION['role'] == 30){ ?>
                  <?php if(!isset($_SESSION['CAR'])){?>
                  <div class="col-12 mt-3  col-sm-6 col-md-3 "  id='selectCar' data-toggle='modal' data-target='#carsection' >
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Select car</div>
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
                  <?php } ?>
                    <?php if(isset($_SESSION['CAR'])){?>
                      <div class="col-12 mt-3  col-sm-6 col-md-3 " id='availability'>
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">availability</div>
                            <div class="row no-gutters align-items-center">
                                            
                            </div>
                            </div>
                            <div class="col-auto">
                            <span class="fa fa-flag text-info"></span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  <div class="col-12 mt-3  col-sm-6 col-md-3 " id='dailBook'>
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Bookings</div>
                            <div class="row no-gutters align-items-center">
                                            
                            </div>
                            </div>
                            <div class="col-auto">
                            <span class="fas fa-fw fa-book text-primary"></span>
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
                              <span class="fas fa-fw fa-close text-danger"></span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> 

                      <div class="col-12 mt-3  col-sm-6 col-md-3 " id='confirmedb'>
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Confirmed</div>
                                <div class="row no-gutters align-items-center">
                                                
                                </div>
                                </div>
                                <div class="col-auto">
                                <span class="fas fa-fw  fa-check-square text-success"></span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> 
                    <?php } ?>

                 
                  <?php } ?> 
                  <?php if($_SESSION['role'] == 10 || $_SESSION['role'] == 20){ ?>

                    <div class="col-12 mt-3  col-sm-6 col-md-3 " id='bookRide'>
                    <div class="card border-left-secondary shadow h-100 py-2">
                        <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Booking</div>
                            <div class="row no-gutters align-items-center">
                                            
                            </div>
                            </div>
                            <div class="col-auto">
                            <span class="fa fa-check-square  text-info"></span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> 
                    <div class="col-12 mt-3  col-sm-6 col-md-3 " id='ViewBook'>
                      <div class="card border-left-info shadow h-100 py-2">
                          <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">View Booking</div>
                              <div class="row no-gutters align-items-center">
                                              
                              </div>
                              </div>
                              <div class="col-auto">
                              <span class="fa fa-info  text-info"></span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> 

                  <?php }?>
                </div>
                <!-- end task -->
            <!-- firstResponse -->
              <div class="row" id="dataRetrival">
                <img src="http://preloaders.net/preloaders/290/preview.gif" id="ajax-loader"  />
              </div>
                <!-- end firstResponse -->

            <!-- secondResponse -->
            <div class="row" id="data2Retrival">
              <img src="http://preloaders.net/preloaders/290/preview.gif" id="ajax-loader"  />
              
            </div>
              <!-- end secondResponse -->

                        
                          
                          
                          

                        
                          
                                           </div>
                                      </div>
                          
                                                        
                                 </div>
                              
                            </div>
                          </div>
                          <!--content end-->
                            <footer class="sticky-footer bg-white">
                              <div class="container my-auto">
                                <div class="copyright text-center my-auto">
                                  <span class="text-uppercase"> <?= $_SESSION['blancName'] ?>(<?=$_SESSION['branchLocation']?>)</span>
                                </div>
                              </div>
                            </footer>
                      </div>
                      <!-- end of content wrapper -->             
              </div>
              <!-- end of  wrapper -->  
              <a class="scroll-to-top rounded" href="#page-top" style="display: inline;">
                <i class="fas fa-angle-up"></i>
              </a>
      
  
  

  <div class="modal fade" id="dailTime" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">This time is based on this date <span class="text-info" id="picked-date"></span></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-12"></div>
          <div class="timeslot" id='timeslot'>

          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success" type="button" data-dismiss="modal">Done</button>
           </div>
      </div>
    </div>
  </div>
  <?php //for cars  ?>
 
  <div class="modal fade" id="carsection" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
  <div class="content"  >
  <div class="modal-dialog" role="document" id="modelContent">
     
    </div>
  </div>
  
  </div>
 
 
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