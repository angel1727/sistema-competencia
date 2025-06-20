const addFormBtn = document.getElementById("addFormBtn");
const formsWrapper = document.getElementById("formsWrapper");

let formCount = 1;

// Función que genera campos dinámicos según selección
function generateExtraFields(selectValue) {
  const wrapper = document.createElement("div");
  wrapper.className = "generated-fields";

  switch (selectValue) {
    case "ETISO_17025en":
      wrapper.innerHTML = `
        <div class="row g-3">
          <div id="formaciones-container">
            <!-- FORMULARIO INDIVIDUAL CLONABLE -->
            <div class="formacion-item p-3 mb-3 rounded">
              <div class="row g-3">
                <!-- CAMPOS DE TEXTO -->
                <div class="col-md-6">
                  <label class="form-label">Ensayo</label>
                  <input type="text" name="ensayo" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Tecnica</label>
                  <input type="text" name="tecnica" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Norma / Documentacion</label>
                  <input type="text" name="norma_doc" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Item de ensayo / Matriz</label>
                  <input type="text" name="item_ensayo" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label class="form-label">Años de Experiencia</label>
                  <input type="text" name="tiempo_exp" class="form-control" />
                </div>
                
              </div>
            </div>
          </div>
        </div>
      `;

      break;

    case "ETISO_17025cal":
      wrapper.innerHTML = `
         <div class="row g-3">
          <div id="formaciones-container">
            <!-- FORMULARIO INDIVIDUAL CLONABLE -->
            <div class="formacion-item p-3 mb-3 rounded">
              <div class="row g-3">
                <!-- CAMPOS DE TEXTO -->
                <div class="col-md-6">
                  <label class="form-label">Magnitud</label>
                  <input type="text" name="magnitud" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Item bajo calibracion</label>
                  <input type="text" name="item_calibracion" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Norma / Documentacion</label>
                  <input type="text" name="norma_doc" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label class="form-label">Años de Experiencia</label>
                  <input type="text" name="tiempo_exp" class="form-control" />
                </div> 
              </div>
            </div>
          </div>
        </div>   
      `;
      break;

    case "ETISO_15189":
      wrapper.innerHTML = `
        <div class="row g-3">
          <div id="formaciones-container">
            <!-- FORMULARIO INDIVIDUAL CLONABLE -->
            <div class="formacion-item p-3 mb-3 rounded">
              <div class="row g-3">
                <!-- CAMPOS DE TEXTO -->
                <div class="col-md-6">
                  <label class="form-label">Área / Campo</label>
                  <input type="text" name="area_campo" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Análisis/Ensayo/Examen</label>
                  <input type="text" name="analisisensayo" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Tecnica</label>
                  <input type="text" name="tecnica" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Muestra/Matriz</label>
                  <input type="text" name="muestra" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label class="form-label">Años de Experiencia</label>
                  <input type="text" name="tiempo_exp" class="form-control" />
                </div>
                <div class="col-8">
                  <label class="form-label">Descripción de Actividades - Responsabilidades</label>
                  <div class="textarea-container">
                    <textarea name="actividades" class="form-control" rows="1" maxlength="500" oninput="actualizarContador(this)"> </textarea>
                    <div class="textarea-counter" id="contador">500</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      `;
      break;

    case "ETISO_17043est":
      wrapper.innerHTML = `
        <div class="row g-3">
          <div id="formaciones-container">
            <!-- FORMULARIO INDIVIDUAL CLONABLE -->
            <div class="formacion-item p-3 mb-3 rounded">
              <div class="row g-3">
                <!-- CAMPOS DE TEXTO -->
                <div class="col-md-6">
                  <label class="form-label">Nombre del EA o CIL (paraticipo)</label>
                  <input type="text" name="nombre_ea" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Empresa u Organizacion (Contratado)</label>
                  <input type="text" name="empresa_contratado" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Software Utilizado (tratamiento de datos)</label>
                  <input type="text" name="Software_datos" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Normas Aplicadas (tratamiento de datos)</label>
                  <input type="text" name="norma_aplic_datos" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label class="form-label">Años de Experiencia</label>
                  <input type="text" name="tiempo_exp" class="form-control" />
                </div> 
              </div>
            </div>
          </div>
        </div> 
      `;
      break;

    case "ETISO_17043tec":
      wrapper.innerHTML = `
        <div class="row g-3">
          <div id="formaciones-container">
            <!-- FORMULARIO INDIVIDUAL CLONABLE -->
            <div class="formacion-item p-3 mb-3 rounded">
              <div class="row g-3">
                <!-- CAMPOS DE TEXTO -->
                <div class="col-md-6">
                  <label class="form-label">Ensayo o Magnitud</label>
                  <input type="text" name="ensayo" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Técnica</label>
                  <input type="text" name="tecnica" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Norma / Documento</label>
                  <input type="text" name="norma_doc" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Item ensayo/muestra - Item bajo calibracion</label>
                  <input type="text" name="item_ensayo" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label class="form-label">Años de Experiencia</label>
                  <input type="text" name="tiempo_exp" class="form-control" />
                </div> 
              </div>
            </div>
          </div>
        </div> 
      `;
      break;

    case "ETISO_17020":
      wrapper.innerHTML = `
        <div class="row g-3">
          <div id="formaciones-container">
            <!-- FORMULARIO INDIVIDUAL CLONABLE -->
            <div class="formacion-item p-3 mb-3 rounded">
              <div class="row g-3">
                <!-- CAMPOS DE TEXTO -->
                <div class="col-md-6">
                  <label class="form-label">Campo o Sector de Inspeccion</label>
                  <input type="text" name="campo_inspec" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Sub Sector</label>
                  <input type="text" name="sub_sector" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Item inspeccionado</label>
                  <input type="text" name="item_inspec" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Metodo o Documento normativo (Inspeccion)</label>
                  <input type="text" name="metodo_doc_inspec" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label class="form-label">Años de Experiencia</label>
                  <input type="text" name="tiempo_exp" class="form-control" />
                </div> 
              </div>
            </div>
          </div>
        </div> 
      `;
      break;

    case "ETISO_17065":
      wrapper.innerHTML = `
        <div class="row g-3">
          <div id="formaciones-container">
            <!-- FORMULARIO INDIVIDUAL CLONABLE -->
            <div class="formacion-item p-3 mb-3 rounded">
              <div class="row g-3">
                <!-- CAMPOS DE TEXTO -->
                <div class="col-md-6">
                  <label class="form-label">Tipo de certificacion</label>
                  <input type="text" name="tipo_certi" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Producto/proceso/servicio</label>
                  <input type="text" name="Producto_proc_serv" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Documento Normativo</label>
                  <input type="text" name="doc_normativo" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">División Nace</label>
                  <input type="text" name="division_nace" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Código CPA</label>
                  <input type="text" name="codigo_cpa" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label class="form-label">Años de Experiencia</label>
                  <input type="text" name="tiempo_exp" class="form-control" />
                </div> 
              </div>
            </div>
          </div>
        </div> 
      `;
      break;

    case "ETISO_17021_1":
      wrapper.innerHTML = `
        <div class="row g-3">
          <div id="formaciones-container">
            <!-- FORMULARIO INDIVIDUAL CLONABLE -->
            <div class="formacion-item p-3 mb-3 rounded">
              <div class="row g-3">
                <!-- CAMPOS DE TEXTO -->
                <div class="col-md-6">
                  <label class="form-label">Sistema de Gestión</label>
                  <input type="text" name="sistema_gest" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Norma</label>
                  <input type="text" name="norma" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Código IAF-Sector</label>
                  <input type="text" name="codigo_iaf" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Nombre del sector</label>
                  <input type="text" name="nombre_sector" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label class="form-label">Años de Experiencia</label>
                  <input type="text" name="tiempo_exp" class="form-control" />
                </div> 
              </div>
            </div>
          </div>
        </div>
      `;
      break;

    case "ETISO_17024":
      wrapper.innerHTML = `
        <div class="row g-3">
          <div id="formaciones-container">
            <!-- FORMULARIO INDIVIDUAL CLONABLE -->
            <div class="formacion-item p-3 mb-3 rounded">
              <div class="row g-3">
                <!-- CAMPOS DE TEXTO -->
                <div class="col-md-6">
                  <label class="form-label">Sector o campo</label>
                  <input type="text" name="sector_campo" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">ACtividad especifica</label>
                  <input type="text" name="actividad_especifica" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Item/Matriz</label>
                  <input type="text" name="item_matriz" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Normas/documentos ustilizado (evaluacion-actividad)</label>
                  <input type="text" name="normas_evaluacion" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label class="form-label">Años de Experiencia</label>
                  <input type="text" name="tiempo_exp" class="form-control" />
                </div> 
              </div>
            </div>
          </div>
        </div>
      `;
      break;

    case "ETISO_17034":
      wrapper.innerHTML = `
        <div class="row g-3">
          <div id="formaciones-container">
            <!-- FORMULARIO INDIVIDUAL CLONABLE -->
            <div class="formacion-item p-3 mb-3 rounded">
              <div class="row g-3">
                <!-- CAMPOS DE TEXTO -->
                <div class="col-md-6">
                  <label class="form-label">Ensayo</label>
                  <input type="text" name="ensayo" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Tecnica</label>
                  <input type="text" name="tecnica" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Norma/documento</label>
                  <input type="text" name="norma_doc" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Item ensayo/muestra</label>
                  <input type="text" name="item_ensayo" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Normas aplicadas (prepacion de los items)</label>
                  <input type="text" name="norma_aplicada" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label class="form-label">Años de Experiencia</label>
                  <input type="text" name="tiempo_exp" class="form-control" />
                </div> 
              </div>
            </div>
          </div>
        </div>
      `;
      break;

    default:
      wrapper.innerHTML = ``;
  }

  return wrapper;
}

function actualizarContador(textarea) {
    const max = 500;
    const actual = textarea.value.length;
    const restantes = max - actual;
    document.getElementById('contador').textContent = restantes;
}


// Función que conecta un formulario con su select
function attachSelectListener(form) {
  const select = form.querySelector("select");
  const extraFieldsContainer = form.querySelector(".extra-fields");

  select.addEventListener("change", () => {
    extraFieldsContainer.innerHTML = ""; // Limpia anteriores
    const selectedValue = select.value;
    const newFields = generateExtraFields(selectedValue);
    extraFieldsContainer.appendChild(newFields);
  });
}

addFormBtn.addEventListener("click", () => {
  const firstForm = formsWrapper.firstElementChild;
  const newForm = firstForm.cloneNode(true);
  formCount++;

  // Limpia campos
  newForm
    .querySelectorAll("input, select")
    .forEach((input) => (input.value = ""));
  newForm.querySelector(".extra-fields").innerHTML = "";

  // Cambia el label del select
  const label = newForm.querySelector("label");
  if (label) {
    label.textContent = `Área ISO/IEC a postular ${formCount}`;
  }

  // Agrega botón de eliminar
  let removeBtn = document.createElement("button");
  removeBtn.textContent = "Eliminar";
  removeBtn.className = "removeFormBtn";
  removeBtn.addEventListener("click", () => {
    formsWrapper.removeChild(newForm);
  });
  newForm.appendChild(removeBtn);

  // Agrega al DOM
  formsWrapper.appendChild(newForm);

  // Vuelve a conectar listener del select
  attachSelectListener(newForm);
});

// Inicializa el listener del primer formulario
attachSelectListener(formsWrapper.firstElementChild);
