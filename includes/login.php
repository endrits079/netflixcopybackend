<?php
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