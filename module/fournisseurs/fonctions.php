<?php
function getFournisseurById($pdo, $id) {
    $query = $pdo->prepare("SELECT * FROM fournisseurs WHERE id = :id");
    $query->execute(['id' => $id]);
    return $query->fetch();
}
?>
