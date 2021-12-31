<?php
    require_once 'config.php'; 
    require_once 'randomMail.php';
    require_once 'databaseConnection.php';

    class DownloadImg{
        function downlo($no,$url,$title,$mysqli){
            $file=$url;
            $data=file_get_contents($file);
            $newimage=$title.".jpg";
            $new='/home4/epaviqlo/public_html/image/'.$newimage;
            file_put_contents($new,$data);
            $no=$mysqli->real_escape_string($no);
            $newimage=$mysqli->real_escape_string($newimage);
            $new=$mysqli->real_escape_string($new);
            $mysqli->query("INSERT INTO image_det(imgNum,imgname,imglocation)VALUES('$no','$newimage','$new')");
        return $new;
        }
    }



?>
