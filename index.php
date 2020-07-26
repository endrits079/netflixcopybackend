<?php
require_once('./includes/db.php');
require_once('./includes/classes/FormSanitizer.php');
require_once('./includes/classes/ValidateInputs.php');
header('Access-Control-Allow-Origin:*');
$message ='';
$succeed=false;
$array = array();
if(isset($_POST['register'])){
    $fname =FormSanitizer::sanitizeString($_POST['first_name']);
    $lname =FormSanitizer::sanitizeString( $_POST['last_name']);
    $username =FormSanitizer::sanitizeUsername($_POST['username']);
    $email = FormSanitizer::sanitizeEmail($_POST['email']);
    $password =FormSanitizer::sanitizePassword( $_POST['password']);
    $confirm_password= FormSanitizer::sanitizePassword($_POST['confirm_password']);

    $fnameValid = ValidateInputs::ValidateName($fname);
    $passwordValid = ValidateInputs::ValidatePassword($password,$confirm_password);
    $usernameValid = ValidateInputs::ValidateUsername($username,$connect);
    $emailValid = ValidateInputs::ValidateEmail($email);
    if($usernameValid!='true'){
        $message=$usernameValid;
    }
    else if($fnameValid!= 'true'){
        $message=$fnameValid;
    }
    else if($emailValid!='true'){
        $message=$emailValid;
    }
    else if($passwordValid!='true'){
        $message=$passwordValid;
    }
    else {
    $query = "INSERT INTO users(first_name,last_name,username,email,password) VALUES ('$fname','$lname','$username','$email','$password')";
        $result = mysqli_query($connect,$query);
        if($result){
            $message= "User Registered successfully";
            $succeed=true;
        }
    }
     array_push($array,$message,$succeed);
     
    echo json_encode($array);
}

if(isset($_POST['login'])){
    $email =FormSanitizer::sanitizeEmail($_POST['email']);
    $password =FormSanitizer::sanitizePassword($_POST['password']);
    $query = "SELECT * from users WHERE email='$email' OR username='$email' AND password='$password'";
    $result=mysqli_query($connect,$query);
    $result= mysqli_fetch_assoc($result);
    if(empty($result)){
        $message='Incorrect username or password';
    }
    else {
        extract($result);
        $message = array('id'=>$id_user,'username'=>$username,'user_type'=>$user_type);
        $message = json_encode($message);
        $succeed=true;
    }

    array_push($array,$message,$succeed);
    echo json_encode($array);
}

?>