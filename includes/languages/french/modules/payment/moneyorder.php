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

  define('MODULE_PAYMENT_MONEYORDER_TEXT_TITLE', 'Chèque ou Virement Bancaire');
  define('MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION', '
<hr>
<u>Paiement par virement bancaire </u> : <br><br>
Veuillez faire un virement du montant de la commande ttc aux coordonnées bancaires ci-dessous :<br /><br />

Bénéficaire : Sarl Easylamps   <br />
Domiciliation : HSBC HERVET BOULOGNE <br />
CODE ETABLISSEMENT : 30368<br />
CODE GUICHET :  00085<br />
N° DE COMPTE : 008516R0357 CLE RIB : 54<br />
<br /><br />
Pour les virements internationaux :<br />
IBAN : FR7630056007850785476108718<br />
BIC : BHVTFRPP<br />
<br />
<u>Paiement par chèque :</u> <br><br>

Veuillez envoyer à l\'adresse ci-dessous un chèque du montant de la commande TTC libellé à l\'ordre d\'Easylamps.
<br><br>

Easylamps <br>
5 rue Firmin Gémier<br>
75018 Paris <br>
<br />
     <hr>' . 'Votre commande ne sera envoyée qu\'&agrave;
 r&eacute;ception du règlement et de sa validation par notre banque.');
  define('MODULE_PAYMENT_MONEYORDER_TEXT_EMAIL_FOOTER', MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION );
?>
