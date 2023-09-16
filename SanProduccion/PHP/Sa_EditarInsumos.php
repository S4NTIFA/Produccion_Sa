<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resgistrar producto</title>
  <link rel="stylesheet" href="../CSS/inventario.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link rel="shortcut icon" type="image/x-icon" href="/img/leben.jpg">
</head>

<body>
  <div class="container">
    <section>
      <nav class="a-hover">
        <ul>
          <li>
            <a href="#" class="logo">
              <img src="../IMG/leben.jpg" alt="">
              <span class="nav-item">PRODUCCION</span>
            </a>
          </li>
          <li><a href="../SaProduccion.html">
              <i class="fas fa-circle-user"></i>
              <span class="nav-item">Perfil</span>
            </a></li>
          </li>
          </li>
          <li><a href="../PHP/Sa_RegistarInsumos.php">
              <i class="fas fa-pen"></i>
              <span class="nav-item">Registrar Insumos</span>
            </a></li>
          <li><a href="../PHP/Sa_RegirarProduccion.php">
              <i class="fas fa-pen"></i>
              <span class="nav-item">Registrar Produccion</span>
            </a></li>
          </a></li>
          <li><a href="../PHP/Sa_FinalizarProduccion.php">
              <i class="fas fa-pen"></i>
              <span class="nav-item">Finalizar Produccion</span>
            </a></li>
          <li><a href="../PHP/Sa_ConsultarInsumos.php">
              <i class="fas fa-list"></i>
              <span class="nav-item">Consultar Insumos</span>
            </a></li>
          <li><a href="../PHP/Sa_ConsultarProduccion.php">
              <i class="fas fa-list"></i>
              <span class="nav-item">Consultar Produccion</span>
            </a></li>
          <li><a href="../SanSalir.html">
              <i class="fas fa-sign-out-alt"></i>
              <span class="nav-item">Salir</span>
            </a></li>
        </ul>
      </nav>
    </section>
  <?php
     // Conectar a la base de datos (ajusta los detalles de la conexión según tu configuración)
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "snb";

     $conn = new mysqli($servername, $username, $password, $dbname);

     // Verificar la conexión
     if ($conn->connect_error) {
         die("Error de conexión: " . $conn->connect_error);
     }

     // Verificar si se envió el formulario de edición
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $idInsumos = $_POST["idInsumos"];
     $cantidadInsumos = $_POST["cantidadInsumos"];
     $tipoInsumos = $_POST["tipoInsumos"];
     $fechaInsumos = $_POST["fechaInsumos"];

     // Actualizar el registro en la base de datos
     $sql = "UPDATE insumos SET cantidadInsumos = $cantidadInsumos, tipoInsumos = '$tipoInsumos', fechaInsumos = '$fechaInsumos' WHERE idInsumos = $idInsumos";

     if ($conn->query($sql) === TRUE) {
        echo "Cambios guardados con éxito.";
        header ("location: ../PHP/Sa_ConsultarInsumos.php");
     } else {
        echo "Error al guardar los cambios: " . $conn->error;
    }
    }

    // Recuperar el ID del insumo de la URL
    if (isset($_GET["idInsumos"])) {
    $idInsumos = $_GET["idInsumos"];

    // Consulta la base de datos para obtener los datos del insumo con el ID proporcionado
    $sql = "SELECT * FROM insumos WHERE idInsumos = $idInsumos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $cantidadInsumos = $row["cantidadInsumos"];
        $tipoInsumos = $row["tipoInsumos"];
        $fechaInsumos = $row["fechaInsumos"];
    } else {
        echo "No se encontró el registro.";
        exit;
    }
   }

    // Cerrar la conexión a la base de datos
    $conn->close();
  ?>
    <section class="main">
      <div class="formulario">
        <h2>Editar Insumos</h2>
        <form method="POST">
          <div class="campos-linea">
            <label for="idInsumos">Id Insumo:</label>
            <input type="number" name="idInsumos" value="<?php echo $idInsumos; ?>" readonly>
          </div>
          <div class="campos-linea">
            <label for="tipoInsumos">Tipo de Insumo:</label>
            <input type="text" name="tipoInsumos" value="<?php echo $tipoInsumos; ?>" required>
          </div>
          <div class="campos-linea">
            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidadInsumos" value="<?php echo $cantidadInsumos; ?>" required>
          </div>
          <div class="campos-linea">
            <label for="fechaEntrada">Fecha de Entrada:</label>
            <input type="date" name="fechaInsumos" value="<?php echo $fechaInsumos; ?>" required>
          </div>
          <button type="submit">Guardar</button>
        </form>

    </section>
  </div>

</body>

</html>