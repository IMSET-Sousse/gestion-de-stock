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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Administrateurs</title>
</head>

<body>

    <h2>Ajouter un Administrateur</h2>

    <!-- Afficher un message de succès ou d'erreur -->
    <?php if (isset($message)) : ?>
        <p style="color: green;"><?php echo $message; ?></p>
    <?php endif; ?>

    <?php if (isset($erreur)) : ?>
        <p style="color: red;"><?php echo $erreur; ?></p>
    <?php endif; ?>

    <form method="post" action="ajout_admin.php">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" required><br>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" required><br>

        <label for="email">Email :</label>
        <input type="email" name="email" required><br>

        <label for="motdepasse">Mot de passe :</label>
        <input type="password" name="motdepasse" required><br>

        <label for="date_naissance">Date de Naissance :</label>
        <input type="date" name="date_naissance" required><br>

        <label for="sexe">Sexe :</label>
        <select name="sexe">
            <option value="homme">Homme</option>
            <option value="femme">Femme</option>
        </select><br>

        <label for="adr">Adresse :</label>
        <input type="text" name="adr"><br>

        <label for="ville">Ville :</label>
        <input type="text" name="ville"><br>

        <label for="cp">Code Postal :</label>
        <input type="text" name="cp"><br>

        <label for="pays">Pays :</label>
        <input type="text" name="pays"><br>

        <label for="num">Numéro de Téléphone :</label>
        <input type="text" name="num" required><br>

        <button type="submit" name="ajoutad">Ajouter Administrateur</button>
    </form>

    <hr>

    <h2>Liste des Administrateurs</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Date de Naissance</th>
            <th>Sexe</th>
            <th>Adresse</th>
            <th>Ville</th>
            <th>Code Postal</th>
            <th>Pays</th>
            <th>Numéro de Téléphone</th>
        </tr>

        <?php
        if ($resultat_liste->num_rows > 0) {
            while ($row = $resultat_liste->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nom"] . "</td>";
                echo "<td>" . $row["prenom"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["date_naissance"] . "</td>";
                echo "<td>" . $row["sexe"] . "</td>";
                echo "<td>" . $row["adresse"] . "</td>";
                echo "<td>" . $row["ville"] . "</td>";
                echo "<td>" . $row["code_postal"] . "</td>";
                echo "<td>" . $row["pays"] . "</td>";
                echo "<td>" . $row["numero_telephone"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='11'>Aucun administrateur trouvé.</td></tr>";
        }
        ?>
    </table>

</body>

</html>

<?php
// Fermer la connexion à la base de données
$connexion->close();
?>
