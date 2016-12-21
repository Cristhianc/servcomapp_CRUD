<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * Se ejecuta cuando el plugin es desinstalado.
 *
 * Cuando se vaya a añadir contenido a este archivo, considerar el siguiente
 * flujo de control:
 *
 * - Este metodo deberia ser estatico
 * - Chequear si el contenido de $_REQUEST hace referencia al nombre del plugin
 * - Ejecute un chequeo de referencia de administrador para estar seguro de que
 *   pasa por el proceso de autentificacion
 * - Verifique que la salida de $_GET tenga sentido
 * - Repita con otros roles de usuarios. Lo mejor es que se haga directamente
 *   usando los parametros de cadenas de caracteres de links/query.
 * - Repita cosas para el multisitio. Una vez para un unico sitio web en la red,
 *   una vez a nivel de sitio web.
 *
 * Esta version podria ser actualizada en la version futura del Boilerplate.Sin
 * embargo, este es el esqueleto general y guia para describir como el archivo
 * deberia trabajar.
 *
 * Para mas informacion acerca de esto, vea la siguiente discusion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    servcomapp CRUD
 */

// Si la desinstalacion no fue llamada desde WordPress, entonces se sale.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
