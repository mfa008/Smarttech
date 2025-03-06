<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db = new PDO('mysql:host=127.0.0.1;dbname=smarttech;charset=utf8', 'root', '');

        $stmt = $db->prepare("INSERT INTO employes 
            (nom, prenom, email, poste, salaire, date_embauche, departement)
            VALUES (?, ?, ?, ?, ?, ?, ?)");
        var_dump($_POST);
        $stmt->execute([
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['poste'],
            $_POST['salaire'],
            $_POST['date_embauche'],
            $_POST['departement']
        ]);
        echo "employer enregistrer";
        // $_SESSION['success'] = "Employé enregistré avec succès!";
    } catch (PDOException $e) {
        // $_SESSION['error'] = "Erreur : " . $e->getMessage();
        echo "employer non enregistrer";
    }
    // header('Location: employe_form.php');
    echo $_SESSION;
    exit();
}
