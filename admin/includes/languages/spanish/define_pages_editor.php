<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: define_pages_editor.php,v 1.2 2006/01/14 13:32:20 damage_in Exp $
//

define('HEADING_TITLE', 'Definir editor de páginas para: ');
define('NAVBAR_TITLE', 'Definir editor de páginas');

define('TEXT_INFO_EDIT_PAGE', 'Seleccione una página para editar:');

define('TEXT_INFO_MAIN_PAGE', 'Página principal');

define('TEXT_INFO_SHIPPINGINFO', 'Envíos y devoluciones.');
define('TEXT_INFO_PRIVACY', 'Privacidad');
define('TEXT_INFO_CONDITIONS', 'Condiciones de uso');
define('TEXT_INFO_CONTACT_US', 'Contacte con nosotros');
define('TEXT_INFO_CHECKOUT_SUCCESS', 'Orden con éxito');

define('TEXT_INFO_PAGE_2', 'Página 2');
define('TEXT_INFO_PAGE_3', 'Página 3');
define('TEXT_INFO_PAGE_4', 'Página 4');
  define('TEXT_INFO_PAGE_5', 'Página 5');
  define('TEXT_INFO_PAGE_6', 'Página 6');
  define('TEXT_INFO_PAGE_7', 'Página 7');
  define('TEXT_INFO_PAGE_8', 'Página 8');
  define('TEXT_INFO_PAGE_9', 'Página 9');
  define('TEXT_INFO_PAGE_10', 'Página 10');
  define('TEXT_INFO_PAGE_11', 'Página 11');
define('TEXT_FILE_DOES_NOT_EXIST', 'No existe el archivo: %s');

define('ERROR_FILE_NOT_WRITEABLE', 'Error: No puede escribirse este archivo. Por favor, seleccione el permiso de usuario correcto en: %s');

define('TEXT_INFO_SELECT_FILE', 'Seleccione un archivo a editar ...');
define('TEXT_INFO_EDITING', 'Editando archivo:');

define('TEXT_INFO_CAUTION','Nota: Debe editar siempre los archivos localizados en el directorio de su plantilla actual. Ejemplo: /languages/' . $_SESSION['language'] . '/html_includes/' . $template_dir . '<br />Asegúrese de hacer copias de seguridad antes de modificar sus archivos.');
?>