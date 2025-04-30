<?php
function getProduitById($pdo, $id) {
    $query = $pdo->prepare("SELECT * FROM produits WHERE id = :id");
    $query->execute(['id' => $id]);
    return $query->fetch();
}
?>
