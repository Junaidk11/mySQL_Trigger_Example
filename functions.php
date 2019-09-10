<!-- 
    To avoid repetition of code, we're going to write HELPER functions to carry out common tasks
   
    
     The functions described here are basically procedural functions and not OOP methods  
     
     
                 HELPER FUNCTIONS 
-->
<?php

  // Function to trim values

function cleandata($value)
{    
    return trim($value);
}

// function to sanitize for string

function sanitizer($raw_value)
{
    return(filter_var($raw_value,FILTER_SANITIZE_STRING));
}

// function to validate value for email

function validateemail($raw_email)
{
    return(filter_var($raw_email,FILTER_VALIDATE_EMAIL));
}

// function to validate a value for integer

function validateint($raw_int)
{
     return (filter_var($raw_int,FILTER_VALIDATE_INT));  
}

// function to redirect to a desired page

function redirect($pagetodirectto)
{
    
    header("Location: {$pagetodirectto}");  // Call the header function, takes two parameters, the Location and the page to redirect to 
}

// function to keep an error and success messages in a session NOTE: this function is not an Exception error, we use the PDOException for that, this function keeps track of the successful login, errors during login like wrong password and etc. 

function keepmsg($message)
{
    // first we need to create a session - which is a super global variable, and make sure the message is not just blank space. Reason: $_SESSION is a super global variable which can be accessed by ANY file in the project, and we want to keep track of what the user is doing. To avoid storing "" in the Super global variable, we need to ensure the $message argument is not just a blank space. Therefore:
    
    if(empty($message))
    {
        $message="";
    }
    else 
    {
        $_SESSION['msg'] = $message; // Push message to the Super global array  
    }
    
}


/// function to display the stored message in the Session super global variable. The following function will be called AS SOON AS a new 'msg' has been set in the $_SESSION super global variable. Therefore, the following function is only called when the 'msg' ID of the $_SESSION super global array has been set by a $message, that the program wishes to echo to the user in response to his/her interaction with the page/GUI

function showmsg()
{
    if(isset($_SESSION['msg'])) // check if the 'msg' id in the $_SESSION super global associative array has been set
    {
        echo $_SESSION['msg']; // Display the $message set into the 'msg' id of the $_SESSION super global Associative Array
        
        // After the message has been echoed to the user, we clean the 'msg' id of the SESSION super global variable, this will allow a new message to be echoed - when it is set. 
        
        unset($_SESSION['msg']); // clear the 'msg' id of the super global associative array 
    }

}

// Create function to hash password using md5 - Q: What is a hash password?

/*
     Hashing a password, basically, guards against the possibility that someone who gains unauthorized access to the database can retrieve passwords of every user in the system. 
        Hashing converts a password to another string, called hashed password, i.e. it converts the REAL password into a another string which is stored on the database, but to login, the user needs the original password - can't use the hashed password to gain access to the patricular user.

*/

function hashpassword($clean_password)
{

    return md5($clean_password);
    
}

?>