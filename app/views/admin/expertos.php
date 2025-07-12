<?php
// Vista cargada por AdminController@listExpertos
// Variables disponibles: $expertos, $titulo
require_once __DIR__ . '/../templates/cabecera_admin.php';
?>

<div class="container my-5">
    <h2><?= htmlspecialchars($titulo ?? 'Gestión de Expertos Técnicos') ?></h2>

    <div class="card shadow-sm border-0 mt-4">
    <div class="card-header bg-primary text-white text-center fw-bold">
      Panel de Búsqueda - Expertos Técnicos
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
            <?php if (!empty($expertos)): ?>
                <?php foreach ($expertos as $experto): ?>
                <tr data-iso="<?= htmlspecialchars($experto['data_iso'] ?? '') ?>">
                    <td><?= htmlspecialchars($experto['nombre'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($experto['especialidad'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($experto['norma'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($experto['organismo'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($experto['correo'] ?? 'N/A') ?></td>
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
                <tr><td colspan="6" class="text-center">No hay expertos para mostrar.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>



<script>
// Script de filtro (se mantiene, pero ahora opera sobre los datos cargados dinámicamente)
document.addEventListener('DOMContentLoaded', function() {
    const filtroIsoSelect = document.getElementById('filtroIso');
    if (filtroIsoSelect) {
        filtroIsoSelect.addEventListener('change', function() {
            const selectedValues = Array.from(this.selectedOptions).map(option => option.value);
            const rows = document.querySelectorAll('#tablaExpertos tr');

            rows.forEach(row => {
            if (selectedValues.length === 0 || selectedValues.includes(row.dataset.iso)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
            });
        });
    }
});
</script>

<?php require_once __DIR__ . '/../templates/pie_admin.php'; ?>