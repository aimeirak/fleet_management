
	   <tr> <td ><?php echo $row['id'].""; ?></td>  
	   <td ><?php echo $row['id_user']."" ; ?></td> 
	   <td ><?php echo $row['start_time'] . ""; ?></td>
	   <td ><?php echo $row['end_time']."" ; ?></td>
	   <td ><?php echo $row['id_destination_master']."" ; ?></td>
	   <td ><?php echo $row['id_departure_master']."" ; ?></td>
	   

	 <?php 
	 //} 
	 ?>
    </table>
    </div>





    <?php
                     $strSQL = "SELECT * FROM `user` JOIN `booking` ON user.id = booking.id_user";

                      // Execute the query (the recordset $rs contains the result)
                      $rs = mysqli_query($con,$strSQL);

                       while ($row = mysqli_fetch_array($con,$rs)) {
                        
                        
                      ?>




                                                      <?php
$strSQL = "SELECT * FROM district";

    // Execute the query (the recordset $rs contains the result)
    $rs = mysqli_query($con,$strSQL);
    
    ?>  

                         
                                <select name="name" class="form-control">

                                
<?php
while($row = mysqli_fetch_array($con,$rs))
{
?>
 <option value="<?php echo $row['name'].""; ?> " > <?php echo $row['name'].""; ?> </option>";
 <?php
}
?>
</select>
<label>to
                                  
                                </label>
<?php
$strSQL = "SELECT * FROM district";
$rs = mysqli_query($con,$strSQL);
?>
                                <select name="name" class="form-control">
<?
                                
while($row = mysqli_fetch_array($con,$rs))
{
?>
 <option value="<?php echo $row['name'].""; ?> " > <?php echo $row['name'].""; ?> </option>";
 <?php
?>
</select>





    $row = mysqli_fetch_array($con,$result);
if(!row) {
    return array();
}
$hn = $row["patient_hn"];
$pid = $row["patient_id"];
$datereg = $row["patient_date_register"];
$prefix = $row["patient_prefix"];
$fname = $row["patient_fname"];
$lname = $row["patient_lname"];
$age = $row["patient_age"];
$sex = $row["patient_sex"];

return array($hn,$pid,$datereg,$prefix,$fname,$lname,$age,$sex) ;





$sql = "SELECT booking.id,full_name,start_time,end_time,departure_master,destination_master FROM booking JOIN user ON booking.id_user=user.id";






<a href="updatecarloc.php? id= '.$row["id"].'";><input type="submit"value="Update" ></a>'.'</td>'




<div class="col-md-6">
                <h2>Bookings joint</h2>
            </div> 
<div class="row" style="padding:10px;">
        
            <table class="table table-striped table-bordered table-hover">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>id_booking</th>
                        <th>name_join</th>
                        <th>full_name</th>
                       
                    </tr>
                </thead>

<?php
    
    $sql="SELECT booking_row.id,id_booking,name_join,full_name from `booking_row` inner join booking on booking_row.id_booking=booking.id";
     $result = mysqli_query($connection, $sql);

      if (mysqli_num_rows($result) > 0) {
                        // output data of each row

                        while($row = mysqli_fetch_assoc($result)) {
                            //var_dump($row);

                            echo (

                                '<tbody>
                                    <tr>'.
                                        '<td>'.$row["id"].'</td>'.
                                        '<td>'.$row["id_booking"].'</td>'.
                                        '<td>'.$row["name_join"].'</td>'.
                                        '<td>'.$row["full_name"].'</td>'.
                                        
                                    '</tr>
                                </tbody>'
                            );

                        }
                    } else {
                       echo "0 results";
                    }
                ?>
                
            </table> 

            
       </div>
    </div>
</div>
</div>