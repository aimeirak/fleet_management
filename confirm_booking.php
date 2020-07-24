<?php
include('connexion.php');

$id=$_GET['id'];

$sql="UPDATE fluid_booking SET rank = 'confirmed' WHERE id =$id";
if (mysqli_query($connection,$sql)) {
    echo 'Booking #'.$id.' Confirmed';


    $sql1 = "SELECT fluid_booking.id,fluid_booking.rank,fluid_user.id,fluid_booking.id_user,fluid_user.email FROM fluid_booking inner join fluid_user on fluid_booking.id_user=fluid_user.id WHERE fluid_booking.id ='$id'";
    $result = mysqli_query($connection, $sql1);
    $row = mysqli_fetch_array($result);
    $email = $row["email"];
    $rank = $row["rank"];
    if (mysqli_num_rows($result) > 0) {
        $to = $row["email"];
        $subject = "About your booking #".$id;
        $message = "your booking has been " . $rank . "";
        mail($to, $subject, $message);
    }
}


