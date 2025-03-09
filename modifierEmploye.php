<?php
include 'config.php'; // Connexion à la BD

// --- Traitement de la mise à jour (méthode POST) ---
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer et sécuriser les données du formulaire
    $id            = intval($_POST['id']);
    $nom           = trim($_POST['nom']);
    $prenom        = trim($_POST['prenom']);
    $email         = trim($_POST['email']);
    $poste         = trim($_POST['poste']);
    $salaire       = trim($_POST['salaire']);
    $date_embauche = trim($_POST['date_embauche']);
    $departement   = trim($_POST['departement']);

    // Contrôles de saisie
    if (empty($nom) || empty($prenom) || empty($email) || empty($poste) || empty($salaire) || empty($date_embauche) || empty($departement)) {
        die("Tous les champs sont obligatoires.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("L'email fourni est invalide.");
    }

    // Préparation de la requête de mise à jour
    $stmt = $conn->prepare("UPDATE employes SET nom = ?, prenom = ?, email = ?, poste = ?, salaire = ?, date_embauche = ?, departement = ? WHERE id = ?");
    if (!$stmt) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }
    // On suppose que 'salaire' est un nombre (double) et que 'id' est un entier
    $stmt->bind_param("ssssdssi", $nom, $prenom, $email, $poste, $salaire, $date_embauche, $departement, $id);

    if ($stmt->execute()) {
        echo "Employé modifié avec succès.";
    } else {
        echo "Erreur lors de la modification : " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    exit();
}

// --- Affichage du formulaire pré-rempli (méthode GET) ---
if (!isset($_GET['id'])) {
    die("ID de l'employé non spécifié.");
}
$id = intval($_GET['id']);

// Récupération des informations de l'employé
$stmt = $conn->prepare("SELECT nom, prenom, email, poste, salaire, date_embauche, departement FROM employes WHERE id = ?");
if (!$stmt) {
    die("Erreur de préparation : " . $conn->error);
}
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nom, $prenom, $email, $poste, $salaire, $date_embauche, $departement);

if (!$stmt->fetch()) {
    die("Employé non trouvé.");
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier un employé</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Modifier l'employé</h2>
        <form action="modifierEmploye.php" method="POST">
            <!-- Champ caché pour l'ID de l'employé -->
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($nom); ?>" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo htmlspecialchars($prenom); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="mb-3">
                <label for="poste" class="form-label">Poste</label>
                <input type="text" class="form-control" id="poste" name="poste" value="<?php echo htmlspecialchars($poste); ?>" required>
            </div>
            <div class="mb-3">
                <label for="salaire" class="form-label">Salaire</label>
                <input type="number" step="0.01" class="form-control" id="salaire" name="salaire" value="<?php echo htmlspecialchars($salaire); ?>" required>
            </div>
            <div class="mb-3">
                <label for="date_embauche" class="form-label">Date d'embauche</label>
                <input type="date" class="form-control" id="date_embauche" name="date_embauche" value="<?php echo htmlspecialchars($date_embauche); ?>" required>
            </div>
            <div class="mb-3">
                <label for="departement" class="form-label">Département</label>
                <input type="text" class="form-control" id="departement" name="departement" value="<?php echo htmlspecialchars($departement); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>