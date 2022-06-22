<?php

class Dbh {
    protected function connect(){ 
        try {
            $username = "root";
            $password = "";
            $dbh = new PDO('mysql:host=localhost; dbname=zuriphp',$username,$password);
            return $dbh;
             
        } catch (PDOException $error) {
            echo "Error connecting to the database";
            die();
            
        }


    }

}


// class Dbh{
//     public $host = "localhost";
//     public $user = "root";
//     public $password = "";
//     public $db_name = "zuriphp";
//     public $con;
  
//     public function connect(){
//       $this->con = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
     
//     }
    
//   }