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
//  $Id: products_to_categories.php 2909 2006-01-29 21:29:35Z ajeh $
//

define('HEADING_TITLE','Manager de Lien Produits vers Cat&eacute;gories Multiples...');
define('HEADING_TITLE2','Cat&eacute;gories / Produits');

define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_AVAILABLE', 'Cat&eacute;gories dont les Produits sont disponibles pour un Lien...');

define('TABLE_HEADING_PRODUCTS_ID', 'Prod ID');
define('TABLE_HEADING_PRODUCT', 'Produit Name');
define('TABLE_HEADING_MODEL', 'Mod&egrave;le');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_INFO_HEADING_EDIT_PRODUCTS_TO_CATEGORIES', 'EDITING PRODUCT TO CATEGORIES INFORMATION');
define('TEXT_PRODUCTS_ID', 'Produit ID# ');
define('TEXT_PRODUCTS_NAME', 'Produit: ');
define('TEXT_PRODUCTS_MODEL', 'Mod&egrave;le: ');
define('TEXT_PRODUCTS_PRICE', 'Prix: ');
define('BUTTON_UPDATE_CATEGORY_LINKS', 'Actualisation des Liens de Cat&eacute;gorie');
define('BUTTON_NEW_PRODUCTS_TO_CATEGORIES', 'S&eacute;lectionner un Produit &agrave; Lier');
define('TEXT_SET_PRODUCTS_TO_CATEGORIES_LINKS', 'R&eacute;gler un Produit vers Liens de Cat&eacute;gories pour: ');
define('TEXT_INFO_LINKED_TO_COUNT', '&nbsp;&nbsp;Nombre Actuel de Cat&eacute;gories Li&eacute;es: ');

define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_LINKER_INTRO',
'L\'Outil Liens Produits vers Cat&eacute;gories permet de lier un Produit &agrave; une ou plusieurs Cat&eacute;gories.<br />Il est possible de lier tous les Produits d\'une Cat&eacute;gorie &agrave; une autre ou d\'enlever des Produits Li&eacute;s d\'une Cat&eacute;gorie vers une autre Cat&eacute;gorie(instructions ci-dessous)');

define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_LINKER',
'Pour la gestion des prix, chaque Produit requiert une Cat&eacute;gorie Master, quel que soit le nombre de Cat&eacute;gories auquel il est rattach&eacute;. Cette op&eacute;ration est r&eacute;alis&eacute;e par le Dropdown de Master Cat&eacute;gorie.<br />
Le Produit est acctuellement li&eacute; &agrave; la Cat&eacute;gorie ou des Cat&eacute;gories qui sont s&eacute;lectionn&eacute;es. Pour ajouter une Nouvelle Cat&eacute;gorie ou des Cat&eacute;gories, cochez le checkbox voisin du nom de la Cat&eacute;gorie. Pour effacer une Cat&eacute;gorie Li&eacute;e ou des Cat&eacute;gories, d&eacute;cochez le checkbox voisin du nom de la Cat&eacute;gorie.<br />
Lorsque vous avez coch&eacute; toutes les Cat&eacute;gories auxquelles vous souhaitez lier le Produit, pressez ' . BUTTON_UPDATE_CATEGORY_LINKS . '<br />'
);

define('HEADER_CATEGORIES_GLOBAL_CHANGES', 'Changements de Lien de Cat&eacute;gorie Globale et ID de Cat&eacute;gorie Master - Remise &agrave; z&eacute;ro');

define('TEXT_SET_MASTER_CATEGORIES_ID', '<strong>WARNING:</strong> You must set the MASTER CATEGORIES ID before changing Linked Categories');

// copy category to category linked
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>Copier TOUS les Produits dans une Cat&eacute;gorie en tant que Produits LIES &agrave; une autre Cat&eacute;gorie ...</strong><br />Exemple: indiquer 8 et 22 lierait TOUS les Produits de la Cat&eacute;gorie 8 &agrave; la Cat&eacute;gorie 22');
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'S&eacute;lectionner Tous les Produits dans la Cat&eacute;gorie: ');
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Lier &agrave; la Cat&eacute;gorie: ');
define('BUTTON_COPY_CATEGORY_LINKED', 'Copier les Produits en tant que Produits Li&eacute;s ');

define('WARNING_PRODUCTS_LINK_TO_CATEGORY_REMOVED', 'Attention: Le produit a &eacute;t&eacute; remis &agrave; z&eacute;ro et n\'est plus une partie de cette cat&eacute;gorie...');  
define('WARNING_COPY_LINKED', 'ATTENTION: ');
define('WARNING_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Cat&eacute;gorie Invalide pour Lier des Produits Depuis: ');
define('WARNING_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Cat&eacute;gorie Invalide pour Lier des Produits Vers: ');
define('SUCCESS_COPY_LINKED', 'Actualisation R&eacute;ussie des Produits en tant que Produits Li&eacute;s... ');
define('SUCCESS_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Cat&eacute;gorie Valide pour Lier des Produits Depuis: ');
define('SUCCESS_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Cat&eacute;gorie Valide pour Lier des Produits Vers: ');   

define('WARNING_COPY_FROM_IN_TO_LINKED', '<strong>ATTENTION: aucun changement de Produit d&eacute;j&agrave; Li&eacute;... </strong>');

// remove category to category linked
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>Effacer TOUS les Produits d\'une Cat&eacute;gorie qui sont des Produits LIES &agrave; une autre Cat&eacute;gorie...</strong><br />Exemple: indiquer 8 et 22 d&eacute;lierait TOUS les Produits de la Cat&eacute;gorie 8 de la Cat&eacute;gorie 22');
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'S&eacute;lectionner TOUS les Produits de la Cat&eacute;gorie: ');
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Effacement des Produits en tant que li&eacute;s &agrave; une Cat&eacute;gorie: ');
define('BUTTON_REMOVE_CATEGORY_LINKED', 'Effacer les Produits en tant que Produits Li&eacute;s ');

define('WARNING_REMOVE_LINKED', 'ATTENTION: ');
define('WARNING_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Cat&eacute;gorie Invalide pour Effacement des Produits Li&eacute;s Depuis: ');
define('WARNING_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Cat&eacute;gorie Invalide pour Effacement des Produits Li&eacute;s &agrave; un  Vers: ');
define('SUCCESS_REMOVE_LINKED', 'Les Produits Li&eacute;s ont &eacute;t&eacute; Effac&eacute;s avec Succ&egrave;s... ');
define('SUCCESS_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Cat&eacute;gorie Valide pour Effacement des Produits Li&eacute;s Depuis: ');
define('SUCCESS_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Cat&eacute;gorie Valide pour Effacement des Produits Li&eacute;s &agrave; un  Vers: ');

define('WARNING_REMOVE_FROM_IN_TO_LINKED', '<strong>ATTENTION: aucun changement car aucun produit li&eacute;... </strong>');

define('WARNING_MASTER_CATEGORIES_ID_CONFLICT', '<strong>ATTENTION: CONFLIT ID de CATEGORIES MASTER ! </strong>');
define('TEXT_INFO_MASTER_CATEGORIES_ID_CONFLICT', '<strong>ID de Cat&eacute;gories Master: </strong>');
define('TEXT_INFO_MASTER_CATEGORIES_ID_PURPOSE', 'NOTE: la Cat&eacute;gorie Master est utilis&eacute;e pour des consid&eacute;rations de prix lorsque la Cat&eacute;gorie du Produit affecte le Priix des Produits Li&eacute;s, exemple: Ventes<br />');
define('WARNING_MASTER_CATEGORIES_ID_CONFLICT_FIX', 'Pour solutionner ce conflit, vous &ecirc;tes redirig&eacute; vers le premier Produit du conflit. R&eacute;-assignez l\'ID de Cat&eacute;gories Master afin qu\'il ne figure plus en tant qu\'ID de Cat&eacute;gorie Master pour la Cat&eacute;gorie dont vous voulez l\'effacer, et recommencez. Lorsque tous les conflits seront corrig&eacute;s, vousn pourrez alors r&eacute;aliser les effacements que vous souhaitez op&eacute;rer.');
define('TEXT_MASTER_CATEGORIES_ID_CONFLICT_FROM', ' Conflit Depuis Cat&eacute;gorie: ');
define('TEXT_MASTER_CATEGORIES_ID_CONFLICT_TO', ' Conflit Vers Cat&eacute;gorie: ');
define('SUCCESS_MASTER_CATEGORIES_ID', 'Actualisation R&eacute;ussie de Produit vers Liens de Cat&eacute;gories...');
define('WARNING_MASTER_CATEGORIES_ID', 'ATTENTION: aucune Cat&eacute;gorie Master s&eacute;lectionn&eacute;e !');

define('TEXT_PRODUCTS_ID_INVALID', 'ATTENTION: ID DE PRODUITS INVALIDES OU AUCUNE SELECTION DE PRODUIT');
define('TEXT_PRODUCTS_ID_NOT_REQUIRED', 'Note: Un ID de Produit n\'est pas indispensable pour utiliser la fonction Lier Tous les Produits d\'une Cat&eacute;gorie &agrave; une autre Cat&eacute;gorie.<br />Cependant, le fait de d&eacute;finir un ID Produits affichera les Cat&eacute;gories Disponibles et leurs ID respectifs.');

// reset all products to new master_categories_id
// copy category to category linked
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_MASTER', '<strong>Remettre &agrave; z&eacute;ro TOUS les Produits de la Cat&eacute;gorie s&eacute;lectionn&eacute;e pour utiliser la Cat&eacute;gorie s&eacute;lectionn&eacute;e en tant qu\'ID de Cat&eacute;gories Master...</strong><br />Example: remettre &agrave; z&eacute;ro la Cat&eacute;gorie 22 aurait pour cons&eacute;quence de r&eacute;gler TOUS les Produits de la Cat&eacute;gorie 22 pour qu\'ils utilisent la Cat&eacute;gorie 22 en tant qu\'ID de Cat&eacute;gorie Master');
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'Remettre &agrave; z&eacute;ro l\'ID de Cat&eacute;gories Master pour Tous les Produits dans la Cat&eacute;gorie: ');
define('BUTTON_RESET_CATEGORY_MASTER', 'Remettre &agrave; z&eacute;ro ID de Cat&eacute;gories Master');

define('WARNING_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'ATTENTION: Cat&eacute;gorie Invalide s&eacute;lectionn&eacute;e...');
define('SUCCESS_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'Actualisation R&eacute;ussie de tous les Produits vers Nouvel ID de Cat&eacute;gories Master pour la Cat&eacute;gorie: ');

?>