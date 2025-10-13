<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Bienvenido</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../Recursos/assets/favicon.ico" />
        <!-- Custom Google font-->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../Recursos/css/styles.css" rel="stylesheet" />
       
        <style>
  canvas {
    border: 2px solid #000;
    display: block;
    margin-bottom: 10px;
    touch-action: none; /* Habilita dibujo con el dedo o stylus */
  }
</style>
    </head>
    <body class="d-flex flex-column h-100 bg-light">
        <main class="flex-shrink-0">
            <!-- Navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
                <div class="container px-5">
                    <a class="navbar-brand" href="../index.html"><span class="fw-bolder text-primary">PLANELEC</span></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    
                </div>
            </nav>
            <!-- Page Content-->
            <div class="container px-10 my-10">
                <div class="text-center mb-10">
                    <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Solicitudes </span></h1>
                </div>
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-15 col-xl-15 col-xxl-15">
                                

<div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-exportable dataTable">
                                    <thead>
                                        <tr>
                                            <th>Id de la solicitud</th>
                                            <th>Estatus</th>
                                            <th>Numero de Control interno</th>
                                            <th>Empresa </th>
                                            <th>Nombre</th>
                                            <th>Area</th>
                                            <th>Puesto</th>
                                            <th>Nombre del Documento</th>
                                            <th>Fecha</th>
                                            <th>Tipo accion</th>
                                            <th>Version Anterior</th>
                                            <th>Version a la que Cambia</th>
                                            <th>Razon</th> 
                                            <th>Revision</th>
                                            <th>Autorizacion</th>
                                            <th>Reporte Pdf</th>
                                           
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Id de la solicitud</th>
                                            <th>Estatus</th>
                                            <th>Numero de Control interno</th>
                                            <th>Empresa </th>
                                            <th>Nombre</th>
                                            <th>Area</th>
                                            <th>Puesto</th>
                                            <th>Nombre del Documento</th>
                                            <th>Fecha</th>
                                            <th>Tipo accion</th>
                                            <th>Version Anterior</th>
                                            <th>Version a la que Cambia</th>
                                            <th>Razon</th>
                                            <th>Revision</th>
                                            <th>Autorizacion</th>
                                            <th>Reporte Pdf</th>

                                           
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
require_once "../Controlador/conexion.php";
$conexion = conectar_db();

$query = "SELECT * FROM solicitud";
$consulta1 = $conexion->query($query);

while ($fila = $consulta1->fetch_assoc()) {

    // Determinar texto y color de fondo según el estatus
    $estatus_texto = "";
    $bg_color = "";

    switch ($fila['Estatus']) {
        case 0:
            $estatus_texto = "Abierto";
            $bg_color = "bg-danger"; // rojo
            break;
        case 1:
            $estatus_texto = "En proceso";
            $bg_color = "bg-warning"; // amarillo
            break;
        case 2:
            $estatus_texto = "Cerrado";
            $bg_color = "bg-success"; // verde
            break;
        default:
            $estatus_texto = "Desconocido";
            $bg_color = "bg-secondary"; // gris
            break;
    }

    // Determinar texto para TA
    switch ($fila['TA']) {
        case 1:
            $tipo_accion = "Creación";
            break;
        case 2:
            $tipo_accion = "Modificación";
            break;
        case 3:
            $tipo_accion = "Eliminación";
            break;
        default:
            $tipo_accion = "Desconocido";
            break;
    }

    echo "<tr>
   
         <td>{$fila['IdSol']}</td>
        <td class='$bg_color text-dark fw-bold text-center'>{$estatus_texto}</td>
        <td>{$fila['NC']}</td>
        <td>{$fila['Empresa']}</td>
        <td>{$fila['Ns']}</td>
        <td>{$fila['Area']}</td>
        <td>{$fila['Ps']}</td>
        <td>{$fila['ND']}</td>
        <td>{$fila['FechaS']}</td>
        <td>{$tipo_accion}</td>
        <td>{$fila['VA']}</td>
        <td>{$fila['VC']}</td>
        <td>{$fila['Razon']}</td>
        <td align='center'>                
        <a href='A-revision.php?Id=".$fila['IdSol']."'><button type='button' class='btn btn-success'>Revision</button></a>
        </td>
        <td align='center'>                
        <a href='A-autorizacion.php?Id=".$fila['IdSol']."'><button type='button' class='btn btn-success'>Autorizacion</button></a>
        </td>
        <td align='center'>                
        <a href='PdfSol.php?Id=".$fila['IdSol']."'><button type='button' class='btn btn-success'>Formato PDF</button></a>
        </td>
        
    </tr>";
}

?>


                                    </tbody>
                                </table>
                                 
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer-->
        <footer class="bg-white py-4 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0">Copyright &copy; Your Website 2023</div></div>
                    <div class="col-auto">
                        <a class="small" href="#!">Privacy</a>
                        <span class="mx-1">&middot;</span>
                        <a class="small" href="#!">Terms</a>
                        <span class="mx-1">&middot;</span>
                        <a class="small" href="#!">Contact</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../Recursos/js/scripts.js"></script>
    </body>
    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Extensiones para exportar -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<!-- Inicialización -->
<script>
$(document).ready(function() {
    $('.dataTable').DataTable({
        dom: 'Bfrtip', // Muestra botones arriba
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});
</script>

</html>







