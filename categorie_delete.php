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
</style><?php
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
