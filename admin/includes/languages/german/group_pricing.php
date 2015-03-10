<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.at/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                                 |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.at/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: group_pricing.php 2770 2006-01-02 07:52:42Z drbyte $
//

define('HEADING_TITLE', 'Gruppenpreise');
define('TABLE_HEADING_GROUP_ID', 'ID');
define('TABLE_HEADING_GROUP_NAME', 'Gruppenname');
define('TABLE_HEADING_GROUP_AMOUNT', '% Nachlass');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TEXT_HEADING_NEW_PRICING_GROUP', 'Neue Preisgruppe');
define('TEXT_HEADING_EDIT_PRICING_GROUP', 'Preisgruppe bearbeiten');
define('TEXT_HEADING_DELETE_PRICING_GROUP', 'Preisgruppe l&ouml;schen');
define('TEXT_NEW_INTRO', 'Bitte geben Sie folgende Informationen f&uuml;r die neue Preisgruppe an');
define('TEXT_EDIT_INTRO', 'Bitte f&uuml;hren Sie hier die notwendigen &Auml;nderungen durch');
define('TEXT_DELETE_INTRO', 'Sind Sie sicher, dass Sie diese Preisgruppe l&ouml;schen wollen?');
define('TEXT_DELETE_PRICING_GROUP', 'L&ouml;scht die Preisgruppe');
define('TEXT_DELETE_WARNING_GROUP_MEMBERS', '<b>WARNUNG:</b> Es gibt %s Kunden, die noch mit dieser Kategorie verbunden sind !');
define('TEXT_GROUP_PRICING_NAME', 'Gruppenname: ');
define('TEXT_GROUP_PRICING_AMOUNT', 'Preisnachlass in Prozent: ');
define('TEXT_DATE_ADDED', 'Erstelldatum:');
define('TEXT_LAST_MODIFIED', 'Letzte &Auml;nderung:');
define('TEXT_CUSTOMERS', 'Kunden in der Gruppe:');
define('ERROR_GROUP_PRICING_CUSTOMERS_EXIST', 'FEHLER: Kunden bestehen in dieser Gruppe.  Best&auml;tigen Sie bitte, da&szlig; Sie alle Mitglieder von der Gruppe entfernen und sie l&ouml;schen m&ouml;chten.');
define('ERROR_MODULE_NOT_CONFIGURED', 'Anmerkung: Sie verwenden Gruppenpreise, haben jedoch nicht das Gruppenerm&auml;&szlig;igunsmodul aktiviert.<br />Gehen Sie zu Admin->Module->Bestellarten->Gruppenerm&auml;&szlig;ig (ot_group_pricing) und installieren/konfigurieren das Modul.');



?>