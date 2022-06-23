<?php

class Dbh {
    protected function connect(){ 
        
            $host = "localhost";
            $username = "root";
            $password = "";
            $db_name = "zuriphp";
            $dbh = mysqli_connect($host,$username,$password,$db_name);

            if(!$dbh){
                echo "<script> alert('Error connecting to the database') </script>";
            }
        
            return $dbh;
             
        

}
}

    
?>