<?php
$host = 'localhost'; // Cambia si es necesario
$dbname = 'software';
$username = 'root'; // Cambia si es necesario
$password = 'usbw'; // Cambia si es necesario

// Crear conexión a la base de datos
$conn = new mysqli($host, $username, $password, $dbname);

// Verificar si hay errores en la conexión
if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}
?>
