<?php
include '../../config/database.php';

 

// Récupérer tous les clients
$query = $pdo->query("SELECT * FROM clients ORDER BY nom ASC");
$clients = $query->fetchAll();

// Ajouter un client via le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter_client'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    $addQuery = $pdo->prepare("INSERT INTO clients (nom, email, telephone) VALUES (:nom, :email, :telephone)");
    $addQuery->execute([
        'nom' => $nom,
        'email' => $email,
        'telephone' => $telephone
    ]);

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
    <title>Liste des Clients</title>
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

        .form-container input {
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
    <h3>Liste des Clients</h3>

    <div class="form-container">
        <form method="POST">
            <h3>Ajouter un nouveau client</h3>
            <input type="text" name="nom" placeholder="Nom du Client" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="telephone" placeholder="Téléphone" required>
            <button type="submit" name="ajouter_client">Ajouter</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client): ?>
                <tr>
                    <td><?php echo $client['nom']; ?></td>
                    <td><?php echo $client['email']; ?></td>
                    <td><?php echo $client['telephone']; ?></td>
                    <td class="actions">
                        <button class="edit" onclick="modifierClient(<?php echo $client['id']; ?>)">Modifier</button>
                        <button class="delete" onclick="supprimerClient(<?php echo $client['id']; ?>)">Supprimer</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        function modifierClient(id) {
            window.location.href = `modifier.php?id=${id}`;
        }

        function supprimerClient(id) {
            if (confirm("Êtes-vous sûr de vouloir supprimer ce client ?")) {
                window.location.href = `supprimer.php?id=${id}`;
            }
        }
    </script>
</body>
</html>
