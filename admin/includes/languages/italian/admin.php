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
//  $Id: admin.php 1105 2005-04-04 22:05:35Z Albigin $
//

define('HEADING_TITLE', 'Settaggi Amministratore');

define('TABLE_HEADING_ADMINS_NAME', 'Nome Admin');
define('TABLE_HEADING_ADMINS_ID', 'ID');
define('TABLE_HEADING_ADMINS_EMAIL', 'Email');
define('TABLE_HEADING_ACTION', 'Azione');

define('TEXT_HEADING_NEW_ADMIN', 'Nuovo');
define('TEXT_HEADING_EDIT_ADMIN', 'Modifica');
define('TEXT_HEADING_DELETE_ADMIN', 'Cancella');
define('TEXT_HEADING_RESET_PASSWORD', 'Resetta Password');

define('TEXT_ADMINS', 'Amministratori:');
define('TEXT_ADMINS_EMAIL', 'Email:');

define('TEXT_NEW_INTRO', 'Inserire le seguenti info sul nuovo admin');
define('TEXT_EDIT_INTRO', 'Effettuare le modifiche necessarie');

define('TEXT_ADMINS_NAME', 'Nome Admin:');
define('TEXT_ADMINS_PASSWORD', 'Password:');
define('TEXT_ADMINS_CONFIRM_PASSWORD', 'Conferma Password:');

define('TEXT_DELETE_INTRO', 'Davvero vuoi cancellare questo Admin?');
define('TEXT_DELETE_IMAGE', 'Cancellare immagine Admin?');


define('ENTRY_PASSWORD_NEW_ERROR', 'La nuova Password deve avere almeno ' . ENTRY_PASSWORD_MIN_LENGTH . ' caratteri.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'La Password di conferma deve essere uguale alla tua nuova Password.');

define('TEXT_ADMINS_LEVEL','Livello di Admin per questo login:');
define('TEXT_ADMIN_LEVEL_INSTRUCTIONS','Settando a 1 il livello si potr&agrave; sovrascrivere l\'Admin di Demo quando attivo. Solo il livello 1 pu&ograve; controllare la Demo.');
define('TEXT_ADMIN_DEMO','

L\'opzione Admin Demo modifica la funzionali&agrave; completa di Amministratore in una semi-funzionali&agrave; meno distruttiva nel caso si voglia attivare una versione di Zen Cart Dimostrativa per il pannello. Loggandosi come Admin a Livello 1 sar&agrave; possibile modificare il settaggio.<br />Assicurarsi PRIMA di attivare tale settaggio di avere un\'accesso Admin completo ossia posto a livello 1!');
define('TEXT_DEMO_STATUS','L\'attuale Admin di Demo &egrave; impostato a:');
define('TEXT_DEMO_OFF','Off');
define('TEXT_DEMO_ON','On');
?>