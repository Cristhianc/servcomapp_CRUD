<?php
/**
 * Clase establecida para la conexion a la base de datos y las respectivas
 * consultas.
 *
 * @link
 * @since      1.0.0
 *
 * @package    servcomapp_CRUD
 * @subpackage servcomapp_CRUD/includes
 * @author     cristh2592@gmail.com
 */
 class servcomapp_crud_bdd {

   /**
 	 * La conexion a la base de datos
 	 *
 	 * @since    1.0.0
 	 * @access   protected
 	 * @var    $coneccion    La conexion a la base de datos.
 	 */
   protected static $coneccion;

   /**
     * Metodo que conecta a la base de datos
     *
     * @return bool false al fallar | instancia del objeto mysqli MySQLi object
     *                              |  al tener exito
     */
     public function conectar() {

       //Intenta conectar con la base de datos
       if (!isset(self::$coneccion)) {
         /*Carga la configuracion de la base de dato como un arreglo. Usa la
         ubicacion actual del archivo de configuracion.*/
         $config = parse_ini_file( dirname(__FILE__) . '/config.ini' );
         self::$coneccion = new mysqli('localhost', $config['username'],
          $config['password'], $config['dbname']);
          self::$coneccion -> set_charset('utf8');
       }

       //Si la conexion no fue existosa, maneja el error.
       if (self::$coneccion -> connect_errno) {
         printf("Falló la conexión: %s\n", self::$coneccion -> connect_error);
         exit();
       }
       return self::$coneccion;
     }

     /**
     * Consulta la base de datos
     *
     * @param $query El string que contiene la consulta
     * @return mixed El resultado de la funcion mysqli::query()
     */
     public function consultar($query) {
       //Conecta a la base de datos
       $coneccion = $this -> conectar();

       /*Consulta la base de datos con su respectivo query y almacena el
       resultado en una variable llamada de la misma manera.*/
       $resultado = $coneccion -> query($query);
       return $resultado;
     }
     /**
     * Trae las filas de la base de datos (del tipo SELECT)
     *
     * @param $query El string que contiene la consulta
     * @return bool false al fallar | arreglo de las filas de la base de datos
     *                              | al tener exito
     */
    public function seleccionar($query) {
        $filas = array();
        $resultado = $this -> consultar($query);
        if($result === false) {
            return false;
        }
        while ($fila = $resultado -> fetch_assoc()) {
            $filas[] = $fila;
        }
        return $filas;
    }

    /**
     * Cita y escapa los valores para el uso de las consultas a la base de datos
     *
     * @param string $valor El valor que va a ser citado y escapado
     * @return string El string que ha sido citado y escapado correctamente
     */
    public function citar_escapar($valor) {
        $coneccion = $this -> conectar();
        return "'" . $coneccion -> real_escape_string($valor) . "'";
    }

    /**
     * Cierra la conexion a la base de datos
     *
     * @return bool true al cerrar la conexion
     */
    public function cerrar_conexion() {
      self::$coneccion -> close();
      return true;
    }
 }
