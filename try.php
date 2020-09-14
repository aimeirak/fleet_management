<?php
include 'connexion.php';

$car = array();
  $id_company =  3;
  $sql  =  "SELECT * FROM fluid_car where id_subcompany = ? ";
  $stmt = $connection->prepare($sql);
  $stmt->bind_param('i',$id_company); 
  $stmt->execute();
  $result = $stmt->get_result();
  $i = 0 ;
  if($result->num_rows > 0 ){
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
  }else{
    $car[$i] = array(
        'plate' => 0,
        'long' => 0,
        'lat' => 0
      );
  }
    
  echo json_encode ($car); 

?>