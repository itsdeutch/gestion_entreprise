<?php
session_start();

// Vérification de la connexion et rôle
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../../login.php");
    exit();
}

include '../../config/database.php';

// Récupérer tous les utilisateurs
$query = $pdo->query("SELECT id, username, email, role FROM utilisateurs ORDER BY username ASC");
$utilisateurs = $query->fetchAll();

// Ajouter un utilisateur via le formulaire avec un mot de passe sécurisé
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter_utilisateur']) && $_SESSION['role'] === 'admin') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hachage du mot de passe

    // Vérifier si l'email existe déjà
    $checkEmail = $pdo->prepare("SELECT COUNT(*) FROM utilisateurs WHERE email = :email");
    $checkEmail->execute(['email' => $email]);
    $emailExists = $checkEmail->fetchColumn();

    if ($emailExists > 0) {
        die("Erreur : Cet email est déjà utilisé !");
    }

    try {
        $addQuery = $pdo->prepare("INSERT INTO utilisateurs (username, email, password, role) VALUES (:username, :email, :password, :role)");
        $addQuery->execute([
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'role' => $role
        ]);

        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de l'ajout de l'utilisateur : " . $e->getMessage());
    }
}

// Suppression d'un utilisateur (admin uniquement)
if (isset($_GET['supprimer']) && $_SESSION['role'] === 'admin') {
    $id = $_GET['supprimer'];
    $deleteQuery = $pdo->prepare("DELETE FROM utilisateurs WHERE id = :id");
    $deleteQuery->execute(['id' => $id]);

    header("Location: index.php");
    exit();
}
?>

<?php include '../../navbar.php'; ?> <!-- Inclure la barre de navigation -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Utilisateurs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #f4f6f9, #ffffff);
        }

        h1, h3 {
            text-align: center;
            color: #007BFF;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .actions button {
            padding: 8px 12px;
            margin: 0 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .edit {
            background-color: #f0ad4e;
            color: white;
        }

        .edit:hover {
            background-color: #d99639;
        }

        .delete {
            background-color: #d9534f;
            color: white;
        }

        .delete:hover {
            background-color: #c12e2a;
        }

        .form-container {
            margin: 20px auto;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            max-width: 500px;
            text-align: center;
        }

        .form-container input,
        .form-container select {
            width: calc(100% - 10px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-container button {
            padding: 10px 20px;
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
    <h3>Liste des Utilisateurs</h3>

    <?php if ($_SESSION['role'] === 'admin'): ?>
        <div class="form-container">
            <form method="POST">
                <h3>Ajouter un nouvel utilisateur</h3>
                <input type="text" name="username" placeholder="Nom d'utilisateur" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <select name="role" required>
                    <option value="admin">Admin</option>
                    <option value="utilisateur">Utilisateur</option>
                    <option value="membre">Membre</option>
                </select>
                <button type="submit" name="ajouter_utilisateur">Ajouter</button>
            </form>
        </div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Nom d'utilisateur</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($utilisateurs as $utilisateur): ?>
                <tr>
                    <td><?php echo htmlspecialchars($utilisateur['username']); ?></td>
                    <td><?php echo htmlspecialchars($utilisateur['email']); ?></td>
                    <td><?php echo ucfirst(htmlspecialchars($utilisateur['role'])); ?></td>
                    <td class="actions">
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <button class="edit" onclick="modifierUtilisateur(<?php echo $utilisateur['id']; ?>)">Modifier</button>
                            <button class="delete" onclick="supprimerUtilisateur(<?php echo $utilisateur['id']; ?>)">Supprimer</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        function modifierUtilisateur(id) {
            window.location.href = `modifier.php?id=${id}`;
        }

        function supprimerUtilisateur(id) {
            if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
                window.location.href = `index.php?supprimer=${id}`;
            }
        }
    </script>
</body>
</html>
