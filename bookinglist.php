<?php ob_start();
 include('connexion.php');
include 'include/authant.php';
include 'include/header.php' ;

if(!isset($_SESSION["username"])){
    header("Location: uiupdate.php");
    exit(); }
$id_subcompany = $_SESSION['sub_company'] ;
 ?>

<?php
$SESSION_ID = $_SESSION['id'];
?>
<?php //include('header.php'); ?>
<!-- /. NAV TOP  -->
<?php //include('navSide.php'); ?>

<body  id="page-top"   >
    <div id="wrapper">
        <!--sidbar start -->
        <?php include 'include/navbar.php'; ?>
        
        
        <!--sidbar end-->
        <div id='content-wrapper' class="d-flex flex-column">
            <?php
            require_once('include/topbon.php');
            ?>
    <div id="page-inner">
    <?php if(isset($msg) and trim($msg)!='' || isset($_GET['msg'])):?>
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
                <span class="sr-only"></span>
                <span class="msg"><?=$success?></span>
            </div>

<?php endif?>
        
        <form action="bookinglist.php" class="p-4" method="post">
            <div class="row">
                <div class="form-group col-md-5">
                    <div class='input-group date' id='datetimepicker1'>
                        <input name='start_date' type='text' class="form-control" placeholder="From"/>
                        <span class="input-group-addon input-group-append btn btn-info"  >
                                    <span class="fa fa-calendar"></span>
                                </span>
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <div class='input-group date' id='datetimepicker2'>
                        <input name='end_date' type='text' class="form-control" placeholder="Until"/>
                        <span class="input-group-addon input-group-append btn btn-primary">
                                    <span class="fa fa-calendar"></span>
                                </span>
                    </div>
                </div>
                <div class='form-group col-md-2'>
                    <button type="submit" class="btn btn-outline-info pull-right ">Go</button>
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


        <div class="row p-2" style="padding:10px;">
         <div class="card shadow-lg">
                <div class="card-header col-md-12 d-flex justify-content-between mb-5">
                        <h2>All bookings</h2>
                        <a href="uiupdate.php"><span class="btn btn-primary pull-right" style="bottom: opx;">Book</span></a>
                </div>
                <div class="card-boby">
                <div class="table-responsive p-2">
                <table class="table table-striped table-bordered table-hover display" id="datatable1" cellspacing="0"
                   width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>book-time</th>
                        <th>Start time</th>
                        <th>End time</th>
                        <th>User</th>
                        <th>Depature</th>
                        <th>Destination</th>
                        <th>status</th>
                        <th>Departments</th>
                        <th>Rank</th>
                    

                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    if (isset($_POST['start_date']) and $_POST['end_date'] != '') {
                        // removes backslashes
                        //var_dump($_POST);
                        $start = stripslashes($_POST['start_date']);
                        $end = stripslashes($_POST['end_date']);


                        $STRsql = "SELECT fluid_booking.id,created_at,start_time,end_time,username,a.name AS 'departure',b.name AS 'destination',statusname,name_dep,rank,fluid_booking.id_user  FROM `fluid_booking` inner join fluid_user on fluid_user.id=fluid_booking.id_user JOIN fluid_place AS a ON fluid_booking.id_place0=a.id JOIN fluid_place AS b ON fluid_booking.id_placef=b.id inner join fluid_status on fluid_status.id=fluid_booking.status_id inner join fluid_departments on fluid_departments.id=fluid_booking.Departments_id where fluid_user.id_subcompany=".$id_subcompany." AND DATE(start_time) BETWEEN '".$start."' AND '".$end."'";


                        $result2 = mysqli_query($connection, $STRsql);

                        if (mysqli_num_rows($result2) != '' || mysqli_num_rows($result2) > 0) {
                            // output data of each row
                            while ($row = mysqli_fetch_array($result2)) {

                                $d1 = new DateTime($row['start_time']);
                                $d2 = new DateTime();
                                echo(


                               

                                    '<tr>'.

                                        '<td>'.$row["id"].'</td>'.
                                        '<td>'.$row["created_at"].'</td>'.
                                        '<td>'.$row["start_time"].'</td>'.
                                        '<td>'.$row["end_time"].'</td>'.
                                        '<td>'.$row["username"].'</td>'. 
                                
                                        '<td>'.$row["departure"].'</td>'.
                                        '<td>'.$row["destination"].'</td>'.
                                        '<td>'.$row["statusname"].'</td>'.
                                        '<td>'.$row["name_dep"].'</td>'.
                                        '<td>'.$row["rank"].'</td>'.

                                      
                                    '</tr>'
                                
                                );

                            }

                        }

                    } else {


                        $sql = "SELECT fluid_booking.id,created_at,start_time,end_time,username,a.name AS 'departure',b.name AS 'destination',statusname,name_dep,rank ,fluid_booking.id_user FROM `fluid_booking` inner join fluid_user on fluid_user.id=fluid_booking.id_user JOIN fluid_place AS a ON fluid_booking.id_place0=a.id JOIN fluid_place AS b ON fluid_booking.id_placef=b.id inner join fluid_status on fluid_status.id=fluid_booking.status_id inner join fluid_departments on fluid_departments.id=fluid_booking.Departments_id where fluid_user.id_subcompany=".$id_subcompany." AND fluid_booking.end_time>=NOW()";
                        //echo  $sql;
                       
                        $rS = mysqli_query($connection, $sql);
                        //var_dump($rS);
                        //die();
                        if (mysqli_num_rows($rS) != '' || mysqli_num_rows($rS) > 0) {

                            while ($row = mysqli_fetch_array($rS)) {

                                $d1 = new DateTime($row['start_time']);
                                $d2 = new DateTime();
                                echo(
                                    '





                                    <tr>'.

                                        '<td>'.$row["id"].'</td>'.
                                        '<td>'.$row["created_at"].'</td>'.
                                        '<td>'.$row["start_time"].'</td>'.
                                        '<td>'.$row["end_time"].'</td>'.
                                        '<td>'.$row["username"].'</td>'. 
                                
                                        '<td>'.$row["departure"].'</td>'.
                                        '<td>'.$row["destination"].'</td>'.
                                        '<td>'.$row["statusname"].'</td>'.
                                        '<td>'.$row["name_dep"].'</td>'.
                                        '<td>'.$row["rank"].'</td>'
                                      
                                
                              ) ; 
                            }

                        } else {
                            echo "0 results";
                        }
                    }


                    ?>

                   

                 </tbody>
                </table>
            </div>
                </div>
         </div>
           

        </div>
    </div>
</div>
    </div>

<?php include('include/footerui.php'); ?> 

	
	
	
	