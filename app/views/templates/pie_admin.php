
            </div>
            </div>
        </div>
    </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>

        
        <script>
            document.getElementById('normas').addEventListener('change', function () {
                const seleccionadas = Array.from(this.selectedOptions).map(opt => opt.value);
                const filas = document.querySelectorAll('#tablaEvaluadores tr');

                filas.forEach(fila => {
                const norma = fila.getAttribute('data-norma');
                fila.style.display = seleccionadas.length === 0 || seleccionadas.includes(norma) ? '' : 'none';
                });
            });
        </script>

        <script>
            document.getElementById('normas').addEventListener('change', function () {
                const seleccionadas = Array.from(this.selectedOptions).map(opt => opt.value);
                const filas = document.querySelectorAll('#tablaEvaluadores tr');

                filas.forEach(fila => {
                const norma = fila.getAttribute('data-norma');
                fila.style.display = seleccionadas.length === 0 || seleccionadas.includes(norma) ? '' : 'none';
                });
            });
        </script>

        <script>
            function cargarUsuario(id, nombre, apellido, usuario, password, correo, cargo, rol) {
            document.getElementById('modal_idusuario').value = id;
            document.getElementById('modal_nombre').value = nombre;
            document.getElementById('modal_apellido').value = apellido;
            document.getElementById('modal_usuario').value = usuario;
            document.getElementById('modal_password').value = password;
            document.getElementById('modal_correo').value = correo;
            document.getElementById('modal_cargo').value = cargo; // Asignar valor por defecto
            document.getElementById('modal_accion').value = 'editar_modal'; // Asignar valor por defecto
            document.getElementById('usuarioModalLabel').innerText = 'Editar Usuario'; // Cambiar título del modal
            
             // Limpiar checkboxes
            document.getElementById('administrador').checked = false;
            document.getElementById('subadministrador').checked = false;

            // Marcar checkboxes según el rol
            if (rol) {
                let roles = rol.split(',');
                if (roles.includes('administrador')) {
                    document.getElementById('administrador').checked = true;
                }
                if (roles.includes('subadministrador')) {
                    document.getElementById('subadministrador').checked = true;
                }
            }
            
            
            // Cambiar acción del botón
            document.getElementById('btnGuardar').name = 'accion';
            document.getElementById('btnGuardar').value = 'editar_modal';
            document.getElementById('btnGuardar').innerHTML = '<i class="bi bi-save2-fill me-1"></i> Actualizar';
            }

            

            document.querySelector('[data-bs-target="#usuarioModal"]').addEventListener('click', function() {
            // Limpiar campos para nuevo usuario
            document.getElementById('modal_idusuario').value = '';
            document.getElementById('modal_nombre').value = '';
            document.getElementById('modal_apellido').value = '';
            document.getElementById('modal_usuario').value = '';
            document.getElementById('modal_password').value = '';
            document.getElementById('modal_correo').value = '';
            document.getElementById('modal_cargo').value = '';
            document.getElementById('modal_accion').value = 'guardar_modal';
            document.getElementById('usuarioModalLabel').innerText = 'Agregar Usuario';
            });
        </script>

        <script>
            $(document).ready(function () {
            const tabla = $('#tablaUsuarios').DataTable({
                responsive: true,
                //dom: 'Bfrtip', // botones y filtros arriba
                //buttons: ['copy', 'excel', 'pdf', 'print'],
                language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                }
            });

            // Botón eliminar con AJAX
            $('#tablaUsuarios').on('click', '.eliminar-usuario', function () {
                const id = $(this).data('id');
                if (confirm('¿Eliminar usuario?')) {
                $.post('usuario.php', { accion: 'eliminar', id: id }, function (res) {
                    if (res === 'ok') {
                    tabla.row($('#fila-' + id)).remove().draw();
                    } else {
                    alert('Error al eliminar.');
                    }
                });
                }
            });

            // Botón editar con AJAX
            $('#tablaUsuarios').on('click', '.editar-usuario', function () {
                const id = $(this).data('id');
                $.post('usuario.php', { accion: 'obtener', id: id }, function (data) {
                const usuario = JSON.parse(data);
                $('#idusuario').val(usuario.idusuario);
                $('#nombre').val(usuario.nombre);
                $('#apellido').val(usuario.apellido);
                $('#usuario').val(usuario.usuario);
                $('#password').val(usuario.password);
                $('#correo').val(usuario.correo);
                $('#cargo').val(usuario.cargo);
                });
            });
            });
        </script>
        


   
    </body>
</html>
