<?php
include '../../config/database.php';

// Vérifier si la colonne `image` existe dans la table `produits`
$queryCheck = $pdo->query("SHOW COLUMNS FROM produits LIKE 'image'");
$imageColumnExists = $queryCheck->rowCount();

if ($imageColumnExists == 0) {
    $pdo->query("ALTER TABLE produits ADD COLUMN image VARCHAR(255) NULL");
}

// Chemin où les images seront stockées
$uploadDir = '../../uploads/';

// Ajouter un produit via le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter_produit'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];

    // Vérifier si une image a été téléchargée
    if (!empty($_FILES['image']['name'])) {
        $imageName = basename($_FILES['image']['name']);
        $uploadFile = $uploadDir . $imageName;
        $imageType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

        // Vérifier si c'est bien une image
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $imagePath = 'uploads/' . $imageName;
            } else {
                $erreur = "Erreur lors de l'upload de l'image.";
            }
        } else {
            $erreur = "Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
        }
    }

    // Enregistrement dans la base de données
    $addQuery = $pdo->prepare("INSERT INTO produits (nom, description, prix, image, created_at) VALUES (:nom, :description, :prix, :image, NOW())");
    $addQuery->execute([
        'nom' => $nom,
        'description' => $description,
        'prix' => $prix,
        'image' => $imagePath ?? ''
    ]);

    header("Location: index.php");
    exit();
}

// Récupérer tous les produits existants
$query = $pdo->query("SELECT * FROM produits ORDER BY created_at DESC");
$produits = $query->fetchAll();
?>
<?php include '../../navbar.php'; ?> <!-- Inclure la barre de navigation -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits</title>
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

        .product-image {
            max-width: 100px;
            border-radius: 8px;
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

    </style>
</head>
<body>
<h1>PARFUME DE FRANCE</h1>
<h3>Liste des Produits</h3>

<div class="form-container">
    <form method="POST" enctype="multipart/form-data">
        <h3>Ajouter un nouveau produit</h3>
        <input type="text" name="nom" placeholder="Nom du produit" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="number" name="prix" placeholder="Prix (€)" required step="0.01">
        <input type="file" name="image" accept="image/*">
        <button type="submit" name="ajouter_produit">Ajouter</button>
    </form>
</div>

<table>
    <thead>
        <tr>
            <th>Image</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Date d'ajout</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produits as $produit): ?>
            <tr>
                <td>
                    <?php if (!empty($produit['image'])): ?>
                        <img src="../../<?php echo htmlspecialchars($produit['image']); ?>" alt="<?php echo htmlspecialchars($produit['nom']); ?>" class="product-image">
                    <?php else: ?>
                        N/A
                    <?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars($produit['nom']); ?></td>
                <td><?php echo htmlspecialchars($produit['description']); ?></td>
                <td><?php echo number_format($produit['prix'], 2); ?> €</td>
                <td><?php echo htmlspecialchars($produit['created_at']); ?></td>
                <td class="actions">
                    <button class="edit" onclick="modifierProduit(<?php echo $produit['id']; ?>)">Modifier</button>
                    <button class="delete" onclick="supprimerProduit(<?php echo $produit['id']; ?>)">Supprimer</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    function modifierProduit(id) {
        window.location.href = `modifier.php?id=${id}`;
    }

    function supprimerProduit(id) {
        if (confirm("Êtes-vous sûr de vouloir supprimer ce produit ?")) {
            window.location.href = `supprimer.php?id=${id}`;
        }
    }
</script>
</body>
</html>
