var totalPag;
function procesarProductos() {
  if (this.readyState == 4 && this.status == 200) {
    var string = this.responseText;
    //console.log('string: ' + string);

    var k = string.indexOf("#");
    //console.log('k' + k);

    var paginacion = string.slice(k + 1, string.length);
    totalPag = parseInt(paginacion);
    //console.log('pag:' + paginacion);

    var stringProductos = string.slice(0, k);

    //console.log('string' + stringProductos);
    var arrayliProductos = stringProductos.split("//").filter(Boolean);
    //console.log('arrayliProductos  '+arrayliProductos);
    var numero = 1;
    arrayliProductos.forEach((element) => {
      var arrayCadaProducto = element.split("/");
      var tbody = document.getElementById("tbody");
      //console.log('id: '+arrayCadaProducto[0]);
      //console.log('img: '+arrayCadaProducto[1]);
      var tr = document.createElement("tr");
      var td1 = document.createElement("td");
      var img = document.createElement("img");
      img.src = rutaImagen(arrayCadaProducto[1]);
      img.width = 200;
      img.alt = "Imagen Producto";
      //Pon el estilo
      td1.classList =
        "container w-100 h-100 p-1 color-White-5 rounded-4 text-center mx-5 my-2";
      td1.appendChild(img);
      var td2 = document.createElement("td");
      //Pon el estilo
      td2.classList =
        "container w-100 h-100 p-4 color-White-5 rounded-4 text-center mx-5 my-2";
      td2.innerHTML = arrayCadaProducto[2];
      var td3 = document.createElement("td");
      td3.classList =
        "container w-100 h-100 p-4 color-White-5 rounded-4 text-center mx-5 my-2";
      td3.innerHTML = arrayCadaProducto[3] + "€";
      var td4 = document.createElement("td");
      if (role != "NOSESSION" && role != "USERSESSION") {
        var editar = document.createElement("a");
        editar.href =
          "../../admin/Oferta/vista/editarOferta.php?idProduct=" +
          arrayCadaProducto[0];
        //console.log(editar.id);
        //editar.value = arrayCadaProducto[0];
        editar.innerHTML = "Editar";
        editar.classList = "btn btn-primary";
        td4.classList =
          "container w-100 h-100 p-4 color-White-5 rounded-4 text-center mx-5 my-2";
        td4.appendChild(editar);
      } else {
        var anadir = document.createElement("button");
        var cantidad = document.createElement("input");
        anadir.innerHTML = "Añadir";
        anadir.id = "anadir" + numero;
        anadir.value = arrayCadaProducto[0];
        anadir.classList = "btn btn-primary";
        cantidad.type = "number";
        cantidad.min = 1;
        cantidad.max = 50;
        cantidad.value = 1;
        cantidad.id = "cantidad" + numero;
        cantidad.style = "width=30px;margin-rigth=10px";
        cantidad.classList = "btn btn-success";
        anadir.onclick = cambiarCantidad;

        //anadir.href="../../carrito/vista/carrito.html?idProduct="+arrayCadaProducto[0];
        anadir.append(cantidad);
        td4.classList =
          "container w-100 h-100 p-4 color-White-5 rounded-4 text-center mx-5 my-2";
        td4.appendChild(anadir);
        td4.insertBefore(cantidad, anadir);
        numero++;
      }
      //Pon el estilo
      tr.classList =
        "container border border-dark rounded-4 color-White-6 my-1 w-80 h-25 p-2 mx-1 d-flex text-start";
      tbody.appendChild(tr);
      tr.appendChild(td1);
      tr.appendChild(td2);
      tr.appendChild(td3);
      tr.appendChild(td4);
    });
    document.getElementById("contador").innerText = totalPag;
    document.getElementById("contadorActual").innerText = pagina;
  }
}
function cambiarCantidad() {
  if (role != "USERSESSION") {
    window.location = "../../comun/logout.php";
  } else {
    let numero = this.id.slice(-1);
    let cantidad = document.getElementById("cantidad" + numero);

    //console.log(cantidad.value);
    //console.log(cantidad);
    //console.log(this.value);
    añadirProductoCarrito(this.value, cantidad.value);
  }
}
function rutaImagen(imgName) {
  var rutaImgTemp = "/php/uploads/" + imgName;
  var rutaImg = rutaImgTemp.split(" ").join("");
  return rutaImg;
}
function respCarrito() {
  if (this.readyState == 4 && this.status == 200) {
    let string = this.responseText;
    console.log("str" + string);
  }
}
var role;
function procesarSession() {
  if (this.readyState == 4 && this.status == 200) {
    role = this.responseText;
    console.log("role" + role);
    if (
      role != "NOSESSION" &&
      role != "USERSESSION" &&
      role != "ADMINSESSION" &&
      role != "SUPERADMINSESSION"
    ) {
      //console.log('role '+role);
      window.location = "../../comun/logout.php";
    }
    if (role === "ADMINSESSION" || role === "SUPERADMINSESSION") {
      //console.log("role "+role);
      document.getElementById("crearProd").style.visibility = "visible";
      document.getElementById("carrito").style.visibility = "hidden";
    } else {
    }
  }
}
function limpiarTable() {
  document.getElementById("tbody").innerHTML = "";
}

function loadEvents() {
  document.getElementById("crearProd").style.visibility = "hidden";
  //document.getElementById("carrito").style.visibility = "visible";
  comprobarSession();
  loadProductos();
  document.getElementById("primera").addEventListener("click", () => {
    pagina = 1;
    //console.log("pagina"+pagina);
    limpiarTable();
    loadProductos();
  });
  document.getElementById("anterior").addEventListener("click", () => {
    if (pagina === 1) {
      pagina = 1;
    } else {
      pagina--;
    }
    //console.log("pagina"+pagina);
    limpiarTable();
    loadProductos();
  });
  document.getElementById("siguiente").addEventListener("click", () => {
    if (pagina === totalPag) {
      pagina = totalPag;
    } else {
      pagina++;
    }
    //console.log("pagina"+pagina);
    limpiarTable();
    loadProductos();
  });
  document.getElementById("ultima").addEventListener("click", () => {
    pagina = totalPag;
    //console.log("pagina"+pagina);
    limpiarTable();
    loadProductos();
  });

  try {
    document.getElementById("cerrar").addEventListener("click", () => {
      Swal.fire({
        title: "Estas seguro?",
        text: "Una vez cerrada tendras que volver a iniciar sesión!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Cierra sesión!",
      }).then((result) => {
        if (result.isConfirmed) {
          window.open("../../comun/logout.php", "_self");
        }
      });
    });
  } catch (error) {
    console.log("Solo dara error debido a que no se inició sesion");
  }
}

function comprobarSession() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = procesarSession;
  xmlhttp.open("GET", "http://localhost/php/comun/comprobarSession.php", true);
  xmlhttp.send();
}
var pagina = 1;
function loadProductos() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = procesarProductos;
  xmlhttp.open(
    "GET",
    "http://localhost/php/Ofertas/modelo/getOfertas.php?pagina=" + pagina,
    true
  );
  xmlhttp.send();
}
function añadirProductoCarrito(id, cantidad) {
  var formData = new FormData();
  formData.append("idProducto", id);
  console.log(id);
  formData.append("cantidad", cantidad);
  console.log(cantidad);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = respCarrito;
  xmlhttp.open("POST", "http://localhost/php/carrito/modelo/carrito.php", true);
  xmlhttp.send(formData);

  //Alert proccess
  Swal.fire({
    position: "top-end",
    icon: "success",
    title: "Oferta añadida",
    showConfirmButton: false,
    timer: 1500,
  });
}
