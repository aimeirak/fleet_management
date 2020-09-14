<?php 
session_start();
include 'include/header.php' ;
include 'connexion.php';
if( isset($_SESSION['sub_company'] ) && $_SESSION['role'] == 20 ){ ?>



  <title><?= $_SESSION['blancName'] ?>(<?=$_SESSION['branchLocation']?>)</title>
  <style>
    #returnB{
    cursor: pointer;
    border-color: skyblue;
      }
    #task div{
    cursor: pointer;
    border: skyblue;
       }
       #map{
            height: 400px;
            width: 100%;
        }

  </style>
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
                          <div class='text-gray-700' >Car last end location </div>  
                      </div>

                    <div id="page-ground">
            <!--  task -->
                <div class="row" id="task">
              <?php  if($_SESSION['role'] == 20){?>               
                
                
                   
                    
                                                <div class="col-12   " >
                                                    <div class="card shadow-lg">
                                                        <div class="card-header">Car location</div>
                                                        <div class="card-body">
                                                        <div id="map" class="map" >

                                                        </div>
                                                        </div>
                                                    </div>
                                                    </div>

                                            
                                            <?php } ?> 
                                            
                                            </div>
                <!-- end task -->
 
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
 
 

  <script>
    

   
     
      function initMap(){
          var options = {
              center:{lat:-1.9500446,lng:30.0806844},
              zoom:10,            
              
          }
          var map = new google.maps.Map(document.getElementById('map'),options);
          
          //marker
    
     
  
      
      function addMarker(pro){
        if(pro.coords.lat == null || pro.coords.lat == null){
               console.log('null not suppoted');
            }else{
                if(pro.mrk === ''){
             
             var marker = new google.maps.Marker({
               position:pro.coords,
               map:map             
               })
            } else{
             var marker = new google.maps.Marker({
               position:pro.coords,
               map:map, 
               icon:pro.mrk            
               })
            }
             }
     } 
    
     $.ajax({
            url:'cars_fluid/carSelect.php',
            method:'POST',
            data:{
                lo:1
            },
            dataType:'json',
            success:(data)=>{
          
                data.forEach(element => {
                    addMarker(element)
                });
               
            }
         });
      }
  </script>  
    <script async defer   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRiVjwISDDplgQBwzof2LINNR-6pP7V2c&callback=initMap"> </script>
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