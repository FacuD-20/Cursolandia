<?php
require_once __DIR__ . '/../../carga.php';
?>
<!doctype html>
<html lang="es" data-bs-theme="light">
    <head>
        <title>Tus Intereses</title>
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
        <!-- Framework: Bootstrap -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <!-- Archivo CSS -->
        <link rel="stylesheet" href="<?php echo URL_BASE; ?>/Interfaz/Activos/curstyles.css">
    </head>
    <body>
        <div class="vh-100">
            <div class="row h-100 g-0">
                <!-- Columna de titulo, imagen, logo, etc. -->
                <div class="col-lg-6 d-none d-lg-flex mi-bg-grisazulado flex-column justify-content-start align-items-center">
                    <div class="w-100 px-5 mt-4 mb-5 text-start">
                        <img src="<?php echo URL_BASE; ?>/Interfaz/Activos/Logo Cursolandia.png" alt="Logo" style="max-height: 40px;">
                        <span class="text-white fw-bold ms-2 fs-4 align-middle">Cursolandia</span>
                    </div>
                    <div class="w-75 mt-3 text-center">
                        <h1 class="text-white fw-bold">¡Casi terminamos!</h1>
                        <p class="text-white-50 fs-5 mt-3">Personalizá tu experiencia para encontrar los mejores cursos para vos.</p>
                    </div>
                    <div class="text-center w-100 mt-4">
                        <img src="<?php echo URL_BASE; ?>/Interfaz/Activos/img registrarse.png" alt="" class="img-fluid" style="max-height: 250px;">
                    </div>
                </div>
                <!-- Columna de Intereses y Antecedentes -->
                <div class="col-12 col-lg-6 mi-bg-grisclaro d-flex flex-column">
                    <!-- Header para celular -->
                    <div class="d-lg-none w-100 p-3 mi-bg-grisazulado shadow-sm d-flex align-items-center">
                        <img src="<?php echo URL_BASE; ?>/Interfaz/Activos/Logo Cursolandia.png" alt="Logo" style="max-height: 40px;">
                        <span class="text-white fw-bold ms-2 fs-5">Cursolandia</span>
                    </div>                  
                    <div class="w-100 px-3 py-4 m-auto" style="max-width: 450px;">
                        <div class="card border-0 shadow-sm rounded-4 p-4">                          
                            <h3 class="fw-bold text-center mi-color-text mb-1">Tus Intereses</h3>
                            <p class="text-center text-muted mb-4 small">
                                Seleccioná los temas que te gustan para recomendarte cursos a tu medida
                            </p>
                            <form action="" method="POST" name="fintereses">
                                <!-- Intereses --> 
                                <label class="form-label fw-bold small mi-color-text mb-2">Categorías y Etiquetas</label>
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                    <input type="checkbox" class="btn-check" name="intereses[]" id="int_prog" value="Programacion" autocomplete="off">
                                    <label class="btn mis-btnes-sinbg rounded-pill px-3 py-1 small fw-bold" for="int_prog">
                                        <i class="bi bi-code-slash me-1"></i> Programación
                                    </label>
                                    <input type="checkbox" class="btn-check" name="intereses[]" id="int_diseno" value="Diseno UI/UX" autocomplete="off">
                                    <label class="btn mis-btnes-sinbg rounded-pill px-3 py-1 small fw-bold" for="int_diseno">
                                        <i class="bi bi-brush me-1"></i> Diseño UI/UX
                                    </label>
                                </div>
                                <!-- Antecedentes -->
                                <div class="mb-4">
                                    <label for="antecedentes" class="form-label fw-bold small mi-color-text mb-1">
                                        Tus Antecedentes <span class="text-muted fw-normal">(Opcional)</span>
                                    </label>
                                    <textarea class="form-control" id="antecedentes" name="antecedentes" rows="3" placeholder="Contanos brevemente tus estudios, experiencia o conocimientos previos..."></textarea>
                                </div>
                                <!-- Boton Registrartse -->
                                <button type="submit" class="btn mis-bgs-btns w-100 py-2 text-light fw-bold mb-2">
                                    FINALIZAR REGISTRO <i class="bi bi-check-lg ms-1"></i>
                                </button>    
                                <!-- Boton Omitir e ir a la pag principal -->                      
                                <div class="text-center mt-2">
                                    <a href="<?php echo URL_BASE; ?>/index.php" class="text-muted small text-decoration-none">
                                        Omitir por ahora e ir al inicio →
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap JavaScript Bundle -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>