<?php
include '../../config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = $pdo->prepare("SELECT * FROM ventes WHERE id = :id");
    $query->execute(['id' => $id]);
    $vente = $query->fetch();
}
?>
<h1>Facture</h1>
<p>Produit : <?php echo $vente['produit']; ?></p>
<p>Quantité : <?php echo $vente['quantite']; ?></p>
<p>Prix Total : <?php echo $vente['prix_total']; ?></p>
<p>Date : <?php echo $vente['date']; ?></p>
