<?php
include '../../config/database.php';

// Vérifie si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    // Insérer le nouveau fournisseur dans la base de données
    $query = $pdo->prepare("INSERT INTO fournisseurs (nom, email, telephone) VALUES (:nom, :email, :telephone)");
    $query->execute([
        'nom' => $nom,
        'email' => $email,
        'telephone' => $telephone
    ]);

    // Rediriger vers la page de la liste des fournisseurs
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Fournisseur</title>
    <style>
        /* Style de base */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #ffffff, #f4f6f9);
        }

        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }

        .form-container h1 {
            text-align: center;
            color: #007BFF;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .form-container button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form method="POST">
            <h1>Ajouter un Fournisseur</h1>
            <input type="text" name="nom" placeholder="Nom du Fournisseur" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="telephone" placeholder="Téléphone" required>
            <button type="submit">Ajouter</button>
        </form>
    </div>
</body>
</html>
