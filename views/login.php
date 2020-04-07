<head>
  <script src="resources/js/login-action.js" charset="utf-8"></script>
  <link rel="stylesheet" href="resources/css/master.css"/><link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
   <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    
</head>
<body >
  <div class="containerL">
    <div class="row">
      <div class="col-md-8 mx-auto pt-3">
        <div class="cardL">
        <i class="fas fa-user"></i>
          <div class="card-header">
            <h4 class="card-title">Inicio De Sesión</h4>
          </div>
          <form action="controllers/userCtrl.php" method="POST"
            onsubmit="return sign('login');">
            <div class="card-body">
              <div class="form-group">
                <label for="email">Correo Electronico:</label>
                <input type="text" name="email" id="email" class="form-control"
                  placeholder="Ingresa tu correo electronico">
              </div>
              <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" class="form-control"
                  placeholder="Ingresa una contraseña">
              </div>
            </div>
            <div class="card-footer text-center">
              <input type="hidden" name="type" id="type">
              <button type="submit" class="btn btn-primary">Ingresar</button>
              <a href="index.php" class="btn btn-dark">Cancelar</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
