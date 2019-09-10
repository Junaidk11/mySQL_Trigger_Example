<?php
require('dbconn.php');

$error   = '';

$success = '';

$result_array = array();

$sql    = " select id, fname, email from subscribers ";

$result = $conn->query($sql);

/*if there are results from database push to result array */

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {

        array_push($result_array, $row);
    }
}

?>

<!DOCTYPE html>

<html>

<head>

  <title>Mysql trigger Example with PHP</title>

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
  
    <?php for($i=0; $i<count($result_array); $i++){ ?>
  
    <tr>

      <td><?php echo $i+1 ?></td>

      <td><?php echo $result_array[$i]['fname'] ?></td>

      <td><?php echo $result_array[$i]['email'] ?></td>

      <td><a href="subscriber_edit.php?id=<?php echo $result_array[$i]['id'] ?>" >Edit</a>

       | <a onclick="return confirm('Are you sure you want to delete this subscriber?');" 
      href="subscriber_del.php?id=<?php echo $result_array[$i]['id'] ?>">Delete</a>

      </td>

    </tr>
    
    <?php } ?>
    
   </table>

</div>

</body>

</html>