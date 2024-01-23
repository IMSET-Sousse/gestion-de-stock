<?php

include 'connexion_bdd.php';

// Récupérer l'ID de l'administrateur à afficher
$admin_id = 1;

// Récupérer les informations de l'administrateur depuis la base de données
$requete_profil = "SELECT * FROM administrateurs WHERE id = $admin_id";
$resultat_profil = $connexion->query($requete_profil);

// Vérifier s'il y a des résultats
if ($resultat_profil->num_rows > 0) {
    $admin = $resultat_profil->fetch_assoc();
} else {
    $erreur_profil = "Aucun administrateur trouvé.";
}

// Fermer la connexion à la base de données
$connexion->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de l'Administrateur</title>
</head>

<body>

    <h2>Profil de l'Administrateur</h2>

    <?php if (isset($erreur_profil)) : ?>
        <p style="color: red;"><?php echo $erreur_profil; ?></p>
    <?php else : ?>
        <p>ID: <?php echo $admin["id"]; ?></p>
        <p>Nom: <?php echo $admin["nom"]; ?></p>
        <p>Prénom: <?php echo $admin["prenom"]; ?></p>
        <p>Email: <?php echo $admin["email"]; ?></p>
        <!-- Ajoutez ici d'autres champs du profil en fonction de votre table -->
    <?php endif; ?>

</body>

</html>
