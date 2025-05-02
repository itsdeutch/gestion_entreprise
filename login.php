<?php
session_start();
include 'config/database.php';

// Si l'utilisateur est déjà connecté, rediriger vers le tableau de bord
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

// Vérification de la connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Vérification que les champs ne sont pas vides
    if (empty($email) || empty($password)) {
        $erreur = "Tous les champs doivent être remplis.";
    } else {
        // Requête pour récupérer l'utilisateur avec l'email
        $query = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $query->execute(['email' => $email]);
        $utilisateur = $query->fetch();

        // Vérification des identifiants
        if ($utilisateur && password_verify($password, $utilisateur['password'])) {
            session_regenerate_id(true); // Sécurisation de la session
            $_SESSION['username'] = $utilisateur['username'];
            $_SESSION['role'] = $utilisateur['role'];
            $_SESSION['id'] = $utilisateur['id'];

            header("Location: dashboard.php");
            exit();
        } else {
            $erreur = "Email ou mot de passe incorrect.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
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
        .login-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-container h1 {
            text-align: center;
            color: #007BFF;
            margin-bottom: 20px;
        }
        .login-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .login-container button:hover {
            background: #0056b3;
        }
        .error-message {
            color: #d9534f;
            font-size: 0.9em;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Connexion</h1>
        <?php if (!empty($erreur)): ?>
            <p class="error-message"><?php echo htmlspecialchars($erreur); ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>
