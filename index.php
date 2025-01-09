<!DOCTYPE html>
<html>
<head>
    <?php include_once "head.php"; ?>
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 500px;">
            <h1 class="text-center mb-4">Inicia sesión</h1>

            <form id="loginForm" class="p-2 mt-2">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="correo" placeholder="Correo" name="correo">
                    <label for="correo">✉️ Correo</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" placeholder="Contraseña" name="password">
                    <label for="password">🔑 Contraseña</label>
                    <span id="togglePassword" style="cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%); font-size: 25px;">
                        🙈
                    </span>
                </div>

                <div class="mb-3">
                    <button type="submit" class="form-control btn btn-primary">Entrar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            togglePassword.textContent = type === 'password' ? '🙈' : '🙉';
        });

        document.getElementById("loginForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Evita el envío del formulario

            const correo = document.getElementById("correo").value;
            const password = document.getElementById("password").value;

            // Verificar que los campos no estén vacíos
            if (!correo || !password) {
                ToastMaker('Todos los campos son obligatorios.', 3000, {
                    type: 'error',
                    position: 'top-right',
                    styles : {
                        backgroundColor: 'red',
                        fontSize: '20px'
                    }
                });
            } else {
                ToastMaker('Iniciando sesión...', 3000, { type: 'success', position: 'top-right' });
                // Aquí puedes enviar el formulario si la validación es correcta
                // this.submit(); // Descomenta si es necesario
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>