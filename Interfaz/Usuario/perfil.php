<?php
    require_once __DIR__ . '/../../carga.php';
    include RUTA_BASE . '/Interfaz/Incluidos/cabecera.php';
    require_once RUTA_BASE . '/Persistencia/Consultas/UsuarioBD.php';
    extract($_POST);

    //Instanciamos los objetos BD
    $ubdd = new UsuarioBD();
    //Obtenemos todos los datos del usuario
    $datos_u = $ubdd -> datos_usuario($_SESSION["id_usuario"]);
    $ins = $ubdd -> inscripciones_a_cursos($datos_u["U_ID"]);
    $cant_c = $ubdd -> cantidad_cursos($datos_u["U_ID"]);
    //Verificamos que tenga intereses
    $intereses = explode(", ",$datos_u["Etiquetas"]);
    //Actualizamos Email
    if (isset($actualizaremail) && $actualizaremail == 1) {
        //insertar email
    }
    //Actualizamos Contraseña
    if (isset($actualizarcontra) && $actualizarcontra == 1) {
        if ($p1 === $p2) {
            //insertar
        }
    }
    //Actualizamos Intereses

    //Fecha de Hoy para verificar vencimientos
    $hoy = date('Y-m-d');
?>

<main>
    <div class="container py-5">
        <div class="row">
            <!-- Contenedor de datos y opciones -->
            <div class="col-12 col-lg-4 mb-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 text-center sticky-lg-top">
                    <!-- Imagen de Perfil -->
                    <div class="position-relative d-inline-block mx-auto mb-3">
                        <?php
                            if ($datos_u["U_FotoDePerfil"] == "avatar_pordefecto.avif") {
                                $img_u = URL_BASE . "/Interfaz/Activos/avatar_pordefecto.avif";
                            } else {
                                $img_u = URL_BASE . "/Subidos/Img/Usuarios/" . $datos_u["U_FotoDePerfil"];
                            }
                        ?>
                        <img src="<?php echo $img_u; ?>" alt="" class="rounded-circle img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;">
                        <button class="btn btn-sm mi-btn-r rounded-circle position-absolute bottom-0 end-0 shadow-sm"><i class="bi bi-camera"></i></button>
                    </div>
                    <!-- Etiqueta que muestra el plan -->
                    <h4><?php echo $datos_u["U_Nom"];?></h4>
                    <div class="mb-4">
                        <span class="badge rounded-pill mi-bg-bronce px-3 py-2"><?php echo $datos_u["U_Plan"]?></span>
                    </div>
                    <!-- Seccion para las cantidad de inscripciones y creaciones -->
                    <div class="row border-top border-bottom py-3">
                        <!-- Cursos Inscriptos -->
                        <div class="col-6 border-end">
                            <i class="bi bi-person-badge text-muted"></i>
                            <p class="text-muted small mb-1">Cursos Inscriptos</p>
                            <h4 class="fw-bold mi-color-text mb-0"><?php echo count($ins);?></h4>
                        </div>
                        <!-- Cursos Creados -->
                        <div class="col-6">
                            <i class="bi bi-pencil-square text-muted"></i>
                            <p class="text-muted small mb-1">Cursos Creados</p>
                            <h4 class="fw-bold mi-color-text mb-0"><?php echo count($cant_c); ?></h4>
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
                        <a href="<?php echo URL_BASE . "/Logica/cerrar_s.php";?>" class="list-group-item list-group-item-action text-start border-0 rounded-3 text-danger">
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
                                <input type="text" value="<?php echo $datos_u["U_Nom"];?>" class="form-control" disabled>
                            </div>
                            <!-- Apellido -->
                            <div class="col-12 col-lg-6">
                                <label for="" class="form-label small text-muted mb-1">Apellido</label>
                                <input type="text" value="<?php echo $datos_u["U_Ape"];?>" class="form-control" disabled>                                
                            </div>
                            <!-- N° Documento -->
                            <div class="col-12 col-lg-6">
                                <label for="" class="form-label small text-muted mb-1">DNI</label>
                                <input type="text" value="<?php echo $datos_u["U_DNI"];?>" class="form-control" disabled>                            
                            </div>
                            <!-- Email -->
                            <div class="col-12 col-lg-6">
                                <label for="" class="form-label small fw-bold mi-color-text mb-1">Email</label>
                                <input type="email" value="<?php echo $datos_u["U_Email"];?>" class="form-control" name="emailperfil" id="emailperfil" required>                                
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" name="actualizaremail" value="1" class="btn mis-bgs-btns text-light w-100 py-2 fw-bold">Guardar Cambios</button>                        
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
                                <input type="password" name="p1" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-12 col-lg-4">
                                <label for="" class="form-label small text-muted mb-1">Confirmar Contraseña</label>
                                <input type="password" name="p2" class="form-control" placeholder="" required>
                            </div>
                            <div class="col-12 col-lg-4 mt-4">
                                <button type="submit" name="actualizarcontra" value="1" class="btn mis-bgs-btns text-light w-100 py-2 fw-bold">Actualizar Contraseña</button>                        
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Seccion "Mis Cursos" -->
                <div class="card border-top shadow-sm rounded-4 p-4 mb-4" id="mis_cursos">
                    <h4 class="fw-bold mi-color-text mb-4">Mis Cursos</h4>
                    <div class="row g-3">
                        <?php if (empty($ins)): ?>
                            <div class="col-12">
                                <p class="text-muted small mb-0">Aún no estás inscripto en ningún curso.</p>
                            </div>
                        <?php else: ?>
                            <?php foreach($ins as $ci):?>
                                <?php 
                                    if ($ci["C_Img"] == "imgcurso_pordefecto.png") {
                                        $img_c = URL_BASE . "/Interfaz/Activos/imgcurso_pordefecto.png";
                                    } else {
                                        $img_c = URL_BASE . "/Subidos/Img/Cursos/" . $ci["C_Img"];
                                    }
                                ?>
                                <div class="col-12 col-lg-6">
                                    <div class="card h-100 shadow-sm border-0 rounded-4">
                                        <img src="<?php echo $img_c; ?>" alt="" class="card-img-top rounded-top-4" style="height: 180px; object-fit: cover;">
                                        <div class="card-body d-flex flex-column p-4">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <?php if ($ci["C_FDFin"] < $hoy):?>
                                                    <span class="badge bg-danger">Inscripto / Inactivo</span>
                                                <?php else: ?>
                                                    <span class="badge bg-success">Inscripto / Activo</span>
                                                <?php endif; ?>
                                                <span class="badge text-bg-light border text-muted"><?php echo $ci["C_Acceso"]?></span>
                                            </div>
                                            <h5 class="card-title fw-bold mi-color-text mb-2"><?php echo $ci["C_Titulo"];?></h5>
                                            <p class="text-muted small mb-3"><i class="bi bi-calendar-range me-1"></i> Fecha y hora: <?php echo $ci["C_FDInicio"] . " al ". $ci["C_FDFin"]; ?></p>
                                            <a href="<?php echo URL_BASE . "/Interfaz/Cursos/aula_c.php?id_c={$ci["C_ID"]}";?>" class="btn mis-btnes-sinbg rounded-pill w-100 mt-auto fw-bold">Aula del Curso<i class="bi bi-arrow-right-short"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Seccion "Intereses y Antecedentes" -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4" id="intereses_antecedentes">
                    <h4 class="fw-bold mi-color-text mb-3">Intereses y Antecedentes</h4>
                    <form action="" method="POST" name="fpintereses">
                        <!-- Intereses -->
                        <label class="form-label small fw-bold mi-color-text mb-2">Mis Intereses</label>
                        <div class="d-flex flex-wrap gap-2 mb-4">
                            <?php foreach($intereses as $i): ?>
                                <input type="checkbox" class="btn-check" name="intereses[]" id="perf_prog" value="<?php echo $i;?>" autocomplete="off" checked>
                                <label class="btn mis-btnes-sinbg rounded-pill px-3 py-1 small fw-bold" for="perf_prog">
                                    <?php echo $i; ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <!-- Antecedentes -->
                        <div class="mb-3">
                            <label for="antecedentes_perfil" class="form-label small fw-bold mi-color-text mb-1">Mis Antecedentes</label>
                            <textarea class="form-control" id="antecedentes_perfil" name="antecedentes_perfil" rows="3" placeholder="Estudios, experiencia o conocimientos previos..."><?php echo trim($datos_u["U_Ant"]); ?></textarea>
                        </div>
                        <button type="submit" name="acintereses" value="1" class="btn mis-bgs-btns text-light w-100 py-2 fw-bold">
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
                    <p class="text-muted small mb-3">
                        Alias: facu.mp
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