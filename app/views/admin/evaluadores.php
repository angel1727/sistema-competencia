<?php
// Vista cargada por AdminController@listEvaluadores
// Variables disponibles: $evaluadores, $titulo
require_once __DIR__ . '/../templates/cabecera_admin.php';
?>

<div class="container my-5">
    <h2><?= htmlspecialchars($titulo ?? 'Gestión de Líderes Evaluadores') ?></h2>

    <!-- Sección de Dashboard -->
  <div class="row mb-4">
    <!-- Tarjeta de Resumen -->
    <div class="col-md-4 mb-3">
      <div class="card h-100 shadow-sm border-0">
        <div class="card-header bg-primary text-white">
          <i class="bi bi-people-fill me-2"></i>Resumen de Evaluadores
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">Total Evaluadores</h5>
            <span class="badge bg-primary rounded-pill fs-5" id="totalEvaluadores"><?= count($evaluadores ?? []) ?></span>
          </div>
          <div class="progress mb-3" style="height: 10px;">
            <div class="progress-bar bg-success" role="progressbar" style="width: 25%"></div>
            <div class="progress-bar bg-info" role="progressbar" style="width: 25%"></div>
            <div class="progress-bar bg-warning" role="progressbar" style="width: 25%"></div>
            <div class="progress-bar bg-danger" role="progressbar" style="width: 25%"></div>
          </div>
          <div class="row">
            <div class="col-6 mb-2">
              <div class="d-flex align-items-center">
                <span class="badge bg-success me-2">&nbsp;</span>
                <small>17025</small>
              </div>
            </div>
            <div class="col-6 mb-2">
              <div class="d-flex align-items-center">
                <span class="badge bg-info me-2">&nbsp;</span>
                <small>17024</small>
              </div>
            </div>
            <div class="col-6 mb-2">
              <div class="d-flex align-items-center">
                <span class="badge bg-warning me-2">&nbsp;</span>
                <small>17020</small>
              </div>
            </div>
            <div class="col-6 mb-2">
              <div class="d-flex align-items-center">
                <span class="badge bg-danger me-2">&nbsp;</span>
                <small>17065</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Mapa de Ubicación -->
    <div class="col-md-4 mb-3">
      <div class="card h-100 shadow-sm border-0">
        <div class="card-header bg-primary text-white">
          <i class="bi bi-geo-alt-fill me-2"></i>Ubicación de Evaluadores
        </div>
        <div class="card-body p-0">
          <div id="mapaEvaluadores" style="height: 100%; min-height: 250px; background-color: #e9ecef; display: flex; align-items: center; justify-content: center;">
            <p class="text-muted"><?= empty($evaluadores) ? "No hay datos para mostrar en el mapa." : "Cargando mapa..." ?></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Gráfico de Experticias -->
    <div class="col-md-4 mb-3">
      <div class="card h-100 shadow-sm border-0">
        <div class="card-header bg-primary text-white">
          <i class="bi bi-bar-chart-fill me-2"></i>Distribución por Norma
        </div>
        <div class="card-body">
          <?php if (!empty($evaluadores)): ?>
            <canvas id="graficoExperticias" height="220"></canvas>
          <?php else: ?>
            <p class="text-center text-muted">No hay datos para el gráfico.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Panel de Búsqueda -->
  <div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white text-center fw-bold">
      Panel de Búsqueda - Lideres Evaluadores
    </div>
    <div class="card-body">
      <!-- Buscador de normas múltiples -->
      <div class="mb-4">
        <label for="filtroIso" class="form-label fw-semibold">Filtrar por norma ISO:</label>
        <select id="filtroIso" class="form-select" multiple>
          <option value="17025E">Laboratorio de ensayo ISO/IEC 17025</option>
          <option value="17025C">Laboratorio de calibración ISO/IEC 17025</option>
          <option value="15189">Laboratorio clínico ISO 15189</option>
          <option value="17043-1">Proveedor de Ensayos de Aptitud ISO/IEC 17043</option>
          <option value="17020">Organismo de inspección ISO/IEC 17020</option>
          <option value="17065">Certificación de Productos ISO/IEC 17065</option>
          <option value="17021-1">Certificación de Sistemas de Gestión ISO/IEC 17021-1</option>
          <option value="17024">Certificación de Personas ISO/IEC 17024</option>
          <option value="17034">Materiales de Referencia ISO 17034</option>
        </select>
        <small class="text-muted">Usa Ctrl (Windows) o Cmd (Mac) para seleccionar varias normas.</small>
      </div>

      <!-- Tabla de expertos -->
      <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
          <thead class="table-light text-center">
            <tr>
              <th>Nombre</th>
              <th>Especialidad</th>
              <th>Norma</th>
              <th>Organismo</th>
              <th>Correo</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody id="tablaExpertos">
            <?php if (!empty($evaluadores)): ?>
                <?php foreach ($evaluadores as $evaluador): ?>
                <tr data-iso="<?= htmlspecialchars($evaluador['data_iso'] ?? '') ?>"
                    data-ciudad="<?= htmlspecialchars($evaluador['data_ciudad'] ?? '') ?>"
                    data-pais="<?= htmlspecialchars($evaluador['data_pais'] ?? '') ?>"
                    data-lat="<?= htmlspecialchars($evaluador['data_lat'] ?? '') ?>"
                    data-lng="<?= htmlspecialchars($evaluador['data_lng'] ?? '') ?>">
                <td><?= htmlspecialchars($evaluador['nombre'] ?? 'N/A') ?></td>
                <td><?= htmlspecialchars($evaluador['especialidad'] ?? 'N/A') ?></td>
                <td><?= htmlspecialchars($evaluador['norma'] ?? 'N/A') ?></td>
                <td><?= htmlspecialchars($evaluador['organismo'] ?? 'N/A') ?></td>
                <td><?= htmlspecialchars($evaluador['correo'] ?? 'N/A') ?></td>
                <td class="text-center">
                    <!-- TODO: Cambiar href a rutas MVC para descargar PDF/Word -->
                    <a href="#" class="btn btn-sm btn-danger me-1" title="Descargar PDF">
                    <i class="bi bi-file-earmark-pdf-fill"></i> PDF
                    </a>
                    <a href="#" class="btn btn-sm btn-primary" title="Descargar Word">
                    <i class="bi bi-file-earmark-word-fill"></i> Word
                    </a>
                </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6" class="text-center">No hay evaluadores para mostrar.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Scripts para el dashboard interactivo -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- TODO: Reemplazar TU_API_KEY con tu clave de API de Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&callback=initMap" async defer></script>
<script>
  // Datos para el gráfico (se podrían pasar desde el controlador también)
  const evaluadoresData = <?= json_encode($evaluadores ?? []) ?>;

  document.addEventListener('DOMContentLoaded', function() {
    // Inicializar gráfico de experticias
    const normas = {};
    evaluadoresData.forEach(e => {
        if(e.norma) normas[e.norma] = (normas[e.norma] || 0) + 1;
    });

    const ctx = document.getElementById('graficoExperticias');
    if (ctx && evaluadoresData.length > 0) {
        new Chart(ctx.getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: Object.keys(normas),
            datasets: [{
            data: Object.values(normas),
          backgroundColor: [
            '#28a745', // verde
            '#17a2b8', // azul claro
            '#ffc107', // amarillo
            '#dc3545'  // rojo
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom',
          }
        }
      }
        });
    }

    // Filtro de normas (se mantiene, pero ahora opera sobre los datos cargados dinámicamente)
    const filtroIsoSelect = document.getElementById('filtroIso');
    if (filtroIsoSelect) {
        filtroIsoSelect.addEventListener('change', function() {
            const selectedValues = Array.from(this.selectedOptions).map(option => option.value);
            const rows = document.querySelectorAll('#tablaExpertos tr');
            let visibleRows = 0;

            rows.forEach(row => {
            if (selectedValues.length === 0 || selectedValues.includes(row.dataset.iso)) {
                row.style.display = '';
                visibleRows++;
            } else {
                row.style.display = 'none';
            }
            });

            const totalEvaluadoresSpan = document.getElementById('totalEvaluadores');
            if (totalEvaluadoresSpan) {
                totalEvaluadoresSpan.textContent = visibleRows;
            }
        });
    }
});

// Inicializar mapa
function initMap() {
    const mapaDiv = document.getElementById('mapaEvaluadores');
    if (!mapaDiv || typeof google === 'undefined' || typeof google.maps === 'undefined') {
        if(mapaDiv) mapaDiv.innerHTML = '<p class="text-muted text-center">No se pudo cargar Google Maps. Verifica la API Key.</p>';
        console.error("Google Maps API no cargada.");
        return;
    }

    const colombia = { lat: 4.5709, lng: -74.2973 }; // Centro por defecto
    const map = new google.maps.Map(mapaDiv, {
      zoom: 5,
      center: colombia
    });

    let bounds = new google.maps.LatLngBounds();
    let markersExist = false;

    evaluadoresData.forEach(evaluador => {
      if (evaluador.data_lat && evaluador.data_lng) {
        const lat = parseFloat(evaluador.data_lat);
        const lng = parseFloat(evaluador.data_lng);
        if (!isNaN(lat) && !isNaN(lng)) {
            const marker = new google.maps.Marker({
            position: { lat: lat, lng: lng },
            map: map,
            title: (evaluador.nombre || 'Evaluador') + ' - ' + (evaluador.norma || 'N/A')
            });
            bounds.extend(marker.getPosition());
            markersExist = true;
        }
      }
    });

    if (markersExist) {
        map.fitBounds(bounds);
    } else if (mapaDiv.querySelector('p.text-muted')) { // Si no hay marcadores y el mensaje de "cargando" está.
         mapaDiv.querySelector('p.text-muted').textContent = 'No hay datos de ubicación para mostrar.';
    }
  }
</script>

<?php require_once __DIR__ . '/../templates/pie_admin.php'; ?>