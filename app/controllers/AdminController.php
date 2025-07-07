<?php
// app/controllers/AdminController.php

class AdminController extends Controller {

    // protected $db; // La conexión a BD la maneja el Modelo base si es necesario directamente en Controller
    protected $usuarioModel;
    // protected $postulanteModel;

    public function __construct() {
        parent::__construct();

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }

        // Cargar modelos necesarios
        $this->usuarioModel = $this->model('Usuario'); // Carga UsuarioModel.php
        // $this->postulanteModel = $this->model('Postulante');

        // Verificar si el modelo se cargó correctamente (opcional pero recomendado)
        if (!$this->usuarioModel) {
            // Manejar el error, quizás redirigir o mostrar un mensaje
            die('Error: No se pudo cargar el modelo de Usuario.');
        }
    }

    /**
     * Muestra el dashboard principal del panel de administración.
     */
    public function dashboard() {
        // Aquí cargarías datos necesarios para el dashboard (ej. estadísticas)
        // y luego mostrarías la vista del dashboard.
        // $data = [
        // 'titulo' => 'Dashboard Admin'
        // ];
        // $this->view('admin/dashboard', $data);

        echo "<h1>Panel de Administración</h1><p>Bienvenido, {$_SESSION['username']}!</p>";
        echo '<p><a href="/logout">Cerrar Sesión</a></p>';
        // Por ahora, solo un mensaje. Necesitaremos crear la vista admin/dashboard.php
        // y las demás vistas del admin.
    }

    /**
     * Muestra la lista de usuarios.
     */
    public function listUsuarios() {
        $usuarios = $this->usuarioModel->getAllUsuarios();

        $data = [
            'usuarios' => $usuarios,
            'titulo' => 'Gestión de Usuarios'
            // Puedes pasar mensajes de sesión aquí si los configuras después de CUD ops
            // 'mensaje_exito' => $_SESSION['mensaje_exito'] ?? null,
            // 'mensaje_error' => $_SESSION['mensaje_error'] ?? null,
        ];
        // Limpiar mensajes de sesión después de obtenerlos
        // unset($_SESSION['mensaje_exito'], $_SESSION['mensaje_error']);

        $this->view('admin/usuarios', $data);
    }

    // Aquí añadiríamos más métodos para:
    // - showCrearUsuarioForm()
    // - storeUsuario() (para procesar el form de creación)
    // - showEditarUsuarioForm($id)
    // - updateUsuario($id) (para procesar el form de edición)
    // - deleteUsuario($id)
    //
    // Y métodos similares para Postulantes, Evaluadores, Expertos.
    // La lógica vendría de los archivos legacy_*.php
}
?>
