<?php
    require('pdocon.php');


    // Make connection to the database.
    $dbh = new Pdocon; 

    
    $fname   = '';
    $email   = '';
    $error   = '';
    $success = '';
    if(isset($_POST['sub'])){
        $fname = $_POST['fname'];

        $email = $_POST['email'];

        if(!$fname || !$email){

          $dbh->errmsg .= 'All fields are required. <br />';

        }elseif(!strpos($email, "@" ) || !strpos($email, ".")){

          $dbh->errmsg .= 'Email is invalid. <br />';
        }
        if(!($dbh->errmsg)){
          
            //insert in to database
          $dbh->query("INSERT INTO subscribers(id, fname, email) values(NULL, )")
          $sql    = "insert into subscribers (fname, email) values (?, ?) ";
          $stmt   = $conn->prepare($sql);
          $stmt->bind_param('ss', $fname, $email);
          if($stmt->execute()){
            $success = 'Subscriber added successfully.';
            $fname = '';
            $email = '';
          }else{
            $error .= 'Error while saving subscriber. Try again. <br />';
          }
       }
    }
?>

<!DOCTYPE html>
<html>
<head>
  <title>mySQL Trigger with PHP</title>
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
  <h2>mySQL Trigger Application: Before Insert of Record</h2>
  <h4>Subscriber Registration</h4>
  <?php if($error) { ?>
    <p class="error"><?php echo $error; ?></p>
  <? } ?>
  <?php if($success) { ?>
    <p class="success"><?php echo $success; ?></p>
  <? } ?>
  <form name="form1" method = "post">
    <p>
    First name:<br>
    <input type="text" placeholder='First Name' name="fname" value="<?php echo $fname; ?>" required >
    </p>
    <p>
    Email:<br>
    <input type="email" placeholder='Email' name="email" value="<?php echo $email; ?>" required >
   </p>
   <p>
    <input type="submit" value="Register Subscriber" name='sub'>
   </p>
  </form>
  <p>Upon clicking "Submit" button, form data is saved into subscriber table and a trigger 
     before_subscriber_insert will execute.</p>
</div>
</body>

</html>