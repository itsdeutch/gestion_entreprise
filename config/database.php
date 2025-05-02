<?php
// Configuration de connexion à la base de données
$host = 'localhost';
$port = '3307';
$dbname = 'gestion_entreprise';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=127.0.0.1;port=3307;dbname=gestion_entreprise", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
