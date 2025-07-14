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
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        .bg-orange {
            background-color: #f3a100 !important;
        }
        /* Sidebar fijo */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background-color: #f3a100;
            padding-top: 1rem;
            color: white;
        }

        .sidebar .nav-link {
            color: white;
            padding: 0.75rem 1rem;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: black !important;
        }

        .sidebar .navbar-brand {
            font-weight: bold;
            padding: 0 1rem;
            color: white;
        }

        /* Contenido desplazado a la derecha */
        .main-content {
            margin-left: 250px;
            padding: 1rem;
        }

        .ibmetro-logo {
        max-width: 200px;
        margin: 350px 0 auto;
        border: 2px solid white;
        }

        .card-selectable:hover {
        transform: scale(1.02);
        box-shadow: 0 0 15px rgba(0, 123, 255, 0.2);
        cursor: pointer;
        }

    .bg-orange {
        background-color: #f3a100 !important;
    }
    
    /* Sidebar fijo */
    .sidebar {
        width: 250px;
        height: 100vh;
        position: fixed;
        background-color: #f3a100;
        padding-top: 1rem;
        color: white;
        transition: transform 0.3s ease;
        z-index: 1000;
    }

    .sidebar .nav-link {
        color: white;
        padding: 0.75rem 1rem;
    }

    .sidebar .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: black !important;
    }

    .sidebar .navbar-brand {
        font-weight: bold;
        padding: 0 1rem;
        color: white;
    }

    /* Contenido desplazado a la derecha */
    .main-content {
        margin-left: 250px;
        padding: 1rem;
        transition: margin-left 0.3s ease;
    }

    .ibmetro-logo {
        max-width: 200px;
        margin: 350px 0 auto;
        border: 2px solid white;
    }

    .card-selectable:hover {
        transform: scale(1.02);
        box-shadow: 0 0 15px rgba(0, 123, 255, 0.2);
        cursor: pointer;
    }

    /* Botón de menú hamburguesa */
    .menu-toggle {
        display: none;
        position: fixed;
        top: 10px;
        left: 10px;
        z-index: 1100;
        background: #f3a100;
        color: white;
        border: none;
        font-size: 1.5rem;
        padding: 5px 10px;
        border-radius: 5px;
    }

    /* Media queries para responsividad */
    @media (max-width: 992px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .main-content {
            margin-left: 0;
        }

        .menu-toggle {
            display: block;
        }

        .ibmetro-logo {
            margin: 50px 0 auto;
        }
    }
    #mapaEvaluadores {
    height: 100%;
    min-height: 250px;
    border-radius: 0.25rem;
    overflow: hidden;
}

/* Para Leaflet */
.leaflet-container {
    background: #e9ecef;
}
</style>

    </head>

    <body>
    <button class="menu-toggle" id="menuToggle">
    <i class="bi bi-list"></i>
</button>
    
<!-- Sidebar lateral -->
<div class="sidebar">
    <a class="navbar-brand d-flex align-items-center mb-4" href="#">
        <i class="bi bi-person-circle fs-4 me-2"></i>
        <span class="fw-bold">Panel Admin</span>
    </a>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="vista_usuario.php"><i class="bi bi-people-fill me-2"></i> Usuario</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="vista_postulantes.php"><i class="bi bi-person-lines-fill me-2"></i> Postulantes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="vista_evaluador.php"><i class="bi bi-person-badge-fill me-2"></i> Líder Evaluador</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="vista_experto.php"><i class="bi bi-tools me-2"></i> Experto Técnico</a>
        </li>
        <li class="nav-item mt-auto">
            <a class="nav-link text-warning" href="../index.php"><i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión</a>
        </li>
    </ul>

    <div class="text-center p-3">
    <img src="../img/acreditacion.png" alt="IBMETRO" class="img-fluid ibmetro-logo">
    </div>
</div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">

        

