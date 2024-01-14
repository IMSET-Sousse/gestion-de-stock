<?php
if (isset($_POST) && $_POST){
    echo "<pre>";
    print_r($_POST);
    echo"</pre>";

}
if (isset($_files) && $_files) {
    echo "<pre>";
    print_r($_file);
    echo"<pre>";
}
?>
<html>
<head>
</head>
<body>
<h2>Ajouter un Produit</h2>
<form action="" method="" enctype="multipart/form-data">
        <div>
    <label for="nom">Nom du Produit:</label>
    <input type="text" name="nom" required><br>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea><br>

    <label for="prix">Prix:</label>
    <input type="number" name="prix" step="0.01" required><br>

    <label for="stock">Stock:</label>
    <input type="number" name="stock" required><br>
    <div >
            <label>file</label>
            <input type="file" name="file">
        </div>
    <button type="submit">Ajouter</button>
        </div>
</form>
</body>
</html>