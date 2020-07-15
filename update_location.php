<?php ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>
<?php //ob_start();
include('authenticate.php'); ?>

<?php include('connexion.php'); ?>
<?php //include('header.php');?>


<?php
$id=$_POST['pk'];
$value=$_POST['value'];

if ($_POST['value']) {

    echo $sql = "
            UPDATE fluid_car_location 
            SET id_place=" . $value . "
            WHERE id=" . $id . "
            ";
    $result = mysqli_query($connection, $sql);


    if ($result > 0) {

        $sql2 = "SELECT id_place FROM fluid_car_location WHERE id=$id";
        $result2 = mysqli_query($connection, $sql2);
        $location = mysqli_fetch_array($res)['id_place'];


        return $location;
    }
}
?>
