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
  </head>
  <body>
    <div class="sidebar">
      <h1>Gestion De Stock</h1>
      <div class="menu-item"><i class="bi bi-grid"></i><span>Dashboard</span></div>
      <div class="menu-item"><i class="bi bi-box-seam"></i><a href="ajoutproduit.php"><span>Produit</span></a></div>
      <div class="menu-item"><i class="bi bi-list-task"></i><span>Commandes</span></div>
      <div class="menu-item"><i class="bi bi-bar-chart"></i><span>Analyse</span></div>
      <div class="menu-item"><i class="bi bi-database"></i><span>Stock</span></div>
      <div class="menu-item"><i class="bi bi-files"></i><span>Toutes les commandes</span></div>
      <div class="menu-item"><i class="bi bi-people-fill"></i><span>Clients</span></div>
      <div class="menu-item"><i class="bi bi-person"></i><span>Utilisateur</span></div>
      <div class="menu-item"><i class="bi bi-gear"></i><span>Parametre</span></div>
      <div class="menu-item"><i class="bi bi-box-arrow-in-left"></i><span>Déconnexion</span></div>
    </div>
    <section class="home-section">
      <nav>
        <div class="sidebar-button">
          <i class="bx bx-menu sidebarBtn"></i>
          <span class="dashboard">Dashboard</span>
        </div>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Sana
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
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
            <h5 class="card-title"></h5>
        </div>
        <div class="card text-bg-success mb-3" style="max-width: 18rem;">
            <div class="card-header">Profit</div>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
            </div>
        </div>
        <div class="card text-bg-danger mb-3" style="max-width: 18rem;">
            <div class="card-header">Revenu</div>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
            </div>
        </div>
      </div>
      <table id="myTable">
          <thead>
              <tr>
                  <th>Nom de produit</th>
                  <th>Description</th>
                  <th>Prix</th>
                  <th>Stock</th>
                  <th>Images</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>Pantalon</td>
                  <td>Pantalon tissé. Modèle ajusté avec taille haute et braguette </td>     
                  <td>90,000</td>
                  <td>10</td>
                  <td>Row 1 Data 2</td>
              </tr>
              <tr>
                  <td>Row 2 Data 2</td>
                  <td>Row 2 Data 2</td>
                  <td>Row 2 Data 1</td>
                  <td>Row 2 Data 2</td>
                  <td>Row 2 Data 2</td>
              </tr>
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