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

if(isset($_POST['getVideo'])){
    $id = $_POST['id'];
    $query="SELECT * FROM videos WHERE id=$id";
    $result = mysqli_query($connect,$query);
    if($result->num_rows>0){
    $row=mysqli_fetch_assoc($result);
    echo json_encode($row);
    }
    else{
        echo 'false';
    }

}


if(isset($_POST['updateProgress'])){
    $user = $_POST['user'];
    $video = $_POST['video'];
    $time = $_POST['time'];

    $query = "SELECT id FROM videos_progress WHERE user=$user AND video=$video";
    $result = mysqli_query($connect,$query);
    if($result->num_rows>0){
        $query = "UPDATE videos_progress SET progress=$time,modified_date=NOW() WHERE user=$user AND video=$video";
        mysqli_query($connect,$query);
    }
    else{
        $query = "INSERT INTO videos_progress(user,video,progress,modified_date) VALUES ($user,$video,$time,NOW())";
        mysqli_query($connect,$query);
    }

}
  if(isset($_POST['getProgress'])){
      $user = $_POST['user'];
      $video = $_POST['video'];
      $query = "SELECT progress FROM videos_progress WHERE user=$user AND video=$video";
      $result = mysqli_query($connect,$query);
      if($result->num_rows>0){
          $progress = mysqli_fetch_assoc($result)['progress'];
          
          echo (json_encode(array('startTime'=>$progress)));
      }
      else {
          echo 'false';
      }
  }
  if(isset($_POST['finishedVideo'])){
      $user = $_POST['user'];
      $video = $_POST['video'];

      $query = "UPDATE videos_progress SET finished=1,progress=0 WHERE user=$user AND video=$video";
      mysqli_query($connect,$query);
  }



  if(isset($_POST['getNextVideo'])){
    $episode = $_POST['episode'];
    $season = $_POST['season'];
    $title = $_POST['title'];
    $id = $_POST['id'];

    $query = "SELECT * FROM videos WHERE  title='$title' AND id!=$id AND ((episode>$episode AND season=$season) OR season>$season) ORDER BY season,episode ASC LIMIT 1";
    $result = mysqli_query($connect,$query);

    if ($result->num_rows>0){
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    }
    else { echo 'false';}
    
}

?>

