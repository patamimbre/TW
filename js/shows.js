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

  //console.log(rows);
}
