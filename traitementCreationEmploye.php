<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


    // $db = new mysqli('localhost', 'admin', 'passer', 'smarttech');
    // if ($db->connect_error) {
    //     die("Échec de la connexion : " . $db->connect_error);
    // }
    $stmt = $conn->prepare("INSERT INTO employes 
            (nom, prenom, email, poste, salaire, date_embauche, departement)
            VALUES (?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Erreur de préparation de la requête : " . $db->error);
    }
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $poste = $_POST['poste'];
    $salaire = $_POST['salaire'];
    $date_embauche = $_POST['date_embauche'];
    $departement = $_POST['departement'];


    if (!$stmt->bind_param('ssssdss', $nom, $prenom, $email, $poste, $salaire, $date_embauche, $departement)) {
        die("Erreur lors du bind_param : " . $stmt->error);
    }

    if (!$stmt->execute()) {
        die("Erreur lors de l'exécution : " . $stmt->error);
    }


    echo "Employé enregistré avec succès!";

    exit();
}
