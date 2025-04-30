<?php
// Fonction pour rediriger l'utilisateur
function redirect($url) {
    header("Location: $url");
    exit();
}

// Fonction pour vérifier si un utilisateur est connecté
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Fonction pour afficher un message d'erreur ou de succès
function flashMessage($message, $type = 'success') {
    echo "<div class='message {$type}'>{$message}</div>";
}
?>
