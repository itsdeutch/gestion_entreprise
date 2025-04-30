<?php
include '../../config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = $pdo->prepare("DELETE FROM clients WHERE id = :id");
    $query->execute(['id' => $id]);

    header("Location: index.php");
    exit();
} else {
    die("ID du client manquant.");
}
?>
