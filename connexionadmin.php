<?php
session_start(); // Démarrer la session si ce n'est pas déjà fait

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

    // Requête préparée pour vérifier les informations de connexion
    $requete = "SELECT * FROM Administrateurs WHERE email = ? AND motdepasse = ?";

    // Préparer la requête
    $statement = $connexion->prepare($requete);

    // Liage des paramètres
    $statement->bind_param("ss", $email, $mot_de_passe);

    // Exécuter la requête
    $statement->execute();

    // Récupérer le résultat
    $resultat = $statement->get_result();

    if ($resultat->num_rows > 0) {
        // L'administrateur est connecté avec succès
        $_SESSION['admin'] = true; // Définir une variable de session pour indiquer que l'administrateur est connecté
        header("Location: index.php"); // Rediriger vers la page d'administration
        exit(); // Arrêter l'exécution du script après la redirection
    } else {
        // Identifiants incorrects
        $message_erreur = "Identifiants incorrects. Veuillez réessayer.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <h2 class="my-4">Connexion Admin</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="mot_de_passe" class="form-label">Mot de passe :</label>
                <input type="password" name="mot_de_passe" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
    
    </div>

    <!-- Inclure le fichier JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Fermer la connexion à la base de données
$connexion->close();
?>