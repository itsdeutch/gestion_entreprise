<?php
include '../../config/database.php';

// Vérifier si l'utilisateur est identifié par son rôle (admin ou utilisateur standard)
session_start(); // Démarrer la session pour gérer les autorisations.
$roleActuel = $_SESSION['role'] ?? ''; // On récupère le rôle actuel de la session.

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les données actuelles de l'utilisateur
    $query = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = :id");
    $query->execute(['id' => $id]);
    $utilisateur = $query->fetch();

    if (!$utilisateur) {
        header("Location: index.php");
        exit();
    }

    // Autoriser uniquement les modifications par un admin
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier_utilisateur']) && $roleActuel === 'admin') {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $role = $_POST['role'] ?? 'utilisateur';

        // Mettre à jour les informations dans la base
        $updateQuery = $pdo->prepare("UPDATE utilisateurs SET username = :username, email = :email, role = :role WHERE id = :id");
        $updateQuery->execute([
            'username' => $username,
            'email' => $email,
            'role' => $role,
            'id' => $id
        ]);

        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'utilisateur</title>
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

        .form-container input,
        .form-container select {
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
    <h3>Modifier l'utilisateur</h3>

    <div class="form-container">
        <?php if ($roleActuel === 'admin'): ?>
            <form method="POST">
                <input type="text" name="username" value="<?php echo htmlspecialchars($utilisateur['username']); ?>" required>
                <input type="email" name="email" value="<?php echo htmlspecialchars($utilisateur['email']); ?>" required>
                <select name="role">
                    <option value="admin" <?php echo $utilisateur['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="utilisateur" <?php echo $utilisateur['role'] === 'utilisateur' ? 'selected' : ''; ?>>Utilisateur</option>
                    <option value="membre" <?php echo $utilisateur['role'] === 'membre' ? 'selected' : ''; ?>>Membre</option>
                </select>
                <button type="submit" name="modifier_utilisateur">Mettre à jour</button>
            </form>
        <?php else: ?>
            <p style="color: red; text-align: center;">Vous n'avez pas l'autorisation de modifier cet utilisateur.</p>
        <?php endif; ?>
    </div>
</body>
</html>
