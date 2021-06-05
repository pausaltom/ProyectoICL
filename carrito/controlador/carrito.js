function loadEvents() {
  //Pagar
  document.getElementById("pagar").addEventListener("click", () => {
    var subtotal = document.getElementById("pagar").value;

    console.log("Click pagar");

    if (subtotal == 0) {
      //Alert pago imposible
      Swal.fire({
        title: "Su carrito esta vació!",
        text: "Regrese a productos o ofertas y añada algo",
        icon: "warning",
        confirmButtonColor: "#3085d6",
      });
    } else {
      //Alert pago para realizar
      Swal.fire({
        title: "Esta seguro de que quiere pagar ya?",
        text: "Una vez confirmado tendras que esperar a que la tienda confirme el pedido!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, quiero pagar ya!",
      }).then((result) => {
        if (result.isConfirmed) {
          comprobarTieneDireccion();
        }
      });
    }
  });

  document.getElementById("vaciar").addEventListener("click", () => {
    var subtotal = document.getElementById("pagar").value;

    if (subtotal == 0) {
      //Alert pago imposible
      Swal.fire({
        title: "Su carrito esta vació!",
        text: "Regrese a productos o ofertas y añada algo",
        icon: "warning",
        confirmButtonColor: "#3085d6",
      });
    } else {
      //Alert pago para realizar
      Swal.fire({
        title: "Esta seguro de que quiere vaciar el carrito?",
        text: "Una vez confirmado se vaciara!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, quiero vaciar el carrito!",
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire("Operación realizada!", "El carrito se vació.", "success");
          window.open("../modelo/vaciarCarritoTodo.php", "_self");
        }
      });
    }
  });

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
}

function comprobarTieneDireccion() {
  console.log("Comprobar direccion");
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = puedePagar;
  xmlhttp.open("GET", "http://localhost/php/carrito/modelo/comprobarTieneDireccion.php", true);
  xmlhttp.send();
}

function puedePagar() {
  console.log("Puede pagar");
  if (this.readyState == 4 && this.status == 200) {
    let string = this.responseText;
    console.log('hola : ' + string);
    let respPuede = string.split("/");
    if (respPuede[1] === "1") {
      pasarApagar();
    } else {
      Swal.fire({
        title: "Usted no tiene dirección",
        text: respPuede[0],
        icon: "error",
        confirmButtonColor: "#3085d6",
        footer: "Recuerde que tiene que introducir una dirección válida",
        showCancelButton: false
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = "../../user/pedirAdomicilio/direccion.php";
        }
      });
      //window.location = "../../user/pedirAdomicilio/direccion.php";
    }


  }

}

function pasarApagar() {
  var coment = document.getElementById("comentario").value;
  var subtotal = document.getElementById("pagar").value;
  let formData = new FormData();
  console.log(coment + "    " + subtotal);
  formData.append("comentario", coment);
  formData.append("subtotal", subtotal);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = respPago;
  xmlhttp.open("POST", "http://localhost/php/carrito/modelo/pagar.php", true);
  xmlhttp.send(formData);
}

function respPago() {
  if (this.readyState == 4 && this.status == 200) {
    let string = this.responseText;
    console.log(string);
    let respOK = string.split("/");
    //Pago correcto
    if (respOK[1] === "1") {
      //alert("Pago realizado correctamente"+respOK[0]);
      window.location = "../vista/vistaPago.php";
    } else if (respOK[1] === "2") {
      /*alert("Usted ya tiene un pedido Activo, porfavor termine el pedido antes de inicializar otro" + respOK[0]);*/
      //Alert pago para realizar
      Swal.fire({
        title: "Imposible de realizar el pago!",
        text: "Usted ya tiene un pedido en espera, porfavor espera a que confirmen el pedido antes de realizar otro o bien puede revisar el ultimo pedido",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Quiero ver el pedido",
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = "../vista/vistaPago.php";
        }
      });
      //window.location="../../Productos/vista/listaProductos.php";
    } else {
      //alert("Fallo al realizar el pago"+respOK[0]);
    }
  }
}

//Si el carrito esta vacio aun admite el pago
