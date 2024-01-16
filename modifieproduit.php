<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && !empty($_POST['id'])) {
    // Assurez-vous de vérifier et valider les données avant de les utiliser dans la requête SQL
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];

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

            $sql = "UPDATE produit SET nom=:nom, description=:description, prix=:prix, stock=:stock, image_path=:imagePath WHERE id=:id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':stock', $stock);
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

                <label for="nom">Nom du Produit:</label>
                <input type="text" name="nom" value="<?php echo $result['nom']; ?>" required><br>

                <label for="description">Description:</label>
                <textarea name="description" required><?php echo $result['description']; ?></textarea><br>

                <label for="prix">Prix:</label>
                <input type="number" name="prix" step="0.01" value="<?php echo $result['prix']; ?>" required><br>

                <label for="stock">Stock:</label>
                <input type="number" name="stock" value="<?php echo $result['stock']; ?>" required><br>

                <label>File</label>
                <input type="file" name="file">

                <button type="submit">Modifier</button>
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
