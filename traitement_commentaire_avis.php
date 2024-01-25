<?php
// Assurez-vous que le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $product_id = $_POST['product_id'];
    $commentaire = $_POST['commentaire'];
    $avis = $_POST['avis'];

    // Effectuer des validations si nécessaire

    // Enregistrement dans la base de données (exemple)
    // ...

    // Redirection vers la page de détails du produit
    header("Location: detailproduit.php?id=$product_id");
    exit();
} else {
    // Redirection vers une page d'erreur ou une autre page appropriée
    header("Location: erreur.php");
    exit();
}
?>
