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
//  $Id: featured.php 1105 2006-10-04 17:32:35Z spike00 $
//

define('HEADING_TITLE', 'Prodotti in Vetrina');

define('TABLE_HEADING_PRODUCTS', 'Prodotti');
define('TABLE_HEADING_PRODUCTS_MODEL','Modello');
define('TABLE_HEADING_PRODUCTS_PRICE', 'Prodotti Prezzi Vendita Promozione');
define('TABLE_HEADING_PRODUCTS_PERCENTAGE','Percentuale');
define('TABLE_HEADING_AVAILABLE_DATE', 'Disponibile');
define('TABLE_HEADING_EXPIRES_DATE','Scade');
define('TABLE_HEADING_STATUS', 'Stato');
define('TABLE_HEADING_ACTION', 'Azione');

define('TEXT_FEATURED_PRODUCT', 'Prodotto:');
define('TEXT_FEATURED_EXPIRES_DATE', 'Scade il:');
define('TEXT_FEATURED_AVAILABLE_DATE', 'Disponibile dal:');

define('TEXT_INFO_DATE_ADDED', 'Inserito il:');
define('TEXT_INFO_LAST_MODIFIED', 'Ultima Modifica:');
define('TEXT_INFO_NEW_PRICE', 'Nuovo Prezzo:');
define('TEXT_INFO_ORIGINAL_PRICE', 'Prezzo Originale:');
define('TEXT_INFO_PERCENTAGE', 'Percentuale:');
define('TEXT_INFO_AVAILABLE_DATE', 'Disponibile il:');
define('TEXT_INFO_EXPIRES_DATE', 'Scade il:');
define('TEXT_INFO_STATUS_CHANGE', 'Stato Cambio:');
define('TEXT_IMAGE_NONEXISTENT', 'Immagine non esistente');

define('TEXT_INFO_HEADING_DELETE_FEATURED', 'Canc. Prod. Vetrina');
define('TEXT_INFO_DELETE_INTRO', 'Davvero vuoi cancellare il prodotto in vetrina?');

define('SUCCESS_FEATURED_PRE_ADD', 'Successo: Pre-agg. prodotto in vetrina ... aggiorna i dati ...');
define('WARNING_FEATURED_PRE_ADD_EMPTY', 'Attenzione: ID Prodotto non specificato ... nessuna azione effettuata ...');
define('WARNING_FEATURED_PRE_ADD_DUPLICATE', 'Attenzione: ID Prodotto gi&agrave; presente ... nessuna azione effettuata ...');
define('TEXT_INFO_HEADING_PRE_ADD_FEATURED', 'Aggiungi manualmente Prodotti in vetrina mediante ID Prodotto');
define('TEXT_INFO_PRE_ADD_INTRO', 'Se hai molti prodotti, potresti voler aggiungere manualmente Prodotti in Vetrina specificando l\'ID Prodotto<br /><br />Questa &egrave; la soluzione migliore quando la pagina impiega troppo tempo a caricarsi e selezionare un prodotto dal dropdown diventa difficle a causa del numero elevato di prodotti tra cui scegliere.');
define('TEXT_PRE_ADD_PRODUCTS_ID', 'Inserisci l\'ID Prodotto da aggiungere come prodotto in vetrina: ');
define('TEXT_INFO_MANUAL', 'ID Prodotto da aggiungere come prodotto in vetrina');
?>