<?php
include 'config.php'; // Inclusion de la connexion à la BD

// Vérifier si l'ID est présent dans l'URL
if (isset($_GET['idclient'])) {
    $idclient = intval($_GET['idclient']); // Sécuriser l'ID en forçant un entier

    // Requête de suppression
    $sql = "DELETE FROM client WHERE idclient = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idclient);

    if ($stmt->execute()) {
        // Rediriger avec un message de succès
        header("Location: GestionClients.php");
    } else {
        // Rediriger avec un message d'erreur
        header("Location: index.php?message=error");
    }

    // Fermer la requête et la connexion
    $stmt->close();
    $conn->close();
} else {
    header("Location: GestionClients.php");
}
