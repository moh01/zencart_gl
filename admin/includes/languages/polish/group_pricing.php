<?php
/**
 *
 * @version $Id: group_pricing.php, v 1.3.7 2007/04/26 11:48:12 $;
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

define( 'ERROR_GROUP_PRICING_CUSTOMERS_EXIST', 'B��D: Istniej� klienci w tej grupie. Potwierd�, �e chcesz usun�� klient�w z tej grupy i usun�� grup�.' );
define( 'ERROR_MODULE_NOT_CONFIGURED','UWAGA: Masz zdefiniowan� grup� cenow�, ale nie w��czy�e� modu�u group-pricing Order Total.<br />Przejd� do Modu�y->Zam�wienia->(ot_group_pricing) i zainstaluj/skonfiguruj ten modu�.' );

define( 'HEADING_TITLE', 'Grupy cenowe' );
define( 'TABLE_HEADING_GROUP_ID', 'ID' );
define( 'TABLE_HEADING_GROUP_NAME', 'Nazwa grupy' );
define( 'TABLE_HEADING_GROUP_AMOUNT', '% zni�ki' );
define( 'TABLE_HEADING_ACTION', 'Akcja' );

define( 'TEXT_HEADING_NEW_PRICING_GROUP', 'Nowa grupa cenowa' );
define( 'TEXT_NEW_INTRO', 'Wpisz informacje na temat nowej grupy cenowej' );
define( 'TEXT_GROUP_PRICING_NAME', 'Nazwa grupy: ' );
define( 'TEXT_GROUP_PRICING_AMOUNT', 'Zni�ka procentowa: ' );

define( 'TEXT_HEADING_EDIT_PRICING_GROUP', 'Edytuj grup� cenow�' );
define( 'TEXT_EDIT_INTRO', 'Wprowad� zmiany' );

define( 'TEXT_HEADING_DELETE_PRICING_GROUP', 'Usu� grup� cenow�' );
define( 'TEXT_DELETE_INTRO', 'Czy usun�� t� grup� cenow�?' );
define( 'TEXT_DELETE_PRICING_GROUP', 'Usu� grup� cenow�' );
define( 'TEXT_DELETE_WARNING_GROUP_MEMBERS', '<strong>OSTRZE�ENIE:</strong> Istnieje %s klient�w przypisanych do tej grupy cenowej!' );

define( 'TEXT_DATE_ADDED', 'Data dodania: ' );
define( 'TEXT_LAST_MODIFIED', 'Ostatnia modyfikacja: ' );
define( 'TEXT_CUSTOMERS', 'Klient�w w grupie: ' );

?>