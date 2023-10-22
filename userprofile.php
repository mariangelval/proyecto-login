<?php
    $server = 'localhost';
    $username = 'root';
    $password = ''; // Deja la contraseña en blanco
    $database = 'login';
    $connection = new mysqli($server, $username, $password, $database, 3308);
    // Obtiene el nombre del usuario autenticado desde la base de datos
    session_start();
    
    $query = "SELECT nombre FROM alumno WHERE nombre='$_SESSION[usuario]'";
    $resultado = mysqli_query($connection, $query);
    
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        $nombreUsuario = $fila['nombre'];
    } else {
        // Manejo de error si no se puede obtener el nombre del usuario
        $nombreUsuario = "Usuario Desconocido";
    }
    // Cierra la conexión a la base de datos
    mysqli_close($connection);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="./estilos/userprofilestyle.css">
</head>
<body>
    <header>
    </header>
    
    <div class="section">
        <div class="titulo">
            <h1>¡Bienvenido/a, <?php echo $nombreUsuario;?>!</h1>
        </div>
    </div>
    <div class="servicios">
        <a href="cate.php" class="cajitalink">
            <div class="cajita">
                <h2>CATE</h2>
                <div class="icon">
                    <img src="./imagenes/cate.png" alt="cate">
                </div>
                <div class="texto">
                    <p>Toda la información del CATE de encuentra aquí.</p>
                </div>
            </div>
        </a>
        <a href="materias.php" class="cajitalink">
            <div class="cajita">
                <h2>MATERIAS</h2>
                <div class="icon">
                    <img src="./imagenes/materias.png" alt="materias">
                </div>
                <div class="texto">
                    <p>Información sobre el estado de tus materias</p>
                </div>
            </div>
        </a>
        <a href="cursospia.php" class="cajitalink">
            <div class="cajita">
                <h2>CURSOS PIA</h2>
                <div class="icon">
                  <img src="./imagenes/cursospia.png" alt="cursos pia">  
                </div>
                <div class="texto">
                    <p>Descubre los cursos que tenemos para tí</p>
                </div>
            </div>
        </a>
    </div>
</body>
</html>