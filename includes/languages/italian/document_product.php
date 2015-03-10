<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
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
//  $Id: document_product.php 2830 2006-01-10 17:13:18Z Albigin $
//

define('HEADING_TITLE', 'Categorie / Prodotti');
define('HEADING_TITLE_GOTO', 'Vai a:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Categorie / Prodotti');
define('TABLE_HEADING_CATEGORIES_SORT_ORDER', 'Elenca');

define('TABLE_HEADING_PRICE','Prezzi Vendita Promozione');
define('TABLE_HEADING_QUANTITY','Quantit&agrave;');

define('TABLE_HEADING_ACTION', 'Azione');
define('TABLE_HEADING_STATUS', 'Stato');

define('TEXT_CATEGORIES', 'Categorie:');
define('TEXT_SUBCATEGORIES', 'Sottocategorie:');
define('TEXT_PRODUCTS', 'Prodotti:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Prezzo:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Classe Tassa:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Punteggio Medio:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Quantit&agrave;:');
define('TEXT_DATE_ADDED', 'Inserito il:');
define('TEXT_DATE_AVAILABLE', 'Disponibile il:');
define('TEXT_LAST_MODIFIED', 'Ultima Modifica:');
define('TEXT_IMAGE_NONEXISTENT', 'IMMAGINE NON PRESENTE');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Inserire una nuova categoria o un nuovo prodotto a questo livello.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Per ulteriori informazioni visitare la <a href="http://%s" target="blank">pagina web</a> di questo prodotto.');
define('TEXT_PRODUCT_DATE_ADDED', 'Il prodotto &egrave; stato inserito in catalogo il %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Il prodotto sar&agrave; disponibile dal %s.');

define('TEXT_EDIT_INTRO', 'Effettuare le modifiche necessarie');
define('TEXT_EDIT_CATEGORIES_ID', 'ID della Categoria:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Nome Categoria:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Immagine Categoria:');
define('TEXT_EDIT_SORT_ORDER', 'Ordinare:');

define('TEXT_INFO_COPY_TO_INTRO', 'Scegli una categoria nella quale copiare questo prodotto');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Attuali Categorie: ');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Nuova Categoria');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Modifica Categoria');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Cancella Categoria');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Sposta Categoria');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Cancella Prodotto');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Sposta Prodotto');
define('TEXT_INFO_HEADING_COPY_TO', 'Copia in');

define('TEXT_DELETE_CATEGORY_INTRO', 'Davvero vuoi cancellare questa Categoria?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Davvero vuoi cancellare permanentemente questo prodotto?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>AVVISO:</b> Vi sono %s (sotto)categorie ancora linkate a questa Categoria!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>AVVISO:</b> Vi sono %s prodotti ancora linkati a questa Categoria!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Scegliere la categoria in cui si desidera che <b>%s</b> debba collocarsi');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Scegliere la Categoria nella quale si desidera che <b>%s</b> debba collocarsi');
define('TEXT_MOVE', 'Spostare <b>%s</b> in:');

define('TEXT_NEW_CATEGORY_INTRO', 'Inserire le seguenti informazioni riguardanti la nuova Categoria');
define('TEXT_CATEGORIES_NAME', 'Nome Categoria:');
define('TEXT_CATEGORIES_IMAGE', 'Immagine Categoria:');
define('TEXT_SORT_ORDER', 'Elencare:');

define('TEXT_PRODUCTS_STATUS', 'Stato Prodotto:');
define('TEXT_PRODUCTS_VIRTUAL', 'Prodotto Virtuale:');
define('TEXT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', 'Sempre Sped.ne Gratuita:');
define('TEXT_PRODUCTS_QTY_BOX_STATUS', 'Mostra Box Quantit&agrave; Prodotto:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Disponibile dal:');
define('TEXT_PRODUCT_AVAILABLE', 'Disponibile');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Esaurito');
define('TEXT_PRODUCT_IS_VIRTUAL', 'Si, Ignora Indirizzo Sped.ne');
define('TEXT_PRODUCT_NOT_VIRTUAL', 'No, Indirizzo Sped.ne Richiesto');
define('TEXT_PRODUCT_IS_ALWAYS_FREE_SHIPPING', 'Si, Sempre Sped.ne Gratis');
define('TEXT_PRODUCT_NOT_ALWAYS_FREE_SHIPPING', 'No, Regole Normali di Sped.ne');
define('TEXT_PRODUCT_SPECIAL_ALWAYS_FREE_SHIPPING', 'Promozioni, Prod./Download richiedono indirizzo di Spedizione');
define('TEXT_PRODUCTS_SORT_ORDER', 'Ordinare:');

define('TEXT_PRODUCTS_QTY_BOX_STATUS_ON', 'Si, Mostra Box Quantit&agrave;');
define('TEXT_PRODUCTS_QTY_BOX_STATUS_OFF', 'No, non mostrare Box Q.t&agrave;');

define('TEXT_PRODUCTS_MANUFACTURER', 'Fabbricante Prodotto:');
define('TEXT_PRODUCTS_NAME', 'Nome Prodotto:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Descrizione Prodotto:');
define('TEXT_PRODUCTS_QUANTITY', 'Quantit&agrave; Prodotto:');
define('TEXT_PRODUCTS_MODEL', 'Modello Prodotto:');
define('TEXT_PRODUCTS_IMAGE', 'Immagine Prodotto:');
define('TEXT_PRODUCTS_IMAGE_DIR', 'Upload nella cartella:');
define('TEXT_PRODUCTS_URL', 'URL Prodotto:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(senza http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Prezzo Prodotto (Netto):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Prezzo Prodotto (Lordo):');
define('TEXT_PRODUCTS_WEIGHT', 'Peso Prodotto:');

define('EMPTY_CATEGORY', 'Categoria Vuota');

define('TEXT_HOW_TO_COPY', 'Metodo Copia:');
define('TEXT_COPY_AS_LINK', 'Link Prodotto');
define('TEXT_COPY_AS_DUPLICATE', 'Duplicare Prodotto');


// Products and Attribute Copy Options
  define('TEXT_COPY_ATTRIBUTES_ONLY','Usato solo per Prodotti Duplicati ...');
  define('TEXT_COPY_ATTRIBUTES','Copiare Additivi Prodotto da duplicare?');
  define('TEXT_COPY_ATTRIBUTES_YES','Si');
  define('TEXT_COPY_ATTRIBUTES_NO','No');

  define('TEXT_INFO_CURRENT_PRODUCT', 'Prodotto Attuale: ');
  define('TABLE_HEADING_MODEL', 'Modello');

  define('TEXT_INFO_HEADING_ATTRIBUTE_FEATURES','Modifiche Additivi per Prodotti ID# ');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_DELETE','Cancella <strong>TUTTI</strong> gli Additivi Prodotto per:<br />');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO','Copia Additivi in un altro Prodotto o in un\'intera Categoria da:<br />');

  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_PRODUCT','Copia Additivi in un altro <strong>Prodotto</strong> da:<br />');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_CATEGORY','Copia Additivi in un\'altra <strong>Categoria</strong> da:<br />');

  define('TEXT_COPY_ATTRIBUTES_CONDITIONS','<strong>Cosa fare degli Additivi Prodotto esistenti?</strong>');
  define('TEXT_COPY_ATTRIBUTES_DELETE','<strong>Cancella</strong> anzitutto, poi copia nuovi Additivi');
  define('TEXT_COPY_ATTRIBUTES_UPDATE','<strong>Aggiorna</strong> con nuovi settaggi/prezzi, poi aggiungine di nuovi');
  define('TEXT_COPY_ATTRIBUTES_IGNORE','<strong>Ignora</strong> e aggiungi soltanto nuovi Additivi');

  define('SUCCESS_ATTRIBUTES_DELETED','Additivi regolarmente cancellati');
  define('SUCCESS_ATTRIBUTES_UPDATE','Additivi regolarmente aggiornati');

  define('ICON_ATTRIBUTES','Caratteristiche Additivi');

  define('TEXT_CATEGORIES_IMAGE_DIR','Upload nella cartella:');


  define('TEXT_PRODUCTS_QTY_BOX_STATUS_PREVIEW','Avviso: non mostra Box Q.t&agrave;, Default a Q.t&agrave; 1');
  define('TEXT_PRODUCTS_QTY_BOX_STATUS_EDIT','Avviso: non mostra Box Q.t&agrave;, Default a Q.t&agrave; 1');

define('TEXT_PRODUCT_OPTIONS', '<strong>Scegliere:</strong>');
  define('TEXT_PRODUCTS_ATTRIBUTES_INFO','Caratteristiche Additivi per:');
  define('TEXT_PRODUCT_ATTRIBUTES_DOWNLOADS','Downloads: ');

  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES','Prodotto Prezzato con Additivi:');
  define('TEXT_PRODUCT_IS_PRICED_BY_ATTRIBUTE','Si');
  define('TEXT_PRODUCT_NOT_PRICED_BY_ATTRIBUTE','No');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_PREVIEW','*Il prezzo esposto include gli additivi gruppo prezzi pi&ugrave; bassi + il prezzo');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT','*Il prezzo esposto include gli additivi gruppo prezzi pi&ugrave; bassi + il prezzo');

  define('TEXT_PRODUCTS_QUANTITY_MIN_RETAIL','Q.t&agrave; Minima Prodotto:');
  define('TEXT_PRODUCTS_QUANTITY_UNITS_RETAIL','Unit&agrave; di Prodotto:');
  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL','Q.t&agrave; Massima Prodotto:');

  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL_EDIT','0 = Illimitato, 1 = No Box Q.t&agrave;');

  define('TEXT_PRODUCTS_MIXED','Mix Q.t&agrave; Min/Unit&agrave; Prodotto:');

  define('PRODUCTS_PRICE_IS_FREE_TEXT', 'Prodotto Gratuito');
  define('TEXT_PRODUCT_IS_FREE','Prodotto Gratuito:');
  define('TEXT_PRODUCTS_IS_FREE_PREVIEW','*Prodotto marcato GRATIS');
  define('TEXT_PRODUCTS_IS_FREE_EDIT','*Prodotto marcato GRATIS');

  define('TEXT_PRODUCT_IS_CALL','Prodotto Prezzo a Richiesta:');
  define('TEXT_PRODUCTS_IS_CALL_PREVIEW','*Prodotto marcato PREZZO A RICHIESTA');
  define('TEXT_PRODUCTS_IS_CALL_EDIT','*Prodotto marcato PREZZO A RICHIESTA');

  define('TEXT_ATTRIBUTE_COPY_SKIPPING','<strong>Salta Nuovo Additivo </strong>');
  define('TEXT_ATTRIBUTE_COPY_INSERTING','<strong>Inserendo Nuovo Additivo da </strong>');
  define('TEXT_ATTRIBUTE_COPY_UPDATING','<strong>Aggiornando da Additivo </strong>');

// meta tags
  define('TEXT_META_TAG_TITLE_INCLUDES','<strong>Contrassegna come il Meta Tag Titolo deve essere composto:</strong>');
  define('TEXT_PRODUCTS_METATAGS_PRODUCTS_NAME_STATUS','<strong>Nome Prodotto:</strong>');
  define('TEXT_PRODUCTS_METATAGS_TITLE_STATUS','<strong>Titolo:</strong>');
  define('TEXT_PRODUCTS_METATAGS_MODEL_STATUS','<strong>Modello:</strong>');
  define('TEXT_PRODUCTS_METATAGS_PRICE_STATUS','<strong>Prezzo:</strong>');
  define('TEXT_PRODUCTS_METATAGS_TITLE_TAGLINE_STATUS','<strong>Titolo/Tagline:</strong>');
  define('TEXT_META_TAGS_TITLE','<strong>Meta Tag Titolo:</strong>');
  define('TEXT_META_TAGS_KEYWORDS','<strong>Parole chiave Meta Tag Keywords:</strong>');
  define('TEXT_META_TAGS_DESCRIPTION','<strong>Meta Tag Descrizione:</strong>');
  define('TEXT_META_EXCLUDED', '<span class="alert">EXCLUDI</span>');
?>