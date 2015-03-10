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
//  $Id: newsletters.php 3020 2006-02-13 04:24:58Z ajeh $
//

  define('HEADING_TITLE', 'Newsletter');

  define('TABLE_HEADING_NEWSLETTERS', 'Newsletters');
  define('TABLE_HEADING_SIZE', 'Taille');
  define('TABLE_HEADING_MODULE', 'Module');
  define('TABLE_HEADING_SENT', 'Envoy&eacute;');
  define('TABLE_HEADING_STATUS', 'Statut');
  define('TABLE_HEADING_ACTION', 'Action');

  define('TEXT_NEWSLETTER_MODULE', 'Module:');
  define('TEXT_NEWSLETTER_TITLE', 'Sujet:');
  define('TEXT_NEWSLETTER_CONTENT', 'Contenu <br />Texte-Seulement:');
  define('TEXT_NEWSLETTER_CONTENT_HTML', 'Contenu <br />Rich Text:');

  define('TEXT_NEWSLETTER_DATE_ADDED', 'Date d\'Ajout:');
  define('TEXT_NEWSLETTER_DATE_SENT', 'Date d\'Envoi:');

  define('TEXT_INFO_DELETE_INTRO', 'Etes-vous certain de vouloir effacer cette Newsletter?');

  define('TEXT_PLEASE_WAIT', 'Veuillez patienter .. envoi des Emails ..<br /><br />Veuillez ne pas interrompre le processus !');
  define('TEXT_FINISHED_SENDING_EMAILS', 'Envoi des e-mails termin&eacute; !');

  define('TEXT_AFTER_EMAIL_INSTRUCTIONS','%s emails envoy&eacute;s. <br /><br />Surveillez votre Bo&icirc;te de R&eacute;ception ('.EMAIL_FROM.') pour:<UL><LI>a) les messages de retour</LI><LI>b) des adresses email qui ne sont plus valides</LI><LI>c) ou qui demandent &agrave; &ecirc;tre effac&eacute;es.</LI></UL>Vous pouvez effacer ces adreesses via le Menu correspondant aux Clients, dans Admin | Menu Clients.');

  define('ERROR_NEWSLETTER_TITLE', 'Erreur: titre de Newsletter requis');
  define('ERROR_NEWSLETTER_MODULE', 'Erreur: module de Newsletter requis');
  define('ERROR_PLEASE_SELECT_AUDIENCE','Error: veuillez s&eacute;lectionner une audience pour cette newsletter');
  define('ERROR_REMOVE_UNLOCKED_NEWSLETTER', 'Erreur: veuillez verrouiller la newsletter avant effacement.');
  define('ERROR_EDIT_UNLOCKED_NEWSLETTER', 'Erreur: veuillez verrouiller la newsletter avant &eacute;dition.');
  define('ERROR_SEND_UNLOCKED_NEWSLETTER', 'Erreur: veuillez verrouiller la newsletter avant envoi.');
?>