<?php

class FormController extends UserAuth{

private $fullname;
private $email;
private $country;
private $gender;
public $password;
private $confirmPassword;

public function __construct($fullname,$email,$country,$gender,$password,$confirmPassword){
   $this->fullname= $fullname; 
   $this->email= $email; 
   $this->country= $country; 
   $this->gender= $gender; 
   $this->password= $password; 
   $this->confirmPassword= $confirmPassword;
}



public function handleForm(){

    switch(true) {
        case isset($_POST['register']):
            //unpack all data for registering
            $this->fullname = $_POST['fullnames'];
            $this->email = $_POST['email'];
            $this->password = $_POST['password'];
            $this->confirmPassword = $_POST['confirmPassword'];
            $this->gender = $_POST['gender'];
            $this->country = $_POST['country'];
            $this->register($this->fullname, $this->email, $this->password, $this->confirmPassword, $this->country, $this->gender);
            break;
        // case isset($_POST['login']):
        //     //unpack all data for login
        //     $this->email = $_POST['email'];
        //     $this->password = $_POST['password'];
        //     $this->login($this->email, $this->password);
        //     break;
        case isset($_POST['logout']):
            //unpack all data for logout
            $this->email = $_POST['email'];
            $this->logout($this->email);
            break;
        case isset($_POST['delete']):
            //unpack all data for deleting
            $this->email = $_POST['email'];
            $this->deleteUser($this->email);
            break;
        case isset($_POST['reset']):
            //unpack all data for updating password
            $this->email = $_POST['email'];
            $this->password = $_POST['password'];
            $this->updateUser($this->email, $this->password);
            break;
        case isset($_POST['all']):
            //unpack all data for getting all users
            $this->getAllUsers();
            break;
        default:
            echo 'No form was submitted';
            break;
    }
}


}



class LoginController extends UserAuth{

    
    private $email;
    public $password;
    
    public function __construct($email,$password){
       $this->email= $email; 
       $this->password= $password; 
    }
    
    public function handleLogin(){
    
        
            if(isset($_POST['login'])){
                 //unpack all data for login
                 $this->email = $_POST['email'];
                 $this->password = $_POST['password'];
                 $this->login($this->email, $this->password);

            }
        }

    }
               
    //             break;
    //         case isset($_POST['logout']):
    //             //unpack all data for logout
    //             $this->email = $_POST['email'];
    //             $this->logout($this->email);
    //             break;
    //         case isset($_POST['delete']):
    //             //unpack all data for deleting
    //             $this->email = $_POST['email'];
    //             $this->deleteUser($this->email);
    //             break;
    //         case isset($_POST['reset']):
    //             //unpack all data for updating password
    //             $this->email = $_POST['email'];
    //             $this->password = $_POST['password'];
    //             $this->updateUser($this->email, $this->password);
    //             break;
    //         case isset($_POST['all']):
    //             //unpack all data for getting all users
    //             $this->getAllUsers();
    //             break;
    //         default:
    //             echo 'No form was submitted';
    //             break;
    //     }
    // }
    
    
    // }


