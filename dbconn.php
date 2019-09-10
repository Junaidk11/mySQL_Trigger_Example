<?php

class Pdocon{
    

    // The connection Properties

        private $host       = "localhost";
        private $user       = "root";
        private $pass       = "";
        private $dbnm       = "Inventory_Application";
   

    //Handle our connection
        private $dbh;
    
    //handle our error
        private $errmsg;
    
    //Statement Handler
        private $stmt;
 
        
    //Method to open our connection

        public function __construct(){
            
        $dsn ="mysql:host=" . $this->host . "; dbname=" . $this->dbnm; 
    
        $options = array( 
        
            PDO::ATTR_PERSISTENT    => true,
            
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION

        );
            
            try{
                
                $this->dbh  = new PDO($dsn, $this->user, $this->pass, $options); 
                
                //echo "Successfully Connected";
 
            }catch(PDOException $error){
                
                $this->errmsg = $error->getMessage();
                
                echo $this->errmsg;
                
            }
            
            
        }
            

        
        //Write query helper function using the stmt property
        public function query($query){
            
            $this->stmt = $this->dbh->prepare($query);
            
        }
        

        //Creating a bind function 
        public function bindvalue($param, $value, $type){
            
             $this->stmt->bindValue($param, $value, $type);
            
        }
        

        //Function to execute statement
        public function execute(){
            
          return $this->stmt->execute();
            
        }
        

        //Function to check if statement was successfully executed
        public function confirm_result(){
            
            $this->dbh->lastInsertId();
            
        }
        
        //Command to fetch data in a result set in associative array
        public function fetchMultiple(){
            
        $this->execute();    
            
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);    
            
        }

        //Command count fetched data in a result set 
        
        public function fetchSingle(){
            
        $this->execute();    
            
        return $this->stmt->fetch(PDO::FETCH_ASSOC);    
            
        }
        
    
}    

?>