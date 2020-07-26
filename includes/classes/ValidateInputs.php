<?php
class ValidateInputs{
    public static function ValidateName($name){
       if(strlen($name)<2 || strlen($name)>25){
           return "Name must be between 2 and 25 characters long";
       }
     return true;
       
    }
    public static function ValidatePassword($password,$confirm_password){
       if(strlen($password)<6 || strlen($password)>50){
           return "Password must be between 6 and 50 characters long";
       }
       else if ($password!=$confirm_password){
           return "Password must match";
       }
      return true;
       
    }

    public static function ValidateUsername($username,$connect){
       
        if(strlen($username)<4 || strlen($username)>50){
            return "Username must be between 4 and 50 characters long";
        }
        else {
            $query = "SELECT id_user FROM users WHERE username='$username'";
            $result = mysqli_query($connect,$query);
            if($result->num_rows>0){
            return "Username already exists";
        }
    }
    return true;
    }
  
}

?>