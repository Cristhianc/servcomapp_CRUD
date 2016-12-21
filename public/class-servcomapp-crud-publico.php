<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * La funcionalidad del lado publico del plugin.
 *
 * Define el nombre del plugin, la version y dos ejemplos de hooks para como
 * poner en cola la hoja de estilo y el JavaScript especifico del administrador.
 *
 * @link
 * @since      1.0.0
 *
 * @package    servcomapp_CRUD
 * @subpackage servcomapp_CRUD/public
 * @author     cristh2592@gmail.com
 */
class servcomapp_crud_publico {

	/**
	 * El ID de este plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $nombre_plugin    El ID de este plugin.
	 */
	private $nombre_plugin;

	/**
	 * La version de este plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    La version actual de este plugin.
	 */
	private $version;

	/**
	 * Inicializa la clase y establece sus propiedades.
	 *
	 * @since    1.0.0
	 * @param      string    $nombre_plugin       El nombre del plugin.
	 * @param      string    $version    La version de este plugin.
	 */
	public function __construct( $nombre_plugin, $version ) {

		$this->nombre_plugin = $nombre_plugin;
		$this->version = $version;

	}

	/**
	 * Registra las hojas de estilo para el lado publico del sitio web.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 *
		 * Una instancia de esta clase deberia ser pasada a la funcion run()
		 * definida en el servcomapp_crud_cargador asi como todos los hooks estan
		 * definidos en esa clase particular.
		 *
		 * El servcomapp_crud_cargador creara entonces la relacion entre los hooks
		 * definidos y las funciones definidas en esta clase.
		 */

		wp_enqueue_style( $this->nombre_plugin, plugin_dir_url( __FILE__ ) . 'css/servcomapp-crud-publico.css', array(), $this->version, 'all' );

	}

	/**
	 * Registra el JavaScript para el lado publico del sitio web.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 *
		 * Una instancia de esta clase deberia ser pasada a la funcion run()
		 * definida en el servcomapp_crud_cargador asi como todos los hooks estan
		 * definidos en esa clase particular.
		 *
		 * El servcomapp_crud_cargador creara entonces la relacion entre los hooks
		 * definidos y las funciones definidas en esta clase.
		 */

		wp_enqueue_script( $this->nombre_plugin, plugin_dir_url( __FILE__ ) . 'js/servcomapp-crud-publico.js', array( 'jquery' ), $this->version, false );

	}

}
