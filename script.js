const addFormBtn = document.getElementById('addFormBtn');
const formsWrapper = document.getElementById('formsWrapper');

let formCount = 1;

// Función que genera campos dinámicos según selección
function generateExtraFields(selectValue) {
  const wrapper = document.createElement('div');
  wrapper.className = 'generated-fields';

  switch (selectValue) {
    case 'ISO_17025':
      wrapper.innerHTML = `
  <div class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Empresa actual</label>
      <input type="text" name="empresa" class="form-control" />
    </div>
    <div class="col-md-6">
      <label class="form-label">Dirección</label>
      <input type="text" name="empresa_direccion" class="form-control" />
    </div>
    <div class="col-md-6">
      <label class="form-label">Departamento</label>
      <input type="text" name="departamento" class="form-control" />
    </div>
    <div class="col-md-6">
      <label class="form-label">Teléfono</label>
      <input type="text" name="empresa_telefono" class="form-control" />
    </div>
    <div class="col-md-6">
      <label class="form-label">Email</label>
      <input type="email" name="empresa_email" class="form-control" />
    </div>
  </div>
`;

      break;

    case 'ISO_15189':
      wrapper.innerHTML = `
        <div id="formaciones-container">
              <!-- FORMULARIO INDIVIDUAL CLONABLE -->
              <div class="formacion-item p-3 mb-3 rounded">
                <div class="row g-3"
                    <div class="col-md-3">
                        <label class="form-label">Tipo de formación</label>
                        <input type="text" name="tipo_formacion" class="form-control" required />
                    </div>
                    <div class="col-md-9">
                        <label class="form-label">Tema</label>
                        <input type="text" name="Tema" class="form-control" required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Organismo que brindó la capacitación</label>
                        <input type="text" name="organismo_capacitacion" class="form-control" required />
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Fecha (AAAA-MM)</label>
                        <input type="text" name="fecha" class="form-control" required />
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Duración en horas</label>
                        <input type="text" name="duracion_horas" class="form-control" required />
                    </div>
                </div>

                  <!-- BOTONES -->
                  <div class="col-md-12">
                    <button type="button" class="btn btn-personalizado btn-agregar ">➕ Añadir Formulario</button>
                    <button type="button" class="btn btn-personalizado eliminar eliminar-formacion">🗑️ Eliminar
                      formulario</button>
                  </div>
                </div>
              </div>
            </div>
      `;
      break;

    case 'ISO_17065':
      wrapper.innerHTML = `
        <div class="form-group">
          <label>Producto certificado:</label>
          <input type="text" name="producto_certificado[]" required>
        </div>
      `;
      break;

    default:
      wrapper.innerHTML = ``;
  }

  return wrapper;
}

// Función que conecta un formulario con su select
function attachSelectListener(form) {
  const select = form.querySelector('select');
  const extraFieldsContainer = form.querySelector('.extra-fields');

  select.addEventListener('change', () => {
    extraFieldsContainer.innerHTML = ''; // Limpia anteriores
    const selectedValue = select.value;
    const newFields = generateExtraFields(selectedValue);
    extraFieldsContainer.appendChild(newFields);
  });
}

addFormBtn.addEventListener('click', () => {
  const firstForm = formsWrapper.firstElementChild;
  const newForm = firstForm.cloneNode(true);
  formCount++;

  // Limpia campos
  newForm.querySelectorAll('input, select').forEach(input => input.value = '');
  newForm.querySelector('.extra-fields').innerHTML = '';

  // Cambia el label del select
  const label = newForm.querySelector('label');
  if (label) {
    label.textContent = `Área ISO/IEC a postular ${formCount}`;
  }

  // Agrega botón de eliminar
  let removeBtn = document.createElement('button');
  removeBtn.textContent = 'Eliminar';
  removeBtn.className = 'removeFormBtn';
  removeBtn.addEventListener('click', () => {
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
