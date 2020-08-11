<?php
include('../connexion.php');
session_start();
if(isset($_POST['strt'])){
 //if we  have active one
 $bookiID = $_POST['dt'];
 $active ='active';
 $driver = $_SESSION['id'];
$stmt = $connection->prepare('SELECT rank from fluid_booking where rank = ? and driver_id = ?');
$stmt->bind_param('si',$active,$driver);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
    echo '<div class="alert alert-danger p-3 m-2 " > complete the current trip </div>' ;
    $stmt->close();
}else{
   $stmt = $connection->prepare("UPDATE fluid_booking SET  rank = ?  where id = ? ");
   $stmt->bind_param('si',$active,$bookiID);
   $stmt->execute();
   if($stmt->affected_rows){
    echo '<div class="alert alert-success p-3 m-2 ml-3 " >it is started </div>' ;
    $stmt->close();
   }else{
    echo '<div class="alert alert-danger p-3 m-2 ml-3" > was not completed </div>' ;
   
   }
}
 //=======================
}
if(isset($_POST['endb'])){
    $active = 'done';
    $bookiID = $_POST['dt'];
 //if this booking was confirmed once  
 $stmt = $connection->prepare("UPDATE fluid_booking SET  rank = ?  where id = ? ");
 $stmt->bind_param('si',$active,$bookiID);
 $stmt->execute();
 if($stmt->affected_rows){
  echo '<div class="alert alert-success p-3 m-2 ml-3 " > The trip is completed </div>' ;
  $stmt->close();
 }else{
  echo '<div class="alert alert-danger p-3 m-2 ml-3" > was not completed </div>' ;
 
 }
//=======================
}

?>