<?php
$host = "localhost";  // Adresse du serveur MySQL/MariaDB
$user = "admin";      // Nom d'utilisateur de la base de données
$password = "passer"; // Mot de passe de l'utilisateur
$dbname = "smarttech"; // Nom de la base de données

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

$conn->set_charset("utf8");

// Optionnel : Afficher un message de connexion réussie en mode développement
//echo "Connexion réussie !";
