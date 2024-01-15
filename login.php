<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
 
form {
    max-width: 400px;
    margin: auto;
}


.row {
    margin-bottom: 15px;
}


label {
    font-weight: bold;
}


.form-control {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}


.btn-primary {
    background-color: #007bff;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}


.btn-primary:hover {
    background-color: #0056b3;
}

    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Bootstrap Example</title>
    <link rel="stylesheet" href="style.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body class="p-3 m-0 border-0 bd-example m-0 border-0">

<h1> <center> Log In </h1> 
    
    <form>
      <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="inputEmail3">
        </div>
      </div>
      <div class="row mb-3">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Mot de passe</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword3">
        </div>
      </div>
      
        
     
   
      <button type="submit" class="btn btn-primary"> Se connecter</button>
    </form>
    

  </body>
</html>