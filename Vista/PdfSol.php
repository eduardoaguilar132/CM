<?php
require '../Controlador/conexion.php';
require '../Recursos/fpdf/fpdf.php';




$conexion = conectar_db();

$id = isset($_GET['Id']) ? intval($_GET['Id']) : 0;
if ($id === 0) {
    die("ID inválido");
}

// Consulta principal a solicitud
$sql = "SELECT * FROM solicitud WHERE IdSol = $id";
$res = $conexion->query($sql);
if (!$res) {
    die("Error en la consulta de solicitud: " . $conexion->error);
}
$data = $res->fetch_assoc();
if (!$data) {
    die("No se encontró el registro con Id = $id en solicitud");
}
$firma_us = $data["FirmaS"];

// Consulta conjunta a las tres tablas: solicitud, revision y autorizacion
$sql3 = "
    SELECT 
        s.*, 
        r.*, 
        a.* 
    FROM solicitud s
    INNER JOIN revision r ON s.IdSol = r.IdSol
    INNER JOIN autorizacion a ON s.IdSol = a.IdSol
    WHERE s.IdSol = $id
";
$res3 = $conexion->query($sql3);
if (!$res3) {
    die("Error en la consulta conjunta: " . $conexion->error);
}

$data3 = $res3->fetch_assoc();
if (!$data3) {
    die("No se encontraron registros relacionados con el Id = $id");
}

// Puedes extraer los datos o firmas de cada tabla si los necesitas:
$firma_rev = $data3["FirmaRev"] ?? null;
$firma_aut = $data3["FirmaA"] ?? null;

// Aquí ya puedes usar $data3 en tu clase PDF o donde lo necesites




class PDF extends FPDF {
    public $data = [];
    public $data3 =[];
    
    

    function Header() {
        $this->SetY(10);
        $this->SetFont('Arial', '', 8);
        $this->Cell(35, 20, '', 1, 0);
        $this->Cell(115, 5, utf8_decode('Nombre del Documento:'), 'T', 0, 'L');
        $this->Cell(20, 10, utf8_decode('Versión:'), 1, 0, 'C');
        $this->Cell(25, 5, utf8_decode('Fecha de Emisión:'), "T+R", 1, 'C');

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(35, 5, '', 0, 0);
        $this->Cell(115, 5, utf8_decode('SOLICITUD DE CREACION, MODIFICACION'), 0, 0, 'C');
        $this->SetFont('Arial', '', 8);
        $this->Cell(20, 5, '07', 0, 0, 'C');
        $this->Cell(25, 5, utf8_decode('Enero 2025'), "R", 1, 'C');

        $this->Cell(35, 5, '', 0, 0);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(115, 5, utf8_decode('O ELIMINACION DE DOCUMENTO'), 0, 0, 'C');
        $this->SetFont('Arial', '', 8);
        $this->Cell(20, 5, utf8_decode('Hoja No.'), 1, 0, 'C');
        $this->Cell(25, 5, utf8_decode('De:'), 1, 1, 'C');

        $this->Cell(35, 5, '', 0, 0);
        $this->Cell(115, 5, utf8_decode('Fecha de Próxima Revisión: Enero 2026'), 1, 0, 'C');
        $this->Cell(20, 5, '1', 1, 0, 'C');
        $this->Cell(25, 5, '1', 1, 1, 'C');

        $this->Image('../Recursos/images/logo.png', 11, 11, 30);
        $this->Ln(8);
    }

    function cuerpo() {
        $d = $this->data;
        $c = $this->data3;

        $this->SetFont('Arial', '', 12);
        $this->Cell(125, 7, "", 0, 0);
        $this->Cell(65, 7, utf8_decode('No. De Control ' . $d['NC']), 0, 1);

        
       $this->Cell(100, 7, utf8_decode(''), 0, 0);
$this->Cell(95, 7, utf8_decode('Fecha: ' . date('d/m/Y', strtotime($d['FechaS']))), 0, 1);
$this->Cell(15, 5, '', 0, 1);

// CREACIÓN DE DOCUMENTO
$this->Cell(40, 4, 'CREACION', 0, 0, 'L');
$this->Cell(15, 4, ($d['TA'] == 1 ? 'X' : ''), "LRT", 0, 'C'); // X si TA = 1
$this->Cell(15, 4, '', 0, 0, 'C');

// MODIFICACIÓN DE DOCUMENTO
$this->Cell(40, 4, 'MODIFICACION', 0, 0, 'L');
$this->Cell(15, 4, ($d['TA'] == 2 ? 'X' : ''), 'LRT', 0, 'C'); // X si TA = 2
$this->Cell(15, 4, '', 0, 0, 'C');

// ELIMINACIÓN DE DOCUMENTO
$this->Cell(40, 4, 'ELIMINACION', 0, 0, 'L');
$this->Cell(15, 4, ($d['TA'] == 3 ? 'X' : ''), 'LRT', 1, 'C'); // X si TA = 3

// SEGUNDA FILA DE TEXTO
$this->Cell(40, 4, 'DE DOCUMENTO', 0, 0, 'L');
$this->Cell(15, 4, '', "LRB", 0, 'C');
$this->Cell(15, 4, '', 0, 0, 'C');
$this->Cell(40, 4, 'DE DOCUMENTO', 0, 0, 'L');
$this->Cell(15, 4, '', 'LRB', 0, 'C');
$this->Cell(15, 4, '', 0, 0, 'C');
$this->Cell(40, 4, 'DE DOCUMENTO', 0, 0, 'L');
$this->Cell(15, 4, '', 'LRB', 1, 'C');

        
        $this->Ln(10);
        





        $this->Cell(50, 7, utf8_decode('Nombre del documento:'), 0, 0);
        $this->Cell(120,7,utf8_decode( $d['ND']),'B',1);
        $this->Ln(5);
        $this->Cell(36, 4, utf8_decode('Version actual:'), 0, 0);
        $this->Cell(36,4,$d['VA'],'B',0,'C');
        $this->Cell(15,4,'',0,0);
        $this->Cell(36,4,utf8_decode('Version a la'),0,0);
        $this->Cell(36,4,$d['VC'],'B',1,'C');


        $this->Cell(36, 4,"", 0, 0);
        $this->Cell(36,4,"",0,0);
        $this->Cell(15,4,'',0,0);
        $this->Cell(36,4,utf8_decode('que cambia'),0,0);
        $this->Cell(36,4,"",0,0);
        $this->Ln(7);

        
        $this->Cell(65,4,'Razon del cambio o creacion del Documento:',0,1);
        $this->Multicell(200,40,utf8_decode($d['Razon']),0,1);


        
$this->Cell(40,7,'Persona que Solicita:',0,0);
$this->SetFont('Arial','I',10);
$this->Cell(43,7,'(Nombre, puesto y firma):',0,0);
$this->SetFont('Arial', '', 12);
$this->Cell(49,7,utf8_decode($d['Ns']),0,0);
$this->Cell(28,7,utf8_decode($d['Ps']),0,0);

// Firma (imagen desde el campo LONGBLOB)
if (!empty($d['FirmaS'])) {
    $tempFile = tempnam(sys_get_temp_dir(), 'sig_') . '.png';
    file_put_contents($tempFile, $d['FirmaS']);

    // Posición actual
    $x = $this->GetX();
    $y = $this->GetY() - 5; // Ajuste para alineación

    // --- AJUSTE DE TAMAÑO DE FIRMA ---
    $ancho = 60;  // antes 30
    $alto  = 25;  // antes 10
    // -------------------------------

    $this->Image($tempFile, $x, $y, $ancho, $alto);

    unlink($tempFile);
} else {
    $this->Cell(20,7,'(sin firma)',0,0,'C');
}

$this->Ln(12);


        $this->Cell(40,7,'Persona que Revisa:',0,0);
        $this->SetFont('Arial','I',10);
        $this->Cell(43,7,'(Nombre, puesto y firma):',0,0);
        $this->SetFont('Arial', '', 12);
        $this->Cell(49,7,utf8_decode($c['Nrev']),0,0);
        $this->Cell(28,7,utf8_decode($c['Pr']),0,0);
       // Firma (imagen desde el campo LONGBLOB)
if (!empty($c['FirmaRev'])) {
    $tempFile = tempnam(sys_get_temp_dir(), 'sig_') . '.png';
    file_put_contents($tempFile, $c['FirmaRev']);

    // Posición actual
    $x = $this->GetX();
    $y = $this->GetY() - 5; // Ajuste para alineación

    // --- AJUSTE DE TAMAÑO DE FIRMA ---
    $ancho = 60;  // antes 30
    $alto  = 25;  // antes 10
    // ---------------------------------

    $this->Image($tempFile, $x, $y, $ancho, $alto);

    unlink($tempFile);
} else {
    $this->Cell(20,7,'(sin firma)',0,0,'C');
}
        $this->Ln(12);

                    // PRIMER GRUPO DE SI / NO (Procede Solicitud)
            $si = ($c['Prev'] == 1) ? 'X' : '';
            $no = ($c['Prev'] == 0) ? 'X' : '';

            $this->Cell(50, 4, 'Procede Solicitud', 0, 0, 'L');

            // Casilla SI
            $this->Cell(15, 4, $si, "LRT", 0, 'C');
            $this->Cell(15, 4, '', 0, 0, 'C');

            // Casilla NO
            $this->Cell(40, 4, '', 0, 0, 'L');
            $this->Cell(15, 4, $no, 'LRT', 0, 'C');
            $this->Cell(15, 4, '', 0, 0, 'C');
            $this->Cell(35, 4, '', 0, 1, 'L');

            $this->Cell(50, 4, '', 0, 0, 'L');
            $this->Cell(15, 4, "Si", "LRB", 0, 'C');
            $this->Cell(15, 4, '', 0, 0, 'C');
            $this->Cell(40, 4, '', 0, 0, 'L');
            $this->Cell(15, 4, 'No', 'LRB', 0, 'C');
            $this->Cell(15, 4, '', 0, 0, 'C');
            $this->Cell(35, 4, '', 0, 1, 'L');



        $this->Ln(6);
        $this->Cell(40,7,'Persona que Autoriza:  ',0,0);
        $this->SetFont('Arial','I',10);
        $this->Cell(43,7,'  (Nombre, puesto y firma):',0,0);
        $this->SetFont('Arial', '', 12);
        $this->Cell(49,7,utf8_decode($c['NA']),0,0);
        $this->Cell(28,7,utf8_decode($c['PA']),0,0);
        // Firma de AUTORIZACIÓN (imagen desde el campo LONGBLOB)
if (!empty($c['FirmaA'])) {
    $tempFile = tempnam(sys_get_temp_dir(), 'sig_') . '.png';
    file_put_contents($tempFile, $c['FirmaA']);

    // Posición actual
    $x = $this->GetX();
    $y = $this->GetY() - 5; // ajuste para alineación

    // --- AJUSTE DE TAMAÑO DE FIRMA ---
    $ancho = 60;   // antes 30
    $alto  = 25;   // antes 10
    // ---------------------------------

    $this->Image($tempFile, $x, $y, $ancho, $alto);

    unlink($tempFile);
} else {
    $this->Cell(20,7,'(sin firma)',0,0,'C');
}



        $this->Ln(12);

   // SEGUNDO GRUPO DE SI / NO (Procede Solicitud)
            $si = ($c['PAA'] == 1) ? 'X' : '';
            $no = ($c['PAA'] == 0) ? 'X' : '';

            $this->Cell(50, 4, 'Procede Solicitud', 0, 0, 'L');

            // Casilla SI
            $this->Cell(15, 4, $si, "LRT", 0, 'C');
            $this->Cell(15, 4, '', 0, 0, 'C');

            // Casilla NO
            $this->Cell(40, 4, '', 0, 0, 'L');
            $this->Cell(15, 4, $no, 'LRT', 0, 'C');
            $this->Cell(15, 4, '', 0, 0, 'C');
            $this->Cell(35, 4, '', 0, 1, 'L');

            $this->Cell(50, 4, '', 0, 0, 'L');
            $this->Cell(15, 4, "Si", "LRB", 0, 'C');
            $this->Cell(15, 4, '', 0, 0, 'C');
            $this->Cell(40, 4, '', 0, 0, 'L');
            $this->Cell(15, 4, 'No', 'LRB', 0, 'C');
            $this->Cell(15, 4, '', 0, 0, 'C');
            $this->Cell(35, 4, '', 0, 1, 'L');
        $this->Ln(6);
         $this->Cell(65,4,'EN CASO DE NO PROCEDER LA SOLICITUD PROPUESTA, INDICA LA RAZON:',0,1);
        $this->Multicell(200,40,utf8_decode($c['RazonA']),0,1);
        $this->Ln(3);
      $this->SetAutoPageBreak(false);
$this->SetY(-10);
$this->Cell(0, 4, 'NOTA: FAVOR DE NO MODIFICAR ESTE FORMATO', 0, 0, 'L');

     
    }
    

    
}

// Generar el PDF
$pdf = new PDF('P', 'mm', 'Letter');
$pdf->data = $data;
$pdf->data3 = $data3;


$pdf->AddPage();
$pdf->cuerpo();

ob_end_clean(); // Limpia buffer de salida para evitar errores con FPDF
$pdf->Output('I', 'reporte_mantenimiento.pdf');
exit;
?>
