/* SCRIPT que maneja todas las funciones necesarias que se vayan a utilizar en el
 * area de los Usuarios.*/

// AREA DE LAS DIFERENTES CONSULTAS CON AJAX

/* Procedimiento que se encarga de insertar un usuario, ya sea
 * coordinador o estudiante, pasandole toda la data introducida por el usuario
 * en el formulario de usuarios.
 */
function insertar_usuarios( data ) {

  /**
   * @var    dir_url       La ubicacion del archivo .php que procesara la
   *                        consulta.
   */
  var dir_url;

  /* Remueve el elemento donde va la respuesta del servidor, si es que hubo
   * una consulta anterior a esta.
   */
  $( "#resp_usuarios" ).remove();

  /* Si el tipo de usuario que esta indicado es 'estudiante', entonces indica
   * la direccion url para procesar la consulta respectiva, de lo contrario
   * indica la direccion url respectiva para el tipo de usuario 'coordinador'.
   */
  if ( sessionStorage.tipo_de_usuario === "estudiante" ) {
    dir_url = "../wp-content/mu-plugins/servcomapp_CRUD/admin/consultasMYSQL/consultasEstudiante.php";
  } else if ( sessionStorage.tipo_de_usuario === "coordinador" ){
    dir_url = "../wp-content/mu-plugins/servcomapp_CRUD/admin/consultasMYSQL/consultasCoordinador.php";
  }

  /* Agrega el tipo de consulta que se va a realizar en el archivo .php
   * respectivo. De esta manera se logra llamar solo a la funcion de insercion.
   * El nombre de la variable que se pasa por el metodo post para determinar el
   * tipo de consulta se llama 'tipo_cons'.
   */
   data.push({ name: 'tipo_cons', value: 'insertar' });

  /* Mediante AJAX y pasandole los parametros correspondiente a esta funcion,
   * se logra enviar todos los datos necesarios para que el servidor procese
   * la peticion de manera efectiva con el uso del metodo POST.
   */
  $.ajax({
    url: dir_url,
    type: "POST",
    data: data
  })
  .done( function( respuesta ) {

    /* Funcion que se ejecuta si la consulta fue exitosa. Tambien indica el
     * tipo de usuario que fue registrado correctamente. Si no se pudo registrar
     * informa sobre el fallo al usuario. Ademas, agrega a la tabla activa en el
     * momento el usuario que fue insertado, siempre y cuando corresponda al
     * tipo de tabla activa.
     */
     if ( respuesta === "true" ) {
       if ( sessionStorage.tipo_de_usuario === "estudiante" ) {
         $( "#alerta_usuarios" ).prepend(
           '<div class="updated" id="resp_usuarios">' +
             '<p>Estudiante Registrado correctamente</p>' +
           '</div>'
         );
         if ( sessionStorage.rboton_tu_estud === "true" ) {
           $("#tabla_usuarios").append(
             '<tr id="' + data[5]["value"] + '">' +
               '<th>' + data[0]["value"] + '</th>' +
               '<th>' + data[1]["value"] + '</th>' +
               '<th>' + data[2]["value"] + '</th>' +
               '<th>' + data[3]["value"] + '</th>' +
               '<th>' + data[4]["value"] + '</th>' +
               '<th>' + data[5]["value"] + '</th>' +
               '<th>' + data[6]["value"] + '</th>' +
               '<th>' + data[7]["value"] + '</th>' +
               '<th>' +
                 '<button type="button" class="btn btn-default btn-sm">' +
                   '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>' +
                 '</button>' +
               '</th>' +
               '<th>' +
                 '<button type="button" class="btn btn-default btn-sm">' +
                   '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>' +
                 '</button>' +
               '</th>' +
             '</tr>'
           );
         }
       } else if ( sessionStorage.tipo_de_usuario === "coordinador" ) {
         $( "#alerta_usuarios" ).prepend(
           '<div class="updated" id="resp_usuarios">' +
             '<p>Coordinador Registrado correctamente</p>' +
           '</div>'
         );
         if ( sessionStorage.rboton_tu_coord === "true" ) {
           $( "#tabla_usuarios" ).append(
             '<tr id="' + data[5]["value"] + '">' +
               '<th>' + data[0]["value"] + '</th>' +
               '<th>' + data[1]["value"] + '</th>' +
               '<th>' + data[2]["value"] + '</th>' +
               '<th>' + data[3]["value"] + '</th>' +
               '<th>' + data[4]["value"] + '</th>' +
               '<th>' + data[5]["value"] + '</th>' +
               '<th>' + data[6]["value"] + '</th>' +
               '<th>' + data[7]["value"] + '</th>' +
               '<th>' + data[8]["value"] + '</th>' +
               '<th>' +
                 '<button type="button" class="btn btn-default btn-sm">' +
                   '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>' +
                 '</button>' +
               '</th>' +
               '<th>' +
                 '<button type="button" class="btn btn-default btn-sm">' +
                   '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>' +
                 '</button>' +
               '</th>' +
             '</tr>'
           );
         }
       }
     }
     else if ( respuesta === "false" ) {
       if ( sessionStorage.tipo_de_usuario === "estudiante" ) {
         $( "#alerta_usuarios" ).prepend(
           '<div class="updated" id="resp_usuarios">' +
             '<p>No se pudo registrar al estudiante. Verifique que no exista ' +
             'aun o que los valores de cada campo estan en el formato correcto</p>' +
           '</div>'
         );
       } else if ( sessionStorage.tipo_de_usuario === "coordinador" ) {
         $( "#alerta_usuarios" ).prepend(
           '<div class="updated" id="resp_usuarios">' +
            '<p>No se pudo registrar al coordinador. Verifique que no exista ' +
            'aun o que los valores de cada campo estan en el formato correcto</p>' +
           '</div>'
         );
       }
     }
  })
  .fail( function( xhr, status, error ) {

    /* Funcion que se ejecuta si la consulta no fue exitosa. Tambien indica el
     * tipo de usuario que no pudo ser registrado. Imprime el estado, error e
     * informacion adicional acerca de la situacion presente.
     */
    console.log( "Estado: " + status + " Error: " + error );
    console.log( xhr );
  })
  .always( function() {
    /*Funcion que se ejecuta siempre, sea exitosa o no la consulta.*/
  });
}


/* Procedimiento que se encargar de consultar en la base de datos todos los
 * registros existentes del tipo de usuario que se haya indicado y ademas, los
 * carga en la tabla de usuarios.
 */
function seleccionar_usuarios( tipoUsuario_tabla ) {

  /**
   * @var    dir_url       La ubicacion del archivo .php que procesara la
   *                        consulta.
   * @var    data          Arreglo que contiene una serie de parametros que se
   *                       le pasaran al archivo .php para ser procesado por el
   *                       servidor.
   *
   */
  var dir_url;
  var data = [{ name: "tipo_cons" , value: "seleccionar" }];

  /* Si el tipo de usuario que esta indicado es 'estudiante', entonces indica
   * la direccion url para procesar la consulta respectiva, de lo contrario
   * indica la direccion url respectiva para el tipo de usuario 'coordinador'.
   */
  if ( tipoUsuario_tabla === "estudiante" ) {
    dir_url = "../wp-content/mu-plugins/servcomapp_CRUD/admin/consultasMYSQL/consultasEstudiante.php";
  } else if ( tipoUsuario_tabla === "coordinador" ){
    dir_url = "../wp-content/mu-plugins/servcomapp_CRUD/admin/consultasMYSQL/consultasCoordinador.php";
  }

  /* Mediante AJAX y pasandole los parametros correspondiente a esta funcion,
   * se logra enviar todos los datos necesarios para que el servidor procese
   * la peticion de manera efectiva con el uso del metodo POST.
   */
  $.ajax({
    url: dir_url,
    type: "POST",
    data: data
  })
  .done( function( respuesta ) {

    /* Obtiene de parte del servidor un archivo .json que lo transforma en un
     * arreglo lleno de objetos, los cuales son los registros que se obtuvieron
     * de la consulta a la base de datos. Luego va cargandolos en la tabla
     * de usuarios, asi como los botones de editar y borrar para cada registro.
     */
    respuesta = JSON.parse(respuesta);
    for ( i = 0 ; i < respuesta.length ; i++ ) {
      $( "#tabla_usuarios" ).append(
        '<tr id="' + respuesta[i].us_apodo + '"></tr>'
      );
      for ( registro in respuesta[i] ) {
        $( "#" + respuesta[i].us_apodo ).append(
          '<th>' + respuesta[i][registro] + '</th>'
        );
      }
      $( "#" + respuesta[i].us_apodo ).append(
        '<th>' +
          '<button type="button" class="btn btn-default btn-sm" onclick="element(this); ">' +
            '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>' +
          '</button>' +
        '</th>' +
        '<th>' +
          '<button type="button" class="btn btn-default btn-sm">' +
            '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>' +
          '</button>' +
        '</th>'
      );
    }
    if ( sessionStorage.rboton_tu_estud === "true" ) {
      $( "#rbtn_tu_coord" ).removeAttr( 'disabled' );
    } else if ( sessionStorage.rboton_tu_coord === "true" ) {
      $( "#rbtn_tu_estud" ).removeAttr( 'disabled' );
    }

  })
  .fail( function( xhr, status, error ){

    /* Funcion que se ejecuta si la consulta no fue exitosa. Tambien indica el
     * tipo de usuario que no pudo ser registrado. Imprime el estado, error e
     * informacion adicional acerca de la situacion presente.
     */
    console.log( "Estado: " + status + " Error: " + error );
    console.log( xhr );
  })
  .always( function() {
    /*Funcion que se ejecuta siempre, sea exitosa o no la consulta.*/
  });
}

// FIN DEL AREA DE LAS DIFERENTES CONSULTAS CON AJAX

// AREA DEL MANEJO DE LA GUI

/* Procedimiento que activa el formulario para procesarlo con el tipo de usuario
 * 'estudiante'.
 */
function activarForm_estudiante() {

  /* Si el boton radio que indica el tipo de usuario 'estudiante' no esta
   * seleccionado entonces remueve los campos facultad y oficina, remueve los
   * botones de enviar y limpiar, agrega el campo carrera al formulario de
   * usuarios y, finalmente agrega los botones de enviar y limpiar al formulario
   * otra vez. Luego actualiza el estado de los botones radio y, el tipo de
   * usuario que se procesara por el momento.
   */
  if ( sessionStorage.rboton_estud === "false" ) {
    $( "#us_facultad" ).remove();
    $( "#us_oficina" ).remove();
    $( "#us_botones" ).remove();
    $( "#form_usuarios" ).append(
      '<div class="form-group" id="us_carrera">' +
        '<label for="us_carr" class="col-md-4 control-label">Carrera (*):</label>' +
        '<div class="col-md-5">' +
          '<select class="form-control" name="us_carr" id="us_carr" required>' +
            '<option value=""></option>' +
            '<option value="arquitectura">Arquitectura</option>' +
            '<option value="i_computacion">Ing. en Computacion</option>' +
            '<option value="i_civil">Ing. Civil</option>' +
            '<option value="i_industrial">Ing. Industrial</option>' +
            '<option value="i_electronica">Ing. Electronica</option>' +
            '<option value="i_mecanica">Ing. Mecanica</option>' +
            '<option value="i_telecomunicacion">Ing. en Telecomunicacion</option>' +
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
    $( "#form_usuarios" ).append(
      '<div class="form-group" id="us_botones">' +
        '<div class="btns_formulario" id="btns_usuarios">' +
          '<button type="submit" class="btn btn-primary" id="us_boton">Enviar</button>' +
          '<button type="reset" class="btn btn-primary" id="us_boton">Limpiar</button>' +
        '</div>' +
      '</div>'
    );
    sessionStorage.rboton_coord = "false";
    sessionStorage.rboton_estud = "true";
    sessionStorage.tipo_de_usuario = "estudiante";
  }
}

/* Procedimiento que activa el formulario para procesarlo con el tipo de usuario
 * 'coordinador'.
 */
function activarForm_coordinador() {

  /* Si el boton radio que indica el tipo de usuario 'coordinador' no esta
   * seleccionado entonces procede a remover el campo carrera, remover los
   * botones de enviar y limpiar, agregar el campo facultad y oficina y,
   * finalmente agrega los botones de enviar y limpiar al formulario de usuarios
   * otra vez. Luego actualiza el estado de ambos botones radio y, el tipo de
   * usuario que se procesara por el momento.
   */
  if ( sessionStorage.rboton_coord === "false" ) {
    $( "#us_carrera" ).remove();
    $( "#us_botones" ).remove();
    $( "#form_usuarios" ).append(
      '<div class="form-group" id="us_facultad">' +
        '<label for="us_fac" class="col-md-4 control-label">Facultad (*):</label>' +
        '<div class="col-md-5">' +
          '<select class="form-control" name="us_fac" id="us_fac" required>' +
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
    $( "#form_usuarios" ).append(
      '<div class="form-group" id="us_oficina">' +
        '<label for="us_ofic" class="col-md-4 control-label">Oficina (*):</label>' +
        '<div class="col-md-5">' +
          '<input type="text" class="form-control" name="us_ofic" id="us_ofic" required>' +
        '</div>' +
      '</div>'
    );
    $( "#form_usuarios" ).append(
      '<div class="form-group" id="us_botones">' +
        '<div class="btns_formulario" id="btns_usuarios">' +
          '<button type="submit" class="btn btn-primary" id="us_boton">Enviar</button>' +
          '<button type="reset" class="btn btn-primary" id="us_boton">Limpiar</button>' +
        '</div>' +
      '</div>'
    );
    sessionStorage.rboton_coord = "true";
    sessionStorage.rboton_estud = "false";
    sessionStorage.tipo_de_usuario = "coordinador";
  }
}

/* Procedimiento que se encarga de cargar todos los elementos necesarios de
 * la tabla de usarios del tipo estudiante.
 */
function activarTabla_estudiante() {
  if ( sessionStorage.rboton_tu_estud === "false" ) {
    $( "#tu_titulo" ).html("Registros de los Usuarios tipo Estudiante");
    $( "#rbtn_tu_coord" ).attr( 'disabled' , 'disabled' );
    sessionStorage.rboton_tu_coord = "false";
    sessionStorage.rboton_tu_estud = "true";
    $( "#tabla_usuarios" ).remove();
    $( "#area_tabla_tu" ).append(
      '<table class="table table-hover" id="tabla_usuarios">' +
        '<tr>' +
          '<th>Nombre</th>' +
          '<th>Apellido</th>' +
          '<th>Correo</th>' +
          '<th>Cedula</th>' +
          '<th>Telefono</th>' +
          '<th>Usuario</th>' +
          '<th>Clave</th>' +
          '<th>Carrera</th>' +
          '<th>Editar</th>' +
          '<th>Borrar</th>' +
        '</tr>' +
      '</table>'
    );
    seleccionar_usuarios( "estudiante" );
  }
}

/* Procedimiento que se encarga de cargar todos los elementos necesarios de
 * la tabla de usarios del tipo coordinador.
 */
function activarTabla_coordinador() {
  if ( sessionStorage.rboton_tu_coord === "false" ) {
    $( "#tu_titulo" ).html("Registros de los Usuarios tipo Coordinador");
    $( "#rbtn_tu_estud" ).attr( 'disabled' , 'disabled' );
    sessionStorage.rboton_tu_coord = "true";
    sessionStorage.rboton_tu_estud = "false";
    $( "#tabla_usuarios" ).remove();
    $( "#area_tabla_tu" ).append(
      '<table class="table table-hover" id="tabla_usuarios">' +
        '<tr>' +
          '<th>Nombre</th>' +
          '<th>Apellido</th>' +
          '<th>Correo</th>' +
          '<th>Cedula</th>' +
          '<th>Telefono</th>' +
          '<th>Usuario</th>' +
          '<th>Clave</th>' +
          '<th>Facultad</th>' +
          '<th>Oficina</th>' +
          '<th>Editar</th>' +
          '<th>Borrar</th>' +
        '</tr>' +
      '</table>'
    );
    seleccionar_usuarios( "coordinador" );
  }
}


// Funcion que realiza la obtención de datos dependiendo del sessionStorage.
// Estos datos serán pasados a otras funciones para hacer el set a cada input.
// La variable band evalua si los elementos son del mismo conjunto.
function element(e){
	
	// Cambio de tipo de sessionStorage de manera global a editar.
	// Edicion del texto arriba del formulario dependiendo de la consulta editar.
	sessionStorage.tipo_consulta = "editar";
	$( ".titulo_usuario" ).html("Editando usuario");
	
	// Obteniendo el id del padre y la fila. Init array vacio para el push de los textos.
	var fila = $(e).parent().parent();
	// Obteniendo id del elemento de MySQL.
	var id_file = fila.attr('id');
	// Arreglo creado sin limite donde se almacenara la informacion de estudiante
	// o de coordinadores.
	var data = [];
	// Variable booleana para la validacion de los elementos clickeados sean iguales.
	var band = false;
	
	// Recorrido para almacenar por cada columna de una fila 
	// en una tabla seleccionada los elementos respectivos.
	fila.find('th').each (function() {
		// Verificacion si los dos botones del mismo elemento están clickeados.
		if( sessionStorage.rboton_tu_estud === "true" && sessionStorage.tipo_de_usuario === "estudiante" ){
			// Imprimiendo el texto
			console.log($(this).text());
			
			if($(this).text() != ""){
				data.push($(this).text());
			}
	
			band = true;
			editando_estudiantes(data);

		}else if(sessionStorage.rboton_tu_coord === "true" && 		  sessionStorage.tipo_de_usuario === "coordinador"){
			// Imprimiendo el texto
			console.log($(this).text());
			
			if($(this).text() != ""){
			   data.push($(this).text());
			}
			
			band = true;
			editando_coordinadores(data);
		}

	});
	
	// Si se colocan dos botones no del mismo elemento se activa la alerta.
	if(band==false){
		$( "#alerta_usuarios" ).prepend(
           '<div class="error" id="resp_usuarios">' +
             '<p>No se puede editar elementos que no son del mismo sector.</p>' +
           '</div>');
	}

	// Debugging
	console.log(data);
	// Debugging
	console.log(sessionStorage.tipo_consulta);
	
	// ALMACENAMIENTO DE ID EN VARIABLE GLOBAL SESSIONSTORAGE
	sessionStorage.id = id_file;

}


// Funcion que actualiza el valor de los estudiantes en los formularios.
// Recibe como parámetro el data (arreglo que tiene los campos)
// Manda los datos obtenidos a el formulario.
// Para editar, se cambia el valor del submit.
function editando_estudiantes(data){
    $("#us_nom").val(data[0]);
    $("#us_ape").val(data[1]);
    $("#us_corr").val(data[2]);
    $("#us_ced").val(data[3]);
    $("#us_tel").val(data[4]);
	$("#us_apo").val(data[5]);
    $("#us_cla").val(data[6]);
	$("#us_carr").val(data[7]);
}


// Funcion que actualiza el valor de los coordinadores en los formularios.
// Recibe como parámetro el data (arreglo que tiene los campos)
// Manda los datos obtenidos a el formulario.
// Para editar, se cambia el valor del submit.
function editando_coordinadores(data){
    $("#us_nom").val(data[0]);
    $("#us_ape").val(data[1]);
    $("#us_corr").val(data[2]);
    $("#us_ced").val(data[3]);
    $("#us_tel").val(data[4]);
	$("#us_apo").val(data[5]);
    $("#us_cla").val(data[6]);
	$("#us_fac").val(data[7]);
	$("#us_ofic").val(data[8]);
}

// Limpieza de elementos cuando se cambia el boton.
// En estudiantes y coordinadores.
 $("#rbtn_estud").click(function(){
	var emp = "";
	$("#us_nom").val(emp);
    $("#us_ape").val(emp);
    $("#us_corr").val(emp);
    $("#us_ced").val(emp);
    $("#us_tel").val(emp);
	$("#us_apo").val(emp);
    $("#us_cla").val(emp);
	$("#us_carr").val(emp);
 });

 $("#rbtn_coord").click(function(){
	var vacio = "";
	$("#us_nom").val(vacio);
    $("#us_ape").val(vacio);
    $("#us_corr").val(vacio);
    $("#us_ced").val(vacio);
    $("#us_tel").val(vacio);
	$("#us_apo").val(vacio);
    $("#us_cla").val(vacio);
	$("#us_fac").val(vacio);
	$("#us_ofic").val(vacio);
 });

/* Procedimiento que se encarga de editar un usuario, ya sea
 * coordinador o estudiante, pasandole toda la data introducida por el usuario
 * en el formulario de usuarios. Se busca el id de la persona en el sessionStorage.
 */
function editar_usuario(data){
	// Almacenando la variable del apodo/id para usarla en la llamada PHP.
	var id = sessionStorage.id;

   /**
   * @var    dir_url       La ubicacion del archivo .php que procesara la
   *                        consulta.
   */
  var dir_url;

  /* Remueve el elemento donde va la respuesta del servidor, si es que hubo
   * una consulta anterior a esta.
   */
  $( "#resp_usuarios" ).remove();

  /* Si el tipo de usuario que esta indicado es 'estudiante', entonces indica
   * la direccion url para procesar la consulta respectiva, de lo contrario
   * indica la direccion url respectiva para el tipo de usuario 'coordinador'.
   */
  if ( sessionStorage.tipo_de_usuario === "estudiante" ) {
    dir_url = "../wp-content/mu-plugins/servcomapp_CRUD/admin/consultasMYSQL/consultasEstudiante.php";
  } else if ( sessionStorage.tipo_de_usuario === "coordinador" ){
    dir_url = "../wp-content/mu-plugins/servcomapp_CRUD/admin/consultasMYSQL/consultasCoordinador.php";
  }


  /* Agrega el tipo de consulta que se va a realizar en el archivo .php
   * respectivo. De esta manera se logra llamar solo a la funcion de insercion.
   * El nombre de la variable que se pasa por el metodo post para determinar el
   * tipo de consulta se llama 'tipo_cons'.
   */
   /* Se pasa el id del estudiante al arreglo data */
   data = '{'
       +'"tipo_cons" : "editar",'
       +'"id_busq"  : '+id+''
       +'}';


  /* Mediante AJAX y pasandole los parametros correspondiente a esta funcion,
   * se logra enviar todos los datos necesarios para que el servidor procese
   * la peticion de manera efectiva con el uso del metodo POST.
   */
  $.ajax({
    url: dir_url,
    type: "POST",
    data: data
  })
  .done( function( respuesta ) {

    /* Funcion que se ejecuta si la consulta fue exitosa. Tambien indica el
     * tipo de usuario que fue registrado correctamente. Si no se pudo registrar
     * informa sobre el fallo al usuario. Ademas, agrega a la tabla activa en el
     * momento el usuario que fue insertado, siempre y cuando corresponda al
     * tipo de tabla activa.
     */
     if ( respuesta === "true" ) {
       if ( sessionStorage.tipo_de_usuario === "estudiante" ) {
         $( "#alerta_usuarios" ).prepend(
           '<div class="updated" id="resp_usuarios">' +
             '<p>Estudiante editado correctamente!</p>' +
           '</div>'
         );
         if ( sessionStorage.rboton_tu_estud === "true" ) {
           $("#tabla_usuarios").append(
             '<tr id="' + data[5]["value"] + '">' +
               '<th>' + data[0]["value"] + '</th>' +
               '<th>' + data[1]["value"] + '</th>' +
               '<th>' + data[2]["value"] + '</th>' +
               '<th>' + data[3]["value"] + '</th>' +
               '<th>' + data[4]["value"] + '</th>' +
               '<th>' + data[5]["value"] + '</th>' +
               '<th>' + data[6]["value"] + '</th>' +
               '<th>' + data[7]["value"] + '</th>' +
               '<th>' +
                 '<button type="button" class="btn btn-default btn-sm">' +
                   '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>' +
                 '</button>' +
               '</th>' +
               '<th>' +
                 '<button type="button" class="btn btn-default btn-sm">' +
                   '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>' +
                 '</button>' +
               '</th>' +
             '</tr>'
           );
         }
       } else if ( sessionStorage.tipo_de_usuario === "coordinador" ) {
         $( "#alerta_usuarios" ).prepend(
           '<div class="updated" id="resp_usuarios">' +
             '<p>Coordinador Registrado correctamente</p>' +
           '</div>'
         );
         if ( sessionStorage.rboton_tu_coord === "true" ) {
           $( "#tabla_usuarios" ).append(
             '<tr id="' + data[5]["value"] + '">' +
               '<th>' + data[0]["value"] + '</th>' +
               '<th>' + data[1]["value"] + '</th>' +
               '<th>' + data[2]["value"] + '</th>' +
               '<th>' + data[3]["value"] + '</th>' +
               '<th>' + data[4]["value"] + '</th>' +
               '<th>' + data[5]["value"] + '</th>' +
               '<th>' + data[6]["value"] + '</th>' +
               '<th>' + data[7]["value"] + '</th>' +
               '<th>' + data[8]["value"] + '</th>' +
               '<th>' +
                 '<button type="button" class="btn btn-default btn-sm">' +
                   '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>' +
                 '</button>' +
               '</th>' +
               '<th>' +
                 '<button type="button" class="btn btn-default btn-sm">' +
                   '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>' +
                 '</button>' +
               '</th>' +
             '</tr>'
           );
         }
       }
     }
     else if ( respuesta === "false" ) {
       if ( sessionStorage.tipo_de_usuario === "estudiante" ) {
         $( "#alerta_usuarios" ).prepend(
           '<div class="updated" id="resp_usuarios">' +
             '<p>No se pudo editar al estudiante. Verifique que no exista ' +
             'aun o que los valores de cada campo estan en el formato correcto</p>' +
           '</div>'
         );
       } else if ( sessionStorage.tipo_de_usuario === "coordinador" ) {
         $( "#alerta_usuarios" ).prepend(
           '<div class="updated" id="resp_usuarios">' +
            '<p>No se pudo editar al coordinador. Verifique que no exista ' +
            'aun o que los valores de cada campo estan en el formato correcto</p>' +
           '</div>'
         );
       }
     }
  })
  .fail( function( xhr, status, error ) {

    /* Funcion que se ejecuta si la consulta no fue exitosa. Tambien indica el
     * tipo de usuario que no pudo ser registrado. Imprime el estado, error e
     * informacion adicional acerca de la situacion presente.
     */
    console.log( "Estado: " + status + " Error: " + error );
    console.log( xhr );
  })
  .always( function() {
    /*Funcion que se ejecuta siempre, sea exitosa o no la consulta.*/
  });


}
// FIN DEL AREA DE MANEJO DE LA GUI
