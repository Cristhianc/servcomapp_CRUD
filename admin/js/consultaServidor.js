$(document).ready(function() {
  
  /* Agrega al evento submit una funcion que consulta de manera asincrona al
   * servidor mediante AJAX, pasandole los parametros necesarios para esta
   * consulta. Ademas agrega tres funciones adicionales que se van a ejecutar
   * dependiendo del resultado de la consulta.*/
  $("#form_estudiante").submit( function(evento) {
    evento.preventDefault();
    $("#resp_usuarios").remove();
    var data = $(this).serializeArray();
    $.ajax({
      url: "../wp-content/mu-plugins/servcomapp_CRUD/admin/consultasMYSQL/consultasEstudiante.php",
      type: "POST",
      data: data
    })
    .done( function() {
      /*Funcion que se ejecuta si la consulta fue exitosa.*/
      $("#alerta_usuarios").prepend(
        '<div class="updated" id="resp_usuarios">' +
          '<p>Estudiante Registrado correctamente</p>' +
        '</div>'
      );
    })
    .fail(function(xhr, status, error){
      /*Funcion que se ejecuta si la consulta no fue exitosa.*/
      console.log("Estado: " + status + " Error: " + error);
      console.log(xhr);
      $("#alerta_usuarios").prepend(
        '<div class="updated" id="resp_usuarios">' +
          '<p>No se pudo registrar al Estudiante</p>' +
        '</div>'
      );
    })
    .always( function() {
      /*Funcion que se ejecuta siempre, sea exitosa o no la consulta.*/
    });
  })

  $("#form_coordinador").submit( function(evento) {
    evento.preventDefault();
    $("#resp_usuarios").remove();
    var data = $(this).serializeArray();
    $.ajax({
      url: "../wp-content/mu-plugins/servcomapp_CRUD/admin/consultasMYSQL/consultasCoordinador.php",
      type: "POST",
      data: data
    })
    .done( function() {
      /*Funcion que se ejecuta si la consulta fue exitosa.*/
      $("#alerta_usuarios").prepend(
        '<div class="updated" id="resp_usuarios">' +
          '<p>Coordinador Registrado correctamente</p>' +
        '</div>'
      );
    })
    .fail(function(xhr, status, error){
      /*Funcion que se ejecuta si la consulta no fue exitosa.*/
      console.log("Estado: " + status + " Error: " + error);
      console.log(xhr);
      $("#alerta_usuarios").prepend(
        '<div class="updated" id="resp_usuarios">' +
          '<p>No se pudo registrar al Coordinador</p>' +
        '</div>'
      );
    })
    .always( function() {
      /*Funcion que se ejecuta siempre, sea exitosa o no la consulta.*/
    });
  })
});
