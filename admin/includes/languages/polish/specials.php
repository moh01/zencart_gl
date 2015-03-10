<?php
/**
 *
 * @version $Id: specials.php, v 1.3.7 2007/04/26 11:48:12 $;
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

/* Patrz funkcje wgrywane przez init_general_funcs.php */
define( 'TEXT_IMAGE_NONEXISTENT', 'BRAK OBRAZKA' );

/* product price manager */
define( 'TEXT_SPECIALS_SPECIAL_PRICE', 'Cena promocyjna: ' );
define( 'TEXT_SPECIALS_AVAILABLE_DATE', 'Data dost�pno�ci promocji: ' );
define( 'TEXT_SPECIALS_EXPIRES_DATE', 'Data wa�no�ci promocji: ' );
define( 'TEXT_SPECIALS_PRICE_TIP', '<strong>Informacje o promocjach:</strong><ul><li>Mo�esz poda� procentow� obni�k� ceny np: <strong>20%</strong></li><li>Mo�esz poda� now� cen�, separator decymalny to \'.\' np: <strong>49.99</strong></li><li>Pozostaw pole Data wa�no�ci promocji puste je�eli promocja ma obowi�zywa� ca�y czas</li></ul>' );

/* wlasne */
define( 'WARNING_SPECIALS_PRE_ADD_EMPTY', 'Ostrze�enie: Nie wybrano �adnego produktu ... nie dokonano �adnych zmian ...' );
define( 'WARNING_SPECIALS_PRE_ADD_BAD_PRODUCTS_ID', 'Ostrze�enie: B��dny produkt ... nie dokonano �adnych zmian ...' );
define( 'WARNING_SPECIALS_PRE_ADD_DUPLICATE', 'Ostrze�enie: Ten produkt jest ju� w promocjach ... nie dokonano �adnych zmian ...' );
define( 'SUCCESS_SPECIALS_PRE_ADD', 'Pomy�lnie dodano produkt promocyjny ... prosz� zaktualizowa� ceny i daty ...' );

define( 'HEADING_TITLE', 'Promocje' );
define( 'TEXT_SPECIALS_PRODUCT', 'Produkt w promocji: ' );

define( 'TABLE_HEADING_PRODUCTS', 'Produkt' );
define( 'TABLE_HEADING_PRODUCTS_MODEL', 'Model' );
define( 'TABLE_HEADING_PRODUCTS_PRICE', 'Cena/Promocja/Obni�ka' );
define( 'TABLE_HEADING_AVAILABLE_DATE', 'Dost�pny' );
define( 'TABLE_HEADING_EXPIRES_DATE', 'Wa�no��' );
define( 'TABLE_HEADING_STATUS', 'Status' );
define( 'TABLE_HEADING_ACTION', 'Akcja' );

define( 'TEXT_INFO_HEADING_DELETE_SPECIALS', 'Usuwanie promocji' );
define( 'TEXT_INFO_DELETE_INTRO', 'Czy na pewno chcesz usun�� informacje o promocji dla tego produktu?' );

define( 'TEXT_INFO_HEADING_PRE_ADD_SPECIALS', 'Manualne dodawanie promocji' );
define( 'TEXT_INFO_PRE_ADD_INTRO', 'Przy du�ej bazie danych, mo�esz manualnie doda� produkt do promocji poprzez wpisanie jego numeru ID<br /><br />Jest to dobry spos�b, przy du�ej bazie danych, poniewa� nie trzeba tworzy� pola select z du�� ilo�ci� produkt�w.' );
define( 'TEXT_PRE_ADD_PRODUCTS_ID', 'Wpisz numer ID produktu: ' );

define( 'TEXT_INFO_DATE_ADDED', 'Data dodania:' );
define( 'TEXT_INFO_LAST_MODIFIED', 'Ostatnia modyfikacja:' );
define( 'TEXT_INFO_ORIGINAL_PRICE', 'Oryginalna cena: ' );
define( 'TEXT_INFO_NEW_PRICE', 'Nowa cena: ' );
define( 'TEXT_INFO_DISPLAY_PRICE', 'Wy�wietlanie ceny: ' );
define( 'TEXT_INFO_AVAILABLE_DATE', 'Obowi�zuje od: ' );
define( 'TEXT_INFO_EXPIRES_DATE', 'Obowi�zuje do: ' );
define( 'TEXT_INFO_STATUS_CHANGE', 'Zmiana statusu: ' );
define( 'TEXT_INFO_MANUAL', 'Dodanie produktu poprzez jego ID' );

/**/
define( 'TABLE_HEADING_PRODUCTS_PERCENTAGE', 'Procentowo' );

?>