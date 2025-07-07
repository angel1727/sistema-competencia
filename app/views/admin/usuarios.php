<?php
// Este archivo ahora es una vista cargada por AdminController@listUsuarios
// La variable $usuarios (antes $listaUsuarios) y $titulo son pasadas por el controlador.
// Los mensajes de sesión también deberían ser pasados por el controlador si se quieren mostrar aquí.

// Incluir cabecera y pie directamente. Asegúrate que las rutas sean correctas desde la ubicación de este archivo.
// O mejor aún, que el layout principal sea manejado por el Controller base o una clase de Vista.
// Por ahora, incluimos directamente con rutas relativas ajustadas.
require_once __DIR__ . '/../templates/cabecera_admin.php';
?>

<?php
// Mostrar mensajes de sesión (si se pasan desde el controlador)
// Ejemplo: if (isset($data['mensaje_exito'])):
if (isset($_SESSION['mensaje_crud_usuario'])): // Usaremos una variable de sesión específica
?>
<script>
Swal.fire({
    icon: '<?= $_SESSION['tipo_mensaje_crud_usuario'] ?? 'info' ?>', // 'success', 'error', 'warning'
    title: '<?= $_SESSION['mensaje_crud_usuario'] ?>',
    showConfirmButton: false,
    timer: 2500
});
</script>
<?php unset($_SESSION['mensaje_crud_usuario'], $_SESSION['tipo_mensaje_crud_usuario']); endif; ?>

<div class="container mt-4"> <!-- Añadido container para mejor espaciado -->
    <h2><?= htmlspecialchars($titulo ?? 'Gestión de Usuarios') ?></h2> <!-- Título pasado por el controlador -->

    <div class="row g-4 mt-3">
        <!-- Panel de Usuario con botón para abrir modal -->
  <div class="col-md-4">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-orange text-white fw-bold text-center">
        PANEL DE USUARIO
      </div>
      <div class="card-body">
        <p class="text-muted text-center">Haz clic en el botón para agregar un nuevo usuario.</p>
        <div class="text-center mt-4">
          <!-- Botón para abrir modal de creación. La acción del form del modal se ajustará con JS o a una ruta de creación. -->
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#usuarioModal" onclick="prepararModalParaCrear()">
            <i class="bi bi-person-plus-fill me-1"></i> Agregar Usuario
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabla de Usuarios -->
  <div class="col-md-8">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-secondary text-white fw-bold text-center">
        Lista de Usuarios
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table id="tablaUsuarios" class="table table-striped table-hover display nowrap" style="width:100%">
            <thead class="table-light">
              <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Usuario</th>
                <!-- No mostramos contraseña -->
                <th>Correo</th>
                <th>Cargo</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
                <?php if (!empty($usuarios)): ?>
                    <?php foreach ($usuarios as $usuario_item): ?>
                    <tr>
                    <td><?= htmlspecialchars($usuario_item['nombre']) ?></td>
                    <td><?= htmlspecialchars($usuario_item['apellido']) ?></td>
                    <td><?= htmlspecialchars($usuario_item['usuario']) ?></td>
                    <td><?= htmlspecialchars($usuario_item['correo']) ?></td>
                    <td><?= htmlspecialchars($usuario_item['cargo']) ?></td>
                <td>
                    <!-- Botón editar -->
                    <button
                    class="btn btn-sm btn-warning"
                    data-bs-toggle="modal"
                    data-bs-target="#usuarioModal"
                    onclick="cargarUsuario('<?= $usuario_item['idusuario'] ?>', '<?= htmlspecialchars(addslashes($usuario_item['nombre'])) ?>', '<?= htmlspecialchars(addslashes($usuario_item['apellido'])) ?>', '<?= htmlspecialchars(addslashes($usuario_item['usuario'])) ?>', '', '<?= htmlspecialchars(addslashes($usuario_item['correo'])) ?>', '<?= htmlspecialchars(addslashes($usuario_item['cargo'])) ?>', '<?= htmlspecialchars(addslashes($usuario_item['rol'])) ?>')"
                    >
                    <i class="bi bi-pencil-fill"></i>
                    </button>

                    <!-- Formulario oculto para eliminar -->
                    <!-- La acción apuntará a la ruta de eliminación, el idusuario se envía en el form -->
                    <form action="/admin/usuarios/delete" method="post" class="d-inline form-eliminar">
                        <input type="hidden" name="idusuario" value="<?= $usuario_item['idusuario'] ?>">
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </form>
                </td>
                </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" class="text-center">No hay usuarios registrados.</td></tr>
                <?php endif; ?>
            </tbody>

          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal para agregar usuario -->
<div class="modal fade" id="usuarioModal" tabindex="-1" aria-labelledby="usuarioModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg">
      <div class="modal-header bg-orange text-white">
        <h5 class="modal-title" id="usuarioModalLabel">Agregar Usuario</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <!-- El action se establecerá dinámicamente con JavaScript -->
      <form id="formUsuarioModal" action="" method="post">
        <input type="hidden" name="idusuario" id="modal_idusuario">
        <!-- Ya no se necesita 'accion', la ruta determinará la acción -->
        <div class="modal-body">
          <div class="mb-3">
            <label for="modal_nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="modal_nombre" id="modal_nombre" required>
          </div>
          <div class="mb-3">
            <label for="modal_apellido" class="form-label">Apellidos</label>
            <input type="text" class="form-control" name="modal_apellido" id="modal_apellido" required>
          </div>
          <div class="mb-3">
            <label for="modal_usuario" class="form-label">Usuario</label>
            <input type="text" class="form-control" name="modal_usuario" id="modal_usuario" required>
          </div>
          <div class="mb-3">
            <label for="modal_password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="modal_password" id="modal_password">
            <small id="passwordHelp" class="form-text text-muted">Dejar en blanco si no desea cambiar la contraseña al editar.</small>
          </div>
          <div class="mb-3">
            <label for="modal_correo" class="form-label">Correo</label>
            <input type="email" class="form-control" name="modal_correo" id="modal_correo" required>
          </div>
          <div class="mb-3">
            <label for="modal_cargo" class="form-label">Cargo</label>
            <input type="text" class="form-control" name="modal_cargo" id="modal_cargo" required>
          </div>  

          <!-- ✅ Checkboxes agregados -->
          <div class="mb-3">
              <label class="form-label">Permisos de Usuario:</label><br>

              <div class="form-check">
                <!-- Ajustar 'name="rol[]"' si se permiten múltiples roles o un solo input tipo radio/select si es un solo rol -->
                <input class="form-check-input" type="radio" name="rol" value="administrador" id="rol_administrador" required>
                <label class="form-check-label" for="rol_administrador">Administrador</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="rol" value="subadministrador" id="rol_subadministrador" required>
                <label class="form-check-label" for="rol_subadministrador">Subadministrador</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="rol" value="usuario" id="rol_usuario" required checked> <!-- Rol por defecto -->
                <label class="form-check-label" for="rol_usuario">Usuario</label>
              </div>
            </div>
          </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary" id="btnGuardar">
            <i class="bi bi-save2-fill me-1"></i> Guardar
          </button>
        </div>
      </form>

    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Selecciona todos los formularios de eliminar
    document.querySelectorAll('form.d-inline').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Evita el envío inmediato
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción no se puede deshacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Envía el formulario si confirma
                }
            });
        });
    });
});
</script>

<?php require_once __DIR__ . '/../templates/pie_admin.php'; ?>