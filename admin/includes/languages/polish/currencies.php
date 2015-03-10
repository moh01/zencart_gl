<?php
/**
 *
 * @version $Id: currencies.php, v 1.3.7 2007/04/26 11:48:12 $;
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

define( 'WARNING_PRIMARY_SERVER_FAILED', 'Ostrze¿enie: Serwer (%s) s³u¿±cy do pobierania kursów walut nie jest dostêpny dla %s (%s) - próbujê inny serwer.' );
define( 'TEXT_INFO_CURRENCY_UPDATED', 'Kurs wymiany dla waluty %s (%s) zosta³ zaktualizowany przez %s.' );
define( 'ERROR_CURRENCY_INVALID', 'B³±d: Kurs wymiany dla waluty %s (%s) nie zosta³ zaktualizowany przez %s. Czy kod waluty jest prawid³owy?' );
define( 'ERROR_REMOVE_DEFAULT_CURRENCY', 'B³±d: Nie mo¿na usun±æ domy¶lnej waluty. Wybierz inn± walutê jako domy¶ln± i wtedy usuñ tê walutê.' );

define( 'HEADING_TITLE', 'Waluty' );
define( 'TABLE_HEADING_CURRENCY_NAME', 'Waluta' );
define( 'TABLE_HEADING_CURRENCY_CODES', 'Kod' );
define( 'TABLE_HEADING_CURRENCY_VALUE', 'Kurs' );
define( 'TABLE_HEADING_ACTION', 'Akcja' );

define( 'TEXT_INFO_HEADING_NEW_CURRENCY', 'Nowa waluta' );
define( 'TEXT_INFO_INSERT_INTRO', 'Wprowad¼ dane dla nowej waluty' );
define( 'TEXT_INFO_CURRENCY_TITLE', 'Nazwa: ' );
define( 'TEXT_INFO_CURRENCY_CODE', 'Kod: ' );
define( 'TEXT_INFO_CURRENCY_SYMBOL_LEFT', 'Symbol z lewej: ' );
define( 'TEXT_INFO_CURRENCY_SYMBOL_RIGHT', 'Symbol z prawej: ' );
define( 'TEXT_INFO_CURRENCY_DECIMAL_POINT', 'Znak groszy: ' );
define( 'TEXT_INFO_CURRENCY_THOUSANDS_POINT', 'Znak tysiêcy: ' );
define( 'TEXT_INFO_CURRENCY_DECIMAL_PLACES', 'Miejsc po przecinku: ' );
define( 'TEXT_INFO_CURRENCY_VALUE', 'Przelicznik: ' );
define( 'TEXT_INFO_SET_AS_DEFAULT', TEXT_SET_DEFAULT . ' (wymaga rêcznej aktualizacji kursów walut)' );

define( 'TEXT_INFO_HEADING_EDIT_CURRENCY', 'Edycja waluty' );
define( 'TEXT_INFO_EDIT_INTRO', 'Wprowad¼ zmiany' );

define( 'TEXT_INFO_HEADING_DELETE_CURRENCY', 'Usuwanie waluty' );
define( 'TEXT_INFO_DELETE_INTRO', 'Czy na pewno usun±æ tê walutê?' );

define( 'TEXT_INFO_CURRENCY_LAST_UPDATED', 'Ostatnia aktualizacja kursu wymiany: ' );
define( 'TEXT_INFO_CURRENCY_EXAMPLE', 'Aktualne wy¶wietlanie: ' );

?>