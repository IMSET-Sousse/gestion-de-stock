<?php
if (isset($_POST) && $_POST){
    echo "<pre>";
    print_r($_POST);
    echo"</pre>";

    // Assurez-vous de vérifier et valider les données avant de les utiliser dans la requête SQL
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];

    // stockerez les images
    $imageFolder = './images/';

    // Vérifiez si un fichier a été téléchargé
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $imagePath = $imageFolder . basename($_FILES['file']['name']);

        // Déplacez le fichier téléchargé vers le dossier des images
        move_uploaded_file($_FILES['file']['tmp_name'], $imagePath);


        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gestion-de-stock";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO produit (nom, description, prix, stock, image_path) VALUES (:nom, :description, :prix, :stock, :imagePath)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':imagePath', $imagePath);
            $stmt->execute();

            echo "Produit ajouté avec succès.";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }

        $conn = null;
    } else {
        echo "Erreur lors du téléchargement du fichier.";
    }
}
?>
<html>
<head>
</head>
<body>


</body>
</html>

