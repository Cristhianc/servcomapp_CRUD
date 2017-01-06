<?php
// Solicita la clase que maneja todas las consultas SQL de la base de datos.
require_once( dirname(__FILE__) . '/class-servcomapp-crud-bdd.php' );

// Procedimiento que realiza la insercion de un nuevo estudiante a la base de datos
function insertar_Estudiante() {

  /* Si el metodo de peticion es POST y su contenido no esta vacio, entonces
   * ejecuta las instrucciones de abajo.*/
  if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST' && !empty($_POST)) {

    /* Crea una nuevo objeto que realizara todas las operaciones pertinentes a
     * la base de datos.*/
    $bdd = new servcomapp_crud_bdd();

    /* Escapa caracteres especiales de la entrada que haya ingresado el usuario
     * para evitar cualquier inyeccion de SQL y devuelve el valor dentro de
     * comillas individuales.*/
    $nombre = $bdd -> citar_escapar($_POST['us_nom']);
    $apellido = $bdd -> citar_escapar($_POST['us_ape']);
    $correo = $bdd -> citar_escapar($_POST['us_corr']);
    $cedula = $bdd -> citar_escapar($_POST['us_ced']);
    $telefono = $bdd -> citar_escapar($_POST['us_tel']);
    $apodo = $bdd -> citar_escapar($_POST['us_apo']);
    $clave = $bdd -> citar_escapar($_POST['us_cla']);
    $carrera = $bdd -> citar_escapar($_POST['us_carr']);

    // Coloca el horario actual de caracas
    date_default_timezone_set('America/Caracas');

    /* Inserta en la base de datos el nuevo usuario con todos los parametros
     * necesarios para la consulta. Para mas informacion, consultar la tabla
     * sc_usuarios de la base de datos.
     *
     * Instruccion tipo INSERT
     */
    $resultado = $bdd -> consultar("INSERT INTO" . " sc_usuarios ( us_apodo , us_clave ," .
      " us_tipo , us_nombre , us_fechaCreacion ) VALUES (" . $apodo . " , " .
      $clave . " , 'estudiante' , " . $nombre . " , '" . date("Y-m-d") . "' )");

    /* Busca el id del usuario que sea igual al apodo o nombre de usuario. Esto
     * se lleva a cabo para luego poder insertar una entidad persona a la base
     * de datos. Luego almacena este valor en una variable que sera pasada a la
     * siguiente consulta.
     *
     * Instruccion tipo SELECT
     */
    if ( $resultado !== false ) {
       $usuario_id = $bdd -> seleccionar("SELECT us_id FROM sc_usuarios WHERE us_apodo = " . $apodo);
    } else {
       echo "false";
       exit();
    }

    /* Inserta en la base de datos la nueva persona con todos los parametros
     * necesarios para la consulta. Para mas informacion, consultar la tabla
     * sc_personas de la base de datos.
     *
     * Instruccion tipo INSERT
     */
     if ( $usuario_id !== false ) {
       $resultado = $bdd -> consultar("INSERT INTO" . " sc_personas ( sc_usuarios_us_id , " .
         " pe_cedula , pe_nombre , pe_apellido , pe_correo , pe_telefono ) VALUES ( " .
         $usuario_id[0]['us_id'] . " , " . $cedula . " , " . $nombre . " , " . $apellido . " , " . $correo .
         " , " . $telefono . " )");
     } else {
       echo "false";
       exit();
     }


    /* Busca el id de la carrera que sea igual al nombre de esta pasado
     * por el usuario. Esto se lleva a cabo para poder insertar un nuevo
     * estudiante a la base de datos.
     *
     * Instruccion tipo SELECT
     */
     if ( $resultado !== false ) {
       $carrera_id = $bdd -> seleccionar("SELECT ca_id FROM sc_carreras WHERE ca_nombre = " . $carrera);
     } else {
       echo "false";
       exit();
     }

    /* Inserta en la base de datos el nuevo estudiante con todos los parametros
     * necesarios para la consulta. Para mas informacion, consultar la tabla
     * sc_estudiantes de la base de datos.
     *
     * Instruccion tipo INSERT
     */
     if ( $carrera_id !== false ) {
       $resultado = $bdd -> consultar("INSERT INTO" . " sc_estudiantes ( " .
         "sc_personas_pe_cedula , sc_carreras_ca_id ) VALUES ( " . $cedula . " , " .
         $carrera_id[0]['ca_id'] .  " )");
     } else {
       echo "false";
       exit();
     }

    //Cierra la conexion a la base de datos.
    $bdd -> cerrar_conexion();
  }
}

/* Procedimiento que recupera todos los registros existentes de un estudiante
 * en la base de datos.
 */
function seleccionar_Estudiantes() {

  /* Crea una nuevo objeto que realizara todas las operaciones pertinentes a
   * la base de datos.*/
  $bdd = new servcomapp_crud_bdd();

  /* Realiza una consulta en la base de datos para extraer todos los datos
   * correspondientes a los usuarios tipo estudiante, uniendo varias tablas de
   * la base de datos, pero solo seleccionando ciertas columnas de estas para
   * mostrar en la tabla de estudiantes del area de los usuarios.
   */
  $resultado = $bdd -> seleccionar("SELECT pe_nombre, pe_apellido, pe_correo, ".
    "pe_cedula, pe_telefono, us_apodo, us_clave, ca_nombre " .
    "FROM sc_estudiantes est " .
    "INNER JOIN sc_personas per " .
    "ON est.sc_personas_pe_cedula = per.pe_cedula " .
    "INNER JOIN sc_usuarios users " .
    "ON per.sc_usuarios_us_id = users.us_id " .
    "INNER JOIN sc_carreras carr " .
    "ON est.sc_carreras_ca_id = carr.ca_id"
  );

  /* Luego transforma el resultado de la consulta en un archivo .json y lo
   * devuelve como parte de la respuesta que da el servidor.
   */
  $resultado = json_encode($resultado);
  echo $resultado;
}

/* Verifica que tipo de consulta se envio y ejecuta su caso correspondiente.
 * Aqui deberian ir todas las llamadas a las funciones respectivas de cada tipo
 * de consulta.
 */
switch ($_POST['tipo_cons']) {

  // Insertar
  case 'insertar':
    insertar_Estudiante();
    echo "true";
    break;

  // Seleccionar
  case 'seleccionar':
    seleccionar_Estudiantes();
    break;

  // Editar
  case 'editar':
    # code...
    break;

  // Eliminar
  case 'eliminar':
    # code...
    break;

  // Accion por defecto
  default:
    # code...
    break;
}