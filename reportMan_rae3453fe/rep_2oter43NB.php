<?php
session_start();
include '../connexion.php';
// if(!isset($_SESSION['username']) && $_SESSION['role'] != 20){
//     $msg = '
//     <div class="container">
//         <div class="card shadow mt-5">
//         <div class=" alert alert-warning text-center m-5"><div class" p-5">access denied.  <a  class="btn btn-info" href="login.php">login</a> please!  </div> </div>
//         </div>
//     </div>
  
//    ';
//     echo '<script> window.open("login.php","_self") </script>';
//     exit($msg);
  
//   }

  function getCarFuelConsuption($plate){
    $car = array();
    $sql  = "SELECT * FROM fluid_car where plaque = ? and id_subcompany = ? ";
    $stmt = $GLOBALS['conn']->prepare($sql);
    $stmt->bind_param('si',$plate,$_SESSION["sub_company"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $fetchCar = $result->fetch_assoc();
    
    $car = array(
      'id' => $fetchCar['id'],
      'fuel' => $fetchCar['fuel_consumption']
    );
    return $car;
    $stmt->close();
  }
  function getKm($allBookings){
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
       $km += $fetchKm['kilometers'];       
       $i++;
     }
    return $km;
    $stmt->close();
}
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
  



  function getAllBooking($from,$until){
    $done = 'done';
    $book = array();
    $sql = "SELECT username as Owner,fluid_booking.id,start_time,end_time,startP.id_sector0 as sectorIdFrom,endP.id_sector0 as sectorIdto ,fluid_booking.rank,  startP.name as nameFrom,fluid_booking.driver_id,
    endP.name as nameTo from fluid_booking
     inner join fluid_place as startP on startP.id = fluid_booking.id_place0 
     inner join fluid_place as endP on endP.id = fluid_booking.id_placef 
     inner join fluid_user on fluid_booking.id_user = fluid_user.id  
     where  date(start_time) between date(?) and date(?)  order by start_time desc";
    $stmt = $GLOBALS['conn']->prepare($sql);
    $stmt->bind_param("ss",$from,$until);
    $stmt->execute();
    $result = $stmt->get_result();
    $i = 0;
    while($fetchBook = $result->fetch_assoc()){
        //km
        $kmCounter[] = array(
        'id'=> $fetchBook['id'],
        'from' => $fetchBook['sectorIdFrom'],
        'to' => $fetchBook['sectorIdto']
          ); 
         //====== 
         //getting car 
         $carLeader[0] = $fetchBook['driver_id'];
         $carLeader[1] = $fetchBook['start_time'];
         $carDriver = getCarAndDriver($carLeader);
         //=========

        $km = getKmEach($kmCounter);

      $book[$i] = array(
        'Owner'=> $fetchBook['Owner'],
        'start_time'=> $fetchBook['start_time'],
        'end_time'=> $fetchBook['end_time'],
        'from' => $fetchBook['sectorIdFrom'],
        'to' => $fetchBook['sectorIdto'],
        'status' => $fetchBook['rank'], 
        'NameFrom' => $fetchBook['nameFrom'], 
        'NameTo' => $fetchBook['nameTo'], 
        'car' => $carDriver['plaque'], 
        'driver' => $carDriver['username'],
        'km' =>  $km,        
        
      );
     $i++;
    }
    return $book;
    $stmt->close();
  };
 
  
  function getCost($km,$carConsuption){
      $live= 1;
      $company = $_SESSION['sub_company'];
      $sql = "SELECT * FROM fuel_cost where id_subcompany = ? and live = ?";
      $stmt = $GLOBALS['conn']->prepare($sql);
      $stmt->bind_param('ii',$company,$live);
      $stmt->execute();
      $result = $stmt->get_result();
      if($result->num_rows > 0){
        $fuelCost = $result->fetch_assoc();
        $costs =  ($km/$carConsuption) * $fuelCost['cost'] ;
        // $costs =  (($km*2)/$carConsuption) * $fuelCost['cost'] ;
      }else{
        $costs =  ($km/$carConsuption) * 960;
      }       
      return round($costs);
      $stmt->close();
  }
  
//==================lastMonth report======================
 if(isset($_POST['rep_2oter']) && ($_SESSION['role'] == 20)){
   $date = new DateTime;
   $clonedDate = clone $date;
   $clonedDate->modify('-1month');
   $dayOne = $clonedDate->format('N') - $clonedDate->format('N') + 1;
  //seting them to dayOne
   $clonedDate->setDate($clonedDate->format('Y'),$clonedDate->format('m'),$dayOne);
   $date->setDate($date->format('Y'),$date->format('m'),$dayOne);
  //======
   $lastMonth = $clonedDate->format('Y-m-d');
   $currentMonth = $date->format('Y-m-d');
  //===infoo=====
   $book = getAllBooking($lastMonth,$currentMonth);
   $km   = getKm($book); 
   $msg  =  '
   
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
    
   <table class="styled-table table table-striped table-bordered table-hover display dataTable no-footer" id="datatable1" >
   <thead>
       <tr>
           <th>Owner</th>
           <th>from</th>
           <th>to</th>
           <th>start time</th>
           <th>end time</th>
           <th>Driver</th>   
           <th>Car</th>     
           <th>km</th>
           <th>status</th>
     
       </tr>
   </thead>
   <tbody>
   ';
 
   foreach($book as $fetchBookB){
       $picker = $fetchBookB['status'];

     $msg.='
      <tr class="'.$picker.'-row">
                        <td>'.$fetchBookB['Owner'].'</td>
                        <td>'.$fetchBookB['NameFrom'].'</td>
                        <td>'.$fetchBookB['NameTo'].'</td>
                        <td>'.$fetchBookB['start_time'].'</td>
                        <td>'.$fetchBookB['end_time'].'</td>
                        <td>'.$fetchBookB['driver'].'</td>
                        <td>'.$fetchBookB['car'].'</td>
                        <td>'.$fetchBookB['km'].'</td>
                        <td>'.$fetchBookB['status'].'</td>
           </tr>
     ';
   }
   $msg .=' </tbody>
   </table>
';
  
echo $msg;
   //======
 }
 //==================daily report======================
 if(isset($_POST['_ngpck_rt453']) && ($_SESSION['role'] == 20)){
     
    $date = new DateTime;
    $clonedDate = clone $date;
    $clonedDate->modify('-1month');
    $dayOne = $clonedDate->format('N') - $clonedDate->format('N') + 1;
   //seting them to dayOne
    $clonedDate->setDate($clonedDate->format('Y'),$clonedDate->format('m'),$dayOne);
    //======
    $lastMonth = $clonedDate->format('Y-m-d');
    $currentMonth = $date->format('Y-m-d');
   //===infoo=====
    $book = getAllBooking($currentMonth,$currentMonth);
    $km   = getKm($book); 
    $msg  =  '
    
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
     
    <table class="styled-table table table-striped table-bordered table-hover display dataTable no-footer" id="datatable1" >
    <thead>
        <tr>
            <th>Owner</th>
            <th>from</th>
            <th>to</th>
            <th>start time</th>
            <th>end time</th>
            <th>Driver</th>   
            <th>Car</th>     
            <th>km</th>
            <th>status</th>
      
        </tr>
    </thead>
    <tbody>
    ';
  
    foreach($book as $fetchBookB){
        $picker = $fetchBookB['status'];
 
      $msg.='
       <tr class="'.$picker.'-row">
                         <td>'.$fetchBookB['Owner'].'</td>
                         <td>'.$fetchBookB['NameFrom'].'</td>
                         <td>'.$fetchBookB['NameTo'].'</td>
                         <td>'.$fetchBookB['start_time'].'</td>
                         <td>'.$fetchBookB['end_time'].'</td>
                         <td>'.$fetchBookB['driver'].'</td>
                         <td>'.$fetchBookB['car'].'</td>
                         <td>'.$fetchBookB['km'].'</td>
                         <td>'.$fetchBookB['status'].'</td>
            </tr>
      ';
    }
    $msg .=' </tbody>
    </table>
 ';
   
 echo $msg;
    //======
  
 }
 //=============end of daily ===================

 //==================daily and tomorrow report======================
 if(isset($_POST['_ngpck12Tv_ki']) && ($_SESSION['role'] == 20)){
     
    $date = new DateTime;
    $clonedDate = clone $date;
    $clonedDate->modify('+1day');
    $dayOne = $clonedDate->format('N') - $clonedDate->format('N') + 1;
    $NextDay = $clonedDate->format('Y-m-d');
    $currentMonth = $date->format('Y-m-d');
   //===infoo=====
    $book = getAllBooking($currentMonth,$NextDay);
    $km   = getKm($book); 
    $msg  =  '
    
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
     
    <table class="styled-table table table-striped table-bordered table-hover display dataTable no-footer" id="datatable1" >
    <thead>
        <tr>
            <th>Owner</th>
            <th>from</th>
            <th>to</th>
            <th>start time</th>
            <th>end time</th>
            <th>Driver</th>   
            <th>Car</th>     
            <th>km</th>
            <th>status</th>
      
        </tr>
    </thead>
    <tbody>
    ';
  
    foreach($book as $fetchBookB){
        $picker = $fetchBookB['status'];
 
      $msg.='
       <tr class="'.$picker.'-row">
                         <td>'.$fetchBookB['Owner'].'</td>
                         <td>'.$fetchBookB['NameFrom'].'</td>
                         <td>'.$fetchBookB['NameTo'].'</td>
                         <td>'.$fetchBookB['start_time'].'</td>
                         <td>'.$fetchBookB['end_time'].'</td>
                         <td>'.$fetchBookB['driver'].'</td>
                         <td>'.$fetchBookB['car'].'</td>
                         <td>'.$fetchBookB['km'].'</td>
                         <td>'.$fetchBookB['status'].'</td>
            </tr>
      ';
    }
    $msg .=' </tbody>
    </table>
 ';
   
 echo $msg;
    //======
  
 }

  //==================modified report======================
  if(isset($_POST['_ngp34cktu67_ki']) && ($_SESSION['role'] == 20)){
    $from = strval($_POST['_ngpcktu67_ki']); 
    $until = strval($_POST['_ngpckt_ki']); 
    $date = new DateTime($from);
    $datUntil = new DateTime($until);
    $reportFrom  = $date->format('Y-m-d');
    $reportUntil = $datUntil->format('Y-m-d');
   //==========infoo==========
    $book = getAllBooking($reportFrom,$reportUntil);
    $km   = getKm($book); 
    $msg  =  '
    
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
     
    <table class="styled-table table table-striped table-bordered table-hover display dataTable no-footer" id="datatable1" >
    <thead>
        <tr>
            <th>Owner</th>
            <th>from</th>
            <th>to</th>
            <th>start time</th>
            <th>end time</th>
            <th>Driver</th>   
            <th>Car</th>     
            <th>km</th>
            <th>status</th>
      
        </tr>
    </thead>
    <tbody>
    ';
  
    foreach($book as $fetchBookB){
        $picker = $fetchBookB['status'];
 
      $msg.='
       <tr class="'.$picker.'-row">
                         <td>'.$fetchBookB['Owner'].'</td>
                         <td>'.$fetchBookB['NameFrom'].'</td>
                         <td>'.$fetchBookB['NameTo'].'</td>
                         <td>'.$fetchBookB['start_time'].'</td>
                         <td>'.$fetchBookB['end_time'].'</td>
                         <td>'.$fetchBookB['driver'].'</td>
                         <td>'.$fetchBookB['car'].'</td>
                         <td>'.$fetchBookB['km'].'</td>
                         <td>'.$fetchBookB['status'].'</td>
            </tr>
      ';
    }
    $msg .=' </tbody>
    </table>
 ';
 
 $email = $_SESSION['email'];
 $username ="urugendo booking report "; 
  include '../include/deplicatSolver/emailSender.php';
    $sender = "ishyigasoftware900@gmail.com";
    $sender_name = "Urugendo booking report ".$reportFrom."  until ". $reportUntil ;
    
    sendEmail($username,$sender,$sender_name,$email,'<!DOCTYPE html>
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
      <title>Report</title>
    </head>
    <body> '.$msg.'  
    </body>
    </html>');
    echo $msg;
   
  
 }
 //==========end of modified  =====
 //=========== Car info ==========
 




function  getAllCar(){
    $company = 3;
    $a = 0 ;
    $car = array();
    $Carsqlction =  "SELECT plaque,id FROM   fluid_car where id_subcompany = ? ";
    $stmt = $GLOBALS['conn']->prepare($Carsqlction);
    $stmt->bind_param('i',$company);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($fetchCar = $result->fetch_assoc()) {
      $car[$a] = array(
        'plaque' => $fetchCar['plaque'] ,
        'id' => $fetchCar['id'] 
      );
      $a++;
    }
    return $car;
    $stmt->close();
  }
 //===========end cars info  ========
 //booking Cars
 
function bookingCars($from ,$until,$id){
    $done = 'done';
    $book = array();
    $i=0; 
    $sql = "SELECT rank,fluid_booking.driver_id,username,plaque,fluid_booking.id as BookId,start_time,startP.name as nameFrom ,endP.name as toName ,startP.id_sector0 as sectorIdFrom,endP.id_sector0 as sectorIdto  FROM fluid_booking
     inner join  fluid_driver_logs on (fluid_driver_logs.driver_id =  fluid_booking.driver_id and date(fluid_booking.start_time) = date(fluid_driver_logs.date_log) )
     inner join fluid_place as startP on startP.id = fluid_booking.id_place0 
     inner join fluid_place as endP on endP.id = fluid_booking.id_placef 
     inner join fluid_user on fluid_booking.id_user = fluid_user.id
     inner join  fluid_car on fluid_car.id = fluid_driver_logs.car_id
     where (date(fluid_booking.start_time) between date(?) and date(?)) and  fluid_car.id = ? and rank = ? ";
    $stmt = $GLOBALS['conn']->prepare($sql);
    $stmt->bind_param("ssis",$from,$until,$id,$done);
    $stmt->execute();
    $result = $stmt->get_result();
    while($fetchBook = $result->fetch_assoc()){
      $carLeader[0] = $fetchBook['driver_id'];
      $carLeader[1] = $fetchBook['start_time'];
      $carDriver = getCarAndDriver($carLeader);
    
      $kmCounter[] = array(
        'id'=> $fetchBook['BookId'],
        'from' => $fetchBook['sectorIdFrom'],
        'to' => $fetchBook['sectorIdto']
          ); 
    
      $km = getKmEach($kmCounter);
     $book[$i] = array(
       'plaque'=>$fetchBook['plaque'],
       'StartFrom'=>$fetchBook['nameFrom'],
       'EndTo'=>$fetchBook['toName'],
       'start_time'=>$fetchBook['start_time'],
       'driver'=> $carDriver['username'],
       'booker'=>$fetchBook['username'],    
       'status'=>$fetchBook['rank'],  
       'km'=>$km
      );
    
     $i++;
    }
    
    return $book;
    $stmt->close();
    }
    
 //======
//=======full detail========
function getFullDetails($from,$until,$cars){  
    echo '
   
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
            <th>Destination </th>                  
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
      
      </tbody>
      </table>
      ';
    }
//=====end full detail ====
 if(isset($_POST['_ngt32mdnkf45_53']) && ($_SESSION['role'] == 20)){
    $date = new DateTime;
    $clonedDate = clone $date;
    $date->modify('-1day');
    $clonedDate->modify('+1day');
    $NextDay = $clonedDate->format('Y-m-d');
    $currentDay = $date->format('Y-m-d');
    $car[] = array(
        'plaque' => $_POST['_ngt32mps5dnkf45_53'] ,
        'id' => $_POST['_ngt32mdnkf45_53'] 
      );
    echo 'from '.$currentDay.' until '. $NextDay.' <br>';
    getFullDetails($currentDay,$NextDay,$car);
}



?>



       
                    
                  

