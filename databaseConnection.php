<?php
    
    $username="sampleUsername";//Enter here your user name.
    $password="samplePassword";//Enter password here
    $database="sampleDatabase";//Enter database name here

    $mysqli=NEW MySQLi('localhost',$username,$password,$database);
    if ($mymysqli->connect_error) {
        die("Connection failed: " . $mymysqli->connect_error);
      }
    else{
        echo "Connected successfully";
    }

?>