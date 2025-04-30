<?php
include 'config/database.php'; // Connexion à la base

try {
    // Récupérer tous les utilisateurs
    $query = $pdo->query("SELECT id, password FROM utilisateurs");
    $utilisateurs = $query->fetchAll();

    foreach ($utilisateurs as $utilisateur) {
        $hashedPassword = password_hash($utilisateur['password'], PASSWORD_DEFAULT); // Hachage du mot de passe
        $updateQuery = $pdo->prepare("UPDATE utilisateurs SET password = :password WHERE id = :id");
        $updateQuery->execute([
            'password' => $hashedPassword,
            'id' => $utilisateur['id']
        ]);
    }

    echo "Tous les mots de passe ont été hachés avec succès !";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
