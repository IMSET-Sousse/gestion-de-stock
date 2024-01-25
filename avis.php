<!-- avis.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Avis - E-shop</title>
    <!-- Ajoutez les liens vers les fichiers CSS et JS nécessaires (Bootstrap, etc.) -->
</head>
<body>

<?php
// Traitez le formulaire d'ajout d'avis ici
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les données du formulaire
    $user_id = 1; // Remplacez cela par l'ID de l'utilisateur actuel (peut provenir de la session)
    $produit_id = $_POST['produit_id'];
    $value = $_POST['value'];
    $commentaire = $_POST['commentaire'];

    // Enregistrez l'avis dans la base de données
    // ... (Utilisez une requête SQL pour insérer les données dans la table Avis)
    // ...

    echo '<p>Avis ajouté avec succès.</p>';
}
?>

<!-- Affichez le formulaire pour ajouter un avis -->
<div class="container mt-4">
    <form method="post" action="avis.php">
        <input type="hidden" name="produit_id" value="1"> <!-- Remplacez 1 par l'ID du produit en cours -->
        <label for="value">Évaluation :</label>
        <select name="value">
            <option value="1">1 étoile</option>
            <option value="2">2 étoiles</option>
            <option value="3">3 étoiles</option>
            <option value="4">4 étoiles</option>
            <option value="5">5 étoiles</option>
        </select>
        <br>
        <label for="commentaire">Commentaire :</label>
        <textarea name="commentaire" rows="4" cols="50"></textarea>
        <br>
        <input type="submit" value="Ajouter Avis">
    </form>
</div>

<?php include("footer.php") ?>

</body>
</html>
