<?php
session_start();

// Incluir la configuración de la base de datos
require_once 'configuraciones/bd.php';
$conexion = BD::crearInstancia();

// Si ya se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $usuario = trim($_POST['username']);
    $clave = trim($_POST['password']);

    // Validar campos vacíos
    if (empty($usuario) || empty($clave)) {
        $error = "Por favor complete todos los campos.";
    } else {
        try {
            // Consulta preparada para evitar inyección SQL
            $sql = "SELECT idusuario, usuario, password, rol FROM usuario WHERE usuario = :usuario LIMIT 1";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $stmt->execute();
            
            // Verificar si encontró el usuario
            if ($stmt->rowCount() == 1) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Verificar la contraseña (asumiendo que está hasheada)
                if (password_verify($clave, $user['password'])) {
                    // Inicio de sesión exitoso
                    $_SESSION['usuario'] = [
                        'id' => $user['idusuario'],
                        'nombre' => $user['usuario'],
                        'rol' => $user['rol']
                    ];
                    
                    // Redireccionar según el rol
                    if ($user['rol'] == 'administrador') {
                        header("Location: secciones/vista_postulantes.php");
                    } else {
                        header("Location: secciones/usuario.php");
                    }
                    exit();
                } else {
                    $error = "Usuario o contraseña incorrectos.";
                }
            } else {
                $error = "Usuario o contraseña incorrectos.";
            }
        } catch(PDOException $e) {
            $error = "Error al conectar con la base de datos: " . $e->getMessage();
        }
    }
}
?>
<!doctype html>
<html lang="es">
    <head>
        <title>Sistemas de Competenciaball</title>
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

/* Fondo animado con degradado */
body {
            background: linear-gradient(-45deg, #f3a100, #e9e6e6, #d6d6d6, #f3a100);
            background-size: 400% 400%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: gradientBG 15s ease infinite;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .login-card {
            border-radius: 20px;
            box-shadow: 0 0 0 0.2rem rgba(243, 161, 0, 0.6);
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(5px);
            border: none;
        }

        .logo {
            width: 80px;
            margin-bottom: 10px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: rgb(243, 161, 0);
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

        /* Botón "Ingresar" animado */
        .btn-primary {
            background-color: #f3a100;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #e59400;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(243, 161, 0, 0.4);
        }

        /* Efecto de vidrio esmerilado para mejor legibilidad */
        .card-body {
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 15px;
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
          <!-- Mostrar errores si existen -->
          <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
          <?php endif; ?>

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
              Ingresar a la Pagina Web
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
        
        <script>
          $usuarios = $conexion->query("SELECT idusuario, password FROM usuario")->fetchAll();
          foreach ($usuarios as $usuario) {
              if (!password_needs_rehash($usuario['password'], PASSWORD_DEFAULT)) {
                  continue; // Saltar si ya está hasheada
              }
              $hashed = password_hash($usuario['password'], PASSWORD_DEFAULT);
              $conexion->prepare("UPDATE usuario SET password = ? WHERE idusuario = ?")
                      ->execute([$hashed, $usuario['idusuario']]);
          }

        </script>

</body>
</html>
