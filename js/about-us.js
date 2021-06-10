function loadEvents() {
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
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
          window.open("comun/logout.php", "_self");
        }
      });
    });
  } catch (error) {
    console.log("Solo dara error debido a que no se inició sesion");
  }
}
