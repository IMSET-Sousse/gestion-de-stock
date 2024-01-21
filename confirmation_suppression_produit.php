<?php
// Assurez-vous que l'ID du produit à supprimer est passé en paramètre dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Paramètres de connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gestion-de-stock";

    try {
        // Créez une connexion à la base de données
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
            // Supprimez le produit de la base de données
            $sql = "DELETE FROM produit WHERE id=:id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            echo "Le produit a été supprimé avec succès.";
            header('Location: afficher_produits.php');
            exit;
        }

        // Récupérez les informations du produit avant la suppression
        $sql = "SELECT * FROM produit WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            // Affichez le message de confirmation avec les informations du produit
            echo "Êtes-vous sûr de vouloir supprimer le produit suivant ?<br>";
            echo "Nom du Produit : " . ($product['nom'] ?? '') . "<br>";
            echo "Description : " . ($product['description'] ?? '') . "<br>";
            echo "Prix : " . ($product['prix'] ?? '') . "<br>";

            // Ajoutez un lien de confirmation
            echo '<a href="supprimer_produit.php?id=' . $id . '&confirm=true">Oui, Supprimer</a> | <a href="afficher_produits.php">Annuler</a>';
        } else {
            echo "Aucun produit trouvé avec cet identifiant.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    // Fermez la connexion à la base de données
    $conn = null;
} else {
    echo "L'identifiant du produit à supprimer n'est pas spécifié.";
}
?>
