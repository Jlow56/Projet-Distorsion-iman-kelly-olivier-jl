<?php
$host = "db.3wa.io";
$port = "3306";
$dbname = "oliviercharlet_distorsion";
$connexionString = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";

$user = "oliviercharlet";
$password = "7e387ec259db7b1b9e295d16e218a740";

$db = new PDO(
    $connexionString,
    $user,
    $password
);
?>


