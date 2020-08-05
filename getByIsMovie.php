<?php
header('Access-Control-Allow-Origin:*');

require_once('./includes/db.php');
include('./functions.php');

if(isset($_POST['getMovies'])){
  getByIsMovie($connect,1);
}
if(isset($_POST['getTVShows'])){
    getByIsMovie($connect,0);
}

?>