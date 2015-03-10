<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                                 |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: store_manager.php 2634 2006-10-04 17:52:04Z spike00 $
//
//
  define('HEADING_TITLE', 'Gestore Negozio');
  define('TABLE_CONFIGURATION_TABLE', 'Ricerca COSTANTI e Definizioni');

  define('SUCCESS_PRODUCT_UPDATE_SORT_ALL', '<strong>Effettuato</strong> aggiornamento elenco valori dei Additivi Prodotti');
  define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_PRICE_SORTER', '<strong>Effettuato</strong> aggiornamento elenco valori dei Prezzi Prodotti');
  define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_VIEWED', '<strong>Effettuato</strong> aggiornamento vista Prodotti a 0');
  define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_ORDERED', '<strong>Effettuato</strong> aggiornamento ordini Prodotti a 0');
  define('SUCCESS_UPDATE_ALL_MASTER_CATEGORIES_ID', '<strong>Effettuato</strong> aggiornamento di tutte le Categorie Master Prodotti Linkati');
  define('SUCCESS_UPDATE_COUNTER', '<strong>Effettuato</strong> aggiornamento Contatore al: ');
  define('SUCCESS_CLEAN_ADMIN_ACTIVITY_LOG', '<strong>Aggiornamento con successo</strong> del Log Attivit&agrave; Amministratore');

  define('ERROR_CONFIGURATION_KEY_NOT_FOUND', '<strong>Errore:</strong> Non sono state trovate Chiavi di Configurazione corrispondenti...');
  define('ERROR_CONFIGURATION_KEY_NOT_ENTERED', '<strong>Errore:</strong> Non sono state inserite Chiavi di Configurazione o Testo da ricercare... Ricerca terminata');

  define('TEXT_INFO_COUNTER_UPDATE', '<strong>Resetta Contatore</strong><br />ad un nuovo Valore: ');
  define('TEXT_INFO_PRODUCTS_PRICE_SORTER_UPDATE', '<strong>Resetta elenco valori di TUTTI i Prezzi Prodotti</strong><br />per potere elecare con i prezzi visualizzati : ');
  define('TEXT_INFO_PRODUCTS_VIEWED_UPDATE', '<strong>Resetta TUTTI i Prodotti Visualizzati</strong><br />Resetta il Contatore Prodotti Visualizzati a 0: ');
  define('TEXT_INFO_PRODUCTS_ORDERED_UPDATE', '<strong>Resetta TUTTI i Prodotti Ordinati</strong><br />Resetta il Contatore Prodotti Ordinati a 0: ');
  define('TEXT_INFO_MASTER_CATEGORIES_ID_UPDATE', '<strong>Resetta TUTTE le Categorie Master Prodotti ID</strong><br />da utilizzare per i prodotti Linkati: ');
  define('TEXT_INFO_ADMIN_ACTIVITY_LOG', '<strong>Vuota Tabella attivit&agrave; di Admin dal database<br />ATTENZIONE: effettuare backup del database prima di procedere!</strong><br />Activity Log &egrave; un metodo che registra le attivit&agrave; dell\'Admin.  Data la natura pu&ograve; diventare molto grande, poco veloce e deve essere pulito di tanto in tanto.<br />Avvertimenti verranno dati a 50,000 registrazioni oppure 60 giorni.');

  define('TEXT_ORDERS_ID_UPDATE', '<strong>Resetta ID attuale Ordine</strong>');
  define('TEXT_INFO_ORDERS_ID_UPDATE', '<strong>NOTA: Prima di aggiornare il Numero Ordine attuale...</strong><br /><br />Prima Crea un ordine di prova. Poi, usando questo Numero Ordine di Prova completa le informazioni qui sotto.<br />Il nuovo Numero Ordine per il successivo Ordine Reale deve essere inserito come 1 in meno di quello che dovr&agrave; usare il tuo Numero Ordine.<br /><strong>Esempio:</strong> Se desideri che il tuo prossimo Numero Ordine sia 1225, inserisci il numero 1224<br /><br /><strong>ATTENZIONE:</strong> E\' possibile reimpostare il Numero Ordine in avanti, non indietro.<br />Perci&ograve; se il tuo numero ordine &egrave; 25, impostandolo a 20, il numero ordine successivo sar&agrave; 26.');
  define('TEXT_OLD_ORDERS_ID', 'Vecchio Numero Ordine');
  define('TEXT_NEW_ORDERS_ID', 'Nuovo Numero Ordine');

  define('TEXT_CONFIGURATION_CONSTANT', '<strong>Ricerca COSTANTI o definizioni Files di Lingua</strong>');
  define('TEXT_CONFIGURATION_KEY', 'Chiave o Nome:');
  define('TEXT_INFO_CONFIGURATION_UPDATE', '<strong>NOTA:</strong> Le COSTANTI sono scritte in maiuscolo.<br />Le ricerche nei File di Lingua possono essere una ricerca alternativa quando non &egrave; stato trovato niente nelle tabelle del database.');


  define('TEXT_CONFIGURATION_CONSTANT_FILES', '<strong>Ricerca nelle definizioni Files di Lingua</strong>');
  define('TEXT_CONFIGURATION_KEY_FILES', 'Testo di Ricerca:');
  define('TEXT_INFO_CONFIGURATION_UPDATE_FILES', '<strong>NOTA:</strong> Il file di lingua pu&ograve; essere in maiuscolo o minuscolo');

  define('TABLE_TITLE_KEY', '<strong>Chiave:</strong>');
  define('TABLE_TITLE_TITLE', '<strong>Titolo:</strong>');
  define('TABLE_TITLE_DESCRIPTION', '<strong>Descrizione:</strong>');
  define('TABLE_TITLE_GROUP', '<strong>Gruppo:</strong>');
  define('TABLE_TITLE_VALUE', '<strong>Valore:</strong>');

  define('TEXT_LANGUAGE_LOOKUPS', 'Ricerche nei Files di Lingua:');
  define('TEXT_LANGUAGE_LOOKUP_NONE', 'Nessuno');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_LANGUAGE', 'Tutti i Files di Lingua in ' . strtoupper($_SESSION['language']) . ' - Catalog/Admin');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG', 'Tutti i Principali Files di Lingua - Catalog (' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . 'english.php /italian.php etc.)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG_TEMPLATE', 'Tutti i Files di Lingua attualmente selezionati - ' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN', 'Tutti i Principali Files di Lingua - Admin (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . 'english.php /italian.php etc.)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN_LANGUAGE', 'Tutti i Files di Lingua attualmente selezionati - Admin (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ALL', 'Tutti i Files di Lingua attualmente selezionati - Catalog/Admin');

  define('TEXT_INFO_NO_EDIT_AVAILABLE','Modifica non disponibile');
  define('TEXT_INFO_CONFIGURATION_HIDDEN', ' o, NASCOSTO');

  define('TEXT_INFO_DATABASE_OPTIMIZE', '<strong>Ottimizza il Database</strong> per recuperare spazio dovuto ai records eliminati.<br />In certi casi (numero elevato di operazioni) pu&ograve; essere utile effettuare questa operazione una volta al mese o anche una volta alla settimana.<br />(Preferibilmente eseguire questa operazione in tempi morti.)');
  define('SUCCESS_DB_OPTIMIZE', 'Ottimizzazione Database - Tabelle processate: ');

?>