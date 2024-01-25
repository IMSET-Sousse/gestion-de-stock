<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion-de-stock";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Categorie";
$result = $conn->query($sql);

$categories = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = array('id' => $row['id'], 'titre' => $row['titre']);
    }
}

$conn->close();

// Renvoyer les données en format JSON
header('Content-Type: application/json');
echo json_encode($categories);
?>
