<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "myweb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";


    if ($result = $conn->query($sql)) {
        if ($result->num_rows > 0) {
            echo "Login exitoso, bienvenido " . $user;
        } else {
            echo "Nombre de usuario o contraseña incorrectos.";
        }
    } else {
        
        echo "Error en la consulta: " . $conn->error;
    }

   
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Vulnerable</title>
</head>
<body>
    <h2>Bienvenido, indentifiquese</h2>
    <form method="POST" action="index.php">
        Nombre de Usuario: <input type="text" name="username"><br>
        Contraseña: <input type="password" name="password"><br>
        <input type="submit" value="Iniciar sesión">
    </form>
</body>
</html>
