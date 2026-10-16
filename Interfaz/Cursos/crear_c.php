<?php
require_once __DIR__ . '/../../carga.php';
include RUTA_BASE . '/Interfaz/Incluidos/cabecera.php';
?>

<main>
    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">                
                <!-- Encabezado con titulo e informacion sobre cursos creados -->
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-2">
                    <h2 class="fw-bold mi-color-text mb-0">Crear Nuevo Curso</h2>
                    <span class="badge mi-bg-grisazulado px-3 py-2 align-self-start align-self-sm-center">
                        Cursos activos: 1 / 3 (Plan Gratuito)
                    </span>
                </div>
                <!-- Formulario -->
                <form action="" method="POST" name="fcrearcurso" enctype="multipart/form-data" class="needs-validation" novalidate>                    
                    <!-- Informacion del Curso -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-4">
                        <h4 class="fw-bold mi-color-text mb-4 border-bottom pb-2">1. Información del Curso</h4>
                        <div class="row g-3">
                            <!-- Titulo -->
                            <div class="col-12">
                                <label for="titulo" class="form-label fw-bold small mi-color-text">Título del Curso *</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ej: Programación en PHP y SQLite" required>
                                <div class="invalid-feedback">Por favor, ingresá un título para el curso.</div>
                            </div>
                            <!-- Descripcion -->
                            <div class="col-12">
                                <label for="descripcion" class="form-label fw-bold small mi-color-text">Descripción *</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" placeholder="Describí de qué trata el curso y qué van a aprender..." required></textarea>
                                <div class="invalid-feedback">La descripción del curso es obligatoria.</div>
                            </div>
                            <!-- Fecha de inicio/fin -->
                            <div class="col-12 col-md-6">
                                <label for="fecha_inicio" class="form-label fw-bold small mi-color-text">Fecha de Inicio *</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                                <div class="invalid-feedback">Seleccioná una fecha de inicio.</div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="fecha_fin" class="form-label fw-bold small mi-color-text">Fecha de Fin *</label>
                                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                                <div class="invalid-feedback">Seleccioná una fecha de finalización.</div>
                            </div>
                            <!-- Etiquetas -->
                            <div class="col-12">
                                <label for="etiquetas" class="form-label fw-bold small mi-color-text">
                                    Etiquetas
                                    <span class="text-muted fw-normal">(Opcionales)</span>
                                </label>
                                <input type="text" class="form-control" id="etiquetas" name="etiquetas" placeholder="Ej: PHP, Web, Base de Datos (separadas por coma)">
                            </div>
                            <div class="form-text small mt-3">
                                    <i class="bi bi-info-circle me-1"></i> 
                                    <strong>*</strong> Campos que contengan un asterisco seran obligatorios.
                                </div>
                        </div>
                    </div>
                    <!-- Precios, cupos y adjuntador de archivo -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-4">
                        <h4 class="fw-bold mi-color-text mb-4 border-bottom pb-2">2. Configuración y Material</h4>
                        <div class="row g-3">
                            <!-- Precio -->
                            <div class="col-12 col-md-6">
                                <label for="precio" class="form-label fw-bold small mi-color-text">
                                    Precio ($)
                                    <span class="text-muted fw-normal">(Opcional)</span>
                                </label>
                                <input type="number" min="0" step="0.01" class="form-control" id="precio" name="precio" placeholder="Vacío o 0 = Gratis">
                            </div>
                            <!-- Cupos -->
                            <div class="col-12 col-md-6">
                                <label for="cupo" class="form-label fw-bold small mi-color-text">
                                    Cupo <span class="text-muted fw-normal">(Opcional)</span>
                                </label>
                                <input type="number" min="1" class="form-control" id="cupo" name="cupo" placeholder="Vacío = Sin límite">
                            </div>
                            <!-- Adjuntar Archivo -->
                            <div class="col-12 mt-3">
                                <label for="materiales" class="form-label fw-bold small mi-color-text">
                                    Material del Curso <span class="text-muted fw-normal">(Archivos adjuntos)</span>
                                </label>
                                <input type="file" class="form-control" id="materiales" name="materiales" multiple>
                                <div class="form-text small mt-3">
                                    <i class="bi bi-info-circle me-1"></i> 
                                    <strong>Plan Gratuito:</strong> máx. 5 archivos (hasta 5 MB c/u y 10 MB en total). <strong>Plan Pro:</strong> sin límite.
                                </div>
                            </div>                            
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn mis-bgs-btns text-light w-100 py-2 fw-bold">
                                    Publicar Curso
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<script src="../Activos/validaciones.js"></script>

<?php include RUTA_BASE . '/Interfaz/Incluidos/pie.php';?>