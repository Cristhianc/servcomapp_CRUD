<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * Registra todas las acciones y filtros para el plugin.
 *
 * Mantiene una lista de todos los hooks que estan registrados a lo largo del
 * plugin, y los registra con el API de WordPress. Llama a la funcion run para
 * que ejecute la lista de acciones y filtros.
 *
 * @package    servcomapp_CRUD
 * @subpackage servcomapp_CRUD/includes
 * @author     cristh2592@gmail.com
 */
class servcomapp_CRUD_cargador {

	/**
	 * El arreglo de acciones registradas con WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $acciones    The actions registered with WordPress to fire when the plugin loads.
	 */
	protected $acciones;

	/**
	 * El arreglo de filtros registrados con WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $filtros    The filters registered with WordPress to fire when the plugin loads.
	 */
	protected $filtros;

	/**
	 * Inicializa las colecciones usadas para mantener las acciones y filtros.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->acciones = array();
		$this->filtros = array();

	}

	/**
	 * Añade una nueva accion a la coleccion para ser registrada con WordPress.
	 *
	 * @since    1.0.0
	 * @param    string               $hook             El nombre de la accion de WordPress que esta siendo registrada.
	 * @param    object               $component        Una referencia a la instancia del objeto en el cual la accion es definida.
	 * @param    string               $callback         El nombre de la funcion definida en la variable $component.
	 * @param    int                  $priority         Opcional. La prioridad en la cual la funcion deberia ser ejecutada.
	 *																									El valor predefinido es 10.
	 * @param    int                  $accepted_args    Opcional. El numero de argumento que deberian ser pasados a la retrollamada
	 *																									"$callback". El valor predefinido es 1, el cual puede ser vacio.
	 */
	public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->acciones = $this->add( $this->acciones, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * Añade un nuevo filtro a la coleccion a ser registrada con WordPress.
	 *
	 * @since    1.0.0
	 * @param    string               $hook             El nombre del filtro de WordPress que esta siendo registrado.
	 * @param    object               $component        Una referencia a la instancia del objeto en el cual el filtro es definido.
	 * @param    string               $callback         El nombre de la funcion definida en la variable $component.
	 * @param    int                  $priority         Opcional. La prioridad en la cual la funcion deberia ser ejecutada.
	 *																									El valor predefinido es 10.
	 * @param    int                  $accepted_args    Opcional. El numero de argumento que deberian ser pasados a la retrollamada
	 *																									"$callback". El valor predefinido es 1, el cual puede ser vacio.
	 */
	public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->filtros = $this->add( $this->filtros, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * Una funcion de utilidad que es usada para registrar las acciones y hooks
	 * dentro de una unica coleccion.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param    array                $hooks            La coleccion de hooks que esta siendo registrada (esto es, acciones y filtros).
	 * @param    string               $hook             El nombre del filtro de WordPress que esta siendo registrado.
	 * @param    object               $component        Una referencia a la instancia del objeto en el cual el filtro es definido.
	 * @param    string               $callback         El nombre de la funcion definida en la variable $component.
	 * @param    int                  $priority         La prioridad a la cual la funcion deberia ser ejecutada.
	 * @param    int                  $accepted_args    EL numero de argumentos que deberian ser pasados al parametro $callback.
	 * @return   array                                  La coleccion de acciones y filtros registrados con WordPress.
	 */
	private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {

		$hooks[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args
		);

		return $hooks;

	}

	/**
	 * Registra los filtros y las acciones con WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		foreach ( $this->filtros as $hook ) {
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

		foreach ( $this->acciones as $hook ) {
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

	}

}
