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
//  $Id: ezpages.php 2827 2006-01-08 19:46:40Z ajeh $
//
define('HEADING_TITLE', 'EZ-Pages');
define('TABLE_HEADING_PAGES', 'Titre de page');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_VSORT_ORDER', 'Classement Sidebox ');
define('TABLE_HEADING_HSORT_ORDER', 'Classement de pied de page');
define('TEXT_PAGES_TITLE', 'Titre de page:');
define('TEXT_PAGES_HTML_TEXT', 'Centenu HTML:');
define('TABLE_HEADING_DATE_ADDED', 'Date Ajout&eacute;e');
define('TEXT_PAGES_STATUS_CHANGE', 'Changement De Statut: %s');
define('TEXT_INFO_DELETE_INTRO', '&Ecirc;tes-vous s&ucirc;r de supprimer cette page');
define('SUCCESS_PAGE_INSERTED', 'Succ&egrave;s : La page a &eacute;t&eacute; ins&eacute;r&eacute;e.');
define('SUCCESS_PAGE_UPDATED', 'Succ&egrave;s : La page a &eacute;t&eacute; mise &agrave; jour.');
define('SUCCESS_PAGE_REMOVED', 'Succ&egrave;s : La page a &eacute;t&eacute; enlev&eacute;e.');
define('SUCCESS_PAGE_STATUS_UPDATED', 'Succ&egrave;s : Le statut de la page a &eacute;t&eacute; mis &agrave; jour.');
define('ERROR_PAGE_TITLE_REQUIRED', 'Erreur: Titre de page requis.');
define('ERROR_UNKNOWN_STATUS_FLAG', 'Erreur: Drapeau statut inconnu.');
define('ERROR_MULTIPLE_HTML_URL', 'Erreur : vous avez d&eacute;fini plusieurs reglages . D&eacute;finissez seulement l\'un ou l\'autre : Contenu de HTML - ou URL interne de lien - ou URL externe de lien');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_STATUS_HEADER', 'En-tjte:');
define('TABLE_HEADING_STATUS_SIDEBOX', 'Sidebox:');
define('TABLE_HEADING_STATUS_FOOTER', 'Pied de page:');
define('TABLE_HEADING_STATUS_TOC', 'TOC:');
define('TABLE_HEADING_CHAPTER', 'Chapitre:');

define('TABLE_HEADING_PAGE_OPEN_NEW_WINDOW', 'Ouvrez La Nouvelle Fen&ecirc;tre :');
define('TABLE_HEADING_PAGE_IS_SSL', 'La page est SSL:');

define('TEXT_DISPLAY_NUMBER_OF_PAGES', 'Afficher <b>%d</b> &agrave; <b>%d</b> (de <b>%d</b> pages)');
define('IMAGE_NEW_PAGE', 'Nouvelle page');
define('TEXT_INFO_PAGE_IMAGE', 'Image');
define('TEXT_INFO_CURRENT_IMAGE', 'Image Courante:');
define('TEXT_INFO_PAGES_ID', 'ID: ');
define('TEXT_INFO_PAGES_ID_SELECT', 'Choisissez une page ...');

define('TEXT_HEADER_SORT_ORDER', 'Ordre:');
define('TEXT_SIDEBOX_SORT_ORDER', 'Ordre:');
define('TEXT_FOOTER_SORT_ORDER', 'Ordre:');
define('TEXT_TOC_SORT_ORDER', 'Ordre:');
define('TEXT_CHAPTER', 'Prec/Suivant Chapitre:');
define('TABLE_HEADING_CHAPTER_PREV_NEXT', 'Chapitre:&nbsp;<br />');

define('TEXT_HEADER_SORT_ORDER_EXPLAIN', 'Le classement d\'en-t&ecirc;te utilis&eacute; tout en produisant des pages dans la rang&eacute;e simple pour l\'en-t&ecirc;te ; Le classement devrait &ecirc;tre plus grand que z&eacute;ro ');
define('TEXT_SIDEBOX_ORDER_EXPLAIN', 'le classement de Sidebox est utilis&eacute; quand des pages sont &eacute;num&eacute;r&eacute;es dans des liens verticaux, else it will be considered as HTML text for special purposes');
define('TEXT_FOOTER_ORDER_EXPLAIN', 'Footer Sort Order used while generating pages in single row footer; Sort order should be greater than zero to enable this page in the row type listing');
define('TEXT_TOC_SORT_ORDER_EXPLAIN', 'TOC (Table of Contents) Sort Order used while generating pages that are customized as either a single row (header/footer, etc) or vertically, based on individual needs; Sort order should be greater than zero to enable this page in the listing');
define('TEXT_CHAPTER_EXPLAIN', 'Chapters are used with TOC (Table of Contents) Sort Order for the display on Previous/Next. Links in the TOC will consist of pages matching this chapter number, and will be displayed in the TOC Sort Order');

define('TEXT_ALT_URL', 'Lien Interne');
define('TEXT_ALT_URL_EXPLAIN', 'SI Oui, le contenu de la page sera ignor&eacute; et ce lien INTERNE sera utilis&eacute;<br />Exemple aux revues: index.php?main_page=reviews<br />Exemple &agrave; mon compte: index.php?main_page=account et marque comme SSL');

define('TEXT_ALT_URL_EXTERNAL', 'Lien Externe:');
define('TEXT_ALT_URL_EXTERNAL_EXPLAIN', 'Si Oui, Le contenu de la page sera ignor&eacute; et ce lien externe sera utilis&eacute; pour faire le lien<br />Exemple de URL Externe: http://www.zen-cart.com');

define('TEXT_SORT_CHAPTER_TOC_TITLE_INFO', 'Ordre D\'Affichage ');
define('TEXT_SORT_CHAPTER_TOC_TITLE', 'Chapitre/TOC');
define('TEXT_SORT_HEADER_TITLE', 'Header');
define('TEXT_SORT_SIDEBOX_TITLE', 'Sidebox');
define('TEXT_SORT_FOOTER_TITLE', 'Pied de page');
define('TEXT_SORT_PAGE_TITLE', 'Titre de page');
define('TEXT_SORT_PAGE_ID_TITLE', 'Page ID, Titre');

define('TEXT_PAGE_TITLE', 'Titre:');
define('TEXT_WARNING_MULTIPLE_SETTINGS', '<strong>Attention: Plusieurs Liens</strong>');
?>