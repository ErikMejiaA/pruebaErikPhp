export { postData };
//selecionamos el formulario
let formEstudiantes = document.querySelector('#formEstudiantes');
//el encabezado para el envio de datos
let myheadersEstu = new Headers({"Content-Type" : "application/json; charset:utf8"});

//le asignamos el evento al boton, para el envi de los datos
document.querySelector('#btnCampers').addEventListener('click', (e) => {

    e.preventDefault();
    //obtenemos el objeto de los datos del formulario
    let data = Object.fromEntries(new FormData(formEstudiantes).entries());
    console.log(data);
    postData(data)
        .then(res => {
            console.log(res);
        });
    alert("El dato fue enviado correctamente.")

})

//Funcion para el metodo POST (enviar los datos)
const postData = async (data) => {

    try {

        let config = {
            method : "POST",
            headers : myheadersEstu,
            body : JSON.stringify(data)
        }
        //definimos la respuesta
        let respuesta = await (await fetch("controllers/Campers/insert_data.php", config)).text();
        //console.log(respuesta);
        return respuesta;
        
    } catch (error) {
        console.log(error);
    }
}