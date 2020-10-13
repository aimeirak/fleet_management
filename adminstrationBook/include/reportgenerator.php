<?php 
include 'connexion.php';
function aGenerator(){
  $date  = new DateTime;
  $today = $date->format('Y-m-d');
  $sent  = 0; 

  //checking if there is already sent 

  $sql  = " SELECT * from fluid_report_gen where sentdate = ? ";
  $stmt = $GLOBALS['conn']->prepare($sql);
  $stmt->bind_param('s',$today);
  $stmt->execute();  
  $result = $stmt->get_result();
  $alreadySent = $result->num_rows;
  if($alreadySent){      
     while( $fetchReport = $result->fetch_assoc()){
          $sent = 1;
      }

  }else{
      //get all kms 
      
  }
  
} 
function mGenerator($from,$until){

} 
//auto generator function
aGenerator();

?>