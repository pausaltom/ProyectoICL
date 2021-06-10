function loadEvents() {
  //carga los productos por defecto
  //loadProductos();
  //btn actions
  document.getElementById("primera").addEventListener("click", () => {
    primera();
  });

  document.getElementById("anterior").addEventListener("click", () => {
    anterior();
  });

  document.getElementById("siguiente").addEventListener("click", () => {
    siguiente();
  });
}

function checkError() { 
  var error = getURLParams();

  if (error == null) {
    
  } else {
    //alert(error);
    Swal.fire({
      icon: 'error',
      title: error,
      text: error,    
    }).then((result)=>{
      if (result.isConfirmed) {        
        location.reload();
        location.replace("http://localhost/php");
      }
    })    
  }
}

function getURLParams() {
  const queryString = window.location.search;
  //console.log(queryString);
  const urlParams = new URLSearchParams(queryString);
  const errorMessage = urlParams.get('error')
  console.log("Mensaje de error: "+errorMessage);
  return errorMessage;
}

//--------------Eventos pagina-----------------//

function primera() {
  var image = document.getElementById("img1");
  var image2 = document.getElementById("img2");
  var image3 = document.getElementById("img3");
  image.src ="../uploads/Formaggio.jpg";
  image2.src ="../uploads/Americana.jpg";
  image3.src ="../uploads/Hawaiana.jpg";
}

function anterior() {
  var image = document.getElementById("img1");
  var image2 = document.getElementById("img2");
  var image3 = document.getElementById("img3");
  image.src ="../uploads/Peperoni.jpg";
  image2.src ="../uploads/Bacon-Crispy.jpg";
  image3.src ="../uploads/Sin-Gluten-4-Quesos.jpg";
}

function siguiente() {
  var image = document.getElementById("img1");
  var image2 = document.getElementById("img2");
  var image3 = document.getElementById("img3");
  image.src ="../uploads/ravioli.jpg";
  image2.src ="../uploads/PUTANESCA.jpg";
  image3.src ="../uploads/Lasana.jpg";
}