<?php
 // PDO connection to database to allow other pages to recieve entries from database.
$server = "localhost";
$user = 'root';
$pass = '';


try{

$conn = new PDO("mysql:host=$server;dbname=finalproject", $user, $pass);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//echo"Connection is go!";

}catch(PDOException $e){

    echo 'Connection Failed: ' .$e->getMessage();

}

// Connection break on other pages.
// conn=null 
?>