<?php
class CategoryContainers{
    private $connect;
  public function __construct($con){
      $this->connect=$con;
  }

    public function showAllCategories(){
        $myarray = array();
        $query = "SELECT * FROM categories";
        $result = mysqli_query($this->connect,$query);
        while($row=mysqli_fetch_assoc($result))
{
    extract($row);

    array_push($myarray,array("id"=>$id,"name"=>$name));
}

echo (json_encode($myarray));
    }
}
?>