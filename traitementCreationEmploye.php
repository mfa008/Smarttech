<?php
echo "bonjour";
// session_start();

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     try {
//         $db = new PDO('mysql:host=localhost;dbname=smarttech;charset=utf8', 'root', '');

//         $stmt = $db->prepare("INSERT INTO employes 
//             (nom, prenom, email, poste, salaire, date_embauche, departement)
//             VALUES (?, ?, ?, ?, ?, ?, ?)");

//         $stmt->execute([
//             $_POST['nom'],
//             $_POST['prenom'],
//             $_POST['email'],
//             $_POST['poste'],
//             $_POST['salaire'],
//             $_POST['date_embauche'],
//             $_POST['departement']
//         ]);

//         $_SESSION['success'] = "Employé enregistré avec succès!";
//     } catch (PDOException $e) {
//         $_SESSION['error'] = "Erreur : " . $e->getMessage();
//     }
//     header('Location: employe_form.php');
//     exit();
// }
