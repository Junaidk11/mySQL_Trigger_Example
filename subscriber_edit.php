<?php
require('dbconn.php');

$error   = '';
$success = '';

$fname   = '';

$email   = '';

$error   = '';

$success = '';

$id      = intval($_GET['id']);

if(isset($_POST['sub'])){

    $fname = $_POST['fname'];

    $email = $_POST['email'];

    if(!$fname || !$email){
      
      $error .= 'All fields are required. <br />';

    }elseif(!strpos($email, "@" ) || !strpos($email, ".")){

      $error .= 'Email is invalid. <br />';

    }

    if(!$error){
      //update data in database
      
      $sql    = "update subscribers set fname = ?, email = ? where id = ? ";

      $stmt   = $conn->prepare($sql);

      $stmt->bind_param('sss', $fname, $email, $id);

      if($stmt->execute()){
        
        $success = 'Subscriber added successfully.';

        $fname = '';

        $email = '';

      }else{

        $error .= 'Error while saving subscriber. Try again. <br />';

      }
   }
}

//Fetch existing record to edit
$sql    = " select id, fname, email from subscribers where id = $id";

$result = $conn->query($sql);

$record = $result->fetch_assoc();

$fname  = $record['fname'];

$email  = $record['email'];

?>
<!DOCTYPE html>

<html>

<head>

  <title>Mysql trigger example with PHP</title>

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
  </style>

</head>

<body>

<div class="container">

  <h2>Example mysql trigger: after update of a record</h2>

  <h4>Update a subscriber information</h4>

  <?php if($error) { ?>


    <p class="error"><?php echo $error; ?></p>

  <? } ?>

  <?php if($success) { ?>

    <p class="success"><?php echo $success; ?></p>

  <? } ?>

  <form name="form1" method = "post">

    <input type="hidden" name='id' value="<?php echo $id; ?>" >

    <p>

    First name:<br>

    <input type="text" placeholder='First Name' name="fname" value="<?php echo $fname; ?>" required >

    </p>

    <p>

    Email:<br>

    <input type="email" placeholder='Email' name="email" value="<?php echo $email; ?>" required >

   </p>

   <p>

    <input type="submit" value="Update" name='sub'>

   </p>

  </form>

  <p>Upon clicking "Update" button, form data is updated into subscriber table, a mysql trigger named  
   after_subscriber_update will execute.</p>

</div>

</body>

</html>