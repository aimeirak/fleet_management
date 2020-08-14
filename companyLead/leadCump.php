<?php 
include '../connexion.php';
session_start();
if($_SESSION['userStatus'] == 'MASTER' and isset($_POST['ins']) and  $_POST['ins'] == 2){
   $companyName = $_POST['comName'];
   $Tin = $_POST['tinNum'];
   $location = $_POST['location'];
   $companyEmail = $_POST['comEmail'];
   if(empty(trim($companyName)) || empty(trim($Tin)) || empty(trim($location)) || empty($companyEmail) ){
       echo '<div class="alert alert-danger p-4 text-gray-900">You have empty field</div>';
   }else{
       $stmt = $connection->prepare('SELECT live FROM fluid_company where tin_number = ?');
       $stmt->bind_param('s',$Tin);
       $stmt->execute();
       $stmt->store_result();
       if($stmt->num_rows > 0){
        echo '<div class="alert alert-danger p-4 text-gray-900 mt-2 col-12">Tin number already exist</div>';
       $stmt->close();  
    }else{
        $live = 1 ;
        $stmt = $connection->prepare('INSERT into fluid_company (company_name,tin_number,email,location,live)values(?,?,?,?,?)');
        $stmt->bind_param('ssssi',$companyName,$Tin,$companyEmail,$location,$live);
        $stmt->execute();
        $companyCreated = $stmt->affected_rows;
        if($companyCreated){
            echo '<div class="alert alert-success p-4 text-gray-900">Company is created</div>';
            $stmt->close();             
        }else{
            echo '<div class="alert alert-danger p-4 text-gray-900">Company was not  created! please try again</div>';
            $stmt->close();   
        }

       } 
   }
}

if($_SESSION['userStatus'] == 'MASTER' and isset($_POST['ins']) and $_POST['ins'] == 1){
   
   $Tin = $_POST['tinNum'];
   $location = $_POST['location'];
   $companyEmail = $_POST['comEmail'];
   $compID = $_POST['Company'];
   $subName = $_POST['subName'];

   if(empty(trim($subName)) || empty(trim($compID))  || empty(trim($Tin)) || empty(trim($location)) || empty($companyEmail) ){
       echo '<div class="alert alert-danger p-4 text-gray-900">You have empty field</div>';
   }else{
       $stmt = $connection->prepare('SELECT id FROM fluid_sub_company where subcompany_name = ?');
       $stmt->bind_param('s',$subName);
       $stmt->execute();
       $stmt->store_result();
       if($stmt->num_rows > 0){
        echo '<div class="alert alert-danger p-4 text-gray-900 mt-2 col-12">sub company name already exist</div>';
       $stmt->close();  
    }else{
        $live = 1 ;
        $stmt = $connection->prepare('INSERT into fluid_sub_company(id_company,subcompany_name,tin_number,email,location)values(?,?,?,?,?)');
        $stmt->bind_param('issss',$compID,$subName,$Tin,$companyEmail,$location);
        $stmt->execute();
        $companyCreated = $stmt->affected_rows;
        if($companyCreated){
            echo '<div class="alert alert-success p-4 text-gray-900">sub company is created</div>';
            $stmt->close();             
        }else{
            echo '<div class="alert alert-danger p-4 text-gray-900">sub company was not  created! please try again</div>';
            $stmt->close();   
        }

       } 
   }
}

?>