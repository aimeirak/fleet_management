<?php ob_start();
include('authenticate.php'); ?>
<?php include('connexion.php');
$SESSION_ID = $_SESSION['id'];
?>
<?php
$id_subcompany = $_SESSION['sub_company'];
if ($_SESSION['role'] != 20) {
    header("location: ui.php");
}
?>


    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-6">
                    <h2>Car history</h2>
                </div>

            </div>


            <div class="row" style="padding:10px;">

                <table class="table table-striped table-bordered table-hover display" id="printable_car" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>plaque</th>
                        <th>Start time</th>
                        <th>End time</th>
                        <th>Employee</th>
                        <th>Depature</th>
                        <th>Destination</th>
                        <th>KMS</th>
                        <th>COST</th>
                    </tr>
                    </thead>
                    <body>
                    <?php

                    if (isset($_GET['from']) and $_GET['to'] != '') {
                        // removes backslashes
                        //var_dump($_POST);
                        $start = stripslashes($_GET['from']);
                        $end = stripslashes($_GET['to']);




                        $sql = "SELECT fluid_car.plaque,start_time,end_time,username,a.name AS 'departure',b.name AS 'destination' ,rank,IF(kilometers>0, kilometers, 10) as 'kilometers',(IF(fluid_distance.kilometers>0, fluid_distance.kilometers, 10)/fluid_car.fuel_consumption)*1045 AS `COST`
                                FROM `fluid_booking` 
                                LEFT join fluid_user on fluid_user.id=fluid_booking.id_user 
                                LEFT JOIN fluid_place AS a ON fluid_booking.id_place0=a.id 
                                LEFT JOIN fluid_place AS b ON fluid_booking.id_placef=b.id 
                                LEFT  JOIN fluid_sector AS sector1 ON a.id_sector0=sector1.id
                                LEFT JOIN fluid_sector AS sector2 ON b.id_sector0=sector2.id
                                LEFT JOIN fluid_distance ON (sector1.id=fluid_distance.id_sector0 AND  sector2.id=fluid_distance.id_sectorf) 
                                LEFT join fluid_car on fluid_booking.car_id=fluid_car.id where rank IN ('confirmed','done') and fluid_booking.car_id=" . $_GET['id'] ." AND DATE(start_time) BETWEEN '" . $start . "' AND '" . $end . "' ORDER BY end_time DESC";



                        $sql1 = "SELECT SUM((IF(fluid_distance.kilometers>0, fluid_distance.kilometers, 10)/fluid_car.fuel_consumption)*1045)AS `SUM`
                                FROM `fluid_booking` 
                                LEFT join fluid_user on fluid_user.id=fluid_booking.id_user 
                                LEFT JOIN fluid_place AS a ON fluid_booking.id_place0=a.id 
                                LEFT JOIN fluid_place AS b ON fluid_booking.id_placef=b.id 
                                LEFT JOIN fluid_sector AS sector1 ON a.id_sector0=sector1.id
                                LEFT JOIN fluid_sector AS sector2 ON b.id_sector0=sector2.id
                                LEFT JOIN fluid_distance ON (sector1.id=fluid_distance.id_sector0 AND  sector2.id=fluid_distance.id_sectorf) 
                                LEFT join fluid_car on fluid_booking.car_id=fluid_car.id where rank IN ('confirmed','done') and fluid_booking.car_id=".$_GET['id'] ." AND DATE(start_time) BETWEEN '" . $start . "' AND '" . $end . "' ORDER BY end_time DESC";
                        //echo  $sql;
                        //echo
                        echo '<div id="top">'."Report from " . $start . " to " . $end . "<br>"."</div>";

                        $rS = mysqli_query($connection, $sql);
                        $rS1 = mysqli_query($connection, $sql1);
                        if (mysqli_num_rows($rS1) != '' || mysqli_num_rows($rS1) > 0) {
                            $row1 = mysqli_fetch_array($rS1);
                        }

                        //echo $row1['SUM'];
                        echo '<div id="total">';
                        echo "TOTAL cost is: " . $row1["SUM"] . " Rwf <br></div>";
                        //var_dump($rS);
                        //die();
                        if (mysqli_num_rows($rS) != '' || mysqli_num_rows($rS) > 0) {

                            while ($row = mysqli_fetch_array($rS)) {
                                echo(
                                    '
                                    <tr>' .
                                    '<td>' . $row["plaque"] . '</td>' .
                                    '<td>' . $row["start_time"] . '</td>' .
                                    '<td>' . $row["end_time"] . '</td>' .
                                    '<td>' . $row["username"] . '</td>' .

                                    '<td>' . $row["departure"] . '</td>' .
                                    '<td>' . $row["destination"] . '</td>' .
                                    '<td>' . $row["kilometers"] . '</td>' .
                                    '<td>' . $row["COST"] . '</td>' .
                                    '</tr>
                                '
                                );
                            }

                        } else {
                            echo "0 results";
                        }

                    } else {


                        $sql = "SELECT fluid_car.plaque,start_time,end_time,username,a.name AS 'departure',b.name AS 'destination' ,rank,IF(kilometers>0, kilometers, 10) AS 'kilometers',(IF(fluid_distance.kilometers>0, fluid_distance.kilometers, 10)/fluid_car.fuel_consumption)*1045 AS `COST`
FROM `fluid_booking` 
LEFT join fluid_user on fluid_user.id=fluid_booking.id_user 
LEFT JOIN fluid_place AS a ON fluid_booking.id_place0=a.id 
LEFT JOIN fluid_place AS b ON fluid_booking.id_placef=b.id 
LEFT JOIN fluid_sector AS sector1 ON a.id_sector0=sector1.id
LEFT JOIN fluid_sector AS sector2 ON b.id_sector0=sector2.id
LEFT JOIN fluid_distance ON (sector1.id=fluid_distance.id_sector0 AND  sector2.id=fluid_distance.id_sectorf) 
LEFT join fluid_car on fluid_booking.car_id=fluid_car.id where rank IN ('confirmed','done') and fluid_booking.car_id=" . $_GET['id'] . " ORDER BY end_time DESC";


                        $sql1 = "SELECT SUM((IF(fluid_distance.kilometers>0, fluid_distance.kilometers, 10)/fluid_car.fuel_consumption)*1045)AS `SUM`
FROM `fluid_booking` 
LEFT join fluid_user on fluid_user.id=fluid_booking.id_user 
LEFT JOIN fluid_place AS a ON fluid_booking.id_place0=a.id 
LEFT JOIN fluid_place AS b ON fluid_booking.id_placef=b.id 
LEFT JOIN fluid_sector AS sector1 ON a.id_sector0=sector1.id
LEFT JOIN fluid_sector AS sector2 ON b.id_sector0=sector2.id
LEFT JOIN fluid_distance ON (sector1.id=fluid_distance.id_sector0 AND  sector2.id=fluid_distance.id_sectorf) 
LEFT join fluid_car on fluid_booking.car_id=fluid_car.id where rank IN ('confirmed','done') and fluid_booking.car_id=" . $_GET['id'] . " ORDER BY end_time DESC";
                        //echo  $sql;
                        echo '<div id="top">'."All trips"."<br>"."</div>";
                        $rS = mysqli_query($connection, $sql);
                        $rS1 = mysqli_query($connection, $sql1);
                        if (mysqli_num_rows($rS1) != '' || mysqli_num_rows($rS1) > 0) {
                            $row1 = mysqli_fetch_array($rS1);
                        }

                        //echo $row1['SUM'];
                        echo '<div id="total"></br>';
                        echo "TOTAL cost is: " . $row1['SUM'] . " Rwf <br></div>";
                        //var_dump($rS);
                        //die();
                        if (mysqli_num_rows($rS) != '' || mysqli_num_rows($rS) > 0) {

                            while ($row = mysqli_fetch_array($rS)) {
                                echo(
                                    '



                                    <tr>' .
                                    '<td>' . $row["plaque"] . '</td>' .
                                    '<td>' . $row["start_time"] . '</td>' .
                                    '<td>' . $row["end_time"] . '</td>' .
                                    '<td>' . $row["username"] . '</td>' .

                                    '<td>' . $row["departure"] . '</td>' .
                                    '<td>' . $row["destination"] . '</td>' .
                                    '<td>' . $row["kilometers"] . '</td>' .
                                    '<td>' . $row["COST"] . '</td>' .
                                    '</tr>
                                '
                                );
                            }

                        } else {
                            echo "0 results";
                        }
                    }


                    ?>
                    <script>
                        $json = json_encode($data);
                        var data = <?= $json?>;

                        $(".myselect").select2({
                            data: data
                        });

                        $('.myselect').on('select2:select', function (e) {

                            $("#myForm").submit();

                        });
                    </script>

                    </body>
                </table>


            </div>

            <div>
                <h3>Car garage history</h3>
                <table class="table table-striped table-bordered table-hover display" id="datatable1" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>From </th>
                        <th>To</th>
                        <th>Reason</th>
                        <th>Status</th>

                    </tr>
                    </thead>
                    <body>
                <?php

                    $sql3="SELECT * FROM fluid_unavailable_car WHERE id_car=".$_GET['id'];
                    $res3 = mysqli_query($connection, $sql3);

                    if (mysqli_num_rows($res3) != '' || mysqli_num_rows($res3) > 0) {

                         while ($row = mysqli_fetch_array($res3)) {
                             //var_dump($row);
                                echo(
                                    '
                                        <tr>' .
                                        '<td>' . $row["id"] . '</td>' .
                                        '<td>' . $row["departure_time"] . '</td>' .
                                        '<td>' . $row["assumed_arrival_time"] . '</td>' .
                                        '<td>' . $row["reason"] . '</td>' .
                                        '<td>' . $row["status"] . '</td>' .
                                        '</tr>
                                    '
                                );
                            }
                    }else {
                        echo "0 results";
                    }
                ?>
                    </body>
                </table>
            </div>
        </div>
    </div>



<?php include('footer.php'); ?>