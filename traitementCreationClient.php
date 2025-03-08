<?php
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $db = new mysqli('localhost', 'admin', 'passer', 'smarttech');
    if ($db->connect_error) {
        die("Échec de la connexion : " . $db->connect_error);
    }

    $stmt = $db->prepare("INSERT INTO client (societe, contact, email, telephone, date_ajout) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Erreur de préparation de la requête : " . $db->error);
    }

    $societe = $_POST['societe'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $date_ajout = $_POST['date_ajout'];

    $stmt->bind_param('sssss', $societe, $contact, $email, $telephone, $date_ajout);

    $stmt->execute();
    echo "Client enregistré avec succès!";

    exit();
}
