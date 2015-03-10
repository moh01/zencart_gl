<?php
/**
 *
 * @version $Id: password_forgotten.php, v 1.3.7 2007/04/26 11:48:12 $;
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

define( 'ERROR_WRONG_EMAIL_NULL', '<p>Musisz wpisaæ email!</p>' );
define( 'ERROR_WRONG_EMAIL', '<p>Wpisano b³êdny adres email!</p>' );
define( 'TEXT_EMAIL_MESSAGE', 'Nowe has³o zosta³o przes³ane z ' . $_SERVER['REMOTE_ADDR']  . '.' . "\n\n" . 'Nowe has³o w sklepie \'' . STORE_NAME . '\' to:' . "\n\n" . '   %s' . "\n\nPo zalogowaniu z nowym has³em mo¿esz je zmianiæ w panelu Narzêdzia->Administratorzy." );
define( 'TEXT_EMAIL_SUBJECT', 'Przypominanie has³a Admina' );
define( 'TEXT_EMAIL_FROM', EMAIL_FROM );
define( 'SUCCESS_PASSWORD_SENT', '<p>Nowe has³o zosta³o przes³ane na Twój adres email.</p>' );

define( 'HEADING_TITLE', 'Przypominanie has³a' );
define( 'TEXT_ADMIN_EMAIL', 'Adres email Admina: ' );

?>