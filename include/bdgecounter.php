<?php
session_start();
$id_subcompany =$_SESSION['sub_company'] ;
$id_user = $_SESSION['id'] ;
include '../connexion.php';
$STRsql = "SELECT fluid_booking.id as booking_id,fluid_car.id as car_id,fluid_car.plaque,start_time,end_time,username,a.name AS 'departure',b.name AS 'destination' ,rank 
FROM `fluid_booking` inner join fluid_user on fluid_user.id=fluid_booking.id_user 
JOIN fluid_place AS a ON fluid_booking.id_place0=a.id JOIN fluid_place AS b ON fluid_booking.id_placef=b.id 
inner join fluid_car on fluid_booking.car_id=fluid_car.id 
WHERE rank IN ('confirmed','ongoing','done')   AND fluid_car.id_driver=" . $id_user . "
ORDER BY end_time DESC
";

$result2 = mysqli_query($connection, $STRsql);

$badge = mysqli_num_rows($result2);
echo $badge;
?>