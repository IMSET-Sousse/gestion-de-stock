<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Utilisateurs</title>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion-de-stock";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les utilisateurs depuis la base de données
$sql = "SELECT nom, email FROM Utilisateur";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Liste des Utilisateurs</h2>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>Nom: " . $row["nom"] . " - Email: " . $row["email"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "Aucun utilisateur trouvé.";
}

$conn->close();
?>

</body>
</html>
