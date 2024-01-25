<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des Catégories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h2>Liste des Catégories</h2>
    <a href="categorie_add.php">Ajouter catégorie</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Titre</th>
                <th scope="col">Créé le</th>
                <th scope="col">Modifié le</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "gestion-de-stock";

            // Créer une connexion
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            // Vérifier la connexion
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT * FROM Categorie";
            $result = mysqli_query($conn, $sql);

            // Vérifier s'il y a des catégories
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["titre"] . "</td>";
                    echo "<td>" . date("Y-m-d H:i:s", strtotime($row["created_at"])) . "</td>";

                    // Vérifiez si la clé "updated_at" existe dans le tableau $row
                    if (isset($row["updated_at"])) {
                        echo "<td>" . date("Y-m-d H:i:s", strtotime($row["updated_at"])) . "</td>";
                    } else {
                        echo "<td>Non disponible</td>"; // Ou tout autre message que vous souhaitez afficher
                    }

                    echo "<td><a href='categorie_edit.php?id=" . $row["id"] . "'>Modifier</a> | <a href='categorie_delete.php?id=" . $row["id"] . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cette catégorie ?\");'>Supprimer</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucune catégorie trouvée.</td></tr>";
            }

            // Fermer la connexion à la base de données
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
