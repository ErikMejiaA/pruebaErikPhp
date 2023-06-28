<?php 
    require_once 'app.php';
    use Models\Campers;

    $objCampers = new Campers();
    $datosRegion = $objCampers -> loadAllDataRegion();

?>

<!--Formulario para el Estudiante-->
<div class="container mt-3 text-center">
    <div class="card">
        <h5 class="card-header">Registro Campers</h5>
        <div class="card-body">
            <form id="formEstudiantes">
                <div class="container text-center">
                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="idCamper" class="form-label">INgrese el Id del Campers:</label>
                                <input type="text" class="form-control" id="idCamper" name="idCamper">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="nombreCamper" class="form-label">Ingrese el nombre del Campers</label>
                                <input type="text" class="form-control" id="nombreCamper" name="nombreCamper">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="apellidoCamper" class="form-label">Ingrese el apellido del Campers:</label>
                                <input type="text" class="form-control" id="apellidoCamper" name="apellidoCamper">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="fechaNac" class="form-label">Ingrese la fecha de Nacimiento:</label>
                                <input type="date" class="form-control" id="fechaNac" name="fechaNac">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">

                                <label for="idReg" class="form-label">Region:</label>
                                <select class="form-select idReg" id="idReg">
                                    <option selected>Seleccione una Region:</option>
                                    <?php foreach ($datosRegion as $itemRegion) { ?>
                                        <option value="<?php echo $itemRegion['idReg']; ?>"><?php echo $itemRegion['nombreReg']; ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="container text-center">
                    <button type="submit" class="btn btn-primary enviar" id="btnCampers">ENVIAR</button>
                    <button type="reset" class="btn btn-success">LIMPIAR</button>
                </div>
            </form>
        </div>
    </div>
</div>