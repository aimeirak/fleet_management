<?php 
include 'include/authant.php';
ob_start();
include 'include/header.php' ; ?>

<?php include('connexion.php');
error_reporting(E_ALL);
ini_set('display_errors', 'On');

if(!isset($_REQUEST['id']) || trim($_REQUEST['id']) == '' ){
  header('location:uiupdate.php');
  exit();
}
?>


<?php $id_subcompany = $_SESSION['sub_company']; ?>

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
    
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h3>Booking #<?= $_GET['id'] ?></h3>
            </div>
        </div>
        <!-- /. ROW  -->

        <?php
            $id = $_GET['id'];

            $STRsql = "SELECT fluid_car.seats,fluid_car.plaque,start_time,end_time,username,full_name,description,created_at,updated_at,a.name AS 'departure',b.name AS 'destination' ,rank FROM `fluid_booking`
             inner join fluid_user on fluid_user.id=fluid_booking.id_user
              JOIN fluid_place AS a ON fluid_booking.id_place0=a.id 
              JOIN fluid_place AS b ON fluid_booking.id_placef=b.id 
             inner join fluid_driver_logs on fluid_driver_logs.driver_id = fluid_booking.driver_id 
             inner join fluid_car on fluid_driver_logs.car_id=fluid_car.id
               WHERE fluid_booking.id=" . $id ." and fluid_car.id_subcompany = ".$id_subcompany;

            $res = mysqli_query($connection, $STRsql);

            if (mysqli_num_rows($res) != '' || mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_array($res);
            }

            $seats=$row['seats'];
        ?>

        <?php
        $booking_id=intval($_GET['id']);
        $sql = "SELECT username,full_name,description,a.name AS 'departure',b.name AS 'destination' FROM `fluid_booking_row` inner join fluid_user on fluid_user.id=fluid_booking_row.id_user JOIN fluid_place AS a ON fluid_booking_row.id_place0=a.id JOIN fluid_place AS b ON fluid_booking_row.id_placef=b.id  WHERE fluid_booking_row.id_booking=" . $booking_id;

        $res1 = mysqli_query($connection, $sql);
        $joints=mysqli_num_rows ( $res1);
        $end_time = $row['end_time'];
        $start_time =$row['start_time'];

        ?>


        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <div class="">

                <table style="width:90%">
                    <tr>
                        <td>From</td>
                        <td><?= $row['departure'] ?></td>
                    </tr>
                    <tr>
                        <td>To</td>
                        <td><?= $row['destination'] ?></td>
                    </tr>
                    <tr>
                        <td>Start time</td>
                        <td><?= $row['start_time'] ?></td>
                    </tr>
                    <tr>
                        <td>End time</td>
                        <td><?= $row['end_time'] ?></td>
                    </tr>
                    <tr>
                        <td>Car</td>
                        <td><?= $row['plaque'] ?></td>
                    </tr>
                    <tr>
                        <td>Comments</td>
                        <td><?= $row['description'] ?></td>
                    </tr>
                    <tr>
                        <td>Number of passengers</td>
                        <td><?=$joints+1?> / <?= $row['seats'] ?></td>
                    </tr>
                    <tr>
                        <td>Created at</td>
                        <td><?=$row['created_at']?></td>
                    </tr>
                    <tr>
                        <td>Updated at</td>
                        <td><?=$row['updated_at']?$row['updated_at']:'Never updated'?></td>
                    </tr>
                    <tr>
                        <td><h1></h1></td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- End Register Box -->

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="">
                <h3>Main passenger</h3>

                <table style="width:100%">
                    <tr>
                        <td><?= $row['full_name'] ?></td>
                    </tr>
                </table>

                <h3>Joined passengers</h3>



                <table style="width:60%">

                    <th>Employee</th>
                    <th>From</th>
                    <th>To</th>
                    <?php $i=1; while($row = mysqli_fetch_array($res1)):?>
                        <tr>

                            <td><?=$i++?> . <?= $row['full_name'] ?></td>
                            <td><?=$row['departure']?></td>
                            <td><?=$row['destination']?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>

                <?php if(($joints+1)<$seats):?>
                    <button type="button" class="btn btn-default btn-number" data-type="plus" data-target="#addModal"
                            data-toggle="modal">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                <?php endif?>
            </div>
        </div>

        <?php


        if (isset($_POST['join'])) {
            //var_dump($_POST);
            //die();

            $booking_id=intval($_GET['id']);
            $user_id = intval($_SESSION['id']);
            $departure = intval(stripslashes($_POST['departure']));
            $destination = intval(stripslashes($_POST['destination']));
            $description = intval(stripslashes($_POST['description']));
            $rank = 'pending';

            $sql="SELECT * FROM fluid_booking WHERE id=".$booking_id;
            $res1 = mysqli_query($connection, $sql);
            if ($res1) {
                $row = mysqli_fetch_array($res1);
            }


            if($user_id==$row['id_user']){
                echo '  <p class="text-danger">You are already in this ride</p>';
                exit;
            }


            $sql2="SELECT * FROM fluid_booking_row WHERE id_booking=".$booking_id." and id_user=".$user_id;
            $res2 = mysqli_query($connection, $sql2);
            $row_cnt = mysqli_num_rows($res2);
            if ($row_cnt) {
                echo '  <p class="text-danger">You are already in this ride</p>';
                exit;
            }


          
            $strSQL = "INSERT into `fluid_booking_row` (id_booking,id_user,id_place0,id_placef,description) values(" . $booking_id . "," . $user_id . "," . $departure . "," . $destination . ",'" . $description . "')";

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


                $message = '
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
                    <h1>Booking join information</h1>
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
                    <a class="button" href="http://localhost/fleetbackup/confirm_booking.php?id=' . $id . '">Confirm this booking now</a>
                    
                    <a class="button" href="http://localhost/fleetbackup/permission.php?id=' . $id . '">Permit </a>
                    </body>
                    </html>';

                    $sel ="SELECT email from fluid_user where role = ? and id_subcompany = ? ";
                    $add= 20;
                    $stmt = $connection->prepare($sel);
                    $stmt->bind_param('ii',$add,$id_subcompany);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $adexist = $result->num_rows;
                    if($adexist){
                        $row = $result->fetch_assoc();
                        $to =$row['email'];
                        
                    $subject = "ishyiga fleet user join request ";
                    $sender = "ishyigasoftware900@gmail.com";
                    $sender_name = " Booking join  ";
                       
                    include 'include/deplicatSolver/emailSender.php';
                    $emailSent = sendEmail($subject,$sender,$sender_name,$to,$message);
                  
                    if($emailSent){
                        $success ='join booking request is sent ' ;
                        header("Location: booking_view.php?success=$success&id=".$_GET['id']);
                      
                        
                    }else{
                    $msg ='request not sent ';
                    header("Location: booking_view.php?msg=$msg&id=".$_GET['id']);
                       
                    }

                    }else{
                        $success ='admin not exist' ;

                    }
                }
        }


        ?>
        <span class="collapsed btn btn-primary ml-4"  data-toggle="collapse" data-target="#joinform" aria-expanded="true" aria-controls="joinform">
           
            <span>Join cars <i class="fas fa-fw fa-car"></i></span> 
            
          </span>
        
<div id="joinform" class="collapse ml-5 " aria-labelledby="headingPages" data-parent="#accordionSidebar" style="height: auto;">

    <div class="row">


        <div  class="joinform" id="joinform" tabindex="-1" role="dialog">
            <div class="card modal-dialog">
                <div class="modal-content">

                    <div class="modal-header justify-content-between d-flex">
                       
                        <h4 class="modal-title">Join ride</h4>

                        <span class=" "  data-toggle="collapse" data-target="#joinform" aria-expanded="true" aria-controls="joinform">
           
                            <span> <i  class="fa fa-times"></i></span> 
                            
                          </span>
                          
                    </div>


                    <div class="modal-body">

                        <form action="booking_view.php?id=<?=$_GET['id']?>" method="post">


                            <div class="form-group">
                                <div class="select-container">
                                    <label>Departure</label>

                                    <?php
                                    $sql = "SELECT fluid_place.id,fluid_place.id_user,fluid_place.name FROM fluid_place 
                                            inner join fluid_user on fluid_place.id_user=fluid_user.id
                                            inner join fluid_sub_company on fluid_user.id_subcompany=fluid_sub_company.id
                                            where id_subcompany='" . $id_subcompany . "'
                                            order by name asc";
                                    $rs = mysqli_query($connection, $sql); ?>

                                    <select type="text" name="departure" class='select2 form-control'>
                                        <?php
                                            while ($row = mysqli_fetch_array($rs)) {
                                                echo '<option value=' . $row['id'] . ' >  ' . $row['name'] . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>


                            </div>
                            <div class="form-group">
                                <div class="select-container">
                                    <label>Destination</label>

                                    <?php
                                    $sql = "SELECT fluid_place.id,fluid_place.id_user,fluid_place.name FROM fluid_place 
                                            inner join fluid_user on fluid_place.id_user=fluid_user.id
                                            inner join fluid_sub_company on fluid_user.id_subcompany=fluid_sub_company.id
                                            where id_subcompany='" . $id_subcompany . "'
                                            order by name asc";
                                    $rs = mysqli_query($connection, $sql); ?>

                                    <select type="text" name="destination" class='select2 form-control'>
                                        <?php
                                        while ($row = mysqli_fetch_array($rs)) {
                                            echo '<option value=' . $row['id'] . ' >  ' . $row['name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <div class="required-field-block">
                                        <textarea rows="3" class="form-control" name="description" placeholder=""
                                                  required></textarea>
                                    <div class="required-icon">
                                        <div class="text">*</div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" name="join" class="btn btn-primary pull-left">Join</button>
                        </form>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" role="button">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>



</div>
         </div>
    </div>
</div>

   <?php include 'include/footerui.php' ?>