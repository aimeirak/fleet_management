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
        <div class="row">
            <div class="col-md-12">
                <h2>Report</h2>
            </div>
        </div>
        <?php
        $strsql="SELECT  SUM(kilometers) AS 'TOTAL',SUM((fluid_distance.kilometers/fluid_car.fuel_consumption)*1055)AS `COST`
        FROM fluid_car 
        INNER JOIN fluid_booking on fluid_booking.car_id=fluid_car.id
        INNER JOIN fluid_place AS place1 on fluid_booking.id_place0=place1.id
        INNER JOIN fluid_place AS place2 on fluid_booking.id_placef=place2.id
        INNER JOIN fluid_sector AS sector1 ON place1.id_sector0=sector1.id
        INNER JOIN fluid_sector AS sector2 ON place2.id_sector0=sector2.id
        INNER JOIN fluid_distance ON (sector1.id=fluid_distance.id_sector0 AND sector2.id=fluid_distance.id_sectorf)    
        INNER JOIN fluid_user ON fluid_booking.id_user=fluid_user.id
        INNER JOIN fluid_sub_company ON fluid_car.id_subcompany=fluid_sub_company.id
        WHERE rank IN('done','confirmed') AND (DATE(fluid_booking.start_time)=CURDATE())";

        $res=mysqli_query($connection,$strsql);
        $row=mysqli_fetch_array($res);
        $km=$row["TOTAL"];
        echo "TOTAL kilometer is: ".$row["TOTAL"]."<br>";
        $rwf=$row["COST"];
        echo "FUEL NEEDED is: ".$rwf."<br>";

        if (mysqli_num_rows ($res)>0) {

            $sql = "
                SELECT fluid_booking.id,fluid_user.full_name as employee,fluid_booking.start_time,rank,place1.name as place11 ,sector1.name,place2.name as place22,sector2.name,kilometers
                FROM fluid_booking
                INNER JOIN fluid_user on fluid_booking.id_user=fluid_user.id
                INNER JOIN fluid_place AS place1 on fluid_booking.id_place0=place1.id
                INNER JOIN fluid_place AS place2 on fluid_booking.id_placef=place2.id
                INNER JOIN fluid_sector AS sector1 ON place1.id_sector0=sector1.id
                INNER JOIN fluid_sector AS sector2 ON place2.id_sector0=sector2.id
                INNER JOIN fluid_distance ON (sector1.id=fluid_distance.id_sector0 AND  sector2.id=fluid_distance.id_sectorf)
                WHERE rank IN('done','confirmed')  AND (DATE(fluid_booking.start_time)=CURDATE()) 
            ";
            // echo $sql;
            $body='
                <thead>
                    <tr>
                        <th style="border: 1px solid black;">Booking ID</th>
                        <th style="border: 1px solid black;">Employee</th>
                        <th style="border: 1px solid black;">From</th>
                        <th style="border: 1px solid black;">To</th>
                        <th style="border: 1px solid black;">Start Time</th>
                        <th style="border: 1px solid black;">Status</th>
                        <th style="border: 1px solid black;">kilometers</th>
                    </tr>
                </thead>
            ';
            $result = mysqli_query($connection,$sql);
            if(mysqli_num_rows($result)>0) {
                while($row_t = mysqli_fetch_array($result)) {
                    $body .= (
                        '<tbody>
                            <tr>'.
                        '<td style="border: 1px solid black;">'.$row_t["id"].'</td>'.
                        '<td style="border: 1px solid black;">'.$row_t["employee"].'</td>'.
                        '<td style="border: 1px solid black;">'.$row_t["place11"].'</td>'.
                        '<td style="border: 1px solid black;">'.$row_t["place22"].'</td>'.
                        '<td style="border: 1px solid black;">'.$row_t["start_time"].'</td>'.
                        '<td style="border: 1px solid black;">'.$row_t["rank"].'</td>'.
                        '<td style="border: 1px solid black;">'.$row_t["kilometers"].'</td>'.
                        '</tr>
                        </tbody>'
                    );
                }
            }
            $datetime = new DateTime('today');

            $message = '
            <html>
            <head>
                <title>HTML email</title>
            </head>
            <body>
            <h3> Bookings of '.$datetime->format('Y-m-d').' </h3>
            <table style="border-collapse: collapse;"';

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            //$from = "info@ishyiga.net";
            $to = "izababelle@gmail.com,kimainyi@gmail.com";
            $subject = 'Bookings of '.$datetime->format('Y-m-d');

            $message .= $body . '
            </table>
            <h3>Total Kilometers is '.$km.' Km</h3>
            <h3>Total fuel cost '.$rwf.' Rwf</h3>
            </body>
            </html>';
            //$message = wordwrap($message, 70);

            /* $headers = array(
                'From' =>'info@ishyiga.net',
                'To' => $to,
                'Subject' => $subject,
                'MIME-Version' => 1,
                'Content-type' => 'text/html;charset=iso-8859-1'
            );

            $smtp = Mail::factory('smtp', array(
                    'host' => 'ssl://smtp.gmail.com',
                    'port' => '465',
                    'auth' => true,
                    'username' => '',
                    'password' => ''
            )); */

            //$mail = $smtp->send($to, $headers, $message);
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
                    
                $subject = ' Tomorrow Bookings of ' . $datetime->format('Y-m-d');

                $sender = "ishyigasoftware900@gmail.com";
                $sender_name = "Tomorrow Bookings Reports ";
               
                include 'include/deplicatSolver/emailSender.php';
                $reportSent = sendEmail($subject,$sender,$sender_name,$to,$message);
                if($reportSent){
                $success ='Report of tomorrow is now  sent';
              
                echo '<script>window.open("report.php?success='.$success.'","_self")</script>';
                    
                }else{
                $msg ='Report not sent to the admin';
                echo '<script>window.open("report.php?msg='.$msg.'","_self")</script>';
                    
                 
                }

                }else{
                    $msg ='admin not exist' ;

                }

        }

        ?>




    </div>
</div>








<?php include('footer.php'); ?>

