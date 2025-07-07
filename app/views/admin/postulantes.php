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

  <!-- Modal Agregar Postulante y Relacionados -->
<div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="modalAgregarLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <form method="post" action="postulantes.php">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="modalAgregarLabel"><i class="bi bi-person-plus-fill me-2"></i>Registrar Postulante</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs mb-3" id="tabsPostulante" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="tab-datos" data-bs-toggle="tab" data-bs-target="#datos" type="button">Datos Personales</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="tab-educacion" data-bs-toggle="tab" data-bs-target="#educacion" type="button">Educación</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="tab-exp" data-bs-toggle="tab" data-bs-target="#InformacionLab" type="button">Informacion Laboral</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="tab-esquemas" data-bs-toggle="tab" data-bs-target="#evaluacion" type="button">Experiencia en Evaluaciones</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="tab-esquemas" data-bs-toggle="tab" data-bs-target="#esquemas" type="button">Experiencia Tecnica por Esquema</button>
            </li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content border rounded-3 p-3">
            <!-- Datos Personales -->
            <div class="tab-pane fade show active" id="datos" role="tabpanel">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Nombre:</label>
                  <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Apellido:</label>
                  <input type="text" name="apellido" class="form-control" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">CI:</label>
                  <input type="text" name="ci" class="form-control">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Ciudad:</label>
                  <input type="text" name="ciudad" class="form-control">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Dirección:</label>
                  <input type="text" name="direccion" class="form-control">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Email:</label>
                  <input type="text" name="email" class="form-control">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Celular:</label>
                  <input type="text" name="celular" class="form-control">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Teléfono:</label>
                  <input type="text" name="telefono" class="form-control">
                </div>
                <div class="col-md-4">
                  <label class="form-label">NIT:</label>
                  <input type="text" name="nit" class="form-control">
                </div>
                <div class="col-md-4">
                  <label class="form-label">SIGEP:</label>
                  <input type="text" name="sigep" class="form-control">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Matricula de Comercio:</label>
                  <input type="text" name="matricula" class="form-control">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Seguro de Salud:</label>
                  <input type="text" name="seguro" class="form-control">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Seguro de Riesgos:</label>
                  <input type="text" name="sriesgos" class="form-control">
                </div>
              </div>
            </div>

            <!-- Educación -->
            <div class="tab-pane fade" id="educacion" role="tabpanel">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Nivel Académico:</label>
                  <input type="text" name="nivelacademico" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Grado Obtenido:</label>
                  <input type="text" name="grado" class="form-control">
                </div>
                <div class="col-md-12">
                  <label class="form-label">Centro Educativo/Universidad/Instituto:</label>
                  <input type="text" name="centroeducativo" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Fecha de Título:</label>
                  <input type="date" name="fechatitulo" class="form-control">
                </div>
              </div>
              <hr class="mt-4 mb-3">
                <h5 class="text-secondary">Capacitacion y Formacion</h5>

                <!-- Contenedor donde se agregarán los grupos ISO -->
                <div id="isoContainer">
                  <div class="iso-block border p-3 rounded mb-3 position-relative">
                                                                <!-- Botón eliminar -->
                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2" onclick="eliminarIso(this)">
                      <i class="bi bi-x-lg"></i>
                    </button>
                    <div class="row g-3">
                    
                      <div class="col-md-6">
                        <label class="form-label">Esquemas:</label>
                        <select class="form-select" name="iso_norma[]">
                          <option value="">-- Selecciona --</option>
                          <option value="ISO/IEC 17025">ISO/IEC 17025 Lab. de Ensayo</option>
                          <option value="ISO/IEC 17025">ISO/IEC 17025 Lab. de Calibracion</option>
                          <option value="ISO/IEC 15189">ISO/IEC 15189 Lab. Clinicos</option>
                          <option value="ISO/IEC 17020">ISO/IEC 17020 Org. de Inspeccion</option>
                          <option value="ISO/IEC 17043">ISO/IEC 17043 Prov. de Ensayos de Aptiud</option>
                          <option value="ISO/IEC 17024">ISO/IEC 17024 Org. de Certificacion de Personas</option>
                          <option value="ISO/IEC 17021">ISO/IEC 17021-1 Org. de Certificacion de Sistemas de Gestion</option>
                          <option value="ISO/IEC 17024">ISO/IEC 17024 Org. de Certificacion de Certificacion de Productos</option>
                          <option value="ISO/IEC 17034">ISO/IEC 17034 Prov. de Materiales de Referencia</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Tipo de Formacion:</label>
                        <input type="text" name="iso_detalle[]" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Tema:</label>
                        <input type="text" name="iso_institucion[]" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Organismo que Brindo la Capacitacion:</label>
                        <input type="text" name="iso_ciudad[]" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Fecha:</label>
                        <input type="date" name="iso_fecha[]" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Duración (horas):</label>
                        <input type="number" name="iso_duracion[]" class="form-control" min="1">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Botón para agregar más ISO -->
                  <div class="text-end">
                    <button type="button" class="btn btn-outline-primary" onclick="agregarIso()">
                      <i class="bi bi-plus-circle me-1"></i> Agregar otra ISO
                    </button>
                  </div>
            </div>

            <!-- Informacion Laboral -->
            <div class="tab-pane fade" id="InformacionLab" role="tabpanel">
              <div class="row g-3">
                <h5 class="text-secondary">Informacion donde Trabaja Actualmente</h5>
                <div class="col-md-6">
                  <label class="form-label">Nombre de la Empresa:</label>
                  <input type="text" name="nomempresa" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Direccion:</label>
                  <input type="text" name="direccionL" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Departamento:</label>
                  <input type="text" name="departamento" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Telefono:</label>
                  <input type="text" name="telefono" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Correo:</label>
                  <input type="text" name="correo" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Cargo:</label>
                  <input type="text" name="cargo" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Tiempo de Permanencia:</label>
                  <input type="text" name="tiempopermanencia" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Persona Referencia:</label>
                  <input type="text" name="personareferencia" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Telefono de la Persona de Referencia:</label>
                  <input type="text" name="telefonoreferencia" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Descripcion de las Actividades, Responsabilidades, Funciones Asignada:</label>
                  <textarea class="form-control" id="descripcion" name="descripcion" rows="4" placeholder="Escribe una descripción..."></textarea>
                </div>
              </div>
              <hr class="mt-4 mb-3">
                <h5 class="text-secondary">Experiencia de Trabajo</h5>
                <div id="experienciaContainer">
                  <div class="experiencia-block border p-3 rounded mb-3 position-relative">
                    <div class="row g-3">
                      <div class="col-md-6">
                        <label class="form-label">Empresa/Institución:</label>
                        <input type="text" name="empresa[]" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Tipo de Organización (Pública, Privada u otra):</label>
                        <input type="text" name="tipoOrganizacion[]" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Cargo Desempeñado:</label>
                        <input type="text" name="cargo[]" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Descripción de las Actividades:</label>
                        <input type="text" name="descripccion[]" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Desde:</label>
                        <input type="date" name="desde[]" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Hasta:</label>
                        <input type="date" name="hasta[]" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Duración (meses):</label>
                        <input type="number" name="duracion[]" class="form-control" min="1">
                      </div>
                    </div>

                    <!-- Botón eliminar -->
                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2" onclick="eliminarExperiencia(this)">
                      <i class="bi bi-x-lg"></i>
                    </button>
                  </div>
                </div>

                <!-- Botón para agregar más experiencias -->
                <div class="text-end mb-3">
                  <button type="button" class="btn btn-outline-primary" onclick="agregarExperiencia()">
                    <i class="bi bi-plus-circle me-1"></i> Agregar otra experiencia
                  </button>
                </div>

            </div>
              <!-- Experiencia en evaluaciones  1 y 2-->             
            <div class="tab-pane fade" id="evaluacion" role="tabpanel">
              <h5 class="text-secondary">Experiencia en Evaluaciones y/o Auditorías</h5>
              <div id="evaluacionContainer">
                <div class="evaluacion-block border p-3 rounded mb-3 position-relative">
                  <div class="row g-3">
                    <div class="col-md-6">
                          <label class="form-label">Evaluacion y/o Auditoria:</label>
                          <select class="form-select" name="evaluacion[]">
                            <option value="">-- Selecciona --</option>
                            <option value="ISO/IEC 17025">1ra Parte</option>
                            <option value="ISO/IEC 17025">2da Parte</option>
                            <option value="ISO/IEC 15189">3ra Parte</option>
                          </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Organización Contratante del Servicio:</label>
                      <input type="text" name="organizaciont[]" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Organización Evaluada o Auditada:</label>
                      <input type="text" name="orevaluada[]" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Tipo de Organización:</label>
                      <input type="text" name="tipo[]" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Rol Designado:</label>
                      <input type="text" name="roldesignado[]" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Norma Aplicada:</label>
                      <input type="text" name="normaaplicada[]" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Fecha:</label>
                      <input type="date" name="fechaevaluacion[]" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Duración (horas):</label>
                      <input type="number" name="duracionhoras[]" class="form-control" min="1">
                    </div>
                  </div>

                  <!-- Botón para eliminar este bloque -->
                  <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2" onclick="eliminarEvaluacion(this)">
                    <i class="bi bi-x-lg"></i>
                  </button>
              </div>
            </div>
              <!-- Botones de control -->
              <div class="text-end">
                <button type="button" class="btn btn-outline-primary mb-2" onclick="agregarEvaluacion()">
                  <i class="bi bi-plus-circle me-1"></i> Agregar evaluación
                </button>
              </div>

              <!-- Experiencia en implememtacion consultoria -->

              <div id="implementacionContainer">
                <div class="implementacion-block border p-3 rounded mb-3 position-relative">
                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2" onclick="eliminarImplementacion(this)">
                    <i class="bi bi-x-lg"></i>
                </button>
                <hr class="mt-4 mb-3">
                <h5 class="text-secondary">Experiencia en Implementacion/Consultoria/Docencia/Facilitador</h5>
                <div class="col-md-6">
                      <label class="form-label">Organicacion Contratante de Servicio:</label>
                      <input type="text" name="organizacioni[]" class="form-control">
                </div>
                <div class="col-md-6">
                      <label class="form-label">Organicacion Beneficiada:</label>
                      <input type="text" name="orgbeneficiada[]" class="form-control">
                </div>
                <div class="col-md-6">
                      <label class="form-label">Funcion:</label>
                      <input type="text" name="funcion[]" class="form-control">
                </div>
                <div class="col-md-6">
                      <label class="form-label">Fecha:</label>
                      <input type="date" name="fecha[]" class="form-control">
                </div>
                <div class="col-md-6">
                      <label class="form-label">Duración (horas):</label>
                      <input type="number" name="duracionhoras[]" class="form-control" min="1">
                </div>
              </div>
              
            </div>
            <div class="text-end">
                <button type="button" class="btn btn-outline-primary mb-2" onclick="agregarImplementacion()">
                  <i class="bi bi-plus-circle me-1"></i> Agregar evaluación
                </button>
            </div>
            </div>
            
            
                
            <!-- Esquemas -->
            <!-- ISO 17025 ensayo -->
            <div class="tab-pane fade" id="esquemas" role="tabpanel">
              <h5 class="text-secondary">ISO/IEC 17025 Lab. de Ensayo</h5>
              <div id="ensayoContainer">
                <div class="ensayo-block border p-3 rounded mb-3 position-relative">
                  <div class="row g-3">
                    <div class="col-md-4">
                      <label class="form-label">Ensayo:</label>
                      <input type="text" name="ensayo[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Técnica:</label>
                      <input type="text" name="tecnica[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Norma/Documento:</label>
                      <input type="text" name="itemensato[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Item de Ensayo / Matriz:</label>
                      <input type="text" name="itemensayo[]" class="form-control">
                    </div>
                  </div>
                  <!-- Botón eliminar este bloque -->
                  <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2" onclick="eliminarEnsayo(this)">
                    <i class="bi bi-x-lg"></i>
                  </button>
                </div>
              </div>
              <!-- Botón para agregar otro ensayo -->
              <div class="text-end">
                <button type="button" class="btn btn-outline-primary" onclick="agregarEnsayo()">
                  <i class="bi bi-plus-circle me-1"></i> Agregar otro 17025 ensayo
                </button>
              </div>

            <!-- ISO 17025 calibracion -->
            <hr class="mt-4 mb-3">
            <h5 class="text-secondary">ISO/IEC 17025 Lab. de Calibracion</h5>
              <div id="calibracionContainer">
                <div class="calibracion-block border p-3 rounded mb-3 position-relative">
                  <div class="row g-3">
                    <div class="col-md-4">
                      <label class="form-label">Magnitud:</label>
                      <input type="text" name="ensayo[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Item Bajo Calibracion:</label>
                      <input type="text" name="tecnica[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Norma/Documento:</label>
                      <input type="text" name="itemensato[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Años de Experiencia:</label>
                      <input type="number" name="tiempoexp[]" class="form-control" min="1">
                    </div>
                  </div>
                  <!-- Botón eliminar este bloque -->
                  <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2" onclick="eliminarCalibracion(this)">
                    <i class="bi bi-x-lg"></i>
                  </button>
                </div>
              </div>
              <!-- Botón para agregar otro ensayo -->
              <div class="text-end">
                <button type="button" class="btn btn-outline-primary" onclick="agregarCalibracion()">
                  <i class="bi bi-plus-circle me-1"></i> Agregar otro 17025 Calib.
                </button>
              </div>

            <!-- script de añadir esquema 15189 clinicos -->
            <hr class="mt-4 mb-3">
            <h5 class="text-secondary">ISO/IEC 15189 Lab. clinicos</h5>
              <div id="clinicoContainer">
                <div class="clinico-block border p-3 rounded mb-3 position-relative">
                  <div class="row g-3">
                    <div class="col-md-4">
                      <label class="form-label">Area/Campo:</label>
                      <input type="text" name="area[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Analisi/Ensayo/Examen:</label>
                      <input type="text" name="analisis[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Tecnica:</label>
                      <input type="text" name="tecnica[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Muestra / Matriz:</label>
                      <input type="text" name="muestra[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Años de Experiencia:</label>
                      <input type="number" name="tiempoexp[]" class="form-control" min="1">
                    </div>
                  </div>
                  <!-- Botón eliminar este bloque -->
                  <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2" onclick="eliminarClinico(this)">
                    <i class="bi bi-x-lg"></i>
                  </button>
                </div>
              </div>
              <!-- Botón para agregar otro ensayo -->
              <div class="text-end">
                <button type="button" class="btn btn-outline-primary" onclick="agregarClinico()">
                  <i class="bi bi-plus-circle me-1"></i> Agregar otro 15189
                </button>
              </div>


            <!-- script de añadir esquema 17043 experto tecnico estadistico -->
            <hr class="mt-4 mb-3">
            <h5 class="text-secondary">ISO/IEC 17043 Experto Tecnico Estadistico</h5>
              <div id="ETEContainer">
                <div class="ETE-block border p-3 rounded mb-3 position-relative">
                  <div class="row g-3">
                    <div class="col-md-4">
                      <label class="form-label">Nombre del EA o CIL en el que Participo:</label>
                      <input type="text" name="nombre[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Empresa u Organizacion que lo Contrato para el Trartamiento de Datos:</label>
                      <input type="text" name="empresa[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Software utilizado para el Tratamiento de Datos:</label>
                      <input type="text" name="software[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Normas Aplicadas para el Tratamientos de Datos:</label>
                      <input type="text" name="normas[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Tiempo de Desarrollo de EA o CIL (Meses):</label>
                      <input type="number" name="tiempod[]" class="form-control" min="1">
                    </div>
                  </div>
                  <!-- Botón eliminar este bloque -->
                  <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2" onclick="eliminarETE(this)">
                    <i class="bi bi-x-lg"></i>
                  </button>
                </div>
              </div>
              <!-- Botón para agregar otro ensayo -->
              <div class="text-end">
                <button type="button" class="btn btn-outline-primary" onclick="agregarETE()">
                  <i class="bi bi-plus-circle me-1"></i> Agregar 17043 Exp. Tec. Est
                </button>
              </div>


            <!-- script de añadir esquema 17043 experto tecnico -->
            <hr class="mt-4 mb-3">
            <h5 class="text-secondary">ISO/IEC 17043 Experto Tecnico</h5>
              <div id="ETContainer">
                <div class="ET-block border p-3 rounded mb-3 position-relative">
                  <div class="row g-3">
                    <div class="col-md-4">
                      <label class="form-label">Ensayo/Magnitud:</label>
                      <input type="text" name="ensayo[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Técnica:</label>
                      <input type="text" name="tecnica[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Norma/Documento:</label>
                      <input type="text" name="itemensato[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Item de Ensayo/Matriz/Item Bajo Calibracion:</label>
                      <input type="text" name="itemensayo[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Años de Experiencia:</label>
                      <input type="number" name="tiempoexp[]" class="form-control" min="1">
                    </div>
                  </div>
                  <!-- Botón eliminar este bloque -->
                  <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2" onclick="eliminarET(this)">
                    <i class="bi bi-x-lg"></i>
                  </button>
                </div>
              </div>
              <!-- Botón para agregar otro ensayo -->
              <div class="text-end">
                <button type="button" class="btn btn-outline-primary" onclick="agregarET()">
                  <i class="bi bi-plus-circle me-1"></i> Agregar otro 17043 Exp. Tec
                </button>
              </div>
            



            <!-- script de añadir esquema 17020  -->
            <hr class="mt-4 mb-3">
            <h5 class="text-secondary">ISO/IEC 17020 Organismo de Inspeccion</h5>
              <div id="OIContainer">
                <div class="OI-block border p-3 rounded mb-3 position-relative">
                  <div class="row g-3">
                    <div class="col-md-4">
                      <label class="form-label">Campo o Sector de Inspeccion:</label>
                      <input type="text" name="campo[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Sub-Sector:</label>
                      <input type="text" name="sector[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Item Inspeccionado:</label>
                      <input type="text" name="iteminspeccion[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Metodo o Documento normativo para la Inspeccion:</label>
                      <input type="text" name="matodo[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Años de Experiencia:</label>
                      <input type="number" name="tiempoexp[]" class="form-control" min="1">
                    </div>
                  </div>
                  <!-- Botón eliminar este bloque -->
                  <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2" onclick="eliminarOI(this)">
                    <i class="bi bi-x-lg"></i>
                  </button>
                </div>
              </div>
              <!-- Botón para agregar otro ensayo -->
              <div class="text-end">
                <button type="button" class="btn btn-outline-primary" onclick="agregarOI()">
                  <i class="bi bi-plus-circle me-1"></i> Agregar otro 17020
                </button>
              </div>


            <!-- script de añadir esquema 17065  -->
            <hr class="mt-4 mb-3">
            <h5 class="text-secondary">ISO/IEC 17065 Organismo de Certificacion de Productos</h5>
              <div id="OCPContainer">
                <div class="OCP-block border p-3 rounded mb-3 position-relative">
                  <div class="row g-3">
                    <div class="col-md-4">
                      <label class="form-label">Tipo de Certificacion</label>
                      <input type="text" name="tipocert[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Producto/Proceso/Servicio:</label>
                      <input type="text" name="producto[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Documento Normativo:</label>
                      <input type="text" name="documentos[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Division NACE:</label>
                      <input type="text" name="division[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Codigo CPA:</label>
                      <input type="text" name="codigo[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Años de Experiencia:</label>
                      <input type="number" name="tiempoexp[]" class="form-control" min="1">
                    </div>
                  </div>
                  <!-- Botón eliminar este bloque -->
                  <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2" onclick="eliminarOCP(this)">
                    <i class="bi bi-x-lg"></i>
                  </button>
                </div>
              </div>
              <!-- Botón para agregar otro ensayo -->
              <div class="text-end">
                <button type="button" class="btn btn-outline-primary" onclick="agregarOCP()">
                  <i class="bi bi-plus-circle me-1"></i> Agregar otro 17065
                </button>
              </div>



            <!-- script de añadir esquema 17021-1  -->
            <hr class="mt-4 mb-3">
            <h5 class="text-secondary">ISO/IEC 17021-1 Organismo de Certificacion de Sistemas de Gestion</h5>
              <div id="OCSGContainer">
                <div class="OCSG-block border p-3 rounded mb-3 position-relative">
                  <div class="row g-3">
                    <div class="col-md-4">
                      <label class="form-label">Sistemas de Gestion:</label>
                      <input type="text" name="sisges[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Norma:</label>
                      <input type="text" name="norma[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Codigo IAF-Sector:</label>
                      <input type="text" name="codigo[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Nombre del Sector:</label>
                      <input type="text" name="sector[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Años de Experiencia:</label>
                      <input type="number" name="tiempoexp[]" class="form-control" min="1">
                    </div>
                  </div>
                  <!-- Botón eliminar este bloque -->
                  <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2" onclick="eliminarOCSG(this)">
                    <i class="bi bi-x-lg"></i>
                  </button>
                </div>
              </div>
              <!-- Botón para agregar otro ensayo -->
              <div class="text-end">
                <button type="button" class="btn btn-outline-primary" onclick="agregarOCSG()">
                  <i class="bi bi-plus-circle me-1"></i> Agregar otro 17021
                </button>
              </div>



            <!-- script de añadir esquema 17024  -->
            <hr class="mt-4 mb-3">
            <h5 class="text-secondary">ISO/IEC 17024 Certificacion de Personas</h5>
              <div id="CPContainer">
                <div class="CP-block border p-3 rounded mb-3 position-relative">
                  <div class="row g-3">
                    <div class="col-md-4">
                      <label class="form-label">Sector o Campo:</label>
                      <input type="text" name="secto[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Actividad Espesifica:</label>
                      <input type="text" name="actividad[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Item/Matriz:</label>
                      <input type="text" name="item[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Normas/Documentos Utilizados para realizar la Evaluacion:</label>
                      <input type="text" name="tiempoexp[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Años de Experiencia:</label>
                      <input type="number" name="tiempoexp[]" class="form-control" min="1">
                    </div>
                  </div>
                  <!-- Botón eliminar este bloque -->
                  <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2" onclick="eliminarCP(this)">
                    <i class="bi bi-x-lg"></i>
                  </button>
                </div>
              </div>
              <!-- Botón para agregar otro ensayo -->
              <div class="text-end">
                <button type="button" class="btn btn-outline-primary" onclick="agregarCP()">
                  <i class="bi bi-plus-circle me-1"></i> Agregar otro 17024
                </button>
              </div>



            <!-- script de añadir esquema 17034  -->
            <hr class="mt-4 mb-3">
            <h5 class="text-secondary">ISO/IEC 17034 Proveedor de Materiales de Referencia</h5>
              <div id="PMRContainer">
                <div class="PMR-block border p-3 rounded mb-3 position-relative">
                  <div class="row g-3">
                    <div class="col-md-4">
                      <label class="form-label">Ensayo:</label>
                      <input type="text" name="ensayo[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Técnica:</label>
                      <input type="text" name="tecnica[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Norma/Documento:</label>
                      <input type="text" name="documento[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Item de Ensayo / Matriz:</label>
                      <input type="text" name="item[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Norma Aplicada para la Preparacion de los Items:</label>
                      <input type="text" name="norma[]" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Años de Experiencia:</label>
                      <input type="number" name="tiempoexp[]" class="form-control" min="1">
                    </div>
                  </div>
                  <!-- Botón eliminar este bloque -->
                  <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2" onclick="eliminarPMR(this)">
                    <i class="bi bi-x-lg"></i>
                  </button>
                </div>
              </div>
              <!-- Botón para agregar otro ensayo -->
              <div class="text-end">
                <button type="button" class="btn btn-outline-primary" onclick="agregarPMR()">
                  <i class="bi bi-plus-circle me-1"></i> Agregar otro 17034
                </button>
              </div>




            </div>

          </div>
        </div>

        <!-- Botones -->
        <div class="modal-footer">
          <button type="submit" name="accion" value="agregar_completo" class="btn btn-success">
            <i class="bi bi-save me-1"></i> Guardar todo
          </button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Cerrar
          </button>
        </div>
      </form>
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
                    <div class="card h-100 shadow-lg border-0 rounded-4 card-selectable position-relative"
                        data-postulante='<?= json_encode($postulante) ?>'
                        data-id="<?= $postulante['idpostulante'] ?>"
                        style="transition: transform 0.3s;">
                      
                      <!-- Checkbox -->
                      <div class="form-check position-absolute top-0 end-0 m-2">
                        <input class="form-check-input seleccionPostulante" type="checkbox" name="ids[]" value="<?= $postulante['idpostulante'] ?>">
                      </div>

                      <!-- Cuerpo con scroll -->
                      <div class="card-body p-3" style="max-height: 300px; overflow-y: auto;">
                        <h5 class="card-title text-primary fw-bold">
                          <i class="bi bi-person-circle me-1"></i>
                          <?= $postulante['nombre'] . ' ' . $postulante['apellido'] ?>
                        </h5>

                        <p class="mb-1"><i class="bi bi-card-text me-1 text-muted"></i><strong>CI:</strong> <?= $postulante['ci'] ?></p>
                        <p class="mb-1"><i class="bi bi-geo-alt me-1 text-muted"></i><strong>Ciudad:</strong> <?= $postulante['ciudad'] ?></p>
                        <p class="mb-1"><i class="bi bi-house-door me-1 text-muted"></i><strong>Dirección:</strong> <?= $postulante['direccion'] ?></p>
                        <p class="mb-1"><i class="bi bi-envelope me-1 text-muted"></i><strong>Email:</strong> <?= $postulante['email'] ?></p>
                        <p class="mb-1"><i class="bi bi-phone me-1 text-muted"></i><strong>Móvil:</strong> <?= $postulante['celular'] ?></p>
                        <p class="mb-1"><i class="bi bi-telephone me-1 text-muted"></i><strong>Fijo:</strong> <?= $postulante['telefono'] ?></p>
                        <p class="mb-1"><i class="bi bi-coin me-1 text-muted"></i><strong>NIT:</strong> <?= $postulante['nit'] ?></p>
                        <p class="mb-1"><i class="bi bi-building me-1 text-muted"></i><strong>Registro SIGEP:</strong> <?= $postulante['sigep'] ?></p>
                        <p class="mb-1"><i class="bi bi-briefcase me-1 text-muted"></i><strong>Matrícula:</strong> <?= $postulante['matricula'] ?></p>
                        <p class="mb-1"><i class="bi bi-heart-pulse me-1 text-muted"></i><strong>Seguro Salud:</strong> <?= $postulante['seguro'] ?></p>
                        <p class="mb-1"><i class="bi bi-shield-lock me-1 text-muted"></i><strong>Riesgo:</strong> <?= $postulante['sriesgos'] ?></p>
                        <p class="mb-3"><i class="bi bi-calendar-check me-1 text-muted"></i><strong>Registrado:</strong> <?= $postulante['fecha_registro'] ?></p>

                        <!-- Botón PDF -->
                        <a href="generar_pdf.php?id=<?= $postulante['idpostulante'] ?>" target="_blank" class="btn btn-outline-danger btn-sm w-100 mt-2">
                          <i class="bi bi-file-earmark-pdf-fill me-1"></i> Descargar PDF
                        </a>
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


<!-- script de añadir mas isos a capacitacion y formacion -->

<script>
  function agregarIso() {
    const container = document.getElementById('isoContainer');
    const bloques = container.getElementsByClassName('iso-block');
    const original = bloques[0];

    const clon = original.cloneNode(true);

    // Limpiar los valores del nuevo bloque
    const inputs = clon.querySelectorAll('input, select');
    inputs.forEach(input => input.value = '');

    container.appendChild(clon);
  }

  function eliminarIso(boton) {
    const block = boton.closest('.iso-block');
    const container = document.getElementById('isoContainer');
    const total = container.getElementsByClassName('iso-block').length;

    // Evitar eliminar el último bloque (opcional)
    if (total > 1) {
      container.removeChild(block);
    } else {
      alert("Debe haber al menos un bloque ISO.");
    }
  }
</script>

<!-- script de añadir mas experiencia laboral -->

<script>
  function agregarExperiencia() {
    const container = document.getElementById('experienciaContainer');
    const bloques = container.getElementsByClassName('experiencia-block');
    const original = bloques[0];

    const clon = original.cloneNode(true);

    // Limpiar valores del clon
    const inputs = clon.querySelectorAll('input');
    inputs.forEach(input => input.value = '');

    container.appendChild(clon);
  }

  function eliminarExperiencia(boton) {
    const block = boton.closest('.experiencia-block');
    const container = document.getElementById('experienciaContainer');
    const total = container.getElementsByClassName('experiencia-block').length;

    if (total > 1) {
      container.removeChild(block);
    } else {
      alert("Debe haber al menos una experiencia.");
    }
  }
</script>

<!-- script de añadir mas evaluaciones y auditorias -->

<script>
  function agregarEvaluacion() {
    const container = document.getElementById('evaluacionContainer');
    const bloques = container.getElementsByClassName('evaluacion-block');
    const original = bloques[0];

    const clon = original.cloneNode(true);
    const inputs = clon.querySelectorAll('input');
    inputs.forEach(input => input.value = '');

    container.appendChild(clon);
  }

  function eliminarEvaluacion(boton) {
    const block = boton.closest('.evaluacion-block');
    const container = document.getElementById('evaluacionContainer');
    const total = container.getElementsByClassName('evaluacion-block').length;

    if (total > 1) {
      container.removeChild(block);
    } else {
      alert("Debe haber al menos una evaluación.");
    }
  }
</script>

<!-- script de añadir mas experiencia y evaluacion -->

<script>
  function agregarImplementacion() {
    const container = document.getElementById('implementacionContainer');
    const bloques = container.getElementsByClassName('implementacion-block');
    const original = bloques[0];

    const clon = original.cloneNode(true);
    const inputs = clon.querySelectorAll('input');
    inputs.forEach(input => input.value = '');

    container.appendChild(clon);
  }

  function eliminarImplementacion(boton) {
    const block = boton.closest('.implementacion-block');
    const container = document.getElementById('implementacionContainer');
    const total = container.getElementsByClassName('implementacion-block').length;

    if (total > 1) {
      container.removeChild(block);
    } else {
      alert("Debe haber al menos una experiencia en implementacion.");
    }
  }
</script>

<!-- script de añadir esquema 17025 ensayo -->

<script>
  function agregarEnsayo() {
    const container = document.getElementById('ensayoContainer');
    const bloques = container.getElementsByClassName('ensayo-block');
    const original = bloques[0];

    const clon = original.cloneNode(true);
    const inputs = clon.querySelectorAll('input');
    inputs.forEach(input => input.value = '');

    container.appendChild(clon);
  }

  function eliminarEnsayo(boton) {
    const block = boton.closest('.ensayo-block');
    const container = document.getElementById('ensayoContainer');
    const total = container.getElementsByClassName('ensayo-block').length;

    if (total > 1) {
      container.removeChild(block);
    } else {
      alert("Debe haber al menos un bloque de 17025 ensayo.");
    }
  }
</script>

<!-- script de añadir esquema 17025 calibracion -->

<script>
  function agregarCalibracion() {
    const container = document.getElementById('calibracionContainer');
    const bloques = container.getElementsByClassName('calibracion-block');
    const original = bloques[0];

    const clon = original.cloneNode(true);
    const inputs = clon.querySelectorAll('input');
    inputs.forEach(input => input.value = '');

    container.appendChild(clon);
  }

  function eliminarCalibracion(boton) {
    const block = boton.closest('.calibracion-block');
    const container = document.getElementById('calibracionContainer');
    const total = container.getElementsByClassName('calibracion-block').length;

    if (total > 1) {
      container.removeChild(block);
    } else {
      alert("Debe haber al menos un bloque de 17025 calibracion.");
    }
  }
</script>

<!-- script de añadir esquema 15189 clinicos -->

<script>
  function agregarClinico() {
    const container = document.getElementById('clinicoContainer');
    const bloques = container.getElementsByClassName('clinico-block');
    const original = bloques[0];

    const clon = original.cloneNode(true);
    const inputs = clon.querySelectorAll('input');
    inputs.forEach(input => input.value = '');

    container.appendChild(clon);
  }

  function eliminarClinico(boton) {
    const block = boton.closest('.clinico-block');
    const container = document.getElementById('clinicoContainer');
    const total = container.getElementsByClassName('clinico-block').length;

    if (total > 1) {
      container.removeChild(block);
    } else {
      alert("Debe haber al menos un bloque de 15189.");
    }
  }
</script>

<!-- script de añadir esquema 17043 experto tecnico estadistico -->

<script>
  function agregarETE() {
    const container = document.getElementById('ETEContainer');
    const bloques = container.getElementsByClassName('ETE-block');
    const original = bloques[0];

    const clon = original.cloneNode(true);
    const inputs = clon.querySelectorAll('input');
    inputs.forEach(input => input.value = '');

    container.appendChild(clon);
  }

  function eliminarETE(boton) {
    const block = boton.closest('.ETE-block');
    const container = document.getElementById('ETEContainer');
    const total = container.getElementsByClassName('ETE-block').length;

    if (total > 1) {
      container.removeChild(block);
    } else {
      alert("Debe haber al menos un bloque de 17043 ETE.");
    }
  }
</script>

<!-- script de añadir esquema 17043 experto tecnico -->

<script>
  function agregarET() {
    const container = document.getElementById('ETContainer');
    const bloques = container.getElementsByClassName('ET-block');
    const original = bloques[0];

    const clon = original.cloneNode(true);
    const inputs = clon.querySelectorAll('input');
    inputs.forEach(input => input.value = '');

    container.appendChild(clon);
  }

  function eliminarET(boton) {
    const block = boton.closest('.ET-block');
    const container = document.getElementById('ETContainer');
    const total = container.getElementsByClassName('ET-block').length;

    if (total > 1) {
      container.removeChild(block);
    } else {
      alert("Debe haber al menos un bloque de 17043 ET.");
    }
  }
</script>

<!-- script de añadir esquema 17020  -->

<script>
  function agregarOI() {
    const container = document.getElementById('OIContainer');
    const bloques = container.getElementsByClassName('OI-block');
    const original = bloques[0];

    const clon = original.cloneNode(true);
    const inputs = clon.querySelectorAll('input');
    inputs.forEach(input => input.value = '');

    container.appendChild(clon);
  }

  function eliminarOI(boton) {
    const block = boton.closest('.OI-block');
    const container = document.getElementById('OIContainer');
    const total = container.getElementsByClassName('OI-block').length;

    if (total > 1) {
      container.removeChild(block);
    } else {
      alert("Debe haber al menos un bloque de 17020.");
    }
  }
</script>

<!-- script de añadir esquema 17065  -->

<script>
  function agregarOCP() {
    const container = document.getElementById('OCPContainer');
    const bloques = container.getElementsByClassName('OCP-block');
    const original = bloques[0];

    const clon = original.cloneNode(true);
    const inputs = clon.querySelectorAll('input');
    inputs.forEach(input => input.value = '');

    container.appendChild(clon);
  }

  function eliminarOCP(boton) {
    const block = boton.closest('.OCP-block');
    const container = document.getElementById('OCPContainer');
    const total = container.getElementsByClassName('OCP-block').length;

    if (total > 1) {
      container.removeChild(block);
    } else {
      alert("Debe haber al menos un bloque de 17065.");
    }
  }
</script>

<!-- script de añadir esquema 17021-1  -->

<script>
  function agregarOCSG() {
    const container = document.getElementById('OCSGContainer');
    const bloques = container.getElementsByClassName('OCSG-block');
    const original = bloques[0];

    const clon = original.cloneNode(true);
    const inputs = clon.querySelectorAll('input');
    inputs.forEach(input => input.value = '');

    container.appendChild(clon);
  }

  function eliminarOCSG(boton) {
    const block = boton.closest('.OCSG-block');
    const container = document.getElementById('OCSGContainer');
    const total = container.getElementsByClassName('OCSG-block').length;

    if (total > 1) {
      container.removeChild(block);
    } else {
      alert("Debe haber al menos un bloque de 17021-1.");
    }
  }
</script>

<!-- script de añadir esquema 17024  -->

<script>
  function agregarCP() {
    const container = document.getElementById('CPContainer');
    const bloques = container.getElementsByClassName('CP-block');
    const original = bloques[0];

    const clon = original.cloneNode(true);
    const inputs = clon.querySelectorAll('input');
    inputs.forEach(input => input.value = '');

    container.appendChild(clon);
  }

  function eliminarCP(boton) {
    const block = boton.closest('.CP-block');
    const container = document.getElementById('CPContainer');
    const total = container.getElementsByClassName('CP-block').length;

    if (total > 1) {
      container.removeChild(block);
    } else {
      alert("Debe haber al menos un bloque de 17024.");
    }
  }
</script>

<!-- script de añadir esquema 17034  -->


<script>
  function agregarPMR() {
    const container = document.getElementById('PMRContainer');
    const bloques = container.getElementsByClassName('PMR-block');
    const original = bloques[0];

    const clon = original.cloneNode(true);
    const inputs = clon.querySelectorAll('input');
    inputs.forEach(input => input.value = '');

    container.appendChild(clon);
  }

  function eliminarPMR(boton) {
    const block = boton.closest('.PMR-block');
    const container = document.getElementById('PMRContainer');
    const total = container.getElementsByClassName('PMR-block').length;

    if (total > 1) {
      container.removeChild(block);
    } else {
      alert("Debe haber al menos un bloque de 17034.");
    }
  }
</script>




















































  
  <!-- <div class="p-4 bg-light">
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
    </script> -->



  </div>

<?php include '../templades/pie.php'; ?>