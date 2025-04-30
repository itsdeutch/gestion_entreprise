<?php
function getVenteById($pdo, $id) {
    $query = $pdo->prepare("SELECT * FROM ventes WHERE id = :id");
    $query->execute(['id' => $id]);
    return $query->fetch();
}
?>
