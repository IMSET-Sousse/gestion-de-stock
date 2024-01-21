<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion-de-stock";

try {
    $conn= new PDO("mysql:host=$servername;dbname=$dbname", $username ,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $sql="SELECT*FROM produit";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $produit=$stmt->fetchAll(PDO::FETCH_ASSOC);

    // Affichez les produits dans un tableau HTML
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nom du Produit</th><th>Description</th><th>Prix</th><th>Action</th></tr>";
    foreach ($products as $product) {
        echo "<tr>";
        echo "<td>" . ($product['id'] ?? '') . "</td>";
        echo "<td>" . ($product['titre'] ?? '') . "</td>";
        echo "<td>" . ($product['description'] ?? '') . "</td>";
        echo "<td>" . ($product['prix'] ?? '') . "</td>";
        echo "<td><a href='supprimer_produit.php?id=" . $product['id'] . "'>Supprimer</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

// Fermez la connexion à la base de données
$conn = null;
?>
