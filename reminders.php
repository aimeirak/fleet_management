<?php
include('connexion.php');
date_default_timezone_set('Africa/Kigali');
$sql = "    SELECT fluid_user.full_name,fluid_car.id_driver,fluid_booking.id as booking_id,fluid_car.id as car_id,fluid_car.plaque,start_time,end_time,username,a.name AS 'departure',b.name AS 'destination' ,rank,description 
            FROM `fluid_booking` inner join fluid_user on fluid_user.id=fluid_booking.id_user 
            JOIN fluid_place AS a ON fluid_booking.id_place0=a.id JOIN fluid_place AS b ON fluid_booking.id_placef=b.id 
            inner join fluid_car on fluid_booking.car_id=fluid_car.id 
            WHERE rank IN ('confirmed') AND fluid_booking.end_time>=NOW()
            ORDER BY end_time DESC ";

$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $today = date('Y-m-d h:i:s');

        $d1 = new DateTime($row['start_time']);
        $d2 = new DateTime($today);
        $interval = $d2->diff($d1);
        $minutes=calculateMinutes($interval);

         $minutes . '</br>';
        if ($minutes<=30) {
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $sql2 = "SELECT * from fluid_user where id=" . $row['id_driver'];
            $result2 = mysqli_query($connection, $sql2);
            if (mysqli_num_rows($result2) > 0) {
                $driver= mysqli_fetch_array($result2);
                //var_dump($driver);
            } else {
                exit;
            }

            echo $to = $driver['email'];

            $subject = 'Ride about to start';

            echo $message = '
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
                    <p>
                      It\'s time for Booking #'.$row['booking_id'].' Please get ready. </br>
                      Please click start if you are ready to start the ride.
                    </p>
                    <h4>Booking information</h4>
                    <table style="width:100%">
                      <tr>
                        <td>Employee</td>
                        <td>' . $row['full_name']. '</td>
                      </tr>
                      <tr>
                        <td>Fom</td>
                        <td>' . $row['departure'] . '</td>
                      </tr>
                      <tr>
                        <td>To</td>
                        <td>' . $row['destination'] . '</td>
                      </tr>
                      <tr>
                        <td>Start time</td>
                        <td>' . $row['start_time']. '</td>
                      </tr>
                      <tr>
                        <td>End time</td>
                        <td>' . $row['end_time'] . '</td>
                      </tr>
                      <tr>
                        <td>Comments</td>
                        <td>' . $row['description'] . '</td>
                      </tr>
                      <tr>
                        <td><h1></h1></td>
                      </tr>
                    </table>
                    
                    <a class="button" href="http://ishyiga.rw/fleet/driver_index.php">Go to app and start the trip </a>
                    </body>
                    </html>';
          //  $res = mail($to, $subject, $message, $headers);
        }
    }
}

function calculateMinutes(DateInterval $int){
    $days = $int->format('%a');
    return ($days * 24 * 60) + ($int->h * 60) + $int->i;
}
