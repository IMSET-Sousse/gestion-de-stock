<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['isadmin']) && $_SESSION['isadmin'] === true) {
    // Détruire la session
    session_unset();
    session_destroy();
}

// Rediriger vers la page de connexion
header('Location: connexionadmin.php');
exit();
?>
