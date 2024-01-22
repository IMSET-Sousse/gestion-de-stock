<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && !empty($_POST['id'])) {
    // Assurez-vous de vérifier et valider les données avant de les utiliser dans la requête SQL
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
  

    // Emplacement où vous stockerez les images
    $imageFolder = './images/';

    // Vérifiez si un fichier a été téléchargé
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $imagePath = $imageFolder . basename($_FILES['file']['name']);

        // Déplacez le fichier téléchargé vers le dossier des images
        move_uploaded_file($_FILES['file']['tmp_name'], $imagePath);

        // Mettez à jour le chemin de l'image dans la base de données
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gestion-de-stock";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE produit SET titre=:titre, description=:description, prix=:prix,  image_path=:imagePath WHERE id=:id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':imagePath', $imagePath);
            $stmt->execute();

            echo "Produit modifié avec succès.";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }

        $conn = null;
    } else {
        echo "Erreur lors du téléchargement du fichier.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Produit</title>
</head>
<body>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        padding: 20px;
    }

    h2 {
        color: #28a745;
    text-align: center;
}
  form {
        max-width: 500px;
        margin: 0 auto;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input,
    textarea,
    select {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }

    button {
        background-color: #28a745;
        color: #fff;
        padding: 10px 15px;
        border: none;
        cursor: pointer;
    }

    button:hover {
        background-color: #218838;
    }
</style>
<h2>Modifier un Produit</h2>

<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérez les informations du produit à partir de la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gestion-de-stock";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM produit WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Affichez le formulaire avec les données du produit
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $result['id']; ?>">

                <label for="titre">Nom du Produit:</label>
                <input type="text" name="titre" value="<?php echo $result['titre']; ?>" required><br>

                <label for="description">Description:</label>
                <textarea name="description" required><?php echo $result['description']; ?></textarea><br>

                <label for="prix">Prix:</label>
                <input type="number" name="prix" step="0.01" value="<?php echo $result['prix']; ?>" required><br>

               
                <label>Image actuelle:</label>
                <img src="<?php echo $result['image_path']; ?>" alt="Image actuelle" style="max-width: 200px;"><br>

                <label for="file">Nouvelle Image:</label>
                <input type="file" name="file" accept="image/*"><br>

                <input type="submit" value="Modifier Produit">
            </form>
            <?php
        } else {
            echo "Aucun produit trouvé avec cet identifiant.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $conn = null;
} else {
    echo "L'identifiant du produit n'est pas spécifié.";
}
?>

</body>
</html>
