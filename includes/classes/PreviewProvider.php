<?php
class PreviewProvider{
    private $connect;
    public function __construct($con){
      $this->connect=$con;
    }
    public function createPreviewVideo($entity){
        if($entity==null){
            $entity = $this->getRandomEntity();
        }
        else {
           $entity=$this->getEntityById($entity);
        }
    }
    private function getEntityById($id){
        $query = "SELECT * from entities WHERE id =$id";
        $result = mysqli_query($this->connect,$query);
        $result = mysqli_fetch_assoc($result);
        extract($result);
        $data = array("image"=>$thumbnail,"video"=>$preview,"name"=>$name);
        echo json_encode($data);

    }
    private function getRandomEntity(){
        $query = "SELECT * FROM entities ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($this->connect,$query);
        $result = mysqli_fetch_assoc($result);
        extract($result);
        $data = array("image"=>$thumbnail,"video"=>$preview,"name"=>$name);

        echo json_encode($data);
    }
}

?>