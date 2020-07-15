<?php //ob_start();
include('authenticate.php'); ?>

<?php include('connexion.php'); ?>
<?php //include('header.php');?>

<?php
$id_subcompany = $_SESSION['sub_company'];
$id_user = $_SESSION['id'];

?>


<div id="page-wrapper">
    <div id="page-inner">
        <h2>My Trips</h2>
        <div class="row">


            <div class="col-md-12">

            </div>
        </div>

        <div class="row" style="padding:10px;">
            <?php
            if (isset($_GET["success"])) {
                echo "<div class=\"alert alert-success alert-dismissable\">
                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                        <strong>Success!</strong>Car successfully updated.
                      </div>
                ";
            }

            if (isset($_GET["update_location"])) {
                echo "<div class=\"alert alert-success alert-dismissable\">
                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                        <strong>Success!</strong>Car location successfully updated and trip in progress.
                      </div>
                ";
            }
            ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover display" id="datatable1" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>plaque</th>
                        <th>Start time</th>
                        <th>End time</th>
                        <th>User</th>
                        <th>Depature</th>
                        <th>Destination</th>
                        <th></th>
                    </tr>
                    </thead>
                    <body>
                    <?php

                    $STRsql = "
                                SELECT fluid_booking.id as booking_id,fluid_car.id as car_id,fluid_car.plaque,start_time,end_time,username,a.name AS 'departure',b.name AS 'destination' ,rank 
                                FROM `fluid_booking` inner join fluid_user on fluid_user.id=fluid_booking.id_user 
                                JOIN fluid_place AS a ON fluid_booking.id_place0=a.id JOIN fluid_place AS b ON fluid_booking.id_placef=b.id 
                                inner join fluid_car on fluid_booking.car_id=fluid_car.id 
                                WHERE rank IN ('confirmed','ongoing','done')   AND fluid_car.id_driver=" . $id_user . "
                                ORDER BY end_time DESC
                              ";

                    $result2 = mysqli_query($connection, $STRsql);

                    if (mysqli_num_rows($result2) != '' || mysqli_num_rows($result2) > 0) {
                        while ($row = mysqli_fetch_array($result2)) {
                            echo(
                                '
                                    <tr>' .
                                '<td>' . $row["plaque"] . '</td>' .
                                '<td>' . $row["start_time"] . '</td>' .
                                '<td>' . $row["end_time"] . '</td>' .
                                '<td>' . $row["username"] . '</td>' .

                                '<td>' . $row["departure"] . '</td>' .
                                '<td>' . $row["destination"] . '</td><td>'
                            );

                            if ($row['rank'] == 'confirmed') {
                                echo '<button class="btn start btn-success" data-car="' . $row['car_id'] . '" data-booking="' . $row['booking_id'] . '">Start</button>';
                            }

                            if ($row['rank'] == 'ongoing') {
                                echo '<button class="btn stop btn-danger" data-car="' . $row['car_id'] . '" data-booking="' . $row['booking_id'] . '">Stop</button>';
                            }

                            if ($row['rank'] == 'done') {
                                echo '<label><i class="fa fa-2x fa-check"></i></label>';
                            }
                            echo('</td> </tr>');
                        }
                    }

                    ?>


            <script>
                $(document).ready(function () {
                    $(".start").click(function () {
    $el = $(this);
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var geocoder;
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            var latlng = new google.maps.LatLng(lat, lng);

            geocoder = new google.maps.Geocoder();

            geocoder.geocode({'latLng': latlng}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {

                    console.log('Reverse Geocoding:');
                    console.dir(results);

                    $('#reverseGeocodingResult_formatted_address').text(results[0].formatted_address);
                    console.log('Address components:');
                    console.dir(results[0].address_components);
                    var temp = [];
                    for (var i = 0; i < results[0].address_components.length; i++) {
                        console.log(results[0].address_components[i]);
                        if ($.inArray(results[0].address_components[i].long_name, temp) === -1) {
                            temp.push(results[0].address_components[i].long_name);
                        }
                        if ($.inArray(results[0].address_components[i].short_name, temp) === -1) {
                            temp.push(results[0].address_components[i].short_name);
                        }
                    }
                    //console.log('Address components (elaborati):');
                    window.location.replace("http://localhost:8888/test_car/" + "update_car_location.php?action=start&location=" + temp + "&car=" + $el.data("car") + "&booking=" + $el.data("booking"));
                    $('#reverseGeocodingResult_address_components').html(temp.join('<br>'));

                } else {
                    alert("Geocoder failed due to: " + status);
                }
            });
        });
    } else {
    console.log("Browser doesn't support geolocation!");
}
});

    $(".stop").click(function () {
        $el = $(this);
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geocoder;
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                var latlng = new google.maps.LatLng(lat, lng);

                geocoder = new google.maps.Geocoder();

                geocoder.geocode({'latLng': latlng}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {

                        console.log('Reverse Geocoding:');
                        console.dir(results);

                        $('#reverseGeocodingResult_formatted_address').text(results[0].formatted_address);
                        console.log('Address components:');
                        console.dir(results[0].address_components);
                        var temp = [];
                        for (var i = 0; i < results[0].address_components.length; i++) {
                            console.log(results[0].address_components[i]);
                            if ($.inArray(results[0].address_components[i].long_name, temp) === -1) {
                                temp.push(results[0].address_components[i].long_name);
                            }
                            if ($.inArray(results[0].address_components[i].short_name, temp) === -1) {
                                temp.push(results[0].address_components[i].short_name);
                            }
                        }

                        //console.log('Address components (elaborati):');
                        window.location.replace("http://localhost:8888/test_car/" + "update_car_location.php?action=stop&location=" + temp + "&car=" + $el.data("car") + "&booking=" + $el.data("booking"));
                        //$('#reverseGeocodingResult_address_components').html(temp.join('<br>'));

                    } else {
                        alert("Geocoder failed due to: " + status);
                    }
                });
            });
        } else {
            console.log("Browser doesn't support geolocation!");
        }
                            });

                        });
                    </script>

                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfUElaIdU1b56bjx-TAZsZpxf9q7HejCc&amp;v=3.exp&amp;sensor=false&amp;language=en"
                            type="text/javascript"></script>
                <script>

        $(document).ready(function () {
            var geocoder;
            var map;

            $('#reverseGeocoding').click(function () {

                var lat = -1.9467661;
                var lng = 30.069915499999997;
                var latlng = new google.maps.LatLng(lat, lng);

                geocoder = new google.maps.Geocoder();

                geocoder.geocode({'latLng': latlng}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {

                        console.log('Reverse Geocoding:');
                        console.dir(results);

                        $('#reverseGeocodingResult_formatted_address').text(results[0].formatted_address);

                        // address components: recupero di tutti gli elementi
                        console.log('Address components:');
                        console.dir(results[0].address_components);

                        var temp = [];
                        for (var i = 0; i < results[0].address_components.length; i++) {

                            console.log(results[0].address_components[i]);

                            if ($.inArray(results[0].address_components[i].long_name, temp) === -1) { // evita potenziali duplicati
                                temp.push(results[0].address_components[i].long_name);
                            }
                            if ($.inArray(results[0].address_components[i].short_name, temp) === -1) { // evita potenziali duplicati
                                temp.push(results[0].address_components[i].short_name);
                            }
                        }

                        console.log('Address components (elaborati):');
                        console.dir(temp);
                        $('#reverseGeocodingResult_address_components').html(temp.join('<br>'));

                    } else {
                        alert("Geocoder failed due to: " + status);
                    }
                });
            });

        });

                    </script>


                    </body>
                </table>
            </div>


            <?php


            if (isset($_POST['plaque'])) {

                $id_subcompany = $_SESSION['sub_company'];

                $car = stripslashes($_POST['plaque']);
                $driver = stripslashes($_POST['driver']);

                $sql = "
                    UPDATE fluid_car 
                    SET id_driver=" . $driver . "
                    WHERE id=" . $car . "
                ";

                $result = mysqli_query($connection, $sql);


                if ($result > 0) {
                    header('Location: ' . "cardriver.php?success");

                }
            } else {
                header("carlist.php");

            }

            ?>

            <div class="container">

                <div class="row">


<div class="modal" id="addModal" tabindex="-1" role="dialog">
<div class="modal-dialog">
<div class="modal-content">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i
                    class="fa fa-times"></i></button>
        <h4 class="modal-title">Car - Driver</h4>
    </div>


    <div class="modal-body">

        <form action="cardriver.php" method="post">

            <div class="form-group">
                <label class="col-sm-2 control-label">Driver</label>
                <select name="driver" class="form-control">
                    <?php
                    echo $sql2 = "SELECT id,full_name FROM fluid_user where id_subcompany='" . $id_subcompany . "' and role=30";
                    $rs2 = mysqli_query($connection, $sql2);
                    ?>
                    <?php
                    while ($row = mysqli_fetch_array($rs2)) {
                        echo '<option value=' . $row['id'] . ' >  ' . $row['full_name'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Car</label>
                <select name="plaque" class="form-control">
                    <?php
                    $standard = 'Available';
                    $sql2 = "SELECT id,id_subcompany,plaque,standard FROM fluid_car where id_subcompany='" . $id_subcompany . "' and standard='Available'";
                    $rs2 = mysqli_query($connection, $sql2);
                    ?>
                    <?php
                    while ($row = mysqli_fetch_array($rs2)) {
                        echo '<option value=' . $row['id'] . ' >  ' . $row['plaque'] . '</option>';
                    }
                    ?>
                </select>
            </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary pull-left">Save</button>
        </form>
        <button type="button" class="btn btn-primary" data-dismiss="modal"
                role="button">
            Close
        </button>
    </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('footer.php'); ?>

