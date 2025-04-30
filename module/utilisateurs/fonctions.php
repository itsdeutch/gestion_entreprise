<?php
function getUtilisateurById($pdo, $id) {
    $query = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = :id");
    $query->execute(['id' => $id]);
    return $query->fetch();
}
?>
