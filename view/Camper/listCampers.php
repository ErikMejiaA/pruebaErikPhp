<!--listar los estudiantes-->
<?php
    require_once '../../app.php';
    use Models\Campers;

    $objCampers = new Campers();
    $datosCampers = $objCampers -> loadAllData();
    $datosRegion = $objCampers -> loadAllDataRegion();


?>

<section>
    <div class="container">
        <table id="myTablaEstudiante" class="table table-success table-striped table-hover dataTable">
            <thead>
                <tr>
                    <th scope="col">Id Campers</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Fecha de Nacimiento</th>
                    <th scope="col">Id de la region</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($datosCampers as $campers) {?>
                    <tr>
                        <td><?php echo $campers['idCamper']; ?></td>
                        <td><?php echo $campers['nombreCamper']; ?></td>
                        <td><?php echo $campers['apellidoCamper']; ?></td>
                        <td><?php echo $campers['fechaNac']; ?></td>
                        <td><?php echo $campers['idReg']; ?></td>
                        <td>
                            <button type="button" class="btn btn-danger eliminarEstudiante">Eliminar</button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary editarEstudiante">Editar</button>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</section>

<!--Modal que muestra el datoa a Eliminar-->
<div class="modal fade " id="verifdelEstu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-l">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">-- CAMPERS --</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card text-center">
                    <h5 class="card-header">Confirmar Eliminacion</h5>
                    <div class="card-body">
                        <div id="infoEstu"></div>
                        <br/>
                        <button type="button" class="btn btn-warning" onclick="borrarDataDbEstu()" data-bs-dismiss="modal">Eliminar</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
            </div>
        </div>
    </div>
</div>

<!--Modal que muestra los datos a editar-->
<div class="modal fade " id="updateDataEstu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">+-+ CAMPERS +-+</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <h5 class="card-header text-center">Editar CAMPER</h5>
                    <div class="card-body text-center">
                        <form id="frmUpdateDataEstu">
                            <div class="container">
                                <div class="row bg-light p-1">
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="idCamper" class="form-label">id Camper:</label>
                                            <br/>
                                            <span class="badge estu bg-primary"></span>
                                            <input id="idCamper" name="idCamper" type="hidden" value="0">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                        <div class="mb-3">
                                                <label for="nombreCamper" class="form-label">Ingrese el nombre del Campers</label>
                                                <input type="text" class="form-control" id="nombreCamper" name="nombreCamper">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="apellidoCamper" class="form-label">Ingrese el apellido del Campers:</label>
                                            <input type="text" class="form-control" id="apellidoCamper" name="apellidoCamper">
                                        </div>
                                    </div>
                                </div>
                                <div class="row bg-light p-1">
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
                            <div class="container text-center bg-light p-1">
                                <button type="button" class="btn btn-success" onclick="editarDataEstu()" data-bs-dismiss="modal">GUARDAR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
            </div>
        </div>
    </div>
</div>

<script>
    var row;
    let idCountryBorrarEstu;
    $(document).ready(function() {
        let tabla = $('#myTablaEstudiante').DataTable();

        // Evento click en los botones dentro de la tabla
        $('#myTablaEstudiante tbody').on('click', '.eliminarEstudiante', function() {
            row = tabla.row($(this).parents('tr'));
            let fila = tabla.row($(this).closest('tr')).data();
            idCountryBorrarEstu = fila[0]; // Obtener el valor de la columna 'Nombre'

            // Abrir el modal y mostrar el nombre del usuario
            abrirModalEstu(fila[0], fila[1]);
        });

        $('#myTablaEstudiante tbody').on('click', '.editarEstudiante', function() {
            const frmEstudi = document.querySelector('#frmUpdateDataEstu');
            const inputsData = new FormData(frmEstudi);
            row = tabla.row($(this).parents('tr'));
            let fila = tabla.row($(this).closest('tr')).data();  
            idCountryBorrarEstu = fila[0]; // Obtener el valor de la columna 'Nombre'
            inputsData.set("idCamper",fila[0]);
            inputsData.set("nombreCamper",fila[1]);
            inputsData.set("apellidoCamper",fila[2]);
            inputsData.set("fechaNac",fila[3]);
            inputsData.set("idReg",fila[4]);

            document.querySelector('.estu').innerHTML = fila[0];
            // Itera a través de los pares clave-valor de los datos
            for (let pair of inputsData.entries()) {
                // Establece los valores correspondientes en el formulario
                frmEstudi.elements[pair[0]].value = pair[1];
            }
            $('#updateDataEstu').modal('show');
            // Abrir el modal y mostrar el nombre del usuario
        });
    });

    function editarDataEstu(){
        const frm = document.querySelector('#frmUpdateDataEstu');
        const info = Object.fromEntries(new FormData(frm).entries());
        console.log(info);

        guardarDataDbEstu(info)
            .then(resp => {
                //document.querySelector("pre").innerHTML = r;
            });

        location.reload();
    }

    function abrirModalEstu(idpk, info) {
        $('#verifdelEstu').modal('show');
        document.querySelector('#infoEstu').innerHTML = 'Desea eliminar a: <b>' + info + '</b> con Id: <b>' + idpk + '</b>';
    }

    //funcion para el DELETE, para borrar un dato de la base de datos
    function borrarDataDbEstu() {
        fetch('../../../controllers/Campers/delete_data.php?id=' + idCountryBorrarEstu, {
                method: 'DELETE'
            })
            .then(response => {
                row.remove().draw();
            })
            .catch(error => {
                console.log('Error en la petición DELETE:', error);
            });

    }

    //funcion para el POST, para guardar el dato editado en la base de datos 
    const guardarDataDbEstu = async(data)=>{
        let myHeaderCiudad = new Headers({"Content-Type": "application/json; charset:utf8"});
        let config = {
            method : "POST",
            headers : myHeaderCiudad,
            body : JSON.stringify(data)
        }
        let res = await ( await fetch("../../../controllers/Campers/update_data.php" ,config)).text();
        return res;
    }


    $('#myTablaEstudiante').DataTable({
        pageLength: 4,
        language: {

            "decimal": "",
            "emptyTable": "No hay datos en la tabla",
            "info": "Desde _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando 0 a 0 de 0 Registros",
            "infoFiltered": "(filtered from _MAX_ total entries)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrando _MENU_ registros",
            "loadingRecords": "Loading...",
            "processing": "",
            "search": "Buscar:",
            "zeroRecords": "Nose encontraron registros",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }

        },
    })
</script>
