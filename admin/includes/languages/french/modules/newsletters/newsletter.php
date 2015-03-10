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
//  $Id: newsletter.php 1105 2005-04-04 22:05:35Z birdbrain $
//

  define('TEXT_COUNT_CUSTOMERS', 'Clients abonn&eacute;s &agrave; cette newsletter: %s');
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

  define('TEXT_INFO_DELETE_INTRO', 'Etes-vous certain de vouloir effacer cette newsletter ?');

  define('TEXT_PLEASE_SELECT_AUDIENCE','Veuillez s&eacute;lectionner l\'audience de cette newsletter: ');
  define('TEXT_PLEASE_WAIT', 'Veuillez patienter .. envoi des E-mails ..<br /><br />Veuillez ne pas interrompre le processus !');
  define('TEXT_FINISHED_SENDING_EMAILS', 'Envoi des E-mails termin&eacute; !');

  define('ERROR_NEWSLETTER_TITLE', 'Erreur: titre de Newsletter requis');
  define('ERROR_NEWSLETTER_MODULE', 'Erreur: module de Newsletter requis');
  define('ERROR_REMOVE_UNLOCKED_NEWSLETTER', 'Erreur: veuillez verrouiller la newsletter avant de l\'effacer.');
  define('ERROR_EDIT_UNLOCKED_NEWSLETTER', 'Erreur: veuillez verrouiller la newsletter avant de l\'&eacute;diter.');
  define('ERROR_SEND_UNLOCKED_NEWSLETTER', 'Erreur: veuillez verrouiller la newsletter avant de l\'envoyer.');
?>