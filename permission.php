<?php ob_start();
include('include/header.php');
include('include/authant.php'); ?>
<?php include('connexion.php'); ?>



<?php
if ($_SESSION['role'] != 20) {
    header("location: uiupdate.php");}
?>

 
<title><?= $_SESSION['blancName'] ?>(<?=$_SESSION['branchLocation']?>)</title>
</head>  
<body id="page-top">
<div id="wrapper">
<!--sidbar start -->
<?php include 'include/navbar.php'; ?>
<!--sidbar end--><div id='content-wrapper' class="d-flex flex-column">
    <?php
    require_once('include/topbon.php');
    ?>
    
              <div id="page-inner" >
           <div class="col-lg-6 col-md-4 col-sm-12 col-xs-4 p-3 ml-2">
            <div class="">
            <h3>Approave</h3>
        <div class="row" >

<form class="" method="POST" >
      <label class="lebal-control" for="permission"> permit : </label>
      <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
         <select class='form-control d-inline'  id="cmbMake" name="Make" >
             <option value="pending">pending</option>
             <option value="confirmed">confirmed</option>
             <option value="rejected">rejected</option>
       </select>
         <input class='btn btn-info mt-5'  type="submit" name="submit" value="update" class="btn btn-defaut">
         
        
</form>
</div>
   <?php

        if(isset($_POST['submit']))
        {



            // $_SESSION['id']=$row['id'];
            // $id_user=
            //var_dump($row['id']);
            $makerValue = $_POST['Make']; // make value
            $id=$_POST['id']; 
            
          $sql="UPDATE fluid_booking SET rank = '".$makerValue."' WHERE id ='$id'";
            if (mysqli_query($connection,$sql)){
            

        //$row["email"]=$_GET['email'];
         $sql1="SELECT fluid_booking.id,fluid_booking.rank,fluid_user.id,fluid_booking.id_user,fluid_user.email FROM fluid_booking inner join fluid_user on fluid_booking.id_user=fluid_user.id WHERE fluid_booking.id ='$id'";
        $result=mysqli_query($connection,$sql1);
        $row=mysqli_fetch_array($result);
        $email=$row["email"];
        $rank=$row["rank"];
       if(mysqli_num_rows($result)>0){
        
           //echo $row["email"];
            $to=$row["email"];

         
            $subject="About your booking";

            $message="your booking has been ".$rank."" ;
            mail($to,$subject,$message);
           //echo $email;
            //echo "About your booking ".$rank."";

            header("Location: bookinglist.php");

        } else {
            echo "Error updating record: " . mysqli_error($connection);
        }}}
                          

       
         ?>



                     
                    
                    </div>
                        </div>
                            </div>
                        </div>
                    </div>

      <?php include('include/footerui.php');?>