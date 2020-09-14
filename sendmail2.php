<?php ob_start(); //include('authenticate.php'); ?>
<?php 
session_start();

if(!isset($_SESSION["username"])){
    header("Location: uiupdate.php");
    exit(); }
    
    include('connexion.php');
    //require_once "Mail.php";
?>
<?php

if(isset($_POST['email'])) {
//var_dump($_POST) ;
    $from = "info@ishyiga.net";
    $to = "kimainyi@gmail.com";
    $subject = "tomorrow's report";
    $message = "
    <html>
        <head>
        <title>report</title>
        </head>
        <body>";

        

             $strsql="SELECT SUM(kilometers) AS 'TOTAL'
                                FROM fluid_booking
                                INNER JOIN fluid_place AS place1 on fluid_booking.id_place0=place1.id
                                INNER JOIN fluid_place AS place2 on fluid_booking.id_placef=place2.id
                                INNER JOIN fluid_sector AS sector1 ON place1.id_sector0=sector1.id
                                INNER JOIN fluid_sector AS sector2 ON place2.id_sector0=sector2.id
                                INNER JOIN fluid_distance ON (sector1.id=fluid_distance.id_sector0 AND  sector2.id=fluid_distance.id_sectorf)
                                WHERE rank='comfirmed' AND (DATE(fluid_booking.start_time)=CURDATE() + INTERVAL 1 DAY)";
                        
                        $res=mysqli_query($connection,$strsql);
                        $row=mysqli_fetch_array($res);
                        $body ="TOTAL kilometer is: ".$row["TOTAL"]."<br>";


                     if (mysqli_num_rows ($res)>0) {

                           

                             echo $strsql2="SELECT (SUM(kilometers)/10*1050) AS 'FRW'
                                FROM fluid_booking
                                INNER JOIN fluid_place AS place1 on fluid_booking.id_place0=place1.id
                                INNER JOIN fluid_place AS place2 on fluid_booking.id_placef=place2.id
                                INNER JOIN fluid_sector AS sector1 ON place1.id_sector0=sector1.id
                                INNER JOIN fluid_sector AS sector2 ON place2.id_sector0=sector2.id
                                INNER JOIN fluid_distance ON (sector1.id=fluid_distance.id_sector0 AND  sector2.id=fluid_distance.id_sectorf)
                                WHERE rank='comfirmed' AND (DATE(fluid_booking.start_time)=CURDATE() + INTERVAL 1 DAY)";
                        
                        $res2=mysqli_query($connection,$strsql2);
                        $row=mysqli_fetch_assoc($res2);
                        $body = "FUEL NEEDED is: ".$row["FRW"]."<br>";}


            $sql3 = "SELECT fluid_booking.id,fluid_booking.id_user,fluid_booking.start_time,place2.name,rank,place1.name,place2.name,sector1.name,sector2.name,kilometers
                                FROM fluid_booking
                                INNER JOIN fluid_place AS place1 on fluid_booking.id_place0=place1.id
                                INNER JOIN fluid_place AS place2 on fluid_booking.id_placef=place2.id
                                INNER JOIN fluid_sector AS sector1 ON place1.id_sector0=sector1.id
                                INNER JOIN fluid_sector AS sector2 ON place2.id_sector0=sector2.id
                                INNER JOIN fluid_distance ON (sector1.id=fluid_distance.id_sector0 AND  sector2.id=fluid_distance.id_sectorf)
                                WHERE rank='comfirmed' AND (DATE(fluid_booking.start_time)=CURDATE() + INTERVAL 1 DAY)";
                    $res3=mysqli_query($connection,$sql3);
                    $row=mysqli_fetch_assoc($res3);

                            




            //$result = $databaseConnection->query($sql);

            $body .= "<table class='TFtable' border='1' style='width':100%>"; //starts the table tag
            $body .= "<tr><td>Booking ID</td><td>employee</td><td>Start Time</td><td>In</td><td>End Time</td><td>destination</td><td>kilometers</td></tr>"; //sets headings
            while($row = $res3->fetch_assoc()) { //loops for each result
            $body .= "<tr><td>".$row['id']."</td><td>".$row['username']."</td><td>".$row['start_time']. "</td><td>".$row['end_time']."</td><td>".$row['name']."</td><td>".$row['kilometers']."</td>";

            }
            $body .= "</table>"; //closes the table
            $message .= $body . "
            </body>
            </html>";
            
            //$message = wordwrap($message, 70);    
            //mail($to,$subject,$message,$headers);

        }

    ?>
    







                         
                        
                    

                   
             


	