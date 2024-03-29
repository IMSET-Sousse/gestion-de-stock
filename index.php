<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
  <div class="sidebar">
  <div class="logo-details">
    <i class="bx bxl-c-plus-plus"></i>
    <h1><span class="logo_name">Gestion DE Stock</span></h1>
  </div>


      <div class="menu-item"><i class="bi bi-box-seam"></i><a href="ajoutproduit.php"><span>Produit</span></a></div>
      <div class="menu-item"><i class="bi bi-files"><a href="categorie_list.php"></i><span>categorie</span></a></div>
      <div class="menu-item"><i class="bi bi-list-task"></i><span>Commandes</span></div>
      <div class="menu-item"><i class="bi bi-bar-chart"></i><span>Analyse</span></div>
      <div class="menu-item"><i class="bi bi-database"></i><span>Stock</span></div>
      <div class="menu-item"><i class="bi bi-files"></i><span>Toutes les commandes</span></div>
      <div class="menu-item"><i class="bi bi-people-fill"><a href="utilisateur.php"></i><span>Clients</span></div>
      <div class="menu-item">
    <a href="#" class="bi bi-person" onclick="toggleDropdown()">Admin</a>
    <div id="dropdownMenu" class="dropdown-menu" style="display: none;">
        <a class="dropdown-item" href="ajout_admin.php">Ajouter admin</a>
        <a class="dropdown-item" href="admin_liste.php">Liste des admins</a>
    </div>
</div>

<script>
    function toggleDropdown() {
        var dropdownMenu = document.getElementById("dropdownMenu");
        if (dropdownMenu.style.display === "none") {
            dropdownMenu.style.display = "block";
        } else {
            dropdownMenu.style.display = "none";
        }
    }
</script>

      <div class="menu-item"><i class="bi bi-gear"></i><span>Parametre</span></div>
      <div class="menu-item"><i class="bi bi-box-arrow-in-left"><a href="deconnexion.php"></i><span>Déconnexion</span></a></div>
    </div>
    <section class="home-section">
      <nav>
        <div class="sidebar-button">
          <i class="bx bx-menu sidebarBtn"></i>
          <span class="dashboard">Dashboard Admin</span>
        </div>
       
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Sana
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="profiladmin.php?id=2">Profil</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
          </ul>
        </div>
      </nav>
    </section>
    <section class="main-content">
    <div class="kpi">
        <div class="card text-bg-primary mb-3" style="max-width: 18rem;">
            <div class="card-header">Commandes</div>
            <div class="card-body">
                <p>523</p>
                <i class="bi bi-cart"></i>
            </div>
        </div>
        <div class="card text-bg-secondary mb-3" style="max-width: 18rem;">
            <div class="card-header">Vente</div>
            <div class="card-body">
                <p>515</p>
                <i class="bi bi-cart"></i>
            </div>
        </div>
        <div class="card text-bg-success mb-3" style="max-width: 18rem;">
            <div class="card-header">Profit</div>
            <div class="card-body">
                <p>51</p>
                <i class="bi bi-cart"></i> 
            </div>
        </div>
        <div class="card text-bg-danger mb-3" style="max-width: 18rem;">
            <div class="card-header">Revenu</div>
            <div class="card-body">
                <p>90</p>
                <i class="bi bi-cart"></i> 
            </div>
        </div>
    </div>

      <table id="myTable" class="table">
    <thead>
        <div class="mb-3">
            <a href="ajoutproduit.php" class="btn btn-success">Ajouter un produit</a>
        </div>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Categorie</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Connect to the database
        $conn = mysqli_connect("localhost", "root", "", "gestion-de-stock");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Query the produits table with a JOIN on categorie table
        $sql = "SELECT produit.id, produit.titre, produit.prix, categorie.titre AS Categorie
                FROM produit
                INNER JOIN categorie ON produit.categorie_id = categorie.id";
        $result = mysqli_query($conn, $sql);

        // Display each row of the table
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["titre"] . "</td>";
                echo "<td>" . $row["prix"] . "</td>";
                echo "<td>" . $row["Categorie"] . "</td>"; // Afficher la catégorie
                echo "<td>
                    <a href='modifieproduit.php?id=" . $row["id"] . "' class='btn btn-warning'>Modifier</a>
                    <a href='supprimer_produit.php?id=" . $row["id"] . "' class='btn btn-danger'>Supprimer</a>
                </td>"; // Boutons pour chaque ligne
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>0 results</td></tr>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </tbody>
</table>


    </section>
</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

  <script>
    $(document).ready( function () {
      $('#myTable').DataTable();
  } );
  </script>
</body>
</html>