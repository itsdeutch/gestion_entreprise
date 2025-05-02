<?php
include 'config/database.php'; // Connexion à la base

try {
    // Récupérer tous les utilisateurs
    $query = $pdo->query("SELECT id, password FROM utilisateurs");
    $utilisateurs = $query->fetchAll();

    foreach ($utilisateurs as $utilisateur) {
        $password = $utilisateur['password'];

        // Vérifier si le mot de passe est déjà haché
        if (password_needs_rehash($password, PASSWORD_DEFAULT)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hachage du mot de passe
            $updateQuery = $pdo->prepare("UPDATE utilisateurs SET password = :password WHERE id = :id");
            $updateQuery->execute([
                'password' => $hashedPassword,
                'id' => $utilisateur['id']
            ]);

            echo "Mot de passe mis à jour pour l'utilisateur ID " . $utilisateur['id'] . "<br>";
        }
    }

    echo "Tous les mots de passe nécessitant une mise à jour ont été hachés avec succès !";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
