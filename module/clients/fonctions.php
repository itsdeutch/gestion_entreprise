<?php
function getClientById($pdo, $id) {
    $query = $pdo->prepare("SELECT * FROM clients WHERE id = :id");
    $query->execute(['id' => $id]);
    return $query->fetch();
}
?>
