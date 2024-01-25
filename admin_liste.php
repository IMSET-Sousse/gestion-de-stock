<?php
include 'connexion_bdd.php';

// Récupérer la liste des administrateurs depuis la base de données
$requete = "SELECT * FROM administrateurs";
$resultat = $connexion->query($requete);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Administrateurs</title>
    <!-- Inclure le CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <h2>Liste des Administrateurs</h2>

        <table class="table">
            <thead>
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($resultat->num_rows > 0) {
                    while ($row = $resultat->fetch_assoc()) {
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
                        
                        // Correction ici
                        echo "<td><a href='profiladmin.php?id=" . $row["id"] . "' class='btn btn-primary btn-sm'>Voir le profil</a></td>";
                        
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12'>Aucun administrateur trouvé.</td></tr>";
                }
                ?>

            </tbody>
        </table>
    </div>

    <!-- Inclure le JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

<?php
$connexion->close();
?>
