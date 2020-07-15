"INSERT into `user` (username,full_name,email,phone_number,pasword, trn_date)
VALUES ('$username','$full_name','$email','$phone_number',".md5($password).",'$trn_date')";






<?php
$con=mysqli_connect("localhost","my_user","my_password","my_db");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }






  $con=mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db($db_name,$con)or die("cannot select DB");
?>
 <span class="input-group-addon">@</span>









                         
                                <select name="name" class="form-control">

                                
<?php
while($row = mysqli_fetch_array($con,$rs))
{
?>
 <option value="<?php echo $row['name'].""; ?> " > <?php echo $row['name'].""; ?> </option>";
 <?php
}
?>









 <div class="row">
                <div class="col-lg-4 col-md-4">
                       <div class="input-group">
                       
                          
                <label>full_name</label><input type="text" class="form-control"  />
 </div>
                                
                               <div>
                                <label>start_time</label>
                                <input  class="form-control" type="timestamp" name="timestamp">
                                </div>
                                <label>
                                end_time</label>
                                <input class="form-control" type="timestamp" name="timestamp">
                                <label>from</label><input class="form-control" type="text" name="departure_master">
                                <label>to</label><input class="form-control" type="text" name="destination_master">








<form name="BOOKING" action="booking.php" method="post">
<br><input type="text" name="full_name" placeholder="full_name" required /></br>
<br><input type="datetime" name="start_time" placeholder="start_time" required /></br>

<br><input type="datetime" name="end_time" placeholder="end_time" required /></br>
<br><input type="text" name="departure_master" placeholder="departure_master" required /></br>
<br><input type="text" name="destination_master" placeholder="destination_master" required /></br>
<br><input type="text" name="reason" placeholder="reason" required /></br>
<br><input type="text" name="status" placeholder="status" required /></br>

<br><input type="submit" name="submit" value="Register"></br>

</form>