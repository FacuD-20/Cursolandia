<?php 
require_once __DIR__ . '/../../carga.php';
include RUTA_BASE . '/Interfaz/Incluidos/cabecera.php'; 
?>

<main>
    <section class="container-fluid">
        <div class="row">
            <!-- Apartado del Menu de filtros en PC -->
            <div class="d-none d-lg-block col-lg-3 bg-light py-5">
                <div class="card bg-white rounded-4 border-0 shadow-sm p-4">
                    <form action="" method="POST" name="fpcfiltros">
                        <h5 class="mi-color-text fw-bold border-bottom border-secondary-subtle pb-2 mb-3">Etiquetas</h5>
                        <div class="form-check mb-2">
                            <input type="checkbox" class="form-check-input" name="nombreetiqueta" id="nombreetiquetapc">
                            <label for="nombreetiquetapc">Nombre Etiqueta</label>
                        </div>
                        <h5 class="mi-color-text fw-bold border-bottom border-secondary-subtle pb-2 mb-3 mt-4">Tipo</h5>
                        <div class="form-check mb-2">
                            <input type="checkbox" class="form-check-input" name="checkgratis" id="checkgratispc">
                            <label for="checkgratispc">Gratis</label>
                        </div>
                        <div class="form-check mb-2">
                            <input type="checkbox" class="form-check-input" name="checkpagos" id="checkpagospc">
                            <label for="checkpagospc">Pagos</label>
                        </div>
                        <div class="form-check mb-2">
                            <input type="checkbox" class="form-check-input" name="checknuevos" id="checknuevospc">
                            <label for="checknuevospc">Nuevos</label>
                        </div>
                        <button type="submit" class="btn mis-btnes-sinbg text-light w-100 mt-4" name="baplicar"><i class="bi bi-filter me-1"></i>Aplicar Filtros</button>
                    </form>
                </div>
            </div>
            <!-- Apartado del Catalogo -->
            <div class="col-12 col-lg-9 py-5 px-4">
                <h2 class="mi-color-text fw-bold mb-4">Catalogo de Cursos</h2>
                <!-- Boton que lanza el offcanvas para menu de filtros en celular -->
                <button type="button" class="btn mis-btnes-sinbg w-100 mb-4 d-lg-none fw-bold" data-bs-toggle="offcanvas" data-bs-target="#filtrosdelcelular"><i class="bi bi-filter"></i>Filtros</button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="filtrosdelcelular">
                    <!-- Cabecera del offcanvas -->
                    <div class="offcanvas-header border-bottom">
                        <h4 class="onffcanvas-title fw-bold mi-color-text">Filtros</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                    </div>
                    <!-- Formulario de Filtros -->
                    <div class="p-3">
                        <form action="" method="POST" name="fcelularfiltros">
                            <h5 class="mi-color-text fw-bold border-bottom border-secondary-subtle pb-2 mb-3">Etiquetas</h5>
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="nombreetiqueta" id="nombreetiquetac">
                                <label for="nombreetiquetac">Nombre Etiqueta</label>
                            </div>
                            <h5 class="mi-color-text fw-bold border-bottom border-secondary-subtle pb-2 mb-3 mt-4">Tipo</h5>
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="checkgratis" id="checkgratisc">
                                <label for="checkgratisc">Gratis</label>
                            </div>
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="checkpagos" id="checkpagosc">
                                <label for="checkpagosc">Pagos</label>
                            </div>
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="checknuevos" id="checknuevosc">
                                <label for="checknuevosc">Nuevos</label>
                            </div>
                            <button type="submit" class="btn mis-btnes-sinbg text-light w-100 mt-4 rounded-5" name="baplicar"><i class="bi bi-filter me-1"></i>Aplicar Filtros</button>
                        </form>
                    </div>
                </div>
                <!-- Fila de Cursos -->
                <div class="row g-4">
                    <!-- Primera Tarjeta de curso -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4">
                            <img src="" alt="" class="card-img-top rounded-top-4" style="height: 180px; object-fit: cover;">
                            <div class="card-body d-flex flex-column p-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge text-bg-light border text-muted">Etiqueta</span>
                                    <span class="badge mi-bg-bronce">Gratis</span>
                                </div>
                                <h5 class="card-title fw-bold mi-color-text mb-2">Nombre Curso</h5>
                                <p class="text-muted small mb-1">
                                    <i class="bi bi-calendar-event me-1"></i> Inicio: xx/xx/xxxx
                                </p>
                                <p class="text-muted small mb-3">
                                    <i class="bi bi-calendar-check me-1"></i> Fin: xx/xx/xxxx
                                </p>
                                <a href="<?php echo URL_BASE; ?>/Interfaz/Cursos/detalles_c.php" class="btn mis-btnes-sinbg rounded-pill w-100 mt-auto fw-bold">
                                    Detalles del Curso <i class="bi bi-arrow-right-short"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php 
include RUTA_BASE . '/Interfaz/Incluidos/pie.php'; 
?>