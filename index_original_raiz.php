<?php
session_start();

// Si ya se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $usuario = trim($_POST['username']);
    $clave = trim($_POST['password']);

    // Validar campos vacíos
    if (empty($usuario) || empty($clave)) {
        $error = "Por favor complete todos los campos.";
    } else {
        // Simulación de datos de usuario (puedes conectarlo a tu BD)
        $usuario_valido = 'admin';
        $clave_valida = '1234';

        if ($usuario === $usuario_valido && $clave === $clave_valida) {
            // Inicio de sesión exitoso
            $_SESSION['usuario'] = $usuario;
            header("Location: secciones/index.php");
            exit();
        } else {
            $error = "Usuario o contraseña incorrectos.";
        }
    }
}
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Login</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
                body {
        background: linear-gradient(to right,rgb(233, 230, 230),rgb(214, 214, 214));
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        }

        .login-card {
        border-radius: 20px;
        /* box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); */
        box-shadow: 0 0 0 0.2rem rgba(243, 161, 0, 0.6)
        }

        .logo {
        width: 80px;
        margin-bottom: 10px;
        }

        /* .btn-primary {
        background-color: #6a11cb;
        border: none;
        }

        .btn-primary:hover {
        background-color: #5b0fbc;
        } */

        .form-control:focus {
        box-shadow: none;
        border-color:rgb(243, 161, 0 );
        }

        /* Animación de borde */
        @keyframes borderGlow {
          0% {
            box-shadow: 0 0 0 0 rgba(243, 161, 0, 0.6);
          }
          50% {
            box-shadow: 0 0 15px 5px rgba(243, 161, 0, 0.9);
          }
          100% {
            box-shadow: 0 0 0 0 rgba(243, 161, 0, 0.6);
          }
        }

        .login-card {
          border-radius: 20px;
          animation: borderGlow 3s infinite;
        }

        /* Botón “Ingresar” animado al pasar el puntero */
        .btn-primary {
          background-color: #f3a100;
          border: none;
          transition: box-shadow 0.3s ease, background-color 0.3s ease;
        }

        .btn-primary:hover {
          background-color: #f3a100;
          box-shadow: 0 0 10px 4px rgba(243, 161, 0, 0.8);
}
    </style>

    </head>

    
<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-4">
        <div class="card login-card p-4 text-center">
          <!-- Logo -->
          <img src="src/img/calibracion.png" alt="Logo" class="logo mx-auto d-block" />

          <h4 class="mb-1">Bienvenido</h4>
          <p class="text-muted">Sistema de Gestión</p>

          <form id="loginForm" action="secciones/index.php" method="post">
            <div class="mb-3 text-start">
              <label for="username" class="form-label">
                <i class="bi bi-person-fill"></i> Usuario
              </label>
              <input type="text" class="form-control" id="username" name="username" required />
            </div>
            <div class="mb-3 text-start">
              <label for="password" class="form-label">
                <i class="bi bi-lock-fill"></i> Contraseña
              </label>
              <input type="password" class="form-control" id="password" name="password" required />
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Ingresar</button>
              <button onclick="window.location.href='index.html'" class="nav-link">
              Regresar
              </button>

            </div>
          </form>

          <div class="mt-3 text-muted">
            <small>© 2025 Sistema de Gestión</small>
          </div>
        </div>
      </div>
    </div>
  </div>

    <header>
            <!-- place navbar here -->
        </header>
        <main></main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
            <!-- Validación con SweetAlert -->
        <script>
            document.getElementById("loginForm").addEventListener("submit", function(e) {
            e.preventDefault();

            const username = document.getElementById("username").value.trim();
            const password = document.getElementById("password").value.trim();

            if (username === "" || password === "") {
                Swal.fire({
                title: "Campos vacíos",
                text: "Por favor, completa todos los campos.",
                icon: "warning",
                confirmButtonText: "Aceptar"
                });
            } else {
                Swal.fire({
                title: '¡Accediendo!',
                text: 'Verificando credenciales...',
                icon: 'info',
                showConfirmButton: false,
                timer: 1500,
                didClose: () => {
                    e.target.submit(); // Enviar formulario si todo está correcto
                }
                });
            }
            });
        </script>

</body>
</html>
