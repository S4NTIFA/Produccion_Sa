<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resgistrar producto</title>
  <link rel="stylesheet" href="../CSS/inventario.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
  <link rel="shortcut icon" type="image/x-icon" href="/img/leben.jpg">
</head>
<body>
  <div class="container">
    <section>
      <nav class ="a-hover">
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
    // Procesar el formulario cuando se envíe
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Conexión a la base de datos (configura tus credenciales)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "snb";

        $conn = new mysqli($servername, $username, $password, $database);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Obtener los datos del formulario
        $cantidad = $_POST['cantidad'];
        $fechaEntrada = $_POST['fechaEntrada'];
        $tipoInsumos = $_POST['tipoInsumos']; // Updated to use user input for tipoInsumos

        // Consulta SQL para insertar el registro en la tabla insumos
        $sql = "INSERT INTO insumos (cantidadInsumos, fechaInsumos, tipoInsumos) VALUES (?, ?, ?)";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("iss", $cantidad, $fechaEntrada, $tipoInsumos);
            if ($stmt->execute()) {
                header ("location: ../PHP/Sa_ConsultarInsumos.php");
            } else {
                echo "Error al guardar el registro de insumo: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error en la preparación de la consulta: " . $conn->error;
        }

        // Cerrar la conexión
        $conn->close();
    }
    ?>
    <section class="main">
      <div class="formulario">
        <h2>Registrar Insumos</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class ="campos-linea">
          <label for="tipoInsumos">Tipo de Insumo:</label>
          <input type="text" name="tipoInsumos" placeholder ="Ingrese el tipo de Insumo" required> 
        </div>
        <div class ="campos-linea">
          <label for="cantidad">Cantidad:</label>
          <input type="number" name="cantidad" placeholder ="Ingrese la cantidad" required>
        </div>
        <div class ="campos-linea">
          <label for="fechaEntrada">Fecha de Entrada:</label>
          <input type="date" name="fechaEntrada" required>
        </div>
        <button type="submit">Guardar</button>
    </form>
      
    </section>
  </div>
  
</body>
</html>