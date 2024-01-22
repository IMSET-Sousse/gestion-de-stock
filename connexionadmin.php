<?php
// Fichier de connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$base_de_donnees = "gestion-de-stock";

$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $connexion->connect_error);
}

// Traitement du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Requête pour vérifier les informations de connexion
    $requete = "SELECT * FROM Utilisateur WHERE email = '$email' AND mot_de_passe = '$mot_de_passe' AND isadmin = 1";
    $resultat = $connexion->query($requete);

    if ($resultat->num_rows > 0) {
        // L'administrateur est connecté avec succès
        echo "Connexion réussie en tant qu'administrateur!";
        header("Location: index.php");
        // Vous pouvez rediriger l'administrateur vers une page d'administration ici
    } else {
        // Identifiants incorrects
        echo "Identifiants incorrects. Veuillez réessayer.";
 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
</head>
<body>

    <h2>Connexion Administrateur</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="email">Email :</label>
        <input type="text" name="email" required><br>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" name="mot_de_passe" required><br>

        <input type="submit" value="Se connecter">
    </form>

</body>
</html>

<?php
// Fermer la connexion à la base de données
$connexion->close();
?>
