
<?php include("nav.php") ?>
<?php
// Vérifier si un identifiant de produit est passé en paramètre dans l'URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Connexion à la base de données
    $conn = mysqli_connect("localhost", "root", "", "gestion-de-stock");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Requête pour récupérer les détails du produit
    $sql = "SELECT produit.id, produit.titre, produit.description, produit.prix, produit.image_path, categorie.titre AS Categorie
            FROM produit
            INNER JOIN categorie ON produit.categorie_id = categorie.id
            WHERE produit.id = $product_id";
    $result = mysqli_query($conn, $sql);

    // Vérifier si le produit existe
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Afficher les détails du produit
        echo '<div class="container mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <img src="' . $row["image_path"] . '" class="img-fluid" alt="' . $row["titre"] . '">
                    </div>
                    <div class="col-md-6">
                        <h2>' . $row["titre"] . '</h2>
                        <p>Catégorie: ' . $row["Categorie"] . '</p>
                        <p>Description: ' . $row["description"] . '</p>
                        <p>Prix: ' . $row["prix"] . ' DT</p>
                    </div>
                </div>
            </div>';

        // Formulaire pour le commentaire et l'avis
        echo '<div class="container mt-4">
                <h3>Laisser un commentaire et donner votre avis</h3>
                <form method="post" action="traitement_commentaire_avis.php">
                    <input type="hidden" name="product_id" value="' . $product_id . '">
                    <div class="mb-3">
                        <label for="commentaire" class="form-label">Commentaire:</label>
                        <textarea class="form-control" name="commentaire" id="commentaire" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="avis" class="form-label">Avis:</label>
                        <select class="form-select" name="avis" id="avis">
                            <option value="1">1 étoile</option>
                            <option value="2">2 étoiles</option>
                            <option value="3">3 étoiles</option>
                            <option value="4">4 étoiles</option>
                            <option value="5">5 étoiles</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>';
    } else {
        echo '<p>Produit non trouvé.</p>';
    }

    // Fermer la connexion à la base de données
    mysqli_close($conn);
} else {
    echo '<p>Identifiant de produit non spécifié.</p>';
}

?>

<?php include("footer.php") ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-rbsKk/jjS6c5I2ZlO4L4UpLHDc7PweAjnoYiQq4IseLAg2DAMCpG9gpgvt3E2Aij" crossorigin="anonymous"></script>
</body>
</html>
