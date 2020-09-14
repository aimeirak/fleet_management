<?php 
include '../../connexion.php';
session_start();

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
                    <span id="drop-me-on" class="btn btn-sm btn-secondary col-12" >Save</span>                 
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
                  <h1 class="h4 text-info mb-4">Create new sub company!</h1>
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
function auth(){
  $AD = 20;
  $LIVE = 1 ;
  $sql  ='SELECT username,subcompany_name from fluid_user 
  inner join fluid_sub_company on fluid_sub_company.id = fluid_user.id_subcompany 
  where role = ? and fluid_user.live = ?';
  $stmt =$GLOBALS['conn']->prepare($sql);
  $stmt->bind_param('ii',$AD,$LIVE);
  $stmt->execute();
  $result = $stmt->get_result();
  while($fetchAdmin = $result->fetch_assoc()){
    echo '
  <div class="col-9 mt-3  col-sm-6 col-md-3 " >
   <div class="card  shadow h-100 py-2">
      <div class="card-body">
      <div class="row no-gutters align-items-center">
          <div class="col mr-2">
          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">'.$fetchAdmin['username'].'</div>
          <div class="row no-gutters align-items-center">
                          
          </div>
          </div>
          <div class="col-auto">
          <span class="fas fa-fw fa-user"></span>
          </div>
        </div>
      </div>
    </div>
  </div>  
  ';
  
  }

  
}
if(isset($_SESSION['role']) and $_SESSION['role'] == 30 and $_POST['ACT'] == 're' and isset($_POST['b'])){
  echo '<div class="modal-body" >
         
          
          <div class="col-sm-12">
              Description
              <input type="text" class="form-control " id="reason" placeholder="Reason..">
            </div>
            
       </div>
      <div class="modal-footer">
        <button class="btn btn-danger" type="button" data-dismiss="modal" onClick ="dismiss('.$_POST['b'].')" >reject</button>
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      </div>
  ';
}
if(isset($_SESSION['role']) and $_SESSION['role'] == 30 and $_POST['ACT'] == 'ca' and isset($_POST['b'])){
  echo '<div class="modal-body" >
         
          
          <div class="col-sm-12">
              Description
              <input type="text" class="form-control " id="reason" placeholder="Reason..">
            </div>
            
       </div>
      <div class="modal-footer">
        <button class="btn btn-warning" type="button" data-dismiss="modal" onClick ="procced('.$_POST['b'].')" >procced</button>
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      </div>
  ';
}
if( isset($_POST['formId']) and $_POST['formId'] == 2 and  isset($_POST['new']) and $_SESSION['userStatus'] == 'MASTER'){
    newCump();
}

if( isset($_POST['formId']) and $_POST['formId'] == 1 and  isset($_POST['new']) and $_SESSION['userStatus'] == 'MASTER'){
    newSub();
}
if( isset($_POST['new']) and $_POST['new'] == 'at' and $_POST['aut'] == 1 and $_SESSION['userStatus'] == 'MASTER'){
    auth();
}


?>
