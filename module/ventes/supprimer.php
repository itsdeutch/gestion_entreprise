<?php
include '../../config/database.php';

// Vérifier si l'ID de la vente est passé
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Supprimer la vente de la base de données
    $query = $pdo->prepare("DELETE FROM ventes WHERE id = :id");
    $query->execute(['id' => $id]);

    header("Location: index.php");
    exit();
} else {
    die("ID de la vente manquant.");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer une Vente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #ffdddd, #ffffff);
            text-align: center;
        }

        h1 {
            color: #d9534f;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            background: #d9534f;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            transition: background 0.3s ease;
        }

        a:hover {
            background: #c12e2a;
        }
    </style>
</head>
<body>
    <h1>Vente Supprimée !</h1>
    <a href="index.php">Retour à la liste des ventes</a>
</body>
</html>
