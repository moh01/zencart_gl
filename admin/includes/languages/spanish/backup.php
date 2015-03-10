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
//  $Id: backup.php,v 1.2 2006/01/14 13:32:20 damage_in Exp $
//

define('HEADING_TITLE', 'Gestor de Copias de Seguridad de la base de datos');

define('TABLE_HEADING_TITLE', 'Título');
define('TABLE_HEADING_FILE_DATE', 'Fecha');
define('TABLE_HEADING_FILE_SIZE', 'Tamaño');
define('TABLE_HEADING_ACTION', 'Acción');

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Nueva copia de seguridad');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Restaurar local');
define('TEXT_INFO_NEW_BACKUP', 'No interrumpa el proceso de la copia de seguridad, puede tardar algunos minutos.');
define('TEXT_INFO_UNPACK', '<br><br>(Luego descomprima el archivo comprimido)');
define('TEXT_INFO_RESTORE', 'No interrumpa el preceso de restauración.<br><br>¡Cuanto más grande es la copia de seguridad, más tiempo tardará este proceso!<br><br>Si es posible, use el cliente mysql.<br><br>Por ejemplo:<br><br><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', 'No interrumpa el proceso de restauración.<br><br>¡Cuanto más grande es la copia de seguridad, más tiempo tardará este proceso!');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'El fichero subido debe ser un ser un fichero sql en bruto (texto).');
define('TEXT_INFO_DATE', 'Fecha:');
define('TEXT_INFO_SIZE', 'Tamaño:');
define('TEXT_INFO_COMPRESSION', 'Compresión:');
define('TEXT_INFO_USE_GZIP', 'Usar GZIP');
define('TEXT_INFO_USE_ZIP', 'Usar ZIP');
define('TEXT_INFO_USE_NO_COMPRESSION', 'Sin compresión (SQL Puro)');
define('TEXT_INFO_DOWNLOAD_ONLY', 'Descargar solamente (no lo almacena en el servidor)');
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'Mejor a través de una conexión HTTPS');
define('TEXT_DELETE_INTRO', '¿Seguro que desea eliminar esta copia de seguridad?');
define('TEXT_NO_EXTENSION', 'Ninguna');
define('TEXT_BACKUP_DIRECTORY', 'Directorio para las copias de seguridad:');
define('TEXT_LAST_RESTORATION', 'Última restauración:');
define('TEXT_FORGET', '(olvidar)');

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Error: El directorio para las copias de seguridad no existe. Por favor, configure esto en  configure.php.');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Error: No se puede escribir en el directorio para las copias de seguridad.');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Error: la dirección de descarga no es valida.');

define('SUCCESS_LAST_RESTORE_CLEARED', 'Listo: La última restauración ha finalizado correctamente.');
define('SUCCESS_DATABASE_SAVED', 'Listo: La base de datos ha sido guardada satisfactoriamente.');
define('SUCCESS_DATABASE_RESTORED', 'Listo: La base de datos ha sido restaurada satisfactoriamente.');
define('SUCCESS_BACKUP_DELETED', 'Listo: La copia de seguridad ha sido eliminada correctamente.');
?>
