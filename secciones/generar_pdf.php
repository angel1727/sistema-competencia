<?php
require_once('../lib/TCPDF-main/tcpdf.php');
require_once __DIR__ . '/../configuraciones/bd.php';

// Verificar conexión
$conexion = BD::crearInstancia();
if (!$conexion) {
    die('No se pudo establecer conexión con la base de datos');
}

// Verificar ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('ID de postulante no válido');
}

$idPostulante = (int)$_GET['id'];

try {
    // Consulta para obtener postulante
    $sql = "SELECT * FROM postulante WHERE idpostulante = ?";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([$idPostulante]);
    $postulante = $consulta->fetch(PDO::FETCH_ASSOC);

    if (!$postulante) {
        die('Postulante no encontrado');
    }

    // Crear el PDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Configurar el documento
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('IBMETRO');
    $pdf->SetTitle('DTA-FOR-086 - Hoja de Vida');
    $pdf->SetSubject('Hoja de Vida del Postulante');
    $pdf->SetKeywords('DTA-FOR-086, Postulante, Hoja de Vida');

    // Agregar una página
    $pdf->AddPage();

    // Contenido del PDF
    $html = '
    <style>
        .header { text-align:center; font-weight:bold; font-size:16px; margin-bottom:10px; }
        .section-title { background-color:#f2f2f2; padding:5px; font-weight:bold; margin-top:10px; }
        .table { width:100%; border-collapse:collapse; margin-bottom:10px; }
        .table td, .table th { border:1px solid #ddd; padding:5px; }
        .table th { background-color:#f2f2f2; text-align:left; }
        .subtable { width:100%; border-collapse:collapse; margin:5px 0; }
        .subtable td { border:none; padding:3px; }
    </style>

    <div class="header">DTA-FOR-086 - HOJA DE VIDA</div>

    <div class="section-title">1. DATOS PERSONALES</div>
    <table class="table">
        <tr>
            <td width="25%"><strong>Nombres:</strong></td>
            <td width="25%">'.htmlspecialchars($postulante['nombre'] ?? '').'</td>
            <td width="25%"><strong>Apellidos:</strong></td>
            <td width="25%">'.htmlspecialchars($postulante['apellido'] ?? '').'</td>
        </tr>
        <tr>
            <td><strong>Cédula identidad:</strong></td>
            <td>'.htmlspecialchars($postulante['ci'] ?? '').'</td>
            <td><strong>Ciudad de residencia:</strong></td>
            <td>'.htmlspecialchars($postulante['ciudad'] ?? '').'</td>
        </tr>
        <tr>
            <td><strong>Dirección de residencia:</strong></td>
            <td>'.htmlspecialchars($postulante['direccion'] ?? '').'</td>
            <td><strong>Nacionalidad:</strong></td>
            <td>'.htmlspecialchars($postulante['nacionalidad'] ?? '').'</td>
        </tr>
        <tr>
            <td><strong>Teléfono móvil:</strong></td>
            <td>'.htmlspecialchars($postulante['celular'] ?? '').'</td>
            <td><strong>Teléfono fijo:</strong></td>
            <td>'.htmlspecialchars($postulante['telefono'] ?? '').'</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Email:</strong></td>
            <td colspan="2">'.htmlspecialchars($postulante['email'] ?? '').'</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Número de Identificación Tributaria (NIT):</strong></td>
            <td colspan="2">'.htmlspecialchars($postulante['nit'] ?? '').'</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Registro SIGEP:</strong></td>
            <td colspan="2">'.htmlspecialchars($postulante['sigep'] ?? '').'</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Matrícula de comercio:</strong></td>
            <td colspan="2">'.htmlspecialchars($postulante['matricula'] ?? '').'</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Nro. de seguro de salud:</strong></td>
            <td colspan="2">'.htmlspecialchars($postulante['seguro'] ?? '').'</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Seguro de riesgos contra accidentes:</strong></td>
            <td colspan="2">'.htmlspecialchars($postulante['sriesgos'] ?? '').'</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Fecha de registro:</strong></td>
            <td colspan="2">'.htmlspecialchars($postulante['fecha_registro'] ?? '').'</td>
        </tr>
    </table>';

    // Sección 2: Educación
    $sqlEducacion = "SELECT * FROM educacion WHERE idpostulante = ?";
    $consultaEducacion = $conexion->prepare($sqlEducacion);
    $consultaEducacion->execute([$idPostulante]);
    $educaciones = $consultaEducacion->fetchAll(PDO::FETCH_ASSOC);

    $html .= '<div class="section-title">2. EDUCACIÓN</div>';
    if (!empty($educaciones)) {
        foreach ($educaciones as $index => $edu) {
            $html .= '
            <table class="subtable">
                <tr>
                    <td width="30%"><strong>Nivel Académico:</strong></td>
                    <td width="70%">'.htmlspecialchars($edu['nivelaceademico'] ?? '').'</td>
                </tr>
                <tr>
                    <td><strong>Grado:</strong></td>
                    <td>'.htmlspecialchars($edu['grado'] ?? '').'</td>
                </tr>
                <tr>
                    <td><strong>Centro Educativo:</strong></td>
                    <td>'.htmlspecialchars($edu['centroeducativo'] ?? '').'</td>
                </tr>
                <tr>
                    <td><strong>Fecha de Título:</strong></td>
                    <td>'.htmlspecialchars($edu['fechatitulo'] ?? '').'</td>
                </tr>
            </table>';
            if ($index < count($educaciones) - 1) {
                $html .= '<hr style="margin:5px 0; border-top:1px dashed #ddd;">';
            }
        }
    } else {
        $html .= '<p>No se registraron datos de educación.</p>';
    }

    // Sección 3: Experiencia Laboral
    $sqlExpLaboral = "SELECT * FROM experiencialaboral WHERE idpostulante = ?";
    $consultaExpLaboral = $conexion->prepare($sqlExpLaboral);
    $consultaExpLaboral->execute([$idPostulante]);
    $experiencias = $consultaExpLaboral->fetchAll(PDO::FETCH_ASSOC);

    $html .= '<div class="section-title">3. EXPERIENCIA LABORAL</div>';
    if (!empty($experiencias)) {
        foreach ($experiencias as $index => $exp) {
            $html .= '
            <table class="subtable">
                <tr>
                    <td width="30%"><strong>Empresa:</strong></td>
                    <td width="70%">'.htmlspecialchars($exp['empresa'] ?? '').'</td>
                </tr>
                <tr>
                    <td><strong>Tipo de Organización:</strong></td>
                    <td>'.htmlspecialchars($exp['tipoOrganizacion'] ?? '').'</td>
                </tr>
                <tr>
                    <td><strong>Cargo:</strong></td>
                    <td>'.htmlspecialchars($exp['cargo'] ?? '').'</td>
                </tr>
                <tr>
                    <td><strong>Descripción:</strong></td>
                    <td>'.htmlspecialchars($exp['descripccion'] ?? '').'</td>
                </tr>
                <tr>
                    <td><strong>Desde:</strong></td>
                    <td>'.htmlspecialchars($exp['desde'] ?? '').'</td>
                </tr>
                <tr>
                    <td><strong>Hasta:</strong></td>
                    <td>'.htmlspecialchars($exp['hasta'] ?? '').'</td>
                </tr>
                <tr>
                    <td><strong>Duración (meses):</strong></td>
                    <td>'.htmlspecialchars($exp['duracion'] ?? '').'</td>
                </tr>
            </table>';
            if ($index < count($experiencias) - 1) {
                $html .= '<hr style="margin:5px 0; border-top:1px dashed #ddd;">';
            }
        }
    } else {
        $html .= '<p>No se registraron datos de experiencia laboral.</p>';
    }

    // Sección 4: Capacitación y Formación
    $sqlCapacitacion = "SELECT * FROM capacitacionformacion WHERE idpostulante = ?";
    $consultaCapacitacion = $conexion->prepare($sqlCapacitacion);
    $consultaCapacitacion->execute([$idPostulante]);
    $capacitaciones = $consultaCapacitacion->fetchAll(PDO::FETCH_ASSOC);

    $html .= '<div class="section-title">4. CAPACITACIÓN Y FORMACIÓN</div>';
    if (!empty($capacitaciones)) {
        foreach ($capacitaciones as $index => $cap) {
            $html .= '
            <table class="subtable">
                <tr>
                    <td width="30%"><strong>Tipo de Formación:</strong></td>
                    <td width="70%">'.htmlspecialchars($cap['tipoformacacion'] ?? '').'</td>
                </tr>
                <tr>
                    <td><strong>Tema:</strong></td>
                    <td>'.htmlspecialchars($cap['tema'] ?? '').'</td>
                </tr>
                <tr>
                    <td><strong>Organización Capacitadora:</strong></td>
                    <td>'.htmlspecialchars($cap['orgcapacitacion'] ?? '').'</td>
                </tr>
                <tr>
                    <td><strong>Fecha:</strong></td>
                    <td>'.htmlspecialchars($cap['fecha'] ?? '').'</td>
                </tr>
                <tr>
                    <td><strong>Duración (horas):</strong></td>
                    <td>'.htmlspecialchars($cap['duracionhoras'] ?? '').'</td>
                </tr>
            </table>';
            if ($index < count($capacitaciones) - 1) {
                $html .= '<hr style="margin:5px 0; border-top:1px dashed #ddd;">';
            }
        }
    } else {
        $html .= '<p>No se registraron datos de capacitación.</p>';
    }

    // Sección 5: Experiencia en Implementación
    $sqlImplementacion = "SELECT * FROM experienciaimpementacion WHERE idpostulante = ?";
    $consultaImplementacion = $conexion->prepare($sqlImplementacion);
    $consultaImplementacion->execute([$idPostulante]);
    $implementaciones = $consultaImplementacion->fetchAll(PDO::FETCH_ASSOC);

    $html .= '<div class="section-title">5. EXPERIENCIA EN IMPLEMENTACIÓN</div>';
    if (!empty($implementaciones)) {
        foreach ($implementaciones as $index => $imp) {
            $html .= '
            <table class="subtable">
                <tr>
                    <td width="30%"><strong>Organización:</strong></td>
                    <td width="70%">'.htmlspecialchars($imp['organizacioni'] ?? '').'</td>
                </tr>
                <tr>
                    <td><strong>Organización Beneficiada:</strong></td>
                    <td>'.htmlspecialchars($imp['orgbeneficiada'] ?? '').'</td>
                </tr>
                <tr>
                    <td><strong>Función:</strong></td>
                    <td>'.htmlspecialchars($imp['funcion'] ?? '').'</td>
                </tr>
                <tr>
                    <td><strong>Fecha:</strong></td>
                    <td>'.htmlspecialchars($imp['fecha'] ?? '').'</td>
                </tr>
                <tr>
                    <td><strong>Duración (horas):</strong></td>
                    <td>'.htmlspecialchars($imp['duracionhoras'] ?? '').'</td>
                </tr>
            </table>';
            if ($index < count($implementaciones) - 1) {
                $html .= '<hr style="margin:5px 0; border-top:1px dashed #ddd;">';
            }
        }
    } else {
        $html .= '<p>No se registraron datos de experiencia en implementación.</p>';
    }

    // Sección 6: Certificación de Persona (si aplica)
    $sqlCertPersona = "SELECT * FROM certificacionpersona WHERE idpostulante = ?";
    $consultaCertPersona = $conexion->prepare($sqlCertPersona);
    $consultaCertPersona->execute([$idPostulante]);
    $certificaciones = $consultaCertPersona->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($certificaciones)) {
        $html .= '<div class="section-title">6. CERTIFICACIÓN DE PERSONA</div>';
        foreach ($certificaciones as $index => $cert) {
            $html .= '
            <table class="subtable">
                <tr>
                    <td width="30%"><strong>Sector:</strong></td>
                    <td width="70%">'.htmlspecialchars($cert['secto'] ?? '').'</td>
                </tr>
                <tr>
                    <td><strong>Actividad:</strong></td>
                    <td>'.htmlspecialchars($cert['actividad'] ?? '').'</td>
                </tr>
                <tr>
                    <td><strong>Item:</strong></td>
                    <td>'.htmlspecialchars($cert['item'] ?? '').'</td>
                </tr>
                <tr>
                    <td><strong>Norma:</strong></td>
                    <td>'.htmlspecialchars($cert['norma'] ?? '').'</td>
                </tr>
                <tr>
                    <td><strong>Tiempo de Experiencia:</strong></td>
                    <td>'.htmlspecialchars($cert['tiempoexp'] ?? '').' meses</td>
                </tr>
            </table>';
            if ($index < count($certificaciones) - 1) {
                $html .= '<hr style="margin:5px 0; border-top:1px dashed #ddd;">';
            }
        }
    }

    // Escribir el HTML en el PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Generar y descargar el PDF
    $nombreArchivo = 'DTA-FOR-086_'.str_replace(' ', '_', $postulante['nombre']).'_'.str_replace(' ', '_', $postulante['apellido']).'.pdf';
    $pdf->Output($nombreArchivo, 'I');

} catch (Exception $e) {
    die('Error al generar el PDF: ' . $e->getMessage());
}
?>