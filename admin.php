<?php
require 'dbAdmin.php';
$message = '';
if (isset ($_POST['nom'])  && isset($_POST['pass']) ) {
  $nom = $_POST['nom'];
  $pass = $_POST['pass'];
  $sql = 'INSERT INTO users(nom, password) VALUES(:nom, :pass)';
  $statement = $bdd->prepare($sql);
  if ($statement->execute([':nom' => $nom, ':pass' => $pass])) {
    $message = 'Bienvenue!';
  }

}
    if(!empty($nom) && !empty($pass)){
      header("location:add.php");
    }
?>




<html>
  <head>
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

        


        <div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Authentification</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="nom">Nom</label>
          <input type="text" name="nom" id="nom" class="form-control" placeholder="nom">
        </div>
        <div class="form-group">
          <label for="password" >Password</label>
          <input type="password" name="pass" id="password" class="form-control" placeholder="password">
        </div><br>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Se connecter</button>
        </div>
      </form>
    </div>
  </div>
</div>