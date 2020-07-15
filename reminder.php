<?php
//$id_subcompany = 3;
include('connexion.php');

$sql = "SELECT * from fluid_car";
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $today=date('Y-m-d');

        $d1 =new DateTime($row['insurance_date']);
        $d2 =new DateTime($today) ;
        $interval = $d2->diff($d1);
        $days=(int)$interval->format('%R%a');

        //echo $days . '</br>';
        if($days==30 || $days==15 || $days==5 ){
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $sql2="SELECT * from fluid_user where role=20 and id_subcompany=".$row['id_subcompany'];
            $result2 = mysqli_query($connection, $sql2);
            if (mysqli_num_rows($result2) > 0) {
                $admin = mysqli_fetch_array($result2);
            }
            else{exit;}

            //echo $to = $admin['kimainyi@gmail.com','izababelle@gmail.com'];
            
            
            $admins=['izababelle@gmail.com,kimainyi@gmail.com,nzajos3@gmail.com'];
            $subject = 'Insurance reminder';

            echo $message = '
                <html>
                <head>
                </head>
                <body>
                <h1>Insurance of car '.$row['plaque'].' will be expired in '.$days.' days</h1>
                </body>
                </html>';

            foreach($admins as $to){

                $res=mail($to, $subject, $message, $headers);
                if($res) echo "Email sent to ".$to;
            }
        }

        $d1 =new DateTime($row['control_technique_date']);
        $interval = $d2->diff($d1);
        $days=(int)$interval->format('%R%a');

        if($days==-19 || $days==-20 || $days==-21 ){
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $sql2="SELECT * from fluid_user where role=20 and id_subcompany=".$row['id_subcompany'];
            $result2 = mysqli_query($connection, $sql2);
            if (mysqli_num_rows($result2) > 0) {
                $admin = mysqli_fetch_array($result2);
            }
            else{exit;}
            
            $admins=['izababelle@gmail.com,kimainyi@gmail.com,nzajos3@gmail.com'];

            //echo $to = $admin['kimainyi@gmail.com','izababelle@gmail.com','nzajos3@gmail.com'];
            $subject = 'Control technique reminder';

            echo $message = '
                <html>
                <head>
                </head>
                <body>
                <h1>Controle technique of car '.$row['plaque'].' has been expired in '.$days.' days</h1>
                </body>
                </html>';
                
            foreach($admins as $to){

                $res=mail($to, $subject, $message, $headers);
                if($res) echo "Email sent to ".$to;
            }
        }

    }
}

