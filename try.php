<?php
include 'connexion.php';
// class locator{
//   protected $api = "http://api.ipapi.com/%s?access_key=%s&format=%s";
//   protected $propert = [];
//   protected $token = "6bd65bb4d7d443c8ccf1b18dc398c2d4";


//   public function request($ip){
//    $format = "1";
//    $url  = sprintf($this->api , $ip,$this->token,$format);
//    $data = $this->sendRequest($url); 
//    echo json_decode($data);
//   }


//   protected function sendRequest($url){
//      $curl = curl_init();
     
//      curl_setopt($curl , CURLOPT_URL , $url);
    
//      return curl_exec($curl); 
//     }

   

// }

// // 41.216.127.98
// $locator = new locator();
// $locator->request("41.216.121.98");


// if(!empty($_SERVER['HTTP_CLIENT_IP'])){
//   //ip from share internet
//   $ip = $_SERVER['HTTP_CLIENT_IP'];
//   echo  "<br> clint ip address = ". $ip; 
// }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
//   //ip pass from proxy
//   $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
//   echo "<br> forwards ip address = ". $ip; 
// }else{
//   $ip = $_SERVER['REMOTE_ADDR'];
//   echo  "<br> remote ip address = ". $ip; 
// }
// function getKmEach($allBookings){
//   //  we may add joined booking
//    $km = 0;
//    $i = 0;
//    $sql  = "SELECT * FROM fluid_distance where id_sector0 = ? and id_sectorf = ?";
//    $stmt = $GLOBALS['conn']->prepare($sql);
//    while($i < sizeof($allBookings)){
//      $from = $allBookings[$i]['from'];
//      $to = $allBookings[$i]['to'];
//      $stmt->bind_param('ii',$from,$to);
//      $stmt->execute();
//      $result = $stmt->get_result();
//      $fetchKm = $result->fetch_assoc();
//     // echo $from .' to '. $to .'<br>';
//      $km = $fetchKm['kilometers'];       
//      $i++;
//    }
//   return $km;
//   $stmt->close();
// }
function getKmEach($allBookings){
  //  we may add joined booking
   $km = 0;
   $i = 0;
   $sql  = "SELECT * FROM fluid_distance where id_sector0 = ? and id_sectorf = ?";
   $stmt = $GLOBALS['conn']->prepare($sql);
   while($i < sizeof($allBookings)){
     $from = $allBookings[$i]['from'];
     $to = $allBookings[$i]['to'];
     $stmt->bind_param('ii',$from,$to);
     $stmt->execute();
     $result = $stmt->get_result();
     $fetchKm = $result->fetch_assoc();
    // echo $from .' to '. $to .'<br>';
     $km = $fetchKm['kilometers'];       
     $i++;
   }
  return $km;
  $stmt->close();
}

function getCarAndDriver($Bookings){
  $driverId = $Bookings[0];
  $date = $Bookings[1];

   $sql  = "SELECT plaque, username
              from fluid_driver_logs
              inner Join fluid_car on fluid_car.id = fluid_driver_logs.car_id
              inner join fluid_user on fluid_user.id = fluid_driver_logs.driver_id
              where driver_id = ? and date(fluid_driver_logs.date_log) = date(?) ";
   $stmt = $GLOBALS['conn']->prepare($sql);
   $stmt->bind_param('is',$driverId,$date);
   $stmt->execute();
   $result = $stmt->get_result();
   $fetchBook = $result->fetch_assoc();
   
   return $fetchBook;
   $stmt->close();
}






function getFullDetails($from,$until,$cars){  
echo '
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <style>
  .styled-table {
          border-collapse: collapse;
          margin: 25px 0;
          font-size: 0.9em;
          font-family: sans-serif;
          min-width: 100%;
          box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
     }
  .styled-table thead tr {
  background-color: #009879;
  color: #ffffff;
  text-align: left;
  }
  .styled-table th,
  .styled-table td {
      padding: 12px 15px;
  }
  .styled-table tbody tr {
  border-bottom: 1px solid #dddddd;
  }

  .styled-table tbody tr:nth-of-type(even) {
      background-color: #f3f3f3;
  }

  .styled-table tbody tr:last-of-type {
      border-bottom: 2px solid #009879;
  }
  .styled-table tbody tr.active-row {
      font-weight: bold;
      color: #009879;
  }
  tr.rejected-row{
      font-weight: bold;
      color: #f5220e;
  }
  tr.confirmed-row{
      font-weight: bold;
      color: #53df03;
   }
   tr.done-row{
      font-weight: bold;
      color: #3b6159;
   }
   tr.canceled-row{
       font-weight: bold;
       color: #d6c210;
    }

  </style>
  <title>Cars reports</title>
</head>
<body>
<table class="styled-table table table-striped table-bordered table-hover display dataTable no-footer" id="datatable1" >
<thead>
    <tr>
        <th>Car</th>
        <th>driver</th>
        <th>passenger</th>
        <th>start time</th>
        <th>From </th>
        <th>Destination to</th>                  
        <th>km</th>         
    </tr>
</thead>
<tbody>
  ';
    $i = 0;
    while($i < sizeof($cars)){
    $carId = $cars[$i]['id'];
    $bd = bookingCars($from,$until,$carId);
    $b = 0;  
    
      while($b < sizeof($bd)){
         echo  '
         <tr class="active-row">
              <td>'.$bd[$b]['plaque'].'</td> 
              <td>'.$bd[$b]['driver'].'</td> 
              <td>'.$bd[$b]['booker'].'</td> 
              <td>'.$bd[$b]['start_time'].'</td> 
              <td>'.$bd[$b]['StartFrom'].'</td> 
              <td>'.$bd[$b]['EndTo'].'</td> 
              <td>'.$bd[$b]['km'].'</td> 
            
         </tr>
         ';

        $b++;
      } 
      
    $i++;
  }
  echo '
  </body>
  </html>
  ';
}






