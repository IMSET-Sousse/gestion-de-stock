<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion-de-stock";

$conn = null;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && !empty($_POST['id'])) {
    try {
        $id = $_POST['id'];
        $titre = $_POST['titre'];

        $sql = "UPDATE Categorie SET titre=:titre WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':titre', $titre);
        $stmt->execute();

        echo "Catégorie modifiée avec succès.";
    } catch (PDOException $e) {
        echo "Erreur lors de la modification de la catégorie : " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Catégorie</title>
</head>
<body>

<h2>Modifier une Catégorie</h2>

<?php
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Rediriger vers une page où l'utilisateur peut sélectionner une catégorie
    header("Location: categorie_list.php");
    exit();
}

// Récupérez les informations de la catégorie à partir de la base de données
try {
    $id = $_GET['id'];
    $sql = "SELECT * FROM Categorie WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Affichez le formulaire avec les données de la catégorie
        ?>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $result['id']; ?>">

            <label for="titre">Nom de la Catégorie:</label>
            <input type="text" name="titre" value="<?php echo $result['titre']; ?>" required><br>

            <input type="submit" value="Modifier Catégorie">
        </form>
        <?php
    } else {
        echo "Aucune catégorie trouvée avec cet identifiant.";
    }
} catch (PDOException $e) {
    echo "Erreur lors de la récupération des informations de la catégorie : " . $e->getMessage();
}

// Fermez la connexion après utilisation
if ($conn) {
    $conn = null;
}
?>

</body>
</html>
