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
// $Id: gv_faq.php 1969 2005-09-13 06:57:21Z drbyte $
//

  define('NAVBAR_TITLE', TEXT_GV_NAME . ' FAQ');
  define('HEADING_TITLE', TEXT_GV_NAME . ' FAQ');

  define('TEXT_INFORMATION', '<a name="Top"></a>
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=1','NONSSL').'">Acheter des ' . TEXT_GV_NAMES . '</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=2','NONSSL').'">Comment Envoyer des ' . TEXT_GV_NAMES . '</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=3','NONSSL').'">Comment Acheter avec des ' . TEXT_GV_NAMES . '</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=4','NONSSL').'">Encaisser des ' . TEXT_GV_NAMES . '</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=5','NONSSL').'">En cas de probl&egrave;me</a><br />
');
switch ($_GET['faq_item']) {
  case '1':
  define('SUB_HEADING_TITLE','Acheter des ' . TEXT_GV_NAMES);
  define('SUB_HEADING_TEXT', 'Les ' . TEXT_GV_NAMES . ' s\'ach&egrave;tent comme tout autre produit, en utilisant les modes de paiement en vigueur sur le Site. Lorsque vous avez pay&eacute; le Montant de Votre ' . TEXT_GV_NAME . ', sa Valeur est ajout&eacute;e &agrave; Votre Compte ' . TEXT_GV_NAME . '. Si vous avez d&eacute;j&agrave; des fonds disponibles sur Votre Compte de ' . TEXT_GV_NAME . ', vous noterez que le montant s\'affiche alors dans le bloc du Panier, avec un lien vers la page depuis laquelle vous pouvez envoyer votre ' . TEXT_GV_NAME . ' par E-mail &agrave; la personne de votre Choix.');
  break;
  case '2':
  define('SUB_HEADING_TITLE','Comment Envoyer des ' . TEXT_GV_NAMES);
  define('SUB_HEADING_TEXT','Pour envoyer un ' . TEXT_GV_NAME . ', vous devez vous rendre sur la page des envois de ' . TEXT_GV_NAME . '. Le lien vers cette page est dispoible depuis le Panier, lorsque vous &ecirc;tes connect&eacute; &agrave; Votre Compte, et si vous avez des fonds disponibles. Lorsque vous envoyez un ' . TEXT_GV_NAME . ', vous devez fournir les informations suivantes: <br />- le Nom de la personne &agrave; laquelle vous adressez ' . TEXT_GV_NAME . '. <br />- Son adresse E-mail. <br />- le Montant que vous souhaitez envoyer. (Vous n\'�es pas tenu de tout envoyer...');
  break;
  case '3':
  define('SUB_HEADING_TITLE','Comment Acheter avec des ' . TEXT_GV_NAMES);
  define('SUB_HEADING_TEXT','Si vous disposez de fonds sur Votre Compte de ' . TEXT_GV_NAME . ', vous pouvez les utiliser lors de la Commande: vous devrez alors entrer le montant que vous souhaitez pr&eacute;lever. Vous devrez compl&eacute;ter avec un autre moyen de paiement si le montant disponible sur Votre Compte ' . TEXT_GV_NAME . ' est insuffisant pour assurer le r&egrave;glement total de Votre Commande.
  Si vous disposez de plus de fonds sur Votre Compte ' . TEXT_GV_NAME . ' que le montant Total de votre commande, le solde sera affect&eacute; &agrave; Votre Compte ' . TEXT_GV_NAME . ' pour vos futurs achats.');
  break;
  case '4':
  define('SUB_HEADING_TITLE','Comment encaisser des ' . TEXT_GV_NAMES);
  define('SUB_HEADING_TEXT','Un ' . TEXT_GV_NAME . ' par E-mail contient les informations concernant l\'Exp&eacute;diteur du ' . TEXT_GV_NAME . ', ainsi qu\'un court message de sa part. Cet E-mail indiquera aussi le ' . TEXT_GV_REDEEM . ' du ' . TEXT_GV_NAME . '. Nous vous invitons &agrave; l\'imprimer. Vous pourrez alors Encaisser ce ' . TEXT_GV_NAME . ' de deux mani&egrave;res possibles.<br /><br />
  1. En cliquant sur le lien contenu dans l\'E-mail et pr&eacute;vu &agrave; cet effet. Vous serez alors redirig&eacute; vers la page de Commande. Nous vous demanderons de cr&eacute;er Votre Compte si vous n\'&ecirc;tes pas encore client et vous pourrez alors utiliser votre ' . TEXT_GV_NAME . ' dans la Boutique.<br /><br />
  2. Lors de la validation de Votre Commande, vous verrez appara&icirc;tre une case &agrave; cocher <strong> ' . TEXT_GV_REDEEM . '. </strong> assortie de la mention \'Entrez votre ' . TEXT_GV_REDEEM . ' ici\'. Le code sera valid&eacute; et ajout&eacute; &agrave; votre Compte de ' . TEXT_GV_NAME . '. Vous pourrez alors utiliser le Montant.');
  break;
  case '5':
  define('SUB_HEADING_TITLE','En cas de probl&egrave;mes.');
  define('SUB_HEADING_TEXT','Pour tout renseignement concernant notre Syst&egrave;me de ' . TEXT_GV_NAME . ', veuillez prendre contact par E-mail avec '. STORE_OWNER_EMAIL_ADDRESS . '. Veuillez par ailleurs vous assurer de nous fournir le maximum d\'informations. ');
  break;
  default:
  define('SUB_HEADING_TITLE','');
  define('SUB_HEADING_TEXT','Choisir une des questions ci-haut');

  }
?>