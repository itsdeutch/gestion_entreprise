<?php
include '../../config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les informations du produit
    $query = $pdo->prepare("SELECT * FROM produits WHERE id = :id");
    $query->execute(['id' => $id]);
    $produit = $query->fetch();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];

        // Vérifier si une nouvelle image a été téléchargée
        if (!empty($_FILES['image']['name'])) {
            $uploadDir = '../../uploads/';
            $imageName = basename($_FILES['image']['name']);
            $uploadFile = $uploadDir . $imageName;

            // Déplacer la nouvelle image
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $imagePath = 'uploads/' . $imageName;
            } else {
                $erreur = "Erreur lors de l'upload de l'image.";
            }
        } else {
            $imagePath = $produit['image']; // Garder l'image existante si aucune nouvelle image n'est uploadée
        }

        // Mettre à jour les informations du produit dans la base de données
        $updateQuery = $pdo->prepare("UPDATE produits SET nom = :nom, description = :description, prix = :prix, image = :image WHERE id = :id");
        $updateQuery->execute([
            'nom' => $nom,
            'description' => $description,
            'prix' => $prix,
            'image' => $imagePath,
            'id' => $id
        ]);

        header("Location: index.php");
        exit();
    }
} else {
    die("ID du produit manquant.");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Produit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #f9f9f9, #ffffff);
        }
        h1 {
            text-align: center;
            color: #007BFF;
            margin-bottom: 20px;
        }

        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }

        .form-container h3 {
            text-align: center;
            color: #007500;
        }

        .form-container input,
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-container input[type="file"] {
            margin-bottom: 10px;
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

        .product-image {
            display: block;
            margin: 10px auto;
            max-width: 100px;
        }
    </style>
</head>
<body>
<h1>PARFUME DE FRANCE</h1>
    <div class="form-container">
        <form method="POST" enctype="multipart/form-data">
            <h3>Modifier un Produit</h3>
            <input type="text" name="nom" value="<?php echo $produit['nom']; ?>" placeholder="Nom du produit" required>
            <textarea name="description" placeholder="Description" required><?php echo $produit['description']; ?></textarea>
            <input type="number" name="prix" value="<?php echo $produit['prix']; ?>" placeholder="Prix (€)" required step="0.01">
            <img src="../../<?php echo $produit['image']; ?>" alt="Image actuelle" class="product-image">
            <input type="file" name="image" accept="image/*">
            <button type="submit">Modifier</button>
        </form>
    </div>
</body>
</html>
