<?php include('connexion.php');?>

<?php
session_start();
if(!isset($_SESSION["username"])){
}
?>

<?php $id_subcompany = $_SESSION['sub_company']; ?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-6">
                
           
<?php
$car="";

if (isset($_GET['start_date']) and $_GET['start_date'] != '') {
    $start = stripslashes($_POST['start_date']);
    $end = stripslashes($_POST['end_date']);
    //$car="";
   $sql = "SELECT fluid_booking.id_user,fluid_car.plaque,fluid_sub_company.subcompany_name AS `SUB`,SUM(kilometers) AS 'kilometers',SUM((fluid_distance.kilometers/fluid_car.fuel_consumption)*1045)AS `COST` 
FROM fluid_car 
INNER JOIN fluid_booking on fluid_booking.car_id=fluid_car.id 
INNER JOIN fluid_user on fluid_booking.id_user=fluid_user.id 
INNER JOIN fluid_place AS place1 on fluid_booking.id_place0=place1.id 
INNER JOIN fluid_place AS place2 on fluid_booking.id_placef=place2.id 
INNER JOIN fluid_sector AS sector1 ON place1.id_sector0=sector1.id 
INNER JOIN fluid_sector AS sector2 ON place2.id_sector0=sector2.id 
INNER JOIN fluid_distance ON (sector1.id=fluid_distance.id_sector0 AND sector2.id=fluid_distance.id_sectorf) 
INNER JOIN fluid_sub_company ON fluid_car.id_subcompany=fluid_sub_company.id 
WHERE rank='confirmed' or rank='done' AND DATE(start_time) BETWEEN '" . $start . "' AND '" . $end . "'GROUP BY fluid_car.plaque";

                        //echo $sql;


                        echo "Report from " . $start . " to " . $end . "<br>";


                        $result = mysqli_query($connection, $sql);

                        if ($result) {
                            while ($row = mysqli_fetch_array($result)) {
                              
                $car.=$row['plaque'].";".$row['SUB'].";".$row['kilometers'].",".$row['COST'].">>";
                                    
                              
                            }
                        }
                        echo $car;
                    } else {

 $sql2 ="SELECT fluid_car.id as id_car,fluid_car.plaque,fluid_sub_company.subcompany_name AS `SUB`,SUM(kilometers) AS 'kilometers',SUM((fluid_distance.kilometers/fluid_car.fuel_consumption)*1045)AS `COST` FROM fluid_car 
INNER JOIN fluid_booking on fluid_booking.car_id=fluid_car.id 
INNER JOIN fluid_user on fluid_booking.id_user=fluid_user.id 
INNER JOIN fluid_place AS place1 on fluid_booking.id_place0=place1.id 
INNER JOIN fluid_place AS place2 on fluid_booking.id_placef=place2.id 
INNER JOIN fluid_sector AS sector1 ON place1.id_sector0=sector1.id 
INNER JOIN fluid_sector AS sector2 ON place2.id_sector0=sector2.id
INNER JOIN fluid_distance ON (sector1.id=fluid_distance.id_sector0 AND sector2.id=fluid_distance.id_sectorf) 
INNER JOIN fluid_sub_company ON fluid_car.id_subcompany=fluid_sub_company.id WHERE rank IN ('confirmed','done') AND fluid_car.`id_subcompany`=" . $id_subcompany . " GROUP BY fluid_car.id";

        $res = mysqli_query($connection, $sql2);

        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_array($res)) {

       $car.=$row['plaque'].";".$row['SUB'].";".$row['kilometers'].",".$row['COST'].">>";
                    
              
            }
        
        echo $car;
                           
                        } else {
                            echo "0 results";
                        }
                    }

                    ?>
                </div></div></div></div>