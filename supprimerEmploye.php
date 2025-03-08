<?php
include 'config.php'; // Inclusion de la connexion à la BD

// Vérifier si l'ID est présent dans l'URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sécuriser l'ID en forçant un entier

    // Requête de suppression
    $sql = "DELETE FROM employes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Rediriger avec un message de succès
        header("Location: index.html");
    } else {
        // Rediriger avec un message d'erreur
        header("Location: index.php?message=error");
    }

    // Fermer la requête et la connexion
    $stmt->close();
    $conn->close();
} else {
    header("Location: index.html");
}
