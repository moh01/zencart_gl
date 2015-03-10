<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |   
// | http://www.zen-cart.com/index.php                                    |   
// |                                                                      |   
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: moneyorder.php,v 1.2 2006/01/11 17:38:23 damage_in Exp $
//

  define('MODULE_PAYMENT_MONEYORDER_TEXT_TITLE', 'Scheck oder Vorkasse/Überweisung');
  define('MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION', '
<hr>
<u>Zahlung per Vorkasse/Überweisung </u> : <br><br>
Bitte überweisen Sie auf das nachstehende Konto den Betrag der Bestellung.<br>
Sarl Easylamps <br><br>
Domiciliation : HSBC HERVET BOULOGNE<br><br>
Für Überweisungen aus Deutschland<br>
<font color="red">
IBAN: FR7630056007850785476108718<br>
BIC : BHVTFRPP<br>
</font>
<br>
<hr>
<u>Zahlung per Scheck </u> : 
<br><br>
Bitte schicken Sie an die nachstehende Adresse einen Scheck  mit dem Betrag der Bestellung, ausgestellt auf die Gesellschaft Easylamps.<br><br>
Easylamps<br>
5 rue Firmin Gémier<br>
75018<br>
FRANCE
<br><br>
<hr>
Der Versand Ihrer Bestellung erfolgt erst nach Eingang Ihrer Bezahlung bei unserer Bank.<br>

');

  define('MODULE_PAYMENT_MONEYORDER_TEXT_EMAIL_FOOTER', MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION );

?>
