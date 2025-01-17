<?php
ini_set('display_errors', 0);
ini_set('session.gc_maxlifetime', 3600); // 1 hora
session_set_cookie_params(3600);
session_start();

include_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener y sanitizar los datos del formulario
    $correo = filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    // Validar campos obligatorios
    if (empty($correo) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    // Validar si el correo ingresado es válido
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Correo inválido.']);
        exit;
    }

    try {
        // Consulta para verificar si el correo está registrado
        $query = "SELECT * FROM usuarios WHERE correo = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si el correo está registrado
        if ($result->num_rows === 0) {
            echo json_encode(['status' => 'error', 'message' => 'Correo no registrado.']);
            exit;
        }

        // Obtener los datos del usuario
        $user = $result->fetch_assoc();

        // Verificar la contraseña
        if (!password_verify($password, $user['password'])) {
            echo json_encode(['status' => 'error', 'message' => 'Contraseña incorrecta.']);
            exit;
        }

        // Iniciar sesión
        $_SESSION['usuario_id'] = $user['usuario_id'];
        $_SESSION['nombre_completo'] = $user['nombre_completo'];

        echo json_encode(['status' => 'success', 'message' => 'Inicio de sesión exitoso.']);
    } catch (Exception $e) {
        error_log("Error en inicio de sesión: " . $e->getMessage());
        echo json_encode(['status' => 'error', 'message' => 'Ocurrió un error en el servidor.']);
    }
}
?>