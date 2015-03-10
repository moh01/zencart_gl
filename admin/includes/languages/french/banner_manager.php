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
//  $Id: banner_manager.php 3131 2006-03-07 22:53:04Z ajeh $
//

  define('HEADING_TITLE', 'Gestionnaire de Banni&egrave;res');

  define('TABLE_HEADING_BANNERS', 'Banni&egrave;res');
  define('TABLE_HEADING_GROUPS', 'Groupes');
  define('TABLE_HEADING_STATISTICS', 'Affichages / Clics');
  define('TABLE_HEADING_STATUS', 'Statut');
  define('TABLE_HEADING_BANNER_OPEN_NEW_WINDOWS','Nouvelle Fen&ecirc;tre');
  define('TABLE_HEADING_BANNER_ON_SSL', 'Afficher en SSL');
  define('TABLE_HEADING_ACTION', 'Action');
  define('TABLE_HEADING_BANNER_SORT_ORDER', 'Classement');

  define('TEXT_BANNERS_TITLE', 'Titre de la Banni&egrave;re:');
  define('TEXT_BANNERS_URL', 'URL de la Banni&egrave;re:');
  define('TEXT_BANNERS_GROUP', 'Groupe de Banni&egrave;res:');
  define('TEXT_BANNERS_NEW_GROUP', ', ou entrez un nouveau groupe');
  define('TEXT_BANNERS_IMAGE', 'Image ');
  define('TEXT_BANNERS_IMAGE_LOCAL', ', ou indiquez un fichier local ');
  define('TEXT_BANNERS_IMAGE_TARGET', 'Image cible [sauvegarde]:');
  define('TEXT_BANNER_IMAGE_TARGET_INFO', '<strong>Suggestion R&eacute;pertoire Cible:</strong> ' . DIR_FS_CATALOG_IMAGES . 'banners/');
define('TEXT_BANNERS_HTML_TEXT_INFO', '<strong>NOTE: Les banni&egrave;res HTML n \'enregistrent pas les clics sur la banni&egrave;re </strong>');
  define('TEXT_BANNERS_HTML_TEXT', 'Texte HTML:');
  define('TEXT_BANNERS_ALL_SORT_ORDER', 'Classement - banner_box_all');
define('TEXT_BANNERS_ALL_SORT_ORDER_INFO', '<strong>NOTE: La banni&egrave;re sidebox all va afficher les banni&egrave;res dans un ordre difini</strong>');
  define('TEXT_BANNERS_EXPIRES_ON', 'Expire le:');
  define('TEXT_BANNERS_OR_AT', ', ou &agrave;');
  define('TEXT_BANNERS_IMPRESSIONS', 'impressions/vues.');
  define('TEXT_BANNERS_SCHEDULED_AT', 'Planifi&eacute; le:');
  define('TEXT_BANNERS_BANNER_NOTE', '<b>Notes sur les Banni&egrave;res:</b><ul><li>utilisez une image ou du texte HTML pour la banni&egrave;re mais pas les deux en m&ecirc;me temps.</li><li>Le texte HTML a priorit&eacute; sur l\'image</li></ul>');
  define('TEXT_BANNERS_INSERT_NOTE', '<b>Notes sur les Images:</b><ul><li>le r&eacute;pertoire de destination lors de l\'upload doit avoir les bonnes permissions !</li><li>Ne remplissez pas la cible de l\'image (\'Save To\') si vous ne t&eacute;l&eacute;chargez pas d\'image (si vous utilisez une image d&eacute;ja pr&eacute;sente).</li><li>La cible de l\'image (\'Save To\') doit pointer sur un r&eacute;pertoire existant et le slash de fin doit &ecirc;tre pr&eacute;sent (ex., banners/).</li></ul>');
  define('TEXT_BANNERS_EXPIRCY_NOTE', '<b>Notes sur la date d\'Expiration:</b><ul><li>seul un devrait &ecirc;tre renseign&eacute;</li><li>SI vous ne d&eacute;sirez pas faire figurer de date d\'expiration automatique de la banni&egrave;re, laissez ces deux champs vides</li></ul>');
  define('TEXT_BANNERS_SCHEDULE_NOTE', '<b>Notes sur la Planification:</b><ul><li>si la date de planification est pr&eacute;cis&eacute;e, la banni&egrave;re sera affich&eacute;e &agrave; partir de cette date.</li><li>Toutes las banni&egrave;res planifi&eacute;es seront inactives jusqu\'alors.</li></ul>');
  define('TEXT_BANNERS_STATUS', 'Statut de la Banni&egrave;re:');
  define('TEXT_BANNERS_ACTIVE', 'Actif');
  define('TEXT_BANNERS_NOT_ACTIVE', 'Inactif');
  define('TEXT_INFO_BANNER_STATUS', '<strong>NOTE:</strong> le statut de la Banni&egrave;re sera actualis&eacute;e selon la date de planification et les Impresssions');
  define('TEXT_BANNERS_OPEN_NEW_WINDOWS', 'Banni&egrave;re en nouvelle fen&ecirc;tre');
  define('TEXT_INFO_BANNER_OPEN_NEW_WINDOWS', '<strong>NOTE:</strong> la Banni&egrave;re s\'ouvrira dans une nouvelle fen&ecirc;tre');
  define('TEXT_BANNERS_ON_SSL', 'Banni&egrave;re en SSL');
  define('TEXT_INFO_BANNER_ON_SSL', '<strong>NOTE:</strong> la Banni&egrave;re peut s\'afficher sur des Pages s&eacute;curis&eacute;es, sans g&eacute;n&eacute;rer d\'erreurs');

  define('TEXT_BANNERS_DATE_ADDED', 'Date d\'Ajout:');
  define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Planifi&eacute; le: <b>%s</b>');
  define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Expire le: <b>%s</b>');
  define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Expire apr&egrave;s: <b>%s</b> impressions');
  define('TEXT_BANNERS_STATUS_CHANGE', 'Changement de Statut: %s');

  define('TEXT_BANNERS_DATA', 'D<br>A<br>T<br>A');
  define('TEXT_BANNERS_LAST_3_DAYS', '3 Derniers Jours');
  define('TEXT_BANNERS_BANNER_VIEWS', 'Banni&egrave;res Vues');
  define('TEXT_BANNERS_BANNER_CLICKS', 'Clics Banni&egrave;res');

  define('TEXT_INFO_DELETE_INTRO', 'Etes-vous certain de vouloir effacer cette Banni&egrave;re ?');
  define('TEXT_INFO_DELETE_IMAGE', 'Effacer l\'Image de la Banni&egrave;re');

  define('SUCCESS_BANNER_INSERTED', 'Succ&egrave;s: la Banni&egrave;re a &eacute;t&eacute; ins&eacute;r&eacute;.');
  define('SUCCESS_BANNER_UPDATED', 'Succ&egrave;s: la Banni&egrave;re a &eacute;t&eacute; actualis&eacute;e.');
  define('SUCCESS_BANNER_REMOVED', 'Succ&egrave;s: la Banni&egrave;re a &eacute;t&eacute; effac&eacute;e.');
  define('SUCCESS_BANNER_STATUS_UPDATED', 'Succ&egrave;s: le statut de la Banni&egrave;re a &eacute;t&eacute; actualis&eacute;.');

  define('ERROR_BANNER_TITLE_REQUIRED', 'Erreur: titre de Banni&egrave;re requis.');
  define('ERROR_BANNER_GROUP_REQUIRED', 'Erreur: groupe de Banni&egrave;re requis.');
  define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Erreur: le r&eacute;pertoire cible %s inexistant');
  define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Erreur: le r&eacute;pertoire cible n\'est pas inscriptible: %s');
  define('ERROR_IMAGE_DOES_NOT_EXIST', 'Erreur: l\'Image est inexistante.');
  define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Erreur: l\'Image ne peut &ecirc;tre effac&eacute;e.');
  define('ERROR_UNKNOWN_STATUS_FLAG', 'Erreur: statut de Drapeau inconnu.');
  define('ERROR_BANNER_IMAGE_REQUIRED', 'Erreur: Image de Banni&egrave;re requise.');

  define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Erreur: le r&eacute;pertoire de Graphs n\'existe pas. Veuillez cr&eacute;er un r&eacute;pertoire de Graphs du type: <strong>' . DIR_WS_ADMIN . 'images/graphs</strong>');
  define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Erreur: le r&eacute;pertoire de Graphs n\'est pas inscriptible. Il est situ&eacute; dans: <strong>' . DIR_WS_ADMIN . 'images/graphs</strong>');

  define('TEXT_LEGEND_BANNER_ON_SSL', 'Affichage SSL');
  define('TEXT_LEGEND_BANNER_OPEN_NEW_WINDOWS', 'Nouvelle Fen&ecirc;tre');

// Tooltip Text for images in Banner Manager
  define('IMAGE_ICON_BANNER_OPEN_NEW_WINDOWS_ON','Ouvrir Nouvelle Fen&ecirc;tre - Activ&eacute;');
  define('IMAGE_ICON_BANNER_OPEN_NEW_WINDOWS_OFF','Ouvrir Nouvelle Fen&ecirc;tre - D&eacute;sactiv&eacute;');
  define('IMAGE_ICON_BANNER_ON_SSL_ON','Afficher sur Pages S&eacute;curis&eacute;es - Activ&eacute;');
  define('IMAGE_ICON_BANNER_ON_SSL_OFF','Afficher sur Pages S&eacute;curis&eacute;es - D&eacute;sactiv&eacute;');

define('SUCCESS_BANNER_OPEN_NEW_WINDOW_UPDATED', 'Succ&egrave;s : Le statut de la banni&egrave;re &agrave; s\'ouvrir dans une nouvelle fen&ecirc;tre a &eacute;t&eacute; mis &agrave; jour.');
define('SUCCESS_BANNER_ON_SSL_UPDATED', 'Succ&egrave;s : Le statut de la banni&egrave;re &agrave; montrer sur le SSL a &eacute;t&eacute; mis &agrave; jour.');
?>