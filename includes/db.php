<?php
ob_start();

date_default_timezone_set('Europe/Tirane');
$connect = mysqli_connect('localhost','root','','netflix') or die('Connection to database failed');

?>