function search() {
  input = document.getElementById('searchInput').value;
  var rows =
    document.querySelectorAll(".concierto");

  for (i=0; i < rows.length; i++){
    fecha =
      rows[i].querySelector('.fecha');
    if (fecha.innerHTML.indexOf(input) > -1) {
      rows[i].style.display = "";
    } else {
      rows[i].style.display = "none";
    }
  }

function checkForm() {


    correcto = true;
    
    fecha = $('input[name="fecha"]').val()
    if ( fecha == "" ) {
        $('#fechaErr').show();
        correcto = false
    } else {
        $('#fechaErr').hide();
    }
    

    hora = $('input[name="hora"]').val()
    if ( hora == "" ) {
        $('#horaErr').show();
        correcto = false
    } else {
        $('#horaErr').hide();
    }


    localizacion = $('input[name="localizacion"]').val()
    if ( localizacion == "" ) {
        $('#localizacionErr').show();
        correcto = false
    } else {
        $('#localizacionErr').hide();
    }


    if (!correcto){
        window.scrollTo(0,0);
    }

    return correcto;



  //console.log(rows);
}
