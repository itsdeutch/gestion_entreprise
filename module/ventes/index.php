<?php
include '../../config/database.php';

// Calculer le total des ventes
$totalQuery = $pdo->query("SELECT SUM(montant) AS total_ventes FROM ventes");
$totalResult = $totalQuery->fetch();
$totalVentes = $totalResult['total_ventes'] ?? 0;

// Récupérer toutes les ventes
$query = $pdo->query("SELECT * FROM ventes ORDER BY nom");
$ventes = $query->fetchAll();

// Ajouter une nouvelle vente
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter_ventes'])) {
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $telephone = $_POST['telephone'] ?? '';
    $montant = $_POST['montant'] ?? 0;

    $addQuery = $pdo->prepare("INSERT INTO ventes (nom, email, telephone, montant) VALUES (:nom, :email, :telephone, :montant)");
    $addQuery->execute([
        'nom' => $nom,
        'email' => $email,
        'telephone' => $telephone,
        'montant' => $montant
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
    <title>Liste des Ventes</title>
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
        h2 {
            text-align: center;
            color:rgb(179, 3, 3);
            margin-bottom: 20px;
        }

        h3 {
            text-align: center;
            color: #28a745;
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
            width: calc(25% - 10px);
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
    <h1>PARFUME DE FRANCE </H1>
    <h2>Liste des Ventes</h2>
    <h3>Total des Ventes : <?php echo number_format($totalVentes, 2); ?> €</h3>

    <div class="form-container">
        <form method="POST">
            <h3>Ajouter une nouvelle Vente</h3>
            <input type="text" name="nom" placeholder="Nom de la Vente" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="telephone" placeholder="Téléphone" required>
            <input type="number" step="0.01" name="montant" placeholder="Montant de la Vente" required>
            <button type="submit" name="ajouter_ventes">Ajouter</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Montant</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ventes as $vente): ?>
                <tr>
                    <td><?php echo htmlspecialchars($vente['nom']); ?></td>
                    <td><?php echo htmlspecialchars($vente['email']); ?></td>
                    <td><?php echo htmlspecialchars($vente['telephone']); ?></td>
                    <td><?php echo number_format($vente['montant'], 2); ?> €</td>
                    <td class="actions">
                        <button class="edit" onclick="modifierVentes(<?php echo $vente['id']; ?>)">Modifier</button>
                        <button class="delete" onclick="supprimerVentes(<?php echo $vente['id']; ?>)">Supprimer</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        function modifierVentes(id) {
            window.location.href = `modifier.php?id=${id}`;
        }

        function supprimerVentes(id) {
            if (confirm("Êtes-vous sûr de vouloir supprimer cette vente ?")) {
                window.location.href = `supprimer.php?id=${id}`;
            }
        }
    </script>
</body>
</html>
