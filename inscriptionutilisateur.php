<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion-de-stock";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

    // Validation des données
    if (empty($nom) || empty($email) || empty($_POST['mot_de_passe'])) {
        echo "Veuillez remplir tous les champs.";
    } else {
        $sql = "INSERT INTO Utilisateur (nom, email, mot_de_passe) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nom, $email, $mot_de_passe);

        if ($stmt->execute()) {
            echo "Inscription réussie ! Redirection vers la page de connexion...";
            header('Refresh: 2; URL=indexutilisateur.php'); // Redirection après 2 secondes
            exit();
        } else {
            echo "Erreur lors de l'inscription : " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription Utilisateur</title>
    <!-- Inclure le fichier CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Ajouter un style personnalisé -->
    <style>
        /* Ajoutez ici votre CSS personnalisé si nécessaire */
    </style>
</head>
<body class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4">Inscription Utilisateur</h2>
            <form method="post" action="inscriptionutilisateur.php">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom :</label>
                    <input type="text" name="nom" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="mot_de_passe" class="form-label">Mot de passe :</label>
                    <input type="password" name="mot_de_passe" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
