<?php
/**
 *
 * @version $Id: banner_statistics.php, v 1.3.7 2007/04/26 11:48:12 $;
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

define( 'ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'B��d: Nie mo�na zapistywa� do katalogu wykres�w: <strong>' . DIR_WS_ADMIN . 'images/graphs</strong>' );
define( 'ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'B��d: Katalog wykres�w nie istnieje. Prosz� utworzy� katalog:  <strong>' . DIR_WS_ADMIN . 'images/graphs</strong>' );

define( 'HEADING_TITLE', 'Statystyki baner�w' );

define( 'STATISTICS_TYPE_DAILY', 'Dzienne' );
define( 'STATISTICS_TYPE_MONTHLY', 'Miesi�czne' );
define( 'STATISTICS_TYPE_YEARLY', 'Roczne' );
define( 'TITLE_TYPE', 'Rodzaj: ' );
define( 'TITLE_MONTH', 'Miesi�c: ' );
define( 'TITLE_YEAR', 'Rok: ' );

define( 'TEXT_BANNERS_DAILY_STATISTICS', '%s - statystyki dzienne: %s %s' );
define( 'TEXT_BANNERS_MONTHLY_STATISTICS', '%s - statystyki miesi�czne: %s' );
define( 'TEXT_BANNERS_YEARLY_STATISTICS', '%s - statystyki roczne' );

define( 'TABLE_HEADING_SOURCE', 'Dzie�/Miesi�c/Rok' );
define( 'TABLE_HEADING_VIEWS', 'Wy�wietle�' );
define( 'TABLE_HEADING_CLICKS', 'Klikni��' );

define( 'TEXT_BANNERS_DATA', 'D<br />A<br />N<br />E' );

?>