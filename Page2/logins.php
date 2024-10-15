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

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($pass, $hashed_password)) {
            echo "Login exitoso, bienvenido " . htmlspecialchars($user);
        } else {
            echo "Nombre de usuario o contraseña incorrectos.";
        }
    } else {
        echo "Nombre de usuario o contraseña incorrectos.";
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Seguro</title>
</head>
<body>
    <h2>Bienvenido, ingrese credenciales</h2>
    <form method="POST" action="logins.php">
        Nombre de Usuario: <input type="text" name="username" ><br>
        Contraseña: <input type="password" name="password" ><br>
        <input type="submit" value="Iniciar sesión">
    </form>
</body>
</html>
