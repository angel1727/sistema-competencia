<?php
// Script to handle Hoja de Vida form submission
// session_start(); // No longer strictly needed here if not redirecting back with session messages for formulariop.html

include_once 'configuraciones/bd.php'; // Include the database configuration

// Function to display a message page and exit
function display_message_page($title, $message, $is_error = false) {
    $page_title = $is_error ? "Error" : "Éxito";
    $alert_class = $is_error ? "alert-danger" : "alert-success";
    echo <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$page_title} - Sistema de Postulación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; align-items: center; justify-content: center; min-height: 100vh; background-color: #f8f9fa; }
        .message-container { max-width: 600px; padding: 2rem; background-color: #fff; border-radius: 0.5rem; box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1); }
        .message-container h1 { margin-bottom: 1rem; }
    </style>
</head>
<body>
    <div class="container message-container text-center">
        <h1>{$title}</h1>
        <div class="alert {$alert_class}" role="alert">
            {$message}
        </div>
        <a href="landing.html" class="btn btn-primary mt-3">Volver a la Página Principal</a>
        <a href="formulariop.html" class="btn btn-secondary mt-3">Volver al Formulario</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
HTML;
    exit;
}

// Instantiate the database connection
$conexion = BD::crearInstancia();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $nombres = $_POST['nombres'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $ci = $_POST['ci'] ?? '';
    $ciudad = $_POST['ciudad'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $nacionalidad = $_POST['nacionalidad'] ?? '';
    $telefono_movil = $_POST['telefono_movil'] ?? '';
    $telefono_fijo = $_POST['telefono_fijo'] ?? '';
    $email = $_POST['email'] ?? '';
    $nit = $_POST['nit'] ?? null;
    $registro_sigep = $_POST['sigep'] ?? null;
    $matricula_comercio = $_POST['matricula_comercio'] ?? null;
    $seguro_salud = $_POST['seguro_salud'] ?? null;
    $seguro_riesgo = $_POST['seguro_riesgo'] ?? null;

    // Basic server-side validation
    $errors = [];
    if (empty($nombres)) {
        $errors[] = "El campo 'nombres' es obligatorio.";
    }
    if (empty($apellidos)) {
        $errors[] = "El campo 'apellidos' es obligatorio.";
    }
    if (empty($ci)) {
        $errors[] = "El campo 'cédula de identidad' es obligatorio.";
    }
    if (empty($email)) {
        $errors[] = "El campo 'email' es obligatorio.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "El formato del 'email' no es válido.";
    }

    // If there are validation errors
    if (!empty($errors)) {
        $error_message = "<strong>Errores de validación:</strong><ul class='list-unstyled'>";
        foreach ($errors as $error) {
            $error_message .= "<li>" . htmlspecialchars($error) . "</li>";
        }
        $error_message .= "</ul>Por favor, corrija los errores e intente nuevamente.";
        // To preserve form data on validation error, we'd ideally redirect with session data.
        // However, the requirement is to display a simple HTML page.
        // For a better UX, one would typically use sessions to repopulate the form.
        // For this step, we are just showing the error.
        display_message_page("Error de Validación", $error_message, true);
    } else {
        // Proceed with database insertion
        try {
            $sql = "INSERT INTO postulantes (nombre, apellido, ci, ciudad, direccion, nacionalidad, telefono_movil, telefono_fijo, email, nit, registro_sigep, matricula_comercio, seguro_salud, seguro_riesgo)
                    VALUES (:nombre, :apellido, :ci, :ciudad, :direccion, :nacionalidad, :telefono_movil, :telefono_fijo, :email, :nit, :registro_sigep, :matricula_comercio, :seguro_salud, :seguro_riesgo)";

            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':nombre', $nombres);
            $stmt->bindParam(':apellido', $apellidos);
            $stmt->bindParam(':ci', $ci);
            $stmt->bindParam(':ciudad', $ciudad);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':nacionalidad', $nacionalidad);
            $stmt->bindParam(':telefono_movil', $telefono_movil);
            $stmt->bindParam(':telefono_fijo', $telefono_fijo);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':nit', $nit);
            $stmt->bindParam(':registro_sigep', $registro_sigep);
            $stmt->bindParam(':matricula_comercio', $matricula_comercio);
            $stmt->bindParam(':seguro_salud', $seguro_salud);
            $stmt->bindParam(':seguro_riesgo', $seguro_riesgo);

            if ($stmt->execute()) {
                $idPostulante = $conexion->lastInsertId();
                // Success message
                $success_message = "Sus datos personales han sido guardados correctamente. <br>Su ID de Postulante es: <strong>" . htmlspecialchars($idPostulante) . "</strong>. <br>Guarde este ID para futuras referencias. <br><br>El siguiente paso es subir sus documentos.";
                // Store $idPostulante in session if it's needed for the next step (e.g., document upload page)
                session_start(); // Start session here if needed for next steps
                $_SESSION['idPostulante'] = $idPostulante;
                display_message_page("Registro Exitoso", $success_message);
            } else {
                $errorInfo = $stmt->errorInfo();
                display_message_page("Error de Base de Datos", "Error al guardar los datos en la base de datos. <br>Detalle: " . htmlspecialchars($errorInfo[2] ?? 'Error desconocido'), true);
            }

        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage()); // Log error for server admin
            display_message_page("Error Crítico de Base de Datos", "Ocurrió un error crítico al procesar su solicitud. Por favor, intente más tarde. <br>Detalle: " . htmlspecialchars($e->getMessage()), true);
        }
    }

} else {
    // Handle cases where the request method is not POST
    display_message_page("Acceso No Permitido", "Esta página no puede ser accedida directamente.", true);
}

?>