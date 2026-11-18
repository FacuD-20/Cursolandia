<?php 
    require_once __DIR__ . '/../../carga.php';
    include RUTA_BASE . '/Interfaz/Incluidos/cabecera.php'; 
    require_once RUTA_BASE . '/Persistencia/Consultas/EtiquetaBD.php';
    require_once RUTA_BASE . '/Persistencia/Consultas/CursoBD.php';
    
    extract($_POST);
    extract($_GET);
    //Instanciamos CursoBD y enlistamos los cursos
    $ebdd = new EtiquetaBD();
    $cbdd = new CursoBD();
    //Obtenemos todos los cursos y etiquetas para los filtros
    $lista_e = $ebdd -> listar_etiquetas();
    //Mensaje de elementos.
    $mensaje_e = "";
    //Verificamos si el usuario Busco un curso, sino que enliste todos de manera normal.
    if (isset($buscar) && $buscar != "") {
        //Enlistamos los cursos resultantes.
        $lista_c = $cbdd -> buscar_curso($buscar);
        //Si no hay ningun elemento con esa palabra buscada
        if (count($lista_c) == 0) {
            $mensaje_e = "No se encontro ningun elemento con esa palabra ingresada."; 
        } else {
            $mensaje_e = "Elementos encontrados: " . count($lista_c);
        }
      //Verficamos si el usuario aplico algun filtro
    } elseif (isset($aplicar_f) && $aplicar_f == 1) {
        //Guardamos los valores en variables dependiendo de la condicion
        $f_etiquetas = isset($etiquetas) ? $etiquetas : array();
        $f_gratis = isset($checkgratis) ? 1 : 0;
        $f_pagos = isset($checkpagos) ? 1 : 0;
        $f_nuevos = isset($checknuevos) ? 1 : 0;
        $f_publicos = isset($checkpublicos) ? 1 : 0;
        $f_privados = isset($checkprivados) ? 1 : 0;
        $lista_c = $cbdd -> listar_cursos($f_etiquetas,$f_gratis,$f_pagos,$f_nuevos,$f_publicos,$f_privados);
        if (count($lista_c) == 0) {
            $mensaje_e = "No se encontro ningun elemento con esa etiqueta o tipo."; 
        } else {
            $mensaje_e = "Elementos encontrados: " . count($lista_c);
        }
    } else {
        //Guardamos la lista de cursos en un arreglo.
        $lista_c = $cbdd -> listar_cursos();
    }
?>

<main>
    <section class="container-fluid">
        <div class="row">
            <!-- Apartado del Menu de filtros en PC -->
            <div class="d-none d-lg-block col-lg-3 bg-light py-5">
                <div class="card bg-white rounded-4 border-0 shadow-sm p-4">
                    <form action="" method="POST" name="fpcfiltros">
                        <h5 class="mi-color-text fw-bold border-bottom border-secondary-subtle pb-2 mb-3">Etiquetas</h5>
                        <!-- Etiquetas checkbox -->
                        <?php foreach($lista_e as $e):?>
                            <div class="form-check mb-2">
                                <input type='checkbox' name='etiquetas[]' id='<?php echo "etiq_pc_{$e->id}"; ?>' class='form-check-input' value='<?php echo $e->id; ?>'>
                                <label for='<?php echo "etiq_pc_{$e->id}"; ?>' class='form-check-label'><?php echo $e->nombre ;?></label>
                            </div>
                        <?php endforeach; ?>
                        <!-- Checkboxes varios -->
                        <h5 class="mi-color-text fw-bold border-bottom border-secondary-subtle pb-2 mb-3 mt-4">Tipo</h5>
                        <!-- Gratis -->
                        <div class="form-check mb-2">
                            <input type="checkbox" class="form-check-input" name="checkgratis" id="checkgratispc">
                            <label for="checkgratispc">Gratis</label>
                        </div>
                        <!-- Pagos -->
                        <div class="form-check mb-2">
                            <input type="checkbox" class="form-check-input" name="checkpagos" id="checkpagospc">
                            <label for="checkpagospc">Pagos</label>
                        </div>
                        <!-- Nuevos -->
                        <div class="form-check mb-2">
                            <input type="checkbox" class="form-check-input" name="checknuevos" id="checknuevospc">
                            <label for="checknuevospc">Nuevos</label>
                        </div>
                        <!-- Publico -->
                        <div class="form-check mb-2">
                            <input type="checkbox" class="form-check-input" name="checkpublicos" id="checkpublicospc">
                            <label for="checkpublicospc">Publico</label>
                        </div>
                        <!-- Privado -->
                        <div class="form-check mb-2">
                            <input type="checkbox" class="form-check-input" name="checkprivados" id="checkprivadospc">
                            <label for="checkprivadospc">Privado</label>
                        </div>
                        <button type="submit" name="aplicar_f" value="1" class="btn mis-btnes-sinbg text-light w-100 mt-4"><i class="bi bi-filter me-1"></i>Aplicar Filtros</button>
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
                            <!-- Etiquetas checkbox -->
                            <?php foreach($lista_e as $e):?>
                                <div class="form-check mb-2">
                                    <input type='checkbox' name='etiquetas[]' id='<?php echo "etiq_cel_{$e->id}"; ?>' class='form-check-input' value='<?php echo $e->id; ?>'>
                                    <label for='<?php echo "etiq_cel_{$e->id}"; ?>' class='form-check-label'><?php echo $e->nombre ;?></label>
                                </div>
                            <?php endforeach; ?>
                            <!-- Checkboxes varios -->
                            <h5 class="mi-color-text fw-bold border-bottom border-secondary-subtle pb-2 mb-3 mt-4">Tipo</h5>
                            <!-- Gratis -->
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="checkgratis" id="checkgratiscel">
                                <label for="checkgratiscel">Gratis</label>
                            </div>
                            <!-- Pagos -->
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="checkpagos" id="checkpagoscel">
                                <label for="checkpagoscel">Pagos</label>
                            </div>
                            <!-- Nuevos -->
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="checknuevos" id="checknuevoscel">
                                <label for="checknuevoscel">Nuevos</label>
                            </div>
                            <!-- Publico -->
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="checkpublicos" id="checkpublicoscel">
                                <label for="checkpublicoscel">Publico</label>
                            </div>
                            <!-- Privado -->
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="checkprivados" id="checkprivadoscel">
                                <label for="checkprivadoscel">Privado</label>
                            </div>
                            <button type="submit" name="aplicar_f" value="1" class="btn mis-btnes-sinbg text-light w-100 mt-4"><i class="bi bi-filter me-1"></i>Aplicar Filtros</button>
                        </form>
                    </div>
                </div>
                <!-- Fila de Cursos -->
                <?php if ($mensaje_e != "") { echo "<p class='text-small text-dark'>{$mensaje_e}</p>"; }?>
                <div class="row g-4">
                    <?php foreach ($lista_c as $c) :?>
                        <div class="col-12 col-md-6 col-lg-4">
                            <!-- Tarjeta de Curso -->
                            <div class='card h-100 shadow-sm border-0 rounded-4'>
                                <!-- Header de la tarjeta -->
                                <?php if ($c["C_Img"] == "imgcurso_pordefecto.png"):?>
                                    <img src='<?php echo URL_BASE . "/Interfaz/Activos/imgcurso_pordefecto.png"; ?>' alt='' class='card-img-top rounded-top-4' style='height: 180px; object-fit: cover;'>
                                <?php else: ?>
                                    <img src='<?php echo URL_BASE . "/Subidos/Img/Cursos/" . $c["C_Img"];?>' alt='' class='card-img-top rounded-top-4' style='height: 180px; object-fit: cover;'>
                                <?php endif; ?>
                                <!-- Cuerpo de la tarjeta -->
                                <div class='card-body d-flex flex-column p-4'>
                                    <div class='d-flex justify-content-between align-items-center mb-2'>
                                        <?php
                                            //Verificamos que el curso tenga etiquetas
                                            if (!empty($c["Etiquetas"])) {
                                                $lista_e = explode(", ",$c["Etiquetas"]);
                                                //Imprimimos todas las etiquetas del curso en la tarjeta del mismo
                                                foreach ($lista_e as $e) {
                                                    echo "<span class='badge text-bg-light border text-muted'>{$e}</span>";
                                                }
                                            } else {
                                                echo "<span class='badge text-bg-light border text-muted'>Sin Etiquetas</span>";
                                            }
                                        ?>
                                        <?php if ($c["C_Costo"] > 0):?>
                                        <span class='badge mi-bg-bronce'>Pago</span>
                                        <?php else: ?>
                                        <span class='badge mi-bg-bronce'>Gratis</span>
                                        <?php endif; ?>
                                    </div>
                                    <h5 class='card-title fw-bold mi-color-text mb-2'><?php echo $c["C_Titulo"];?></h5>
                                    <p class='text-muted small mb-1'>
                                        <i class='bi bi-calendar-event me-1'></i> <?php echo $c["C_FDInicio"];?>
                                    </p>
                                    <p class='text-muted small mb-3'>
                                        <i class='bi bi-calendar-check me-1'></i> <?php echo $c["C_FDFin"];?>
                                    </p>
                                    <a href='<?php echo URL_BASE; ?>/Interfaz/Cursos/detalles_c.php?id_c=<?php echo $c["C_ID"]; ?>' class='btn mis-btnes-sinbg rounded-pill w-100 mt-auto fw-bold'>
                                        Detalles del Curso <i class='bi bi-arrow-right-short'></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php 
include RUTA_BASE . '/Interfaz/Incluidos/pie.php'; 
?>