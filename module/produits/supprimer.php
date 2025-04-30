<?php
include '../../config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer le produit pour supprimer l'image associée
    $query = $pdo->prepare("SELECT * FROM produits WHERE id = :id");
    $query->execute(['id' => $id]);
    $produit = $query->fetch();

    if ($produit) {
        // Supprimer l'image si elle existe
        if (!empty($produit['image'])) {
            $imagePath = '../../' . $produit['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Supprimer le produit de la base de données
        $deleteQuery = $pdo->prepare("DELETE FROM produits WHERE id = :id");
        $deleteQuery->execute(['id' => $id]);
    }

    header("Location: index.php");
    exit();
} else {
    die("ID du produit manquant.");
}
?>
