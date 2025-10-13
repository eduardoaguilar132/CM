<?php
require '../Controlador/conexion.php';
require '../Recursos/fpdf/fpdf.php';


$conexion = conectar_db();

$id = isset($_GET['Id']) ? intval($_GET['Id']) : 0;
if ($id === 0) {
    die("ID inválido");
}

// Consulta a manttohs
$sql = "SELECT * FROM solicitud WHERE IdSol = $id";
$res = $conexion->query($sql);
if (!$res) {
    die("Error en la consulta: " . $conexion->error);
}
$data = $res->fetch_assoc();
$firma_us= $data["FirmaS"];
if (!$data) {
    die("No se encontró el registro con Id = $id");
}



class PDF extends FPDF {
    public $data = [];
    
    

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

        $this->SetFont('Arial', '', 12);
        $this->Cell(125, 7, "", 0, 0);
        $this->Cell(65, 7, utf8_decode('No. De Control ' . $d['NoEquipo']), 0, 1);

        
        $this->Cell(100, 7, utf8_decode(''), 0, 0);
        $this->Cell(95, 7, utf8_decode('Fecha: ' . date('d/m/Y', strtotime($d['FechaS']))), 0, 1);
        $this->Cell(15, 5, "", 0, 1);
        $this->Cell(35, 4, 'CREACION DE', 0, 0, 'L');
        $this->Cell(15, 4, "", "LRT", 0, 'C');
        $this->Cell(15, 4, '', 0, 0, 'C');
        $this->Cell(40, 4, 'MODIFICACION', 0, 0, 'L');
        $this->Cell(15, 4, '', 'LRT', 0, 'C');
        $this->Cell(15, 4, '', 0, 0, 'C');
        $this->Cell(35, 4, 'ELIMINACION DE', 0, 0, 'L');
        $this->Cell(15, 4, '', 'LRT', 1, 'C');
        $this->Cell(35, 4, 'DOCUMENTO', 0, 0, 'L');
        $this->Cell(15, 4, "", "LRB", 0, 'C');
        $this->Cell(15, 4, '', 0, 0, 'C');
        $this->Cell(40, 4, 'DE DOCUMENTO', 0, 0, 'L');
        $this->Cell(15, 4, '', 'LRB', 0, 'C');
        $this->Cell(15, 4, '', 0, 0, 'C');
        $this->Cell(35, 4, 'DOCUMENTO', 0, 0, 'L');
        $this->Cell(15, 4, '', 'LRB', 1, 'C');
        
        $this->Ln(10);
        





        $this->Cell(50, 7, utf8_decode('Nombre del documento:'), 0, 0);
        $this->Cell(50,7,"",0,1);
        $this->Ln(5);
        $this->Cell(65, 4, utf8_decode('Version actual:'), 0, 0);
        $this->Cell(30,4,"",0,0);
        $this->Cell(65,4,utf8_decode('Version a la'),0,0);
        $this->Cell(65,4,"",0,1);
        $this->Cell(65, 4,"", 0, 0);
        $this->Cell(30,4,"",0,0);
        $this->Cell(65,4,utf8_decode('que cambia'),0,0);
        $this->Cell(65,4,"",0,0);
        $this->Ln(8);
        $this->Cell(65,4,'Razon del cambio o creacion del Documento:',0,1);
        $this->Multicell(200,40,utf8_decode(''),0,1);

        $this->Cell(20,7,'Persona que Solicita',0,0);


     
    }

    function firmas($usuario, $firmaBlob, $firmaSisBlob) {
        $this->SetX(20);
        $this->SetFont('Arial', '', 9);
        $this->SetTextColor(0, 0, 0);

        $boxW = 80;
        $boxH = 30;
        $x1 = $this->GetX();
        $y1 = $this->GetY();

        // Usuario
        $this->Rect($x1, $y1, $boxW, $boxH);
        $this->SetXY($x1, $y1 + 3);
        $this->Cell($boxW, 5, utf8_decode('Usuario'), 0, 2, 'C');
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($boxW, 5, utf8_decode($usuario), 0, 2, 'C');
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(150, 150, 150);
        $this->Cell($boxW, 5, utf8_decode('Firma'), 0, 0, 'C');

        if (!empty($firmaBlob)) {
            $tempFile = tempnam(sys_get_temp_dir(), 'sig_') . '.png';
            file_put_contents($tempFile, $firmaBlob);
            $this->Image($tempFile, $x1 + 10, $y1 + 12, 60, 15);
            unlink($tempFile);
        }

        // Ingeniero
        $this->SetTextColor(0, 0, 0);
        $x2 = $x1 + $boxW + 20;
        $this->SetXY($x2, $y1);
        $this->Rect($x2, $y1, $boxW, $boxH);
        $this->SetXY($x2, $y1 + 3);
        $this->Cell($boxW, 5, utf8_decode('Ingeniero de Sistemas'), 0, 2, 'C');
        $this->SetFont('Arial', 'B', 9);
        $this->Cell($boxW, 5, utf8_decode($this->nombreIngeniero), 0, 2, 'C'); // Aquí usamos la variable dinámica
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(150, 150, 150);
        $this->Cell($boxW, 5, utf8_decode('Firma'), 0, 1, 'C');

        if (!empty($firmaSisBlob)) {
            $tempFileSis = tempnam(sys_get_temp_dir(), 'sigsis_') . '.png';
            file_put_contents($tempFileSis, $firmaSisBlob);
            $this->Image($tempFileSis, $x2 + 10, $y1 + 12, 60, 15);
            unlink($tempFileSis);
        }
    }
}

// Generar el PDF
$pdf = new PDF('P', 'mm', 'Letter');
$pdf->data = $data;


$pdf->AddPage();
$pdf->cuerpo();

ob_end_clean(); // Limpia buffer de salida para evitar errores con FPDF
$pdf->Output('I', 'reporte_mantenimiento.pdf');
exit;
?>
