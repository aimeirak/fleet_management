<?php ob_start();
include('authenticate.php'); ?>

<?php include('connexion.php'); ?>


<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Please update car status</h2>

            </div>
        </div>

        <?php

        if (isset($_POST['submit'])) {

            $id_car = $_GET['id'];
            $departure_time = stripslashes($_POST['departure_time']);
            $assumed_arrival_time = stripslashes($_POST['assumed_arrival_time']);
            $reason = stripslashes($_POST['reason']);
            $status = stripslashes($_POST['status']);
            $standard = stripslashes($_POST['standard']);

            $sql="UPDATE fluid_car SET standard='".$standard."' WHERE id=".$id_car;
            $result = mysqli_query($connection, $sql);

            if($result) {
                if ($standard == "mechanical issue") {
                    $sql1 = "INSERT into fluid_unavailable_car(id_car,departure_time,assumed_arrival_time,reason,status) values ($id_car,'$departure_time','$assumed_arrival_time','$reason','$status')";
                    $result1 = mysqli_query($connection, $sql1);
                } else {
                    echo $sql1 = "UPDATE fluid_unavailable_car SET is_active=FALSE WHERE id=".$id_car;
                    $result1 = mysqli_query($connection, $sql1);
                }
            }
            if ($result1 > 0) {
                header('Location: ' . "carlist.php");
            } else {
                echo "wapi";
            }
        }


        ?>


        <div class="col-md-8 col-lg-offset-2">

            <div class="row" style="padding:10px">

                <form action="update_car_status.php?id=<?= $_GET['id'] ?>" method="post" class="form-horizontal">

                    <br><label>PLAQUE</label><br>
                    <?php
                    $plaque = '';
                    $sql = "SELECT plaque FROM fluid_car where id=" . $_GET['id'];
                    if ($result = mysqli_query($connection, $sql)) {
                        while ($row = mysqli_fetch_row($result)) {
                            $plaque = $row[0];
                        }
                    }
                    ?>

                    <input type="text" class="form-control" name="plaque" value="<?= $plaque ?>">
                    <label>standard</label>


                    <select id="cmbMake" name="standard" class="form-control">
                        <option value="Control Technique">Control-Technique</option>
                        <option value="mechanical issue">mechanical-issue</option>
                        <option value="poor docs">poor-docs</option>
                        <option value="available">Available</option>
                    </select>

                    <div id="more-info" style="display: none">
                        <label class="control-label">Entering time</label>
                        <input type="text" name="departure_time" class="form-control"
                               placeholder="2018-01-11">

                        <label class="control-label">Expected return time</label>
                        <input type="text" name="assumed_arrival_time" class="form-control"
                               placeholder="2018-01-11">
                        <label class="control-label">Reason</label>
                        <input type="text" name="reason" class="form-control" placeholder="why?">
                        <label>status</label>
                        <select id="cmbMake" name="status" class="form-control">
                            <option value="still_repaired">In garage</option>
                            <option value="done">Done</option>
                            <option value="already-active">Already active</option>

                        </select>
                    </div>
                    <br><a href="carlist.php"><input type="submit" class="btn btn-primary" name="submit" value="update"></a><br>
                </form>


            </div>
        </div>


    </div>
</div>

<script>
    $("#cmbMake").change(function () {
        if ($(this).val() == 'mechanical issue') {
            //alert($(this).val());
            $('#more-info').show();
        }
        else {
            //alert($(this).val());
            $('#more-info').hide();
        }
    });
</script>

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

