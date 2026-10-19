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
            <section class="container-fluid px-lg-4 py-4">
                <!-- Card de Mini Encabezado con info varia -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
                        <div>
                            <div class="mb-2">
                                <span class="badge rounded-pill mi-bg-bronce">Curso Activo</span>
                            </div>
                            <h2 class="fw-bold mi-color-text mb-1">Nombre del Curso</h2>
                            <p class="text-muted small mb-0">
                                <i class="bi bi-person-workspace me-1"></i>Docente: Nombre del Creador |
                                <i class="bi bi-calendar-range ms-2 me-1"></i>Activo: xx/xx/xx al xx/xx/xx
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row g-4">           
                    <!-- Card de Materiales adjuntos del curso -->
                    <div class="col-12 col-lg-3 d-none d-lg-block">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <!-- Encabezado -->
                            <h5 class="fw-bold mi-color-text mb-3 border-bottom pb-2">
                                <i class="bi bi-folder2-open me-2"></i>Material del Curso
                            </h5>
                            <!-- Lista de Archivos -->
                            <div class="list-group list-group-flush">
                                <!-- Primer Item -->
                                <a href="" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0 py-2 border-bottom">
                                    <div class="text-truncate me-2">
                                        <i class="bi bi-file-earmark-pdf text-danger me-2"></i>
                                        <span class="small fw-semibold">Archivo.x</span>
                                    </div>
                                    <span class="badge bg-light text-muted border">
                                        Tamaño de Descarga<i class="bi bi-download ms-1"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Contenido -->
                    <div class="col-12 col-lg-9 mb-4">
                        <!-- Offcanvas para el indice del curso en Telefono -->
                        <button class="btn mis-bgs-btns w-100 p-3 rounded-4 shadow-sm d-lg-none mb-4 fw-bold text-light border" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                            <i class="bi bi-list-ul me-2"></i> Ver Materiales del Curso
                        </button>
                        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                            <div class="offcanvas-header border-bottom">
                                <h5 class="offcanvas-title fw-bold mi-color-text" id="offcanvasWithBothOptionsLabel">
                                    <i class="bi bi-folder2-open me-2"></i> Material del Curso                                        
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <!-- Lista de Archivos -->
                                <div class="list-group list-group-flush">
                                    <p class="text-muted small mb-3">Archivos disponibles para descargar:</p>
                                    <div class="list-group list-group-flush">
                                        <!--Item -->
                                        <a href="" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0 py-2">
                                            <div class="text-truncate me-2">
                                                <i class="bi bi-file-earmark-pdf text-danger me-2"></i>
                                                <span class="small fw-semibold">Archivo.x</span>
                                            </div>
                                            <span class="badge bg-light text-muted border">
                                                Tamaño de Descarga<i class="bi bi-download ms-1"></i>
                                            </span>
                                        </a>
                                    </div>                                
                                </div>
                            </div>
                        </div>
                        <!-- Publicar Pregunta -->
                        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                            <h5 class="fw-bold mi-color-text mb-3">
                                <i class="bi bi-chat-left-dots me-2"></i> Foro de Preguntas
                            </h5>
                            <form action="" method="POST" name="fpreguntas" class="needs-validation" novalidate>
                                <div class="mb-2">
                                    <input type="text" name="titulo_pregunta" class="form-control" placeholder="Título o asunto de tu duda..." required>
                                    <div class="invalid-feedback">Ingresá un título para tu consulta.</div>
                                </div>
                                <div class="mb-3">
                                    <textarea name="atexto_pregunta" id="atexto_pregunta" rows="2"  class="form-control" placeholder="Escribe tu consulta para el docente y tus compañeros..." required></textarea>
                                    <div class="invalid-feedback">Escribe los detalle de tu pregunta.</div>
                                </div>
                                <button type="submit" class="btn mis-bgs-btns text-light px-4 fw-bold">
                                    Publicar Pregunta
                                </button>
                            </form>
                        </div>
                        <!-- Lista de Preguntas -->
                        <div class="card border-0 shadow-sm rounded-4 p-4 mb-3">
                            <!-- Primera Pregunta -->                            
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <!-- header de la pregunta -->
                                <div class="d-flex align-items-center">
                                    <img src="" alt="Avatar" class="rounded-circle me-2 border" style="width: 40px; height: 40px; object-fit: cover;">
                                    <div>
                                        <h6 class="fw-bold mi-color-text mb-0">Título de la pregunta del alumno</h6>
                                        <small class="text-muted">Por: Nombre Alumno | Fecha: xx/xx/xxxx</small>
                                    </div>
                                </div>
                                <!-- Estado de la pregunta -->
                                <div class="d-flex gap-1">
                                    <span class="badge mi-bg-bronce"><i class="bi bi-pin-angle-fill me-1"></i>Destacada</span>
                                    <span class="badge bg-secondary"><i class="bi bi-lock-fill me-1"></i>Cerrada</span>
                                </div>
                            </div>
                            <!-- Consulta -->
                            <p class="text-muted small mb-3">
                                Duda planteada por el estudiante.
                            </p>
                            <!-- Bloque de Respuestas -->
                            <div class="ps-3 border-start ms-2 mb-3">                                
                                <!-- Ejemplo de x respuesta -->
                                <div class="bg-light border-start border-4 border-success p-3 rounded-3 mb-2">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="fw-bold small mi-color-text">Nombre Compañero / Docente</span>
                                        <span class="badge bg-success"><i class="bi bi-check2-all me-1"></i>Respuesta Aceptada</span>
                                    </div>
                                    <p class="small text-muted mb-2">
                                        Esta es la respuesta que soluciona la consulta y cierra el tema.
                                    </p>
                                    <!-- Acciones del Alumno (Marcar como aceptada si es el autor de la pregunta, o editar su última respuesta) -->
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-sm btn-outline-success py-0" style="font-size: 0.75rem;">
                                            Marcar como Aceptada
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary py-0" style="font-size: 0.75rem;">
                                            <i class="bi bi-pencil me-1"></i>Editar mi respuesta
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Formulario para responder una consulta -->
                            <form action="" method="POST" name="frespuesta" class="needs-validation" novalidate>
                                <div class="input-group input-group-sm">
                                    <input type="text" name="respuesta" class="form-control" placeholder="Escribir una respuesta..." required>
                                    <button class="btn mis-btns-bg-bronce text-light fw-bold px-3" type="submit">Responder</button>
                                </div>
                            </form>
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
        <script src="<?php echo URL_BASE;?>/Interfaz/Activos/validaciones.js"></script>
    </body>
</html>
