<?php
session_start(); // Ajout de la gestion des sessions
include 'config/database.php';

// Récupérer les totaux avec `fetchColumn()`
$totalClients = $pdo->query("SELECT COUNT(*) FROM clients")->fetchColumn();
$totalVentes = $pdo->query("SELECT SUM(quantite) AS total_ventes FROM ventes")->fetchColumn();
$totalProduits = $pdo->query("SELECT COUNT(*) FROM produits")->fetchColumn();
$totalFournisseurs = $pdo->query("SELECT COUNT(*) FROM fournisseurs")->fetchColumn();
$totalUtilisateurs = $pdo->query("SELECT COUNT(*) FROM utilisateurs")->fetchColumn();
?>

<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
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

        .logout {
            text-align: right;
            padding: 10px 20px;
        }

        .logout a {
            color: #ffffff;
            background-color: #d9534f;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .logout a:hover {
            background-color: #c9302c;
        }

        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .card {
            background: #ffffff;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
            padding: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);
        }

        .card h2 {
            font-size: 2em;
            color: #333;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 1.2em;
            color: #555;
        }

        .card a {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .card a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="logout">
        <a href="logout.php">Déconnexion</a>
    </div>
    <h1>PARFUME DE FRANCE</h1>
    <h3>Bienvenue sur le Tableau de Bord</h3>
    <div class="dashboard">
        <div class="card">
            <h2><?php echo $totalClients; ?></h2>
            <p>Total des Clients</p>
            <a href="module/clients/index.php">Voir les Clients</a>
        </div>
        <div class="card">
            <h2><?php echo $totalProduits; ?></h2>
            <p>Total des Produits</p>
            <a href="module/produits/index.php">Voir les Produits</a>
        </div>
        <div class="card">
            <h2><?php echo $totalVentes; ?></h2>
            <p>Total des Ventes</p>
            <a href="module/ventes/index.php">Voir les Ventes</a>
        </div>
        <div class="card">
            <h2><?php echo $totalFournisseurs; ?></h2>
            <p>Total des Fournisseurs</p>
            <a href="module/fournisseurs/index.php">Voir les Fournisseurs</a>
        </div>
        <div class="card">
            <h2><?php echo $totalUtilisateurs; ?></h2>
            <p>Total des Utilisateurs</p>
            <a href="module/utilisateurs/index.php">Voir les Utilisateurs</a>
        </div>
    </div>
</body>
</html>
