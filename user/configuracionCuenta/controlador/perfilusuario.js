function procesarDataUser() {
    if (this.readyState == 4 && this.status == 200) {
        var string = this.responseText;
        console.log("data User " + string);
        var datosUser = string.split("/%//");
        console.log('datos ' + datosUser);

        document.getElementById("nombre").setAttribute("value", datosUser[0]);
        document.getElementById("telefono").setAttribute("value", datosUser[1]);
        //document.getElementById("email").setAttribute("value", datosUser[2]);
        document.getElementById("contraDefinitiva").setAttribute("value", datosUser[2]);
        document.getElementById("iduser").setAttribute("value", datosUser[3]);
    }
}
function comprobarContrasIguales() {
    let contraNueva = document.getElementById("nuevaPassword").value;
    let ConfirmarContra = document.getElementById("ConfirmarPassword").value;
    var spanErr = document.getElementById("spanErr");
    //var divErr = document.getElementById("diverr");
    spanErr.textContent = "";
    if (contraNueva != ConfirmarContra || contraNueva === "" || ConfirmarContra === "") {        
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Nueva Contraseña no válida',
            showConfirmButton: false,
            timer: 1500
          })
    } else {        
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Nueva Contraseña válida',
            showConfirmButton: false,
            timer: 1500
          })
        var cbCambiarContra = document.getElementById("checkboxButton");
        cbCambiarContra.checked = false;
        console.log('this ' + cbCambiarContra.checked);
        cbChecked();
        //enciptContra(contraNueva);
        document.getElementById("contraDefinitiva").setAttribute("value",contraNueva);
    }
}

function cbChecked() {
    var spanErr = document.getElementById("spanErr");
    spanErr.textContent = "";
    let divContra = document.getElementById("divContra");
    let divNuevaContra = document.getElementById("nuevaContra");
    var cbCambiarContra = document.getElementById("checkboxButton");
    console.log('this ' + cbCambiarContra.checked);
    if (cbCambiarContra.checked) {
        divContra.style.display = "none";
        divNuevaContra.style.display = "block";
        console.log('divContra ' + divContra.style.display);
    } else {
        divContra.style.display = "block";
        divNuevaContra.style.display = "none";
        console.log('divContra ' + divContra.style.display);
    }
}
var role;
function procesarSession() { 
    
    if (this.readyState == 4 && this.status == 200) {
        role = this.responseText;
        console.log('role' + role);
        if ((role != "USERSESSION" && role != "ADMINSESSION" && role != "SUPERADMINSESSION")) {
            console.log('role '+role);
            window.location = "../../../comun/logout.php";
        }
    }
}

function procesarAjustes(){
    if (this.readyState == 4 && this.status == 200) {
        let string = this.responseText;
        console.log('Resp del form'+ string);
        var err = string.split("/");
        console.log('message ' + err);
        var span = document.getElementById("spanErr");
        if (err[1] === "1" || err[1] === "2") {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: err[0],
                showConfirmButton: false,
                timer: 1000
              })
            /*span.textContent = err[0];
            span.style = "color:red;";*/
            //divErr.appendChild(span1);
        } else if (err[1] === "0") {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: err[0],
                showConfirmButton: false,
                timer: 1000
              })
            /*span.textContent = err[0];
            span.style = "color:green;";*/           
        }
    }
}

function encriptarContra(){
    if (this.readyState == 4 && this.status == 200) {
        let string = this.responseText;
        console.log('Resp contra'+ string);
        let contraDef =document.getElementById("contraDefinitiva");
        contraDef.setAttribute("value",string);
    }
}
function loadEvents() {
    comprobarSession();
    loadDatosUser();
    document.getElementById("guardarContra").addEventListener("click", comprobarContrasIguales);
    document.getElementById("btnEnviar").addEventListener("click", guardarAjustesCuenta);

    document.getElementById("cerrar").addEventListener("click",()=>{
        Swal.fire({
            title: 'Estas seguro?',
            text: "Una vez cerrada tendras que volver a iniciar sesión!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Cierra sesión!'
          }).then((result) => {
            if (result.isConfirmed) {
              window.open("../../../comun/logout.php","_self");
            }
          })
    });
}
function comprobarSession() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = procesarSession;
    xmlhttp.open("GET", "http://localhost/php/comun/comprobarSession.php", true);
    xmlhttp.send();
}
function enciptContra(contraNueva) {
    let form = new FormData();
    form.append("contra",contraNueva);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = encriptarContra;
    xmlhttp.open("POST","http://localhost/php/comun/encryptcontra.php", true);
    xmlhttp.send(form);
}

function guardarAjustesCuenta() {
    var formData = new FormData();
    let iduser = document.getElementById("iduser").value;
    console.log(iduser)
    let nombre = document.getElementById("nombre").value;
    let contraDefinitiva = document.getElementById("contraDefinitiva").value;
    let telefono = document.getElementById("telefono").value;
    formData.append("iduser",iduser);
    formData.append("nombre",nombre);
    formData.append("contraDefinitiva",contraDefinitiva);
    formData.append("telefono",telefono);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = procesarAjustes;
    xmlhttp.open("POST","http://localhost/php/user/configuracionCuenta/modelo/cambiarAjustesCuenta.php", true);
    xmlhttp.send(formData);
}

function loadDatosUser() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = procesarDataUser;
    xmlhttp.open("GET", "http://localhost/php/user/configuracionCuenta/modelo/loadDatosUsuario.php", true);
    xmlhttp.send();

}
