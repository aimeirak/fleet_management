<?php 
session_start();
ob_start();
include 'include/header.php' ; ?>
<?php include('connexion.php');
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>


<title><?= $_SESSION['blancName'] ?>(<?=$_SESSION['branchLocation']?>)</title>
</head>  
<body id="page-top"  >
<div id="wrapper">
    <!--sidbar start -->
<?php include 'include/navbar.php'; ?>


<!--sidbar end-->
<div id='content-wrapper' class="d-flex flex-column">
<?php
require_once('include/topbon.php');
?>
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Please update car</h2>

            </div>
        </div>

        <?php

        if (isset($_POST['submit'])) {

            $id_subcompany = $_SESSION['sub_company'];
            $plaque = stripslashes($_POST['plaque']);
            $marque = stripslashes($_POST['marque']);
            $insurance_date = stripslashes($_POST['insurance_date']);
            $control_technique_date = stripslashes($_POST['control_technique']);
            $fuel_consumption = stripslashes($_POST['fuel_consumption']);
            $id_driver = stripslashes($_POST['driver']);

            $seats = stripslashes($_POST['seats']);



            $sql = "UPDATE fluid_car SET marque='" . $marque . "', insurance_date='" . $insurance_date . "', control_technique_date='" . $control_technique_date  . "',fuel_consumption='" . $fuel_consumption. "',id_driver=" . $id_driver . ",seats='" . $seats . "' WHERE
                    `id_subcompany`=" . $id_subcompany . " and `plaque`='" . $plaque . "'";
            $result = mysqli_query($connection, $sql);

            if ($result > 0) {
                header("location:carlist.php");
            } else {
                echo "Error updating record: " . mysqli_error($connection);

            }
        }

        ?>
        <div class="col-md-8 col-lg-offset-2">

            <div class="row" style="padding:10px">

                <form action="updatecarlist.php" method="post" class="form-horizontal">

                    <br><label>PLAQUE</label><br>
                    <?php

                    $plaque = '';

                    $sql = "SELECT * FROM fluid_car where id=" . $_GET['id'];
                    if ($result = mysqli_query($connection, $sql)) {
                        // Fetch one and one row

                        if ($row = mysqli_fetch_array($result)) {
                            $plaque = $row['plaque'];
                            //var_dump($row);
                        }
                    }


                    ?>

                    <input type="text" class="form-control" name="plaque" value="<?= $row['plaque']?>">

                    <label>Model</label>
                    <input type="text" class="form-control" name="marque" value="<?= $row['marque']?>">
                    <label>Insurance</label><br><input type="text" name="insurance_date" class="form-control" value="<?= $row['insurance_date']?>" required>
                    <label>Control technique</label>
                    <input type="text" name="control_technique" class="form-control" value="<?= $row['control_technique_date']?>" required>

                    <label>Fuel consumption</label>
                    <input class="form-control" type="text" name="fuel_consumption" placeholder="km/l" value="<?= $row['fuel_consumption']?>" >
                    <?php
                        $sqlu1 = "SELECT * from fluid_user where role='30'";
                        $rst1 = mysqli_query($connection, $sqlu1); 
                        ?>

                        <label>driver</label>
                        <select name="driver" class="form-control">
                        <?php
                        while ($row = mysqli_fetch_array($rst1)) {
                            echo '
                        <option value=' . $row['id'] . ' > ' . $row['username'] . '</option>';

                        }
                        echo '</select>';
                        ?>

                    <label>Seats</label>
                    <input class="form-control" type="text" name="seats"  value="<?= $row['seats']?>" >

                    <br><a href="carlist.php"><input class="btn btn-primary"type="submit" name="submit" value="update"></a><br>
            </div>
        </div>
        </form>


    </div>
</div>
<div class="col-md-8 col-lg-offset-2">
    <div class="row" style="padding:10px">
        <div class="container">

            <div class="row">


                <div class="modal" id="addModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                            class="fa fa-times"></i></button>
                                <h4 class="modal-title">where is it?</h4>
                            </div>


                            <div class="modal-body">


                                <form action="updatecarlist.php" method="post">


                                    <label class="col-sm-2 control-label">car</label>
                                    <input type="text" name="id_car" class="form-control"
                                           placeholder="<?php echo $id = $_GET['id']; ?>">

                                    <label class="col-sm-2 control-label">departure_time</label>
                                    <input type="text" name="departure_time" class="form-control"
                                           placeholder="2018-01-11">

                                    <label class="col-sm-2 control-label">assumed_arrival_time</label>
                                    <input type="text" name="assumed_arrival_time" class="form-control"
                                           placeholder="2018-01-11">
                                    <label class="col-sm-2 control-label">reason</label>
                                    <input type="text" name="reason" class="form-control" placeholder="why?">
                                    <label>status</label>
                                    <select id="cmbMake" name="status" class="form-control">
                                        <option value="still_repaired">still_repaired</option>
                                        <option value="done">done</option>
                                        <option value="already-active">already-active</option>

                                    </select>


                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary pull-left">Save</button>
                                </form>
                                <button type="button" class="btn btn-primary" data-dismiss="modal" role="button">Close
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php //mysqli_close($connection);?>

<?php include('footer.php'); ?>

