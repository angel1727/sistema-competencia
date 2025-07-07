  // document.addEventListener("DOMContentLoaded", function () {
  //   const container = document.getElementById("formaciones-container");
  //   let contador = 1;

  //   //Función para mostrar/ocultar botones "Eliminar"
  //   function actualizarVisibilidadBotonesEliminar() {
  //     const items = container.querySelectorAll(".formacion-item");
  //     items.forEach((item, index) => {
  //       const btnEliminar = item.querySelector(".eliminar-formacion");
  //       if (btnEliminar) {
  //         btnEliminar.style.display = index === 0 ? "none" : "inline-block";
  //       }
  //     });
  //   }

  //   //Función para mostrar solo el botón "Añadir" en el último formulario
  //   function actualizarVisibilidadBotonesAgregar() {
  //     const items = container.querySelectorAll(".formacion-item");
  //     items.forEach((item, index) => {
  //       const btnAgregar = item.querySelector(".btn-agregar");
  //       if (btnAgregar) {
  //         btnAgregar.style.display = index === items.length - 1 ? "inline-block" : "none";
  //       }
  //     });
  //   }

  //   container.addEventListener("click", function (e) {
  //     const target = e.target;

  //     // Añadir nuevo formulario
  //     if (target.classList.contains("btn-agregar")) {
  //       const itemActual = target.closest(".formacion-item");
  //       const clon = itemActual.cloneNode(true);

  //       // Limpiar valores y actualizar nombre de radios
  //       clon.querySelectorAll("input").forEach(input => {
  //         if (input.type === "radio") {
  //           input.checked = false;
  //           input.name = "nivel_radio_" + contador;
  //         } else {
  //           input.value = "";
  //         }
  //       });

  //       container.appendChild(clon);
  //       contador++;

  //       actualizarVisibilidadBotonesEliminar();
  //       actualizarVisibilidadBotonesAgregar();

  //       // Scroll a "Nivel Académico" del nuevo
  //       const labelNivel = clon.querySelector('label.form-label.d-block');
  //       if (labelNivel) {
  //         labelNivel.scrollIntoView({ behavior: "smooth", block: "center" });
  //       }
  //     }

  //     // Eliminar formulario
  //     if (target.classList.contains("eliminar-formacion")) {
  //       const items = container.querySelectorAll(".formacion-item");
  //       if (items.length > 1) {
  //         target.closest(".formacion-item").remove();

  //         actualizarVisibilidadBotonesEliminar();
  //         actualizarVisibilidadBotonesAgregar();

  //         // Scroll al último "Nivel Académico"
  //         const ultimosItems = container.querySelectorAll(".formacion-item");
  //         const ultimoItem = ultimosItems[ultimosItems.length - 1];
  //         if (ultimoItem) {
  //           const labelUltimo = ultimoItem.querySelector('label.form-label.d-block');
  //           if (labelUltimo) {
  //             labelUltimo.scrollIntoView({ behavior: "smooth", block: "center" });
  //           }
  //         }
  //       } else {
  //         alert("Debe haber al menos un formulario.");
  //       }
  //     }
  //   });

  //   // 👇 Ejecutar al inicio
  //   actualizarVisibilidadBotonesEliminar();
  //   actualizarVisibilidadBotonesAgregar();
  // });

  document.addEventListener("DOMContentLoaded", function () {
    // Selecciona todos los contenedores
    const todosLosContenedores = document.querySelectorAll('[id^="formaciones-container"]');

    todosLosContenedores.forEach(container => {
      function actualizarBotones() {
        const items = container.querySelectorAll(".formacion-item");
        items.forEach((item, index) => {
          const btnAgregar = item.querySelector(".btn-agregar");
          const btnEliminar = item.querySelector(".eliminar-formacion");
          btnAgregar.style.display = (index === items.length - 1) ? "inline-block" : "none";
          btnEliminar.style.display = (items.length > 1) ? "inline-block" : "none";
        });
      }

      container.addEventListener("click", function (e) {
        const target = e.target;

        if (target.classList.contains("btn-agregar")) {
          const itemActual = target.closest(".formacion-item");
          const clon = itemActual.cloneNode(true);

          clon.querySelectorAll("input, textarea").forEach(input => input.value = "");
          container.appendChild(clon);

          actualizarBotones();

          clon.scrollIntoView({ behavior: "smooth", block: "center" });
          const inputEmpresa = clon.querySelector('input[name="empresa_institucion"]');
          if (inputEmpresa) inputEmpresa.focus();
        }

        if (target.classList.contains("eliminar-formacion")) {
          const items = container.querySelectorAll(".formacion-item");
          if (items.length > 1) {
            const itemActual = target.closest(".formacion-item");
            const itemsArray = Array.from(items);
            const index = itemsArray.indexOf(itemActual);

            itemActual.remove();
            actualizarBotones();

            const nuevosItems = container.querySelectorAll(".formacion-item");
            const focoItem = nuevosItems[Math.max(0, index - 1)];
            if (focoItem) {
              const inputEmpresa = focoItem.querySelector('input[name="empresa_institucion"]');
              if (inputEmpresa) {
                inputEmpresa.focus();
                inputEmpresa.scrollIntoView({ behavior: "smooth", block: "center" });
              }
            }
          } else {
            alert("Debe haber al menos un formulario.");
          }
        }
      });

      actualizarBotones();
    });
  });