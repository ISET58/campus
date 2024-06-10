<?php

include_once 'acceso.php'; 

ini_set('html_errors', false);

/* Getting file name */
$filename = $_FILES['file']['name'];

$userID=$_GET["userID"];


$uploadOk = 1;
$imageFileType = pathinfo($filename,PATHINFO_EXTENSION);

/* el lugra donde se deposita el upload */
$location = "avatares/foto_".$userID.".".$imageFileType;

/* Valid Extensions */
$valid_extensions = array("jpg","jpeg","png");
/* Check file extension */
if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
   $uploadOk = 0;
}


if($uploadOk == 0){
   echo 0;
}else{
   /* Upload file */
   if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
      echo $location."?".time();
      actualizarPorID ("usuarios", $userID, array("foto"), array($location));
   }else{
      echo 0;
   }
}

?>