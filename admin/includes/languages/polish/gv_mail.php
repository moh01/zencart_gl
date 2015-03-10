<?php
/**
 *
 * @version $Id: gv_mail.php, v 1.3.7 2007/04/26 11:48:12 $;
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

/* mail */
define( 'ERROR_NO_CUSTOMER_SELECTED', 'B��d: Nie wybrano odbiorc�w maila' );
define( 'NOTICE_EMAIL_SENT_TO', 'Informacja: Email wys�ano do: %s' );
define( 'ERROR_NO_SUBJECT', 'B��d: Nie wpisano tematu' );
define( 'TEXT_CUSTOMER', 'Klienci: ' );
define( 'TEXT_FROM', 'Nadawca: ' );
define( 'TEXT_SUBJECT', 'Temat: ' );
define( 'TEXT_MESSAGE', 'Wiadomo�� tekstowa: ' );

/* wlasne */
define( 'ERROR_NO_AMOUNT_SELECTED', 'B��d: Nie wpisano kwoty' );

define( 'HEADING_TITLE', 'Wysy�anie bon�w towarowych do Klient�w' );

define( 'TEXT_AMOUNT', 'Kwota' );
define( 'ERROR_GV_AMOUNT', 'Ustal kwot� jako warto�� bez podawania symbolu waluty np.: 25.00' );
define( 'TEXT_RICH_TEXT_MESSAGE', 'Wiadomo�� formatowana: ' );

define( 'TEXT_TO', 'Email do: ' );
define( 'TEXT_SINGLE_EMAIL', '<span class="smallText">U�yj tego pola, aby wys�a� pojedy�czy email, zamiast wybiera� z listy rozwijalnej powy�ej</span>' );
define( 'TEXT_GV_ANNOUNCE', '<span class="color: #0000ff">Chcemy zaproponowa� Ci <strong>' . TEXT_GV_NAME . '</strong></span>' );
define( 'TEXT_GV_WORTH', 'Warto�� Kuponu twowarowego ' );
define( 'TEXT_TO_REDEEM', 'Aby zrealizowa� ' . TEXT_GV_NAME . ', kliknij na poni�szy link. Wpisz ' . TEXT_GV_REDEEM . ' widoczny poni�ej' );
define( 'TEXT_WHICH_IS', ' kt�ry jest' );
define( 'TEXT_IN_CASE', ' w przypadku, kiedy masz jakiekolwiek problemy.' );
define( 'TEXT_CLICK_TO_REDEEM', 'Kliknij, aby zrealizowa�' );
define( 'TEXT_OR_VISIT', ' lub odwied� ' );
define( 'TEXT_ENTER_CODE', ' i wpisz kod podczas zamawiania' );

/**/
define( 'TEXT_SELECT_CUSTOMER', 'Wybierz Klienta' );
define( 'TEXT_ALL_CUSTOMERS', 'Do wszystkich Klient�w' );
define( 'TEXT_NEWSLETTER_CUSTOMERS', 'Do wszystkich subskrybent�w');
define( 'TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'Niedawno zakupi�e� Bon Towarowy w naszym sklepie.' );
define( 'TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', "\n\n" . 'Warto�� Bonu towarowego wynosi: %s' );
define( 'TEXT_REDEEM_COUPON_MESSAGE_BODY', "\n\n" . 'Mo�esz teraz odwiedzi� nasz sklep, zalogowa� si� i wys�a� ten Bon Towarowy dka kogo chcesz.' );
define( 'TEXT_REDEEM_COUPON_MESSAGE_FOOTER', "\n\n" );

?>