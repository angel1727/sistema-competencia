<?php
include_once '../configuraciones/bd.php';
$conexion = BD::crearInstancia();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['accion'] === 'agregar_completo') {
    try {
        $conexion->beginTransaction();

        function getPost($key, $default = null) {
            return isset($_POST[$key]) && $_POST[$key] !== '' ? $_POST[$key] : $default;
        }

        // POSTULANTE
        $stmt = $conexion->prepare("INSERT INTO postulante (nombre, apellido, ci, ciudad, direccion, email, celular, telefono, nit, sigep, matricula, seguro, sriesgos)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            getPost('nombre', ''), getPost('apellido', ''), getPost('ci'), getPost('ciudad'),
            getPost('direccion'), getPost('email'), getPost('celular'), getPost('telefono'),
            getPost('nit'), getPost('sigep'), getPost('matricula'), getPost('seguro'), getPost('sriesgos')
        ]);
        $idpostulante = $conexion->lastInsertId();

        // EDUCACION
        if (getPost('nivelaceademico') || getPost('grado') || getPost('centroeducativo')) {
            $stmt = $conexion->prepare("INSERT INTO educacion (nivelaceademico, grado, centroeducativo, fechatitulo, idpostulante) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([
                getPost('nivelaceademico'), getPost('grado'), getPost('centroeducativo'), getPost('fechatitulo'), $idpostulante
            ]);
        }

        // CAPACITACIONES
        if (!empty($_POST['iso_norma'])) {
            $stmt = $conexion->prepare("INSERT INTO capacitacionformacion (tipoformacacion, tema, orgcapacitacion, fecha, duracionhoras) VALUES (?, ?, ?, ?, ?)");
            foreach ($_POST['iso_norma'] as $i => $norma) {
                $stmt->execute([
                    $_POST['iso_detalle'][$i] ?? null,
                    $_POST['iso_institucion'][$i] ?? null,
                    $_POST['iso_ciudad'][$i] ?? null,
                    $_POST['iso_fecha'][$i] ?? null,
                    $_POST['iso_duracion'][$i] ?? 0
                ]);
            }
        }

        //INFORMACION DONDE TRABAJA ACTUALMENTE
        if (!empty($_POST['empresaactual'])) {
            $stmt = $conexion->prepare("INSERT INTO infolaboral (nomempresa, direccionL, departamento, celular, correo, cargo, tiempopermanencia, personareferencia, telefonoreferencia, descripcion, idpostulante)
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $_POST['nomempresa'], $_POST['direccionL'], $_POST['departamento'],
                $_POST['celular'], $_POST['correo'], $_POST['tiempopermanencia'], $_POST['personareferencia'], $_POST['telefonoreferencia'], $_POST['descripcion'], $idpostulante
            ]);
        }

        // EXPERIENCIA LABORAL
        if (!empty($_POST['empresa'])) {
            $stmt = $conexion->prepare("INSERT INTO experiencialaboral (empresa, tipoOrganizacion, cargo, descripccion, desde, hasta, duracion, idpostulante)
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            foreach ($_POST['empresa'] as $i => $empresa) {
                $stmt->execute([
                    $empresa, $_POST['tipoOrganizacion'][$i] ?? null, $_POST['cargo'][$i] ?? null,
                    $_POST['descripccion'][$i] ?? null, $_POST['desde'][$i] ?? null,
                    $_POST['hasta'][$i] ?? null, $_POST['duracion'][$i] ?? 0, $idpostulante
                ]);
            }
        }

        // AUDITORIAS
        if (!empty($_POST['organizaciont'])) {
            $stmt = $conexion->prepare("INSERT INTO experienciaaudiriat (organizaciont, orgevaluada, tipo, roldesignado, normaaplicada, fecha, duracionhoras, idpostulante)
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            foreach ($_POST['organizaciont'] as $i => $org) {
                $stmt->execute([
                    $org, $_POST['orevaluada'][$i] ?? null, $_POST['tipo'][$i] ?? null,
                    $_POST['roldesignado'][$i] ?? null, $_POST['normaaplicada'][$i] ?? null,
                    $_POST['fechaevaluacion'][$i] ?? null, $_POST['duracionhoras'][$i] ?? 0, $idpostulante
                ]);
            }
        }

        // IMPLEMENTACION
        if (!empty($_POST['organizacioni'])) {
            $stmt = $conexion->prepare("INSERT INTO experienciaimpementacion (organizacioni, orgbeneficiada, funcion, fecha, duracionhoras, idpostulante)
                                        VALUES (?, ?, ?, ?, ?, ?)");
            foreach ($_POST['organizacioni'] as $i => $org) {
                $stmt->execute([
                    $org, $_POST['orgbeneficiada'][$i] ?? null, $_POST['funcion'][$i] ?? null,
                    $_POST['fecha'][$i] ?? null, $_POST['duracionhoras'][$i] ?? 0, $idpostulante
                ]);
            }
        }

        // ESQUEMAS ISO

        // ISO/IEC 17025 - ENSAYO
        if (!empty($_POST['ensayo_17025'])) {
            $stmt = $conexion->prepare("INSERT INTO laboratorioensayo (ensayo, tecnica, norma, itemensato, tiempoexp) VALUES (?, ?, ?, ?, ?)");
            foreach ($_POST['ensayo_17025'] as $i => $ensayo) {
                $stmt->execute([
                    $ensayo, $_POST['tecnica_17025'][$i] ?? null, $_POST['norma_17025'][$i] ?? null,
                    $_POST['itemensato_17025'][$i] ?? null, $_POST['tiempoexp_17025'][$i] ?? 0
                ]);
                $idLapensayo = $conexion->lastInsertId();
                $stmtEsq = $conexion->prepare("INSERT INTO esquemas (idpostulante, idlapensayo) VALUES (?, ?)");
                $stmtEsq->execute([$idpostulante, $idLapensayo]);
            }
        }

        // ISO/IEC 17025 - CALIBRACION
        if (!empty($_POST['magnitud_17025'])) {
            $stmt = $conexion->prepare("INSERT INTO laboratoriocalibracion (magnitud, itemcalibracion, norma, tiempoexp) VALUES (?, ?, ?, ?)");
            foreach ($_POST['magnitud_17025'] as $i => $magnitud) {
                $stmt->execute([
                    $magnitud, $_POST['itemcalibracion_17025'][$i] ?? null, $_POST['norma_17025_cal'][$i] ?? null, $_POST['tiempoexp_17025_cal'][$i] ?? 0
                ]);
                $idLabCal = $conexion->lastInsertId();
                $stmtEsq = $conexion->prepare("INSERT INTO esquemas (idpostulante, idlabcalibracion) VALUES (?, ?)");
                $stmtEsq->execute([$idpostulante, $idLabCal]);
            }
        }

        // ISO/IEC 15189 - CLINICOS
        if (!empty($_POST['area_15189'])) {
            $stmt = $conexion->prepare("INSERT INTO laboratorioclinico (area, analisis, tecnica, muestra, tiempoexp) VALUES (?, ?, ?, ?, ?)");
            foreach ($_POST['area_15189'] as $i => $area) {
                $stmt->execute([
                    $area, $_POST['analisis_15189'][$i] ?? null, $_POST['tecnica_15189'][$i] ?? null,
                    $_POST['muestra_15189'][$i] ?? null, $_POST['tiempoexp_15189'][$i] ?? 0
                ]);
                $idLabClinico = $conexion->lastInsertId();
                $stmtEsq = $conexion->prepare("INSERT INTO esquemas (idpostulante, idlabclinico) VALUES (?, ?)");
                $stmtEsq->execute([$idpostulante, $idLabClinico]);
            }
        }

// ... [Todo el código anterior intacto] ...

        // ISO/IEC 17043 - Experto Técnico Estadístico (ETE)
        if (!empty($_POST['nombre_17043_ete'])) {
            $stmt = $conexion->prepare("INSERT INTO expertoestadistico (nombre, empresa, software, normas, tiempod) VALUES (?, ?, ?, ?, ?)");
            foreach ($_POST['nombre_17043_ete'] as $i => $nombre) {
                $stmt->execute([
                    $nombre, $_POST['empresa_17043_ete'][$i] ?? null, $_POST['software_17043_ete'][$i] ?? null,
                    $_POST['normas_17043_ete'][$i] ?? null, $_POST['tiempod_17043_ete'][$i] ?? 0
                ]);
                $idETE = $conexion->lastInsertId();
                $stmtEsq = $conexion->prepare("INSERT INTO esquemas (idpostulante, idete) VALUES (?, ?)");
                $stmtEsq->execute([$idpostulante, $idETE]);
            }
        }

        // ISO/IEC 17043 - Experto Técnico (ET)
        if (!empty($_POST['ensayo_17043_et'])) {
            $stmt = $conexion->prepare("INSERT INTO experto17043 (ensayo, tecnica, norma, itemensayo, tiempoexp) VALUES (?, ?, ?, ?, ?)");
            foreach ($_POST['ensayo_17043_et'] as $i => $ensayo) {
                $stmt->execute([
                    $ensayo, $_POST['tecnica_17043_et'][$i] ?? null, $_POST['norma_17043_et'][$i] ?? null,
                    $_POST['itemensayo_17043_et'][$i] ?? null, $_POST['tiempoexp_17043_et'][$i] ?? 0
                ]);
                $idET = $conexion->lastInsertId();
                $stmtEsq = $conexion->prepare("INSERT INTO esquemas (idpostulante, idet) VALUES (?, ?)");
                $stmtEsq->execute([$idpostulante, $idET]);
            }
        }

        // ISO/IEC 17020 - Inspección
        if (!empty($_POST['campo_17020'])) {
            $stmt = $conexion->prepare("INSERT INTO inspeccion (campo, subsector, item, metodo, tiempoexp) VALUES (?, ?, ?, ?, ?)");
            foreach ($_POST['campo_17020'] as $i => $campo) {
                $stmt->execute([
                    $campo, $_POST['sector_17020'][$i] ?? null, $_POST['iteminspeccion_17020'][$i] ?? null,
                    $_POST['metodo_17020'][$i] ?? null, $_POST['tiempoexp_17020'][$i] ?? 0
                ]);
                $idOI = $conexion->lastInsertId();
                $stmtEsq = $conexion->prepare("INSERT INTO esquemas (idpostulante, idoi) VALUES (?, ?)");
                $stmtEsq->execute([$idpostulante, $idOI]);
            }
        }

        // ISO/IEC 17065 - Certificación de Productos
        if (!empty($_POST['tipocert_17065'])) {
            $stmt = $conexion->prepare("INSERT INTO certprod (tipocert, producto, documento, division, codigo, tiempoexp) VALUES (?, ?, ?, ?, ?, ?)");
            foreach ($_POST['tipocert_17065'] as $i => $tipocert) {
                $stmt->execute([
                    $tipocert, $_POST['producto_17065'][$i] ?? null, $_POST['documentos_17065'][$i] ?? null,
                    $_POST['division_17065'][$i] ?? null, $_POST['codigo_17065'][$i] ?? null, $_POST['tiempoexp_17065'][$i] ?? 0
                ]);
                $idOCP = $conexion->lastInsertId();
                $stmtEsq = $conexion->prepare("INSERT INTO esquemas (idpostulante, idocp) VALUES (?, ?)");
                $stmtEsq->execute([$idpostulante, $idOCP]);
            }
        }

        // ISO/IEC 17021-1 - Certificación de Sistemas
        if (!empty($_POST['sisges_17021'])) {
            $stmt = $conexion->prepare("INSERT INTO certsistemas (sisges, norma, codigo, sector, tiempoexp) VALUES (?, ?, ?, ?, ?)");
            foreach ($_POST['sisges_17021'] as $i => $sisges) {
                $stmt->execute([
                    $sisges, $_POST['norma_17021'][$i] ?? null, $_POST['codigo_17021'][$i] ?? null,
                    $_POST['sector_17021'][$i] ?? null, $_POST['tiempoexp_17021'][$i] ?? 0
                ]);
                $idOCSG = $conexion->lastInsertId();
                $stmtEsq = $conexion->prepare("INSERT INTO esquemas (idpostulante, idocsg) VALUES (?, ?)");
                $stmtEsq->execute([$idpostulante, $idOCSG]);
            }
        }

        // ISO/IEC 17024 - Certificación de Personas
        if (!empty($_POST['sector_17024'])) {
            $stmt = $conexion->prepare("INSERT INTO certpersonas (sector, actividad, item, documento, tiempoexp) VALUES (?, ?, ?, ?, ?)");
            foreach ($_POST['sector_17024'] as $i => $sector) {
                $stmt->execute([
                    $sector, $_POST['actividad_17024'][$i] ?? null, $_POST['item_17024'][$i] ?? null,
                    $_POST['documento_17024'][$i] ?? null, $_POST['tiempoexp_17024'][$i] ?? 0
                ]);
                $idCP = $conexion->lastInsertId();
                $stmtEsq = $conexion->prepare("INSERT INTO esquemas (idpostulante, idcp) VALUES (?, ?)");
                $stmtEsq->execute([$idpostulante, $idCP]);
            }
        }

        // ISO/IEC 17034 - Proveedor de Materiales
        if (!empty($_POST['ensayo_17034'])) {
            $stmt = $conexion->prepare("INSERT INTO proveedor17034 (ensayo, tecnica, documento, item, norma, tiempoexp) VALUES (?, ?, ?, ?, ?, ?)");
            foreach ($_POST['ensayo_17034'] as $i => $ensayo) {
                $stmt->execute([
                    $ensayo, $_POST['tecnica_17034'][$i] ?? null, $_POST['documento_17034'][$i] ?? null,
                    $_POST['item_17034'][$i] ?? null, $_POST['norma_17034'][$i] ?? null, $_POST['tiempoexp_17034'][$i] ?? 0
                ]);
                $idPMR = $conexion->lastInsertId();
                $stmtEsq = $conexion->prepare("INSERT INTO esquemas (idpostulante, idpmr) VALUES (?, ?)");
                $stmtEsq->execute([$idpostulante, $idPMR]);
            }
        }

        $conexion->commit();
        echo '<script>Swal.fire("\u00c9xito", "Datos guardados correctamente", "success").then(() => { window.location.reload(); });</script>';
    } catch (Exception $e) {
        $conexion->rollBack();
        echo '<script>Swal.fire("Error", "Fallo al guardar: ' . $e->getMessage() . '", "error");</script>';
    }
}
?>

