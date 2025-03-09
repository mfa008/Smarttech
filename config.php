<?php
$host = "localhost";
$user = "admin";
$password = "passer";
$dbname = "smarttech";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

$conn->set_charset("utf8");
