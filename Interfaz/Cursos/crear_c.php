<?php
    require_once __DIR__ . '/../../carga.php';
    include RUTA_BASE . '/Interfaz/Incluidos/cabecera.php';
    require_once RUTA_BASE . "/Logica/Curso.php";
    require_once RUTA_BASE . "/Logica/Material.php";
    require_once RUTA_BASE . "/Logica/Etiqueta.php";
    require_once RUTA_BASE . "/Persistencia/Consultas/EtiquetaBD.php";
    require_once RUTA_BASE . "/Persistencia/Consultas/CursoBD.php";
    require_once RUTA_BASE . "/Persistencia/Consultas/UsuarioBD.php";
    //Extraemos los valores de la matriz $_POST y iniciamos la session
    extract($_POST);
    //Instanciamos los objetos de las clases
    $cbdd = new CursoBD();
    $ebdd = new EtiquetaBD();
    $ubdd = new UsuarioBD();
    //Obtenesmos todas las etiquetas de la BDD
    $list = $ebdd -> listar_etiquetas();
    //Obtenemos la cantidad de cursos y datos varios del usuario
    $cant_curs = $ubdd -> cantidad_cursos($_SESSION['id_usuario']);
    //Variable para mostrar un posible error.
    $mensaje_error_crear = "";
    $mensaje_error_archivo = "";
    //Arreglo de materiales
    $materiales = array();
    //Obtenemos los datos de entrada del usuario.
    if (isset($publicar) && $publicar == 1) {
        //Arreglo de etiquetas
        $list_etiquetas = isset($etiquetas) ? $etiquetas: array();
        //Verificamos si se subio al menos un archivo
        if (!empty($_FILES["materiales"]["name"][0])) {
            //Obtenemos el numero de archivos.
            $long = count($_FILES["materiales"]["name"]);
            //Bucle for para instanciar todos los materiles y agregarlos en el arreglo materiales.
            for ($i = 0; $i < $long; $i ++) {
                $nom_a = $_FILES["materiales"]["name"][$i];
                $tipo_a = $_FILES["materiales"]["type"][$i];
                $tam_a = $_FILES["materiales"]["size"][$i];
                $rutatmp_a = $_FILES["materiales"]["tmp_name"][$i];
                //Instanciamos
                $m = new Material($nom_a,$tipo_a,$tam_a,$rutatmp_a);
                //Agregamos el nuevo objeto al array
                $materiales[] = $m;
            }
        }
        //Verificamos si subio uno imagen
        if (isset($_FILES["img"]) && $_FILES["img"]["name"] != "") {
            //Colocamos el id del usuario para saber quien subio x imagen y obtenemos la extension.
            $ext = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
            $img = $_SESSION["id_usuario"] . "_" . time() . "." . $ext;
            $vieja_r = $_FILES["img"]["tmp_name"];
            $nueva_r = RUTA_BASE . "/Subidos/Img/Cursos/" . $img;
        } else {
            //Si el usuario no subio ninguna imagen, queda la imagen por defecto
            $img = "imgcurso_pordefecto.png";
        }
        //Instanciamos el objeto curso.
        $c = new Curso($_SESSION["id_usuario"], $titulo, $descripcion, $fecha_inicio, $fecha_fin,
        $img, $costo, $cupos, $sacceso, $materiales, $list_etiquetas);
        //Intentamos insertar el curso en la base de datos
        try {
            $mensaje_error_archivo = $cbdd -> crear_curso($c);
        } catch (Exception $e) {
            $mensaje_error_crear = $e -> getMessage();
        }
        /*Si no hay error, movemos la imagen a la carpeta /Subidos/Img/Cursos/ 
        Y Verificamos que no sea la predefinida */
        if ($mensaje_error_archivo == "" && $mensaje_error_crear == "") {
            if ($img != "imgcurso_pordefecto.png"){
                move_uploaded_file($vieja_r, $nueva_r);
            }
            echo "<script>window.location.href = 'aula_c.php';</script>";
            exit;
        }
    }
?>

<main>
    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <!-- Encabezado con titulo e informacion sobre cursos creados -->
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-2">
                    <h2 class="fw-bold mi-color-text mb-0">Crear Nuevo Curso</h2>
                    <span class="badge mi-bg-grisazulado px-3 py-2 align-self-start align-self-sm-center">
                        <?php if ($_SESSION['plan_usuario'] == 'gratuito'): ?>
                        Cursos activos: <?php echo $cant_curs; ?> / 3 (Plan Gratuito)
                        <?php else: ?>
                        Cursos activos: <?php echo $cant_curs; ?> (Plan Pro)
                        <?php endif; ?>
                    </span>
                </div>
                <?php if ($mensaje_error_crear != "") { echo "<p class='text-small text-danger'>{$mensaje_error_crear}</p>";}?>
                <?php if ($mensaje_error_archivo != "") { echo "<p class='text-small text-danger'>{$mensaje_error_archivo}</p>";}?>
                <!-- Formulario -->
                <form action="" method="POST" name="fcrearcurso" enctype="multipart/form-data" class="needs-validation" novalidate>                    
                    <!-- Informacion del Curso -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-4">
                        <h4 class="fw-bold mi-color-text mb-4 border-bottom pb-2">1. Información del Curso</h4>
                        <div class="row g-3">
                            <!-- Imagen del curso -->
                            <div class="col-12">
                                <label for="img_curso" class="form-label fw-bold small mi-color-text">
                                    Imagen de Portada 
                                    <span class="text-muted fw-normal">(Opcional)</span>
                                </label>
                                <input type="file" class="form-control" id="img" name="img" accept="image/*">
                            </div>
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
                            <div class="col-12 col-md-4">
                                <label for="fecha_inicio" class="form-label fw-bold small mi-color-text">Fecha de Inicio *</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                                <div class="invalid-feedback">Seleccioná una fecha de inicio.</div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="fecha_fin" class="form-label fw-bold small mi-color-text">Fecha de Fin *</label>
                                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                                <div class="invalid-feedback">Seleccioná una fecha de finalización.</div>
                            </div>
                            <!-- Acceso -->
                            <div class="col-12 col-md-4">
                                <label for="sacceso" class="form-label fw-bold small mi-color-text">Acceso</label>
                                <select name="sacceso" id="sacceso" class="form-select">
                                    <option value="publico">Publico</option>
                                    <option value="privado">Privado</option>
                                </select>
                            </div>
                            <!-- Etiquetas -->
                            <div class="col-12">
                                <label for='etiquetas' class='form-label fw-bold small mi-color-text'>
                                    Etiquetas
                                    <span class='text-muted fw-normal'>(Opcionales)</span>
                                </label>
                                <?php 
                                    foreach ($list as $e) {
                                        echo "
                                        <input type='checkbox' class='btn-check' name='etiquetas[]' id='{$e -> id}' value='{$e -> id}' autocomplete='off'>
                                        <label class='btn mis-btnes-sinbg rounded-pill px-3 py-1 small fw-bold' for='{$e -> id}'>
                                            {$e -> nombre}
                                        </label>
                                        ";
                                    }
                                ?>
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
                                <label for="costo" class="form-label fw-bold small mi-color-text">
                                    Costo ($)
                                    <span class="text-muted fw-normal">(Opcional)</span>
                                </label>
                                <input type="number" min="0" step="0.01" class="form-control" id="costo" name="costo" placeholder="Vacío o 0 = Gratis">
                            </div>
                            <!-- Cupos -->
                            <div class="col-12 col-md-6">
                                <label for="cupos" class="form-label fw-bold small mi-color-text">
                                    Cupo <span class="text-muted fw-normal">(Opcional)</span>
                                </label>
                                <input type="number" min="1" class="form-control" id="cupos" name="cupos" placeholder="Vacío = Sin límite">
                            </div>
                            <!-- Adjuntar Archivo -->
                            <div class="col-12 mt-3">
                                <label for="materiales" class="form-label fw-bold small mi-color-text">
                                    Material del Curso <span class="text-muted fw-normal">(Archivos adjuntos)</span>
                                </label>
                                <input type="file" class="form-control" id="materiales" name="materiales[]" multiple>
                                <div class="form-text small mt-3">
                                    <i class="bi bi-info-circle me-1"></i> 
                                    <strong>Plan Gratuito:</strong> máx. 5 archivos (hasta 5 MB c/u y 10 MB en total). <strong>Plan Pro:</strong> sin límite.
                                </div>
                            </div>
                            <!-- Crear Curso -->
                            <div class="col-12 mt-4">
                                <button type="submit" name="publicar" value="1" class="btn mis-bgs-btns text-light w-100 py-2 fw-bold">
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