<?php ob_start();
include('authenticate.php'); ?>

<?php include('connexion.php'); ?>


<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Please indicate date range the car will be in private</h2>

            </div>
        </div>

        <?php

        if (isset($_POST['submit'])) {

            $id_car = $_GET['id'];
            $from = stripslashes($_POST['from']);
            $to = stripslashes($_POST['to']);
            $status=10;


            $sql = "INSERT INTO fluid_private_usage(id_car,`from`,`to`,`status`) VALUES($id_car,'$from','$to',$status)";
            $result = mysqli_query($connection, $sql);

            if ($result) {
                $msg= "Successfully booked for private usage from $from to $to";
            } else {
                echo "wapi";
            }
        }


        ?>
        <?php if($result):?>
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> <?=$msg?>
                </div>
            </div>
        </div>
        <?php endif?>


        <div class="col-md-8 col-lg-offset-2">

            <div class="row" style="padding:10px">

                <form action="schedule_private_usage.php?id=<?= $_GET['id'] ?>" method="post" class="form-horizontal">

                    <br><label>Plate number</label><br>
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

                    <br>
                    <label>Period</label><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="from">From</label>
                            <input type="text" class="form-control" id="from" name="from" readonly="readonly" style="background: white;cursor: text">
                        </div>
                        <div class="col-md-6">
                            <label for="to">To</label>
                            <input type="text" class="form-control" id="to" name="to" readonly="readonly" style="background: white;cursor: text">
                        </div>
                    </div>


                    <br><a href="carlist.php"><input type="submit" class="btn btn-primary" name="submit" value="update"></a><br>
                </form>


            </div>
        </div>


    </div>
</div>

<script>
    $(function () {
        var dateFormat = "mm/dd/yy",
            from = $("#from")
                .datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 1,
                    minDate: 0
                })
                .on("change", function () {
                    to.datepicker("option", "minDate", getDate(this));
                }),
            to = $("#to").datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1
            })
                .on("change", function () {
                    from.datepicker("option", "maxDate", getDate(this));
                });

        function getDate(element) {
            var date;
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
                date = null;
            }

            return date;
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

