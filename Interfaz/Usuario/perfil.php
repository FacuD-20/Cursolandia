<?php
    require_once __DIR__ . '/../../carga.php';
    include RUTA_BASE . '/Interfaz/Incluidos/cabecera.php';
    require_once RUTA_BASE . '/Logica/Solicitud_p.php';
    require_once RUTA_BASE . '/Persistencia/Consultas/UsuarioBD.php';
    require_once RUTA_BASE . '/Persistencia/Consultas/Solicitud_pBD.php';
    require_once RUTA_BASE . '/Persistencia/Consultas/InteresesBD.php';
    require_once RUTA_BASE . '/Persistencia/Consultas/EtiquetaBD.php';
    
    //Protegemos la pagina de ser ingresada de afuera
    if (!isset($_SESSION["id_usuario"])) {
        echo "<script>window.location.href = 'acceder.php';</script>";
        exit;
    }
    //Extraemos los nombres de los inputs de post.
    extract($_POST);

    //Instanciamos los objetos BD
    $ubdd = new UsuarioBD();
    $spbdd = new SolicitudProBD();
    $ebdd = new EtiquetaBD();
    $ibdd = new InteresesBD();
    //Obtenemos todos los datos del usuario
    $datos_u = $ubdd -> datos_usuario($_SESSION["id_usuario"]);
    $ins = $ubdd -> inscripciones_a_cursos($datos_u["U_ID"]);
    $cant_c = $ubdd -> cantidad_cursos($datos_u["U_ID"]);
    //Verificamos que tenga intereses
    $intereses = !empty($datos_u["Etiquetas"]) ? explode(", ", $datos_u["Etiquetas"]) : array();
    //Obtenemos todas las etiquetas
    $lista_e = $ebdd -> listar_etiquetas();
    //Definimos una variable para un posible error
    $merror_email = "";
    $merror_contra = "";
    $merror_pro = "";
    $mensaje_ex = "";
    $mexito_int_ant = "";
    //Actualizamos Email
    if (isset($actualizaremail) && $actualizaremail == 1) {
        if (trim($emailperfil) == $datos_u["U_Email"]) {
            $mensaje_error = "Ingrese un mail distinto al que tenia antes.";
        } else {
            try {
                $ubdd -> actualizar_columna($_SESSION["id_usuario"],"U_Email",$emailperfil);
                session_destroy();
                echo "<script>window.location.href = 'acceder.php';</script>";
                exit;
            } catch (Exception $e) {
                $mensaje_error = $e -> getMessage();
            }
        }
    }
    //Actualizamos Contraseña
    if (isset($actualizarcontra) && $actualizarcontra == 1) {
        //Verificamos que sean iguales
        if ($p1 === $p2) {
            if ($p1 == $datos_u["U_Contrasena"]) {
                $mensaje_error = "Ingrese una contraseña distinta a la que tenia antes.";
            } else {
                $ubdd -> actualizar_columna($_SESSION["id_usuario"],"U_Contrasena",$p1);
                session_destroy();
                echo "<script>window.location.href = 'acceder.php';</script>";
                exit;
            }
        } else {
            $mensaje_error = "Las contraseñas no coinciden.";
        }
    }
    //Actualizamos Antecedentes e Intereses
    if (isset($acantecedentes) && $acantecedentes == 1) {
        //actualizamos la columna de Antecedentes
        $ubdd -> actualizar_columna($_SESSION["id_usuario"],"U_Ant",$antecedentes_perfil);
        //Ingresamos los nuevos intereses chekeados si los hay, sino lo inicializamos con un array vacio.
        $nuevos_int = isset($etiquetas) ? $etiquetas : array();
        $ibdd -> actualizar_intereses($_SESSION["id_usuario"], $nuevos_int);
        //Actualizamos los datos para que se muestren los nuevos cambios
        $datos_u = $ubdd -> datos_usuario($_SESSION["id_usuario"]);
        $intereses = !empty($datos_u["Etiquetas"]) ? explode(", ", $datos_u["Etiquetas"]) : array();
        $mexito_int_ant = "Intereses y/o Antecentedes actualizados exitosamente.";
    }
    /*Actualizamos Foto de perfil (Verificamos que el usuario haya mandando el formulario y 
    que no haya ningun error*/
    if (isset($_FILES["foto_perfil"]) && $_FILES["foto_perfil"]["error"] === 0) {
        //Guardamos la ruta de la carpeta donde se va a subir
        $ruta = RUTA_BASE . "/Subidos/Img/Usuarios/";
        //Obtenemos la extension, creamos un nuevo nombre para que no sea tan largo y creamos la nuevo ruta de des
        $extension = pathinfo($_FILES["foto_perfil"]["name"], PATHINFO_EXTENSION);
        $nom_foto = "perfil_" . $_SESSION["id_usuario"] . "." . $extension;
        $ruta_completa = $ruta . $nom_foto;
        //Obtenemos el archivo temporal y lo movemos a la carpeta de la ruta.
        if (move_uploaded_file($_FILES["foto_perfil"]["tmp_name"], $ruta_completa)) {
            //Actualizamos la foto de perfil del usuario
            $ubdd->actualizar_columna($_SESSION["id_usuario"], "U_FotoDePerfil", $nom_foto);
            //Guardamos la foto en la variable SESSION para mostrarla en la pag.
            $_SESSION["fp_usuario"] = $nom_foto;
            echo "<script>window.location.href = 'perfil.php';</script>";
            exit;
        }
        $datos_u = $ubdd -> datos_usuario($_SESSION["id_usuario"]);
    }
    //Fecha de Hoy para verificar vencimientos
    $hoy = date('Y-m-d');
    //Verificamos que el usuario haya mandado alguna solicitud pro
    if (isset($solicitar_pro) && $solicitar_pro == 1) {
        if (isset($_FILES["adjunto_pro"]) && $_FILES["adjunto_pro"]["error"] === 0) {
            //Nueva ruta
            $nueva_r = RUTA_BASE . "/Subidos/Comprobantes/";
            //Extraemos la extension del archivo, armamos un nuevo nombre, y lo guardamos en la carpeta correspondiente
            $ext = pathinfo($_FILES["adjunto_pro"]["name"], PATHINFO_EXTENSION);
            $nuevo_nom = "comprobante_" . $_SESSION["id_usuario"] . "_" . $hoy . "." . $ext;
            $r_destino = $nueva_r . $nuevo_nom;
            /*Si se actualizo bien la ruta, se crea un nuevo objeto solicitud, el cual es pasado por parametro
            Para ingresarla a la base de datos.*/
            if (move_uploaded_file($_FILES["adjunto_pro"]["tmp_name"], $r_destino)) {
                $sp = new Solicitud_p($_SESSION["id_usuario"], $mensaje_pro, $nuevo_nom, date('Y-m-d H:i:s'));
                $spbdd -> ingresar_solicitud($sp);
                $mensaje_ex = "Solicitud enviada. Un administrador revisara su comprobante pronto.";
            }
        } else {
            $mensaje_error = "Error al subir el comprobante. Intente nuevamente.";
        }
    }
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
                        <form action="" method="POST" enctype="multipart/form-data">
                            <label for="input_foto_perfil" class="btn btn-sm mi-btn-r rounded-circle position-absolute bottom-0 end-0 shadow-sm" style="cursor: pointer;">
                                <i class="bi bi-camera"></i>
                            </label>
                            <input type="file" id="input_foto_perfil" name="foto_perfil" class="d-none" accept="image/*" onchange="this.form.submit()">
                        </form>
                    </div>
                    <!-- Etiqueta que muestra el plan -->
                    <h4><?php echo $datos_u["U_Nom"] . " " . $datos_u["U_Ape"];?></h4>
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
                        <a href="#cursos_ins" class="list-group-item list-group-item-action text-start border-0 rounded-3 mb-1">
                            <i class="bi bi-book me-2"></i>
                            Cursos Inscriptos
                        </a>
                        <a href="#mis_cursos" class="list-group-item list-group-item-action text-start border-0 rounded-3 mb-1">
                            <i class="bi bi-person-workspace me-2"></i>
                            Cursos Creados
                        </a>
                        <a href="#intereses_antecedentes" class="list-group-item list-group-item-action text-start border-0 rounded-3 mb-1">
                            <i class="bi bi-bookmark-plus me-2"></i>
                            Antecedentes e Intereses
                        </a>
                        <?php if ($datos_u["U_Plan"] != "Pro"): ?> 
                            <a href="#plan_pro" class="list-group-item list-group-item-action text-start border-0 rounded-3 mb-1">
                                <i class="bi bi-star-fill text-warning me-2"></i>
                                Plan Pro
                            </a>
                        <?php endif; ?>
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
                    <h4 class="fw-bold mi-color-text mb-3">Mis Datos</h4>
                    <!-- Formulario de Datos -->
                    <?php if ($merror_email != "") { echo "<p class='text-small text-danger'>" . $merror_email . "</p>";} ?>
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
                    <?php if ($merror_contra != "") { echo "<p class='text-small text-danger'>" . $merror_contra . "</p>";}?>
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
                <!-- Seccion "Cursos Inscriptos" -->
                <div class="card border-top shadow-sm rounded-4 p-4 mb-4" id="cursos_ins">
                    <h4 class="fw-bold mi-color-text mb-4">Cursos Inscriptos</h4>
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
                                            <?php if ($ci["Estado_Tomo"] == 'pendiente'): ?>
                                                <a href="<?php echo URL_BASE . "/Interfaz/Usuario/perfil.php";?>" class="btn mis-btnes-sinbg rounded-pill w-100 mt-auto fw-bold">Pendiente<i class="bi bi-arrow-right-short"></i></a>
                                            <?php else: ?>
                                                <a href="<?php echo URL_BASE . "/Interfaz/Cursos/aula_c.php?id_c={$ci["C_ID"]}";?>" class="btn mis-btnes-sinbg rounded-pill w-100 mt-auto fw-bold">Aula del Curso<i class="bi bi-arrow-right-short"></i></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Seccion "Cursos Creados" -->
                <div class="card border-top shadow-sm rounded-4 p-4 mb-4" id="mis_cursos">
                    <h4 class="fw-bold mi-color-text mb-4">Cursos Creados</h4>
                    <div class="row g-3">
                        <?php if (empty($cant_c)): ?>
                            <div class="col-12">
                                <p class="text-muted small mb-0">Aún no has creado ningún curso.</p>
                            </div>
                        <?php else: ?>
                            <?php foreach($cant_c as $c):?>
                                <?php 
                                    if ($c["C_Img"] == "imgcurso_pordefecto.png") {
                                        $img_c = URL_BASE . "/Interfaz/Activos/imgcurso_pordefecto.png";
                                    } else {
                                        $img_c = URL_BASE . "/Subidos/Img/Cursos/" . $c["C_Img"];
                                    }
                                ?>
                                <div class="col-12 col-lg-6">
                                    <div class="card h-100 shadow-sm border-0 rounded-4">
                                        <img src="<?php echo $img_c; ?>" alt="" class="card-img-top rounded-top-4" style="height: 180px; object-fit: cover;">
                                        <div class="card-body d-flex flex-column p-4">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <?php if ($c["C_FDFin"] < $hoy):?>
                                                    <span class="badge bg-danger">Creado / Inactivo</span>
                                                <?php else: ?>
                                                    <span class="badge bg-success">Creado / Activo</span>
                                                <?php endif; ?>
                                                <span class="badge text-bg-light border text-muted"><?php echo $c["C_Acceso"]?></span>
                                            </div>
                                            <h5 class="card-title fw-bold mi-color-text mb-2"><?php echo $c["C_Titulo"];?></h5>
                                            <p class="text-muted small mb-3"><i class="bi bi-calendar-range me-1"></i> Fecha y hora: <?php echo $c["C_FDInicio"] . " al ". $c["C_FDFin"]; ?></p>
                                            <a href="<?php echo URL_BASE . "/Interfaz/Cursos/aula_c.php?id_c={$c["C_ID"]}";?>" class="btn mis-btnes-sinbg rounded-pill w-100 mt-auto fw-bold">Aula del Curso<i class="bi bi-arrow-right-short"></i></a>
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
                    <?php if ($mexito_int_ant != "") { echo "<p class='text-small text-success'>" . $mexito_int_ant . "</p>";}?>
                    <form action="" method="POST" name="fpintereses">
                        <!-- Intereses -->
                        <label class="form-label small fw-bold mi-color-text mb-2">Mis Intereses</label>
                        <div class="d-flex flex-wrap gap-2 mb-4">
                            <?php foreach($lista_e as $e): ?>
                                <?php
                                    $id_e = $e -> id;
                                    $nom_e = $e -> nombre;
                                    $marcado = in_array($nom_e, $intereses) ? "checked" : "";
                                ?>
                                <input type="checkbox" class="btn-check" name="etiquetas[]" id="perf_<?php echo $id_e; ?>" value="<?php echo $id_e; ?>" autocomplete="off" <?php echo $marcado; ?>>
                                <label class="btn mis-btnes-sinbg rounded-pill px-3 py-1 small fw-bold" for="perf_<?php echo $id_e; ?>">
                                    <?php echo htmlspecialchars($nom_e); ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <!-- Antecedentes -->
                        <div class="mb-3">
                            <label for="antecedentes_perfil" class="form-label small fw-bold mi-color-text mb-1">Mis Antecedentes</label>
                            <textarea class="form-control" id="antecedentes_perfil" name="antecedentes_perfil" rows="3" placeholder="Estudios, experiencia o conocimientos previos..."><?php echo trim($datos_u["U_Ant"]); ?></textarea>
                        </div>
                        <button type="submit" name="acantecedentes" value="1" class="btn mis-bgs-btns text-light w-100 py-2 fw-bold">
                            Actualizar Intereses y Antecedentes
                        </button>
                    </form>
                </div>
                <!-- Seccion "Solicitar Plan Pro" solo si es plan Gratuito -->
                <?php if ($datos_u["U_Plan"] != "Pro"): ?>
                    <div class="card mi-border-color-pro shadow-sm rounded-4 p-4 mb-4" id="plan_pro">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="fw-bold mi-color-text mb-0">
                                <i class="bi bi-star-fill text-warning me-2"></i>Pasate al Plan Pro
                            </h4>
                            <span class="badge mi-bg-grisazulado px-3 py-2">$9.99 / mes</span>
                        </div>
                        <p class="text-muted small mb-2">
                            Eliminá el límite de 3 cursos activos y subí archivos sin restricción de tamaño siguiendo estos pasos:
                        </p>
                        <p class="text-muted small mb-3">
                            <strong>1.</strong> Transfiera el abono mensual al alias <strong>facu.mp</strong> (Mercado Pago).<br>
                            <strong>2.</strong> Descarge o capture la pantalla con el comprobante de pago.<br>
                            <strong>3.</strong> Adjuntelo acá abajo con un breve mensaje (Opcional) para que el 
                            administrador actualice su plan Gratuito a Pro y clikee el boton <strong>Enviar Comprobante al Administrador</strong>.
                        </p>
                        <?php if ($mensaje_ex != "") { echo "<p class='text-small text-success'>" . $mensaje_ex . "</p>";}?>
                        <?php if ($merror_pro != "") { echo "<p class='text-small text-danger'>" . $merror_pro . "</p>";}?>
                        <form action="" method="POST" name="fpsolicitudpro" enctype="multipart/form-data" class="needs-validation" novalidate>
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <label for="mensaje_pro" class="form-label small fw-bold mi-color-text mb-1">Mensaje para el Administrador (Opcional)</label>
                                    <input type="text" class="form-control" name="mensaje_pro" placeholder="Ej: Adjunto comprobante de transferencia...">
                                    <div class="invalid-feedback">Escribí un mensaje breve.</div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="adjunto_pro" class="form-label small fw-bold mi-color-text mb-1">Comprobante de Pago (Adjunto) *</label>
                                    <input type="file" class="form-control" name="adjunto_pro" required>
                                    <div class="invalid-feedback">Adjuntá el comprobante de pago.</div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="solicitar_pro" value="1" class="btn mis-bgs-btns-pro w-100 py-2 fw-bold">
                                        <i class="bi bi-send me-1"></i> Enviar Comprobante al Administrador
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<script src="<?php echo URL_BASE; ?>/Interfaz/Activos/validaciones.js"></script>

<?php
include RUTA_BASE . '/Interfaz/Incluidos/pie.php';
?>