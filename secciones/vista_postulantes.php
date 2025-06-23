<?php include '../secciones/postulantes.php'; ?>
<?php include '../templades/cabecera.php'; ?>

<div class="row g-4">
  <!-- Panel lateral de acciones -->
  <div class="col-md-4">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-orange text-white fw-bold text-center">
        Panel de Control
      </div>
      <div class="card-body text-center">
        <button class="btn btn-success w-100 mb-2" data-bs-toggle="modal" data-bs-target="#modalAgregar">
          <i class="bi bi-person-plus-fill me-1"></i> Agregar
        </button>
        <button id="btnEditar" class="btn btn-warning w-100 mb-2" disabled>
          <i class="bi bi-pencil-fill me-1"></i> Editar
        </button>
        <button id="btnEliminar" class="btn btn-danger w-100" disabled>
          <i class="bi bi-trash-fill me-1"></i> Eliminar
        </button>
      </div>
    </div>
  </div>

  <!-- Sección principal de tarjetas -->
  <div class="col-md-8">
    <div class="card-body" style="max-height: 80vh; overflow-y: auto;">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-secondary text-white fw-bold text-center">
          Lista de Postulantes
        </div>
        <div class="card-body">
          <!-- Buscador -->
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input type="text" id="buscadorPostulante" class="form-control" placeholder="Buscar por nombre, ciudad o rol">
          </div>

          <!-- Tarjetas de postulantes -->
          <form id="formPostulantes" method="post">
            <input type="hidden" name="accion" value="eliminar_multiple">
            <div class="row" id="postulantesList">
              <?php if (!empty($postulantes)): ?>
                <?php foreach ($postulantes as $postulante): ?>
                  <div class="col-12 col-sm-6 col-lg-6 mb-4">
                    <div class="card h-100 shadow-sm card-selectable position-relative"
                        data-postulante='<?= json_encode($postulante) ?>'
                        data-id="<?= $postulante['idpostulante'] ?>">
                      <div class="form-check position-absolute top-0 end-0 m-2">
                        <input class="form-check-input seleccionPostulante" type="checkbox" name="ids[]" value="<?= $postulante['idpostulante'] ?>">
                      </div>
                      
                      <!-- SCROLL dentro del card-body -->
                      <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                        <h5 class="card-title"><?= $postulante['nombre'] . ' ' . $postulante['apellido'] ?></h5>
                        <p class="card-text"><strong>CI:</strong> <?= $postulante['ci'] ?></p>
                        <p class="card-text"><strong>Ciudad:</strong> <?= $postulante['ciudad'] ?></p>
                        <p class="card-text"><strong>Dirección:</strong> <?= $postulante['direccion'] ?></p>
                        <p class="card-text"><strong>Tel. Móvil:</strong> <?= $postulante['celular'] ?></p>
                        <p class="card-text"><strong>Tel. Fijo:</strong> <?= $postulante['telefono'] ?></p>
                        <p class="card-text"><strong>NIT:</strong> <?= $postulante['nit'] ?></p>
                        <p class="card-text"><strong>Registro SIGEP:</strong> <?= $postulante['sigep'] ?></p>
                        <p class="card-text"><strong>Matrícula Comercio:</strong> <?= $postulante['matricula'] ?></p>
                        <p class="card-text"><strong>Seguro Salud:</strong> <?= $postulante['seguro'] ?></p>
                        <p class="card-text"><strong>Seguro Riesgo:</strong> <?= $postulante['sriesgos'] ?></p>
                        <p class="card-text"><strong>Fecha Registro:</strong> <?= $postulante['fecha_registro'] ?></p>
                      </div>
                    </div>
                  </div>

                <?php endforeach; ?>
              <?php else: ?>
                <div class="col-12 text-center">
                  <p>No hay postulantes registrados.</p>
                </div>
              <?php endif; ?>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Script para manejar la selección -->
<script>
  const cards = document.querySelectorAll('.card-selectable');
  const btnEditar = document.getElementById('btnEditar');
  const btnEliminar = document.getElementById('btnEliminar');

  let selectedCard = null;

  cards.forEach(card => {
    card.addEventListener('click', () => {
      // Remover selección anterior
      cards.forEach(c => c.classList.remove('border-primary', 'border-3'));
      
      // Marcar nueva selección
      card.classList.add('border-primary', 'border-3');
      selectedCard = card;

      // Activar botones
      btnEditar.disabled = false;
      btnEliminar.disabled = false;
    });
  });

  btnEditar.addEventListener('click', () => {
    if (selectedCard) {
      const data = JSON.parse(selectedCard.dataset.postulante);
      const modal = new bootstrap.Modal(document.getElementById('modalAgregar'));
      // Aquí puedes cargar datos al modal, ejemplo:
      document.querySelector('#modalAgregar input[name="nombre"]').value = data.nombre;
      // ...
      modal.show();
    }
  });

  btnEliminar.addEventListener('click', () => {
    if (selectedCard) {
      const id = selectedCard.dataset.id;

      Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción eliminará el postulante.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar'
      }).then((result) => {
        if (result.isConfirmed) {
          const form = document.createElement('form');
          form.method = 'post';
          form.innerHTML = `
            <input type="hidden" name="accion" value="eliminar">
            <input type="hidden" name="id" value="${id}">
          `;
          document.body.appendChild(form);
          form.submit();
        }
      });
    }
  });
</script>












































  
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