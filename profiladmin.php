<?php
include 'connexion_bdd.php';

$erreur_profil = ''; // Initialisez la variable d'erreur

if (isset($_GET['id'])) {
    $admin_id = intval($_GET['id']);

    $requete_profil = "SELECT * FROM administrateurs WHERE id = ?";
    $stmt = $connexion->prepare($requete_profil);
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $resultat_profil = $stmt->get_result();

    if ($resultat_profil->num_rows > 0) {
        $admin = $resultat_profil->fetch_assoc();
    } else {
        $erreur_profil = "Aucun administrateur trouvé.";
    }

    $stmt->close();
} else {
    $erreur_profil = "ID d'administrateur non spécifié.";
}

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
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 20px;
}

h2 {
    color: #007bff;
}

.error-message {
    color: red;
}

.profile-info {
    margin-bottom: 20px;
}

.profile-info p {
    margin: 5px 0;
}

.profile-info p:first-child {
    font-weight: bold;
}

.profile-info p:nth-child(even) {
    color: #6c757d;
}

.profile-info p:nth-child(odd) {
    color: #343a40;
}
</style>
     <h2>Profil de l'Administrateur</h2>

    <?php if (!empty($erreur_profil)) : ?>
        <p style="color: red;"><?php echo $erreur_profil; ?></p>
    <?php else : ?>
        <p>ID: <?php echo $admin["id"]; ?></p>
        <p>Nom: <?php echo $admin["nom"]; ?></p>
        <p>Prénom: <?php echo $admin["prenom"]; ?></p>
        <p>Email: <?php echo $admin["email"]; ?></p>
        <p>Date de Naissance: <?php echo $admin["date_naissance"]; ?></p>
        <p>Sexe: <?php echo $admin["sexe"]; ?></p>
        <p>Adresse: <?php echo $admin["adresse"]; ?></p>
        <p>Ville: <?php echo $admin["ville"]; ?></p>
        <p>Code Postal: <?php echo $admin["code_postal"]; ?></p>
        <p>Pays: <?php echo $admin["pays"]; ?></p>
        <p>Numéro de Téléphone: <?php echo $admin["numero_telephone"]; ?></p>
    <?php endif; ?>

</body>

</html>