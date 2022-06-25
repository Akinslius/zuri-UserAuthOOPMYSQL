<?php
//Connection to the database
class Dbh {
    //properties
    protected $host;
    protected $username;
    protected $password;
    protected $dbname;
    
//method
    protected function connect(){ 
        
            $this->host = "localhost";
            $this->username = "root";
            $this->password = "";
            $this->dbname = "zuriphp";
            $dbh = mysqli_connect($this->host,$this->username,$this->password,$this->dbname);

            if(!$dbh){
                echo "<script> alert('Error connecting to the database') </script>";
            }
            return $dbh;
}
}  
?>

