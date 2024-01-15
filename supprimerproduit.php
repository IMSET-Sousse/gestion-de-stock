<?php

if (isset($_GET['id'])) {
    $produit_id = $_GET['id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gestion-de-stock";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmer'])) {
            $sql_suppression = "DELETE FROM produit WHERE id = :id";
            $stmt = $pdo->prepare($sql_suppression);
            $stmt->bindParam(':id', $produit_id);

            if ($stmt->execute()) {
                echo "Produit supprimé avec succès.";

                echo '<br><a href="listeproduit.php">Retour à la liste des produits</a>';
            } else {
                echo "Erreur lors de la suppression du produit.";
            }
        } else {

            $sql_selection = "SELECT * FROM produit WHERE id = :id";
            $stmt_selection = $pdo->prepare($sql_selection);
            $stmt_selection->bindParam(':id', $produit_id);
            $stmt_selection->execute();
            $produit = $stmt_selection->fetch(PDO::FETCH_ASSOC);

            if ($produit) {
      
                ?>
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Supprimer un Produit</title>
                </head>
                <body>
                    <h2>Confirmez la suppression du produit :</h2>
                    <p>Êtes-vous sûr de vouloir supprimer le produit "<?php echo $produit['nom']; ?>" ?</p>
                    <form action="supprimerproduit.php?id=<?php echo $produit_id; ?>" method="post">
                        <input type="submit" name="confirmer" value="Confirmer la suppression">
                        <a href="listeproduit.php">Annuler</a>
                    </form>
                </body>
                </html>
                <?php
            } else {
                echo "Produit non trouvé.";
            }
        }
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    } finally {

        $pdo = null;
    }
} else {

    echo "ID du produit non spécifié.";
}
?>
