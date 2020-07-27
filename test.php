<?php
require_once('./includes/db.php');

$query = "SELECT * FROM categories";
$result = mysqli_query($connect,$query);
$categories= array();
$alldata = array();
$sameCategory = array();
$singleData= array();
while($row=mysqli_fetch_assoc($result)){
    extract($row);
    array_push($categories,array('id'=>$id,'category'=>$name));
}

for($i=0;$i<sizeof($categories);$i++){
    $query = "SELECT * FROM entities WHERE categoryId=".$categories[$i]['id'];

    $result = mysqli_query($connect,$query);
     $sameCategory= array("category"=>$categories[$i]['category']);
    while($row=mysqli_fetch_assoc($result)){
        extract($row);
        array_push($singleData,$row);
        
    }
    $sameCategory['data']=$singleData;
    if(sizeof($sameCategory['data'])>0){
    array_push($alldata,$sameCategory);
    }
    
    $singleData = array();

}
print_r(json_encode($alldata));
?>

