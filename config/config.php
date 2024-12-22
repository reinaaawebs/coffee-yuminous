<?php

try { 
    //host

    define("HOST", "localhost");

    //dbname

    define("DBNAME", "coffee-blend");

    //user

    define("USER", "root");

    //password


    define("PASS", "");


    $conn = new PDO("mysql:host=".HOST.";dbname=".DBNAME."", USER, PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $Exception ) { 


    echo $Exception->getMessage();


}
   // if($conn == true) {
   //     echo "The connection to the database has been successfully established.";
   // } else {
   //     echo "An error occurred while attempting to connect to the database.";
   // }

    




?>