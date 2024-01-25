<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Utilisateur</title>
</head>
<body>

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

<h2>Inscription Utilisateur</h2>
<form method="post" action="inscriptionutilisateur.php">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" required><br>

    <label for="email">Email :</label>
    <input type="email" name="email" required><br>

    <label for="mot_de_passe">Mot de passe :</label>
    <input type="password" name="mot_de_passe" required><br>


    <button type="submit">S'inscrire</button>
</form>

</body>
</html>
