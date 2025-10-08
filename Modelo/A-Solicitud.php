<?php
include("../Controlador/conexion.php");
$conexion = conectar_db();
$null     = NULL;
$Empresa = $_POST["empresa"];
$Ns      = $_POST['nombre'];
$Area    = $_POST["area"];
$Ps      = $_POST['puesto'];
$ND      = $_POST["nombred"];
$FechaS  = $_POST['fecha'];
$TA      = $_POST["r1"];
$VA      = $_POST["ver1"];
$VC      = $_POST["ver2"];
$Razon   = $_POST["razonm"];
$FirmaS  = $_POST["firma"];
 // Recibimos la firma en base64

// Convertir firma base64 a binario
$firmaBinaria = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $FirmaS));

    // Usamos prepare para poder insertar el blob
    $stmt = $conexion->prepare("INSERT INTO solicitud (
        Empresa, Ns, Area, Ps, ND,FechaS, TA, VA, VC, Razon, FirmaS
    ) VALUES (
        ?, ?, ?, ?, ?, ?, ?, ?,
        ?, ?,?
    )");

    $stmt->bind_param(
        "ssssssssssb",
        $Empresa, $Ns, $Area ,$Ps, $ND ,$FechaS, $TA, $VA, $VC, $Razon, 
        $null
    );

    $stmt->send_long_data(10, $firmaBinaria); // índice del parámetro firma

    if ($stmt->execute()) {
        $IdSol= $conexion->insert_id;
        echo "<script>alert('Solicitud capturada correctamente');</script>";
    } else {    
        echo "Error al guardar: " . $stmt->error;
    }

    $stmt->close();

?>
<body>
<script type="text/javascript">
    window.location = "../index.html";
</script>
</body>
