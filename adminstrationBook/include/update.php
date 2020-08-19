<?php 
include 'connexion.php';

$column = $_POST['name'];
if($column == 'username'){
    $value =$_POST['value'] ;
    $id = $_POST['pk'];
    $stmt = $connection->prepare('SELECT id from fluid_user where username = ? ');
    $stmt->bind_param('s',$value);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows > 0){
        echo('username exist');
        $stmt->close();
    }else{
        $stmt = $connection->prepare('UPDATE fluid_user set username = ? where id = ? ');
        $stmt->bind_param('si',$value,$id);
        $stmt->execute();
    }
    
}
 if($column == 'live'){
    $value =$_POST['value'] ;
    $id = $_POST['pk'];
    $stmt = $connection->prepare('UPDATE fluid_user set live = ? where id = ? ');
    $stmt->bind_param('ii',$value,$id);
    $stmt->execute();
}
if($column == 'role'){
    $value =$_POST['value'] ;
    $id = $_POST['pk'];
    $stmt = $connection->prepare('UPDATE fluid_user set role = ? where id = ? ');
    $stmt->bind_param('ii',$value,$id);
    $stmt->execute();
}


?>