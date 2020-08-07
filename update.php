<?php
header('Access-Control-Allow-Origin:*');
require_once('./includes/db.php');

if(isset($_POST['updateProfile'])){
    $first_name  =$_POST['first_name'];
    $last_name  =$_POST['last_name'];
    $username  =$_POST['username'];
    $email  =$_POST['email'];
    $user_id=$_POST['user_id'];
    $query = "UPDATE users SET first_name='$first_name', last_name='$last_name', username='$username', email='$email' WHERE id_user='$user_id'";
    $result = mysqli_query($connect,$query);
    if($result){
        echo json_encode(array('message'=>'Profile Updated Successfully','type'=>'success'));
    }
    else{
        echo json_encode(array('message'=>mysqli_error($connect),'type'=>'fail'));

    }
}

?>