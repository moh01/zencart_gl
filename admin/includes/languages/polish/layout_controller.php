<?php
/**
 *
 * @version $Id: layout_controller.php, v 1.3.7 2007/04/26 11:48:12 $;
 *
 * @author Zen Cart Development Team
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 *
 * Modyfikacje do ZenCart.pl
 * @author Grupa ZenCart.pl <kontakt@zencart.pl>
 * @copyright Copyright &copy; 2007, ZenCart.pl
 * Wi�cej informacji na stronie projektu {@link http://www.zencart.pl ZenCart.pl} Zajrzyj!
 *
 *
 * @package admin
 *
 */

define( 'SUCCESS_BOX_ADDED', 'Pomy�lnie dodano boxa: ' );
define( 'SUCCESS_BOX_UPDATED', 'Pomy�lnie zaktualizowano ustawienia boxa: ' );
define( 'SUCCESS_BOX_DELETED', 'Pomy�lnie usuni�to z szablonu box: ' );
define( 'SUCCESS_BOX_RESET', 'Poprawnie przywr�cono wszystkie domy�lne ustawienia dla box�w zgodnie z ustawieniami szablonu: ' );

define( 'HEADING_TITLE', 'Boxy' );
define( 'TABLE_HEADING_LAYOUT_BOX_NAME', 'Nazwa boxa' );
define( 'TABLE_HEADING_LAYOUT_BOX_STATUS', 'LEWA/PRAWA KOLUMNA<br />Status' );
define( 'TABLE_HEADING_LAYOUT_BOX_LOCATION', 'LEWA/PRAWA<br />KOLUMNA' );
define( 'TABLE_HEADING_LAYOUT_BOX_SORT_ORDER', 'LEWA/PRAWA KOLUMNA<br />Sortowanie' );
define( 'TABLE_HEADING_LAYOUT_BOX_SORT_ORDER_SINGLE', 'POJEDYNCZA KOLUMNA<br />Sortowanie');
define( 'TABLE_HEADING_LAYOUT_BOX_STATUS_SINGLE', 'POJEDYNCZA KOLUMNA<br />Status' );
define( 'TABLE_HEADING_ACTION', 'Akcja' );
define( 'TEXT_ON', ' W� ' );
define( 'TEXT_OFF', ' WY� ' );
define( 'TEXT_LEFT', ' LEWA ' );
define( 'TEXT_RIGHT', ' PRAWA ' );
define( 'TEXT_GOOD_BOX', '' );
define( 'TEXT_BAD_BOX', '<span class="czerwony"><strong>POMINI�TO</strong></span>' );

define( 'TEXT_INFO_HEADING_NEW_BOX', 'Nowy box' );
define( 'TEXT_INFO_INSERT_INTRO', 'Wprowad� dane nowego boxu' );
define( 'TEXT_INFO_LAYOUT_BOX_NAME', 'Nazwa boxa:' );
define( 'TEXT_INFO_LAYOUT_BOX_STATUS', 'Lewa/Prawa kolumna status: ' );
define( 'TEXT_INFO_LAYOUT_BOX_LOCATION', 'Lewa/Prawa kolumna:<br />(Te ustawienia nie dotycz� pojedynczej kolumny)' );
define( 'TEXT_INFO_LAYOUT_BOX_SORT_ORDER', 'Lewa/Prawa kolumna sortowanie: ' );
define( 'TEXT_INFO_LAYOUT_BOX_SORT_ORDER_SINGLE', 'Pojedyncza kolumna sortowanie: ' );
define( 'TEXT_INFO_LAYOUT_BOX_STATUS_SINGLE', 'Pojedyncza kolumna status: ' );

define( 'TEXT_INFO_HEADING_EDIT_BOX', 'Edycja boxa' );
define( 'TEXT_INFO_EDIT_INTRO', 'Wprowad� zmiany' );

define( 'TEXT_INFO_HEADING_DELETE_BOX', 'Usuwanie boxa' );
define( 'TEXT_INFO_DELETE_INTRO', 'Czy usun�� ten box?' );

define( 'TEXT_INFO_LAYOUT_BOX', 'Wybrany box: ' );
define( 'TEXT_INFO_BOX_DETAILS', 'Szczeg�y boxa: ' );
define( 'TEXT_INFO_DELETE_MISSING_LAYOUT_BOX', 'Usu� brakuj�cy box z listy: ' );
define( 'TEXT_INFO_DELETE_MISSING_LAYOUT_BOX_NOTE', 'UWAGA: Opcja ta nie usuwa pliku wi�c b�dzie mo�na p�niej doda� tego boxa.<br /><br /><strong>Nazwa usuwanego boxa: </strong>' );

define( 'TEXT_INFO_RESET_TEMPLATE_SORT_ORDER', 'Przywr�� sortowanie box�w zgodnie z DOMY�LNYM sortowaniem dla szablonu: ' );
define( 'TEXT_INFO_RESET_TEMPLATE_SORT_ORDER_NOTE', 'Opcja ta nie usuwa �adnego boxu. Przywraca tylko domy�lne sortowanie' );

define( 'TEXT_MODULE_DIRECTORY', 'Katalog modu��w: ' );
define('TEXT_MODULE_DIRECTORY', 'Katalog szablonu:');
define( 'TEXT_INFO_DATE_ADDED', 'Data dodania:' );
define( 'TEXT_INFO_LAST_MODIFIED', 'Ostatnia modyfikacja:' );

/**/
define('TEXT_INFO_LAYOUT_BOX_STATUS_INFO','ON= 1 OFF=0');
define('HEADING_TITLE_LAYOUT_TEMPLATE', 'Szablon');
define('TABLE_HEADING_LAYOUT_TITLE', 'Tytu�');
define('TABLE_HEADING_LAYOUT_VALUE', 'Warto��');

// layout box text in includes/boxes/layout.php
define('BOX_HEADING_LAYOUT', 'Szablon');
define('BOX_LAYOUT_COLUMNS', 'Zarz�dzanie kolumnami');

?>