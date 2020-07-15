<?php ob_start();
error_reporting(E_ALL);
ini_set('display_errors','On');
?>
<?php //ob_start();
include('authenticate.php'); ?>

<?php include('connexion.php'); ?>
<?php //include('header.php');?>

<div id="page-wrapper">
    <div id="page-inner">
        <h2>Location</h2>
        <div class="row" style="padding:10px;">

            <?php
            $id_subcompany = $_SESSION['sub_company'];
            $id_user = $_SESSION['id'];


            $location = $_GET['location'];
            $car = $_GET['car'];
            $booking = $_GET['booking'];
            $action = $_GET['action'];

            if ($_POST['location']) {

                //var_dump($_POST['location']);


                $sql = "
            UPDATE fluid_car_location 
            SET address='" . $location . "'
            WHERE car_id=" . $car . "
        ";
                $result = mysqli_query($connection, $sql);


                if ($result > 0) {



                    if ($action == "start") {
                        $sql1 = "
            UPDATE fluid_booking 
            SET rank='" . 'ongoing' . "'
            WHERE id=" . $booking . "
        ";
                    } elseif ($action == "stop") {
                        $sql1 = "
            UPDATE fluid_booking 
            SET rank='" . 'done' . "'
            WHERE id=" . $booking . "
        ";
                    }
                    $result1 = mysqli_query($connection, $sql1);
                    if ($result1 > 0) {
                        header('Location: ' . "driver_index.php?update_location");
                    }
                }
            }
            ?>


            <form method="post">

                <div class="form-group">
                    <label for="exampleFormControlInput1">Car</label>
                    <input class="form-control" id="exampleFormControlInput1" name="car" value="<?= $car ?>"
                           placeholder="Car plate" required>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Location</label>
                    <textarea class="form-control" name="location" rows="3" required><?= $location ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save car location</button>
            </form>
        </div>
    </div>
</div>