<?php if(isset($_POST['allbooking']) && $_POST['allbooking'] == 1){
    session_start();
    ?>
    
    <?php include('../connexion.php'); ?>


<?php $id_subcompany = $_SESSION['sub_company'];
        $id_user = $_SESSION['id'];        
?>
<?php if(isset($msg) and trim($msg)!=''){?>
<div class="col-md-12 ">
        <h2 class="text-center" >All Bookings</h2>
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
        
     </div>
            <form method="post">
                    <div class="row">
                        <div class="form-group col-md-5">
                            <div class='input-group date' id='datetimepicker1'>
                                <input name='start_date' id="startDate" type='date' class="form-control" placeholder="From date" />
                                <span class="input-group-append btn btn-info">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-md-5">
                            <div class='input-group date' id='datetimepicker2'>
                                <input name='end_date' type='date' id="endDate" class="form-control  " placeholder="Until date" />
                                <span class="input-group-append btn btn-primary">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                        </div>
                       
                    </div>
                </form>
                
       


        
        <div class="row" style="padding:10px;" id= "loadMeUpTable" >
        
            <table class="table table-striped table-bordered table-hover display" id="datatable1" cellspacing="0"
                   width="100%">
                <thead>
                    <tr>
                        <th>#</th>
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
                if(isset($_POST['start_date']) and $_POST['end_date']!=''){
                    // removes backslashes
                    //var_dump($_POST);
                    $start=stripslashes($_POST['start_date']);
                    $end=stripslashes($_POST['end_date']);

                    
                     $sql ="SELECT fluid_booking.id,start_time,end_time,username,a.name AS 'departure',b.name AS 'destination',statusname,name_dep,rank FROM `fluid_booking` inner join fluid_user on fluid_user.id=fluid_booking.id_user JOIN fluid_place AS a ON fluid_booking.id_place0=a.id JOIN fluid_place AS b ON fluid_booking.id_placef=b.id inner join fluid_status on fluid_status.id=fluid_booking.status_id inner join fluid_departments on fluid_departments.id=fluid_booking.Departments_id WHERE fluid_user.id_subcompany=".$id_subcompany." AND DATE(start_time) BETWEEN '".$start."' AND '".$end."'";

                          echo "Bookings from ".$start." to ".$end."<br>";
                    $result = mysqli_query($connection,$sql);
                   //var_dump($result);

                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row

                        while($row = mysqli_fetch_array( $result)) {
                            //var_dump($row);

                            echo (

                                '


                                    <tr>'.

                                        '<td>'.$row["id"].'</td>'.
                                        '<td>'.$row["start_time"].'</td>'.
                                        '<td>'.$row["end_time"].'</td>'.
                                        '<td>'.$row["username"].'</td>'. 
                                
                                        '<td>'.$row["departure"].'</td>'.
                                        '<td>'.$row["destination"].'</td>'.
                                        '<td>'.$row["statusname"].'</td>'.
                                        '<td>'.$row["name_dep"].'</td>'.
                                        '<td>'.$row["rank"].'</td>'.
                                        '<td>'.'<a href="booking_view.php?id='.$row['id'].' "class="btn btn-primary">Join</a>'.'</td>'.
                                        
                                    '</tr>'
                                
                            );

                        }}
                    } else {
                    
                   $sql ="SELECT fluid_booking.id,start_time,end_time,username,a.name AS 'departure',b.name AS 'destination',statusname,name_dep,rank FROM `fluid_booking` inner join fluid_user on fluid_user.id=fluid_booking.id_user JOIN fluid_place AS a ON fluid_booking.id_place0=a.id JOIN fluid_place AS b ON fluid_booking.id_placef=b.id inner join fluid_status on fluid_status.id=fluid_booking.status_id inner join fluid_departments on fluid_departments.id=fluid_booking.Departments_id where fluid_user.id_subcompany=".$id_subcompany." AND fluid_booking.end_time>=NOW()";
                    //echo  $sql;
               echo "All bookings<br>";
                    $rS = mysqli_query($connection,$sql);
                    //var_dump($rS);
                    //die();
                   if(mysqli_num_rows($rS )>0) {
                            
                            while($row = mysqli_fetch_array($rS)) {

                echo (
                '


                    <tr>'.

                        '<td>'.$row["id"].'</td>'.
                        '<td>'.$row["start_time"].'</td>'.
                        '<td>'.$row["end_time"].'</td>'.
                        '<td>'.$row["username"].'</td>'. 
                
                        '<td>'.$row["departure"].'</td>'.
                        '<td>'.$row["destination"].'</td>'.
                        '<td>'.$row["statusname"].'</td>'.
                        '<td>'.$row["name_dep"].'</td>'.
                        '<td>'.$row["rank"].'</td>'.
                        '<td>'.'<a href="booking_view.php?id='.$row["id"].'" class="btn btn-primary">Join</a>'.'</td>'.

                        
                        
                    '</tr>
                '
            ); 
            }

        }else{
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
               
            </table> 


      
<?php } else{?>
   <div class="alert alert-warning" >
      <p>you need to be authorized </p>
   </div>
  
<?php  include('../include/footerui.php');   } ?>

 