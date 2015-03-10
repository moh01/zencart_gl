<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: email_extras.php 3166 2006-03-11 02:45:51Z drbyte $
 */

// office use only
  define('OFFICE_FROM','<strong>De:</strong>');
  define('OFFICE_EMAIL','<strong>E-mail:</strong>');

  define('OFFICE_SENT_TO','<strong>A:</strong>');
  define('OFFICE_EMAIL_TO','<strong>E-mail:</strong>');

  define('OFFICE_USE','<strong>Infos Usage Bureau</strong>');
  define('OFFICE_LOGIN_NAME','<strong>Identifiant:</strong>');
  define('OFFICE_LOGIN_EMAIL','<strong>E-mail de Connexion:</strong>');
  define('OFFICE_LOGIN_PHONE','<strong>Telephone:</strong>');
  define('OFFICE_IP_ADDRESS','<strong>Adresse IP:</strong>');
  define('OFFICE_HOST_ADDRESS','<strong>Adresse du serveur:</strong>');
  define('OFFICE_DATE_TIME','<strong>Date:</strong>');
//  define('OFFICE_IP_TO_HOST_ADDRESS', 'OFF');

// email disclaimer
  define('EMAIL_DISCLAIMER', '');
  define('EMAIL_SPAM_DISCLAIMER','');
  define('EMAIL_FOOTER_COPYRIGHT','');

// email advisory for all emails customer generate - tell-a-friend and GV send
  define('EMAIL_ADVISORY', '');

// email advisory included warning for all emails customer generate - tell-a-friend and GV send
  define('EMAIL_ADVISORY_INCLUDED_WARNING', '<strong>Ce message figure dans les E-Mails provenant du site</strong>');


// Admin additional email subjects
  define('SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO_SUBJECT','[CREATION DE COMPTE]');
  define('SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO_SUBJECT','[INFORMER UN AMI]');
  define('SEND_EXTRA_GV_CUSTOMER_EMAILS_TO_SUBJECT','[CHEQUE CADEAU CLIENT ENVOYE]');
  define('SEND_EXTRA_NEW_ORDERS_EMAILS_TO_SUBJECT','[NOUVELLE COMMANDE]');
  define('SEND_EXTRA_CC_EMAILS_TO_SUBJECT','[INFO DE COMMANDE EXTRA CC] #');

// Low Stock Emails
  define('EMAIL_TEXT_SUBJECT_LOWSTOCK','Attention: Stock Minimum');
  define('SEND_EXTRA_LOW_STOCK_EMAIL_TITLE','Stock Minimum: ');

// for when gethost is off
 define('OFFICE_IP_TO_HOST_ADDRESS', 'D&eacute;activ&eacute;');
?>