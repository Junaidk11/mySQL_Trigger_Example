<?php
require('pdocon.php');

$id  = $_GET['id'];

$dbh= new Pdocon;


if($id){
    
    $dbh->query('DELETE FROM subscribers WHERE id=:id');
    $dbh->bindvalue(':id',$id, PDO::PARAM_INT);
    
    $run_query = $dbh->execute();
    
    header("Location: http://localhost:9090/mySQL_Trigger_Example/");

  exit;
}