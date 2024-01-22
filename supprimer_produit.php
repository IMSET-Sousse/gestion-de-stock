<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion-de-stock";

// Assurez-vous que l'ID du produit à supprimer est passé en paramètre dans l'URL

// Vérifier si l'ID du produit est présent dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Vérifier si le formulaire de confirmation est soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
        // Si le formulaire est soumis avec la confirmation, supprimer le produit
        // Utilisez des requêtes préparées pour des raisons de sécurité
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gestion-de-stock";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM produit WHERE id=:id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            echo "Le produit a été supprimé avec succès.";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }

        // Fermez la connexion à la base de données
        $conn = null;
    } else {
        // Afficher le formulaire de confirmation
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Confirmation de Suppression</title>
        </head>
        <body>
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
            <h3>Confirmation de Suppression</h3>
            <form method="post">
                Êtes-vous sûr de vouloir supprimer ce produit ?
                <input type="hidden" name="confirm" value="yes">
                <button type="submit">Oui, Supprimer</button>
                <a href="afficher_produits.php">Annuler</a>
            </form>
        </body>
        </html>
        <?php
    }
} else {
    echo "L'identifiant du produit à supprimer n'est pas spécifié.";
}
?>
