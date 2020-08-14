<?php
session_start();
ob_start();
include 'include/header.php' ; ?>

<?php include('connexion.php');
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>

<?php
$id_subcompany = $_SESSION['sub_company'];
if ($_SESSION['role'] != 20) {
    header("location: uiupdate.php");
}
?>


<script language="javascript">
    function printDiv() {

        var divToPrint = document.getElementById('div-to-print');
        var newWin = window.open('', 'Print-Window');
        newWin.document.open();
        newWin.document.write('<html><body onload="window.print()">' + divToPrint.outerHTML + '</body></html>');
        newWin.document.close();
        setTimeout(function () {
            newWin.close();
        }, 10);

    }
</script>

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
            <div class="col-md-12 p-5">
                <h2>Report</h2>
              <?php if(!isset($_POST['start_date']) || !isset($_POST['end_date'])){ ?>  
                <div class="alert alert-warning" role="alert">
                    <span class="fa fa-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">warning:</span>
                    <span class="msg">First modify or choose date to send any report otherwise will not be sent </span>
                </div>
                
              <?php } ?>
           
           
                <?php   if(isset($_GET['msg']) and trim($_GET['msg'])!=''):?>
            <div class="alert alert-danger" role="alert">
                <span class="fa fa-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <span class="msg"><?=$msg?></span>
            </div>
            <?php endif?>
            <?php if(isset($_GET['success']) and trim($_GET['success']) !=''):
                $success=$_GET['success'];
                ?>
           
                <div class="alert alert-success" role="alert">
                <span class="fa fa-exclamation-sign" aria-hidden="true"></span>
                
                <span class="msg"><?=$success?></span>
            </div>
            <?php endif?>


                <form action="report.php" method="post">
                    <div class="row">
                        <div class="form-group col-md-5">
                            <div class='input-group date' id='datetimepicker1'>
                                <input name='start_date' type='text' class="form-control"/>
                                <span class="input-group-addon btn btn-info">
                                <span class="fa fa-calendar"></span>
                            </span>
                            </div>
                        </div>
                        <div class="form-group col-md-5">
                            <div class='input-group date' id='datetimepicker2'>
                                <input name='end_date' type='text' class="form-control"/>
                                <span class="input-group-addon btn btn-primary">
                                <span class="fa fa-calendar"></span>
                            </span>
                            </div>
                        </div>
                        <div class='form-group col-md-2'>
                            <button type="submit" class="btn btn-outline-secondary pull-right ">Go</button>
                        </div>
                    </div>
                </form>

                <script type="text/javascript">
                    $(function () {
                        $('#datetimepicker1').datetimepicker
                        (
                            {
                                format: "YYYY-MM-DD",
                            }
                        );

                        $('#datetimepicker2').datetimepicker
                        (
                            {
                                format: "YYYY-MM-DD",
                            }
                        );
                    });
                </script>
            </div>
        </div>

        <div class="row" style="padding:10px;">
            <div id="div-to-print p-5">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover display" id="printable" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>user</th>
                            <th>Start Time</th>
                            <th>Description</th>
                            <th>Rank</th>
                            <th>kilometers</th>
                            <th>Persons</th>
                            <th>Cost</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <body>
                        <?php
                        if (isset($_POST['start_date']) and $_POST['start_date'] != '') {
                            // removes backslashes
                            //var_dump($_POST);
                            $start = stripslashes($_POST['start_date']);
                            $end = stripslashes($_POST['end_date']);

                            //var_dump($end);

                            //$date = stripslashes($_POST['date']);
                             $sql = "SELECT fluid_booking.id as booking_id,fluid_booking.id_user,fluid_user.id,fluid_user.username,fluid_booking.car_id,fluid_booking.start_time,description,rank,place1.name,place2.name,sector1.name,sector2.name,IF(kilometers>0, kilometers, 10) as kilometers,(IF(kilometers>0, kilometers, 10)/fluid_car.fuel_consumption)*1055 AS `COST`
                        FROM fluid_booking
                        LEFT JOIN fluid_user ON fluid_booking.id_user=fluid_user.id
                        LEFT JOIN fluid_car ON fluid_booking.car_id=fluid_car.id
                        LEFT JOIN fluid_sub_company ON fluid_car.id_subcompany=fluid_sub_company.id
                        LEFT JOIN fluid_place AS place1 on fluid_booking.id_place0=place1.id
                        LEFT JOIN fluid_place AS place2 on fluid_booking.id_placef=place2.id
                        LEFT JOIN fluid_sector AS sector1 ON place1.id_sector0=sector1.id
                        LEFT JOIN fluid_sector AS sector2 ON place2.id_sector0=sector2.id
                        LEFT JOIN fluid_distance ON (sector1.id=fluid_distance.id_sector0 AND  sector2.id=fluid_distance.id_sectorf)
                        WHERE rank IN('done','confirmed') and  fluid_car.id_subcompany='" . $id_subcompany . "' AND DATE(start_time) BETWEEN '" . $start . "' AND '" . $end . "' ORDER BY DATE(start_time) ASC";

                            echo "Bookings from " . $start . " to " . $end . "<br>";

                            $result = mysqli_query($connection, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    $booking_id=intval($row["booking_id"]);
                                    $sql = "SELECT username,full_name,description,a.name AS 'departure',b.name AS 'destination' FROM `fluid_booking_row` inner join fluid_user on fluid_user.id=fluid_booking_row.id_user JOIN fluid_place AS a ON fluid_booking_row.id_place0=a.id JOIN fluid_place AS b ON fluid_booking_row.id_placef=b.id  WHERE fluid_booking_row.id_booking=" . $booking_id;

                                    $res1 = mysqli_query($connection, $sql);
                                    $joints=mysqli_num_rows ( $res1);
                                    echo(
                                            '<tr>' .
                                                '<td>' . $row["booking_id"] . '</td>' .
                                                '<td>' . $row["username"] . '</td>' .
                                                '<td>' . $row["start_time"] . '</td>' .
                                                '<td>' . $row["description"] . '</td>' .
                                                '<td>' . $row["rank"] . '</td>' .
                                                '<td>' . $row["kilometers"] . '</td>'.
                                                '<td>' . ($joints+1)  . '</td>'.
                                                '<td>' . $row["COST"]. '</td>'.
                                                '<td>' . '<a target="_blank" href="booking_view.php?id='.$row["booking_id"].'" class="btn btn-primary">Details</a>' . '</td>'.

                                            '</tr>'
                                    );
                                }
                            } else {
                                echo "0 results";
                            }
                            
                       

                             $strsql = "SELECT SUM(IF(kilometers>0, kilometers, 10)) AS `TOTAL`,SUM(IF(fluid_distance.kilometers>0, fluid_distance.kilometers, 10)/fluid_car.fuel_consumption)*1055 AS `TOTAL_COST`
                                FROM fluid_booking
                                LEFT JOIN fluid_user ON fluid_booking.id_user=fluid_user.id
                                LEFT JOIN fluid_car ON fluid_booking.car_id=fluid_car.id
                                LEFT JOIN fluid_sub_company ON fluid_car.id_subcompany=fluid_sub_company.id
                                LEFT JOIN fluid_place AS place1 on fluid_booking.id_place0=place1.id
                                LEFT JOIN fluid_place AS place2 on fluid_booking.id_placef=place2.id
                                LEFT JOIN fluid_sector AS sector1 ON place1.id_sector0=sector1.id
                                LEFT JOIN fluid_sector AS sector2 ON place2.id_sector0=sector2.id
                                LEFT JOIN fluid_distance ON (sector1.id=fluid_distance.id_sector0 AND  sector2.id=fluid_distance.id_sectorf)
                                WHERE rank IN('done','confirmed') and  fluid_car.id_subcompany='" . $id_subcompany . "' AND DATE(start_time) BETWEEN '" . $start . "' AND '" . $end . "'";
                            $res = mysqli_query($connection, $strsql);
                            $row = mysqli_fetch_array($res);
                            echo '<div id="total">TOTAL kilometer is: ' . $row["TOTAL"] . " Km <br>";
                            echo "TOTAL cost is: " . $row["TOTAL_COST"] . " Rwf <br></div>";


                        } else {
                            $id_place0 = stripcslashes('id_place0');
                            $id_placef = stripcslashes('id_placef');
                             $sql = "SELECT fluid_booking.id as booking_id,fluid_booking.id_user,fluid_user.id,fluid_user.username,fluid_booking.car_id,fluid_booking.start_time,description,rank,place1.name,place2.name,sector1.name,sector2.name,IF(kilometers>0, kilometers, 10) as kilometers,(IF(kilometers>0, kilometers, 10)/fluid_car.fuel_consumption)*1055 AS `COST`
                            FROM fluid_booking
                            LEFT JOIN fluid_user ON fluid_booking.id_user=fluid_user.id
                            LEFT JOIN fluid_car ON fluid_booking.car_id=fluid_car.id
                            LEFT JOIN fluid_sub_company ON fluid_car.id_subcompany=fluid_sub_company.id
                            LEFT JOIN fluid_place AS place1 on fluid_booking.id_place0=place1.id
                            LEFT JOIN fluid_place AS place2 on fluid_booking.id_placef=place2.id
                            LEFT JOIN fluid_sector AS sector1 ON place1.id_sector0=sector1.id
                            LEFT JOIN fluid_sector AS sector2 ON place2.id_sector0=sector2.id
                            LEFT JOIN fluid_distance ON (sector1.id=fluid_distance.id_sector0 AND  sector2.id=fluid_distance.id_sectorf)
                            WHERE rank IN('done','confirmed') and  fluid_car.id_subcompany='" . $id_subcompany . "'  ORDER BY DATE(start_time) ASC";

                            echo "All bookings<br>";
                            $result = mysqli_query($connection, $sql);
                            if (mysqli_num_rows($result) > 0) {

                                while ($row = mysqli_fetch_array($result)) {

                                    $booking_id=intval($row["booking_id"]);
                                    $sql = "SELECT username,full_name,description,a.name AS 'departure',b.name AS 'destination' FROM `fluid_booking_row` inner join fluid_user on fluid_user.id=fluid_booking_row.id_user JOIN fluid_place AS a ON fluid_booking_row.id_place0=a.id JOIN fluid_place AS b ON fluid_booking_row.id_placef=b.id  WHERE fluid_booking_row.id_booking=" . $booking_id;

                                    $res1 = mysqli_query($connection, $sql);
                                    $joints=mysqli_num_rows ( $res1);

                                    echo(
                                        '                            <tr>' .
                                        '<td>' . $row["booking_id"] . '</td>' .
                                        '<td>' . $row["username"] . '</td>' .
                                        '<td>' . $row["start_time"] . '</td>' .
                                        '<td>' . $row["description"] . '</td>' .
                                        '<td>' . $row["rank"] . '</td>' .
                                        '<td>' . $row["kilometers"] . '</td>' .
                                        '<td>' . ($joints+1) . '</td>'.
                                        '<td>' . $row["COST"]. '</td>'.
                                        '<td>' . '<a target="_blank" href="booking_view.php?id='.$row["booking_id"].'" class="btn btn-primary">Details</a>' . '</td>'.
                                        '</tr>'

                                    );
                                }

                            } else {
                                echo "0 results";
                            }

                            $strsql = "SELECT SUM(IF(kilometers>0, kilometers, 10)) AS `TOTAL`,SUM(IF(fluid_distance.kilometers>0, fluid_distance.kilometers, 10)/fluid_car.fuel_consumption)*960 AS `TOTAL_COST`
                            FROM fluid_booking
                            LEFT JOIN fluid_user ON fluid_booking.id_user=fluid_user.id
                            LEFT JOIN fluid_car ON fluid_booking.car_id=fluid_car.id
                            LEFT JOIN fluid_sub_company ON fluid_car.id_subcompany=fluid_sub_company.id
                            LEFT JOIN fluid_place AS place1 on fluid_booking.id_place0=place1.id
                            LEFT JOIN fluid_place AS place2 on fluid_booking.id_placef=place2.id
                            LEFT JOIN fluid_sector AS sector1 ON place1.id_sector0=sector1.id
                            LEFT JOIN fluid_sector AS sector2 ON place2.id_sector0=sector2.id
                            LEFT JOIN fluid_distance ON (sector1.id=fluid_distance.id_sector0 AND  sector2.id=fluid_distance.id_sectorf)
                            WHERE rank='done' or rank='confirmed' and  fluid_car.id_subcompany='" . $id_subcompany . "'  ORDER BY DATE(start_time) ASC";
                            $res = mysqli_query($connection, $strsql);
                            $row = mysqli_fetch_array($res);
                            echo '<div id="total">TOTAL kilometer is: ' . $row["TOTAL"] . " Km <br>";
                            echo "TOTAL cost is: " . $row["TOTAL_COST"] . " Rwf <br></div>";
                        }
                        ?>
                        <script>
                            /*$json = json_encode($data);
                            var data = <? //echo $json;?>;

                            $(".myselect").select2({
                                data: data
                            });

                            $('.myselect').on('select2:select', function (e) {

                                $("#myForm").submit();

                            });*/
                        </script>

                        </body>
                    </table>
                </div>
            </div>
            <?php
                if (isset($_POST['start_date']) and $_POST['start_date'] != '') {
                    // removes backslashes
                    //var_dump($_POST);
                    $start = stripslashes($_POST['start_date']);
                    $end = stripslashes($_POST['end_date']);
                }

            ?>
            <div class="justify-content-between d-flex col-12">
            <a href="sendmail.php<?=(isset($_POST['start_date']) and $_POST['start_date'] != '')?'?start='.$start.'&end='.$end:''?>">
                <button type="submit" class="btn btn-primary pull-left ">send</button>
            </a>

            <a href="sendmail_tomorrow.php?<?=(isset($_POST['start_date']) and $_POST['start_date'] != '')?'start='.$start.'&end='.$end:''?>">
                <button type="submit" class="btn btn-primary pull-right ">Send bookings of tomorrow</button>
            </a>
            
        </div>

        </div>
    </div>
</div>


<?php include('include/footerui.php'); ?>




