<?php
$hostName = "localhost";
$userName="garageuser";
$password="garageUserPass4";
$dbName="garage_system";
try {
    // PDO > PHP data object
    // create new pdo object to create connection with database
    $con = new PDO("mysql:host=$hostName;dbname=$dbName;charset=utf8",$userName, $password);
    // set PDO to throw exception on errors
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) {
    die("Databse connection failed.: ".$e->getMessage());
}

















?>