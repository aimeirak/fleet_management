<?php ob_start();
include('authenticate.php'); ?>
<?php include('connexion.php'); ?>
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

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>General Report</h2>


                <form action="generalreport.php" method="post">
                    <div class="row">
                        <div class="form-group col-md-5">
                            <div class='input-group date' id='datetimepicker1'>
                                <input name='start_date' type='text' class="form-control"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-md-5">
                            <div class='input-group date' id='datetimepicker2'>
                                <input name='end_date' type='text' class="form-control"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class='form-group col-md-2'>
                            <button type="submit" class="btn btn-default pull-right ">Go</button>
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
            <div id="div-to-print">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="printable">
                        <thead>
                        <tr>

                            <th>Plaque</th>
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

                            $sql = "SELECT fluid_car.id as id_car,fluid_car.plaque,fluid_sub_company.subcompany_name AS `SUB`,SUM(IF(kilometers IS NULL AND fluid_car.plaque!='', 10, kilometers)) AS 'kilometers',SUM((IF(fluid_distance.kilometers>0, fluid_distance.kilometers, 10)/fluid_car.fuel_consumption)*1045)AS `COST` 
FROM fluid_car 
LEFT JOIN fluid_booking on fluid_booking.car_id=fluid_car.id 
LEFT JOIN fluid_user on fluid_booking.id_user=fluid_user.id 
LEFT JOIN fluid_place AS place1 on fluid_booking.id_place0=place1.id 
LEFT JOIN fluid_place AS place2 on fluid_booking.id_placef=place2.id 
LEFT JOIN fluid_sector AS sector1 ON place1.id_sector0=sector1.id 
LEFT JOIN fluid_sector AS sector2 ON place2.id_sector0=sector2.id 
LEFT JOIN fluid_distance ON (sector1.id=fluid_distance.id_sector0 AND sector2.id=fluid_distance.id_sectorf) 
LEFT JOIN fluid_sub_company ON fluid_car.id_subcompany=fluid_sub_company.id 
WHERE rank IN ('confirmed','done') and fluid_sub_company.id=" . $id_subcompany . "  AND DATE(start_time) BETWEEN '" . $start . "' AND '" . $end . "'
        GROUP BY fluid_car.id";

                            //echo $sql;


                            echo "Report from " . $start . " to " . $end . "<br>";


                            $result = mysqli_query($connection, $sql);
                            echo "<span id='plaque'>RAD 762</span>";

                            if ($result) {
                                while ($row = mysqli_fetch_array($result)) {
                                    echo(
                                        '<tbody>
                                        <tr>' .
                                        '<td>' . $row["plaque"] . '</td>' .
                                        '<td>' . $row["SUB"] . '</td>' .
                                        '<td>' . $row["kilometers"] . '</td>' .
                                        '<td>' . $row["COST"] . '</td>' .
                                        '<td>' . '<a href="car_report.php?id=' . $row["id_car"] .'&from='.$start .'&to='.$end. '" class="btn btn-primary">View</a>' . '</td>' .

                                        '</tr>
                                    </tbody>'
                                    );
                                }
                            }
                        } else {

                          $sql2 = "SELECT fluid_car.id as id_car,fluid_car.plaque,fluid_sub_company.subcompany_name AS `SUB`,SUM(IF(kilometers IS NULL AND fluid_car.plaque!='', 10, kilometers)) AS 'kilometers',SUM((IF(fluid_distance.kilometers>0, fluid_distance.kilometers, 10)/fluid_car.fuel_consumption)*1045)AS `COST` 
FROM fluid_car 
LEFT JOIN fluid_booking on fluid_booking.car_id=fluid_car.id 
LEFT JOIN fluid_user on fluid_booking.id_user=fluid_user.id 
LEFT JOIN fluid_place AS place1 on fluid_booking.id_place0=place1.id 
LEFT JOIN fluid_place AS place2 on fluid_booking.id_placef=place2.id 
LEFT JOIN fluid_sector AS sector1 ON place1.id_sector0=sector1.id 
LEFT JOIN fluid_sector AS sector2 ON place2.id_sector0=sector2.id
LEFT JOIN fluid_distance ON (sector1.id=fluid_distance.id_sector0 AND sector2.id=fluid_distance.id_sectorf) 
LEFT JOIN fluid_sub_company ON fluid_car.id_subcompany=fluid_sub_company.id WHERE rank IN ('confirmed','done') AND fluid_car.`id_subcompany`=" . $id_subcompany . " GROUP BY fluid_car.id";

                            $res = mysqli_query($connection, $sql2);

                            if (mysqli_num_rows($res) > 0) {
                                while ($row = mysqli_fetch_array($res)) {
                                    echo(
                                        '<tbody>
                                        <tr>' .
                                        '<td>' . $row["plaque"] . '</td>' .
                                        '<td>' . $row["SUB"] . '</td>' .
                                        '<td>' . $row["kilometers"] . '</td>' .
                                        '<td>' . $row["COST"] . '</td>' .
                                        '<td>' . '<a href="car_report.php?id=' . $row["id_car"] . '" class="btn btn-primary">View</a>' . '</td>' .

                                        '</tr>
                                    </tbody>'
                                    );
                                }
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

<?php include('footer.php'); ?> 

	
	
	
