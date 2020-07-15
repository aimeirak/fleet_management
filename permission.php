<?php ob_start();include('authenticate.php');?>
<?php include('connexion.php');?>


 <div id="page-wrapper" >
              <div id="page-inner">
           <div class="col-lg-6 col-md-4 col-sm-12 col-xs-4">
            <div class="">
            <h3>Approave</h3>
        <div class="row" class="col-lg-6">

<form class="form-horizontal" method="POST" >
      <label for="permission"> permit : </label>
      <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
         <select id="cmbMake" name="Make" >
             <option value="pending">pending</option>
             <option value="confirmed">confirmed</option>
             <option value="rejected">rejected</option>
       </select>
         <input type="submit" name="submit" value="update" class="btn btn-defaut">
         
        
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
        

      <?php include('footer.php');?>