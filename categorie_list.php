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

$sql = "SELECT * FROM Categorie";
$result = mysqli_query($conn, $sql);

// Vérifier s'il y a des catégories
if (mysqli_num_rows($result) > 0) {
    echo "<h2>Liste des Catégories</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Titre</th><th>Créé le</th><th>Modifié le</th><th>Actions</th></tr>";

    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["titre"] . "</td>";
        echo "<td>" . $row["created_at"] . "</td>";
        echo "<td>" . $row["update_at"] . "</td>";
        echo "<td><a href='categorie_edit.php?id=" . $row["id"] . "'>Modifier</a> | <a href='categorie_delete.php?id=" . $row["id"] . "'>Supprimer</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Aucune catégorie trouvée.";
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>