<?php
/* Solicita la clase que maneja todas las operaciones generales de la base de
 * datos. */
require_once( dirname(__FILE__) . '/class-servcomapp-crud-bdd.php' );

function insertar_Coordinador() {

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
    $facultad = $bdd -> citar_escapar($_POST['us_fac']);
    $oficina = $bdd -> citar_escapar($_POST['us_ofic']);

    /* Inserta en la base de datos el nuevo usuario con todos los parametros
     * necesarios para la consulta. Para mas informacion, consultar la tabla
     * sc_usuarios de la base de datos.
     *
     * Instruccion tipo INSERT
     */
    $resultado = $bdd -> consultar("INSERT INTO" . " sc_usuarios ( us_apodo , us_clave ," .
      " us_tipo , us_nombre , us_fechaCreacion ) VALUES (" . $nombre . " , " .
      $clave . " , 'estudiante' , " . $nombre . " , '" . date("Y-m-d") . "' )");

    /* Busca el id del usuario que sea igual al apodo o nombre de usuario. Esto
     * se lleva a cabo para luego poder insertar una entidad persona a la base
     * de datos. Luego almacena este valor en una variable que sera pasada a la
     * siguiente consulta.
     *
     * Instruccion tipo SELECT
     */
    $usuario_id = $bdd -> consultar("SELECT us_id FROM sc_usuarios WHERE us_apodo = " . $apodo);

    /* Inserta en la base de datos la nueva persona con todos los parametros
     * necesarios para la consulta. Para mas informacion, consultar la tabla
     * sc_personas de la base de datos.
     *
     * Instruccion tipo INSERT
     */
    $resultado = $bdd -> consultar("INSERT INTO" . " sc_personas ( sc_usuarios_us_id , " .
      " pe_cedula , pe_nombre , pe_apellido , pe_correo , pe_telefono ) VALUES ( " .
      . $usuario_id . " , " . $cedula . " , " . $nombre . " , " . $apellido . " , " . $correo .
      " , " . $telefono . " )");

    /* Busca el id de la facultad que sea igual al nombre de esta pasado
     * por el usuario. Esto se lleva a cabo para poder insertar un nuevo
     * estudiante a la base de datos.
     *
     * Instruccion tipo SELECT
     */
    $carrera_id = $bdd -> consultar("SELECT fa_id FROM sc_facultades WHERE fa_nombre = " . $facultad);

    /* Inserta en la base de datos el nuevo coordinador con todos los parametros
     * necesarios para la consulta. Para mas informacion, consultar la tabla
     * sc_coordinadores de la base de datos.
     *
     * Instruccion tipo INSERT
     */
    $resultado = $bdd -> consultar("INSERT INTO" . " sc_coordinadores ( " .
      "sc_personas_pe_cedula , sc_facultades_fa_id , co_oficina ) VALUES ( " . $cedula . " , " .
      $facultad_id .  " , " . $oficina . " )");

    //Cierra la conexion a la base de datos.
    $bdd -> cerrar_conexion();
  }
}

insertar_Coordinador();
