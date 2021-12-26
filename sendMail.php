<?php


    function SendMail($fname,$lname,$email,$vkey)
    {
        $to=$email;
        $subject="Email Verification";
        $message= "<h3>Hey $fname $lname, you're almost ready to start enjoing<strong> XKCD Comics</strong>.Simply verify your email address with your one time password.</h3><br><h3>Verification OTP:<br>$vkey</h3><br><br><br><h5>Thank you.</h5>";
        $sender = "From: prasadsanap@epavitram.com\r\n";
        $sender .= "MIME-Version: 1.0"."\r\n";
        $sender .="Content-type:text/html;charset=UTF-8"."\r\n";
        
        if(mail($to,$subject,$message,$sender)){
            $insert=$mysqli->query("INSERT INTO visitor_det(fname,lname,email,vkey,action)VALUES('$fname','$lname','$email','$vkey','$action')");
            if($insert){
                header('location:thankyou.php');
            }
        }else{
            header('location:index.php');
            echo "<h2>Your email is not valid please try another or re-check.</h2>";
        }
          
    }

?>