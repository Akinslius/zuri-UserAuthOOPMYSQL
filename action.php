<?php

require 'classes/Dbh.php';
require 'classes/UserAuth.php';
require 'classes/Route.php';



switch(true){
    case isset($_POST['register']):
        //extract the $_POST array values for name, password and email
        $fullname = $_POST['fullnames'];
        $email = $_POST['email'];
        $country = $_POST['country'];
        $gender = $_POST['gender'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        $route = new formController($fullname,$email,$country,$gender,$password,$confirmPassword);
        $route->handleForm();
        break;

    case isset($_POST['login']):
            $email = $_POST['email'];
            $password = $_POST['password'];

            $route = new LoginController($email, $password);
            $route->handleLogin();
        
        break;
    case isset($_POST["reset"]):
            $email = $_POST['email'];
            $password = $_POST['password'];
        resetPassword($email, $password);
        break;
    case isset($_GET["deleteid"]):
        session_start();
         $_SESSION['id'] = $_GET['deleteid'];
         
        deleteaccount($id);
        break;
    case isset($_GET["all"]):
        getusers();
        break;
}