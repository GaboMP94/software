<?php
// Iniciar la sesión
session_start();

// Incluir el archivo de conexión a la base de datos
include_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar los datos enviados desde el formulario
    $correo = trim($_POST['correo']);
    $password = trim($_POST['password']);

    // Verificar que los campos no estén vacíos
    if (empty($correo) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    try {
        // Crear la consulta para buscar el usuario por correo
        $query = "SELECT usuario_id, nombre_completo, password FROM usuarios WHERE correo = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si se encontró un usuario con ese correo
        if ($result->num_rows === 0) {
            echo json_encode(['status' => 'error', 'message' => 'Correo o contraseña incorrectos.']);
            exit;
        }

        // Obtener los datos del usuario
        $user = $result->fetch_assoc();

        // Verificar la contraseña
        $password_hashed = hash('sha256', $password); // Encriptar la contraseña ingresada
        if ($password_hashed !== $user['password']) {
            echo json_encode(['status' => 'error', 'message' => 'Correo o contraseña incorrectos.']);
            exit;
        }

        // Iniciar sesión y guardar los datos del usuario
        $_SESSION['usuario_id'] = $user['usuario_id'];
        $_SESSION['nombre_completo'] = $user['nombre_completo'];

        // Responder con éxito
        echo json_encode(['status' => 'success', 'message' => 'Inicio de sesión exitoso.']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Ocurrió un error en el servidor: ' . $e->getMessage()]);
    }
}
