<?php
require('pdocon.php');

// Create Database Connection handler

$dbh = new Pdocon;

$error   = '';
$success = '';

$fname   = '';

$email   = '';

$error   = '';

$success = '';

$id      = $_GET['id'];

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
      
        // Create Query 
        $dbh->query("UPDATE subscribers set fname=:name, email=:email WHERE id=:id"); 
        
        // Bind values
        
        $dbh->bindvalue(':id',$id,PDO::PARAM_INT);
        $dbh->bindvalue(':name',$fname, PDO::PARAM_STR);
        $dbh->bindvalue(':email',$email, PDO::PARAM_STR);
        
        // Execute the QUERY on the database.
        $run_query = $dbh->execute();
     
      if($run_query){
          // If UPDATE Query was Successful
        
        $success = 'Subscriber added successfully.';

        $fname = '';

        $email = '';

      }else{

          // if update query was unsuccessful
        $error .= 'Error while saving subscriber. Try again. <br />';

      }
   }
}

//Fetch existing record to edit

$dbh->query("SELECT * FROM subscribers WHERE id=:id");

// Bind 
$dbh->bindvalue(':id', $id, PDO::PARAM_INT);

// Run Query and store returned data

$run_query = $dbh->fetchSingle();

$fname  = $run_query['fname'];

$email  = $run_query['email'];

?>
<!DOCTYPE html>

<html>

<head>

  <title>MySQL trigger with PHP</title>

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