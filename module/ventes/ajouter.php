<?php
include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produit = $_POST['produit'];
    $quantite = $_POST['quantite'];
    $prix_total = $_POST['prix_total'];

    $query = $pdo->prepare("INSERT INTO ventes (produit, quantite, prix_total, date) VALUES (:produit, :quantite, :prix_total, NOW())");
    $query->execute(['produit' => $produit, 'quantite' => $quantite, 'prix_total' => $prix_total]);

    header("Location: index.php");
}
?>
<form method="POST">
    <input type="text" name="produit" placeholder="Nom du produit" required>
    <input type="number" name="quantite" placeholder="Quantité" required>
    <input type="number" name="prix_total" placeholder="Prix Total" required step="0.01">
    <button type="submit">Ajouter</button>
</form>
