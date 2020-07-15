<?php if(isset($_POST['MyBookings']) && $_POST['MyBookings'] == 1 || isset($_POST['book']) && $_POST['book'] == 1){
    session_start();
    ?>
    
    <?php include('../connexion.php'); ?>



<?php $id_subcompany = $_SESSION['sub_company'];
        $id_user = $_SESSION['id'];

        
?>



<div class="row">
<?php if(isset($msg) and trim($msg)!=''){?>
            
            <div class="col-md-6">
                <h2>Bookings</h2>
            </div>
            <div class="col-md-6">
                <a href="uiupdate.php"><span class="btn btn-primary pull-right" style="bottom: opx;">add</span></a>
            </div>
        </div>
       
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
                    <button id="go" class="btn btn-outline-secondary pull-right ">Go</button>
                </div>
            </div>
      
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


        <div class="row" style="padding:10px;">
            <div class="table-responsive">
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
                        <th></th>

                    </tr>
                    </thead>
                    <body>
                    <?php

                    if (isset($_POST['start_date']) and $_POST['end_date'] != '') {
                        // removes backslashes
                        //var_dump($_POST);
                        $start = stripslashes($_POST['start_date']);
                        $end = stripslashes($_POST['end_date']);


                        $STRsql = "SELECT fluid_booking.id,created_at,start_time,end_time,username,a.name AS 'departure',b.name AS 'destination',statusname,name_dep,rank,fluid_booking.id_user  FROM `fluid_booking` inner join fluid_user
                         on fluid_user.id=fluid_booking.id_user JOIN fluid_place AS a ON fluid_booking.id_place0=a.id JOIN fluid_place AS b 
                         ON fluid_booking.id_placef=b.id inner join fluid_status on fluid_status.id=fluid_booking.status_id 
                         inner join fluid_departments on fluid_departments.id=fluid_booking.Departments_id where fluid_user.id_subcompany=".$id_subcompany." AND DATE(start_time) BETWEEN '".$start."' AND '".$end."'";


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
                                        '<td>'.'<a href="booking_view.php?id='.$row['id'].' "class="btn btn-primary">Join</a>'.
                                    (($row["id_user"]==$SESSION_ID and $d1>$d2) ?(' <a href="booking_edit.php?id='.$row['id'].' "class="btn btn-success">Edit</a>'):'').'</td>'.

                                    '</tr>'
                                
                                );

                            }

                        }

                    } else {


                        $sql = "SELECT fluid_booking.id,created_at,start_time,end_time,username,a.name AS 'departure',b.name AS 'destination',statusname,name_dep,rank ,fluid_booking.id_user FROM `fluid_booking` inner join fluid_user on fluid_user.id=fluid_booking.id_user JOIN fluid_place AS a ON fluid_booking.id_place0=a.id JOIN fluid_place AS b ON fluid_booking.id_placef=b.id inner join fluid_status on fluid_status.id=fluid_booking.status_id 
                        inner join fluid_departments on fluid_departments.id=fluid_booking.Departments_id
                         where fluid_user.id_subcompany=".$id_subcompany.";
                        
                        fluid_booking.end_time>=NOW()";
                        //echo  $sql;
                        echo "All bookings<br>"; ?>
                        <?php if(isset($_GET['msg']) and trim($_GET)!=''){?>
            <div class="alert alert-danger" role="alert">
                <span class="fa fa-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <span class="msg"><?=$msg?></span>
            </div>
            <?php }elseif(isset($_GET['SENT']) and $_GET['SENT'] === 'you request is sent' ){?>
            <div class="alert alert-success" role="alert">
                <span class="fa fa-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Success:</span>
                <span class="msg"><?=$success?></span>
            </div>
                <?php }}?>
                        <?php
                        
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
                                        '<td>'.$row["rank"].'</td>'.
                                        '<td>'.'<a href="booking_view.php?id='.$row['id'].' "class="btn btn-primary">Join</a>'.
                                    (($row["id_user"]==$SESSION_ID and $d1>$d2) ?(' <a href="booking_edit.php?id='.$row['id'].' "class="btn btn-success">Edit</a>'):'').'</td>'.
                                    '</tr>'
                                
                              ) ; 
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

        </div>
        


<?php } else{?>
   <div class="alert alert-warning" >
      <p>you need to be authorized </p>
   </div>
<?php } ?>

<?php include('../include/footerui.php'); ?>