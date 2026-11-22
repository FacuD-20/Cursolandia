<?php
    require_once __DIR__ . "/../../carga.php";
    require_once RUTA_BASE . "/Persistencia/Consultas/Solicitud_pBD.php";
    include RUTA_BASE . "/Interfaz/Incluidos/cabecera.php";

    //Verificamos que el usuario este logeado y sea administrador.
    if (!isset($_SESSION["id_usuario"]) || $_SESSION["rol_usuario"] != "admin") {
        echo "<script>window.location.href = '" . URL_BASE . "/index.php';</script>";
        exit;
    }
    //Instanciamos el objeto solicitudproBD.
    $spbdd = new SolicitudProBD();
    //Verificamos que el admin haya enviado el form
    if (isset($_POST["actualizar_plan"])) {
        /*Si el administrador dejo algun campo sin modificar, estos no se aplican 
        y si lo hacen los que si modifico.*/
        if ($_POST["nuevo_estado"] != "pendiente") {
            $spbdd->procesar_solicitud($_POST["sp_id"], $_POST["u_id_solicita"], 
            $_SESSION["id_usuario"], $_POST["nuevo_estado"]);
            $mensaje_exito = "¡Solicitud actualizada correctamente!";
        }
    }
    //Enlistamos las solicitudes pendientes
    $lista_sp = $spbdd->listar_pendientes();
?>

<main>
    <div class="container py-5">
        <!-- Mensaje de Bienvenida -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-4 p-4 bg-white">
                    <h2 class="fw-bold mi-color-text mb-1">
                        <i class="bi bi-shield-lock-fill text-warning me-2"></i>Bienvenido administrador, <?php echo htmlspecialchars($_SESSION["nombre_usuario"]) . " " . htmlspecialchars($_SESSION["apellido_usuario"]); ?>
                    </h2>
                    <p class="text-muted mb-0">Desde este panel puede gestionar las solicitudes de los usuarios para actualizar su Plan Gratuito a Pro o viceversa.</p>
                </div>
            </div>
        </div>
        <!-- Mensaje de exito -->
        <?php if (isset($mensaje_exito)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $mensaje_exito; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <!-- Tabla con las solicitudes pendientes -->
        <div class="card shadow-sm border-0 rounded-4 p-4 bg-white">
            <h4 class="fw-bold mb-3">Solicitudes Pro Pendientes</h4>
            <!-- Verificamos que no este vacia la lista de solicitudes -->
            <?php if (empty($lista_sp)): ?>
                <div class="alert alert-info mb-0">No hay solicitudes pendientes en este momento.</div>
            <?php else: ?>
                <div class="table-responsive">
                    <!-- Header -->
                    <table class="table align-middle table-hover">
                        <tr>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Mensaje / Comprobante</th>
                            <th>Fecha</th>
                            <th class="text-center">Cambiar Estado / Plan</th>
                        </tr>
                        <!-- Recorremos cada uno de los elementos y los imprimimos con su respectivo diseño en la tabla -->
                        <?php foreach ($lista_sp as $sp): ?>
                            <tr>
                                <td class="fw-bold"><?php echo htmlspecialchars($sp["U_Nom"]) . " " . htmlspecialchars($sp["U_Ape"]); ?></td>
                                <td><?php echo htmlspecialchars($sp["U_Email"]); ?></td>
                                <td>
                                    <p class="small text-muted mb-1"><?php echo htmlspecialchars($sp["SP_Texto"]); ?></p>
                                    <a href="<?php echo URL_BASE . '/Subidos/Comprobantes/' . $sp["SP_Comprobante"]; ?>" target="_blank" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-file-earmark-image me-1"></i>Ver Comprobante
                                    </a>
                                </td>
                                <td><?php echo $sp["SP_FDEmision"]; ?></td>
                                <td class="text-center">
                                    <!-- Formulario de selecciones entre plan pro y gratuito -->
                                    <form action="" method="POST" class="d-flex justify-content-center align-items-center gap-2">
                                        <input type="hidden" name="sp_id" value="<?php echo $sp["SP_ID"]; ?>">
                                        <input type="hidden" name="u_id_solicita" value="<?php echo $sp["U_ID_Solicita"]; ?>">
                                        
                                        <select name="nuevo_estado" class="form-select form-select-sm w-auto">
                                            <option value="pendiente" selected>Pendiente</option>
                                            <option value="aprobada">Aprobar</option>
                                            <option value="rechazada">Rechazar</option>
                                        </select>
                                        <button type="submit" name="actualizar_plan" class="btn btn-sm btn-primary fw-bold">
                                            Aplicar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include RUTA_BASE . '/Interfaz/Incluidos/pie.php'; ?>