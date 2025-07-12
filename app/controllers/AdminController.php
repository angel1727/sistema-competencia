<?php
// app/controllers/AdminController.php

class AdminController extends Controller {

    // protected $db; // La conexión a BD la maneja el Modelo base si es necesario directamente en Controller
    protected $usuarioModel;
    protected $postulanteModel;
    protected $evaluadorModel;
    protected $expertoModel;

    public function __construct() {
        parent::__construct();

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }

        // Cargar modelos necesarios
        $this->usuarioModel = $this->model('Usuario');
        $this->postulanteModel = $this->model('Postulante');
        $this->evaluadorModel = $this->model('Evaluador'); // Cargar EvaluadorModel
        $this->expertoModel = $this->model('Experto');   // Cargar ExpertoModel (lo crearemos después)


        // Verificar si los modelos se cargaron correctamente (opcional pero recomendado)
        if (!$this->usuarioModel || !$this->postulanteModel || !$this->evaluadorModel || !$this->expertoModel) {
            // Manejar el error, quizás redirigir o mostrar un mensaje
            // Podrías ser más específico sobre qué modelo falló.
            die('Error: No se pudo cargar uno o más modelos requeridos por AdminController.');
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

    // --- Métodos CRUD para Usuarios ---

    /**
     * Procesa la creación de un nuevo usuario.
     * Se llama vía POST desde el modal en la vista de usuarios.
     */
    public function storeUsuario() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitizar y recolectar datos (ejemplo básico)
            $nombre = filter_input(INPUT_POST, 'modal_nombre', FILTER_SANITIZE_STRING);
            $apellido = filter_input(INPUT_POST, 'modal_apellido', FILTER_SANITIZE_STRING);
            $username = filter_input(INPUT_POST, 'modal_usuario', FILTER_SANITIZE_STRING);
            $password = $_POST['modal_password']; // No sanitizar directamente, se hasheará
            $correo = filter_input(INPUT_POST, 'modal_correo', FILTER_SANITIZE_EMAIL);
            $cargo = filter_input(INPUT_POST, 'modal_cargo', FILTER_SANITIZE_STRING);
            $rol = filter_input(INPUT_POST, 'rol', FILTER_SANITIZE_STRING);

            // Validación (ejemplo básico)
            if (empty($nombre) || empty($apellido) || empty($username) || empty($password) || empty($correo) || empty($cargo) || empty($rol)) {
                $_SESSION['mensaje_crud_usuario'] = 'Todos los campos son requeridos.';
                $_SESSION['tipo_mensaje_crud_usuario'] = 'error';
                $this->redirect('/admin/usuarios');
                return;
            }

            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['mensaje_crud_usuario'] = 'Formato de correo inválido.';
                $_SESSION['tipo_mensaje_crud_usuario'] = 'error';
                $this->redirect('/admin/usuarios');
                return;
            }

            // Hashear contraseña
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $data = [
                'nombre' => $nombre,
                'apellido' => $apellido,
                'usuario' => $username,
                'password_hash' => $password_hash, // Pasar el hash al modelo
                'correo' => $correo,
                'cargo' => $cargo,
                'rol' => $rol
            ];

            if ($this->usuarioModel->crearUsuario($data)) {
                $_SESSION['mensaje_crud_usuario'] = 'Usuario creado exitosamente.';
                $_SESSION['tipo_mensaje_crud_usuario'] = 'success';
            } else {
                $_SESSION['mensaje_crud_usuario'] = 'Error al crear el usuario.';
                $_SESSION['tipo_mensaje_crud_usuario'] = 'error';
            }
            $this->redirect('/admin/usuarios');
        } else {
            $this->redirect('/admin/usuarios');
        }
    }

    /**
     * Procesa la actualización de un usuario existente.
     * Se llama vía POST desde el modal en la vista de usuarios.
     * El ID del usuario a actualizar estará en $_POST['idusuario'].
     */
    public function updateUsuario() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idusuario = filter_input(INPUT_POST, 'idusuario', FILTER_VALIDATE_INT);
            $nombre = filter_input(INPUT_POST, 'modal_nombre', FILTER_SANITIZE_STRING);
            $apellido = filter_input(INPUT_POST, 'modal_apellido', FILTER_SANITIZE_STRING);
            $username = filter_input(INPUT_POST, 'modal_usuario', FILTER_SANITIZE_STRING);
            $password = $_POST['modal_password']; // Se hashea solo si no está vacío
            $correo = filter_input(INPUT_POST, 'modal_correo', FILTER_SANITIZE_EMAIL);
            $cargo = filter_input(INPUT_POST, 'modal_cargo', FILTER_SANITIZE_STRING);
            $rol = filter_input(INPUT_POST, 'rol', FILTER_SANITIZE_STRING);

            if (!$idusuario) {
                $_SESSION['mensaje_crud_usuario'] = 'ID de usuario inválido.';
                $_SESSION['tipo_mensaje_crud_usuario'] = 'error';
                $this->redirect('/admin/usuarios');
                return;
            }

            // Validación (ejemplo básico)
            if (empty($nombre) || empty($apellido) || empty($username) || empty($correo) || empty($cargo) || empty($rol)) {
                $_SESSION['mensaje_crud_usuario'] = 'Todos los campos (excepto contraseña) son requeridos para actualizar.';
                $_SESSION['tipo_mensaje_crud_usuario'] = 'error';
                // Podríamos pasar los datos de vuelta a la vista para rellenar el form, pero es más complejo con modal.
                // Por ahora, solo redirigimos.
                $this->redirect('/admin/usuarios');
                return;
            }

            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['mensaje_crud_usuario'] = 'Formato de correo inválido.';
                $_SESSION['tipo_mensaje_crud_usuario'] = 'error';
                $this->redirect('/admin/usuarios');
                return;
            }

            $data = [
                'nombre' => $nombre,
                'apellido' => $apellido,
                'usuario' => $username,
                'correo' => $correo,
                'cargo' => $cargo,
                'rol' => $rol
            ];

            // Si se proporcionó una nueva contraseña, hashearla y añadirla a $data
            if (!empty($password)) {
                $data['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
            }

            if ($this->usuarioModel->actualizarUsuario($idusuario, $data)) {
                $_SESSION['mensaje_crud_usuario'] = 'Usuario actualizado exitosamente.';
                $_SESSION['tipo_mensaje_crud_usuario'] = 'success';
            } else {
                $_SESSION['mensaje_crud_usuario'] = 'Error al actualizar el usuario.';
                $_SESSION['tipo_mensaje_crud_usuario'] = 'error';
            }
            $this->redirect('/admin/usuarios');

        } else {
            $this->redirect('/admin/usuarios');
        }
    }

    /**
     * Procesa la eliminación de un usuario.
     * Se llama vía POST desde el formulario en la tabla de usuarios.
     * El ID del usuario a eliminar estará en $_POST['idusuario'].
     */
    public function deleteUsuario() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idusuario = filter_input(INPUT_POST, 'idusuario', FILTER_VALIDATE_INT);

            if (!$idusuario) {
                $_SESSION['mensaje_crud_usuario'] = 'ID de usuario inválido para eliminar.';
                $_SESSION['tipo_mensaje_crud_usuario'] = 'error';
                $this->redirect('/admin/usuarios');
                return;
            }

            if ($this->usuarioModel->eliminarUsuario($idusuario)) {
                $_SESSION['mensaje_crud_usuario'] = 'Usuario eliminado exitosamente.';
                $_SESSION['tipo_mensaje_crud_usuario'] = 'success';
            } else {
                $_SESSION['mensaje_crud_usuario'] = 'Error al eliminar el usuario.';
                $_SESSION['tipo_mensaje_crud_usuario'] = 'error';
            }
            $this->redirect('/admin/usuarios');
        } else {
            $this->redirect('/admin/usuarios');
        }
    }

    // --- Métodos para Postulantes ---
    public function listPostulantes() {
        // Lógica para cargar el modelo de Postulante y obtener datos
        // $postulantes = $this->postulanteModel->getAll();
        // $this->view('admin/postulantes', ['postulantes' => $postulantes, 'titulo' => 'Gestión de Postulantes']);
        $this->view('admin/postulantes', ['titulo' => 'Gestión de Postulantes', 'postulantes' => []]);
    }

    // --- Métodos para Evaluadores ---
    public function listEvaluadores() {
        if (!$this->evaluadorModel) {
             die('Error: Modelo de Evaluador no cargado.');
        }
        // $evaluadores = $this->evaluadorModel->getAllEvaluadores(); // Cuando el método exista y la tabla esté poblada

        // Datos hardcodeados para simular lo que la vista espera
        $evaluadores_hardcoded_ejemplo = [
           ['id_evaluador' => 1, 'nombre' => 'María Rodríguez', 'especialidad' => 'Laboratorio de Ensayo', 'norma' => 'ISO/IEC 17025', 'organismo' => 'ICONTEC', 'correo' => 'mrodriguez@email.com', 'data_iso' => '17025E', 'data_ciudad' => 'Bogotá', 'data_pais' => 'Colombia', 'data_lat' => "4.710989", 'data_lng' => "-74.072092"],
           ['id_evaluador' => 2, 'nombre' => 'Carlos Gómez', 'especialidad' => 'Certificación de Personas', 'norma' => 'ISO/IEC 17024', 'organismo' => 'ONAC', 'correo' => 'cgomez@email.com', 'data_iso' => '17024', 'data_ciudad' => 'Medellín', 'data_pais' => 'Colombia', 'data_lat' => "6.244203", 'data_lng' => "-75.581211"],
           ['id_evaluador' => 3, 'nombre' => 'Ana Torres', 'especialidad' => 'Organismo de Inspección', 'norma' => 'ISO/IEC 17020', 'organismo' => 'SGS Colombia', 'correo' => 'atorres@email.com', 'data_iso' => '17020', 'data_ciudad' => 'Cali', 'data_pais' => 'Colombia', 'data_lat' => "3.451647", 'data_lng' => "-76.531982"],
           ['id_evaluador' => 4, 'nombre' => 'Jorge Díaz', 'especialidad' => 'Certificación de Productos', 'norma' => 'ISO/IEC 17065', 'organismo' => 'Bureau Veritas', 'correo' => 'jdiaz@email.com', 'data_iso' => '17065', 'data_ciudad' => 'Barranquilla', 'data_pais' => 'Colombia', 'data_lat' => "10.963889", 'data_lng' => "-74.796387"],
        ];

        $data = [
            'evaluadores' => $evaluadores_hardcoded_ejemplo, // Cambiar a $evaluadores cuando el modelo esté listo
            'titulo' => 'Gestión de Líderes Evaluadores'
        ];
        $this->view('admin/evaluadores', $data);
    }

    // --- Métodos para Expertos ---
    public function listExpertos() {
        if (!$this->expertoModel) {
             die('Error: Modelo de Experto no cargado.');
        }
        // $expertos = $this->expertoModel->getAllExpertos(); // Cuando el método y la tabla existan

        // Datos hardcodeados para simular lo que la vista espera
        $expertos_hardcoded_ejemplo = [
             ['id_experto' => 1, 'nombre' => 'Laura Sofía Peña (Experta)', 'especialidad' => 'Análisis Químico', 'norma' => 'ISO/IEC 17025', 'organismo' => 'LabCert', 'correo' => 'laura.experta@email.com', 'data_iso' => '17025E'],
             ['id_experto' => 2, 'nombre' => 'Juan David Restrepo (Experto)', 'especialidad' => 'Sistemas de Gestión de Calidad', 'norma' => 'ISO 9001', 'organismo' => 'QualityConsult', 'correo' => 'juan.experto@email.com', 'data_iso' => '9001'],
        ];

        $data = [
            'expertos' => $expertos_hardcoded_ejemplo, // Cambiar a $expertos cuando el modelo esté listo
            'titulo' => 'Gestión de Expertos Técnicos'
        ];
        $this->view('admin/expertos', $data);
    }

    // Y métodos similares para Postulantes, Evaluadores, Expertos (CRUD).
    // La lógica vendría de los archivos legacy_*.php
}
?>
