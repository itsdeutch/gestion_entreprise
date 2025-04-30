<?php
include '../../config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les données actuelles du client
    $query = $pdo->prepare("SELECT * FROM clients WHERE id = :id");
    $query->execute(['id' => $id]);
    $client = $query->fetch();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier_client'])) {
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];

        // Mettre à jour les données dans la base
        $updateQuery = $pdo->prepare("UPDATE clients SET nom = :nom, email = :email, telephone = :telephone WHERE id = :id");
        $updateQuery->execute([
            'nom' => $nom,
            'email' => $email,
            'telephone' => $telephone,
            'id' => $id
        ]);

        header("Location: index.php");
        exit();
    }
} else {
    // Redirige si aucun ID n'est fourni
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Client</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #f4f6f9, #ffffff);
        }

        h1 {
            text-align: center;
            color: #007BFF;
            margin-bottom: 20px;
        }
        h3 {
            text-align: center;
            color: #007500;
            margin-bottom: 20px;
        }

        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .form-container input {
            width: calc(100% - 20px);
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
<h1>PARFUME DE FRANCE</h1>
    <h3>Modifier le Client</h3>

    <div class="form-container">
        <form method="POST">
            <input type="text" name="nom" value="<?php echo htmlspecialchars($client['nom']); ?>" required>
            <input type="email" name="email" value="<?php echo htmlspecialchars($client['email']); ?>" required>
            <input type="text" name="telephone" value="<?php echo htmlspecialchars($client['telephone']); ?>" required>
            <button type="submit" name="modifier_client">Mettre à jour</button>
        </form>
    </div>
</body>
</html>
