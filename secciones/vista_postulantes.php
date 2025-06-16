<?php include '../templades/cabecera.php'; ?>

 <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Lista de Postulantes</h5>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregar">Agregar Postulante</button>
    </div>
    <div class="card-body">
      <table class="table table-bordered table-striped">
        <thead class="table-light">
          <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>CI</th>
            <th>Ciudad</th>
            <th>Email</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <!-- Ejemplo de fila -->
          <tr>
            <td>Juan</td>
            <td>Pérez</td>
            <td>1234567</td>
            <td>La Paz</td>
            <td>juan@email.com</td>
            <td>
              <button class="btn btn-sm btn-warning">Editar</button>
              <button class="btn btn-sm btn-danger">Eliminar</button>
            </td>
          </tr>
          <!-- Aquí se añadirán más filas dinámicamente -->
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Agregar Postulante -->
  <div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="modalAgregarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form id="formPostulante">
          <div class="modal-header">
            <h5 class="modal-title" id="modalAgregarLabel">Agregar Postulante</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body row g-3">

            <!-- Campos del formulario -->
            <div class="col-md-6">
              <label class="form-label">Nombre</label>
              <input type="text" class="form-control" name="nombre" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Apellido</label>
              <input type="text" class="form-control" name="apellido" required>
            </div>

            <div class="col-md-4">
              <label class="form-label">CI</label>
              <input type="text" class="form-control" name="ci" required>
            </div>

            <div class="col-md-4">
              <label class="form-label">Ciudad</label>
              <input type="text" class="form-control" name="ciudad">
            </div>

            <div class="col-md-4">
              <label class="form-label">Dirección</label>
              <input type="text" class="form-control" name="direccion">
            </div>

            <div class="col-md-4">
              <label class="form-label">Nacionalidad</label>
              <input type="text" class="form-control" name="nacionalidad">
            </div>

            <div class="col-md-4">
              <label class="form-label">Teléfono Móvil</label>
              <input type="text" class="form-control" name="telefono_movil">
            </div>

            <div class="col-md-4">
              <label class="form-label">Teléfono Fijo</label>
              <input type="text" class="form-control" name="telefono_fijo">
            </div>

            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email">
            </div>

            <div class="col-md-6">
              <label class="form-label">NIT</label>
              <input type="text" class="form-control" name="nit">
            </div>

            <div class="col-md-6">
              <label class="form-label">Registro SIGEP</label>
              <input type="text" class="form-control" name="registro_sigep">
            </div>

            <div class="col-md-6">
              <label class="form-label">Matrícula de Comercio</label>
              <input type="text" class="form-control" name="matricula_comercio">
            </div>

            <div class="col-md-6">
              <label class="form-label">Seguro de Salud</label>
              <input type="text" class="form-control" name="seguro_salud">
            </div>

            <div class="col-md-6">
              <label class="form-label">Seguro de Riesgo</label>
              <input type="text" class="form-control" name="seguro_riesgo">
            </div>

            <div class="col-md-6">
              <label class="form-label">Fecha de Registro</label>
              <input type="date" class="form-control" name="fecha_registro">
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar Postulante</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="p-4 bg-light">
    <div class="container">
        <h2 class="mb-4">Dashboard de Postulantes</h2>

        <div class="card">
        <div class="card-header">
            Distribución de Postulantes por Rol
        </div>
        <div class="card-body">
            <canvas id="postulantesChart" height="100"></canvas>
        </div>
        </div>
    </div>

    <script>
        // Datos de ejemplo (puedes obtenerlos dinámicamente con PHP o JS)
        const data = {
        labels: ['Líderes', 'Evaluadores Técnicos', 'Ambos'],
        datasets: [{
            label: 'Cantidad de Postulantes',
            data: [12, 18, 7], // <- Puedes modificar esto con datos reales
            backgroundColor: [
            'rgba(54, 162, 235, 0.6)',   // azul
            'rgba(255, 206, 86, 0.6)',   // amarillo
            'rgba(75, 192, 192, 0.6)'    // verde azulado
            ],
            borderColor: [
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
        };

        // Configuración de la gráfica
        const config = {
        type: 'bar', // Puedes cambiar a 'pie', 'doughnut', 'line'
        data: data,
        options: {
            responsive: true,
            scales: {
            y: {
                beginAtZero: true,
                title: {
                display: true,
                text: 'Cantidad'
                }
            }
            }
        }
        };

        // Inicializar la gráfica
        const postulantesChart = new Chart(
        document.getElementById('postulantesChart'),
        config
        );
    </script>


  </div>

<?php include '../templades/pie.php'; ?>