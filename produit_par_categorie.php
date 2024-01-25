<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produits par Catégorie - E-shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css"/>
</head>
<body>

<div class="container mt-4">
    <?php
    // Vérifiez si une catégorie est sélectionnée
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selectedCategoryId = isset($_POST['categorie']) ? $_POST['categorie'] : null;

        if ($selectedCategoryId !== null) {
            // Connexion à la base de données
            $conn = mysqli_connect("localhost", "root", "", "gestion-de-stock");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Récupérer les produits par catégorie
            $sqlProducts = "SELECT * FROM Produit WHERE categorie_id = $selectedCategoryId";
            $resultProducts = mysqli_query($conn, $sqlProducts);

            if (mysqli_num_rows($resultProducts) > 0) {
                echo "<h3>Produits de la Catégorie sélectionnée</h3>";
                echo '<div class="row">';
                while ($row = mysqli_fetch_assoc($resultProducts)) {
                    echo '<div class="col-md-8 mb-8">
                            <div class="card">
                                <img src="' . $row["image_path"] . '" class="card-img-top" alt="' . $row["titre"] . '">
                                <div class="card-body">
                                    <h5 class="card-title">' . $row["titre"] . '</h5>
                                    <p class="card-text">' . $row["description"] . '</p>
                                    <p class="card-text"><strong>Prix:</strong> ' . $row["prix"] . ' DT</p>
                                </div>
                            </div>
                        </div>';
                }
                echo "</div>";
            } else {
                echo "<p>Aucun produit disponible pour la catégorie sélectionnée.</p>";
            }

            // Fermer la connexion à la base de données
            mysqli_close($conn);
        }
    } else {
        // Redirigez l'utilisateur vers la page précédente si la demande POST n'est pas détectée
        header("Location: categorie.php");
        exit();
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-rbsKk/jjS6c5I2ZlO4L4UpLHDc7PweAjnoYiQq4IseLAg2DAMCpG9gpgvt3E2Aij" crossorigin="anonymous"></script>
</body>
</html>
