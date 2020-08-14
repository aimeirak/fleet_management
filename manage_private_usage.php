<?php
include 'include/authant.php';
ob_start();
include 'include/header.php' ; ?>

<?php include('connexion.php');
error_reporting(E_ALL);
ini_set('display_errors', 'On');

date_default_timezone_set('Africa/Kigali');
$sql = "
            SELECT * FROM fluid_private_usage
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$to_mail = 'sezeranochrisostom123@gmail.com';
$subject = 'Car updates';

$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $today = date('Y-m-d');
        $from = date('Y-m-d', strtotime($row['from']));
        $to = date('Y-m-d', strtotime($row['to']));
        $car = $row['id_car'];

        if ($from == $today) {
            $sql = "UPDATE fluid_car SET standard='private' WHERE id=$car";
            $result = mysqli_query($connection, $sql);
            if ($result) {
                //echo "Car $car set to be used privately";
                echo $message = "
                    <html>
                    <head>
                    </head>
                    <body>
                    <p>
                      Car $car set to be used privately
                    </p>
                    </body>
                    </html>";
                $res = mail($to_mail, $subject, $message, $headers);
            }
        }
        $previous = date('Y-m-d', strtotime(' -1 day'));

        if ($previous == $to) {
            $sql = "UPDATE fluid_car SET standard='available' WHERE id=$car";
            $result = mysqli_query($connection, $sql);
            if ($result) {
                //echo "Car $car set to be used";
                echo $message = "
                    <html>
                    <head>
                    </head>
                    <body>
                    <p>
                      Car $car set to be used by all users
                    </p>
                    </body>
                    </html>";
                $res = mail($to_mail, $subject, $message, $headers);
            }
        }
    }
}


