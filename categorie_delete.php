<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion-de-stock";

// Créer une connexion
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérifier la connexion
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];

    // Supprimer la catégorie de la table
    $sql = "DELETE FROM Categorie WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "Catégorie supprimée avec succès.";
    } else {
        echo "Erreur lors de la suppression de la catégorie: " . mysqli_error($conn);
    }

    // Fermer la connexion à la base de données
    mysqli_close($conn);
}
?>
