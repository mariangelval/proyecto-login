<?php
$server = 'localhost';
$username = 'root';
$password = ''; // Deja la contraseña en blanco
$database = 'login';
$connection = new mysqli($server, $username, $password, $database, 3308);

// Verificar la conexión
if ($connection->connect_error) {
    die("Error de conexión: " . $connection->connect_error);
}

session_start();
$cuil = $_SESSION['cuil']; // Obtén el CUIL del alumno de la sesión

// Obtener el año seleccionado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['year'])) {
    $year = $_POST['year'];

    // Consulta SQL para obtener las materias junto con su estado y profesor
    $sql = "SELECT 
    M.nombre AS Materia,
    ME.estado AS Estado,
    CONCAT(P.nombre, ' ', P.apellido) AS Profesor,
    C.anio AS Anio_Materia
    FROM 
        Alumno A
    INNER JOIN 
        AlumnoMateriaEstado AME ON A.CUIL = AME.CUIL
    INNER JOIN 
        MateriaEstado ME ON AME.idEstado = ME.idEstado
    INNER JOIN 
        Materia M ON ME.idMateria = M.idMateria
    INNER JOIN 
        Profesor P ON ME.idProfesor = P.idProfesor
    INNER JOIN 
        Curso C ON M.idCurso = C.idCurso
    WHERE 
        C.anio = $year AND A.`CUIL` = $cuil";
    
    $resultado = $connection->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materias</title>
    <link rel="stylesheet" href="./estilos/materias.css">
</head>
<body>
    <header>
    </header>
    <!-- Título de la página -->
    <div class="section">
        <div class="titulo">
            <h1>Estado de tus materias</h1>
        </div>
    </div>
    <!-- Selector para poder elegir el año del que se quiere saber información sobre las materias -->
    <form method="post" action="" id="form-anio">
    <div class="selector">
        <select name="year" id="year">
            <option value="1" <?php if(isset($_POST['year']) && $_POST['year'] == '1') echo 'selected'; ?>>1er Año</option>
            <option value="2" <?php if(isset($_POST['year']) && $_POST['year'] == '2') echo 'selected'; ?>>2do Año</option>
            <option value="3" <?php if(isset($_POST['year']) && $_POST['year'] == '3') echo 'selected'; ?>>3er Año</option>
            <option value="4" <?php if(isset($_POST['year']) && $_POST['year'] == '4') echo 'selected'; ?>>4to Año</option>
            <option value="5" <?php if(isset($_POST['year']) && $_POST['year'] == '5') echo 'selected'; ?>>5to Año</option>
            <option value="6" <?php if(isset($_POST['year']) && $_POST['year'] == '6') echo 'selected'; ?>>6to Año</option>
            </select>
        </div>
    </form>
    <script>
    // Agregar un evento onchange al selector de año
    document.getElementById("year").addEventListener("change", function() {
        // Enviar el formulario automáticamente cuando se cambie la selección
        document.getElementById("form-anio").submit();
    });
    </script>
    <!-- Tabla contenedora de información -->
    <table>
        <tr>
            <th class="cabecera">Materia</th>
            <th class="cabecera">Profesor</th>
            <th class="cabecera">Estado</th>
        </tr>
        <?php
        // Genera dinámicamente las filas de la tabla con los resultados de la consulta
        if (isset($resultado) && $resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo '<tr>';
                echo '<td class="materia">' . $fila['Materia'] . '</td>';
                echo '<td class="profesor">' . $fila['Profesor'] . '</td>';
                echo '<td class="status">';
                echo '<div class="status-container">';
                
                // Dependiendo del estado, puedes aplicar diferentes estilos
                if ($fila['Estado'] == 'Aprobado') {
                    echo '<div class="statuscontainer_aprobado">' . $fila['Estado'] . '</div>';
                } else {
                    echo '<div class="statuscontainer_desaprobado">' . $fila['Estado'] . '</div>';
                }
                
                echo '</div>';
                echo '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="3">No hay materias disponibles para el año seleccionado.</td></tr>';
        }
        ?>
    </table>
    
    <!-- Boton para volver, todavía pendiente de aplicar estilos -->
    <a href="userprofile.php" class="volver">VOLVER</a>
</body>
</html>
