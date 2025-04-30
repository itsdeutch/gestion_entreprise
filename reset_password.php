<?php
include 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Vérifier si l'email existe
    $query = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
    $query->execute(['email' => $email]);
    $utilisateur = $query->fetch();

    if ($utilisateur) {
        // Envoie d'un email fictif pour réinitialiser le mot de passe
        // En vrai, il faudrait utiliser une bibliothèque comme PHPMailer
        $message = "Bonjour, cliquez sur le lien suivant pour réinitialiser votre mot de passe : http://localhost/reset_password.php?email=$email";
        mail($email, "Réinitialisation du mot de passe", $message);
        $confirmation = "Un email de réinitialisation a été envoyé à $email.";
    } else {
        $erreur = "Email introuvable.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du Mot de Passe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #f4f6f9, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .reset-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .reset-container h1 {
            text-align: center;
            color: #007BFF;
            margin-bottom: 20px;
        }

        .reset-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .reset-container button {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .reset-container button:hover {
            background: #0056b3;
        }

        .error-message,
        .confirmation-message {
            text-align: center;
            margin-bottom: 15px;
            font-size: 0.9em;
        }

        .error-message {
            color: #d9534f;
        }

        .confirmation-message {
            color: #5cb85c;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <h1>Réinitialisation du Mot de Passe</h1>
        <?php if (isset($erreur)): ?>
            <p class="error-message"><?php echo $erreur; ?></p>
        <?php elseif (isset($confirmation)): ?>
            <p class="confirmation-message"><?php echo $confirmation; ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Entrez votre email" required>
            <button type="submit">Envoyer</button>
        </form>
    </div>
</body>
</html>
