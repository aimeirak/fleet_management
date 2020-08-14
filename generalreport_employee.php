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
    header("location: ui.php");
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
                <h2>General Report</h2>


                <form action="generalreport_employee.php" method="post">
                    <div class="row">
                        <div class="form-group col-md-5">
                            <div class='input-group date' id='datetimepicker1'>
                                <input name='start_date' type='text' class="form-control"/>
                                <span class="input-group-addon btn btn-info ">
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
                                useCurrent: false,
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
            </div>
        </div>

        <div class="row" style="padding:10px;">
            <div id="div-to-print">
                <div class="table-responsive p-5">
                    <table class="table table-striped table-bordered table-hover" id="datatable1">
                        <thead>
                        <tr>

                            <th>Employee</th>
                            <th>Sub-Company</th>
                            <th>Total kms</th>
                            <th>Total Rwf</th>
                            <th>View</th>

                        </tr>
                        </thead>
                        <?php
                        if (isset($_POST['start_date']) and $_POST['start_date'] != '') {
                            $start = stripslashes($_POST['start_date']);
                            $end = stripslashes($_POST['end_date']);

                            $sql = "
                            
                                SELECT fluid_user.id as id_user,fluid_user.full_name as user_name,fluid_car.plaque,fluid_sub_company.subcompany_name AS `SUB`,SUM(IF(kilometers IS NULL AND fluid_car.plaque!='', 10, kilometers)) AS 'kilometers',SUM((IF(fluid_distance.kilometers>0, fluid_distance.kilometers, 10)/fluid_car.fuel_consumption)*1045)AS `COST` FROM fluid_user
                                LEFT JOIN fluid_booking on (fluid_booking.id_user=fluid_user.id AND fluid_booking.rank IN ('confirmed','done') AND DATE(fluid_booking.start_time) BETWEEN '$start' AND '$end')
                                LEFT JOIN fluid_car on fluid_booking.car_id=fluid_car.id 
                                LEFT JOIN fluid_place AS place1 on fluid_booking.id_place0=place1.id 
                                LEFT JOIN fluid_place AS place2 on fluid_booking.id_placef=place2.id 
                                LEFT JOIN fluid_sector AS sector1 ON place1.id_sector0=sector1.id 
                                LEFT JOIN fluid_sector AS sector2 ON place2.id_sector0=sector2.id 
                                LEFT JOIN fluid_distance ON (sector1.id=fluid_distance.id_sector0 AND sector2.id=fluid_distance.id_sectorf) 
                                LEFT JOIN fluid_sub_company ON fluid_user.id_subcompany=fluid_sub_company.id 
                                WHERE fluid_user.`id_subcompany`=$id_subcompany GROUP BY fluid_user.id
                            
                            ";

                            echo "Report from " . $start . " to " . $end . "<br>";
 
              echo"<tbody>";
                            $result = mysqli_query($connection, $sql);

                            if ($result) {
                                while ($row = mysqli_fetch_array($result)) {
                                    echo(
                                        '
                                        <tr>' .
                                        '<td>' . $row["user_name"] . '</td>' .
                                        '<td>' . $row["SUB"] . '</td>' .
                                        '<td>' . (($row["kilometers"])?$row["kilometers"]:'<span class="text-danger">0</span>'). '</td>' .
                                        '<td>' . (($row["COST"])?$row["COST"]:'<span class="text-danger">0</span>'). '</td>' .
                                        '<td>' . '<a href="user_report.php?id=' . $row["id_user"] .'&from='.$start .'&to='.$end. '" class="btn btn-primary">View</a>' . '</td>' .

                                        '</tr>'
                                    );
                                }
                            }
                            
                        } else {

                         $sql2 = "
                            SELECT fluid_user.id as id_user,fluid_user.full_name as user_name,fluid_car.plaque,fluid_sub_company.subcompany_name AS `SUB`,SUM(IF(kilometers IS NULL AND fluid_car.plaque!='', 10, kilometers)) AS 'kilometers',SUM((IF(fluid_distance.kilometers>0, fluid_distance.kilometers, 10)/fluid_car.fuel_consumption)*1045)AS `COST` FROM fluid_user
                            LEFT JOIN fluid_booking on (fluid_booking.id_user=fluid_user.id AND fluid_booking.rank IN ('confirmed','done'))
                            LEFT JOIN fluid_car on fluid_booking.car_id=fluid_car.id 
                            LEFT JOIN fluid_place AS place1 on fluid_booking.id_place0=place1.id 
                            LEFT JOIN fluid_place AS place2 on fluid_booking.id_placef=place2.id 
                            LEFT JOIN fluid_sector AS sector1 ON place1.id_sector0=sector1.id 
                            LEFT JOIN fluid_sector AS sector2 ON place2.id_sector0=sector2.id 
                            LEFT JOIN fluid_distance ON (sector1.id=fluid_distance.id_sector0 AND sector2.id=fluid_distance.id_sectorf) 
                            LEFT JOIN fluid_sub_company ON fluid_user.id_subcompany=fluid_sub_company.id 
                            WHERE fluid_user.`id_subcompany`=$id_subcompany GROUP BY fluid_user.id
                         ";

                            $res = mysqli_query($connection, $sql2);

                            if (mysqli_num_rows($res) > 0) {
                                while ($row = mysqli_fetch_array($res)) {
                                    echo(
                                        '
                                        <tr>' .
                                        '<td>' . $row["user_name"] . '</td>' .
                                        '<td>' . $row["SUB"] . '</td>' .
                                        '<td>' . (($row["kilometers"])?$row["kilometers"]:'<span class="text-danger">0</span>'). '</td>' .
                                        '<td>' . (($row["COST"])?$row["COST"]:'<span class="text-danger">0</span>'). '</td>' .
                                        '<td>' . '<a href="user_report.php?id=' . $row["id_user"] . '" class="btn btn-primary">View</a>' . '</td>' .

                                        '</tr>'
                                    );
                                }
                                echo  '</tbody>';
                            } else {
                                echo "0 results";
                            }
                        }

                        ?>
                    </table>
                </div>
            </div>
            <div>
                <input type="button" value="print" class="btn btn-danger" style="bottom: opx;" onclick="printDiv();"/>
            </div>

        </div>
    </div>
</div>

<?php include('include/footerui.php'); ?> 

	
	
	
