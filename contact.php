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
session_start(); 
include("config.php");

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: connexionutilisateur.php");
    exit();
}

// Traitement du formulaire de contact
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $message = $_POST['message'];

    // Enregistrez le message dans la table Contact
    $sql = "INSERT INTO Contact (user_id, message) VALUES ('$user_id', '$message')";
    if (mysqli_query($conn, $sql)) {
        echo "<p>Message envoyé avec succès!</p>";
    } else {
        echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact - E-shop</title>
    <!-- Liens vers les fichiers CSS et JavaScript -->
</head>
<body>

<nav>
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="produits.php">Produits</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="logout.php">Déconnexion</a></li>
    </ul>
</nav>

<div>
    <h2>Contactez-nous</h2>
    
    <!-- Formulaire de contact -->
    <form method="post" action="contact.php">
        <label for="message">Message:</label>
        <textarea name="message" id="message" rows="4" required></textarea>
        <br>
        <button type="submit">Envoyer</button>
    </form>
</div>

</body>
</html>
