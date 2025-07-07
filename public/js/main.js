$(document).ready(function () {
    const $fechaInicio = $('#fechaInicio');
    const $fechaFin = $('#fechaFin');
    const $mensaje = $('#mensaje');
  
    function validarFechas() {
      const inicioVal = $fechaInicio.val();
      const finVal = $fechaFin.val();
  
      if (inicioVal && finVal) {
        const inicio = new Date(inicioVal);
        const fin = new Date(finVal);
  
        if (fin < inicio) {
          Swal.fire({
            icon: 'warning',
            title: 'Fechas inválidas',
            text: 'La fecha de fin no puede ser anterior a la fecha de inicio.',
          });
          $mensaje.text('La fecha de fin no puede ser anterior a la fecha de inicio.');
        } else {
          const diffMeses = (fin.getFullYear() - inicio.getFullYear()) * 12 + (fin.getMonth() - inicio.getMonth());
          $('input[name="Duracion"]').val(diffMeses);
          $mensaje.text('');
        }
      }
    }
  
    $fechaInicio.on('change', validarFechas);
    $fechaFin.on('change', validarFechas);
  
    // Etiqueta de archivos
    $("input[type='file']").on("change", function () {
      const $label = $(this).prev("label");
      const fileName = this.files.length > 1
        ? `${this.files.length} archivos seleccionados`
        : this.files[0].name;
  
      const labelText = $label.text().split(':')[0];
      $label.text(`${labelText}: ${fileName}`);
    });
  
    // Confirmación con SweetAlert
    $("form").on("submit", function (e) {
      e.preventDefault(); // Detener el envío inicial
  
      Swal.fire({
        title: '¿Está seguro?',
        text: '¿Desea enviar el formulario?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, enviar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          this.submit(); // Enviar formulario si el usuario confirma
        }
      });
    });
  });
  