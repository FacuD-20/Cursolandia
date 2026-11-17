<?php
    require_once __DIR__ . '/../../carga.php';
    include RUTA_BASE . '/Interfaz/Incluidos/cabecera.php';
    require_once RUTA_BASE . "/Logica/Inscripcion.php";
    require_once RUTA_BASE . "/Persistencia/Consultas/InscripcionBD.php";
    require_once RUTA_BASE . "/Persistencia/Consultas/CursoBD.php";

    extract($_POST);
    //Guardamos las datos de la inscripcion del al curso actual
    $ins = null;
    //Veroficamos que el usuario este logeado
    if (isset($_GET["id_c"]) && isset($_SESSION["id_usuario"])) {
        $_SESSION["id_c"] = $_GET["id_c"];
        //Instanciamos el objeto de inscripcionesbd para verificar sus inscripciones
        $ibdd = new InscripcionBD();
        //Variable que nos permite saber si esta inscripto en el curso actual o no.
        $ins = $ibdd -> obtener_inscripcion($_SESSION["id_usuario"],$_SESSION["id_c"]);
    }
    //Instanciamos el objeto de cursodb
    $cbdd = new CursoBD();
    //Obtenemos todos los detalles del curso
    $datos_c = $cbdd -> datos_curso($_SESSION["id_c"]);
    //Variable para guardar un posible mensaje de error
    $mensaje = "";
    //Guardamos todas las etiquetas del curso y si no tiene, solo definimos un array vacio
    $etiquetas_c = !empty($datos_c["Etiquetas"]) ? explode(", ",$datos_c["Etiquetas"]) : array();
    //Si el usuario quiere inscribirse
    if (isset($inscribirse) && $inscribirse == 1) {
        //Control para que el titular no se pueda inscribir y para definir el estado de inscripcion
        if ($datos_c["U_ID_Crea"] == $_SESSION["id_usuario"]) {
            $mensaje = "El titular del curso no puede inscribirse.";
        } elseif ($datos_c["C_Costo"] > 0) {
            $i = new Inscripcion($_SESSION["id_usuario"],$datos_c["C_ID"]);
            $ibdd -> ingresar_inscripcion($i);
            $mensaje = "Inscripcion Completada. Le notificaremos cuando la hayan confirmado.";
        } else {
            $i = new Inscripcion($_SESSION["id_usuario"],$datos_c["C_ID"],'confirmada');
            $ibdd -> ingresar_inscripcion($i);
            echo "<script>window.location.href = 'aula_c.php?id_c={$datos_c["C_ID"]}';</script>";
            exit;
        }
    }
    if (isset($inscribirsevisitante) && $inscribirsevisitante == 1) {
        $mensaje = "Inicie sesion si quiere inscribirse a este curso.";
    }
    if (isset($aula) && $aula == 1) {
        echo "<script>window.location.href = 'aula_c.php?id_c={$datos_c["C_ID"]}';</script>";
        exit;
    }
?>

<main>
    <!-- Banner con fondo, imagen, etiqueta y titulo del curso -->
    <section class="mi-bg-grisazulado text-white py-5 mb-4">
        <div class="container">
            <div class="row align-items-center g-4">
                <!-- Imagen -->
                <div class="col-12 col-md-5 col-lg-4 text-center text-md-start">
                    <?php if ($datos_c["C_Img"] == "imgcurso_pordefecto.png") {
                            $img_r = URL_BASE . "/Interfaz/Activos/imgcurso_pordefecto.png";
                        } else {
                            $img_r = URL_BASE . "/Subidos/Img/Cursos/" . $datos_c["C_Img"];
                        }
                    ?>
                    <img src="<?php echo $img_r; ?>" alt="" class="img-fluid rounded-4 shadow-sm" style="max-height: 250px; width: 100%; object-fit: cover;">
                </div>
                <!-- Titulo y Etiqueta -->
                <div class="col-12 col-md-7 col-lg-8 text-center text-md-start">
                    <?php if (!empty($etiquetas_c)): ?>
                        <?php foreach($etiquetas_c as $e): ?>
                            <span class="badge rounded-pill mi-bg-bronce px-3 py-2 mb-2"><?php echo $e; ?></span>
                        <?php endforeach; ?>
                        <h1 class="fw-bold mb-3 display-5 text-white"><?php echo $datos_c["C_Titulo"]; ?></h1>
                    <?php endif; ?>
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
                            <i class="bi bi-people fs-3 text-muted mb-2 me-md-2 mb-md-0"></i>
                            <div>
                                <p class="fw-bold small mb-0">Cupos</p>
                                <?php if ($datos_c["C_Cupos"] == 0 || $datos_c["C_Cupos"] == null): ?>
                                    <span class="text-muted small">Ilimitados</span>
                                <?php else: ?>
                                    <span class="text-muted small"><?php echo $datos_c["C_Cupos"]; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Segunda Tarjeta -->
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm p-3 h-100 rounded-3 text-center text-md-start">
                        <div class="d-flex flex-column flex-md-row align-items-center">
                            <i class="bi bi-calendar-event fs-3 text-muted mb-2 me-md-2 mb-md-0"></i>                            
                            <div>
                                <p class="fw-bold small mb-0">Apertura de Aula</p>
                                <span class="text-muted small"><?php echo $datos_c["C_FDInicio"]; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tercera Tarjeta -->
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm p-3 h-100 rounded-3 text-center text-md-start">
                        <div class="d-flex flex-column flex-md-row align-items-center">
                            <i class="bi bi-calendar-check fs-3 text-muted mb-2 me-md-2 mb-md-0"></i>                            
                            <div>
                                <p class="fw-bold small mb-0">Cierre de Aula</p>
                                <span class="text-muted small"><?php echo $datos_c["C_FDFin"]; ?></span>                        
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
                        <!-- Header -->
                        <p>Precio total del curso</p>
                        <?php if ($datos_c["C_Costo"] > 0): ?>
                            <h2 class="mb-4 mt-2 fw-bold"><?php echo $datos_c["C_Costo"]; ?></h2>
                        <?php else: ?>
                            <h2 class="mb-4 mt-2 fw-bold">GRATIS</h2>
                        <?php endif; ?>
                        <!-- Cuerpo -->
                        <div class="text-start">
                            <!-- FDInicio -->
                            <p class="border-bottom border-top my-2 py-2 d-flex justify-content-between">
                                <span class="fw-bold mi-color-text">Apertura</span>
                                <span class="text-muted"><?php echo $datos_c["C_FDInicio"]; ?></span>
                            </p>
                            <!-- FDFin -->
                            <p class="border-bottom pb-2 mb-2 d-flex justify-content-between">
                                <span class="fw-bold mi-color-text">Cierre</span>
                                <span class="text muted"><?php echo $datos_c["C_FDFin"]; ?></span>
                            </p>
                            <!-- Cupos -->
                            <p class="border-bottom pb-2 d-flex justify-content-between">
                                <span class="fw-bold mi-color-text">Vacantes</span>
                                <?php if ($datos_c["C_Cupos"] == 0 || $datos_c["C_Cupos"] == null): ?>
                                    <span class="text-muted">Lugares Ilimitados</span>
                                <?php else: ?>
                                    <span class="text-muted"><?php echo $datos_c["C_Cupos"]; ?></span>
                                <?php endif; ?>
                            </p>
                        </div>
                        <?php if ($mensaje != "") { echo "<p class='text-small text-danger'>". $mensaje . "</p>";}?>
                        <form action="" method="POST" name="finscribirse">
                            <?php if ($ins == null): ?>
                                <button type="submit" name="inscribirsevisitante" value="1" class="btn w-100 mis-bgs-btns mt-auto text-light">Inscribirse</button>
                            <?php else: ?>
                                <?php if ($ins["U_ID_Tomo"] == $_SESSION["id_usuario"]): ?>
                                    <button type="submit" name="aula" value="1" class="btn w-100 mis-bgs-btns mt-auto text-light">Ir al Aula</button>
                                <?php else: ?>
                                    <button type="submit" name="inscribirse" value="1" class="btn w-100 mis-bgs-btns mt-auto text-light">Inscribirse</button>
                                <?php endif; ?>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
                <!-- Informacion -->
                <div class="col-12 col-lg-8 order-lg-1">
                    <!-- Descripcion -->
                    <div class="border-0 bg-white shadow-sm rounded-4 p-4 p-md-5 mb-4">
                        <h5 class="fw-bold mi-color-text mb-3">Descripcion</h5>
                        <p class="text-muted mb-0">
                            <?php echo $datos_c["C_Descripcion"]; ?>
                        </p>
                    </div>
                    <!-- Equipo Docente -->
                    <div class="border-0 bg-white shadow-sm rounded-4 p-4 p-md-5 mb-4">
                        <h5 class="fw-bold mi-color-text mb-3">Equipo Docente</h5>
                        <div class="d-flex align-items-center">
                            <?php if ($datos_c["U_FotoDePerfil"] == "avatar_pordefecto.avif"): ?>
                                <img src="<?php echo URL_BASE . "/Interfaz/Activos/avatar_pordefecto.avif"?>" alt="" class="rounded-circle me-3" style="width: 64px; height: 64px; object-fit: cover">
                            <?php else: ?>
                                <img src="<?php echo URL_BASE . "/Subidos/Img/Usuario/" . $datos_c["U_FotoDePerfil"]; ?>" alt="" class="rounded-circle me-3" style="width: 64px; height: 64px; object-fit: cover">
                            <?php endif; ?>
                            <div>
                                <h6 class="fw-bold mb-0 mi-color-text"><?php echo $datos_c["U_Nom"]; ?></h6>
                                <small class="text-muted">Docente</small>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </section>
</main>

<?php include RUTA_BASE . '/Interfaz/Incluidos/pie.php'; ?>