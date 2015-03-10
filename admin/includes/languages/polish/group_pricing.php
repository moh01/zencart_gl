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
 * Wiêcej informacji na stronie projektu {@link http://www.zencart.pl ZenCart.pl} Zajrzyj!
 *
 *
 * @package admin
 *
 */

define( 'ERROR_GROUP_PRICING_CUSTOMERS_EXIST', 'B£¡D: Istniej± klienci w tej grupie. Potwierd¼, ¿e chcesz usun±æ klientów z tej grupy i usun±æ grupê.' );
define( 'ERROR_MODULE_NOT_CONFIGURED','UWAGA: Masz zdefiniowan± grupê cenow±, ale nie w³±czy³e¶ modu³u group-pricing Order Total.<br />Przejd¼ do Modu³y->Zamówienia->(ot_group_pricing) i zainstaluj/skonfiguruj ten modu³.' );

define( 'HEADING_TITLE', 'Grupy cenowe' );
define( 'TABLE_HEADING_GROUP_ID', 'ID' );
define( 'TABLE_HEADING_GROUP_NAME', 'Nazwa grupy' );
define( 'TABLE_HEADING_GROUP_AMOUNT', '% zni¿ki' );
define( 'TABLE_HEADING_ACTION', 'Akcja' );

define( 'TEXT_HEADING_NEW_PRICING_GROUP', 'Nowa grupa cenowa' );
define( 'TEXT_NEW_INTRO', 'Wpisz informacje na temat nowej grupy cenowej' );
define( 'TEXT_GROUP_PRICING_NAME', 'Nazwa grupy: ' );
define( 'TEXT_GROUP_PRICING_AMOUNT', 'Zni¿ka procentowa: ' );

define( 'TEXT_HEADING_EDIT_PRICING_GROUP', 'Edytuj grupê cenow±' );
define( 'TEXT_EDIT_INTRO', 'Wprowad¼ zmiany' );

define( 'TEXT_HEADING_DELETE_PRICING_GROUP', 'Usuñ grupê cenow±' );
define( 'TEXT_DELETE_INTRO', 'Czy usun±æ tê grupê cenow±?' );
define( 'TEXT_DELETE_PRICING_GROUP', 'Usuñ grupê cenow±' );
define( 'TEXT_DELETE_WARNING_GROUP_MEMBERS', '<strong>OSTRZE¯ENIE:</strong> Istnieje %s klientów przypisanych do tej grupy cenowej!' );

define( 'TEXT_DATE_ADDED', 'Data dodania: ' );
define( 'TEXT_LAST_MODIFIED', 'Ostatnia modyfikacja: ' );
define( 'TEXT_CUSTOMERS', 'Klientów w grupie: ' );

?>