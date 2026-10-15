<?php
require_once __DIR__ . '/../../carga.php';
?>

<!doctype html>
<html lang="es" data-bs-theme="light">
    <head>
        <title>Aula</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- font: Open Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
        <!-- font: Inter -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
        <!-- Frameworck: Bootstrap -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <!-- Archivo CSS -->
        <link rel = "stylesheet" href = "<?php echo URL_BASE;?>/Interfaz/Activos/curstyles.css">
    </head>

    <body>
        <header class="mi-bg-grisazulado text-white py-3 px-4 shadow-sm">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <img src="<?php echo URL_BASE; ?>/Interfaz/Activos/logo Cursolandia.png" alt="Logo" style="max-height: 40px;">
                    <span class="text-white fw-bold ms-2 fs-5 pe-3">Cursolandia</span>
                    <a href="<?php echo URL_BASE;?>/index.php" class="text-white-50 text-decoration-none small border-start ps-3">
                        <i class="bi bi-arrow-left me-1"></i>
                        Pagina Principal
                    </a>
                </div>
                <span class="fw-semibold d-none d-md-inline">Nombre del Curso</span>
            </div>
        </header>
        <main>
            <section class="container-fluid px-lg-4">
                <div class="row py-4">                    
                    <!-- Indice de clases en PC -->
                    <div class="col-12 col-lg-3 d-none d-lg-block mb-4">
                        <div class="card border-0 shadow-sm rounded-4 p-3">
                            <!-- Encabezado -->
                            <h4 class="fw-bold mi-color-text mb-3">Indice del Curso</h4>
                            <!-- Acordeon para listar los modulos -->
                            <div class="accordion" id="accordionIndicedelCurso">
                                <!-- Item 1 -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Accordion Item #1
                                    </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionIndicedelCurso">
                                        <div class="accordion-body p-2">
                                            <div class="list-group list-group-flush">
                                                <a href="" class="list-group-item list-group-item-action border-0 rounded-2 py-2"><i class="bi bi-play-circle me-2"></i>Nombre de la clase</a>
                                                <a href="" class="list-group-item list-group-item-action border-0 rounded-2 py-2"><i class="bi bi-play-circle me-2"></i>Nombre de la clase</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Item 2 -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Accordion Item #2
                                    </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionIndicedelCurso">
                                        <div class="accordion-body p-2">
                                            <div class="list-group list-group-flush">
                                                <a href="" class="list-group-item list-group-item-action border-0 rounded-2"><i class="bi bi-play-circle me-2"></i>Nombre de la clase</a>
                                                <a href="" class="list-group-item list-group-item-action border-0 rounded-2"><i class="bi bi-play-circle me-2"></i>Nombre de la clase</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Item 3 -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Accordion Item #3
                                    </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionIndicedelCurso">
                                        <div class="accordion-body p-2">
                                            <div class="list-group list-group-flush">
                                                <a href="" class="list-group-item list-group-item-action border-0 rounded-2"><i class="bi bi-play-circle me-2"></i>Nombre de la clase</a>
                                                <a href="" class="list-group-item list-group-item-action border-0 rounded-2"><i class="bi bi-play-circle me-2"></i>Nombre de la clase</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Contenido -->
                    <div class="col-12 col-lg-9 mb-4">
                        <!-- Offcanvas para el indice del curso en Telefono -->
                        <button class="btn mis-bgs-btns w-100 p-3 rounded-4 shadow-sm d-lg-none mb-4 fw-bold text-light border" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                            <i class="bi bi-list-ul me-2"></i> Ver Índice del Curso
                        </button>
                        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Indice del Curso</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <!-- Acordeon de modulos -->
                                <div class="accordion" id="accordionIndiceCelular">
                                <!-- Item 1 -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOneCelular" aria-expanded="true" aria-controls="collapseOneCelular">
                                        Accordion Item #1
                                    </button>
                                    </h2>
                                    <div id="collapseOneCelular" class="accordion-collapse collapse" data-bs-parent="#accordionIndiceCelular">
                                        <div class="accordion-body p-2">
                                            <div class="list-group list-group-flush">
                                                <a href="" class="list-group-item list-group-item-action border-0 rounded-2 py-2"><i class="bi bi-play-circle me-2"></i>Nombre de la clase</a>
                                                <a href="" class="list-group-item list-group-item-action border-0 rounded-2 py-2"><i class="bi bi-play-circle me-2"></i>Nombre de la clase</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Item 2 -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwoCelular" aria-expanded="false" aria-controls="collapseTwoCelular">
                                        Accordion Item #2
                                    </button>
                                    </h2>
                                    <div id="collapseTwoCelular" class="accordion-collapse collapse" data-bs-parent="#accordionIndiceCelular">
                                        <div class="accordion-body p-2">
                                            <div class="list-group list-group-flush">
                                                <a href="" class="list-group-item list-group-item-action border-0 rounded-2"><i class="bi bi-play-circle me-2"></i>Nombre de la clase</a>
                                                <a href="" class="list-group-item list-group-item-action border-0 rounded-2"><i class="bi bi-play-circle me-2"></i>Nombre de la clase</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Item 3 -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThreeCelular" aria-expanded="false" aria-controls="collapseThreeCelular">
                                        Accordion Item #3
                                    </button>
                                    </h2>
                                    <div id="collapseThreeCelular" class="accordion-collapse collapse" data-bs-parent="#accordionIndiceCelular">
                                        <div class="accordion-body p-2">
                                            <div class="list-group list-group-flush">
                                                <a href="" class="list-group-item list-group-item-action border-0 rounded-2"><i class="bi bi-play-circle me-2"></i>Nombre de la clase</a>
                                                <a href="" class="list-group-item list-group-item-action border-0 rounded-2"><i class="bi bi-play-circle me-2"></i>Nombre de la clase</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!--Visualizador -->
                        <div class="ratio ratio-16x9 mb-3 rounded-4 overflow-hidden shadow-sm bg-dark">
                            <video controls poster="">
                                <source src="" type="video/mp4">
                            </video>
                        </div>
                        <!-- Titulo y botonoes -->
                        <div>
                            <h3 class="fw-bold mi-color-text my-2">Clase x: Tema</h3>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <a href="" class="btn mis-btnes-sinbg-bronce px-3"><i class="bi bi-arrow-left me-1"></i> Clase Anterior</a>
                                <a href="" class="btn mis-btns-bg-bronce text-light px-3">Clase Siguiente <i class="bi bi-arrow-right ms-1"></i> </a>
                            </div>                            
                        </div>
                        <!-- Descripción y Recursos -->
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <ul class="nav nav-tabs mb-3" id="aulaTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active fw-bold mi-color-text" id="desc-tab" data-bs-toggle="tab" data-bs-target="#descripcion" type="button" role="tab">Descripción</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fw-bold text-muted" id="rec-tab" data-bs-toggle="tab" data-bs-target="#recursos" type="button" role="tab">Recursos</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="aulaTabsContent">
                                <!-- Descripción -->
                                <div class="tab-pane fade show active text-muted" id="descripcion" role="tabpanel">
                                    <p class="mb-0">Resumen de la clase</p>
                                </div>
                                <!-- Recursos -->
                                <div class="tab-pane fade" id="recursos" role="tabpanel">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                            Material de la clase.
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
