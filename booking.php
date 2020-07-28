<?php 
include 'include/authant.php';
ob_start();
include 'include/header.php' ; ?>
<?php include('connexion.php');
error_reporting(E_ALL);
ini_set('display_errors', 'On');
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
                <h2>New booking</h2>
            </div>

            <div class="col-md-12 msg-box" style="display: none">

                <div class="alert alert-danger" role="alert">
                    <span class="fa fa-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    <span class="msg"></span>
                </div>
            </div>

        </div>
        <!-- /. ROW  -->


        <?php


        if (isset($_POST['submit']) and isset($_POST['plaque']) ) {
            // removes backslashes
            //var_dump($_POST);

            

            $user_id = intval($_SESSION['id']);
            $car_id = stripslashes($_POST['plaque']);

            $startTime = stripslashes($_POST['startTime']);
            $endTime   = stripslashes($_POST['endTime']);
            
            $startdate = stripslashes($_POST['start_time']);
            $enddate = stripslashes($_POST['end_time']);

            $start_time = $startdate.' '.$startTime ;
            $end_time = $enddate.' '.$endTime ;
            $departure = intval(stripslashes($_POST['departure']));
            //$from = mysqli_real_escape_string($connection,$from);
            $destination = intval(stripslashes($_POST['destination']));
            $status = intval(stripslashes($_POST['status']));
            $departments_id = stripslashes($_POST['name_dep']);
            $description = stripslashes($_POST['description']);          
                $rank = 'confirmed'; 
            $now=date("Y-m-d H:i:s");

       
           

            $sql_check = "SELECT id FROM fluid_booking WHERE ((rank ='confirmed') AND (car_id=$car_id) AND ((end_time > '$start_time') AND (start_time < '$end_time')))";
            $res_check = mysqli_query($connection, $sql_check);

            $msg="";
            if (mysqli_num_rows($res_check)){
                $msg.="Time taken by an other booking"."</br>";

            }else {
     //check if car shoosen is avaible
     $live = 1;
    
     //== 
     //==limite user for chossing wrong date 
    

                $strSQL = "INSERT into `fluid_booking` (id_user,car_id,start_time,end_time,id_place0,id_placef,status_id,departments_id,description,rank,created_at) values(" . $user_id . "," . $car_id . ",'" . $start_time . "','" . $end_time . "'," . $departure . "," . $destination . "," . $status . "," . $departments_id . ",'" . $description . "','" . $rank ."','" .$now. "')";
                //var_dump($strSQL);
                $res = mysqli_query($connection, $strSQL);

                $base_url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                if ($res) {
                    //km count
                    $kmd  = "SELECT * FROM fluid_booking where id_user = ? order by id desc ";
                    $stmt = $connection->prepare($kmd);
                    $stmt->bind_param('i',$user_id);
                    $stmt->execute();
                    $krow =  $stmt->get_result();
                    $fetchBookingId = $krow->fetch_assoc();
                    $bookId = $fetchBookingId['id'];
                    $startPlace = $fetchBookingId['id_place0'];
                    $endPlace = $fetchBookingId['id_placef'];

                    $insert = "INSERT into fluid_km_count (id_booking,id_place0,id_placef) VALUES (?,?,?) ";
                    $kmi    = $connection->prepare($insert);
                    $kmi->bind_param('iii',$bookId,$startPlace,$endPlace);
                    $kmi->execute();


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
                        
                    $subject = "ishyiga freet user booking request ";
                    $sender = "ishyigasoftware900@gmail.com";
                    $sender_name = " Bookings ";
                   
                    include 'include/deplicatSolver/emailSender.php';
                    $emailSent = sendEmail($subject,$sender,$sender_name,$to,$message);
                    $emailSent= true;
                    if($emailSent){
                    $success ='request is  sent ' ;
                    header("Location: bookinglist.php?success=$success");
                        
                    }else{
                    $msg ='request not sent ';
                    }

                    }else{
                        $success ='admin not exist' ;

                    }

                   
                    

                }
            }
        }


        ?>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            

            <div class="">
            
            <?php 
            
            if(isset($_GET['msg']) and trim($_GET['msg'])!=''):?>
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
                <form id="new-booking" spellcheck="false" class="form-horizontal" action="booking.php" method="post">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">


                            <label>username</label>

                            <input class="form-control" type="text" name="username" disabled
                                   placeholder="<?php echo $_SESSION['username'] ?>"
                                   required>

                            <?php
                            $standard = 'Available';
                            $privateDateEnd = date('m/d/y'); 
                            $sql2 = "SELECT id,id_subcompany,plaque,standard FROM fluid_car where id_subcompany='" . $id_subcompany . "' and standard='Available' and id NOT IN (select id_car from fluid_private_usage where fluid_private_usage.to > '". $privateDateEnd ."' and live != 1) ;";
                           
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
                                <div class='d-flex'>
                                <div  class='d-block d-sm-flex"'  id=''>
                                    <input name='start_time' type='date' id="sd"  autocomplete="off" autocorrect="off" class="form-control" required value="<?=isset($start_time)?$start_time:''?>" />
                                    <input name='startTime' type='time' id="st"  autocomplete="off" autocorrect="off"class="form-control"  required value="<?=isset($startTime)?$startTime:''?>" />
                                     
                                </div>
                                             
                                </div>
                               
                                <label>End time</label>
                                <div class='d-flex'>
                                <div class='d-block d-sm-flex"' id=''>
                                <input name='end_time' type='date' id="ed"  autocomplete="off" autocorrect="off"  class="form-control" required value="<?=isset($end_time)?$end_time:''?>" />
                                <input name='endTime' type='time' id="et"   autocomplete="off" autocorrect="off" class="form-control"  required value="<?=isset($endTime)?$endTime:''?>" />
                                      
                                </div>
                                           
                                </div>

                               

                                <script type="text/javascript">

                        $(document).ready(function () {
                            $('#datetimepicker1').datetimepicker
                                        (
                                            {
                                                format: "YYYY-MM-DD ",
                                            }
                                        );

                                        $('#datetimepicker2').datetimepicker
                                        (
                                            {
                                                format: "YYYY-MM-DD ",
                                                useCurrent: false
                                            }
                                        )
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
                                <button type="button" class="btn btn-outline-default btn-number" data-type="plus" data-toggle="modal" id="adddep">
                                    <span class="fa fa-plus"></span>
                                    </button>
</span>
                                    <?php if(isset($_POST['save'])) {
                                        
                                        // removes backslashes 
                                       

                                        $id_user = intval($_SESSION['id']);
                                        $name = stripslashes($_POST['departure']);
                                        $id_sector0 = stripslashes($_POST['name']);
                                        $aboutcontract = stripslashes($_POST['aboutcontract']);
                                        if(empty($name)||empty($id_sector0)||empty($aboutcontract)){
                                            $msg = 'you submitted with empty field';                                            
                                            header("Location:booking.php?msg=$msg");
                                        } else{
                                            $sqlqury  = 'SELECT id_sector0,name from fluid_place WHERE name = ? and id_sector0 = ? ';
                                            $stmt = $connection->prepare($sqlqury);
                                            $stmt->bind_param('si',$_POST['departure'],$_POST['name']);
                                            $result = $stmt->get_result();
                                            $placeExist = $result->num_rows;
                                            if($placeExist){
                                                  $msg = 'place exist';
                                                
                                                header("Location:booking.php?msg=$msg");
                                            }else{
                                                //$from = mysqli_real_escape_string($connection,$from);

                                                echo $sql = "INSERT into `fluid_place` (id_user,name,id_sector0,aboutcontract) values (" . $id_user . ",'" . $name . "'," . $id_sector0 . ",'" . $aboutcontract . "')";
        
                                                $result = mysqli_query($connection, $sql);
                                                //var_dump($result);
        
        
                                                if ($result) {
                                                    $success = 'place created. Now you can browse it! ';
                                                    header("Location:booking.php?success=$success");
                                                }
                                            }


                                            
                             

                                        }

                                    } 
                                    ?>

                                    <select id="departure" class="myselect form-control" name="departure" style="width: 100%"></select>
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
                                    <button type="button" class="btn btn-outline-default btn-number" id='addDestin' ><span class="fa fa-plus"></span>
                                    </button>
                                    </span>


                                        <select id="destination" class="myselect form-control" name="destination" style="width: 100%"></select>

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
        var sd =$("#sd").val();
        var st =$("#st").val();

        var start_time = sd+' '+st;

        var ed =$("#ed").val();
        var et =$("#et").val();

        var end_time = ed+' '+et;
        if(value1==value2) {
            //alert
            $(".msg").html("Destination must be different from departure");
            $(".msg-box").show();
            event.preventDefault();
        }
        if(start_time == end_time){
            $(".msg").html("start time must be different from end time");
            $(".msg-box").show();
            event.preventDefault();
        }
    });
</script

<?php include('include/footerui.php'); ?> 
   