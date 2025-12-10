<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Alta de Usuario</title>
        <!-- Favicon-->
      <link rel="icon" type="image/x-icon" href="../Recursos/images/plan.png" />
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
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                            <li class="nav-item"><a class="nav-link" href="../index.html">Home</a></li>
                            
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Page Content-->
            <div class="container px-10 my-10">
                <div class="text-center mb-10">
                    <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Inicio de Sesion.</span></h1>
                </div>
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-11 col-xl-9 col-xxl-8">


                        <!-- Experience Section-->
                        <section>
                         

                            <!-- Experience Card 1-->
                            <div class="card shadow border-0 rounded-4 mb-5">
    <div class="card-body p-5">
        <h3 class="fw-bolder text-center mb-4">Iniciar Sesión</h3>

        <form action="../Modelo/Procesar.php" method="POST">

            <!-- Usuario -->
            <div class="mb-3">
                <label class="form-label fw-bold">Usuario</label>
                <input 
                    type="text" 
                    name="NombreUs" 
                    class="form-control form-control-lg rounded-3"
                    placeholder="Ingresa tu usuario"
                    required
                >
            </div>

            <!-- Contraseña -->
            <div class="mb-3">
                <label class="form-label fw-bold">Contraseña</label>
                <input 
                    type="password" 
                    name="password" 
                    class="form-control form-control-lg rounded-3"
                    placeholder="Ingresa tu contraseña"
                    required
                >
            </div>

            <!-- Botón -->
            <div class="d-grid mt-4">
                <button class="btn btn-primary btn-lg rounded-4" type="submit">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Entrar
                </button>
            </div>

        </form>
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
        <script src="../Recursos/js/scripts.js"></script>
        
    </body>
</html>
