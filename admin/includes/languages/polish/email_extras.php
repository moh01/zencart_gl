<?php
/**
 *
 * @version $Id: email_extras.php, v 1.3.7 2007/04/26 11:48:12 $;
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

/* Patrz funkcje wgrywane przez init_languages.php */
define( 'EMAIL_FOOTER_COPYRIGHT', 'Copyright (c) ' . date( 'Y' ) . ' <a href="http://www.zen-cart.com" target="_blank">Zen Cart</a>. Powered by <a href="http://www.zen-cart.com" target="_blank">Zen Cart</a> Modified by <a href="http://zencart.pl" target="_blank">ZenCart.pl</a>' );
define( 'EMAIL_DISCLAIMER', 'Twój adres email zosta³ dodany do naszej bazy bezpo¶rednio przez Ciebie lub przez jednego z naszych Klientów. Je¶li otrzyma³e¶(a¶) ten email przez przypadek zg³o¶ ten fakt na adres: %s' );
define( 'EMAIL_SPAM_DISCLAIMER', 'Szanujemy politykê AntySpamow± dlatego, je¶li nie chcesz otrzymywaæ emaili od nas zg³o¶ ten fakt, a usuniemy go z naszej bazy.' );
define( 'TEXT_UNSUBSCRIBE', "\n\nJe¶li chcesz zrezygnowaæ z otrzymywania naszego newslettera oraz informacji o promocjach kliknij w podany link: \n");

/* orders */
define( 'SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_SUBJECT', '[STATUS ZAMÓWIENIA]' );

/* gv mail */
define( 'SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO_SUBJECT', '[BONY TOWAROWE]' );

/**/
define( 'OFFICE_USE', '<strong>Wy³±cznie do u¿ytku biurowego:</strong>' );
define( 'OFFICE_FROM', '<strong>Od:</strong>' );
define( 'OFFICE_EMAIL', '<strong>Email:</strong>' );
define( 'OFFICE_LOGIN_NAME', '<strong>Nick:</strong>' );
define( 'OFFICE_LOGIN_EMAIL', '<strong>Email logowania:</strong>' );
define( 'OFFICE_LOGIN_PHONE', '<strong>Telefon:</strong>' );
define( 'OFFICE_IP_ADDRESS', '<strong>Adres IP:</strong>' );
define( 'OFFICE_HOST_ADDRESS', '<strong>Adres hosta:</strong>' );
define( 'OFFICE_DATE_TIME', '<strong>Data i czas:</strong>' );
  define('OFFICE_SENT_TO','<strong>Wys³any do:</strong>');
  define('OFFICE_EMAIL_TO','<strong>Na adres:</strong>');

// email disclaimer
  define('SEND_EXTRA_GV_ADMIN_EMAILS_TO_SUBJECT','[GV ADMIN]');

// for whos_online when gethost is off
  define('OFFICE_IP_TO_HOST_ADDRESS', 'WY£');

?>