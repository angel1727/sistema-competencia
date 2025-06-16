
            </div>
            </div>
        </div>
    </div>
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
            function cargarUsuario(id, nombre, apellido, usuario, password, correo) {
            document.getElementById('modal_id').value = id;
            document.getElementById('modal_nombre').value = nombre;
            document.getElementById('modal_apellido').value = apellido;
            document.getElementById('modal_usuario').value = usuario;
            document.getElementById('modal_password').value = password;
            document.getElementById('modal_correo').value = correo;

            // Cambiar acción del botón
            document.getElementById('btnGuardar').name = 'accion';
            document.getElementById('btnGuardar').value = 'editar_modal';
            document.getElementById('btnGuardar').innerHTML = '<i class="bi bi-save2-fill me-1"></i> Actualizar';
            }
        </script>

   
    </body>
</html>
