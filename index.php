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

         
            $error ='All fields are required. <br />';

        }elseif(!strpos($email, "@" ) || !strpos($email, ".")){

          
            $error = 'Email is invalid. <br />';
        }
        if(!($error)){
          
            //insert in to database
          $dbh->query("INSERT INTO subscribers(id, fname, email) values(NULL, :name, :email)");
          
            // Usually you would clean & validate the data coming in from the form before binding
            // But, this example is for implementing Triggers, we can skip the cleaning & validation step. 
            
            $dbh->bindvalue(':name',$fname, PDO::PARAM_STR);
            $dbh->bindvalue(':email', $email, PDO::PARAM_STR);
        
            // Run the query to your database
            $run_query = $dbh->execute();
            
            
          if($run_query){
              // If Query successful
                $fname = '';
                $email = '';
          }else{
              
                $error = 'Error while saving subscriber. Try again. <br />';
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
  <h2>mySQL Trigger Application: Before Inserting Record</h2>
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
      before_subscriber_insert will execute. <br><br>
      
      
      The 'before_subscriber_insert trigger will update the 'audit_subscriber' table with time-stamp and the action that was just performed. </p>
</div>
</body>

</html>