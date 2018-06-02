
function search() {
  input = document.getElementById('searchInput').value;
  var discos =
    document.querySelectorAll(".disco");


  for (i=0; i < discos.length; i++){
    titulo =
      discos[i].querySelector('.titulo');
    canciones =
      discos[i].querySelectorAll(".cancion");

    en_cancion = false;
      console.log('-------------');
      //console.log(canciones);

  for (c=0; c < canciones.length; c++){
    nombre = canciones[c].querySelector(".nombre>p");
    console.log(nombre.innerHTML);
    if (nombre.innerHTML.indexOf(input) > -1) {
      en_cancion = true;
    } 
  }





    if (titulo.innerHTML.indexOf(input) > -1) {
      discos[i].style.display = "";
    } else {
      discos[i].style.display = "none";
    }
  }

  console.log('***************');


  //console.log(canciones);
}
