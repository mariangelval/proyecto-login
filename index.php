<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresa a tu cuenta</title>
</head>
<body>
    <form action="php/login_usuario_be.php" method="POST" class="formulario">
        <h2 class="titulo-formulario">Inicia Sesión</h2>

        <div class="contenedor-formulario">
            <div class="grupo-formulario">
                <input type="text" id="usuario" class="imput-formulario" placeholder=" " name="usuario">
                <label for="usuario" class="label-formulario">Usuario:</label>
                <span class="linea-formulario"></span>
            </div>
        </div>

        <div class="contenedor-formulario">
            <div class="grupo-formulario">
                <input type="text" id="contrasenia" class="imput-formulario" placeholder=" " name="contrasenia">
                <label for="contrasenia" class="label-formulario">Contraseña:</label>
                <span class="linea-formulario"></span>
            </div>
        </div>

        <input type="submit" class="enviar-formulario" value="Entrar">
    </form>
</body>
</html>