<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
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
// $Id:easypopulate.php,v2.75a-Zen-Cart 1.2 12/13/2004 01:20:27 ecdiscounts $
//

define('HEADING_TITLE', 'Easy Populate configuración');
define('EASY_VERSION_A', 'Easy Populate avanzado');
define('EASY_VERSION_B', 'Easy Populate básico ');
define('EASY_DEFAULT_LANGUAGE', '  -  Lenguaje por defecto ');
define('EASY_UPLOAD_FILE', 'Fichero subido. ');
define('EASY_UPLOAD_TEMP', 'Fichero temporal: ');
define('EASY_UPLOAD_USER_FILE', 'User filename: ');
define('EASY_SIZE', 'Tamaño: ');
define('EASY_FILENAME', 'Nombre de fichero: ');
define('EASY_SPLIT_DOWN', 'You can download your split files your Store Root Directory under /temp/');
define('EASY_UPLOAD_EP_FILE', 'Subir fichero EP para importar');
define('EASY_SPLIT_EP_FILE', 'Upload and Split a EP File');

define('TEXT_IMPORT_TEMP', 'Importar datos desde un fichero en la carpeta %s');
define('TEXT_INSERT_INTO_DB', 'Insertar en la base de datos');
define('TEXT_SELECT_ONE', 'Select a EP File for Import');
define('TEXT_SPLIT_FILE', 'Select a EP File');
define('EASY_LABEL_CREATE', 'Create an export files');
define('EASY_LABEL_CREATE_SELECT', 'Selecciona la forma en la que quieres guardar el fichero exportado');
define('EASY_LABEL_CREATE_SAVE', 'Guardar en un fichero temporal en el servidor');
define('EASY_LABEL_SELECT_DOWN', 'Selecciona los campos a guardar');
define('EASY_LABEL_SORT', 'Selecciona un campo para ordenar los datos');
define('EASY_LABEL_PRODUCT_RANGE', 'Limit by Products_ID(s)');
define('EASY_LABEL_LIMIT_CAT', 'Limit By Category');
define('EASY_LABEL_LIMIT_MAN', 'Limit By Manufacture');

define('EASY_LABEL_PRODUCT_AVAIL', 'Rango disponible: ');
define('EASY_LABEL_PRODUCT_TO', ' hasta ');
define('EASY_LABEL_PRODUCT_RECORDS', '    Número total de registros: ');
define('EASY_LABEL_PRODUCT_BEGIN', 'comienzo: ');
define('EASY_LABEL_PRODUCT_END', 'fin: ');
define('EASY_LABEL_PRODUCT_START', 'Comenzar la creación del fichero ');

define('EASY_FILE_LOCATE', 'You can get your file in your Store Root Directory under ');
define('EASY_FILE_LOCATE_2', ' by clicking this Link and going to the file manager');
define('EASY_FILE_RETURN', ' You can return to EP by clicking this link.');
define('EASY_IMPORT_TEMP_DIR', 'Importar desde la carpeta temporal ');
define('EASY_LABEL_DOWNLOAD', 'Download');
define('EASY_LABEL_COMPLETE', 'Completo');
define('EASY_LABEL_TAB', 'tab-delimited .txt file to edit');
define('EASY_LABEL_MPQ', 'Modelo/Precio/Cantidad');
define('EASY_LABEL_EP_MC', 'Modelo/Categoría');
define('EASY_LABEL_EP_FROGGLE', 'Froogle');
define('EASY_LABEL_EP_ATTRIB', 'Attributes');
define('EASY_LABEL_NONE', 'Ninguno');
define('EASY_LABEL_CATEGORY', '1st Category Name');
define('PULL_DOWN_MANUFACTURES', 'Fabricantes');
define('EASY_LABEL_PRODUCT', 'Product ID Number');
define('EASY_LABEL_MANUFACTURE', 'Manufacture ID Number');
define('EASY_LABEL_EP_FROGGLE_HEADER', 'Download a EP or Froogle file');
define('EASY_LABEL_EP_MA', 'Model/Attributes');
define('EASY_LABEL_EP_FR_TITLE', 'Create EP or Froogle Files in Temp Dir ');
define('EASY_LABEL_EP_DOWN_TAB', 'Create <b>Complete</b> tab-delimited .txt file in temp dir');
define('EASY_LABEL_EP_DOWN_MPQ', 'Create <b>Model/Price/Qty</b> tab-delimited .txt file in temp dir');
define('EASY_LABEL_EP_DOWN_MC', 'Create <b>Model/Category</b> tab-delimited .txt file in temp dir');
define('EASY_LABEL_EP_DOWN_MA', 'Create <b>Model/Attributes</b> tab-delimited .txt file in temp dir');
define('EASY_LABEL_EP_DOWN_FROOGLE', 'Create <b>Froogle</b> tab-delimited .txt file in temp dir');

define('EASY_LABEL_NEW_PRODUCT', '!New Product!</font><br>');
define('EASY_LABEL_UPDATED', "<font color='black'> Updated</font><br>");
define('EASY_LABEL_DELETE_STATUS_1', "<font color='red'> !! Deleting product ");
define('EASY_LABEL_DELETE_STATUS_2', " from the database !!</font><br>");
define('EASY_LABEL_LINE_COUNT_1', 'Added ');
define('EASY_LABEL_LINE_COUNT_2', 'records and closing file... ');
define('EASY_LABEL_FILE_COUNT_1A', 'Creating file EPA_Split ');
define('EASY_LABEL_FILE_COUNT_1B', 'Creating file EPB_Split ');
define('EASY_LABEL_FILE_COUNT_2', '.txt ...  ');
define('EASY_LABEL_FILE_CLOSE_1', 'Added ');
define('EASY_LABEL_FILE_CLOSE_2', ' records and closing file...');
//errormessages
define('EASY_ERROR_1', 'Strange but there is no default language to work... That may not happen, just in case... ');
define('EASY_ERROR_2', '... ERROR! - Demasiados caracteres en el campo "modelo".<br>
			25 is the maximum on a standard Zen-Cart install.<br>
			Your maximum product_model length is set to ');
define('EASY_ERROR_2A', ' <br>You can either shorten your model numbers or increase the size of the field in the database.</font>');
define('EASY_ERROR_2B',  "<font color='red'>");
define('EASY_ERROR_3', '<p class=smallText>No products_id field in record. This line was not imported <br><br>');
define('EASY_ERROR_4', '<font color=red>ERROR - v_customer_group_id and v_customer_price must occur in pairs</font>');
define('EASY_ERROR_5', '</b><font color=red>ERROR - You are trying to use a file created with EP Advance, please try with Easy Populate Advance </font>');
define('EASY_ERROR_5a', '<font color=red><b><u>  Click here to return to Easy Populate Basic </u></b></font>');
define('EASY_ERROR_6', '</b><font color=red>ERROR - You are trying to use a file created with EP Basic, please try with Easy Populate basic </font>');
define('EASY_ERROR_6a', '<font color=red><b><u>  Click here to return to Easy Populate Advance </u></b></font>');

?>
