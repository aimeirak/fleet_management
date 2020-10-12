<?php
session_start();
include '../connexion.php';

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


if(isset($_SESSION['id']) && isset($_POST['d']) && $_POST['u'] == 1){

    $id = $_POST['d']; 
    $id_comany =  $_SESSION['sub_company'];
    $stmt = $connection->prepare("SELECT * from fluid_car where id = ? and id_subcompany = ?");
    $stmt->bind_param('ii',$id,$id_comany);
    $stmt->execute();
    $result = $stmt->get_result();
    while($fetchCar = $result->fetch_assoc()){
       echo '
       <div class="card mt-2">
        <div class="card-header" >You are  picking ?</div>
          <div class="card-body" >
             <div class="row">
              <div class="col " >
              <span class="text-info" >marque:</span> '.$fetchCar['marque'].'
               </div>
               <div class="col  " >
                <span class="text-info" >consumption:</span> '.$fetchCar['fuel_consumption'].' km/l 
               </div> 
               </div>
          </div>
          <div class="card-footer" >
               <div class="col p-2 " >
               <span class="text-info" >insurance date:</span> '.$fetchCar['insurance_date']. '
              
               </div>
               <div class="col p-2 " >
               <span class="text-info" >control technique date:</span> '.$fetchCar['control_technique_date']. '
              
               </div>
               </div>
        </div>
      </div>  ';
    }

}
if(isset($_POST['cr']) && isset($_POST['r']) && isset($_POST['d'])&& isset($_POST['u']) && $_POST['u'] == 2){
     if($_POST['r'] == 30){
       $car = $_POST['cr'];
       $driver = $_SESSION['id'];
       $id_comany =  $_SESSION['sub_company'];
       $now  = date('Y-m-d'); 
       $live = 1;
       $id= '';
       $stmt = $connection->prepare("SELECT id,car_id from fluid_driver_logs where driver_id = ? and date(date_log) = ?  and live = ?");
       $stmt->bind_param('isi',$driver,$now,$live);
       $stmt->execute();
       $result = $stmt->get_result();
       if($result->num_rows >= 1){
         $fetchCarId = $result->fetch_assoc();
        $_SESSION['CAR'] = $fetchCarId['car_id'];
        $stmt->close();
       }else{
        $now = date('Y-m-d H:m'); 
        $stmt = $connection->prepare("INSERT INTO fluid_driver_logs VALUES (?,?,?,?,?)");        
        $stmt->bind_param('iisii',$id,$driver,$now,$car,$live);
        $stmt->execute();
        $inserted = $stmt->affected_rows;
        if($inserted){
          $_SESSION['CAR'] = $_POST['d'];
          $stmt->close();
          }else{
            echo ' ';
          }        
      }

    
     }else{
        echo "<span class='text-white-50 btn btn-danger' >  Your are not a driver </span> ";
     }

}

if($_SESSION['role'] == 20 and isset($_POST['lo'])){
  $car = array();
  $id_company =  $_SESSION['sub_company'];
  $sql  =  "SELECT * FROM fluid_car where id_subcompany = ? ";
  $stmt = $connection->prepare($sql);
  $stmt->bind_param('i',$id_company); 
  $stmt->execute();
  $result = $stmt->get_result();
  $i = 0 ;
    while($row = $result->fetch_assoc()){
      $car[$i] = '';  
      $carid = $row['id'];
      $carlocSql = "SELECT * from fluid_endtrack WHERE carId = ? order by id desc limit 1";
      $loc = $connection->prepare($carlocSql); 
      $loc->bind_param('i',$carid);
      $loc->execute();
      $locResult = $loc->get_result();
      $rowLoc = $locResult->fetch_assoc();
      $lat = floatval($rowLoc['la']);
      $lng = floatval($rowLoc['lo']);
      $car[$i] = array(
        'plate' => $row['plaque'],
        'coords' => array('lat'=>$lat,'lng' => $lng ),
        'mrk' => 'assets/img/location3.png'                
      );
      $i++;

    }
   echo json_encode($car); 
}

?>