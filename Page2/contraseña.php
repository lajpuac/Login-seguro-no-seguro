<?php
// Cambia esto a la contraseña que deseas hashear
$plain_password = "usuario234"; 

// Generar el hash
$hashed_password = password_hash($plain_password, PASSWORD_BCRYPT);

// Mostrar el hash generado
echo "Hash de la contraseña: " . $hashed_password;
?>

