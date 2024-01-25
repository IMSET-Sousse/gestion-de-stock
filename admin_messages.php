<?php
// Assurez-vous que l'administrateur est connecté (ajoutez votre logique d'authentification ici)

// Connexion à la base de données
$conn = mysqli_connect("localhost", "root", "", "votre_base_de_donnees");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Récupérer les messages de la table Contact
$sql = "SELECT * FROM Contact";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Messages de Contact - E-shop</title>
    <!-- Ajoutez vos liens vers Bootstrap ou d'autres fichiers CSS ici -->
</head>
<body>

<div class="container mt-4">
    <h2>Messages de Contact</h2>

    <?php
    // Afficher les messages s'il y en a
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div>";
            echo "<p><strong>Nom:</strong> " . $row['nom'] . "</p>";
            echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
            echo "<p><strong>Message:</strong> " . $row['message'] . "</p>";
            echo "<hr>";
            echo "</div>";
        }
    } else {
        echo "<p>Aucun message de contact trouvé.</p>";
    }

    // Fermer la connexion à la base de données
    mysqli_close($conn);
    ?>
</div>

</body>
</html>
