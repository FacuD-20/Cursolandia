<?php
require_once __DIR__ . '/../../carga.php';
include RUTA_BASE . '/Interfaz/Incluidos/cabecera.php';
?>

<main>
    <div class="container py-5">
        <div class="row">
            <!-- Contenedor de datos y opciones -->
            <div class="col-12 col-lg-4 mb-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 text-center sticky-lg-top">
                    <!-- Imagen de Perfil -->
                    <div class="position-relative d-inline-block mx-auto mb-3">
                        <img src="" alt="" class="rounded-circle img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;">
                        <button class="btn btn-sm mi-btn-r rounded-circle position-absolute bottom-0 end-0 shadow-sm"><i class="bi bi-camera"></i></button>
                    </div>
                    <!-- Etiqueta que muestra el plan -->
                    <h4>Nombre de Usuario</h4>
                    <div class="mb-4">
                        <span class="badge rounded-pill mi-bg-bronce px-3 py-2">Plan Gratuito</span>
                    </div>
                    <!-- Seccion para las cantidad de inscripciones y creaciones -->
                    <div class="row border-top border-bottom py-3">
                        <div class="col-6 border-end">
                            <i class="bi bi-person-badge text-muted"></i>
                            <p class="text-muted small mb-1">Cursos Inscriptos</p>
                            <h4 class="fw-bold mi-color-text mb-0">Num</h4>
                        </div>
                        <div class="col-6">
                            <i class="bi bi-pencil-square text-muted"></i>
                            <p class="text-muted small mb-1">Cursos Creados</p>
                            <h4 class="fw-bold mi-color-text mb-0">Num</h4>
                        </div>                        
                    </div>
                    <!-- Lista de opciones -->
                    <div class="list-group list-group-flush mt-4">
                        <a href="#mis_datos" class="list-group-item list-group-item-action text-start border-0 rounded-3 mb-1">
                            <i class="bi bi-person me-2"></i>
                            Mis Datos
                        </a>
                        <a href="#cambiar_contraseña" class="list-group-item list-group-item-action text-start border-0 rounded-3 mb-1">
                            <i class="bi bi-lock me-2"></i>
                            Cambiar Contraseña
                        </a>
                        <a href="#mis_cursos" class="list-group-item list-group-item-action text-start border-0 rounded-3 mb-1">
                            <i class="bi bi-book me-2"></i>
                            Mis Cursos
                        </a>
                        <a href="#intereses_antecedentes" class="list-group-item list-group-item-action text-start border-0 rounded-3 mb-1">
                            <i class="bi bi-bookmark-plus me-2"></i>
                            Antecedentes e Intereses
                        </a>
                        <a href="#plan_pro" class="list-group-item list-group-item-action text-start border-0 rounded-3 mb-1">
                            <i class="bi bi-star-fill text-warning me-2"></i>
                            Plan Pro
                        </a>
                        <a href="" class="list-group-item list-group-item-action text-start border-0 rounded-3 text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i>
                            Cerrar Sesion
                        </a>
                    </div>
                </div>
            </div>
            <!-- Contenedor de datos personales -->
            <div class="col-12 col-lg-8">
                <!-- Seccion "Mis Datos" -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4" id="mis_datos">
                    <h4 class="fw-bold mi-color-text mb-4">Mis Datos</h4>
                    <!-- Formulario de Datos -->
                    <form action="" method="POST" name="fpdatosnuevos" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <!-- Nombre -->
                            <div class="col-12 col-lg-6">
                                <label for="" class="form-label small text-muted mb-1">Nombre</label>
                                <input type="text" value="Nombre" class="form-control" disabled>
                            </div>
                            <!-- Apellido -->
                            <div class="col-12 col-lg-6">
                                <label for="" class="form-label small text-muted mb-1">Apellido</label>
                                <input type="text" value="Apellido" class="form-control" disabled>                                
                            </div>
                            <!-- N° Documento -->
                            <div class="col-12 col-lg-6">
                                <label for="" class="form-label small text-muted mb-1">DNI</label>
                                <input type="text" value="DNI" class="form-control" disabled>                            
                            </div>
                            <!-- Email -->
                            <div class="col-12 col-lg-6">
                                <label for="" class="form-label small fw-bold mi-color-text mb-1">Email</label>
                                <input type="email" value="Email" class="form-control" name="emailperfil" id="emailperfil" required>                                
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn mis-bgs-btns text-light w-100 py-2 fw-bold">Guardar Cambios</button>                        
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Seccion "Cambiar Contraseña" -->
                <div class="card border-top shadow-sm rounded-4 p-4 mb-4" id="cambiar_contraseña">
                    <h4 class="fw-bold mi-color-text mb-4">Cambiar Contraseña</h4>
                    <form action="" method="POST" name="fpdatosnuevos" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <label for="" class="form-label small text-muted mb-1">Nueva Contraseña</label>
                                <input type="password" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-12 col-lg-4">
                                <label for="" class="form-label small text-muted mb-1">Confirmar Contraseña</label>
                                <input type="password" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-12 col-lg-4 mt-4">
                                <button type="submit" class="btn mis-bgs-btns text-light w-100 py-2 fw-bold">Actualizar Contraseña</button>                        
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Seccion "Mis Cursos" -->
                <div class="card border-top shadow-sm rounded-4 p-4 mb-4" id="mis_cursos">
                    <h4 class="fw-bold mi-color-text mb-4">Mis Cursos</h4>
                    <div class="row g-3">
                        <div class="col-12 col-lg-6">
                            <div class="card h-100 shadow-sm border-0 rounded-4">
                                <img src="" alt="" class="card-img-top rounded-top-4" style="height: 180px; object-fit: cover;">
                                <div class="card-body d-flex flex-column p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge bg-success">Inscripto / Activo</span>
                                        <span class="badge text-bg-light border text-muted">Público</span>
                                    </div>
                                    <h5 class="card-title fw-bold mi-color-text mb-2">Nombre Curso</h5>
                                    <p class="text-muted small mb-3"><i class="bi bi-calendar-range me-1"></i> Activo: xx/xx/xx al xx/xx/xx</p>
                                    <a href="" class="btn mis-btnes-sinbg rounded-pill w-100 mt-auto fw-bold">Contenido del Curso<i class="bi bi-arrow-right-short"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Seccion "Intereses y Antecedentes" -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4" id="intereses_antecedentes">
                    <h4 class="fw-bold mi-color-text mb-3">Intereses y Antecedentes</h4>
                    <form action="" method="POST" name="fpintereses">
                        <!-- Intereses -->
                        <label class="form-label small fw-bold mi-color-text mb-2">Mis Intereses</label>
                        <div class="d-flex flex-wrap gap-2 mb-4">
                            <input type="checkbox" class="btn-check" name="intereses[]" id="perf_prog" value="Programacion" autocomplete="off" checked>
                            <label class="btn mis-btnes-sinbg rounded-pill px-3 py-1 small fw-bold" for="perf_prog">
                                <i class="bi bi-code-slash me-1"></i> Programación
                            </label>
                        </div>
                        <!-- Antecedentes -->
                        <div class="mb-3">
                            <label for="antecedentes_perfil" class="form-label small fw-bold mi-color-text mb-1">Mis Antecedentes</label>
                            <textarea class="form-control" id="antecedentes_perfil" name="antecedentes_perfil" rows="3" placeholder="Estudios, experiencia o conocimientos previos...">Estudiante de desarrollo web con conocimientos en HTML, CSS, Bootstrap y bases de datos.</textarea>
                        </div>
                        <button type="submit" class="btn mis-bgs-btns text-light w-100 py-2 fw-bold">
                            Actualizar Intereses y Antecedentes
                        </button>
                    </form>
                </div>
                <!-- Seccion "Solicitar Plan Pro" -->
                <div class="card mi-border-color-pro shadow-sm rounded-4 p-4 mb-4" id="plan_pro">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fw-bold mi-color-text mb-0">
                            <i class="bi bi-star-fill text-warning me-2"></i>Pasate al Plan Pro
                        </h4>
                        <span class="badge mi-bg-grisazulado px-3 py-2">$9.99 / mes</span>
                    </div>
                    <p class="text-muted small mb-3">
                        Eliminá el límite de 3 cursos activos y subí archivos sin restricción de tamaño. Si ya realizaste el pago, enviá tu comprobante para que el administrador active tu cuenta Pro.
                    </p>
                    <form action="" method="POST" name="fpsolicitudpro" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label for="mensaje_pro" class="form-label small fw-bold mi-color-text mb-1">Mensaje para el Administrador *</label>
                                <input type="text" class="form-control" name="mensaje_pro" placeholder="Ej: Adjunto comprobante de transferencia..." required>
                                <div class="invalid-feedback">Escribí un mensaje breve.</div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="adjunto_pro" class="form-label small fw-bold mi-color-text mb-1">Comprobante de Pago (Adjunto) *</label>
                                <input type="file" class="form-control" name="adjunto_pro" required>
                                <div class="invalid-feedback">Adjuntá el comprobante de pago.</div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn mis-bgs-btns-pro w-100 py-2 fw-bold">
                                    <i class="bi bi-send me-1"></i> Enviar Comprobante al Administrador
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="<?php echo URL_BASE; ?>/Interfaz/Activos/validaciones.js"></script>

<?php
include RUTA_BASE . '/Interfaz/Incluidos/pie.php';
?>