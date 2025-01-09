<!DOCTYPE html>
<html lang="es">
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

                <div class="form-floating mb-3 position-relative">
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
    event.preventDefault(); 

    const correo = document.getElementById("correo").value.trim();
    const password = document.getElementById("password").value.trim();

    if (!correo || !password) {
        ToastMaker('Todos los campos son obligatorios.', 3000, {
            type: 'error',
            position: 'top-right',
            styles: {
                backgroundColor: 'red',
                color: 'white',
                fontSize: '20px',
                padding: '10px',
                borderRadius: '5px',
                opacity: '0.8'
            },
            classList: ['toast-slide-in'] // Animación de entrada
        });
    } else {
        fetch('signin.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ correo, password })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                ToastMaker(data.message, 3000, { 
                    type: 'success', 
                    position: 'top-right',
                    classList: ['toast-slide-in'] // Animación de entrada
                });
                setTimeout(() => {
                    window.location.href = 'dashboard.php';
                }, 1000);
            } else {
                ToastMaker(data.message, 3000, { 
                    type: 'error', 
                    position: 'top-right',
                    styles: {
                        backgroundColor: 'red',
                        color: 'white',
                        fontSize: '20px',
                        padding: '10px',
                        borderRadius: '5px',
                        opacity: '0.8'
                    },
                    classList: ['toast-slide-in'] // Animación de entrada
                });
            }
        })
        .catch(() => {
            ToastMaker('Ocurrió un error inesperado.', 3000, { 
                type: 'error', 
                position: 'top-right',
                styles: {
                    backgroundColor: 'red',
                    color: 'white',
                    fontSize: '20px',
                    padding: '10px',
                    borderRadius: '5px',
                    opacity: '0.8'
                },
                classList: ['toast-slide-in'] // Animación de entrada
            });
        });
    }
});

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>