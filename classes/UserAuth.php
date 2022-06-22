<?php
include_once 'Dbh.php';
session_start();

class UserAuth extends Dbh{
    // private static $db;

    // public function __construct(){
    //     $this->db = new Dbh();
    // }


    public function checkEmailExist($email){
        // $conn = $this->connect();
        //my database connection is in pdo thats why i used count anf fetchcolumn
         $sql = " SELECT COUNT(*) FROM `students` WHERE `email` = '$email' ";
        //  $result = mysqli_query($conn, $sql);
         $result = $this->connect()->query($sql);
    
       //fetchColumn returns the numbers columns affected by our last query
       $count = $result->fetchColumn();
        if($count > 0){
            return true;
        } else {
            return false;
        }
    }


    public function confirmPasswordMatch($password, $confirmPassword){
        //method to check if the password match
        if($password === $confirmPassword){
            return true;
        } else {
            return false;
        }
    }



    public function register($fullname, $email, $password, $confirmPassword, $country, $gender){
        //connection from dbh.php 
        $conn = $this->connect();
        //calling the checkeMailExist method
        if($this->checkEmailExist($email) == true){
          

            echo '<script>alert("User already registered");
            window.location="forms/register.php";
            </script>';

        }else{
            //calling the confirmPasswordmatch method
            if($this->confirmPasswordMatch($password, $confirmPassword) == true){
                $sql = "INSERT INTO `students` (`full_names`, `email`, `password`, `country`, `gender`) VALUES ('$fullname','$email', '$password', '$country', '$gender')";
                if($conn->query($sql)){
                    echo '<script>alert("User Successfully registered");
                    window.location="forms/login.php";
                    </script>';
                } else {
                    echo '<script>alert("Technical Error, failed to register");
                    window.location="forms/register.php";
                    </script>';
                    // echo "Opps". $conn->error;
                }
            }elseif($this->confirmPasswordMatch($password, $confirmPassword) == false){
                echo '<script>alert("Password does not Match!!!");
                window.location="forms/register.php";
                </script>';
                    
            }

        }
        
    }



    public function login($email, $password){
        $conn = $this->db->connect();
        $sql = "SELECT * FROM `students` WHERE `email`='$email' AND `password`='$password'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $_SESSION['email'] = $email;
            header("Location: ../dashboard.php");
        } else {
            header("Location: forms/login.php");
        }
    }

    public function getUser($username){
        $conn = $this->db->connect();
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function getAllUsers(){
        $conn = $this->db->connect();
        $sql = "SELECT * FROM students";
        $result = $conn->query($sql);
        echo"<html>
        <head>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
        </head>
        <body>
        <center><h1><u> ZURI PHP STUDENTS </u> </h1> 
        <table class='table table-bordered' border='0.5' style='width: 80%; background-color: smoke; border-style: none'; >
        <tr style='height: 40px'>
            <thead class='thead-dark'> <th>ID</th><th>Full Names</th> <th>Email</th> <th>Gender</th> <th>Country</th> <th>Action</th>
        </thead></tr>";
        if($result->num_rows > 0){
            while($data = mysqli_fetch_assoc($result)){
                //show data
                echo "<tr style='height: 20px'>".
                    "<td style='width: 50px; background: gray'>" . $data['id'] . "</td>
                    <td style='width: 150px'>" . $data['full_names'] .
                    "</td> <td style='width: 150px'>" . $data['email'] .
                    "</td> <td style='width: 150px'>" . $data['gender'] . 
                    "</td> <td style='width: 150px'>" . $data['country'] . 
                    "</td>
                    <td style='width: 150px'> 
                    <form action='action.php' method='post'>
                    <input type='hidden' name='id'" .
                     "value=" . $data['id'] . ">".
                    "<button class='btn btn-danger' type='submit', name='delete'> DELETE </button> </form> </td>".
                    "</tr>";
            }
            echo "</table></table></center></body></html>";
        }
    }

    public function deleteUser($id){
        $conn = $this->db->connect();
        $sql = "DELETE FROM Students WHERE id = '$id'";
        if($conn->query($sql) === TRUE){
            header("refresh:0.5; url=action.php?all");
        } else {
            header("refresh:0.5; url=action.php?all=?message=Error");
        }
    }

    public function updateUser($email, $password){
        $conn = $this->db->connect();
        if($this->checkEmailExist($email)){
           

        }else{
            echo '<script>alert("User does not exist");
            window.location="../forms/resetpassword.php";
            </script>';

        }


        $sql = "UPDATE users SET password = '$password' WHERE username = '$username'";
        if($conn->query($sql) === TRUE){
            header("Location: ../dashboard.php?update=success");
        } else {
            header("Location: forms/resetpassword.php?error=1");
        }
    }

    public function getUserByUsername($username){
        $conn = $this->db->connect();
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function logout($username){
        session_start();
        session_destroy();
        header('Location: index.php');
    }

   



}

