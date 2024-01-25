<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <a class="nav-link" href="navbarutilisateur.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="apropos.php">À propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products.php">Produits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Categorie</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <?php
                // Vérifiez si l'utilisateur est connecté
                if (isset($_SESSION['user_id'])) {
                    echo '<li class="nav-item">
                            <a class="nav-link" href="logout.php">Déconnexion</a>
                        </li>';
                } else {
                    echo '<li class="nav-item">
                            <a class="nav-link" href="login.php">Connexion</a>
                        </li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Le reste du contenu de votre page va ici -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
