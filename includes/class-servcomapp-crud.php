<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * Este es el archivo que define la clase central del plugin
 *
 * Una definicion de clase que incluye los atributos y funciones usadas a lo
 * largo del lado publico y del area de administracion del sitio web.
 *
 * @link
 * @since      1.0.0
 *
 * @package    servcomapp_CRUD
 * @subpackage servcomapp_CRUD/includes
 */

/**
 * La clase central del plugin.
 *
 * Esta es usada para definir la internacionalizacion, hooks especificos de la
 * area de administracion y, hooks que encaran el lado publico del sitio web.
 *
 * Igualmente mantiene el identificador unico de este plugin asi como la version
 * actual del mismo.
 *
 * @since      1.0.0
 * @package    servcomapp_CRUD
 * @subpackage servcomapp_CRUD/includes
 * @author     cristh2592@gmail.com
 */
class servcomapp_crud {

	/**
	 * Aqui se ubica el cargador que es el responsable de mantener y registrar
	 * todos los hooks que impulsan o le dan poder al plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      servcomapp_CRUD_cargador    $loader    Mantiene y registra todos
	 *																								los hooks del plugin.
	 */
	protected $cargador;

	/**
	 * El identificador unico de este plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $nombre_plugin    Este string es utilizado unicamente
	 *																		para identificar este plugin con su
	 *																		su nombre respectivo.
	 */
	protected $nombre_plugin;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    La version actual del plugin.
	 */
	protected $version;

	/**
	 * Define la funcionalidad central del plugin.
	 *
	 * Coloca el nombre del plugin y la version que puede ser usada a lo largo del
	 * plugin. Tambien carga las dependencias, define el lugar, y coloca los hooks
	 * para el area de administracion y el lado publico del sitio web.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->nombre_plugin = 'servcomapp_CRUD';
		$this->version = '1.0.0';

		$this->cargar_dependencias();
		$this->set_lugar();
		$this->definir_hooks_admin();
		$this->definir_hooks_publicos();

	}

	/**
	 * Carga las dependencias requeridas para este plugin.
	 *
	 * Incluye los siguientes archivos que preparan el plugin:
	 *
	 * - servcomapp_CRUD_cargador. Controla los hooks del plugin.
	 * - servcomapp_CRUD_i18n. Define la funcionalidad de internacionalizacion.
	 * - servcomapp_CRUD_Admin. Define todos los hooks del area de administracion.
	 * - servcomapp_CRUD_Publico. Define todos los hooks para el lado publico del
	 *														sitio web.
	 *
	 * Crea una instancia de el cargador, la cual sera usada para registrar localhost
	 * hooks con WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function cargar_dependencias() {

		/**
		 * La clase responsable de controlar las acciones y filtros centrales del
		 * plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes\class-servcomapp-crud-cargador.php';

		/**
		 * La clase responsable de definir la funcionalidad de internacionalizacion
		 * del plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes\class-servcomapp-crud-i18n.php';

		/**
		 * La clase responsable de definir la coneccion a la base de datos y las
		 * consultas respectivas de leer, modificar, mostrar y borrar.
		 */
		/*require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes\class-servcomapp-crud-bdd.php';*/

		/**
		 * La clase responsable de definir todas las acciones que ocurren en la area
		 * de administracion.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin\class-servcomapp-crud-admin.php';

		/**
		 * La clase responsable de definir todas las acciones que ocurran en el lado
		 * publico del sitio web.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public\class-servcomapp-crud-publico.php';

		$this->cargador = new servcomapp_crud_cargador();

	}

	/**
	 * Define el lugar de este plugin para la internacionalizacion.
	 *
	 * Usa la clase servcomapp_crud_i18n para poder colocar el dominio y registrar
	 * el hook con WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_lugar() {

		$plugin_i18n = new servcomapp_crud_i18n();

		$this->cargador->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Registra todos los hooks relacionados a la funcionalidad del area de
	 * de administracion del plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function definir_hooks_admin() {

		$plugin_admin = new servcomapp_crud_admin( $this->get_nombre_plugin(), $this->get_version() );

		$this->cargador->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->cargador->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->cargador->add_action( 'admin_menu', $plugin_admin, 'agregar_menu_lateral_admin' );

	}

	/**
	 * Registra todos los hooks relacionados a la funcionalidad del lado publico
	 * del plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function definir_hooks_publicos() {

		$plugin_publico = new servcomapp_crud_publico( $this->get_nombre_plugin(), $this->get_version() );

		$this->cargador->add_action( 'wp_enqueue_scripts', $plugin_publico, 'enqueue_styles' );
		$this->cargador->add_action( 'wp_enqueue_scripts', $plugin_publico, 'enqueue_scripts' );

	}

	/**
	 * Corre el cargador para ejecutar todos los hooks con WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->cargador->run();
	}

	/**
	 * El nombre del plugin usado para identificarlo de manera unica dentro del
	 * contexto de WordPress y para definir la funcionalidad de internacionalizacion.
	 *
	 * @since     1.0.0
	 * @return    string    El nombre del plugin.
	 */
	public function get_nombre_plugin() {
		return $this->nombre_plugin;
	}

	/**
	 * La referencia a la clase que controla los hooks con el plugin.
	 *
	 * @since     1.0.0
	 * @return    servcomapp_crud_cargador    Controla  los hooks del plugin.
	 */
	public function get_cargador() {
		return $this->cargador;
	}

	/**
	 * Recupera el numero de la version del plugin.
	 *
	 * @since     1.0.0
	 * @return    string    El numero de la version del plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
