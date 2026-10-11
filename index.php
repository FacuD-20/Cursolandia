<?php include 'Interfaz/Incluidos/cabecera.php';?>
<main class="flex-grow-1">
    <!-- Banner para pantalla mobile y computadora-->
    <section class="mb-4">
        <div class="container-fluid px-4 pt-5 mi-bg-banner mb-3">
            <div class="row">
                <div class="col-12 text-light text-start text-lg-start mb-4">
                    <h1>Aprende y crea sin limites, en cualquier lugar y/o momento</h1>
                    <h5 class ="my-3">Aprende de los mejores profesionales — y conviértete en uno tú mismo.</h5>
                    <div class="d-flex flex-column flex-lg-row gap-2 mt-4" style ="width: 35%">
                        <a href="" class="d-flex btn mis-bgs-btns-banner w-auto p-3 text-light">EXPLORAR CURSOS <i class="bi bi-arrow-right-short ms-auto"></i></a>
                        <a href="" class="d-flex btn btn-outline-light w-auto p-3">CREAR CURSOS <i class="bi bi-arrow-right-short ms-auto"></i></a>
                    </div>
                </div>
                <div class="d-none d-lg-block col-12 mb-4">
                    <img src="Interfaz/Activos/img-banner main section.webp" alt="" class="img-fluid rounded-4">
                </div>
            </div>
        </div>
    </section>
    <!-- Carrusel de Propuestas para pantalla mobil -->
    <section class="my-4">
        <div class="text-dark my-4 text-center">
            <h1 class="mi-color-text">¿POR QUÉ ELEGIRNOS?</h1>
        </div>
        <div id="carouselPropuestas" class="carousel slide carousel-dark"  data-bs-ride="carousel">
            <div class="carousel-inner container-fluid">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-6 col-lg-3 bg-light p-4">
                            <div>
                                <i class="bi bi-person-workspace fs-4"></i>
                            </div>
                            <h5 class="fw-bold my-3 mi-color-text">Profesores Expertos</h5>
                            <p class="text-muted small mi-color-text">Aprende de los mejores profesionales de la industria.</p>
                        </div>
                        <div class="col-6 col-lg-3 bg-transparent p-4">
                            <div>
                                <i class="bi bi-clock fs-4"></i>
                            </div>
                            <h5 class="fw-bold my-3 mi-color-text">Aprende a tu Ritmo</h5>
                            <p class="text-muted small mi-color-text">Accede a cursos en cualquier momento, con acceso de por vida.</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-6 col-lg-3 bg-light p-4">
                            <div>
                                <i class="bi bi-person-vcard-fill fs-4"></i>
                            </div>
                            <h5 class="fw-bold my-3 mi-color-text">Obten tu Certificado</h5>
                            <p class="text-muted small mi-color-text">Gana certificados para que reconozca la mejora en tu carrera.</p>
                        </div>
                        <div class="col-6 col-lg-3 p-4">
                            <div>
                                <i class="bi bi-headset fs-4"></i>
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
    </section>
</main>
<?php include 'Interfaz/Incluidos/pie.php';?>