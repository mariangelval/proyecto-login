<?php
    include 'conexion_be.php';

    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];
    $validarLogin = mysqli_query($connection, "SELECT * FROM alumno WHERE nombre='$usuario' and cuil = '$contrasenia'");

    if(mysqli_num_rows($validarLogin) > 0){
        session_start();
        $_SESSION['usuario'] = $usuario;
        $_SESSION['cuil'] = $contrasenia;
        header("location: ../userprofile.php");
        exit;
    } else {
        echo '
            <script>
                alert("Usuario inexistente");
            </script>
        ';
        exit;
    }

?>
