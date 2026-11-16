<?php
    require_once __DIR__ . '/../../carga.php';
    require_once RUTA_BASE . "/Logica/Pregunta.php";
    require_once RUTA_BASE . "/Logica/Respuesta.php";
    require_once RUTA_BASE . "/Persistencia/Consultas/PreguntaBD.php";
    require_once RUTA_BASE . "/Persistencia/Consultas/RespuestaBD.php";
    require_once RUTA_BASE . "/Persistencia/Consultas/CursoBD.php";
    require_once RUTA_BASE . "/Persistencia/Consultas/MaterialesBD.php";
    //Iniciamos sesion y extraemos los nombres y los convertimos en variables
    session_start();
    extract($_POST);
    //Actualizamos la variable $_SESSION["id_c"]
    if (isset($_GET["id_c"])) {
        $_SESSION["id_curso"] = $_GET["id_c"];
    }
    //Guardamos el id de curso creamos una variable para ingresar despues el id de la pregunta
    $id_c = $_SESSION["id_curso"];
    //Instanciamos los objetos BD
    $pbdd = new PreguntaBD();
    $rbdd = new RespuestaBD();
    $cbdd = new CursoBD();
    $mbdd = new MaterialesBD();
    //Verificamos que el usuario haya manadado el formulario
    if (isset($publicar_p) && $publicar_p == 1) {
        $p = new Pregunta($_SESSION["id_usuario"],$id_c,$titulo_p,$texto_p);
        $pbdd -> ingresar_pregunta($p);
        header("Location: aula_c.php?id_c=" . $id_c);
        exit;
    }
    //Verificamos que el usuario haya mandado el formulario de respuesta
    if (isset($publicar_r) && $publicar_r == 1) {
        $r = new Respuesta($_SESSION["id_usuario"],$id_p,$respuesta);
        $rbdd -> ingresar_respuesta($r);
        header("Location: aula_c.php?id_c=" . $id_c);
        exit;
    }
    //Listas y datos del curso
    $datos_c = $cbdd -> datos_curso($id_c);
    $lista_p = $pbdd -> listar_preguntas($id_c);
    $lista_a = $mbdd -> listar_archivos($id_c);
?>

<!doctype html>
<html lang="es" data-bs-theme="light">
    <head>
        <title><?php echo "Aula - {$datos_c['C_Titulo']}";?></title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- font: Open Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
        <!-- font: Inter -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
        <!-- Frameworck: Bootstrap -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <!-- Archivo CSS -->
        <link rel = "stylesheet" href = "<?php echo URL_BASE;?>/Interfaz/Activos/curstyles.css">
    </head>
    <body>
        <header class="mi-bg-grisazulado text-white py-3 px-4 shadow-sm">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <img src="<?php echo URL_BASE; ?>/Interfaz/Activos/logo Cursolandia.png" alt="Logo" style="max-height: 40px;">
                    <span class="text-white fw-bold ms-2 fs-5 pe-3">Cursolandia</span>
                    <a href="<?php echo URL_BASE;?>/index.php" class="text-white-50 text-decoration-none small border-start ps-3">
                        <i class="bi bi-arrow-left me-1"></i>
                        Pagina Principal
                    </a>
                </div>
                <span class="fw-semibold d-none d-md-inline"><?php echo "{$datos_c['C_Titulo']}";?></span>
            </div>
        </header>
        <main>
            <section class="container-fluid px-lg-4 py-4">
                <!-- Card de Mini Encabezado con info del curso -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
                        <!-- info del curso -->
                        <div>
                            <!-- Info del curso activo/inactivo -->
                            <div class="mb-2">
                                <?php if ($datos_c["C_FDInicio"] < $datos_c["C_FDFin"]): ?>
                                <span class="badge rounded-pill mi-bg-bronce">Curso Activo</span>
                                <?php else: ?>
                                <span class="badge rounded-pill mi-bg-bronce">Curso Inactivo</span>
                                <?php endif; ?>
                            </div>
                            <!-- Info del curso fechas de inicio y fin junto con el titulo del mismo -->
                            <h2 class="fw-bold mi-color-text mb-1"><?php echo "{$datos_c['C_Titulo']}"; ?></h2>
                            <p class="text-muted small mb-0">
                                <i class="bi bi-calendar-range ms-2 me-1"></i>
                                Activo: <?php echo "{$datos_c['C_FDInicio']} al {$datos_c['C_FDFin']}";?>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Contenido del curso -->
                <div class="row g-4">
                    <!-- Card de Materiales adjuntos del curso -->
                    <div class="col-12 col-lg-3 d-none d-lg-block">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <!-- Encabezado -->
                            <h5 class="fw-bold mi-color-text mb-3 border-bottom pb-2">
                                <i class="bi bi-folder2-open me-2"></i>Material del Curso
                            </h5>
                            <!-- Lista de Archivos -->
                            <div class="list-group list-group-flush">
                                <?php
                                    foreach ($lista_a as $archivo) {
                                        echo "
                                            <!-- Item -->
                                            <a href='' class='list-group-item list-group-item-action d-flex 
                                            justify-content-between align-items-center px-0 py-2 border-bottom'>
                                                <div class='text-truncate me-2'>
                                                    <i class='bi bi-file-earmark-pdf text-danger me-2'></i>
                                                    <span class='small fw-semibold'>{$archivo["M_Nombre"]}</span>
                                                </div>
                                                <span class='badge bg-light text-muted border'>
                                                    {$archivo["M_Tamano"]}<i class='bi bi-download ms-1'></i>
                                                </span>
                                            </a>
                                        ";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- Contenido -->
                    <div class="col-12 col-lg-9 mb-4">
                        <!-- Offcanvas para el indice del curso en Telefono -->
                        <!-- Boton para abrir offcanvas -->
                        <button class="btn mis-bgs-btns w-100 p-3 rounded-4 shadow-sm d-lg-none mb-4 fw-bold text-light border" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                            <i class="bi bi-list-ul me-2"></i> Ver Materiales del Curso
                        </button>
                        <!-- Menu offcanvas -->
                        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                            <!-- Header de offcanvas -->
                            <div class="offcanvas-header border-bottom">
                                <h5 class="offcanvas-title fw-bold mi-color-text" id="offcanvasWithBothOptionsLabel">
                                    <i class="bi bi-folder2-open me-2"></i> Material del Curso                                        
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <!-- Cuerpo del offcanbas -->
                            <div class="offcanvas-body">
                                <div class="list-group list-group-flush">
                                    <p class="text-muted small mb-3">Archivos disponibles para descargar:</p>
                                    <!-- Lista de Archivos -->
                                    <div class="list-group list-group-flush">
                                        <?php
                                            foreach ($lista_a as $archivo) {
                                                echo "
                                                    <!-- Item -->
                                                    <a href='' class='list-group-item list-group-item-action d-flex 
                                                    justify-content-between align-items-center px-0 py-2 border-bottom'>
                                                        <div class='text-truncate me-2'>
                                                            <i class='bi bi-file-earmark-pdf text-danger me-2'></i>
                                                            <span class='small fw-semibold'>{$archivo["M_Nombre"]}</span>
                                                        </div>
                                                        <span class='badge bg-light text-muted border'>
                                                            {$archivo["M_Tamano"]}<i class='bi bi-download ms-1'></i>
                                                        </span>
                                                    </a>
                                                ";
                                            }
                                        ?>
                                    </div>                                
                                </div>
                            </div>
                        </div>
                        <!-- Publicar Pregunta -->
                        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                            <h5 class="fw-bold mi-color-text mb-3">
                                <i class="bi bi-chat-left-dots me-2"></i> Foro de Preguntas
                            </h5>
                            <form action="" method="POST" name="fpreguntas" class="needs-validation" novalidate>
                                <!-- Titulo -->
                                <div class="mb-2">
                                    <input type="text" name="titulo_p" class="form-control" placeholder="Título o asunto de tu duda..." required>
                                    <div class="invalid-feedback">Ingresá un título para tu consulta.</div>
                                </div>
                                <!-- Texto -->
                                <div class="mb-3">
                                    <textarea name="texto_p" id="texto_pregunta" rows="2"  class="form-control" placeholder="Escribe tu consulta para el docente y tus compañeros..." required></textarea>
                                    <div class="invalid-feedback">Escribe los detalle de tu pregunta.</div>
                                </div>
                                <!-- Boton para publicarla -->
                                <button type="submit" name="publicar_p" value="1" class="btn mis-bgs-btns text-light px-4 fw-bold">
                                    Publicar Pregunta
                                </button>
                            </form>
                        </div>
                        <!-- Lista de Preguntas -->
                        <?php 
                            if (empty($lista_p)) {
                                echo "
                                <div class='card border-0 shadow-sm rounded-4 p-4 text-center text-muted'>
                                    Aún no hay preguntas en este curso.
                                </div>";
                            } else {
                                foreach ($lista_p as $p) {
                                    // Obtenemos la foto de perfil del usuario creador de la pregunta
                                    if ($p['U_FotoDePerfil'] == "avatar_pordefecto.avif") {
                                        $avatar_u = URL_BASE . "/Interfaz/Activos/avatar_pordefecto.avif";
                                    } else {
                                        $avatar_u = URL_BASE . "/Subidos/" . $p['U_FotoDePerfil'];
                                    }
                                    //Utilizamos el operador "?"
                                    $cartel_des = ($p["P_Destacada"] == 1) ? "<span class='badge mi-bg-bronce'><i class='bi bi-pin-angle-fill me-1'></i>Destacada</span>" : "";
                                    $cartel_cerr = ($p["P_Cerrada"] == 1) ? "<span class='badge bg-secondary'><i class='bi bi-lock-fill me-1'></i>Cerrada</span>" : "";
                                    //imprimimos todas las preguntas
                                    echo "
                                    <!-- Pregunta -->
                                    <div class='card border-0 shadow-sm rounded-4 p-4 mb-3'>
                                        <!-- header de la pregunta -->
                                        <div class='d-flex justify-content-between align-items-start mb-2'>
                                            <!-- Titulo, nombre de usuario, etc -->
                                            <div class='d-flex align-items-center'>
                                                <img src='{$avatar_u}' alt='Avatar' class='rounded-circle me-2 border' style='width: 40px; height: 40px; object-fit: cover;'>
                                                <div>
                                                    <h6 class='fw-bold mi-color-text mb-0'>{$p["P_Titulo"]}</h6>
                                                    <small class='text-muted'>Por: {$p["U_Nom"]} {$p["U_Ape"]} | Fecha y Hora: {$p["P_FDCreacion"]} </small>
                                                </div>
                                            </div>
                                            <!-- Estado de la pregunta -->
                                            <div class='d-flex gap-1'>
                                                {$cartel_des}
                                                {$cartel_cerr}
                                            </div>
                                        </div>
                                        <!-- Consulta -->
                                        <p class='text-muted small mb-3'>
                                            {$p["P_Texto"]}
                                        </p>
                                        <!-- Bloque de Respuestas -->
                                        <div class='ps-3 border-start ms-2 mb-3'>";
                                            $lista_r = $rbdd -> listar_respuestas($p["P_ID"]);
                                            foreach ($lista_r as $r) {
                                                //Cartel que muestra si fue aceptada y boder para remarcar
                                                $cartel_acep = ($r["R_Aceptada"] == 1) ? 
                                                "<span class='badge bg-success'><i class='bi bi-check2-all me-1'></i>
                                                    Respuesta Aceptada
                                                </span>" : "";
                                                $borde_acep  = ($r["R_Aceptada"] == 1) ? "border-start border-4 border-success" : "";
                                                //Boton para el dueño de la pregunta la marque como aceptada
                                                $marcar_acep = ($p["U_ID_Inicia"] == $_SESSION["id_usuario"] && $p["P_Cerrada"] != 1) ?
                                                "<button type='button' class='btn btn-sm btn-outline-success py-0' style='font-size: 0.75rem;'>
                                                    Marcar como Aceptada
                                                </button>" : "";
                                                //Boton para que el dueño de la respuesta la pueda editar
                                                $editar_r = ($r["U_ID_Realiza"] == $_SESSION["id_usuario"]) ?
                                                "<button type='button' class='btn btn-sm btn-outline-secondary py-0' style='font-size: 0.75rem;'>
                                                    <i class='bi bi-pencil me-1'></i>Editar mi respuesta
                                                </button>" : "";
                                                //Imprimir las respuestas con todas las variables cargadas segun que pregunta y que usuario
                                                echo "
                                                <!-- Respuesta -->
                                                <div class='bg-light {$borde_acep} p-3 rounded-3 mb-2'>
                                                    <div class='d-flex justify-content-between align-items-center mb-1'>
                                                        <span class='fw-bold small mi-color-text'>{$r['U_Nom']} {$r['U_Ape']}</span>
                                                        {$cartel_acep}
                                                    </div>
                                                    <p class='small text-muted mb-2'>
                                                        {$r['R_Texto']}
                                                    </p>
                                                    <!-- Acciones del Alumno (Marcar como aceptada si es el autor de la pregunta, o editar su última respuesta) -->
                                                    <div class='d-flex gap-2'>
                                                        {$marcar_acep}
                                                        {$editar_r}
                                                    </div>
                                                </div>";
                                            }
                                echo    "</div>
                                        <!-- Formulario para responder una consulta -->
                                        <form action='' method='POST' name='frespuesta' class='needs-validation' novalidate>
                                            <div class='input-group input-group-sm'>
                                                <input type='hidden' name='id_p' value='{$p["P_ID"]}'>
                                                <input type='text' name='respuesta' class='form-control' placeholder='Escribir una respuesta...' required>
                                                <button name='publicar_r' value='1' class='btn mis-btns-bg-bronce text-light fw-bold px-3' type='submit'>
                                                    Responder
                                                </button>
                                            </div>
                                        </form>
                                    </div>";
                                }
                            }
                        ?>  
                    </div>
                </div>
            </section>
        </main>
        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
        <script src="<?php echo URL_BASE;?>/Interfaz/Activos/validaciones.js"></script>
    </body>
</html>