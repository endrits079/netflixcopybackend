<?php

function getByIsMovie($connect,$isMovie){
        
        $allData = array();
        $sameCategory=array();
  
        $categoriesQuery = "SELECT DISTINCT (entities.categoryId),categories.name FROM entities LEFT OUTER JOIN videos ON entities.id=videos.entityId
        LEFT OUTER JOIN categories ON entities.categoryId=categories.id WHERE videos.isMovie=$isMovie";
        $categoriesResult = mysqli_query($connect,$categoriesQuery);
         while($categoriesRow = mysqli_fetch_assoc($categoriesResult)){
            extract($categoriesRow);
             $sameCategory['category']=$name;
             $sameCategory['data']=array();
             $entitiesQuery = "SELECT DISTINCT(entities.id),entities.name,entities.thumbnail,entities.preview
              FROM entities LEFT OUTER JOIN videos ON entities.id=videos.entityId WHERE videos.isMovie=$isMovie AND entities.categoryId=$categoryId";
             $entitiesResult = mysqli_query($connect,$entitiesQuery);
             $entities = array();
             while($entitiesRow = mysqli_fetch_assoc($entitiesResult)){
                extract($entitiesRow);
                $entities['id']=$id;
                $entities['name']=$name;
                $entities['thumbnail']=$thumbnail;
                $entities['preview']=$preview;
                array_push($sameCategory['data'],$entities);
             }

             array_push($allData,$sameCategory);
             $sameCategory=array();

         }

      echo json_encode($allData);
}

?>