<?php
require('dbconn.php');

$id  = intval($_GET['id']);

if($id){
  $sql    = " delete from subscribers where id = ?";

  $stmt   = $conn->prepare($sql);

  $stmt->bind_param('s', $id);

  $stmt->execute();

  header("Location: records.php");

  exit;
}