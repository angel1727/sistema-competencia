<?php include '../templades/cabecera.php'; ?>

<div class="container my-5">
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
            <span class="badge bg-primary rounded-pill fs-5" id="totalEvaluadores">4</span>
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
            <p class="text-muted">Cargando mapa...</p>
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
          <canvas id="graficoExperticias" height="220"></canvas>
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
            <tr data-iso="17025E" data-ciudad="Bogotá" data-pais="Colombia" data-lat="4.710989" data-lng="-74.072092">
              <td>María Rodríguez</td>
              <td>Laboratorio de Ensayo</td>
              <td>ISO/IEC 17025</td>
              <td>ICONTEC</td>
              <td>mrodriguez@email.com</td>
              <td class="text-center">
                <a href="descargar.php?tipo=pdf&id=1" class="btn btn-sm btn-danger me-1">
                  <i class="bi bi-file-earmark-pdf-fill"></i> PDF
                </a>
                <a href="descargar.php?tipo=word&id=1" class="btn btn-sm btn-primary">
                  <i class="bi bi-file-earmark-word-fill"></i> Word
                </a>
              </td>
            </tr>
            <tr data-iso="17024" data-ciudad="Medellín" data-pais="Colombia" data-lat="6.244203" data-lng="-75.581211">
              <td>Carlos Gómez</td>
              <td>Certificación de Personas</td>
              <td>ISO/IEC 17024</td>
              <td>ONAC</td>
              <td>cgomez@email.com</td>
              <td class="text-center">
                <a href="descargar.php?tipo=pdf&id=2" class="btn btn-sm btn-danger me-1">
                  <i class="bi bi-file-earmark-pdf-fill"></i> PDF
                </a>
                <a href="descargar.php?tipo=word&id=2" class="btn btn-sm btn-primary">
                  <i class="bi bi-file-earmark-word-fill"></i> Word
                </a>
              </td>
            </tr>
            <tr data-iso="17020" data-ciudad="Cali" data-pais="Colombia" data-lat="3.451647" data-lng="-76.531982">
              <td>Ana Torres</td>
              <td>Organismo de Inspección</td>
              <td>ISO/IEC 17020</td>
              <td>SGS Colombia</td>
              <td>atorres@email.com</td>
              <td class="text-center">
                <a href="descargar.php?tipo=pdf&id=3" class="btn btn-sm btn-danger me-1">
                  <i class="bi bi-file-earmark-pdf-fill"></i> PDF
                </a>
                <a href="descargar.php?tipo=word&id=3" class="btn btn-sm btn-primary">
                  <i class="bi bi-file-earmark-word-fill"></i> Word
                </a>
              </td>
            </tr>
            <tr data-iso="17065" data-ciudad="Barranquilla" data-pais="Colombia" data-lat="10.963889" data-lng="-74.796387">
              <td>Jorge Díaz</td>
              <td>Certificación de Productos</td>
              <td>ISO/IEC 17065</td>
              <td>Bureau Veritas</td>
              <td>jdiaz@email.com</td>
              <td class="text-center">
                <a href="descargar.php?tipo=pdf&id=4" class="btn btn-sm btn-danger me-1">
                  <i class="bi bi-file-earmark-pdf-fill"></i> PDF
                </a>
                <a href="descargar.php?tipo=word&id=4" class="btn btn-sm btn-primary">
                  <i class="bi bi-file-earmark-word-fill"></i> Word
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Scripts para el dashboard interactivo -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&callback=initMap" async defer></script>
<script>
  // Inicializar gráfico de experticias
  document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('graficoExperticias').getContext('2d');
    const chart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['ISO/IEC 17025', 'ISO/IEC 17024', 'ISO/IEC 17020', 'ISO/IEC 17065'],
        datasets: [{
          data: [1, 1, 1, 1],
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
  });

  // Inicializar mapa
  function initMap() {
    const colombia = { lat: 4.5709, lng: -74.2973 };
    const map = new google.maps.Map(document.getElementById('mapaEvaluadores'), {
      zoom: 5,
      center: colombia
    });

    // Agregar marcadores para cada evaluador
    document.querySelectorAll('#tablaExpertos tr').forEach(row => {
      if (row.dataset.lat && row.dataset.lng) {
        const marker = new google.maps.Marker({
          position: { lat: parseFloat(row.dataset.lat), lng: parseFloat(row.dataset.lng) },
          map: map,
          title: row.cells[0].textContent + ' - ' + row.cells[2].textContent
        });
      }
    });
  }

  // Filtro de normas
  document.getElementById('filtroIso').addEventListener('change', function() {
    const selectedValues = Array.from(this.selectedOptions).map(option => option.value);
    const rows = document.querySelectorAll('#tablaExpertos tr');
    
    rows.forEach(row => {
      if (selectedValues.length === 0 || selectedValues.includes(row.dataset.iso)) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
    
    // Actualizar contador
    document.getElementById('totalEvaluadores').textContent = 
      document.querySelectorAll('#tablaExpertos tr[style=""]').length;
  });
</script>

<?php include '../templades/pie.php'; ?>