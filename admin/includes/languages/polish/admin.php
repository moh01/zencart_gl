<?php
/**
 *
 * @version $Id: admin.php, v 1.3.7 2007/04/26 11:48:12 $;
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

define( 'ENTRY_PASSWORD_NEW_ERROR', 'Twoje nowe has³o musi sk³adaæ siê przynajmniej z  ' . ENTRY_PASSWORD_MIN_LENGTH . ' znaków' );
define( 'ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Potwierdzenie has³a musi byæ takie samo jak nowe has³o' );

define( 'HEADING_TITLE', 'Administratorzy sklepu' );
define( 'TABLE_HEADING_ADMINS_ID', 'ID' );
define( 'TABLE_HEADING_ADMINS_NAME', 'Nick admina' );
define( 'TABLE_HEADING_ADMINS_EMAIL', 'Email' );
define( 'TABLE_HEADING_ACTION', 'Akcja' );

define( 'TEXT_HEADING_NEW_ADMIN', 'Nowy Admin' );
define( 'TEXT_NEW_INTRO', 'Wpisz informacje na temat nowego admina' );
define( 'TEXT_ADMINS_NAME', 'Nick admina: ' );
define( 'TEXT_ADMINS_EMAIL', 'Email: ' );
define( 'TEXT_ADMINS_PASSWORD', 'Has³o: ' );
define( 'TEXT_ADMINS_CONFIRM_PASSWORD', 'Potwierd¼ has³o: ' );

define( 'TEXT_HEADING_EDIT_ADMIN', 'Edycja Admina' );
define( 'TEXT_EDIT_INTRO', 'Wprowad¼ zmiany' );
define( 'TEXT_ADMIN_DEMO', 'Demo Panelu Administracyjnego ogranicza pewne dzia³ania dla Admina, zabezpieczaj±c przed zniszczeniem danych sklepu. Tylko Admin poziomu 1 mo¿e wprowadzaæ zmiany, które zosta³y wy³±czone w wersji Demo.<br />Upewnij siê, ¿e dla Admina w wersji Demo ustawiono poziom 0, je¶li chcesz w³±czyæ tê opcjê' );
define( 'TEXT_DEMO_STATUS', 'Demo dla Admina ma status: ' );
define( 'TEXT_DEMO_OFF', 'Wy³±czone' );
define( 'TEXT_DEMO_ON', 'W³±czone' );

define( 'TEXT_HEADING_RESET_PASSWORD', 'Zmiana has³a' );

define( 'TEXT_HEADING_DELETE_ADMIN', 'Usuwanie Admina' );
define( 'TEXT_DELETE_INTRO', 'Czy usun±æ tego admina?' );

/**/
define( 'TEXT_ADMINS', 'Admini: ' );
define( 'TEXT_DELETE_IMAGE', 'Usuñ obrazek admina?' );
define( 'TEXT_ADMINS_LEVEL', 'Poziom admina: ' );

define( 'TEXT_ADMIN_LEVEL_INSTRUCTIONS', 'Ustaw poziom 1 dla Admina, który ma mieæ pe³ny dostêp do Panleu. Tylko poziom 1 pozwala na zmianê loginów i hase³, kiedy w³±czona jest opcja Demo.' );

?>