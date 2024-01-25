<?php
// Inclure le fichier de connexion à la base de données
include 'connexion_bdd.php';

// Vérifier si le formulaire a été soumis
if (isset($_POST['ajoutad'])) {
    // Récupérer les valeurs du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $motdepasse = $_POST['motdepasse'];
    $date_naissance = $_POST['date_naissance'];
    $img1 = $_POST['img1'];
    $sexe = $_POST['sexe'];
    $adr = $_POST['adr'];
    $ville = $_POST['ville'];
    $code = $_POST['cp'];
    $pays = $_POST['pays'];
    $num = $_POST['num'];

    // Préparer la requête d'insertion
    $requete = "INSERT INTO administrateurs (nom, prenom, email, motdepasse, date_naissance, img1, sexe, adresse, ville, code_postal, pays, numero_telephone)
                VALUES ('$nom', '$prenom', '$email', '$motdepasse', '$date_naissance', '$img1', '$sexe', '$adr', '$ville', '$code', '$pays', '$num')";

    // Exécuter la requête
    if ($connexion->query($requete) === TRUE) {
        $message = "Administrateur ajouté avec succès!";
    } else {
        $erreur = "Erreur lors de l'ajout de l'administrateur : " . $connexion->error;
    }
}

// Récupérer la liste des administrateurs depuis la base de données
$requete_liste = "SELECT * FROM administrateurs";
$resultat_liste = $connexion->query($requete_liste);
?>

<!DOCTYPE html>
<html lang="en">
<body>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </head>

    <h2>Ajouter un Administrateur</h2>

    <!-- Afficher un message de succès ou d'erreur -->
    <?php if (isset($message)) : ?>
        <p style="color: green;"><?php echo $message; ?></p>
    <?php endif; ?>

    <?php if (isset($erreur)) : ?>
        <p style="color: red;"><?php echo $erreur; ?></p>
    <?php endif; ?>

    <form method="post" action="ajout_admin.php" class="mt-3">
    <div class="mb-3">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom :</label>
        <input type="text" name="prenom" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email :</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="motdepasse" class="form-label">Mot de passe :</label>
        <input type="password" name="motdepasse" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="date_naissance" class="form-label">Date de Naissance :</label>
        <input type="date" name="date_naissance" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="sexe" class="form-label">Sexe :</label>
        <select name="sexe" class="form-select">
            <option value="homme">Homme</option>
            <option value="femme">Femme</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="adr" class="form-label">Adresse :</label>
        <input type="text" name="adr" class="form-control">
    </div>
    <div class="mb-3">
        <label for="ville" class="form-label">Ville :</label>
        <input type="text" name="ville" class="form-control">
    </div>
    <div class="mb-3">
        <label for="cp" class="form-label">Code Postal :</label>
        <input type="text" name="cp" class="form-control">
    </div>
    <div class="mb-3">
        <label for="pays" class="form-label">Pays :</label>
        <input type="text" name="pays" class="form-control">
    </div>
    <div class="mb-3">
        <label for="num" class="form-label">Numéro de Téléphone :</label>
        <input type="text" name="num" class="form-control" required>
    </div>
    <button type="submit" name="ajoutad" class="btn btn-primary">Ajouter Administrateur</button>
</form>

</body>
</html>

<?php
// Fermer la connexion à la base de données
$connexion->close();
?>
