<?php if(isset($_POST['OurRouts']) && $_POST['OurRouts'] == 1){
    session_start();
    ?>
    
    <?php include('../connexion.php'); ?>


<?php $id_subcompany = $_SESSION['sub_company'];
        $id_user = $_SESSION['id'];

        
?>

<div class="row">

<div class="col-md-12">
    <a class="btn icon-btn btn-success pull-right" href="#" data-target="#addModal"
       data-toggle="modal"><span
                class="glyphicon btn-glyphicon glyphicon-plus img-circle text-success"></span>Add</a>


    <?php
    if (isset($_GET["success"])) {
        echo "<div class=\"alert alert-success alert-dismissable\">
<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
<strong>Success!</strong> Distance successfully added.
</div>";
    }
    ?>
    <h2>Routes</h2>
    <hr>

    <h5><bold>Please select departure</bold></h5>


    <form id="myForm" method="post" action="distance.php" class="search-form">
        <div class="form-group has-feedback">
            <label for="search" class="sr-only">Select depart</label>
        </div>
        <div>
            <select class="myselect" name="place" class="col-lg-12 col-xs-12">

            </select>

        </div>


    </form>

    <hr>


    <div class="row" style="padding:10px;">

        <table id="datatable1" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>

                <th>From</th>
                <th>to</th>
                <th>Km</th>
                <th></th>


            </tr>
            </thead>
            <tbody>

            <?php
            if (isset($_POST['submit'])) {
                //var_dump($_POST);
                $name = stripslashes($_POST['search']);
                //var_dump($name);


                $sql1 = "SELECT fluid_distance.id,place1.name AS a,place2.name AS b,kilometers
    FROM fluid_distance
   
    INNER JOIN fluid_place AS place1 on fluid_distance.id_sector0=place1.id
    INNER JOIN fluid_place AS place2 on fluid_distance.id_sectorf=place2.id where a=" . $name . " ORDER BY fluid_distance.id ASC";
                $result1 = mysqli_query($connection, $sql1);
                //$row = mysqli_fetch_assoc($result1);
                //var_dump($row);
                if (mysqli_num_rows($result1) > 0) {
                    // output data of each row
                    while ($row = mysqli_fetch_assoc($result1)) {


                        echo(

                            '

                        <tr>' .

                            '<td>' . $row["id"] . '</td>' .
                            '<td>' . $row["a"] . '</td>' .
                            '<td>' . $row["b"] . '</td>' .
                            '<td>' . $row["kilometers"] . '</td>' .
                            '<td>' . '<a href="upkilometers.php?id=' . $row["id"] . '"; class="btn btn-default">update</a>' . '</td>' .

                            '</tr>
                    '
                        );

                    }


                }
} else {

//$result1 = mysqli_query($connection, $sql1);
if (isset($_POST['place'])) {
    $place = $_POST['place'];
    $sql3 = "SELECT fluid_user.id_subcompany,fluid_place.id,fluid_place.id_user,fluid_place.name,fluid_place.id_sector0 FROM fluid_place INNER JOIN fluid_user on fluid_place.id_user=fluid_user.id where id_subcompany=" . $id_subcompany . " and fluid_place.id=" . $place;
    $res = mysqli_query($connection, $sql3);
    $rows1 = [];
    while ($row = mysqli_fetch_array($res)) {
        $rows1[] = $row;
    }

} else {
    $sql3 = "SELECT fluid_user.id_subcompany,fluid_place.id,fluid_place.id_user,fluid_place.name,fluid_place.id_sector0 FROM fluid_place INNER JOIN fluid_user on fluid_place.id_user=fluid_user.id where id_subcompany=" . $id_subcompany . " ORDER BY fluid_place.id LIMIT 1";
    $res = mysqli_query($connection, $sql3);
    $rows1 = [];
    while ($row = mysqli_fetch_array($res)) {
        $rows1[] = $row;
    }
}


$sql3 = "SELECT fluid_user.id_subcompany,fluid_place.id,fluid_place.id_user,fluid_place.name,fluid_place.id_sector0 FROM fluid_place INNER JOIN fluid_user on fluid_place.id_user=fluid_user.id where id_subcompany=" . $id_subcompany;
$res = mysqli_query($connection, $sql3);
$rows = [];
while ($row = mysqli_fetch_array($res)) {
    $rows[] = $row;
}

$routes = [];
foreach ($rows1 as $from) {
    foreach ($rows as $to) {
        if ($from != $to) {
            $sql = "SELECT kilometers FROM fluid_distance WHERE id_sector0=" . $from['id_sector0'] . " AND id_sectorf=" . $to['id_sector0'];
            $res = mysqli_query($connection, $sql);
            $row = mysqli_fetch_array($res);
            $km = $row['kilometers'];
            $routes[] = [
                'from' => $from['name'],
                'from_id' => $from['id_sector0'],
                'to' => $to['name'],
                'to_id' => $to['id_sector0'],
                'km' => $km,
            ];

        }
    }
}

foreach ($routes as $row) {


    echo(

        '


<tr>' .
        '<td>' . $row["from"] . '</td>' .
        '<td>' . $row["to"] . '</td>' .
        '<td>' . $row["km"] . '</td>' .
        '<td class="text-center">' . '<a href="upkilometers.php?from_id=' . $row["from_id"] . '&to_id=' . $row['to_id'] . '&from=' . $row['from'] . '&to=' . $row['to'] . '"; class="btn btn-default">update</a>' . '</td>' .

        '</tr>
'
    );

}

}


            ?>
            </tbody>
        </table>

    </div>
</div>
</div>

<!-- /. ROW  -->


<?php

if (isset($_POST['submit'])) {

$id_user = $_SESSION['id'];
$id_sector0 = stripslashes($_POST['sector1']);
$id_sectorf = stripslashes($_POST['sector2']);
$kilometers = stripslashes($_POST['kilometers']);

//$from = mysqli_real_escape_string($connection,$from);

$sql = "INSERT into fluid_distance (id_user,id_sector0,id_sectorf,kilometers) values(" . $id_user . ",'" . $id_sector0 . "'," . $id_sectorf . ",'" . $kilometers . "')";

$result = mysqli_query($connection, $sql);
//var_dump($result);


if ($result) {
    header("Location: distance.php?success");
}
} else {

}


?>

<div class="col-md-12">


<div class="container">

<div class="row">


<div class="modal" id="addModal" tabindex="-1" role="dialog">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
    class="fa fa-times"></i></button>
<h4 class="modal-title">Add Distance</h4>
</div>


<div class="modal-body">

<form action="distance.php" method="post">

<div class="input-group">
<?php

$sq = "SELECT id,name FROM fluid_sector";
$rslt = mysqli_query($connection, $sq); ?>

<br><label>sector1</label><br>
<select name="sector1" class="form-control">
    <?php
    while ($row = mysqli_fetch_array($rslt)) {
        echo '
<option value=' . $row['id'] . ' >  ' . $row['name'] . '</option>
';
    }
    ?>

</select>

</div>
<div class="input-group">
<?php

$sq = "SELECT id,name FROM fluid_sector";
$rslt = mysqli_query($connection, $sq); ?>

<br><label>sector2</label><br>
<select name="sector2" class="form-control">
    <?php
    while ($row = mysqli_fetch_array($rslt)) {
        echo '
<option value=' . $row['id'] . ' >  ' . $row['name'] . '</option>
';
    }
    ?>

</select>


</div>
<br><label>kilometers</label><br><input type="text" name="kilometers"
                                    required><br>
<br><input type="submit" name="submit" value="register"></a><br>
<div class="modal-footer">
<button type="submit" class="btn btn-primary pull-left">Save</button>
</form>
<button type="button" class="btn btn-primary" data-dismiss="modal" role="button">
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


<?php
 $sql = "SELECT fluid_place.id,name FROM fluid_place INNER JOIN fluid_user ON fluid_place.id_user=fluid_user.id WHERE fluid_user.id_subcompany=".$_SESSION['sub_company'];
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

    $('.myselect').on('select2:select', function (e) {

        $("#myForm").submit();

    });
</script>


<?php } else{?>
   <div class="alert alert-warning" >
      <p>you need to be authorized </p>
   </div>
<?php } ?>

<?php include('../include/footerui.php'); ?>