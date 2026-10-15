<?php
require_once __DIR__ . '/../../carga.php';
include RUTA_BASE . '/Interfaz/Incluidos/cabecera.php';
?>

<main>
    <div class="container py-5">
        <div class="row">
            <!-- Contenedor de datos y opciones -->
            <div class="col-12 col-lg-4 mb-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
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
                        <a href="" class="list-group-item list-group-item-action text-start border-0 rounded-3 mb-1">
                            <i class="bi bi-person me-2"></i>
                            Mis Datos
                        </a>
                        <a href="" class="list-group-item list-group-item-action text-start border-0 rounded-3 mb-1">
                            <i class="bi bi-lock me-2"></i>
                            Cambiar Contraseña
                        </a>
                        <a href="" class="list-group-item list-group-item-action text-start border-0 rounded-3 mb-1">
                            <i class="bi bi-book me-2"></i>
                            Mis Cursos
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
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
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
                <div class="card border-top shadow-sm rounded-4 p-4 mb-4">
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
            </div>
        </div>
    </div>
</main>

<script src="../Activos/validaciones.js"></script>

<?php
include RUTA_BASE . '/Interfaz/Incluidos/pie.php';
?>