<?php
// app/controllers/AuthController.php

// La clase Controller base se cargará mediante el autoloader de public/index.php
// require_once __DIR__ . '/../core/Controller.php';

class AuthController extends Controller { // Hereda de Controller

    protected $db;
    // Podríamos tener una propiedad para un UserModel si lo creamos
    // protected $userModel;

    public function __construct() {
        // Llamar al constructor del padre si es necesario en el futuro
        // parent::__construct();

        // La conexión a la BD se obtiene de la clase BD.
        // El archivo app/config/bd.php es incluido por public/index.php.
        $this->db = BD::crearInstancia();

        // Ejemplo si tuviéramos un UserModel:
        // $this->userModel = $this->model('User'); // Carga el modelo User
    }

    /**
     * Muestra el formulario de login.
     * @param array $data Datos para pasar a la vista (ej. errores)
     */
    public function showLoginForm($data = []) {
        // Utiliza el método view heredado de la clase Controller base
        $this->view('auth/login', $data);
    }

    /**
     * Procesa la solicitud de login.
     */
    public function login() {
        $error_message = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login_identifier = trim($_POST['usuario'] ?? ''); // Campo del formulario ahora es 'usuario'
            $password = trim($_POST['password'] ?? '');

            if (empty($login_identifier) || empty($password)) {
                $error_message = "Por favor complete todos los campos.";
            } else {
                try {
                    // Consultar la tabla 'usuario' usando la columna 'usuario' para el login
                    $stmt = $this->db->prepare("SELECT idusuario, usuario, password FROM usuario WHERE usuario = :login_identifier");
                    $stmt->bindParam(':login_identifier', $login_identifier);
                    $stmt->execute();
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($user && password_verify($password, $user['password'])) {
                        // Login exitoso
                        $_SESSION['user_id'] = $user['idusuario'];
                        $_SESSION['username'] = $user['usuario']; // Guardar el contenido de la columna 'usuario' en la sesión
                        $this->redirect('/admin/dashboard');
                    } else {
                        $error_message = "Usuario o contraseña incorrectos.";
                    }
                } catch (PDOException $e) {
                    error_log("Error de login: " . $e->getMessage());
                    $error_message = "Error del sistema. Por favor, inténtelo más tarde.";
                }
            }
            // Si hay error o no es POST, mostrar formulario de login
            $this->showLoginForm(['error' => $error_message]);
        } else {
            // Si es GET, simplemente mostrar el formulario
            $this->showLoginForm();
        }
    }

    /**
     * Procesa el cierre de sesión.
     */
    public function logout() {
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        $this->redirect('/login'); // Usa el método redirect heredado
    }

    // El método view() ya no es necesario aquí, se hereda de Controller.
}
?>
