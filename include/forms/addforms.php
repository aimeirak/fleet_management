<?php 
include '../../connexion.php';
if(isset($_POST['addplace'])){
 function deperti(){
    echo '
    


    <div class="col-12 container" >
      <div class="row">
         
              <div class="modal-content">

                  <div class="card-header d-flex justify-content-between bg-primary text-gray-900 p-3">
                      
                      <h4 class="modal-title">add place</h4>
                      <h6 class="modal-title">departure</h6>
                  </div>


                  <div class="card-body">

                      <form action="booking.php" method="post">


                          <div class="form-group">
                              <label class="col-sm-4 col-md-6 col-lg-9 control-label">place</label>
                              <input type="text"class="form-control" name="departure" placeholder="Enter place"></div>
                          <div class="form-group">
                              <div class="select-container">
                                  <label class="col-sm-2 control-label" placeholder="sector">sector</label>
                                ';

                                  $sq = "SELECT id,name FROM fluid_sector order by name asc";
                                  $rslt = mysqli_query($GLOBALS['conn'], $sq);
                               


                                 echo' <select name="name" class="select2 form-control col-sm-4">';

                                
                                  while ($row = mysqli_fetch_array($rslt)) {
                                      echo '
                                          <option value=' . $row['id'] . ' >  ' . $row['name'] . '</option>
      ';
                                  }
                                  echo '</select>
                                 </div>

                              <label class="col-sm-2 control-label">contract</label>
                              <input type="text" class="form-control" name="aboutcontract"></div>

                          <div class="card-footer d-flex justify-content-between ">
                              <button type="submit" name="save" class="btn btn-primary pull-left">Save</button>
                      </form>
                      <a href="booking.php" class="btn btn-danger">Close</a>
                  </div>

              </div>
          </div>
      </div>

';
}
function destination(){
    echo '
    


    <div class="col-12 container" >
      <div class="row">
         
              <div class="modal-content">

                  <div class="card-header d-flex justify-content-between bg-info text-gray-900 p-3">
                      
                      <h4 class="modal-title">add place</h4>
                      <h4 class="modal-title">DESTINATION</h4>
                  </div>


                  <div class="card-body">

                      <form action="booking.php" method="post">


                          <div class="form-group">
                              <label class="col-sm-4 col-md-6 col-lg-9 control-label">place</label>
                              <input type="text"class="form-control" name="departure" placeholder="Enter place"></div>
                          <div class="form-group">
                              <div class="select-container">
                                  <label class="col-sm-2 control-label" placeholder="sector">sector</label>
                                ';

                                  $sq = "SELECT id,name FROM fluid_sector order by name asc";
                                  $rslt = mysqli_query($GLOBALS['conn'], $sq);
                               


                                 echo' <select name="name" class="select2 form-control col-sm-4">';

                                
                                  while ($row = mysqli_fetch_array($rslt)) {
                                      echo '
                                          <option value=' . $row['id'] . ' >  ' . $row['name'] . '</option>
      ';
                                  }
                                  echo '</select>
                                 </div>

                              <label class="col-sm-2 control-label">contract</label>
                              <input type="text" class="form-control" name="aboutcontract"></div>

                          <div class="card-footer d-flex justify-content-between ">
                              <button type="submit" name="save" class="btn btn-primary pull-left">Save</button>
                      </form>
                      <a href="booking.php" class="btn btn-danger">Close</a>
                  </div>

              </div>
          </div>
      </div>

';
}
if(isset($_POST['departure'])){
    deperti();
}
if(isset($_POST['destination'])){
    destination();
}    

}else {
    echo 'add place not set';
}


?>
