<?php ob_start();
include('authenticate.php'); ?>
<?php include('connexion.php');
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>


<?php $id_subcompany = $_SESSION['sub_company']; ?>


<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>New booking</h2>
            </div>

            <div class="col-md-12 msg-box" style="display: none">

                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    <span class="msg"></span>
                </div>
            </div>

        </div>
        <!-- /. ROW  -->


        <?php


        if (isset($_POST['plaque'])) {
            // removes backslashes
            //var_dump($_POST);

            $user_id = intval($_SESSION['id']);
            $car_id = stripslashes($_POST['plaque']);
            $start_time = stripslashes($_POST['start_time']);
            $end_time = stripslashes($_POST['end_time']);
            $departure = intval(stripslashes($_POST['departure']));
            //$from = mysqli_real_escape_string($connection,$from);
            $destination = intval(stripslashes($_POST['destination']));
            $status = intval(stripslashes($_POST['status']));
            $departments_id = stripslashes($_POST['name_dep']);
            $description = stripslashes($_POST['description']);
            $rank = 'confirmed';
            $now=date("Y-m-d H:i:s");



            $sql_check = "SELECT id FROM fluid_booking WHERE ((rank='confirmed') AND (car_id=$car_id) AND ((end_time > '$start_time') AND (start_time < '$end_time')))";
            $res_check = mysqli_query($connection, $sql_check);

            $msg="";
            if (mysqli_num_rows($res_check)){
                $msg.="Time taken by an other booking"."</br>";

            }else {


                $strSQL = "INSERT into `fluid_booking` (id_user,car_id,start_time,end_time,id_place0,id_placef,status_id,departments_id,description,rank,created_at) values(" . $user_id . "," . $car_id . ",'" . $start_time . "','" . $end_time . "'," . $departure . "," . $destination . "," . $status . "," . $departments_id . ",'" . $description . "','" . $rank ."','" .$now. "')";
                //var_dump($strSQL);

                $res = mysqli_query($connection, $strSQL);


                $base_url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];


                if ($res) {

                    $id = mysqli_insert_id($connection);

                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $to = "admin email";
                    $subject = 'New booking ';
                    $sql1 = 'SELECT name from fluid_place where id=' . $departure;
                    $res = mysqli_query($connection, $sql1);
                    $row = mysqli_fetch_array($res);
                    $departure = $row['name'];
                    $sql2 = 'SELECT name from fluid_place where id=' . $destination;
                    $res = mysqli_query($connection, $sql2);
                    $row = mysqli_fetch_array($res);
                    $destination = $row['name'];

                    $sql3 = 'SELECT full_name from fluid_user where id=' . $user_id;
                    $res = mysqli_query($connection, $sql3);
                    $row = mysqli_fetch_array($res);
                    $employee = $row['full_name'];


                    echo $message = '
                    <html>
                    <head>
                        <style type="text/css">
                            .button {
                                -webkit-border-radius: 4px;
                                -moz-border-radius: 4px;
                                border-radius: 4px;
                                border: solid 1px #20538D;
                                text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.4);
                                -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
                                -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
                                box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
                                background: #4479BA;
                                color: #FFF;
                                padding: 8px 12px;
                                text-decoration: none;
                                margin-top: 20px;
                            }
                        </style>
                    </head>
                    <body>
                    <h1>Booking information</h1>
                    <table style="width:100%">
                      <tr>
                        <td>Employee</td>
                        <td>' . $employee . '</td>
                      </tr>
                      <tr>
                        <td>Fom</td>
                        <td>' . $departure . '</td>
                      </tr>
                      <tr>
                        <td>To</td>
                        <td>' . $destination . '</td>
                      </tr>
                      <tr>
                        <td>Start time</td>
                        <td>' . $start_time . '</td>
                      </tr>
                      <tr>
                        <td>End time</td>
                        <td>' . $end_time . '</td>
                      </tr>
                      <tr>
                        <td>Comments</td>
                        <td>' . $description . '</td>
                      </tr>
                      <tr>
                        <td><h1></h1></td>
                      </tr>
                    </table>
                    <a class="button" href="http://localhost:8888/test_car/confirm_booking.php?id=' . $id . '">Confirm this booking now</a>
                    
                    <a class="button" href="http://localhost:8888/test_car/permission.php?id=' . $id . '">Go to booking </a>
                    </body>
                    </html>';

                    $res = mail($to, $subject, $message, $headers);

                    header("Location: bookinglist.php");
                }
            }
        }


        ?>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <?php if(isset($msg) and trim($msg)!=''):?>
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <span class="msg"><?=$msg?></span>
            </div>
            <?php endif?>

            <div class="">

                <form id="new-booking" class="form-horizontal" action="booking.php" method="post">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">


                            <label>username</label>

                            <input class="form-control" type="text" name="username" disabled
                                   placeholder="<?php echo $_SESSION['username'] ?>"
                                   required>

                            <?php
                            $standard = 'Available';
                            $sql2 = "SELECT id,id_subcompany,plaque,standard FROM fluid_car where id_subcompany='" . $id_subcompany . "' and standard='Available'";
                            $rs2 = mysqli_query($connection, $sql2); ?>

                            <label>select car</label>
                            <select name="plaque" class="form-control">
                                <?php
                                while ($row = mysqli_fetch_array($rs2)) {
                                    echo '<option value="' . $row['id'].'"' .((isset($car_id) and ($car_id==$row['id']))?'selected':' '). ' >  ' . $row['plaque'] . '</option>
';
                                }
                                echo '</select>';
                                ?>
                                <label>Start time</label>
                                <div class='input-group date' id='datetimepicker1'>
                                    <input name='start_time' type='text' class="form-control" required value="<?=isset($start_time)?$start_time:''?>" />
                                    <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span>
                                </div>
                                <label>End time</label>
                                <div class='input-group date' id='datetimepicker2'>
                                    <input name='end_time' type='text' class="form-control" required value="<?=isset($end_time)?$end_time:''?>" />
                                    <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span>
                                </div>

                                <script type="text/javascript">
                                    $(function () {
                                        $('#datetimepicker1').datetimepicker
                                        (
                                            {
                                                format: "YYYY-MM-DD HH:mm",
                                            }
                                        );

                                        $('#datetimepicker2').datetimepicker
                                        (
                                            {
                                                format: "YYYY-MM-DD HH:mm",
                                                useCurrent: false
                                            }
                                        );

                                        $("#datetimepicker1").on("dp.change", function (e) {
                                            $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
                                        });
                                        $("#datetimepicker2").on("dp.change", function (e) {
                                            $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
                                        });
                                    });
                                </script>


                                <?php
                                $sql = "SELECT fluid_place.id,fluid_place.id_user,fluid_place.name FROM fluid_place 
inner join fluid_user on fluid_place.id_user=fluid_user.id
inner join fluid_sub_company on fluid_user.id_subcompany=fluid_sub_company.id
where id_subcompany='" . $id_subcompany . "'
order by name asc";
                                $rs = mysqli_query($connection, $sql); ?>

                                <div class="select-container">
                                    <label>Departure</label>
                                    <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" data-type="plus" data-target="#addModal"
                      data-toggle="modal">
                <span class="glyphicon glyphicon-plus"></span>
                </button>
</span>
                                    <?php if (isset($_POST['aboutcontract'])) {
                                        // removes backslashes

                                        $id_user = intval($_SESSION['id']);
                                        $name = stripslashes($_POST['departure']);
                                        $id_sector0 = stripslashes($_POST['name']);
                                        $aboutcontract = stripslashes($_POST['aboutcontract']);

                                        //$from = mysqli_real_escape_string($connection,$from);

                                        echo $sql = "INSERT into `fluid_place` (id_user,name,id_sector0,aboutcontract) values (" . $id_user . ",'" . $name . "'," . $id_sector0 . ",'" . $aboutcontract . "')";

                                        $result = mysqli_query($connection, $sql);
                                        //var_dump($result);


                                        if ($result) {
                                            // echo $sql;
                                            header("Location: booking.php");
                                        }
                                    } else {
                                    }
                                    ?>

                                    <select id="departure" class="myselect" name="departure" style="width: 100%"></select>
                                </div>


                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                            <?php
                            $sq = "SELECT*FROM fluid_status";
                            $rslt = mysqli_query($connection, $sq); ?>

                            <label>Status</label>
                            <select name="status" class="form-control">

                                <?php
                                while ($row = mysqli_fetch_array($rslt)) {
                                    echo '<option value="' . $row['id'] .'"'.((isset($status) and ($status==$row['id']))?'selected':' '). '> ' . $row['statusname'] . ' </option>';

                                }
                                echo '</select>';
                                ?>
                                <?php
                                $sqlu = "SELECT * from fluid_departments where id_subcompany='" . $id_subcompany . "'";
                                $rst = mysqli_query($connection, $sqlu);
                                ?>

                                <label>department</label>
                                <select name="name_dep" class="form-control">
                                    <?php
                                    while ($row = mysqli_fetch_array($rst)) {
                                        echo '<option value="' . $row['id'].'"'.((isset($departments_id) and ($departments_id==$row['id']))?'selected':' ') . ' > ' . $row['name_dep'] . '</option>';

                                    }
                                    echo '</select>';
                                    ?>
                                    <label>description</label>
                                    <div class="required-field-block">
    <textarea rows="3" class="form-control" name="description" placeholder=""
              required><?=isset($description)?$description:''?></textarea>
                                        <div class="required-icon">
                                            <div class="text">*</div>
                                        </div>
                                    </div>

                                    <?php

                                    $strSQL = "SELECT fluid_place.id,fluid_place.id_user,fluid_place.name FROM fluid_place 
inner join fluid_user on fluid_place.id_user=fluid_user.id
inner join fluid_sub_company on fluid_user.id_subcompany=fluid_sub_company.id
where id_subcompany='" . $id_subcompany . "'
order by name asc";
                                    $result2 = mysqli_query($connection, $strSQL);

                                    ?>
                                    <div class="select-container">
                                        <label>Destination</label>
                                        <span class="input-group-btn">
    <button type="button" class="btn btn-default btn-number" data-type="plus" data-target="#addModal"
            data-toggle="modal"><span class="glyphicon glyphicon-plus"></span>
    </button>
    </span>


                                        <select id="destination" class="myselect" name="destination" style="width: 100%"></select>

                                    </div>
                                    <?php


                                    ?>
                        </div>
                    </div>

                    <div class="row pad-top">

                        <div class="col-lg-6 col-lg-offset-2">
                            <div class="form-group">
                                <input class="form-control btn btn-primary" type="submit" name="submit" value="Submit">
                            </div>
                        </div>
                    </div>
                </form>


            </div>

        </div>
        <!-- End Register Box -->
    </div>
</div>


<div class="container">

    <div class="row">


        <div class="modal" id="addModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                    class="fa fa-times"></i></button>
                        <h4 class="modal-title">add place</h4>
                    </div>


                    <div class="modal-body">

                        <form action="booking.php" method="post">


                            <div class="form-group">
                                <label class="col-sm-2 control-label">place</label>
                                <input type="text" name="departure" placeholder="Enter place"></div>
                            <div class="form-group">
                                <div class="select-container">
                                    <label class="col-sm-2 control-label" placeholder="sector">sector</label>
                                    <?php

                                    $sq = "SELECT id,name FROM fluid_sector order by name asc";
                                    $rslt = mysqli_query($connection, $sq);
                                    ?>


                                    <select name="name" class="'select2 form-group col-sm-2'">

                                    <?php
                                    while ($row = mysqli_fetch_array($rslt)) {
                                        echo '
     <option value=' . $row['id'] . ' >  ' . $row['name'] . '</option>
        ';
                                    }
                                    echo '</select>';
                                    ?></div>

                                <label class="col-sm-2 control-label">contract</label>
                                <input type="text" name="aboutcontract"></div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary pull-left">Save</button>
                        </form>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" role="button">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
$sql = "SELECT fluid_place.id,name FROM fluid_place INNER JOIN fluid_user ON fluid_place.id_user=fluid_user.id WHERE fluid_user.id_subcompany=" . $_SESSION['sub_company'];
$res = mysqli_query($connection, $sql);
$data = [];
while ($row = mysqli_fetch_array($res)) {
    $data[] = [
        'id' => $row['id'],
        'text' => $row['name'],
    ];
}

$json = json_encode($data);
//var_dump($json);
?>

<script>
    var data = <?= $json?>;

    $(".myselect").select2({
        data: data
    });



    <?php if(isset($departure)):?>
        $("#departure").val(<?=$departure?>).trigger('change');
    <?php endif;?>
    <?php if(isset($destination)):?>
        $("#destination").val(<?=$destination?>).trigger('change');
    <?php endif;?>

    $('.myselect').on('select2:select', function (e) {

        $("#myForm").submit();

    });

    $(document).on('click', 'form button[type=submit]', function(e) {
            var isValid = $(e.target).parents('form').isValid();
            if(!isValid) {
                e.preventDefault(); //prevent the default action
            }
        });

    $( "#new-booking" ).submit(function( event ) {
        //alert( "Handler for .submit() called." );
        var value1=$("#departure").val();
        var value2=$("#destination").val();
        if(value1==value2) {
            //alert
            $(".msg").html("Destination must be different from departure");
            $(".msg-box").show();
            event.preventDefault();
        }
    });
</script>Ftry
           
   