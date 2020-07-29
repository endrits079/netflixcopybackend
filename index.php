<?php
require_once('./includes/db.php');
require_once('./includes/classes/FormSanitizer.php');
require_once('./includes/classes/ValidateInputs.php');
require_once('./includes/classes/PreviewProvider.php');
require_once('./includes/classes/CategoryContainers.php');
header('Access-Control-Allow-Origin:*');
$message ='';
$succeed=false;
$array = array();
include('./includes/register.php');
include('./includes/login.php');



if(isset($_POST['getPreview'])){
$provider = new PreviewProvider($connect);
$provider->createPreviewVideo(null);
}

if(isset($_POST['getCategories'])){
    $category = new CategoryContainers($connect);
    $category->showAllCategories();
}

if(isset($_POST['getMovie'])){
    $provider = new PreviewProvider($connect);
    $movie = $provider->createPreviewVideo($_POST['id']);
    if($movie!='false'){
     $seasons = $provider->getSeasons($_POST['id']);

     print_r(json_encode(array('movie'=>$movie,'seasons'=>$seasons)));
    }
}

if(isset($_POST['updateViews'])){
    $id=$_POST['id'];
    $query = "UPDATE videos SET views=views+1 WHERE id=$id";
    mysqli_query($connect,$query);
    

}

?>