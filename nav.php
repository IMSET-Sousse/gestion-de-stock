<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accueil - E-shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">E-shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="indexutilisateur.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="apropos.php">À propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="produit.php">Produits</a>
                </li>
            </ul>
            <form class="d-flex" method="post" action="produit_par_categorie.php">
                <label for="categorie" class="me-2"></label>
                <select class="form-select me-2" name="categorie" id="categorie">
                <?php
                // Connexion à la base de données
                $conn = mysqli_connect("localhost", "root", "", "gestion-de-stock");
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Récupérer les catégories depuis la base de données
                $sqlCategories = "SELECT * FROM Categorie";
                $resultCategories = mysqli_query($conn, $sqlCategories);

                if (mysqli_num_rows($resultCategories) > 0) {
                    while ($row = mysqli_fetch_assoc($resultCategories)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['titre'] . "</option>";
                    }
                } else {
                    echo "<option disabled>Aucune catégorie trouvée</option>";
                }

                // Fermer la connexion à la base de données
                mysqli_close($conn);
                ?>
            </select>
            <button type="submit" class="btn btn-primary mt-2">Afficher les Produits</button>
        </form>
    </div>
       
           
        <?php
        // Affichage des produits correspondant à la catégorie sélectionnée
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
                    echo "<ul>";
                    while ($row = mysqli_fetch_assoc($resultProducts)) {
                        echo "<li>" . $row["titre"] . "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>Aucun produit disponible pour la catégorie sélectionnée.</p>";
                }

                // Fermer la connexion à la base de données
                mysqli_close($conn);
            }
        }
        ?>

    
        <div class="navbar-nav ms-auto">
            <?php
            if (isset($_SESSION['user_id'])) {
                echo '<li class="nav-item">
                        <a class="nav-link" href="logout.php">Déconnexion</a>
                    </li>';
            } else {
                echo '<li class="nav-item">
                        <a class="nav-link" href="connexionutilisateur.php">Connexion</a>
                    </li>';
            }
            ?>
 </nav>