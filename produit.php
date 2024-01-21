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

    // Si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Assurez-vous de vérifier et valider les données avant de les utiliser dans la requête SQL
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $selectedCategory = $_POST['categorie']; // Catégorie sélectionnée

        // Stockez les images dans le dossier "./images/"
        $imageFolder = './images/';

        // Vérifiez si un fichier a été téléchargé
        if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
            $imagePath = $imageFolder . basename($_FILES['file']['name']);

            // Déplacez le fichier téléchargé vers le dossier des images
            move_uploaded_file($_FILES['file']['tmp_name'], $imagePath);

            try {
                // Ajoutez le produit avec la catégorie sélectionnée
                $insertProductQuery = $conn->prepare("INSERT INTO Produit (titre, description, prix, image_path, categorie_id) VALUES (:titre, :description, :prix, :imagePath, :selectedCategory)");
                $insertProductQuery->bindParam(':titre', $titre);
                $insertProductQuery->bindParam(':description', $description);
                $insertProductQuery->bindParam(':prix', $prix);
                $insertProductQuery->bindParam(':imagePath', $imagePath);
                $insertProductQuery->bindParam(':selectedCategory', $selectedCategory);
                $insertProductQuery->execute();

                echo "Produit ajouté avec succès.";
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
        } else {
            echo "Erreur lors du téléchargement du fichier.";
        }
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
} finally {
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Produit</title>
</head>
<body>
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
                foreach ($categories as $category) {
                    echo "<option value='" . htmlspecialchars($category['titre']) . "'>" . htmlspecialchars($category['titre']) . "</option>";
                }
                ?>
            </select>
        </div>
        <input type="submit" value="Ajouter Produit">
    </form>
</body>
</html>
