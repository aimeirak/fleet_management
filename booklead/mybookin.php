<?php
session_start();
include('../connexion.php');

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

$id_subcompany = $_SESSION['sub_company'];
$SESSION_ID = $_SESSION['id'];
if(isset($_POST['mybookin'])){ ?>

<div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Your booking </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                    <thead>
                    <tr>
                       
                      
                        <th>Start time</th>
                        <th>End time</th>
                        <th>User</th>
                        <th>Depature</th>
                        <th>Destination</th>
                        <th>status</th>
                        <th>Departments</th>
                        <th>Rank</th>
                      

                    </tr>
                    </thead>
                    <tbody>

 <?php
  $sql = "SELECT fluid_booking.id,created_at,start_time,end_time,username,a.name AS 'departure',b.name AS 'destination',statusname,name_dep,rank ,fluid_booking.id_user FROM `fluid_booking` 
  inner join fluid_user on fluid_user.id=fluid_booking.id_user 
  JOIN fluid_place AS a ON fluid_booking.id_place0=a.id
  JOIN fluid_place AS b ON fluid_booking.id_placef=b.id 
  inner join fluid_status on fluid_status.id=fluid_booking.status_id 
  inner join fluid_departments on fluid_departments.id=fluid_booking.Departments_id where fluid_user.id_subcompany=".$id_subcompany." AND fluid_booking.id_user = $SESSION_ID  order by fluid_booking.id desc limit 10";
  
  
  $rS = mysqli_query($connection, $sql);
  //var_dump($rS);
  //die();
  $re =' ';
  if (mysqli_num_rows($rS) != '' || mysqli_num_rows($rS) > 0) {

      while ($row = mysqli_fetch_array($rS)) {
          if($row["rank"] == 'rejected'){
              $re = 'class="bg-warning text text-gray-900"';
          }
          elseif($row["rank"] == 'done'){
                $re = 'class="bg-secondary  text-white"';
            }
          elseif($row["rank"] == 'confirmed'){
                $re = 'class="bg-success text  text-gray-800"';
            }
            else{
                $re = '';
            }
         

          $d1 = new DateTime($row['start_time']);
          $d2 = new DateTime();
          echo(
              '<tr '.$re.'>'.
         
                  '<td>'.$row["start_time"].'</td>'.
                  '<td>'.$row["end_time"].'</td>'.
                  '<td>'.$row["username"].'</td>'. 
                  '<td>'.$row["departure"].'</td>'.
                  '<td>'.$row["destination"].'</td>'.
                  '<td>'.$row["statusname"].'</td>'.
                  '<td>'.$row["name_dep"].'</td>'.
                  '<td>'.$row["rank"].'</td>'
          
        ) ; 
      }

  } else {
      echo "0 results";
  }



?>
 
                </tbody>
             </table>
             </div>
             </div>
            </div>
            </div>


<?php

}


?>