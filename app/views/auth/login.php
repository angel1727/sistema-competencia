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

        .form-control:focus {
        box-shadow: none;
        border-color:rgb(243, 161, 0 );
        }

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

        .btn-primary {
          background-color: #f3a100;
          border: none;
          transition: box-shadow 0.3s ease, background-color 0.3s ease;
        }

        .btn-primary:hover {
          background-color: #f3a100;
          box-shadow: 0 0 10px 4px rgba(243, 161, 0, 0.8);
        }
        .error-message { color: red; text-align: center; margin-bottom: 10px; font-weight: bold; }
    </style>

    </head>

<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-4">
        <div class="card login-card p-4 text-center">
          <!-- Logo -->
          <!-- Asegúrate que la ruta a la imagen sea correcta desde la raíz pública -->
          <img src="/img/calibracion.png" alt="Logo" class="logo mx-auto d-block" />
          <!-- O podría ser /img/logo_src.png dependiendo de cuál era el logo del login -->

          <h4 class="mb-1">Bienvenido</h4>
          <p class="text-muted">Sistema de Gestión</p>

          <?php
          // Mostrar error si existe (pasado desde AuthController)
          if (isset($data['error']) && !empty($data['error'])) {
              echo '<p class="error-message">' . htmlspecialchars($data['error']) . '</p>';
          }
          ?>

          <form id="loginForm" action="/login" method="post"> <!-- Acción apunta a la ruta /login (POST) -->
            <div class="mb-3 text-start">
              <label for="usuario" class="form-label">
                <i class="bi bi-person-fill"></i> Usuario
              </label>
              <input type="text" class="form-control" id="usuario" name="usuario" required />
            </div>
            <div class="mb-3 text-start">
              <label for="password" class="form-label">
                <i class="bi bi-lock-fill"></i> Contraseña
              </label>
              <input type="password" class="form-control" id="password" name="password" required />
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Ingresar</button>
              <!-- El botón de regresar ahora apunta a la raíz pública /index.html -->
              <button type="button" onclick="window.location.href='/index.html'" class="nav-link mt-2">
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

    <!-- Bootstrap JavaScript Libraries (ya no se necesita header/main/footer aquí) -->
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
        // El JavaScript de validación y SweetAlert se mantiene igual,
        // pero el e.target.submit() ahora enviará el formulario a /login (POST)
        // lo que será manejado por AuthController@login vía el Router.
        document.getElementById("loginForm").addEventListener("submit", function(e) {
            e.preventDefault();

            const usernameInput = document.getElementById("username");
            const passwordInput = document.getElementById("password");
            const username = usernameInput.value.trim();
            const password = passwordInput.value.trim();

            if (username === "" || password === "") {
                Swal.fire({
                title: "Campos vacíos",
                text: "Por favor, completa todos los campos.",
                icon: "warning",
                confirmButtonText: "Aceptar"
                });
            } else {
                // Si se desea, se puede quitar el SweetAlert de "Accediendo"
                // y dejar que el controlador maneje la redirección o el error directamente.
                // Por ahora, lo mantenemos para la experiencia de usuario.
                Swal.fire({
                title: '¡Accediendo!',
                text: 'Verificando credenciales...',
                icon: 'info',
                showConfirmButton: false,
                timer: 1500, // Ajustar tiempo si es necesario
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                },
                willClose: () => {
                    // No es necesario anular el temporizador aquí si se envía el formulario
                }
                }).then((result) => {
                    // Este bloque se ejecutará después de que el temporizador de SweetAlert termine
                    // o si se cierra manualmente (aunque showConfirmButton es false)
                    // Aquí es donde realmente se envía el formulario
                    if (result.dismiss === Swal.DismissReason.timer) {
                        e.target.submit();
                    }
                });
            }
        });
    </script>

</body>
</html>
