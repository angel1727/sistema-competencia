<?php include '../templades/cabecera.php'; ?>
<?php include '../secciones/usuario.php'; ?>

<div class="row g-4">
  <!-- Panel de Usuario con botón para abrir modal -->
  <div class="col-md-4">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-primary text-white fw-bold text-center">
        PANEL DE USUARIO
      </div>
      <div class="card-body">
        <p class="text-muted text-center">Haz clic en el botón para agregar un nuevo usuario.</p>
        <div class="text-center mt-4">
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#usuarioModal">
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
          <table class="table table-striped table-hover m-0">
            <thead class="table-light">
              <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Usuario</th>
                <th>Contraseña</th>
                <th>Correo</th>
                <th>Cargo</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ($listaUsuarios as $usuario): ?>
                <tr>
                <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                <td><?= htmlspecialchars($usuario['apellidos']) ?></td>
                <td><?= htmlspecialchars($usuario['usuario']) ?></td>
                <td>••••••</td>
                <td><?= htmlspecialchars($usuario['correo']) ?></td>
                <td><?= htmlspecialchars($usuario['cargo']) ?></td>
                <td>
                    <!-- Botón editar -->
                    <button
                    class="btn btn-sm btn-warning"
                    data-bs-toggle="modal"
                    data-bs-target="#usuarioModal"
                    onclick="cargarUsuario('<?= $usuario['idusuario'] ?>', '<?= $usuario['nombre'] ?>', '<?= $usuario['apellidos'] ?>', '<?= $usuario['usuario'] ?>', '<?= $usuario['password'] ?>', '<?= $usuario['correo'] ?>', '<?= $usuario['cargo'] ?>')"
                    >
                    <i class="bi bi-pencil-fill"></i>
                    </button>

                    <!-- Formulario oculto para eliminar -->
                    <form method="post" class="d-inline">
                    <input type="hidden" name="accion" value="eliminar">
                    <input type="hidden" name="id" value="<?= $usuario['idusuario'] ?>">
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                    </form>
                </td>
                </tr>
                <?php endforeach; ?>
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
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="usuarioModalLabel">Agregar Usuario</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <form action="" method="post" input type="hidden" name="id" id="modal_id">
        <div class="modal-body">
          <div class="mb-3">
            <label for="modal_nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="modal_nombre" id="modal_nombre" required>
          </div>
          <div class="mb-3">
            <label for="modal_apellido" class="form-label">Apellidos</label>
            <input type="text" class="form-control" name="modal_apellidos" id="modal_apellidos" required>
          </div>
          <div class="mb-3">
            <label for="modal_usuario" class="form-label">Usuario</label>
            <input type="text" class="form-control" name="modal_usuario" id="modal_usuario" required>
          </div>
          <div class="mb-3">
            <label for="modal_password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="modal_password" id="modal_password" required>
          </div>
          <div class="mb-3">
            <label for="modal_correo" class="form-label">Correo</label>
            <input type="email" class="form-control" name="modal_correo" id="modal_correo" required>
          </div>
          <div class="mb-3">
            <label for="modal_cargo" class="form-label">Cargo</label>
            <input type="text" class="form-control" name="modal_cargo" id="modal_cargo" required>
          </div>  
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" name="accion" value="guardar_modal" class="btn btn-primary" id="btnGuardar">
            <i class="bi bi-save2-fill me-1"></i> Guardar
        </button>

        </div>
      </form>
    </div>
  </div>
</div>




<?php include '../templades/pie.php'; ?>