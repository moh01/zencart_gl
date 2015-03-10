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

  define('MODULE_PAYMENT_MONEYORDER_TEXT_TITLE', 'Giro Bancario / Transferencia o Cheque');

$desc =  '<br>Sírvase hacer un giro del monto de su pedido a la cuenta bancaria siguiente.<br>
Beneficiario: Sarl Easylamps<br><br>
N° de IVA Intracomunitario : FR 68 489 702 514<br>
Domicilio social : 5 rue Firmin Gémier 75018 Paris, Francia.<br><br><br>


Para los giros desde España<br>
IBAN: FR7630056007850785476108718<br>
BIC : BHVTFRPP
<br>
<hr>
<br>
Pago por cheque<br><br>
Sírvase enviar a la dirección siguiente un cheque con el monto del pedido, suscrito a la orden de la empresa Easylamps.<br><br>

Easylamps<br>
5 Rue Firmin Gémier<br>
75018 PARIS<br>
Francia<br>
<br>
<hr>
<br>
Su pedido no será enviado salvo buen cobro y validación por parte de nuestra banca.<br><br>';

  define('MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION', $desc );

  define('MODULE_PAYMENT_MONEYORDER_TEXT_EMAIL_FOOTER', $desc );

?>
