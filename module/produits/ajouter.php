<?php
include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $image = $_POST['image']; // URL de l'image ou chemin

    $query = $pdo->prepare("INSERT INTO produits (nom, description, prix, image) VALUES (:nom, :description, :prix, :image)");
    $query->execute(['nom' => $nom, 'description' => $description, 'prix' => $prix, 'image' => $image]);

    header("Location: index.php");
}
?>
<form method="POST">
    <input type="text" name="nom" placeholder="Nom du produit" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <input type="number" name="prix" placeholder="Prix" required step="0.01">
    <input type="text" name="image" placeholder="URL de l'image" required>
    <button type="submit">Ajouter</button>
</form>
