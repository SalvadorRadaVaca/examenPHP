<?php 

include("../config/bd.php");

$bd = new BasedeDatos("localhost", "examen", "root", "");
$bd->conexion();

$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtApellidopaterno = (isset($_POST['txtApellidopaterno'])) ? $_POST['txtApellidopaterno'] : "";
$txtApellidomaterno = (isset($_POST['txtApellidomaterno'])) ? $_POST['txtApellidomaterno'] : "";
$txtDomicilio = (isset($_POST['txtDomicilio'])) ? $_POST['txtDomicilio'] : "";
$txtCorreo = (isset($_POST['txtCorreo'])) ? $_POST['txtCorreo'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

include("clientes.php");

$clientes = new Clientes($txtID, $txtNombre, $txtApellidopaterno, $txtApellidomaterno, $txtDomicilio, $txtCorreo);

switch($accion) {
    
    case "Cancelar":
        header("pagina.php");
        break;

    case "Seleccionar":
        $sentenciaSQL = $bd->conexion()->prepare("SELECT * FROM clientes WHERE id = :id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $clienteSQL = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $clientes->setID($clienteSQL['id']);
        $clientes->setNombre($clienteSQL['nombre']);
        $clientes->setApellidopaterno($clienteSQL['apellido_paterno']);
        $clientes->setApellidomaterno($clienteSQL['apellido_materno']);
        $clientes->setDomicilio($clienteSQL['domicilio']);
        $clientes->setCorreo($clienteSQL['correo']);
        break;

    case "Borrar":
        $estado = 0;
        $sentenciaSQL = $bd->conexion()->prepare("UPDATE clientes SET estado = :estado WHERE id = :id");
        $sentenciaSQL->bindParam(':estado', $estado);
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
}

$sentenciaSQL = $bd->conexion()->prepare("SELECT * FROM clientes");
$sentenciaSQL->execute();
$clientesSQL = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

include("../template/cabecera.php"); 

?>

<div class="col-md-5">
    <div class="card">

        <div class="card-header">
            Datos del cliente
        </div>
        
        <div class="card-body">
            <form id="frm_registrar" method="POST">

                <div class = "form-group">
                    <label for="txtID">ID:</label>
                    <input type="text" required readonly class="form-control" name="txtID" id="txtID" value="<?php echo $clientes->getID(); ?>" placeholder="ID">
                </div>

                <div class = "form-group">
                    <label for="txtNombre">Nombre:</label>
                    <input type="text" required class="form-control" name="txtNombre" id="txtNombre" value="<?php echo $clientes->getNombre(); ?>" placeholder="Nombre">
                </div>

                <div class = "form-group">
                    <label for="txtApellidopaterno">Apellido Paterno:</label>
                    <input type="text" required class="form-control" name="txtApellidopaterno" id="txtApellidopaterno" value="<?php echo $clientes->getApellidopaterno(); ?>" placeholder="Apellido Paterno">
                </div>

                <div class = "form-group">
                    <label for="txtApellidomaterno">Apellido Materno:</label>
                    <input type="text" required class="form-control" name="txtApellidomaterno" id="txtApellidomaterno" value="<?php echo $clientes->getApellidomaterno(); ?>" placeholder="Apellido Materno">
                </div>

                <div class = "form-group">
                    <label for="txtDomicilio">Domicilio:</label>
                    <input type="text" required class="form-control" name="txtDomicilio" id="txtDomicilio" value="<?php echo $clientes->getDomicilio(); ?>" placeholder="Domicilio">
                </div>

                <div class = "form-group">
                    <label for="txtCorreo">Correo:</label>
                    <input type="email" required class="form-control" name="txtCorreo" id="txtCorreo" value="<?php echo $clientes->getCorreo(); ?>" placeholder="Correo">
                </div>

                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" id="agregar" <?php echo ($accion == "Seleccionar") ? "disabled" : ""; ?> value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" id="modificar" <?php echo ($accion != "Seleccionar") ? "disabled" : ""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" <?php echo ($accion != "Seleccionar") ? "disabled" : ""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
                </div>

            </form>
        </div>

    </div>
</div>

<div class="col-md-7">
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Domicilio</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($clientesSQL as $clienteSQL) { ?>
                <?php if($clienteSQL['estado'] == 1) { ?>
                    <tr>
                        <td><?php echo $clienteSQL['id']; ?></td>
                        <td><?php echo $clienteSQL['nombre']; ?></td>
                        <td><?php echo $clienteSQL['apellido_paterno']; ?></td>
                        <td><?php echo $clienteSQL['apellido_materno']; ?></td>
                        <td><?php echo $clienteSQL['domicilio']; ?></td>
                        <td><?php echo $clienteSQL['correo']; ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="txtID" id="txtID" value="<?php echo $clienteSQL['id']; ?>" />
                                <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary" />
                                <input type="submit" name="accion" id="borrar" value="Borrar" class="btn btn-danger" />
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>

</div>

<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/functions.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        M.AutoInit();
    });
</script>

<?php include("../template/pie.php"); ?>