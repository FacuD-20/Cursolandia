<?php include 'Interfaz/Incluidos/cabecera.php';?>
<main class="flex-grow-1">
    <!-- Banner para pantalla mobile y computadora-->
    <section class="mb-4">
        <div class="container-fluid px-4 py-5 mi-bg-banner mb-3">
            <div class="row aling-items-center">
                <div class="col-12 col-lg-6 text-light text-start text-lg-start my-auto">
                    <h1>Aprende y crea sin limites, en cualquier lugar y/o momento</h1>
                    <h5 class ="my-3">Aprende de los mejores profesionales — y conviértete en uno tú mismo.</h5>
                    <!-- Botones en Celular -->
                    <div class="d-lg-none d-flex flex-column flex-lg-row gap-2 mt-4" style ="width: 35%">
                        <a href="" class="d-flex btn mis-bgs-btns-banner w-auto p-3 text-light">EXPLORAR CURSOS <i class="bi bi-arrow-right-short ms-auto"></i></a>
                        <a href="" class="d-flex btn btn-outline-light w-auto p-3">CREAR CURSOS <i class="bi bi-arrow-right-short ms-auto"></i></a>
                    </div>
                    <!-- Botones en computadora -->
                    <div class="d-none d-lg-flex flex-column flex-lg-row gap-3 mt-4 w-75">
                        <a href="" class="btn mis-bgs-btns-banner w-100 py-3 text-light">EXPLORAR CURSOS <i class="bi bi-arrow-right-short"></i></a>
                        <a href="" class="btn btn-outline-light w-100 py-3">CREAR CURSOS <i class="bi bi-arrow-right-short"></i></a>
                    </div>
                </div>
                <div class="d-none d-lg-block col-6">
                    <img src="Interfaz/Activos/img-banner main section.webp" alt="" class="img-fluid rounded-4">
                </div>
            </div>
        </div>
    </section>
    <!-- Carrusel y fila de Propuestas -->
    <section class="my-4">
        <div class="text-dark my-4 text-center">
            <h2 class="mi-color-text">¿Por Qué Elegirnos?</h2>
        </div>
        <!-- Carrusel de Propuestas Telefono -->
        <div id="carouselPropuestas" class="carousel slide carousel-dark d-lg-none"  data-bs-ride="carousel">
            <div class="carousel-inner container rounded">
                <!-- Primeros par de Items -->
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-6 col-lg-3 bg-light p-4">
                            <div>
                                <i class="bi bi-person-workspace fs-4 text-light px-2 py-1 rounded" style="background-color: #8393ad !important;"></i>
                            </div>
                            <h5 class="fw-bold my-3 mi-color-text">Profesores Expertos</h5>
                            <p class="text-muted small mi-color-text">Aprende de los mejores profesionales de la industria.</p>
                        </div>
                        <div class="col-6 col-lg-3 bg-light p-4">
                            <div>
                                <i class="bi bi-clock fs-4 text-light px-2 py-1 rounded" style="background-color: #AB978C !important;"></i>
                            </div>
                            <h5 class="fw-bold my-3 mi-color-text">Aprende a tu Ritmo</h5>
                            <p class="text-muted small mi-color-text">Accede a cursos en cualquier momento, con acceso de por vida.</p>
                        </div>
                    </div>
                </div>
                <!-- Segundo par de Items -->
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-6 col-lg-3 bg-light p-4">
                            <div>
                                <i class="bi bi-person-vcard-fill fs-4 text-light px-2 py-1 rounded bg-success"></i>
                            </div>
                            <h5 class="fw-bold my-3 mi-color-text">Obten tu Certificado</h5>
                            <p class="text-muted small mi-color-text">Gana certificados para que reconozca la mejora en tu carrera.</p>
                        </div>
                        <div class="col-6 col-lg-3 bg-light p-4">
                            <div>
                                <i class="bi bi-headset fs-4 text-light px-2 py-1 rounded bg-primary"></i>
                            </div>
                            <h5 class="fw-bold my-3 mi-color-text">Soporte 24/7</h5>
                            <p class="text-muted small mi-color-text">Obten ayuda del equipo sin importar cuando la necesites.</p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselPropuestas" data-bs-slide="prev">
                <span class="carousel-control-prev-icon me-auto" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselPropuestas" data-bs-slide="next">
                <span class="carousel-control-next-icon ms-auto" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- Fila de Propuestas PC -->
        <div class="d-none d-lg-block container">
            <div class="row gx-4">
                <!-- Primera Propuesta -->
                <div class="col-lg-3">
                    <div class="shadow bg-light rounded p-3 h-100">
                        <div>
                            <i class="bi bi-person-workspace fs-4 text-light px-2 py-1 rounded" style="background-color: #8393ad !important;"></i>
                        </div>
                        <h5 class="fw-bold my-3 mi-color-text">Profesores Expertos</h5>
                        <p class="text-muted small mi-color-text">Aprende de los mejores profesionales de la industria.</p>
                    </div>
                </div>
                <!-- Segunda Propuesta -->
                <div class="col-3">
                    <div class="shadow bg-light rounded p-3 h-100">
                        <div>
                            <i class="bi bi-clock fs-4 text-light px-2 py-1 rounded" style="background-color: #AB978C !important;" ></i>
                        </div>
                        <h5 class="fw-bold my-3 mi-color-text">Aprende a tu Ritmo</h5>
                        <p class="text-muted small mi-color-text">Accede a cursos en cualquier momento, con acceso de por vida.</p>
                    </div>
                </div>
                <!-- Tercera Propuesta -->
                <div class="col-3">
                    <div class="shadow bg-light rounded p-3 h-100">
                        <div>
                            <i class="bi bi-person-vcard-fill fs-4 text-light px-2 py-1 rounded bg-success"></i>
                        </div>
                        <h5 class="fw-bold my-3 mi-color-text">Obten tu Certificado</h5>
                        <p class="text-muted small mi-color-text">Gana certificados para que reconozca la mejora en tu carrera.</p>
                    </div>
                </div>
                <!-- Cuarta Propuesta -->
                <div class="col-3">
                    <div class="shadow bg-light rounded p-3 h-100">
                        <div>
                            <i class="bi bi-headset fs-4 text-light px-2 py-1 rounded bg-primary"></i>
                        </div>
                        <h5 class="fw-bold my-3 mi-color-text">Soporte 24/7</h5>
                        <p class="text-muted small mi-color-text">Obten ayuda del equipo sin importar cuando la necesites.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Cursos Populares -->
    <section class="container my-5">
        <div class="d-flex justify-content-between aling-items-center mb-4">
            <h2 class="mi-color-text">Cursos Populares</h2>
            <a href="" class="text-center btn mis-btnes-sinbg rounded-pill px-4 fw-bold">Ver Más</a>
        </div>
        <!-- Carrusel de los cursos populares -->
        <div class="row g-4 flex-nowrap overflow-x-auto sin-scrollbar d-lg-flex flex-lg-wrap pb-4">
            <!-- Primera Tarjeta -->
            <div class="col-6 col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    <img src="" alt="" class="card-img-top rounded-4">
                    <div class="card-body d-flex flex-column">
                        <!-- Etiqueta -->
                        <span class="badge text-bg-light border mb-2 text-start text-muted" style="width: fit-content;">Desarrollo Web</span>
                        <h5 class="card-title fw-bold mi-color-text"> X </h5>
                        <p class="text-muted small mb-3"> Autor </p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <a href="#" class="btn btn-sm mis-btnes-sinbg rounded-pill p-2">Detalles del Curso<i class="bi bi-arrow-right-short"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Segunda Tarjeta -->
            <div class="col-6 col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    <img src="" alt="" class="card-img-top rounded-4">
                    <div class="card-body d-flex flex-column">
                        <!-- Etiqueta -->
                        <span class="badge text-bg-light border mb-2 text-start text-muted" style="width: fit-content;">Desarrollo Web</span>
                        <h5 class="card-title fw-bold mi-color-text"> X </h5>
                        <p class="text-muted small mb-3"> Autor </p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <a href="#" class="btn btn-sm mis-btnes-sinbg rounded-pill p-2">Detalles del Curso<i class="bi bi-arrow-right-short"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tercera Tarjeta -->
            <div class="col-6 col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    <img src="" alt="" class="card-img-top rounded-4">
                    <div class="card-body d-flex flex-column">
                        <!-- Etiqueta -->
                        <span class="badge text-bg-light border mb-2 text-start text-muted" style="width: fit-content;">Desarrollo Web</span>
                        <h5 class="card-title fw-bold mi-color-text"> X </h5>
                        <p class="text-muted small mb-3"> Autor </p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <a href="#" class="btn btn-sm mis-btnes-sinbg rounded-pill p-2">Detalles del Curso<i class="bi bi-arrow-right-short"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Cuarta Tarjeta -->
            <div class="col-6 col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    <img src="" alt="" class="card-img-top rounded-4">
                    <div class="card-body d-flex flex-column">
                        <!-- Etiqueta -->
                        <span class="badge text-bg-light border mb-2 text-start text-muted" style="width: fit-content;">Desarrollo Web</span>
                        <h5 class="card-title fw-bold mi-color-text"> X </h5>
                        <p class="text-muted small mb-3"> Autor </p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">                            
                            <a href="#" class="btn btn-sm mis-btnes-sinbg rounded-pill p-2">Detalles del Curso<i class="bi bi-arrow-right-short"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Etiquetas -->
    <section class="container bg-light rounded-4 px-4 py-5 my-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold mi-color-text">Buscar por Etiquetas</h2>
            <p class="text-muted">Ecuentra tus cursos segun tus intereses</p>
        </div>
        <!-- Fila de Etiquetas -->
        <div class="row g-4 justify-content-center">
            <!-- Primera Etiqueta -->
            <div class="col-6 col-md-4 col-lg-2 text-center">
                <a href="" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100 p-4 rounded-4 mis-btnes-sinbg">
                        <i class="bi bi-code-slash fs-1 mi-color-icono mb-2"></i>
                        <h6 class="fw-bold mb-0">Programacion</h6>
                    </div>
                </a>
            </div>
            <!-- Segunda Etiqueta -->
            <div class="col-6 col-md-4 col-lg-2 text-center">
                <a href="" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100 p-4 rounded-4 mis-btnes-sinbg">
                        <i class="bi bi-brush fs-1 mi-color-icono mb-2"></i>
                        <h6 class="fw-bold mb-0">Diseño UI/UX</h6>
                    </div>
                </a>
            </div>
            <!-- Tercera Etiqueta -->
            <div class="col-6 col-md-4 col-lg-2 text-center">
                <a href="" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100 p-4 rounded-4 mis-btnes-sinbg">
                        <i class="bi bi-graph-up fs-1 mi-color-icono mb-2"></i>
                        <h6 class="fw-bold mb-0">Negocios</h6>
                    </div>
                </a>
            </div>
            <!-- Cuarta Etiqueta -->
            <div class="col-6 col-md-4 col-lg-2 text-center">
                <a href="" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100 p-4 rounded-4 mis-btnes-sinbg">
                        <i class="bi bi-megaphone fs-1 mi-color-icono mb-2"></i>
                        <h6 class="fw-bold mb-0">Marketing</h6>
                    </div>
                </a>
            </div>
            <!-- Quinta Etiqueta -->
            <div class="col-6 col-md-4 col-lg-2 text-center">
                <a href="" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100 p-4 rounded-4 mis-btnes-sinbg">
                        <i class="bi bi-database fs-1 mi-color-icono mb-2"></i>
                        <h6 class="fw-bold mb-0">Base de Datos</h6>
                    </div>
                </a>
            </div>
            <!-- Sexta Etiqueta -->
            <div class="col-6 col-md-4 col-lg-2 text-center">
                <a href="" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100 p-4 rounded-4 mis-btnes-sinbg">
                        <i class="bi bi-capsule fs-1 mi-color-icono mb-2"></i>
                        <h6 class="fw-bold mb-0">Farmacia</h6>
                    </div>
                </a>
            </div>
        </div>
    </section>
    <!-- Elegir Plan -->
    <section class="my-5 container">
        <h2 class="mi-color-text mb-5 text-center">Eligí tu Plan</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-12 col-lg-4">
                <div class="card text-center p-4 shadow-sm h-100">
                    <h5>Plan Gratuito</h5>
                    <h3>$O</h3>
                    <div class="card-body text-start">
                        <ul class="list-unstyled">
                            <li class="mb-4"><i class="bi bi-check-circle-fill text-success"></i> Maximo de 3 Cursos Inscriptos a la vez.</li>
                            <li class="mb-4"><i class="bi bi-check-circle-fill text-success"></i> Maximo de 3 Cursos Creados.</li>
                            <li class="mb-4"><i class="bi bi-check-circle-fill text-success"></i> Maximo de 5MB de tamaños de archivos.</li>
                        </ul>                        
                    </div>
                    <a href="#" class="btn mis-bgs-btns-G mt-auto">Registrarse Gratis</a>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card text-center p-4 mi-border-color-pro shadow-lg h-100">
                    <h5>Plan Pro</h5>
                    <h3>$9.99/mes</h3>
                    <div class="card-body text-start">
                        <ul class="list-unstyled">
                            <li class="mb-4"><i class="bi bi-check-circle-fill text-success"></i> Inscripciones a Cursos Ilimitados.</li>
                            <li class="mb-4"><i class="bi bi-check-circle-fill text-success"></i> Creaciones de Cursos Ilimitadas.</li>
                            <li class="mb-4"><i class="bi bi-check-circle-fill text-success"></i> Tamaño de Subida de Archivos Ilimitados.</li>
                        </ul>                        
                    </div>
                    <a href="#" class="btn mis-bgs-btns-pro mt-auto">Quiero ser Pro</a>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include 'Interfaz/Incluidos/pie.php';?>