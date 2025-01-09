<!-- add_user.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-5">Formulario de Registro</h2>
        <form id="registerForm" class="mt-4">
            <div class="mb-3">
                <label for="nombre_completo" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
        <div id="responseMessage" class="mt-3"></div>
    </div>

    <script>
        $(document).ready(function() {
            $("#registerForm").on("submit", function(event) {
                event.preventDefault(); // Prevenir el envío normal del formulario

                const formData = $(this).serialize();

                $.ajax({
                    url: 'register_user.php',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        const data = JSON.parse(response);

                        if (data.status === 'success') {
                            $('#responseMessage').html('<div class="alert alert-success">' + data.message + '</div>');
                        } else {
                            $('#responseMessage').html('<div class="alert alert-danger">' + data.message + '</div>');
                        }
                    },
                    error: function() {
                        $('#responseMessage').html('<div class="alert alert-danger">Ocurrió un error al registrar el usuario.</div>');
                    }
                });
            });
        });
    </script>
</body>
</html>
