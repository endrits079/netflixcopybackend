<?php
header('Access-Control-Allow-Origin:*');
require_once('./includes/db.php');
if(isset($_POST['searchMovie'])){
    $title = $_POST['title'];
    $query="SELECT  * FROM videos WHERE title LIKE '%$title%' ORDER BY season,episode";
    $result = mysqli_query($connect,$query);
    if($result && $result->num_rows>0){
    $result = mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo json_encode($result);
    }
    else 
    echo 'false';
}
?>