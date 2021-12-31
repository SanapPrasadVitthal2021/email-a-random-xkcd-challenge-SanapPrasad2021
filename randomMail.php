<?php
require_once 'databaseConnection.php';
require_once 'config.php'; 
require 'vendor/autoload.php';
require_once 'imgdownload.php';

class AutoSendingMail{
    function SendMail($firstName,$lastName,$receiver,$link,$getpath,$title,$month,$num,$transcript,$day,$year,$alt,$safe_title){
        $to=$receiver;
        
        // $img=file_get_contents($url);
        // print_r $img;
        // If you're using Composer (recommended)
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("fmc202158@zealeducation.com", "Prasad Sanap");
        $email->setSubject("XKCD Comics");
        $email->addTo("$to","User Details");
        $email->addContent("text/plain","This is email from XKCD Comics.");
        $email->addContent(
            "text/html", "<h2>Hi, $firstName $lastName</h2>
            <h4>----- XKCD COMIC -----
            <br>
            Title:".$title."
            <br>
            Safe Title:".$safe_title."
            <br>
            Number of comic:".$num."
            <br>
            Day:".$day."
            <br>
            Month:".$month."
            <br>
            Year:".$year."
            <br>
            Alternate text:".$alt."
            <br>
            Transcript:".$transcript."
            <br>
            Link of this comic:<a href='https://xkcd.com/$num/info.0.json'>".$link."</a>
            <br>
            <p>You are receiving this email because you have expressed interest in our XKCD comics.</p>
            <a href='https://epavitram.com/unsubscribe.php'>Unsubscribe</a>"
        );
        $file_encoded=base64_encode(file_get_contents($getpath));
        $email->addAttachment(
            $file_encoded,
            "application/jpg",
            "$title.jpg",
            "attachment"
           );
        $sendgrid = new \SendGrid(SENDGRID_API_KEY);
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            // print_r($response->headers());
            // print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }
}


    // Remote Database Connection
    $asm=new AutoSendingMail();
    $imgD=new DownloadImg();
    $details=$mysqli->query("SELECT fname,lname,email FROM visitor_det WHERE action='start'");
    
    // set array
    $array = array();
    // look through query
    while($row = mysqli_fetch_assoc($details)){
      // add each row returned into an array
      $array[] = $row;
    }
    
    // Fatching the random image.
    $no=rand(1,614);
    // Genarating link
    $link="https://xkcd.com/".$no."/info.0.json";
    // Genarating link and geting data from json file
    $value=curl_init("https://xkcd.com/".$no."/info.0.json");
    curl_setopt($value,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($value,CURLOPT_RETURNTRANSFER,true);
    $result=curl_exec($value);
    curl_close($value);
    $data=json_decode($result);
    // echo $link."<br>";
    $url=$data->img;
    $title=$data->title;
    $safe_title=$data->safe_title;
    $month=$data->month;
    $num=$data->num;
    $year=$data->year;
    $alt=$data->alt;
    $day=$data->day;
    $transcript=$data->transcript;

    // For image
    $check=$mysqli->query("SELECT * FROM image_det WHERE imgNum=$no");
    if(mysqli_num_rows($check) == 0)
    {
        $getpath=$imgD->downlo($no,$url,$title,$mysqli);
        
    }else{
         $getpath=$mysqli->query("SELECT imglocation FROM image_det WHERE imgNum='$no'");
    }
  

    // Foreach array loop and send email to them.
    foreach($array as $val){
        $fname=$val['fname'];
        $lname=$val['lname'];
        $email=$val['email'];
        // Calling function
        $asm->SendMail($fname,$lname,$email,$link,$getpath,$title,$month,$num,$transcript,$day,$year,$alt,$safe_title);
    }
    //   echo $getpath;
  
    
?>