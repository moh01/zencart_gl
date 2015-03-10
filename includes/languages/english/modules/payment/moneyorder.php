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
// $Id: moneyorder.php 1969 2005-09-13 06:57:21Z drbyte $
//

  define('MODULE_PAYMENT_MONEYORDER_TEXT_TITLE', 'Check or money order');
  define('MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION', '
<hr>
<u>Paiement by bank transfert </u> : <br><br>
Please make a transfer for the amount of the order to the bank details below :<br /><br />

Sarl Easylamps<br />
Domiciliation : HSBC HERVET BOULOGNE  <br />
<br /><br />
<font color="red">
For transfers from outside France<br />
IBAN : FR7630056007850785476108718<br />
BIC : BHVTFRPP
</font>
<br />
<br />

<u>Payment by cheque :</u> <br><br>

Please send a cheque for the total inc VAT amount to the address below made out to Easylamps.
<br><br>

Easylamps <br>
5 rue Firmin Gémier<br>
75018 Paris <br>
France<br>
<br />
<hr>
<br />' . 'Your order will only be sent after receipt of transfer or cheque and bank validation.');
  define('MODULE_PAYMENT_MONEYORDER_TEXT_EMAIL_FOOTER', MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION );
?>
