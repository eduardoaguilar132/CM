<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Alta de Usuario</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../Recursos/images/plan.png" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Bootstrap Theme -->
    <link href="../Recursos/css/styles.css" rel="stylesheet" />

    <!-- Canvas Style -->
    <style>
        canvas {
            border: 2px solid #000;
            display: block;
            margin-bottom: 10px;
            touch-action: none;
        }
    </style>
</head>

<body class="d-flex flex-column h-100 bg-light">

    <main class="flex-shrink-0">

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
            <div class="container px-5">
                <a class="navbar-brand fw-bolder text-primary" href="../index.html">PLANELEC</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                        <li class="nav-item">
                            <a class="nav-link" href="../index.html">Home</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container px-5 my-5">

            <div class="text-center mb-5">
                <h1 class="display-5 fw-bolder mb-0">
                    <span class="text-gradient d-inline">Alta de Usuario</span>
                </h1>
            </div>

            <div class="row gx-5 justify-content-center">
                <div class="col-lg-11 col-xl-9 col-xxl-8">

                    <section>

                        <!-- Card -->
                        <div class="card shadow border-0 rounded-4 mb-5">
                            <div class="card-body">
                                <div class="row gx-3">

                                    <div class="body">

                                        <form id="formFirma" action="../Modelo/A-Usuario.php" method="POST">

                                            <div class="row mb-3">

                                                <!-- Nombre -->
                                                <div class="col-md-6">
                                                    <label for="nombre" class="form-label">Nombre de usuario:</label>
                                                    <input type="text" name="nombre" id="nombre" class="form-control">
                                                </div>

                                                <!-- Usuario login -->
                                                <div class="col-md-6">
                                                    <label for="usuariolog" class="form-label">Usuario para inicio de sesión:</label>
                                                    <input type="text" name="usuariolog" id="usuariolog" class="form-control">
                                                </div>

                                                <!-- Área -->
                                                <div class="col-md-6">
                                                    <label for="area" class="form-label">Área:</label>
                                                    <input type="text" name="area" id="area" class="form-control">
                                                </div>

                                                <!-- Puesto -->
                                                <div class="col-md-6">
                                                    <label for="puesto" class="form-label">Puesto:</label>
                                                    <input type="text" name="puesto" id="puesto" class="form-control">
                                                </div>

                                                <!-- Contraseña -->
                                                <div class="col-md-6">
                                                    <label for="pass" class="form-label">Contraseña:</label>
                                                    <input type="text" name="pass" id="pass" class="form-control">
                                                </div>

                                                <!-- Nivel -->
                                                <div class="col-md-12 mt-3">
                                                    <label class="form-label">Nivel:</label>
                                                    <br>

                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="re" id="revisa" value="1" class="form-check-input">
                                                        <label for="revisa" class="form-check-label">Revisa</label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="re" id="autoriza" value="2"
                                                               class="form-check-input" checked>
                                                        <label for="autoriza" class="form-check-label">Autoriza</label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="re" id="superuser" value="0"
                                                               class="form-check-input">
                                                        <label for="superuser" class="form-check-label">SuperUser</label>
                                                    </div>
                                                </div>

                                                <!-- Firma -->
                                                <div class="col-md-12 mt-4">
                                                    <label class="form-label">Firma de Usuario</label>
                                                    <canvas id="canvasFirma" width="300" height="200"></canvas>
                                                    <input type="hidden" name="firma" id="firmaInput">
                                                    <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="limpiarCanvas()">Limpiar</button>
                                                </div>

                                                <!-- Botón Guardar -->
                                                <div class="col-md-12 mt-4">
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                </div>

                                            </div>

                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </section>

                </div>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-white py-4 mt-auto">
        <div class="container px-5">
            <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                <div class="col-auto">
                    <div class="small m-0">Copyright © Your Website 2023</div>
                </div>
                <div class="col-auto">
                    <a class="small" href="#!">Privacy</a>
                    <span class="mx-1">·</span>
                    <a class="small" href="#!">Terms</a>
                    <span class="mx-1">·</span>
                    <a class="small" href="#!">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts -->
    <script src="../Recursos/js/scripts.js"></script>

</body>
</html>
