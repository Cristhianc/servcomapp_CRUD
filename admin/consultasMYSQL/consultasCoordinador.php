<?php
/* Solicita la clase que maneja todas las operaciones generales de la base de
 * datos. */
require_once( dirname(__FILE__) . '/class-servcomapp-crud-bdd.php' );

// Procedimiento que raliza la insercion de un nuevo coordinador a la base de datos
function insertar_Coordinador() {

  if( strtoupper( $_SERVER['REQUEST_METHOD'] ) === 'POST' && !empty( $_POST ) ) {

    /* Crea una nuevo objeto que realizara todas las operaciones pertinentes a
     * la base de datos.*/
    $bdd = new servcomapp_crud_bdd();

    /* Escapa caracteres especiales de la entrada que haya ingresado el usuario
     * para evitar cualquier inyeccion de SQL y devuelve el valor dentro de
     * comillas individuales.*/
    $nombre = $bdd -> citar_escapar( $_POST['us_nom'] );
    $apellido = $bdd -> citar_escapar( $_POST['us_ape'] );
    $correo = $bdd -> citar_escapar( $_POST['us_corr'] );
    $cedula = $bdd -> citar_escapar( $_POST['us_ced'] );
    $telefono = $bdd -> citar_escapar( $_POST['us_tel'] );
    $apodo = $bdd -> citar_escapar( $_POST['us_apo'] );
    $clave = $bdd -> citar_escapar( $_POST['us_cla'] );
    $facultad = $bdd -> citar_escapar( $_POST['us_fac'] );
    $oficina = $bdd -> citar_escapar( $_POST['us_ofic'] );

    // Coloca el horario actual de caracas
    date_default_timezone_set( 'America/Caracas' );

    /* Inserta en la base de datos el nuevo usuario con todos los parametros
     * necesarios para la consulta. Para mas informacion, consultar la tabla
     * sc_usuarios de la base de datos.
     *
     * Instruccion tipo INSERT
     */
    $resultado_usuario = $bdd -> consultar( "INSERT INTO" . " sc_usuarios ( us_apodo , us_clave ," .
      " us_tipo , us_nombre , us_fechaCreacion ) VALUES (" . $apodo . " , " .
      $clave . " , 'coord' , " . $nombre . " , '" . date("Y-m-d") . "' )"
    );

    /* Busca el id del usuario que sea igual al apodo o nombre de usuario. Esto
     * se lleva a cabo para luego poder insertar una entidad persona a la base
     * de datos. Luego almacena este valor en una variable que sera pasada a la
     * siguiente consulta.
     *
     * Instruccion tipo SELECT
     */
     if ( $resultado_usuario !== false ) {
        $usuario_id = $bdd -> seleccionar( "SELECT us_id FROM sc_usuarios WHERE us_apodo = " . $apodo );
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
       $resultado_persona = $bdd -> consultar( "INSERT INTO" . " sc_personas ( sc_usuarios_us_id , " .
         " pe_cedula , pe_nombre , pe_apellido , pe_correo , pe_telefono ) VALUES ( " .
         $usuario_id[0]['us_id'] . " , " . $cedula . " , " . $nombre . " , " . $apellido . " , " . $correo .
         " , " . $telefono . " )"
       );
     } else {
        echo "false";
        exit();
     }

    /* Busca el id de la facultad que sea igual al nombre de esta pasado
     * por el usuario. Esto se lleva a cabo para poder insertar un nuevo
     * estudiante a la base de datos.
     *
     * Instruccion tipo SELECT
     */
     if ( $resultado_persona !== false ) {
        $facultad_id = $bdd -> seleccionar( "SELECT fa_id FROM sc_facultades WHERE fa_nombre = " . $facultad );
     } else {
        $bdd -> consultar( "DELETE FROM sc_usuarios WHERE us_id = " . $usuario_id[0]['us_id'] );
        echo "false";
        exit();
     }

    /* Inserta en la base de datos el nuevo coordinador con todos los parametros
     * necesarios para la consulta. Para mas informacion, consultar la tabla
     * sc_coordinadores de la base de datos.
     *
     * Instruccion tipo INSERT
     */
     if ( $facultad_id !== false ) {
       $resultado_coordinador = $bdd -> consultar( "INSERT INTO" . " sc_coordinadores ( " .
         "sc_personas_pe_cedula , sc_facultades_fa_id , co_oficina ) VALUES ( " . $cedula . " , " .
         $facultad_id[0]['fa_id'] .  " , " . $oficina . " )"
       );
     } else {
        echo "false";
        exit();
     }

     /* Verifica si la ultima consulta para insertar un estudiante fue exitosa.
      * De no ser asi, elimina los registros creados anteriormente y devuelve
      * una respuesta al servidor de manera inmediata, saliendose del script php.
      */
     if ( $resultado_coordinador === false ) {
       $bdd -> consultar( "DELETE FROM sc_personas WHERE sc_usuarios_us_id = " . $usuario_id[0]['us_id'] );
       $bdd -> consultar( "DELETE FROM sc_usuarios WHERE us_id = " . $usuario_id[0]['us_id'] );
       echo "false";
       exit();
     }

    //Cierra la conexion a la base de datos.
    $bdd -> cerrar_conexion();
  }
}

/* Procedimiento que recupera todos los registros existentes de un coordinador
 * en la base de datos.
 */
function seleccionar_Coordinadores() {

  /* Crea una nuevo objeto que realizara todas las operaciones pertinentes a
   * la base de datos.*/
  $bdd = new servcomapp_crud_bdd();

  /* Realiza una consulta en la base de datos para extraer todos los datos
   * correspondientes a los usuarios tipo coordinador, uniendo varias tablas de
   * la base de datos, pero solo seleccionando ciertas columnas de estas para
   * mostrar en la tabla de coordinadores del area de los usuarios.
   */
  $resultado = $bdd -> seleccionar( "SELECT pe_nombre, pe_apellido, pe_correo," .
    " pe_cedula, pe_telefono, us_apodo, us_clave, fa_nombre, co_oficina " .
    "FROM sc_coordinadores coord " .
    "INNER JOIN sc_personas per " .
    "ON coord.sc_personas_pe_cedula = per.pe_cedula " .
    "INNER JOIN sc_usuarios users " .
    "ON per.sc_usuarios_us_id = users.us_id " .
    "INNER JOIN sc_facultades fac " .
    "ON coord.sc_facultades_fa_id = fac.fa_id"
  );

  /* Luego transforma el resultado de la consulta en un archivo .json y lo
   * devuelve como parte de la respuesta que da el servidor.
   */
  $resultado = json_encode( $resultado );
  echo $resultado;
}

function editar_Coordinadores($id){
     /* La variable $id hace referencia al campo del apodo */
    /* Conexion a la base de datos usando una clase pre-definida. */
    $bdd = new servcomapp_crud_bdd();
    /* Escapando los caracteres para impedir cualquier tipo de inyeccion SQL. */
    $nombre = $bdd -> citar_escapar( $_POST['us_nom'] );
    $apellido = $bdd -> citar_escapar( $_POST['us_ape'] );
    $correo = $bdd -> citar_escapar( $_POST['us_corr'] );
    $cedula = $bdd -> citar_escapar( $_POST['us_ced'] );
    $telefono = $bdd -> citar_escapar( $_POST['us_tel'] );
    $clave = $bdd -> citar_escapar( $_POST['us_cla'] );
    $facultad = $bdd -> citar_escapar( $_POST['us_fac'] );
    $ofi = $bdd -> citar_escapar( $_POST['us_ofic'] );

   /* Variable que almacena el id contable del usuario */
   $usuario_id = $bdd -> seleccionar( "SELECT us_id FROM sc_usuarios WHERE us_apodo = '" . $id  . "'");
    
   // Query para la busqueda de la facultad
   $fa_i = $bdd -> seleccionar( "SELECT fa_id FROM sc_facultades WHERE fa_nombre =" . $facultad );
    
   $facultad_cons = $fa_i[0]['fa_id'];
        
   /* Almacenamiento de valor fijo del select */
   $usuario_id_cons = $usuario_id[0]['us_id'];
    
   /* Query para la cedula vieja */
   $cedula_vieja = $bdd -> seleccionar( "SELECT pe_cedula FROM sc_personas WHERE sc_usuarios_us_id = '" . $usuario_id_cons  . "'");
    
    /* Variable para almacenar la cedula vieja */
    $cedula_id_cons = $cedula_vieja[0]['pe_cedula'];
    
    /* Query que act el nombre y el apodo del usuario a editar */
   $resultado_usuario = $bdd -> consultar( "UPDATE" . " sc_usuarios SET us_nombre=" . $nombre . ", us_clave=" . $clave . " WHERE us_apodo='" . $id .  "'");
    
    /* Query que act los campos en la tabla personas */ 
   $resultado_personas = $bdd -> consultar( "UPDATE" . " sc_personas SET pe_nombre=" . $nombre . ", pe_apellido=" . $apellido . ", pe_correo=" . $correo . ", pe_telefono=" . $telefono . ", pe_cedula=" . $cedula . " WHERE sc_usuarios_us_id='" . $usuario_id_cons . "'");
    
   /* Query que act el nombre y el apodo del usuario a editar */
   $resultado_coordinadores = $bdd -> consultar( "UPDATE" . " sc_coordinadores SET co_oficina=" . $ofi . ", sc_facultades_fa_id=" . $facultad_cons . " WHERE sc_personas_pe_cedula='" . $cedula_id_cons .  "'");
    
        
    //Cierra la conexion a la base de datos.
    $bdd -> cerrar_conexion();

}

/* Verifica que tipo de consulta se envio y ejecuta su caso correspondiente.
 * Aqui deberian ir todas las llamadas a las funciones respectivas de cada tipo
 * de consulta.
 */
switch ( $_POST['tipo_cons'] ) {

  // Insertar
  case 'insertar':
    insertar_Coordinador();
    echo "true";
    break;

  // Seleccionar
  case 'seleccionar':
    seleccionar_Coordinadores();
    break;

  // Editar
  case 'editar':
    # code...
    $id = $_POST['id_busq'];
    editar_Coordinadores($id);
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
