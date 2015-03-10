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
 * Wi�cej informacji na stronie projektu {@link http://www.zencart.pl ZenCart.pl} Zajrzyj!
 *
 *
 * @package admin
 *
 */

define( 'ERROR_WRONG_EMAIL_NULL', '<p>Musisz wpisa� email!</p>' );
define( 'ERROR_WRONG_EMAIL', '<p>Wpisano b��dny adres email!</p>' );
define( 'TEXT_EMAIL_MESSAGE', 'Nowe has�o zosta�o przes�ane z ' . $_SERVER['REMOTE_ADDR']  . '.' . "\n\n" . 'Nowe has�o w sklepie \'' . STORE_NAME . '\' to:' . "\n\n" . '   %s' . "\n\nPo zalogowaniu z nowym has�em mo�esz je zmiani� w panelu Narz�dzia->Administratorzy." );
define( 'TEXT_EMAIL_SUBJECT', 'Przypominanie has�a Admina' );
define( 'TEXT_EMAIL_FROM', EMAIL_FROM );
define( 'SUCCESS_PASSWORD_SENT', '<p>Nowe has�o zosta�o przes�ane na Tw�j adres email.</p>' );

define( 'HEADING_TITLE', 'Przypominanie has�a' );
define( 'TEXT_ADMIN_EMAIL', 'Adres email Admina: ' );

?>