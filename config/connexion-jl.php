<?php
$host = "db.3wa.io";
$port = "3306";
$dbname = "jeanlouisjean_distortion_groupe1";
$connexionString = "mysql:host=$host;port=$port;dbname=$dbname";
// charset=utf8";
$user = "jeanlouisjean";
$password = "22d18cb47bce6a70993e6a4ea2e4eb40";

$db = new PDO(
    $connexionString,
    $user,
    $password,
);
?>