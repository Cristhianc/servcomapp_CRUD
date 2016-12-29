$(document).ready(function(){
  /* Almacena localmente y por sesion una variable que indica el estado de los
   * botones radio estudiante y coordinador. Por defecto el boton radio
   * estudiante esta seleccionado y el de coordinador no, por lo tanto asi los
   * inicializa al recargar la pagina.*/
  sessionStorage.setItem("rboton_estud", "true");
  sessionStorage.setItem("rboton_coord", "false");
  $("#rbtn_coord").click(function() {
    /* Si el boton radio no esta seleccionado entonces procede a remover el
     * el campo carrera, agregar el campo facultad y oficina al formulario de
     * usuarios. Luego actualiza el estado de ambos botones.*/
    if (sessionStorage.rboton_coord === "false") {
      $("#us_carrera").remove();
      $("#form_usuarios").append(
        '<div class="form-group" id="us_facultad">' +
          '<label for="" class="col-md-4 control-label">Facultad (*):</label>' +
          '<div class="col-md-5">' +
            '<input type="email" class="form-control" id="">' +
          '</div>' +
        '</div>'
      );
      $("#form_usuarios").append(
        '<div class="form-group" id="us_oficina">' +
          '<label for="" class="col-md-4 control-label">Oficina (*):</label>' +
          '<div class="col-md-5">' +
            '<input type="email" class="form-control" id="">' +
          '</div>' +
        '</div>'
      );
      sessionStorage.rboton_coord = "true";
      sessionStorage.rboton_estud = "false";
    }
  });
  $("#rbtn_estud").click(function() {
    /* Si el boton radio no esta seleccionado entonces remueve los campos
     * facultad y oficina y, agrega el campo carrera al formulario de usuarios.
     * Luego actualiza el estado de los botones.*/
    if (sessionStorage.rboton_estud === "false") {
      $("#us_facultad").remove();
      $("#us_oficina").remove();
      $("#form_usuarios").append(
        '<div class="form-group" id="us_carrera">' +
          '<label for="" class="col-md-4 control-label">No Carrera (*):</label>' +
          '<div class="col-md-5">' +
            '<input type="email" class="form-control" id="">' +
          '</div>' +
        '</div>'
      );
      sessionStorage.rboton_coord = "false";
      sessionStorage.rboton_estud = "true";
    }
  });
});
