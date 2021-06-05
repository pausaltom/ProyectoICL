     
function procesarProducto() {
    if (this.readyState == 4 && this.status == 200) {
        var string = this.responseText;
        console.log('string ' + string);
        var err = string.split("/");
        console.log('err ' + err);
        //var span = document.getElementById("spanErr");
        if (err[1] === "1" || err[1] === "2") {
            /*span.innerHTML = err[0];
            span.style = "color:red;";*/
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: err[0],
                showConfirmButton: false,
                timer: 1500
            });
            document.getElementById("btnEnviar").disabled = true;
            //divErr.appendChild(span1);
        } else if (err[1] === "0") {
            document.getElementById("btnEnviar").disabled = false;
            /*span.innerHTML = err[0];
            span.style = "color:green;";*/
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: err[0],
                showConfirmButton: false,
                timer: 1500
            });
            var img = document.getElementById("imagenInput").files[0].name;
            //var selectorcategoria = document.getElementById("categoriaProducto");
            //var catValue = selectorcategoria.options[selectorcategoria.selectedIndex].value;
            //var catInt = parseInt(catValue);
            //document.getElementById("IDcategoria").setAttribute("value", catInt);
            console.log("nIMG " + img)
            document.getElementById("imagen").setAttribute("value", img); 
            document.getElementById("hereName").setAttribute("value",img);
        }
    }
}

function previewImg(e) {
    // Creamos el objeto de la clase FileReader
    let reader = new FileReader();

    // Leemos el archivo subido y se lo pasamos a nuestro fileReader
    reader.readAsDataURL(e.target.files[0]);

    // Le decimos que cuando este listo ejecute el código interno
    reader.onload = function () {
        let preview = document.getElementById('imagenFoto'),
            image = document.createElement('img');

        image.src = reader.result;
        image.width = 200;
        image.height = 200;
        image.classList = "imgProduct";

        preview.innerHTML = '';
        preview.append(image);
    };
    //reader.readAsDataURL(e.target.files[0]);
}

var role;
function procesarSession() {
    if (this.readyState == 4 && this.status == 200) {
        role = this.responseText;
        console.log('role ' + role);
        if (!(role === "ADMINSESSION" || role === "SUPERADMINSESSION")) {
            window.location = "../../../comun/logout.php";
        }
    }
}
function procesarIMG() {
    if (this.readyState == 4 && this.status == 200) {
        var str = this.responseText;
        console.log('img ' + str);
        var imgNombre = str.split("/");
        console.log("imgNom " + imgNombre);
        var span = document.getElementById("spanErr");
        if (imgNombre[1] === "1" || imgNombre[1] === "2") {
            span.innerHTML = imgNombre[0];
            span.style = "color:red;";
        } else if (imgNombre[1] === "0") {
            span.innerHTML = "La imagen" + imgNombre[0] + " és totalmente válida";
            span.style = "color:green;";
        }
    }
}
function loadEvents() {
    comprobarSession();
    //loadCategorias();
    //previsualizamos imagen y la enviamos a la carpeta uploads de nuestro servidor
    var inputIMG = document.getElementById("imagenInput");
    inputIMG.addEventListener("change", previewImg);
    document.getElementById("enviar").addEventListener("click", imagen);
    //--------------------------------------------------------------------
    //al validar la creación de productos miramos que no hay ningún producto creado con ese nombre
    var btnValidar = document.getElementById("btnValidar");
    btnValidar.addEventListener("click", comprobarProducto);   

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
function comprobarProducto() {
    var formData = new FormData(document.getElementById("formularioProducto"));
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = procesarProducto;
    xmlhttp.open("POST", "http://localhost/php/admin/Oferta/modelo/comprobarOferta.php", true);
    xmlhttp.send(formData);
}
function imagen() {
    var formData = new FormData(document.getElementById("formimg"));
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = procesarIMG;
    xmlhttp.open("POST", "http://localhost/php/comun/mostrarImg.php", true);
    xmlhttp.send(formData);
}