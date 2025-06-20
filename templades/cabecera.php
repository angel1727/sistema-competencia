<!doctype html>
<html lang="es">
    <head>
        <title>Direccion Tecnica de Acreditacion</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <style>
        .bg-orange {
            background-color: #f3a100 !important;
        }

        .navbar .nav-link {
            color: white !important;
        }

        .navbar .nav-link:hover {
            color: #000 !important;
        }

        .navbar-brand {
            color: white !important;
        }

        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.8)' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");

        }

        /* .nav-logout {
            background-color: white;
            color: #f3a100 !important;
            border-radius: 5px;
            padding: 5px 10px;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        .nav-logout:hover {
            background-color: #f3a100;
            color: white !important;
            text-shadow: 0 0 3px #fff;
        } */
        </style>
    </head>

    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-orange shadow-sm">
        <div class="container-fluid">
        <!-- Logo o Título -->
        <a class="navbar-brand d-flex align-items-center " href="#">
        <i class="bi bi-person-circle fs-4 me-2"></i>
        <span class="fw-bold">Panel Admin</span>
        </a>

        <!-- Botón para colapsar en pantallas pequeñas -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
        aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menú de navegación -->
        <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav ms-auto gap-2">
            <li class="nav-item">
            <a class="nav-link active" href="vista_usuario.php"><i class="bi bi-people-fill me-1"></i> Usuario</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="vista_postulantes.php"><i class="bi bi-person-lines-fill me-1"></i> Postulantes</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="vista_evaluador.php"><i class="bi bi-person-badge-fill me-1"></i> Líder Evaluador</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="vista_experto.php"><i class="bi bi-tools me-1"></i> Experto Técnico</a>
            </li>
            <!--<li class="nav-item">
            <a class="nav-link" href="vista_normas.php"><i class="bi bi-journal-text me-1"></i> Normas</a>
            </li>-->
            <li class="nav-item">
            <a class="nav-link text-warning" href="../index.php"><i class="bi bi-box-arrow-right me-1"></i> Cerrar Sesión</a>
            </li>
            </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
               
                <div class="row">

                   



