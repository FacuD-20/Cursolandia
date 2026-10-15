<?php
require_once __DIR__ . '/../../carga.php';
include RUTA_BASE . '/Interfaz/Incluidos/cabecera.php';
?>

<main>
    <!-- Banner con fondo, imagen, etiqueta y titulo del curso -->
    <section class="mi-bg-grisazulado text-white py-5 mb-4">
        <div class="container">
            <div class="row align-items-center g-4">
                <!-- Imagen -->
                <div class="col-12 col-md-5 col-lg-4 text-center text-md-start">
                    <img src="" alt="" class="img-fluid rounded-4 shadow-sm" style="max-height: 250px; width: 100%; object-fit: cover;">
                </div>
                <!-- Titulo -->
                <div class="col-12 col-md-7 col-lg-8 text-center text-md-start">
                    <span class="badge rounded-pill mi-bg-bronce px-3 py-2 mb-2">Desarrollo Web</span>
                    <h1 class="fw-bold mb-3 display-5 text-white">Nombre del Curso</h1>
                    <p class="text-white-50 fs-5 mb-0">Descripcion</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Tarjetas de informacion varia del curso -->
    <section>
        <div class="container mb-5">
            <div class="row g-3">
                <!-- Primera tarjeta -->
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm p-3 h-100 rounded-3 text-center text-md-start">
                        <div class="d-flex flex-column flex-md-row align-items-center">
                            <i class="bi bi-laptop fs-3 text-muted mb-2 me-md-2 mb-md-0"></i>
                            <div>
                                <p class="fw-bold small mb-0">Modalidad</p>
                                <span class="text-muted small">A distancia ágil</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Segunda Tarjeta -->
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm p-3 h-100 rounded-3 text-center text-md-start">
                        <div class="d-flex flex-column flex-md-row align-items-center">
                            <i class="bi bi-clock fs-3 text-muted mb-2 me-md-2 mb-md-0"></i>                            
                            <div>
                                <p class="fw-bold small mb-0">Apertura de aula</p>
                                <span class="text-muted small">Fecha de Inicio</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tercera Tarjeta -->
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm p-3 h-100 rounded-3 text-center text-md-start">
                        <div class="d-flex flex-column flex-md-row align-items-center">
                            <i class="bi bi-calendar fs-3 text-muted mb-2 me-md-2 mb-md-0"></i>                            
                            <div>
                                <p class="fw-bold small mb-0">Cursada</p>
                                <span class="text-muted small">Dias y horarios (Pais)</span>                        
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Cuarta Tarjeta -->
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm p-3 h-100 rounded-3 text-center text-md-start">
                        <div class="d-flex flex-column flex-md-row align-items-center">                    
                            <i class="bi bi-patch-check fs-3 text-muted mb-2 me-md-2 mb-md-0"></i>
                            <div>
                                <p class="fw-bold small mb-0">Certificado</p>
                                <span class="text-muted small">Cursolandia</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contenido y Precio -->
    <section>
        <div class="container mb-5">
            <div class="row g-3">
                <!-- Precios -->
                <div class="col-12 col-lg-4 order-lg-2">
                    <div class="bg-white shadow-sm p-4 mb-2 rounded-4 text-center border border-2 mi-border-grisazulado sticky-lg-top">
                        <p>Precio total del curso</p>
                        <h2 class="my-4 fw-bold">Precio</h2>
                        <div class="text-start">
                            <p class="border-bottom border-top my-2 py-2 d-flex justify-content-between">
                                <span class="fw-bold mi-color-text">Apertura</span>
                                <span class="text-muted">xx/xx/xx</span>
                            </p>
                            <p class="border-bottom pb-2 mb-2 d-flex justify-content-between">
                                <span class="fw-bold mi-color-text">Horario</span>
                                <span class="text muted">xh a xh</span>
                            </p>
                            <p class="border-bottom pb-2 d-flex justify-content-between">
                                <span class="fw-bold mi-color-text">Duracion</span>
                                <span class="text-muted">x semanas</span>
                            </p>
                        </div>
                        <a href="" class="btn w-100 mis-bgs-btns mt-auto text-light">Inscribirse</a>                        
                    </div>
                </div>
                <!-- Informacion -->
                <div class="col-12 col-lg-8 order-lg-1">
                    <!-- Presentacion -->
                    <div class="border-0 bg-white shadow-sm rounded-4 p-4 p-md-5 mb-4">
                        <h5 class="fw-bold mi-color-text mb-3">Presentacion</h5>
                        <p class="text-muted mb-0">
                            Introduccion al curso
                        </p>
                    </div>
                    <!-- Temario -->
                    <div class="border-0 bg-white shadow-sm rounded-4 p-4 p-md-5 mb-4">
                        <h5 class="fw-bold mi-color-text mb-3">Temario</h5>
                        <div class="accordion" id="accordionPanelsStayOpenTemario">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                                    Accordion Item #1
                                </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <strong>This is the first item’s accordion body.</strong> 
                                        It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It’s also worth noting that just about any HTML can go within the 
                                        <code>.accordion-body</code>
                                        , though the transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    Accordion Item #2
                                </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <strong>This is the second item’s accordion body.</strong> 
                                        It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It’s also worth noting that just about any HTML can go within the 
                                        <code>.accordion-body</code>
                                        , though the transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    Accordion Item #3
                                </button>
                                </h2>
                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <strong>This is the third item’s accordion body.</strong> 
                                        It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It’s also worth noting that just about any HTML can go within the 
                                        <code>.accordion-body</code>
                                        , though the transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Equipo Docente -->
                    <div class="border-0 bg-white shadow-sm rounded-4 p-4 p-md-5 mb-4">
                        <h5 class="fw-bold mi-color-text mb-3">Equipo Docente</h5>
                        <div class="d-flex align-items-center">
                            <img src="" alt="" class="rounded-circle me-3">
                            <div>
                                <h6 class="fw-bold mb-0 mi-color-text">Nombre del Profesor</h6>
                                <small class="text-muted">Rol</small>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </section>
</main>

<?php include RUTA_BASE . '/Interfaz/Incluidos/pie.php'; ?>