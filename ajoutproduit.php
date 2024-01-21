<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion-de-stock";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les catégories depuis la table "Categorie"
    $sqlCategories = "SELECT id, titre FROM Categorie";
    $stmtCategories = $conn->query($sqlCategories);
    $categories = $stmtCategories->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titre = $_POST["titre"];
        $description = $_POST["description"];
        $prix = $_POST["prix"];
        $categorie = $_POST["categorie"];

        // Récupérer l'ID de la catégorie en fonction de son titre
        $sqlGetCategoryId = "SELECT id FROM Categorie WHERE titre = :categorie";
        $stmtGetCategoryId = $conn->prepare($sqlGetCategoryId);
        $stmtGetCategoryId->bindParam(":categorie", $categorie);
        $stmtGetCategoryId->execute();
        $categorieId = $stmtGetCategoryId->fetchColumn();

        // Ajouter les données dans la table Produit avec la vérification de la catégorie
        if ($categorieId) {
            echo "Catégorie valide. ID de catégorie : $categorieId<br>";

            $sqlInsertProduit = "INSERT INTO Produit (titre, description, prix, categorie_id) VALUES (:titre, :description, :prix, :categorie_id)";
            $stmtInsertProduit = $conn->prepare($sqlInsertProduit);
            $stmtInsertProduit->bindParam(":titre", $titre);
            $stmtInsertProduit->bindParam(":description", $description);
            $stmtInsertProduit->bindParam(":prix", $prix);
            $stmtInsertProduit->bindParam(":categorie_id", $categorieId);

            // Exécuter la requête
            $stmtInsertProduit->execute();

            // Gérer le téléchargement du fichier
            if ($_FILES && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
                $targetDir = "./images/";
                $targetFile = $targetDir . basename($_FILES["file"]["name"]);
                move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile);

                // Enregistrer le chemin du fichier dans la base de données
                $sqlUpdateImagePath = "UPDATE Produit SET image_path = :image_path WHERE titre = :titre";
                $stmtUpdateImagePath = $conn->prepare($sqlUpdateImagePath);
                $stmtUpdateImagePath->bindParam(":image_path", $targetFile);
                $stmtUpdateImagePath->bindParam(":titre", $titre);
                $stmtUpdateImagePath->execute();

                echo "Fichier téléchargé avec succès. Chemin du fichier : $targetFile<br>";
            } else {
                echo "Erreur lors du téléchargement du fichier.<br>";
            }
        } else {
            echo "Catégorie non valide.";
        }
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>

<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  <title>Votre titre ici</title>
    <title>Ajouter un Produit</title>
    
</head>
<body>
    <h2>Ajouter un Produit</h2>
    <form method="post" enctype="multipart/form-data">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" required>
        <br>
        <label for="description">Description :</label>
        <textarea name="description" required></textarea>
        <br>
        <label for="prix">Prix :</label>
        <input type="number" step="0.01" name="prix" required>
        <br>
        <label for="file">Image :</label>
        <input type="file" name="file" accept="image/*">
        <br>
        <div class="input-group mb-3">
            <label for="categorie">Catégorie :</label>
            <select class="form-select" name="categorie" required>
                <option selected disabled>Choisissez une catégorie...</option>
                <?php
                foreach ($categories as $cat) {
                    echo "<option value='" . htmlspecialchars($cat['titre']) . "'>" . htmlspecialchars($cat['titre']) . "</option>";
                }
                ?>
            </select>
        </div>
       <button input type="submit" class="btn btn-outline-success" >Ajouter un produit </button>
        
    </form>
</body>
</html>
