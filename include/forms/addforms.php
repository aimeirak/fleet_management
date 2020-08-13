<?php 
include '../../connexion.php';
session_start();
function newCump(){
    echo '
    <div class="card o-hidden border-0 shadow-lg my-5 col-12">
    <div class="card-body p-0">
       
      <div class="row">
        <div class="col-lg-5 d-none d-lg-block ">
          <i class="fa fa-building text-center text-secondary text-gray-300 " style="font-size:500px;width:100%;height:100%" ></i>
        </div>
        <div class="col-lg-7">
          <div class="p-5">
          <div id="ms"></div>
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Create new company!</h1>
            </div>
            <form class="user">
              <div class="form-group row">
                <div class="col-sm-12 mb-3 mb-sm-2">
                  <input type="text" class="form-control form-control-user" id="companyName" placeholder="Company name">
                </div>
                <div class="col-sm-12">
                  <input type="number" class="form-control form-control-user" id="tinNumber" placeholder="Tin number">
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="location" placeholder="Location(sector)">
              </div>
              <div class="form-group">
                <input type="email" class="form-control form-control-user" id="compEmail" placeholder="Email Address">
              </div>
              <div class="form-group row">
              <div class="col-12">
                    <span id="drop-me-on" class="btn btn-sm btn-info col-12" >Save</span>                 
              </div>              
               
              </div>
          
             
            </form>
            <hr>
            
          
          </div>
        </div>
      </div>
    </div>
  </div>
    ';
}
function newSub(){
    
        echo '
        <div class="card o-hidden border-0 shadow-lg my-5 col-12">
        <div class="card-body p-0">
           
          <div class="row">
            <div class="col-lg-5 d-none d-lg-block ">
              <i class="fa fa-home text-center text-secondary text-gray-300  " style="font-size:400px;width:100%;height:100%" ></i>
            </div>
            <div class="col-lg-7">
              <div class="p-5">
              <div id="ms"></div>
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Create new sub company!</h1>
                </div>
                <form class="user">
                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-2">
                      <input type="text" class="form-control " id="subcompanyName" placeholder="sub_Company name">
                    </div>
                    <div class="col-sm-12 mb-3 mb-sm-2">
                    
                      <select class="form-control " id="company" >
                      <option value="" >Select company</option>
                    
                      ';
                  $stmt = $GLOBALS['conn']->prepare('SELECT company_name,id from fluid_company') ;  
                  $stmt->execute();
                  $result = $stmt->get_result();
                  while($fetcCompany = $result->fetch_assoc()){
                      echo '<option value="'.$fetcCompany['id'].'">'.$fetcCompany['company_name'].'</option>';
                  }                       
                  echo  '
                  </select>
                   </div>
                    <div class="col-sm-12">
                      <input type="number" class="form-control " id="tinNumber" placeholder="Tin number">
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control " id="location" placeholder="Location(sector)">
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control " id="compEmail" placeholder="Email Address">
                  </div>
                  <div class="form-group row">
                  <div class="col-12">
                        <span id="drop-me-on" class="btn btn-sm btn-info col-12" >Save</span>                 
                  </div>              
                   
                  </div>
              
                 
                </form>
                <hr>
                
              
              </div>
            </div>
          </div>
        </div>
      </div>
        ';
}
if( isset($_POST['formId']) and $_POST['formId'] == 2 and  isset($_POST['new']) and $_SESSION['userStatus'] == 'MASTER'){
    newCump();
}

if( isset($_POST['formId']) and $_POST['formId'] == 1 and  isset($_POST['new']) and $_SESSION['userStatus'] == 'MASTER'){
    newSub();
}


?>
