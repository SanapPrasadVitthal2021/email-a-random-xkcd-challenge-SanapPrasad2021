<?php
    require_once 'databaseConnection.php';
    class AutoSendingMail{
        function SendMail($firstName,$lastName,$receiver,$link,$url,$title,$month,$num,$transcript,$day,$year,$alt,$safe_title){
    
            $to=$receiver;
            $subject="XKCD Comics";
            // Message body for email
            $message= "<h2>Hi, $firstName $lastName</h2>
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
            <img src=".$url." alt=".$title.">
            <br>
            <p>You are receiving this email because you have expressed interest in our XKCD comics.</p>
            <a href='https://epavitram.com/unsubscribe.php'>Unsubscribe</a>";
            $sender = "From: prasadsanap@epavitram.com\r\n";
            $sender .= "MIME-Version: 1.0"."\r\n";
            $sender .="Content-type:text/html;charset=UTF-8"."\r\n";
            mail($to,$subject,$message,$sender);
            // echo $message;
        }
    }

    
    
    
    // Remote Database Connection
    $asm=new AutoSendingMail();
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
    
    // Foreach array loop and send email to them.
    foreach($array as $val){
    
        $fname=$val['fname'];
        $lname=$val['lname'];
        $email=$val['email'];
        // Calling function
        $asm->SendMail($fname,$lname,$email,$link,$url,$title,$month,$num,$transcript,$day,$year,$alt,$safe_title);
    }
    
?>