<?php include '../templades/cabecera.php'; ?>

<div class="container my-5">
  <div class="card shadow-sm border-0">
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
            <tr data-iso="17025E">
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
            <tr data-iso="17024">
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
            <tr data-iso="17020">
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
            <tr data-iso="17065">
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
            <!-- Más registros aquí -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>



<?php include '../templades/pie.php'; ?>