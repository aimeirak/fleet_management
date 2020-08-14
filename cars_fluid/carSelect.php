<?php
session_start();
include '../connexion.php';

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

?>