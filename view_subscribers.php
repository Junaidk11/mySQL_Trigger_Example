<?php
require('pdocon.php');

// Create database connection handler.

$dbh = new Pdocon; 
$error   = '';

$success = '';


// Create Query
$dbh->query("SELECT * FROM subscribers");

// Execute and return all rows of the database
$results = $dbh->fetchMultiple();

?>

<!DOCTYPE html>

<html>

<head>

  <title>Mysql Delete trigger Example with PHP</title>

  <style>
    .container {
      margin: 0 auto;

      padding: 10px;
    }
    .error {
      width: 100%;
      color: red;
    }
    .success {
      width: 100%;
      color: green;
    }
   

  table {

    border-collapse: collapse;

  }


  table, th, td {
    border: 1px solid black;

  }
  </style>

</head>

<body>

<div class="container">

  <h2>View Subscribers</h2>
  
  <h4>If you click on delete link. Record will be deleted and after delete trigger will execute.</h4>
  
  <h4>If you click on edit link. On update of record and after update trigger will execute.</h4>
  
  <?php if($error) { ?>
 
   <p class="error"><?php echo $error; ?></p>
  
  <? } ?>
  
  <?php if($success) { ?>
 
   <p class="success"><?php echo $success; ?></p>
  
 <? } ?>
    
  <table width="90%" >
      <tr>

      <th>#</th>

      <th>Name</th>

      <th>Email</th>

      <th>Action</th>

    </tr>
  
      <?php foreach ($results as $result) { ?>
  
    <tr>

      <td><?php echo  $result['id'];?></td>

      <td><?php echo $result['fname']; ?></td>

      <td><?php echo $result['email']; ?></td>

      <td><a href="subscriber_edit.php?id=<?php echo $result['id']; ?>" >Edit</a>

       | <a onclick="return confirm('Are you sure you want to delete this subscriber?');" 
      href="subscriber_del.php?id=<?php echo $result['id'] ?>">Delete</a>

      </td>

    </tr>
    
    <?php } ?>
    
   </table>

</div>

</body>

</html>