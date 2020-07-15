<?php ob_start();
 
 if(isset($_POST['book']) ){
     session_start();
?>
<?php include('../connexion.php');
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>
  
<?php $id_subcompany = $_SESSION['sub_company']; ?>


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


        if (isset($_POST['plaque']) && !empty($_POST['plaque'])) {
            // removes backslashes
            //var_dump($_POST);

            $user_id = intval(5);
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


                     $messagesq = '
                    
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
                     ';
                   try{
                    $role = 10;
                    $select = "SELECT email from fluid_user where id_subcompany =?  and role = ? ";
                    $stmt   = $connection->prepare($select);
                    $stmt->bind_param('si',$id_subcompany,$role);
                    $stmt->execute();
                    $result   = $stmt->get_result();
                    $anyAdmin = $result->num_rows;
                    if($anyAdmin == 1){
                        $row = $result->fetch_assoc();
                        //to be modified
                       //$toAdm = $row['email'];
                       $sender = "ishyigasoftware900@gmail.com";
                       $sender_name = "ishyiga Freet Managiment system ";
                       $to  = 'sezeranochrisostom123@gmail.com';//must be the driver
                       include '../tasks/emailSender.php';
                       $request = sendEmail($subject,$sender,$sender_name,$to,$messagesq);
                    //    $request = true; when no internet
 
                       if($request){
                         $success =  'your request is sent';  
                         header('location:allbookings.php?SENT=your request is sent ');                    
                       }else{
                         $msg =  'email not sent';
            
                       }
 
                    }else{
                     $msg = 'lost';
                    
                    }
                   }catch(Exception $e){
                       if(issset($success)){
                        $success =  'your request is sent'; 
                       }else{
                        $msg =  'email not sent';
                       }
                   }
                  

                  

                }
            }
        }


        ?>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <?php if(isset($msg) and trim($msg)!=''){?>
            <div class="alert alert-danger" role="alert">
                <span class="fa fa-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <span class="msg"><?=$msg?></span>
            </div>
            <?php }elseif(isset($success) and $success === 'you request is sent' ){?>
            <div class="alert alert-success" role="alert">
                <span class="fa fa-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Success:</span>
                <span class="msg"><?=$success?></span>
            </div>
                <?php }?>


            <div class="">

                <form id="new-booking" class="form-horizontal" >
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
                            <select name="plaque" id="plaque" class="form-control">
                                <?php
                                while ($row = mysqli_fetch_array($rs2)) {
                                    echo '<option value="' . $row['id'].'"' .((isset($car_id) and ($car_id==$row['id']))?'selected':' '). ' >  ' . $row['plaque'] . '</option>
';
                                }
                                echo '</select>';
                                ?>
                                <label>Start time</label>
                                <div class="input-group date"  id='datetimepicker1'>
                                    <input name='start_time' id='start_time' type="date" class="form-control  border small"  placeholder="YYYY-MM-DD HH:mm" aria-label="Search" aria-describedby="basic-addon2" required value="<?=isset($start_time)?$start_time:''?>">
                                    <input name='time' id='startTime' type="time" class="form-control  border small"  placeholder="YYYY-MM-DD HH:mm" aria-label="Search" aria-describedby="basic-addon2" required value="<?=isset($start_time)?$start_time:''?>">
                                    
                                    <div class="input-group-append">
                                        <span class="btn btn-primary" type="button">
                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                    </div>
                                </div>
                               
                                <label>End time</label>
                                <div class="input-group date"  id='datetimepicker2'>
                                    <input name='end_time'id='end_time'   type="date" class="form-control  border small"  aria-label="Search" aria-describedby="basic-addon2" placeholder="YYYY-MM-DD HH:mm" required value="<?=isset($end_time)?$end_time:''?>">
                                    <input name='end_time'id='endTime'   type="time" class="form-control  border small"  aria-label="Search" aria-describedby="basic-addon2" placeholder="YYYY-MM-DD HH:mm" required value="<?=isset($end_time)?$end_time:''?>">
                                  
                                    <div class="input-group-append">
                                        <span class="btn btn-info" type="button">
                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                    </div>
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

                               
                             <label>Departure</label>
                                    <div class="input-group " >
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
                                            header("Location: uiupdate.php");
                                        }
                                    } else {
                                    }
                                    ?>

                                    <?php    
                                    
                                    $name = '';
                                    $placeList = "SELECT fluid_place.id as dep_id ,fluid_user.id,fluid_user.id_subcompany ,name from
                                    fluid_place inner join fluid_user on fluid_place.id_user = fluid_user.id
                                     where fluid_user.id_subcompany = ? and name != ? order by fluid_place.id desc";
                                     $stmt = $connection->prepare($placeList);
                                     $stmt->bind_param('is',$id_subcompany,$name);
                                     $stmt->execute();
                                     $result =  $stmt->get_result();
                                     $placeListRowNotEmpty = $result->num_rows;
                                     if($placeListRowNotEmpty){
                                        echo  '
                                        <div class="input-group">
                                        <select id="departure" class="myselect form-control" name="destination"  >
                                        ';  
                                        while( $places = $result->fetch_assoc()){
                                            echo'<option value="'.$places['dep_id'].'" >'.$places['name'].'</option>';
                                         } 
                                         echo ' </select>
                                         <div class="input-group-append">
                                        <button type="button" class="btn btn-primary btn-number" data-type="plus" data-target="#addModal" data-toggle="modal">
                                            <span class="fa fa-plus"></span>
                                            </button>
                                                        </span>
                                        </div>
                                         ';

                                     }


                                    
                                    ?>
                                    

                                   

                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

                            <?php
                            $sq = "SELECT * FROM fluid_status";
                            $rslt = mysqli_query($connection, $sq); ?>

                            <label>Status</label>
                            <select name="status" id='status' class="form-control">

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
                                <select name="name_dep" id="name_dep" class="form-control">
                                    <?php
                                    while ($row = mysqli_fetch_array($rst)) {
                                        echo '<option value="' . $row['id'].'"'.((isset($departments_id) and ($departments_id==$row['id']))?'selected':' ') . ' > ' . $row['name_dep'] . '</option>';

                                    }
                                    echo '</select>';
                                    ?>
                                    <label>description</label>
                                    <div class="required-field-block">
    <textarea rows="3" class="form-control" name="description" id='description' placeholder=""
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
                                    
                                    <label>Destination</label>
                                    <?php 
                                      $name = '';
                                     $placeList = "SELECT fluid_place.id as dep_id ,fluid_user.id,fluid_user.id_subcompany ,name from
                                     fluid_place inner join fluid_user on fluid_place.id_user = fluid_user.id
                                      where fluid_user.id_subcompany = ? and name != ? order by fluid_place.id desc";
                                      $stmt = $connection->prepare($placeList);
                                      $stmt->bind_param('is',$id_subcompany,$name);
                                      $stmt->execute();
                                      $result =  $stmt->get_result();
                                      $placeListRowNotEmpty = $result->num_rows;
                                      if($placeListRowNotEmpty){
                                        echo  '
                                        <div class="input-group " >
                                        <select id="destination" class="myselect form-control" name="destination"  >
                                        '; 
                                        while( $places = $result->fetch_assoc()){
                                            echo'<option value="'.$places['dep_id'].'" >'.$places['name'].'</option>';
                                         } 
                                         echo ' </select>
                                         <div class="input-group-append">
                                           <button type="button" class="btn btn-info btn-number" data-type="plus" data-target="#addModal"
                                                data-toggle="modal"><span class="fa fa-plus"></span>
                                        </button>
                                                        </span>
                                        </div>
                                         ';


                                      }


                                    
                                    ?>

                                    




                                    
                                
                                    <?php


                                    ?>
                        </div>
                    </div>

                    <div class="row pad-top">

                        <div class="col-lg-12 col-lg-offset-2">
                            <div class="form-group">
                                <span class="form-control btn btn-primary btn-lg"  id="book" >Book</span>
                            </div>
                        </div>
                    </div>
                </form>


            </div>

        </div>
        <!-- End Register Box -->
    

<div class="container">

    <div class="row">


        <div class="modal" id="addModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header  align-items-center d-flex justify-content-between">
                    <h4 class="modal-title">add place</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                    class="fa fa-times"></i></button>
                        
                    </div>


                    <div class="modal-body">

                        <form action="booking.php" method="post">


                            <div class="form-group">
                                <label class="col-sm-4 control-label">place</label>
                                <input type="text" class="form-control"  name="departure" placeholder="Enter place"></div>
                            <div class="form-group">
                                <div class="select-container ">
                                    <label class="col-sm-2 control-label" placeholder="sector">sector</label>
                                    <?php

                                    $sq = "SELECT id,name FROM fluid_sector order by name asc";
                                    $rslt = mysqli_query($connection, $sq);
                                    ?>


                                    <select name="name" class="'select2 form-control col-sm-2'">

                                    <?php
                                    while ($row = mysqli_fetch_array($rslt)) {
                                        echo ' <option value=' . $row['id'] . ' >  ' . $row['name'] . '</option> ';
                                    }
                                    echo '</select>';
                                    ?></div>

                                <label class="col-sm-4 control-label">contract</label>
                                <input type="text" class="form-control"  name="aboutcontract"></div>

                            <div class="modal-footer d-flex justify-content-between align-items-center  ">
                                <button type="submit" class="btn btn-primary pull-left">Save</button>
                                
                        </form>
                        <button  class="btn btn-danger" data-dismiss="modal" role="button">Close</button>
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
</script>

<?php
 }
 else{
     echo'try again';
 }
 ?>

           
   