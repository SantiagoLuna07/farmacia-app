<?php
  if (!(isset($_SESSION['user_id']))){
    header('location: index.php?error-msg=Acceso denegado');
  }
 ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Farmacia</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="index.php?page=users">Usuarios</a>
      <a class="nav-item nav-link" href="index.php?page=clients">clientes</a>
      <a class="nav-item nav-link" href="index.php?page=medicines">Inventario</a>
      <a class="nav-item nav-link" href="index.php?page=sales">ventas</a>
    </div>
  </div>
</nav>
<div class="container">
<?php
  if (isset($_GET['page'])) {
    include 'views/' . $_GET['page'] . '.php';
  } else {
    include 'views/home.php';
  }
 ?>
</div>
