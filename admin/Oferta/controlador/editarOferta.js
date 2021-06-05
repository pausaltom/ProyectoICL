function procesarProducto() {
    if (this.readyState == 4 && this.status == 200) {
        var stringProducto = this.responseText;
        console.log('string' + stringProducto);

        var arrayAtributosProduct = stringProducto.split("/");
        console.log('arrayAtributosProduct  ' + arrayAtributosProduct);
        var foto = document.getElementById("imagenFoto");
        var img = document.createElement("img");
        img.src = rutaImagen(arrayAtributosProduct[0]);
        img.width =200;
        img.height=200;
        img.alt = "Imagen Producto";
        img.classList = "imgProduct";
        foto.appendChild(img);
        var nombreProducto = document.getElementById("nombreProducto");
        nombreProducto.setAttribute("value",arrayAtributosProduct[1]);
        var precioProducto = document.getElementById("precioProducto");
        precioProducto.setAttribute("value",arrayAtributosProduct[2]);
    }
}
function rutaImagen(imgName) {
    var rutaImgTemp = "/php/uploads/" + imgName;
    var rutaImg = rutaImgTemp.split(" ").join("");
    return rutaImg;
}

function getURLParams() {
    const queryString = window.location.search;
    console.log(queryString);
    const urlParams = new URLSearchParams(queryString);
    const IDproduct = urlParams.get('idProduct')
    console.log(IDproduct);
    return IDproduct;
}
var role;
function procesarSession() {
    if (this.readyState == 4 && this.status == 200) {
        role = this.responseText;
        console.log('role' + role);
        if (!(role === "ADMINSESSION" || role === "SUPERADMINSESSION")) {
            window.location = "../../../comun/logout.php";
        }
    }
}
function loadEvents() {
    comprobarSession();
    loadProducto();
    var idProduct =getURLParams();
    document.getElementById("idProduct").setAttribute("value",idProduct);
    document.getElementById("idProduct1").setAttribute("value",idProduct);    
    document.getElementById("botonEnviar").addEventListener("click",()=>{
        location.reload();
    });
    document.getElementById("eliminar").addEventListener("click",()=>{
        console.log("Id de la oferta: "+idProduct);            
        window.open("../modelo/eliminarOferta.php?idProd=" + idProduct,"_self");              
        
    });

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
function loadProducto() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = procesarProducto;
    xmlhttp.open("GET", "http://localhost/php/admin/Oferta/modelo/getOfertaPorID.php?idProducto=" + getURLParams(), true);
    xmlhttp.send();
}
