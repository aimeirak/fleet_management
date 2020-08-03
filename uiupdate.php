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
                  <?php if($_SESSION['role'] == 10){ ?>

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
                            <span class="fa fa-calendar text-info"></span>
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
  <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">See you soon</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" to proceed </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

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
  <?php
$sql = "SELECT fluid_place.id,name FROM fluid_place INNER JOIN fluid_user ON fluid_place.id_user=fluid_user.id WHERE fluid_user.id_subcompany=" . $_SESSION['sub_company'];
$res = mysqli_query($connection, $sql);
$data = [];
while ($row = mysqli_fetch_array($res)) {
    $data[] = [
        'id' => $row['id'],
        'text' => $row['name'],
    ];
}

$json = json_encode($data);
//var_dump($json);
?>
 
 <div class="card shadow  mt-4">
      
    
      <div class="row">
         <div class="col-lg-12 text-center" >
             &copy; algorithm inc.
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