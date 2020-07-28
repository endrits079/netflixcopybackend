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
    $provider->createPreviewVideo($_POST['id']);
}
?>