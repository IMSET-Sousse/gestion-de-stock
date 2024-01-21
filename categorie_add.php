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



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST["titre"];

    // Insérer la nouvelle catégorie dans la table
    $sql = "INSERT INTO Categorie (titre) VALUES ('$titre')";
    if (mysqli_query($conn, $sql)) {
        echo "Catégorie ajoutée avec succès.";
    } else {
        echo "Erreur lors de l'ajout de la catégorie: " . mysqli_error($conn);
    }

    // Fermer la connexion à la base de données
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une Catégorie</title>
</head>
<body>
    <h2>Ajouter une Catégorie</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Titre : <input type="text" name="titre" required>
        <input type="submit" value="Ajouter">
    </form>
</body>
</html>