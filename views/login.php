<head>
  <script src="resources/js/login-action.js" charset="utf-8"></script>
</head>
<body >
  <div class="containerL">
    <div class="row">
      <div class="col-md-8 mx-auto pt-3">
        <div class="cardL">
          <div class="card-header">
            <h4 class="card-title">Ingresar</h4>
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
            <div class="card-footer text-right">
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
