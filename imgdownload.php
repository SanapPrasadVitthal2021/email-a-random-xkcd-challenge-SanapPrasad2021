<?php


require_once 'config.php'; 
require_once 'randomMail.php';
//    $con=NEW MySQLi("localhost","epaviqlo_prasad","GCXytsrg%uA","epaviqlo_rtCamp");
// if(isset($_POST['submit'])){
//     $file=$_POST['url'];
//     $data=file_get_contents($file);
//     $newimage=rand()."abc.jpg";
//     $new='/home4/epaviqlo/public_html/image/'.$newimage;
//     file_put_contents($new,$data);
//     // mysql_query("insert into image set name='$newimage'");
//     echo"<img src='/home4/epaviqlo/public_html/image/$newimage'width='300px height='250px'/>";
// }

require_once 'databaseConnection.php';

class DownloadImg{
    function downlo($no,$url,$title,$mysqli){
        $file=$url;
        $data=file_get_contents($file);
        $newimage=$title.".jpg";
        $new='/home4/epaviqlo/public_html/image/'.$newimage;
        file_put_contents($new,$data);
        // mysql_query("insert into image set name='$newimage'");
        // $mysqli->query("INSERT INTO image_det(id,imgname,imglocation)VALUES('$no','$title','$new')");
        $no=$mysqli->real_escape_string($no);
        $newimage=$mysqli->real_escape_string($newimage);
        $new=$mysqli->real_escape_string($new);
        $mysqli->query("INSERT INTO image_det(imgNum,imgname,imglocation)VALUES('$no','$newimage','$new')");
       return $new;
    }
}



?>
