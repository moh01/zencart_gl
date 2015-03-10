<?php
/**
 *
 * @version $Id: whos_online.php, v 1.3.7 2007/04/26 11:48:12 $;
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

define( 'WHOIS_TIMER_INACTIVE', 180 ); // seconds when considered inactive - 180 default = 3 minutes
define( 'WHOIS_TIMER_DEAD', 540 ); // seconds when considered dead - 540 default = 9 minutes
define( 'WHOIS_TIMER_REMOVE', 1200 ); // seconds when removed from whos_online table - 1200 default = 20 minutes

define( 'HEADING_TITLE', 'Klienci online' );
define( 'WHOS_ONLINE_REFRESH_LIST_TEXT', 'OD¦WIE¯ LISTÊ' );
define( 'WHOS_ONLINE_LEGEND_TEXT', 'Legenda: ' );
define( 'WHOS_ONLINE_ACTIVE_TEXT', 'Aktywny z koszykiem' );
define( 'WHOS_ONLINE_INACTIVE_TEXT', 'Nieaktywny z koszykiem' );
define( 'WHOS_ONLINE_ACTIVE_NO_CART_TEXT', 'Aktywny bez koszyka' );
define( 'WHOS_ONLINE_INACTIVE_NO_CART_TEXT', 'Nieaktywny bez koszyka' );
define( 'WHOS_ONLINE_INACTIVE_LAST_CLICK_TEXT', 'Nieaktywny dla ostatniego klikniêcia >=' );
define( 'WHOS_ONLINE_INACTIVE_ARRIVAL_TEXT', 'Nieaktywny od >' );
define( 'WHOS_ONLINE_REMOVED_TEXT', 'zosta³ usuniêty' );
define( 'TEXT_NUMBER_OF_CUSTOMERS', 'Obecnie w sklepie znajduje siê %s klientów' );

define( 'WHOIS_SHOW_HOST', '1' ); // pokazuje czas od ostatniego klikniecia i ID sesji, Host, przegladarka
define( 'WHOIS_REPEAT_LEGEND_BOTTOM', '12' ); // pokazuje legende na dole, gdy liczba klientow > od wartosci

define( 'TABLE_HEADING_ONLINE', 'Online' );
define( 'TABLE_HEADING_CUSTOMER_ID', 'ID' );
define( 'TABLE_HEADING_FULL_NAME', 'Imiê i Nazwisko');
define( 'TABLE_HEADING_IP_ADDRESS', 'Adres IP' );
define( 'TABLE_HEADING_SESSION_ID', 'Sesja' );
define( 'TABLE_HEADING_ENTRY_TIME', 'Wej¶cie' );
define( 'TABLE_HEADING_LAST_CLICK', 'Ostatnie klikniêcie' );
define( 'TABLE_HEADING_LAST_PAGE_URL', 'Ostatnio odwiedzony link' );
define( 'TIME_PASSED_LAST_CLICKED', '<strong>Czas od ostatniego klikniêcia:</strong> ' );
define( 'TEXT_SESSION_ID', '<strong>ID sesji:</strong> ' );
define( 'TEXT_HOST', '<strong>Host:</strong> ');
define( 'TEXT_USER_AGENT', '<strong>Przegl±darka:</strong> ' );

define( 'TABLE_HEADING_SHOPPING_CART', 'Koszyk u¿ytkownika' );
define( 'TEXT_EMPTY_CART', '<strong>Koszyk jest pusty</strong>' );
define( 'TEXT_SHOPPING_CART_SUBTOTAL', 'Podsuma' );

define( 'TABLE_HEADING_ACTION', 'Akcja' );

/**/
  define('OFFICE_IP_TO_HOST_ADDRESS', 'WY£');

?>