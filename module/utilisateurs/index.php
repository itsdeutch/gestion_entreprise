<?php
session_start(); // Démarrer la session pour gérer les rôles et autorisations.

// Vérification de la connexion et rôle
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: login.php"); // Redirection vers la page de connexion si non connecté.
    exit();
}

include '../../config/database.php';

// Récupérer tous les utilisateurs
$query = $pdo->query("SELECT * FROM utilisateurs ORDER BY username ASC");
$utilisateurs = $query->fetchAll();

// Ajouter un utilisateur via le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter_utilisateur']) && $_SESSION['role'] === 'admin') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $addQuery = $pdo->prepare("INSERT INTO utilisateurs (username, email, role) VALUES (:username, :email, :role)");
    $addQuery->execute([
        'username' => $username,
        'email' => $email,
        'role' => $role
    ]);

    header("Location: index.php");
    exit();
}
?>
<?php include'../../navbar.php'; ?> <!-- Inclure la barre de navigation -->
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

        h1 {
            text-align: center;
            color: #007BFF;
            margin-bottom: 20px;
        }
        h3 {
            
            text-align: center;
            color:rgb(255, 0, 0);
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

        .actions .edit {
            background-color: #f0ad4e;
            color: white;
        }

        .actions .edit:hover {
            background-color: #d99639;
        }

        .actions .delete {
            background-color: #d9534f;
            color: white;
        }

        .actions .delete:hover {
            background-color: #c12e2a;
        }

        .form-container {
            margin: 20px 0;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .form-container input,
        .form-container select {
            width: calc(33% - 10px);
            padding: 10px;
            margin-right: 10px;
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

    <?php if ($_SESSION['role'] === 'admin'): // Vérifier si le rôle actuel est admin ?>
        <div class="form-container">
            <form method="POST">
                <h3>Ajouter un nouvel utilisateur</h3>
                <input type="text" name="username" placeholder="Nom d'utilisateur" required>
                <input type="email" name="email" placeholder="Email" required>
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
                    <td><?php echo ucfirst($utilisateur['role']); ?></td>
                    <td class="actions">
                        <?php if ($_SESSION['role'] === 'admin'): // Vérifier si le rôle actuel est admin ?>
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
                window.location.href = `supprimer.php?id=${id}`;
            }
        }
    </script>
</body>
</html>
