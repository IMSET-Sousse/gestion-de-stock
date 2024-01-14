<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     </head><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <body>
    <div class="sidebar">
    <h1>Gestion De Stock</h1>
    <div class="menu-item"><i class="bi bi-grid"></i><span>Dashboard</span></div><br>
    <div class="menu-item"><i class="bi bi-box-seam"></i><span>Produit</span></div><br>
    <div class="menu-item"><i class="bi bi-list-task"></i><span>Commandes</span></div><br>
    <div class="menu-item"><i class="bi bi-bar-chart"></i><span>Analyse</span></div><br>
    <div class="menu-item"><i class="bi bi-database"></i><span>Stock</span></div><br>
    <div class="menu-item"><i class="bi bi-files"></i><span>Toutes les commandes</span></div><br>
    <div class="menu-item"><i class="bi bi-people-fill"></i><span>Clients</span></div><br>
    <div class="menu-item"><i class="bi bi-person"></i><span>Utilisateur</span></div><br>
    <div class="menu-item"><i class="bi bi-gear"></i><span>Parametre</span></div><br>
    <div class="menu-item"><i class="bi bi-box-arrow-in-left"></i><span>Déconnexion</span></div>
</div>

<div class="p-3 mb-2 bg-dark-subtle text-emphasis-dark">
<section class="home-section">
      <nav>
        <div class="sidebar-button">
          <i class="bx bx-menu sidebarBtn"></i>
          <span class="dashboard">Dashboard</span>
        </div>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit" style="background-color: ;">Search</button>
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

    </div>
   
      </nav>
    
      </section>
      <section class="main-content">
    <div class="card text-bg-primary mb-3" style="max-width: 18rem;">
        <h5 class="card-title">Commandes</h5>
        <p>523</p>
        <i class="bi bi-cart"></i>
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
</section>



</div>

</body>
</html>