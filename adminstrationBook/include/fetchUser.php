<?php 

include 'connexion.php';
$select = 'SELECT id,username,role,status,live from fluid_user order by username asc';
$stmt = $connection->prepare($select);
$stmt->execute();
$result = $stmt->get_result();
$output = array();
while($row = $result->fetch_assoc()){
  if($row['role'] == 20 and $row['status'] == 'MASTER'){
    $row['role'] = 'MASTER';
  }else if($row['role'] == 20 and $row['status'] != 'MASTER'){
    $row['role'] = 'ADMIN';
  }else if( $row['role'] == 10){
    $row['role'] = 'LEBOUR';    
  }else{
    $row['role'] = 'DRIVER'; 
  }

  if($row['live'] == 1){
    $row['live'] = 'Entertained'; 
  }else{
    $row['live'] = 'Dismissed'; 
  }
  
  $output[] = $row; 
}
echo json_encode($output);