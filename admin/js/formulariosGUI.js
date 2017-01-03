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
    $("#form_estudiante").attr("id","form_coordinador");
    if (sessionStorage.rboton_coord === "false") {
      $("#us_carrera").remove();
      $("#us_botones").remove();
      $("#form_coordinador").append(
        '<div class="form-group" id="us_facultad">' +
          '<label for="" class="col-md-4 control-label">Facultad (*):</label>' +
          '<div class="col-md-5">' +
            '<select class="form-control" name="us_fac" required>' +
              '<option value=""></option>' +
              '<option value="f_ingenieria">Ingenieria</option>' +
              '<option value="f_csociales">Ciencias Sociales</option>' +
              '<option value="f_ceducacion">Ciencias de la Educacion</option>' +
              '<option value="f_csalud">Ciencias de la Salud</option>' +
              '<option value="f_cjurpol">Ciencias Juridicas y Politicas</option>' +
            '</select>' +
          '</div>' +
        '</div>'
      );
      $("#form_coordinador").append(
        '<div class="form-group" id="us_oficina">' +
          '<label for="" class="col-md-4 control-label">Oficina (*):</label>' +
          '<div class="col-md-5">' +
            '<input type="text" class="form-control" name="us_ofic" required>' +
          '</div>' +
        '</div>'
      );
      $("#form_coordinador").append(
        '<div class="form-group" id="us_botones">' +
          '<div class="btns_formulario" id="btns_usuarios">' +
            '<button type="submit" class="btn btn-primary" id="us_boton">Enviar</button>' +
            '<button type="reset" class="btn btn-primary" id="us_boton">Limpiar</button>' +
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
    $("#form_coordinador").attr("id", "form_estudiante");
    if (sessionStorage.rboton_estud === "false") {
      $("#us_facultad").remove();
      $("#us_oficina").remove();
      $("#us_botones").remove();
      $("#form_estudiante").append(
        '<div class="form-group" id="us_carrera">' +
          '<label for="" class="col-md-4 control-label">Carrera (*):</label>' +
          '<div class="col-md-5">' +
            '<select class="form-control" name="us_carr" required>' +
              '<option value=""></option>' +
              '<option value="arquitectura">Arquitectura</option>' +
              '<option value="i_computacion">Ing. en Computacion</option>' +
              '<option value="i_civil">Ing. Civil</option>' +
              '<option value="i_industrial">Ing. Industrial</option>' +
              '<option value="i_electronica">Ing. Electronica</option>' +
              '<option value="i_mecanica">Ing. Mecanica</option>' +
              '<option value="a_empresas">Adm. de Empresas</option>' +
              '<option value="a_publica">Adm. Publica</option>' +
              '<option value="c_publica">Cont. Publica</option>' +
              '<option value="mercadeo">Mercadeo</option>' +
              '<option value="r_industriales">Rel. Industriales</option>' +
              '<option value="informatica">Informatica</option>' +
              '<option value="integral">Integral</option>' +
              '<option value="preescolar">Preescolar</option>' +
              '<option value="odontologia">Odontologia</option>' +
              '<option value="derecho">Derecho</option>' +
            '</select>' +
          '</div>' +
        '</div>'
      );
      $("#form_estudiante").append(
        '<div class="form-group" id="us_botones">' +
          '<div class="btns_formulario" id="btns_usuarios">' +
            '<button type="submit" class="btn btn-primary" id="us_boton">Enviar</button>' +
            '<button type="reset" class="btn btn-primary" id="us_boton">Limpiar</button>' +
          '</div>' +
        '</div>'
      );
      sessionStorage.rboton_coord = "false";
      sessionStorage.rboton_estud = "true";
    }
  });
});
