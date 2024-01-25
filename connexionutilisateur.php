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

    // Utilisation de déclarations préparées pour éviter les injections SQL
    $requete = "SELECT * FROM Utilisateur WHERE email = ? AND isadmin IS NULL";
    $stmt = $connexion->prepare($requete);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultat = $stmt->get_result();

    if ($resultat && $resultat->num_rows > 0) {
        $utilisateur = $resultat->fetch_assoc();
        // Vérification du mot de passe avec password_verify pour les mots de passe hachés
        if (password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
            // L'utilisateur est connecté avec succès
            echo "Connexion réussie!";
            header("Location: indexutilisateur.php");
            exit();
        } else {
            // Mot de passe incorrect
            echo "Mot de passe incorrect. Veuillez réessayer.";
        }
    } else {
        // Identifiants incorrects
        echo "Identifiants incorrects. Veuillez réessayer.";
    }

    $stmt->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion Utilisateur</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

   
</head>
<body class="m-5 border-1 border-15">
    <div class="container">
        <h2 class="mb-4">Connexion Utilisateur</h2>
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
        <p class="mt-3">Vous n'avez pas de compte ? <a href="inscriptionutilisateur.php">Inscrivez-vous ici</a>.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

