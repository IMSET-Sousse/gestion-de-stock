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

<a href="categorie_add.php">Ajouter catégorie</a>.</p>

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
    echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>" . $row["titre"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "Aucune catégorie trouvée.";
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>
