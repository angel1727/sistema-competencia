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
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($username) || empty($password)) {
                $error_message = "Por favor complete todos los campos.";
            } else {
                try {
                    // Idealmente, esta lógica estaría en un UserModel
                    // $user = $this->userModel->findByUsername($username);
                    // if ($user && $this->userModel->verifyPassword($password, $user->password_column_name)) { ... }

                    $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE username = :username");
                    $stmt->bindParam(':username', $username);
                    $stmt->execute();
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($user) {
                        // ¡¡¡ADVERTENCIA DE SEGURIDAD!!!
                        // Esto asume contraseñas en TEXTO PLANO. ¡NO HACER ESTO EN PRODUCCIÓN!
                        // DEBES USAR password_hash() al guardar y password_verify() al comprobar.
                        if ($password === $user['password']) { // Reemplazar 'password' con el nombre de tu columna
                            // Login exitoso
                            $_SESSION['user_id'] = $user['id'];
                            $_SESSION['username'] = $user['username'];
                            $this->redirect('/admin/dashboard'); // Usa el método redirect heredado
                        } else {
                            $error_message = "Usuario o contraseña incorrectos.";
                        }
                    } else {
                        $error_message = "Usuario o contraseña incorrectos.";
                    }
                } catch (PDOException $e) {
                    error_log("Error de login: " . $e->getMessage()); // Loggear el error real
                    $error_message = "Error del sistema. Por favor, inténtelo más tarde.";
                }
            }
            $this->showLoginForm(['error' => $error_message]);
        } else {
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
