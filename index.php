<?php
require_once('db.php');
header('Access-Control-Allow-Origin:*');
if(isset($_POST['register'])){
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password= $_POST['confirm_password'];

    $query = "INSERT INTO users(first_name,last_name,username,email,password) VALUES ('$fname','$lname','$username','$email','$password')";
    $message ='';
    $succeed=false;
    if($password!=$confirm_password){
     $message='Password must match';
    }
    else {
        $result = mysqli_query($connect,$query);
        if($result){
            $message= "User Registered successfully";
            $succeed=true;
        }
    }
     $array =  array();
     array_push($array,$message,$succeed);
     
    echo json_encode($array);
}

?>