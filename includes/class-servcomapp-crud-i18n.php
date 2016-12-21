<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * Define la funcionalidad de internacionalizacion.
 *
 * Carga y define los archivos de internacionalizacion para este plugin para que
 * asi esten listos para traduccion.
 *
 * @since      1.0.0
 * @package    servcomapp_CRUD
 * @subpackage servcomapp_CRUD/includes
 * @author     cristh2592@gmail.com
 */
class servcomapp_crud_i18n {


	/**
	 * Carga el dominio de texto del plugin para la traduccion.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'plugin-name',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
