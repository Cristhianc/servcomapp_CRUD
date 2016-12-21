<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * Este es el archivo de arranque del Plugin
 *
 * Este archivo es leido por WordPress para generar la informacion del plugin en
 * la area de administracion del plugin. Este archivo tambien incluye todas las
 * dependencias usadas por el plugin, registra las funciones de activacion y
 * desactivacion, y define una funcion que inicia el plugin.
 *
 * @link							https://github.com/Cristhianc/servcomapp_CRUD
 * @since             1.0.0
 * @package           servcomapp CRUD
 *
 * @wordpress-plugin
 * Plugin Name:       servcomapp CRUD
 * Plugin URI:        https://github.com/Cristhianc/servcomapp_CRUD
 * Description:       Plugin que maneja la data del sistema de informacion
 * Version:           1.0.0
 * Author:            Cristhian Caicedo
 * Author URI:        #
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:
 * Domain Path:       /languages
 */

// Si este archivo es llamado directamente, abortar por seguridad.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Cabe destacar que como el plugin esta siendo colocado dentro de la carpeta
 * "mu-plugins", el script activador, desactivador y desinstalador no seran
 * leidos por WordPress debido a que estos plugins son colocados para que no
 * sean alterados por ningun usuario, sino que son permanentes y sumamente
 * importantes para el sistema de informacion. Debe estar siempre activo y no
 * puede ser desinstalado sino manualmente. No obstante, se deja el codigo
 * necesario por si se desea trabajar de la otra manera, es decir, colocando
 * el plugin en la carpeta "plugins" para ser manejado por los usuarios del
 * escritorio de WordPress.
 *
 * El codigo que corre durante la activacion del Plugin.
 * Esta accion es documentada en includes/class-activador-nombre-plugin.php
 */

/*
function activar_nombre_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-nombre-plugin-activador.php';
	servcomapp_crud_activador::activar();
}
*/

/**
 * El codigo que corre durante la desactivacion del Plugin.
 * Esta accion es documentada en includes/class-plugin-name-deactivator.php
 */

/*
function desactivar_nombre_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-nombre-plugin-desactivador.php';
	servcomapp_crud_desactivador::desactivar();
}

register_activation_hook( __FILE__, 'activar_nombre_plugin' );
register_deactivation_hook( __FILE__, 'desactivar_nombre_plugin' );
*/

/**
 * La clase central del plugin que es usada para definir internacionalizacion,
 * hooks especificos del administrador,y hooks de la pagina web orientados al
 * publico.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-servcomapp-crud.php';

/**
 * Comienza la ejecucon del plugin.
 *
 * Dado que todo dentro del plugin es registrado mediante hooks,
 * entonces arrancar el plugin desde este punto en el archivo no afecta el ciclo
 * de vida de la pagina.
 *
 * @since    1.0.0
 */
function run_nombre_plugin() {

	$plugin = new servcomapp_crud();
	$plugin->run();
}
run_nombre_plugin();
?>
