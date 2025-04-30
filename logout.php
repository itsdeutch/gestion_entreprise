<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #fffbfb, #d9534f);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #ffffff;
        }
        .logout-container {
            text-align: center;
            padding: 20px;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        }
        .logout-container h1 {
            font-size: 2em;
            margin-bottom: 10px;
        }
        .logout-container p {
            font-size: 1.2em;
            margin-bottom: 20px;
        }
        .logout-container a {
            text-decoration: none;
            color: #ffffff;
            background: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        .logout-container a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <h1>Déconnexion Réussie</h1>
        <p>Vous avez été déconnecté avec succès.</p>
        <a href="login.php">Retourner à la Connexion</a>
    </div>
</body>
</html>
