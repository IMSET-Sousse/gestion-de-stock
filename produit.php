<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits</title>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion-de-stock";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM produit";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        echo '<table border="1">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Image</th>
                </tr>';

        foreach ($result as $row) {
            echo '<tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['nom'] . '</td>
                    <td>' . $row['description'] . '</td>
                    <td>' . $row['prix'] . '</td>
                    <td>' . $row['stock'] . '</td>
                    <td>';

            // Vérifier si la clé 'image_path' existe dans le tableau $row
            if (isset($row['image_path'])) {
                echo '<img src="' . $row['image_path'] . '" alt="' . $row['nom'] . '" style="width: 50px;">';
            } else {
                echo 'Image non disponible';
            }

            echo '</td>
                </tr>';
        }

        echo '</table>';
    } else {
        echo "Aucun produit trouvé.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

$conn = null;
?>

</body>
</html>

