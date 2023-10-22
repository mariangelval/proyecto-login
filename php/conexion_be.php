<?PHP
        $server = 'localhost';
        $username = 'root';
        $password = ''; // Deja la contraseña en blanco
        $database = 'login';
        $connection = new mysqli($server, $username, $password, $database, 3308);
        // or die("not connected");
        // echo "connected";        
?>