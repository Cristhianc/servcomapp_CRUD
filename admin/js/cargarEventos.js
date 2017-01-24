/* Script que se ejecuta cuando el documento ha sido cargado por completo. Este
 * se encarga de cargar todos los eventos relacionados con el plugin para las
 * diferentes areas de trabajo.
 */
$( document ).ready( function(){

  // AREA DE EVENTOS PARA EL AREA DE LOS USUARIOS

  /* Almacena localmente y por sesion una variable que indica el estado de los
   * botones radio estudiante y coordinador tanto para el formulario de usuarios
   * como para la tabla que mostrara los registros. Por defecto el boton radio
   * estudiante esta seleccionado y el de coordinador no, por lo tanto asi los
   * inicializa al recargar la pagina. De la misma manera se aplica para los
   * botones de la tabla de usuarios. Por ultimo, se establece con que tipo de
   * usuario se va a trabajar, por defecto se coloca el valor de 'estudiante'.
   */
  sessionStorage.setItem( "rboton_estud", "true" );
  sessionStorage.setItem( "rboton_coord", "false" );
  sessionStorage.setItem( "rboton_tu_estud", "true" );
  sessionStorage.setItem( "rboton_tu_coord", "false" );
  sessionStorage.setItem( "tipo_de_usuario", "estudiante" );
	
  // sessionStorage para almacenamiento de variable id de manera global (Que se usa en editar y borrar)
  sessionStorage.setItem("id", null);

  /* Establece una variable de sesion para poder determinar el tipo de consulta
   * que se desea llevar a cabo. Esto solo aplica para los casos de insertar y
   * editar, por defecto se indica que se desea realizar una insercion a la base
   * de datos, pero dependiendo de las acciones del usuario, puede cambiar a
   * editar. Los dos valores seran:
   *
   * Para consultas de insercion: 'insertar'
   *
   * Para consultas de modificacion 'editar'
   */
  sessionStorage.setItem( "tipo_consulta", "insertar" );

  /* Al cargar la pagina del area de administracion del plugin, por defecto
   * carga la tabla de usuarios del tipo 'estudiante' con todos los registros
   * existentes que haya en la base de datos.
   */
  seleccionar_usuarios("estudiante");

  /* Agrega un evento del tipo click a el boton del formulario de usuarios con
   * el respectivo id: "rbtn_estud" referente a los usuarios tipo 'estudiante'.
   */
  $( "#rbtn_estud" ).click( function() {
    activarForm_estudiante();
  });

  /* Agrega un evento del tipo click a el boton del formulario de usuarios con
   * el respectivo id: "rbtn_coord" referente a los usuarios tipo 'coordinador'.
   */
  $( "#rbtn_coord" ).click( function() {
    activarForm_coordinador();
  });

  /* Agrega un evento del tipo click a el boton de la tabla de usuarios con
   * el respectivo id: "rbtn_tu_estud" referente a los usuarios tipo
   * 'estudiante'. Tambien comprueba si el boton esta deshabilitado o no.
   */
  $( "#rbtn_tu_estud" ).click( function() {
    if ( $( "#rbtn_tu_estud" ).attr( "disabled" ) !== "disabled" ) {
      activarTabla_estudiante();
    }
  });

  /* Agrega un evento del tipo click a el boton de la tabla de usuarios con
   * el respectivo id: "rbtn_tu_coord" referente a los usuarios tipo
   * 'coordinador'. Tambien comprueba si el boton esta deshabilitado o no.
   */
  $( "#rbtn_tu_coord" ).click( function() {
    if ( $( "#rbtn_tu_coord" ).attr( "disabled" ) !== "disabled" ) {
      activarTabla_coordinador();
    }
  });

  // Boton que se encarga de devolver al estado de creacion de un usuario.
  $( "#btn_agregarUsuario" ).click( function() {
    if ( sessionStorage.tipo_consulta !== "insertar" ) {
      sessionStorage.tipo_consulta = "insertar";
      $( ".titulo_usuario" ).html("Crear Usuario");
    }
  });
	
  
  /* Agrega un evento del tipo submit que se ejecutara al enviar el formulario
   * correctamente para que sea procesado por AJAX y luego por el archivo .php
   * que le corresponda dependiendo del caso.*/
  $( "#form_usuarios" ).submit( function(evento) {
    /**
     * @var    $data          arreglo de datos que contiene el formulario con el
     *                        atributo 'name'.
     */
    var data = $( this ).serializeArray();

    // Funcion que previene la recarga de la pagina
    evento.preventDefault();

    /* Llamada al procedimiento que inserta, edita o borra los datos, pasando la data
     * del formulario.
     */
	  if(sessionStorage.tipo_consulta === "editar" && sessionStorage.id != null){
		 // Llamada al procedimiento de edicion de usuario.
		  editar_usuario(data);
	  }else if(sessionStorage.tipo_consulta === "borrar" && sessionStorage.id != null){
		 // Llamada al procedimiento de eliminacion de usuario.
		  // eliminar_usuario(data);
	  }else{
		insertar_usuarios( data );
	  }

  });

  // FIN DEL AREA DE LOS EVENTOS PARA EL FORMULARIO DE LOS USUARIOS

});
