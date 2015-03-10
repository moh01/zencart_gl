<?php
/**
 *
 * @version $Id: featured.php, v 1.3.7 2007/04/26 11:48:12 $;
 *
 * @author Zen Cart Development Team
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 *
 * Modyfikacje do ZenCart.pl
 * @author Grupa ZenCart.pl <kontakt@zencart.pl>
 * @copyright Copyright &copy; 2007, ZenCart.pl
 * Wiêcej informacji na stronie projektu {@link http://www.zencart.pl ZenCart.pl} Zajrzyj!
 *
 *
 * @package admin
 *
 */
/* Patrz funkcje wgrywane przez init_general_funcs.php */
define( 'TEXT_IMAGE_NONEXISTENT', 'BRAK OBRAZKA' );

/* product price manager */
define( 'TEXT_FEATURED_AVAILABLE_DATE', 'Dostêpny od: ' );
define( 'TEXT_FEATURED_EXPIRES_DATE', 'Wa¿ny do: ' );

/* specials */
define( 'TABLE_HEADING_PRODUCTS_PRICE', 'Cena/Promocja/Obni¿ka' );
define( 'TEXT_INFO_ORIGINAL_PRICE', 'Oryginalna cena: ' );
define( 'TEXT_INFO_NEW_PRICE', 'Nowa cena: ' );

/* wlasne */
define( 'WARNING_FEATURED_PRE_ADD_EMPTY', 'Ostrze¿enie: Nie wybrano ¿adnego produktu ... nie dokonano ¿adnych zmian ...' );
define( 'WARNING_FEATURED_PRE_ADD_BAD_PRODUCTS_ID', 'Ostrze¿enie: B³êdny produkt ... nie dokonano ¿adnych zmian ...' );
define( 'WARNING_FEATURED_PRE_ADD_DUPLICATE', 'Ostrze¿enie: Ten produkt jest ju¿ w polecanych ... nie dokonano ¿adnych zmian ...' );
define( 'SUCCESS_FEATURED_PRE_ADD', 'Pomy¶lnie dodano produkt polecany ... proszê zaktualizowaæ daty ...' );

define( 'HEADING_TITLE', 'Produkty polecane' );
define( 'TEXT_FEATURED_PRODUCT', 'Produkt polecany: ' );

define( 'TABLE_HEADING_PRODUCTS', 'Produkt' );
define( 'TABLE_HEADING_PRODUCTS_MODEL', 'Model' );
define( 'TABLE_HEADING_AVAILABLE_DATE', 'Dostêpny' );
define( 'TABLE_HEADING_EXPIRES_DATE', 'Wa¿no¶æ' );
define( 'TABLE_HEADING_STATUS', 'Status' );
define( 'TABLE_HEADING_ACTION', 'Akcja' );

define( 'TEXT_INFO_HEADING_DELETE_FEATURED', 'Usuwanie produktów polecanych' );
define( 'TEXT_INFO_DELETE_INTRO', 'Czy chcesz usun±æ informacjê o polecaniu tego produktu?' );

define( 'TEXT_INFO_HEADING_PRE_ADD_FEATURED', 'Manualne dodawanie produktu polecanego' );
define( 'TEXT_INFO_PRE_ADD_INTRO', 'Przy du¿ej bazie danych, mo¿esz manualnie dodaæ produkt do listy polacanych poprzez wpisanie jego numeru ID<br /><br />Jest to dobry sposób, przy du¿ej bazie danych, poniewa¿ nie trzeba tworzyæ pola select z du¿± ilo¶ci± produktów.' );
define( 'TEXT_PRE_ADD_PRODUCTS_ID', 'Wpisz numer ID produktu: ' );

define( 'TEXT_INFO_DATE_ADDED', 'Data dodania:' );
define( 'TEXT_INFO_LAST_MODIFIED', 'Ostatnia modyfikacja:' );
define( 'TEXT_INFO_AVAILABLE_DATE', 'Obowi±zuje od: ' );
define( 'TEXT_INFO_EXPIRES_DATE', 'Obowi±zuje do: ' );
define( 'TEXT_INFO_STATUS_CHANGE', 'Zmiana statusu: ' );
define( 'TEXT_INFO_MANUAL', 'Dodanie produktu poprzez jego ID' );

/**/
define( 'TABLE_HEADING_PRODUCTS_PERCENTAGE', 'Procentowo' );
define( 'TEXT_INFO_PERCENTAGE', 'Procentowo:' );

?>