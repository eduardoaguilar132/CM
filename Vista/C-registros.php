<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Bienvenido</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="Recursos/assets/favicon.ico" />
        <!-- Custom Google font-->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="Recursos/css/styles.css" rel="stylesheet" />
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
                    <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Solicitud</span></h1>
                </div>
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-11 col-xl-9 col-xxl-8">


                        <!-- Experience Section-->
                        <section>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h2 class="text-primary fw-bolder mb-0"X>Alta</h2>
                            </div>


                            <!-- Experience Card 1-->
                            <div class="card shadow border-0 rounded-4 mb-10">
                                <div class="card-body">
                                    <div class="row align-items-center gx-15">
                                       <div class="body">
                                            <form id="formFirma" action="../modelo/A-ManttoHSQL.php" method="POST">
                                                <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <label for="nombre" class="form-label">Nombre del solicitante:</label>
                                                            <input type="text" name="nombre" class="form-control" id="nombre" >
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="area" class="form-label">Puesto:</label>
                                                            <input type="text" name="puesto" class="form-control" id="area" >
                                                        </div>
                                                          <div class="col-md-3">
                                                            <label for="fecha" class="form-label">Fecha de Solicitud:</label>
                                                            <input  type="date" name="fecha" class="form-control"  id="fecha" name="fecha">
                                                        </div>
                                                    <div class="row mb-6">
                                                        <div class="col-md-15">
                                                            <div>
                                                                <label class="form-label">Tipo de Accion:</label>
                                                                <br>
                                                                <div class="form-check form-check-inline">
                                                                    <input type="radio" name="r1" class="form-check-input" id="r1c" value="1">
                                                                    <label for="r1c" class="form-check-label">Creacion de Documento</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input type="radio" name="r1" class="form-check-input" id="r1m" value="2"
                                                                        checked>
                                                                    <label for="r1m" class="form-check-label">Modificacion de Documento</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input type="radio" name="r1" class="form-check-input" id="r1e" value="3"
                                                                        checked>
                                                                    <label for="r1e" class="form-check-label">Eliminacion de Documento</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <div class="col-md-6">
                                                            <label for="ver1" class="form-label">Version actual</label>
                                                            <input type="text" name="ver1" class="form-control" id="ver1" >
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="ver2" class="form-label">Version a la que cambia:</label>
                                                            <input type="text" name="ver2" class="form-control" id="ver2" >
                                                        </div>
                                                        <div class="col-md-15">
                                                            <label for="razonm" class="form-label">Razon del cambio o creacion del documento:</label>
                                                            <textarea name="razonm" rows="5" class="form-control" cols="10" ></textarea>
                                                        </div>

                                                         <div >
                                                            <label class="form-check-label">Firma de usuario</label>
                                                            <canvas id="canvasFirma" width="500" height="200"></canvas>
                                                            <input type="hidden" name="firma" id="firmaInput">
                                                            <button type="button" onclick="limpiarCanvas()">Limpiar</button>
                                                         </div>
                    
                                                        <div>
                                                            <br>
                                                            <button type="submit"  class="btn btn-primary " >generar reporte</button>
                                                        </div>

                  
                                                    </div>
                                                </div>
                                            </form>
                                       </div>
                                        
                                    </div>
                                </div>
                            </div>
                          
                                </div>
                            </div>
                        </section>
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
        <script src="js/scripts.js"></script>
    </body>
</html>
