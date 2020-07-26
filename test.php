<?php
require_once('./includes/db.php');

$query = "SELECT * FROM categories";
$result = mysqli_query($connect,$query);
$myarray = array();


?>