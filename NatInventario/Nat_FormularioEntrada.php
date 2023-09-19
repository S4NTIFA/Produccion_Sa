<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="inventario.css">
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>
<img class="marca-agua" src="img.jpeg" alt="Marca de Agua">

<body>
  <div class="container">
    <section>
      <nav>
        <ul>
          <li>
            <a href="#" class="logo">
              <img src="logoleben.png" alt="">
              <span class="nav-item">Inventario</span>
            </a>
          <li><a href="perfil.html">
              <i class="fas fa-user"></i>
              <span class="nav-item">Perfil</span>
          <li><a href="inventario.html">
              <i class="fas fa-house"></i>
              <span class="nav-item">Inicio</span>
            </a></li>
          <li><a href="registroEntrada.html">
              <i class="fas fa-pencil"></i>
              <span class="nav-item">Registro Entrada</span>
            </a></li>
          <li><a href="proveedor.html">
              <i class="fas fa-person"></i>
              <span class="nav-item">Registro Proveedor</span>
            </a></li>
          <li><a href="registrarSalida.html">
              <i class="fas fa-pencil"></i>
              <span class="nav-item">Registro Salida</span>
            </a></li>
          <li><a href="crearcategoria.html">
              <i class="fas fa-file"></i>
              <span class="nav-item">Crea Categoria</span>
            </a></li>
        </ul>
      </nav>
    </section>
    <section class="main">
      <div class="formulario">
        <h2>Registro de Entrada</h2>
        <input type="hidden" id="idProducto" name="idProducto">
        <form method="POST" action="Nat_RegistroEntrada.php">
          <div class="form-group">
            <label for="categoria">Categoría:</label>
            <select id="categoria" name="categoria" required>
              <option value="">Seleccione una categoría</option>
              <?php
              $servername = "localhost";
              $username = "root";
              $password = "";
              $dbname = "snb";
              $conn = new mysqli($servername, $username, $password, $dbname);
              if ($conn->connect_error) {
                die("La conexión falló: " . $conn->connect_error);
              }
              $sql = "SELECT DISTINCT idCategoria, nombreCategoria FROM categoria";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<option value='" . $row["idCategoria"] . "'>" . $row["nombreCategoria"] . "</option>";
                }
              } else {
                echo "<option value=''>No hay categorías disponibles</option>";
              }
              $conn->close();
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="talla">Talla:</label>
            <select id="talla" name="talla" required>
              <option value="">Seleccione una talla</option>
              <?php
              $conn = new mysqli($servername, $username, $password, $dbname);
              if ($conn->connect_error) {
                die("La conexión falló: " . $conn->connect_error);
              }
              $sql = "SELECT DISTINCT idTallas, numeroTallas FROM tallas";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<option value='" . $row["idTallas"] . "'>" . $row["numeroTallas"] . "</option>";
                }
              } else {
                echo "<option value=''>No hay tallas disponibles</option>";
              }
              $conn->close();
              ?>
            </select>
          </div>
          <div class="productop">
            <label for="referencia">Producto:</label>
            <input type="text" id="referencia" name="referencia" placeholder="Ingrese el producto" required>
          </div>
          <div class="campos-linea">
            <label for="entrada">Entrada:</label>
            <input type="text" id="entrada" name="entrada" placeholder="Ingrese la cantidad" required pattern="[0-9]+">
          </div>
          <div class="campos-linea">
            <label for="fechaEntrada">Fecha de Entrada:</label>
            <input type="date" id="fechaEntrada" name="fechaEntrada" required>
          </div>
          <button type="submit">Guardar</button>
        </form>
      </div>
    </section>
  </div>
  </form>
</body>
</html>