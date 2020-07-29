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
           return $this->getEntityById($entity);
        }
    }
    public function getSeasons($entity){
        $sameSeason = array();
        $allData = array();
        $query = "SELECT COUNT(DISTINCT season) FROM videos WHERE entityId=$entity";
        $result =mysqli_query($this->connect,$query);
        $count = mysqli_fetch_array($result)[0];
        for($i=1;$i<=$count;$i++){
            $query = "SELECT * FROM videos WHERE entityId=$entity AND season=$i";
            $result =mysqli_query($this->connect,$query);
            $sameSeason['season']=$i;
            $sameSeason['data']=array();
            while($row = mysqli_fetch_assoc($result)){
                extract($row);
                array_push($sameSeason['data'],$row);
            }
            array_push($allData,$sameSeason);
            $sameSeason= array();
        }

        return json_encode($allData) ;
    }
    private function getEntityById($id){
        $query = "SELECT * from entities WHERE id =$id";
        $result = mysqli_query($this->connect,$query);
        $result = mysqli_fetch_assoc($result);
        if(!empty($result)){
        extract($result);
        $data = array("image"=>$thumbnail,"video"=>$preview,"name"=>$name);
        return json_encode($data);
        }
        else {
           return 'false';
        }

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