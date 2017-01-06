<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * La funcionalidad especifica del administrador del plugin.
 *
 * Define el nombre del plugin, la version y dos ejemplares de hooks para como
 * poner en cola la hoja de estilo y el JavaScript especifico del administrador.
 * @link
 * @since      1.0.0
 *
 * @package    servcomapp_CRUD
 * @subpackage servcomapp_CRUD/admin
 * @author     cristh2592@gmail.com
 */
class servcomapp_crud_admin {

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
	 * @param      string    $nombre_plugin       El nombre de este plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $nombre_plugin, $version ) {

		$this->nombre_plugin = $nombre_plugin;
		$this->version = $version;

	}

	/**
	 * Registra las hojas de estilo del area de administracion.
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

		wp_enqueue_style( 'servcomapp-crud-admin',
			plugin_dir_url( __FILE__ ) . 'css/servcomapp-crud-admin.css'
		);

		wp_enqueue_style( 'bootstrap',
			plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css',
			array(),
			'3.3.7',
			'all' );
	}

	/**
	 * Registra el JavaScript definido para el area de administracion.
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
	 	wp_enqueue_script( 'jquery-3.1.1',
			plugin_dir_url( __FILE__ ) . 'js/jquery-3.1.1.js',
			array(),
			'3.1.1',
			true
		);
		wp_enqueue_script( 'servcomapp-areaUsuarios',
			plugin_dir_url( __FILE__ ) . 'js/areaUsuarios.js',
			array('jquery'),
			$this->version,
			true
		);
		wp_enqueue_script( 'servcomapp-cargarEventos',
 			plugin_dir_url( __FILE__ ) . 'js/cargarEventos.js',
 			array('jquery'),
 			$this->version,
 			true
 		);
		wp_enqueue_script( 'bootstrap',
			plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js',
			array(),
			'3.3.7',
			true
		);
	}



	public function agregar_menu_lateral_admin() {
		add_menu_page('Aplicacion de manejo del CRUD del sistema de informacion',
			'servcomapp CRUD',
			'manage_options',
			$this->nombre_plugin,
			array($this, 'display_plugin_setup_page')
		);
	}

	public function display_plugin_setup_page() {
		include_once( 'partials/servcomapp-crud-admin-exhibir.php' );
	}
}
