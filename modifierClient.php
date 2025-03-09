<?php
include 'config.php'; // Fichier de connexion à la base de données

// --- Traitement de la modification (méthode POST) ---
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer et sécuriser les données du formulaire
    $id = intval($_POST['idclient']);
    $societe = trim($_POST['societe']);
    $contact = trim($_POST['contact']);
    $email = trim($_POST['email']);
    $telephone = trim($_POST['telephone']);

    // Contrôles de saisie
    if (empty($societe) || empty($contact) || empty($email) || empty($telephone)) {
        die("Tous les champs sont obligatoires.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("L'email fourni est invalide.");
    }

    // Préparer la requête de mise à jour
    $stmt = $conn->prepare("UPDATE clients SET societe = ?, contact = ?, email = ?, telephone = ? WHERE id = ?");
    if (!$stmt) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }
    $stmt->bind_param("ssssi", $societe, $contact, $email, $telephone, $id);

    if ($stmt->execute()) {
        echo "Client modifié avec succès.";
    } else {
        echo "Erreur lors de la modification : " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    exit();
}

// --- Affichage du formulaire pré-rempli (méthode GET) ---
if (!isset($_GET['idclient'])) {
    die("IDclient du client non spécifié.");
}
$idclient = intval($_GET['idclient']);

// Récupérer les informations du client depuis la base de données
$stmt = $conn->prepare("SELECT societe, contact, email, telephone FROM clients WHERE idclient = ?");
if (!$stmt) {
    die("Erreur de préparation : " . $conn->error);
}
$stmt->bind_param("i", $idclient);
$stmt->execute();
$stmt->bind_result($societe, $contact, $email, $telephone);

if (!$stmt->fetch()) {
    die("Client non trouvé.");
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier un client</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Modifier le client</h2>
        <form action="modifierClient.php" method="POST">
            <!-- Champ caché pour l'ID du client -->
            <input type="hidden" name="idclient" value="<?php echo htmlspecialchars($id); ?>">

            <div class="mb-3">
                <label for="societe" class="form-label">Société</label>
                <input type="text" class="form-control" id="societe" name="societe" value="<?php echo htmlspecialchars($societe); ?>" required>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Contact</label>
                <input type="text" class="form-control" id="contact" name="contact" value="<?php echo htmlspecialchars($contact); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo htmlspecialchars($telephone); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>