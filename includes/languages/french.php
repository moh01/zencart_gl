<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: french.php 3260 2006-03-26 00:18:01Z drbyte $
 */

// FOLLOWING WERE moved to meta_tags.php
//define('TITLE', 'fweb!');
//define('SITE_TAGLINE', 'better web by design !');
//define('CUSTOM_KEYWORDS', 'ecommerce, open source, shop, online shopping');
// END: moved to meta_tags.php

  define('FOOTER_TEXT_BODY', 'Copyright &copy; 2003-2006 <a href="http://www.zen-cart.com" target="_blank">Zen Cart</a>. Powered by <a href="http://www.zen-cart.com" target="_blank">Zen Cart</a>');

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat try 'fr_FR'
// on FreeBSD try 'fr_FR.ISO_8859-1'
// on Windows try 'fr', or 'French'
@setlocale(LC_TIME, 'fr_FR.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

////
// Return date in raw format
// $date should be in format dd/mm/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
  if (!function_exists('zen_date_raw')) {
    function zen_date_raw($date, $reverse = false) {
      if ($reverse) {
        return substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 6, 4);
      } else {
        return substr($date, 6, 4) . substr($date, 0, 2) . substr($date, 3, 2);
      }
    }
  }

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'EUR');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="fr"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// footer text in includes/footer.php
  define('FOOTER_TEXT_REQUESTS_SINCE', 'requ&ecirc;tes depuis le');

// Define the name of your Gift Certificate as Gift Voucher, Gift Certificate, Zen Cart Dollars, etc. here for use through out the shop
  define('TEXT_GV_NAME','Ch&egrave;que Cadeau');
  define('TEXT_GV_NAMES','Ch&egrave;ques Cadeaux');

// used for redeem code, redemption code, or redemption id
  define('TEXT_GV_REDEEM','Code');

// text for gender
  define('MALE', 'M.');
  define('FEMALE', 'Mme');
  define('MALE_ADDRESS', 'M.');
  define('FEMALE_ADDRESS', 'Mme');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/aaaa');

//text for sidebox heading links
  define('BOX_HEADING_LINKS', '&nbsp;&nbsp;[+]');

// categories box text in sideboxes/categories.php
  define('BOX_HEADING_CATEGORIES', 'Notre Catalogue');
  
// manufacturers box text in sideboxes/manufacturers.php
  define('BOX_HEADING_MANUFACTURERS', 'Nos Marques');

// whats_new box text in sideboxes/whats_new.php
  define('BOX_HEADING_WHATS_NEW', 'Nouveaut&eacute;s');
  define('CATEGORIES_BOX_HEADING_WHATS_NEW', 'Nouveaut&eacute;s...');

  define('BOX_HEADING_FEATURED_PRODUCTS', 'Coup de Coeur');
  define('CATEGORIES_BOX_HEADING_FEATURED_PRODUCTS', 'Coup de Coeur...');
  define('TEXT_NO_FEATURED_PRODUCTS', 'De Nouveaux Coup de Coeur seront bient&ocirc;t ajout&eacute;s. Nous vous invitons donc &agrave; consulter cette page r&eacute;guli&egrave;rement.');

  define('TEXT_NO_ALL_PRODUCTS', 'De Nouveaux Produits seront bient&ocirc;t ajout&eacute;s. Nous vous invitons donc &agrave; consulter cette page r&eacute;guli&egrave;rement.');
  define('CATEGORIES_BOX_HEADING_PRODUCTS_ALL', 'Tous les Produits...');

// quick_find box text in sideboxes/quick_find.php
  define('BOX_HEADING_SEARCH', 'Recherche');
  define('BOX_SEARCH_ADVANCED_SEARCH', 'Recherche Avanc&eacute;e');

// specials box text in sideboxes/specials.php
  define('BOX_HEADING_SPECIALS', 'Promotions');
  define('CATEGORIES_BOX_HEADING_SPECIALS','Promotions...');

// reviews box text in sideboxes/reviews.php
  define('BOX_HEADING_REVIEWS', 'Avis');
  define('BOX_REVIEWS_WRITE_REVIEW', 'Ecrire un Avis');
  define('BOX_REVIEWS_NO_REVIEWS', 'Aucun Avis actuellement');
  define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s sur 5 &eacute;toiles !');

// shopping_cart box text in sideboxes/shopping_cart.php
  define('BOX_HEADING_SHOPPING_CART', 'Mon Panier');
  define('BOX_SHOPPING_CART_EMPTY', '0 article');
  define('BOX_SHOPPING_CART_DIVIDER', 'ea.-&nbsp;');

// order_history box text in sideboxes/order_history.php
  define('BOX_HEADING_CUSTOMER_ORDERS', 'Historique');

// best_sellers box text in sideboxes/best_sellers.php
  define('BOX_HEADING_BESTSELLERS', 'Best Sellers');
  define('BOX_HEADING_BESTSELLERS_IN', 'Best Sellers dans<br />&nbsp;&nbsp;');

// notifications box text in sideboxes/products_notifications.php
  define('BOX_HEADING_NOTIFICATIONS', 'Notifications');
  define('BOX_NOTIFICATIONS_NOTIFY', 'Me Notifier les Actualisations de <strong>%s</strong>');
  define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'Ne plus Me Notifier les Actualisations de <strong>%s</strong>');

// manufacturer box text
  define('BOX_HEADING_MANUFACTURER_INFO', 'Infos Fabricant');
  define('BOX_MANUFACTURER_INFO_HOMEPAGE', 'Site de %s');
  define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Autres Produits');

// languages box text in sideboxes/languages.php
  define('BOX_HEADING_LANGUAGES', 'Langues');

// currencies box text in sideboxes/currencies.php
  define('BOX_HEADING_CURRENCIES', 'Devises');

// information box text in sideboxes/information.php
  define('BOX_HEADING_INFORMATION', 'Informations');
  define('BOX_INFORMATION_PRIVACY', 'Qui sommes nous ?');
  define('BOX_INFORMATION_CONDITIONS', 'Conditions G&eacute;n&eacute;rales de Vente');
  define('BOX_INFORMATION_SHIPPING', 'Livraisons-Retours');
  define('BOX_INFORMATION_CONTACT', 'Nous Contacter');
  define('BOX_BBINDEX', 'Forum');
  define('BOX_INFORMATION_UNSUBSCRIBE', 'D&eacute;sabonnement Newsletter');

define('BOX_INFORMATION_SITE_MAP', 'Carte du site');

// information box text in sideboxes/more_information.php - were TUTORIAL_
  define('BOX_HEADING_MORE_INFORMATION', 'En Savoir Plus');
  define('BOX_INFORMATION_PAGE_2', 'Page 2');
  define('BOX_INFORMATION_PAGE_3', 'Page 3');
  define('BOX_INFORMATION_PAGE_4', 'Page 4');
define('BOX_INFORMATION_PAGE_5', 'Page 5');
define('BOX_INFORMATION_PAGE_6', 'Page 6');
define('BOX_INFORMATION_PAGE_7', 'Page 7');
define('BOX_INFORMATION_PAGE_8', 'Page 8');
define('BOX_INFORMATION_PAGE_9', 'Page 9');
define('BOX_INFORMATION_PAGE_10', 'Page 10');
define('BOX_INFORMATION_PAGE_11', 'Page 11');

// tell a friend box text in sideboxes/tell_a_friend.php
  define('BOX_HEADING_TELL_A_FRIEND', 'Informer Un Ami');
  define('BOX_TELL_A_FRIEND_TEXT', 'concernant ce Produit');

// wishlist box text in includes/boxes/wishlist.php
  define('BOX_HEADING_CUSTOMER_WISHLIST', 'Ma Wishlist');
  define('BOX_WISHLIST_EMPTY', 'Vous n\'avez aucun Produit dans votre Wishlist');
  define('IMAGE_BUTTON_ADD_WISHLIST', 'ajouter &agrave; la wishlist');
  define('TEXT_WISHLIST_COUNT', 'Vous avez actuellement %s Produit(s) dans votre Wishlist.');
  define('TEXT_DISPLAY_NUMBER_OF_WISHLIST', 'Afficher <strong>%d</strong> &agrave; <strong>%d</strong> (sur <strong>%d</strong> Produit dans votre Wishlist)');

//New billing address text
  define('SET_AS_PRIMARY' , 'Etablir en tant qu\'Adresse Principale');
  define('NEW_ADDRESS_TITLE', 'Adresse de Facturation');

// javascript messages
  define('JS_ERROR', 'Des erreurs sont apparues dans la validation de votre formulaire.\n\nMerci de rectifier les points suivants:\n\n');

  define('JS_REVIEW_TEXT', '* Le \'texte de votre Avis\' doit comporter un minimum de ' . REVIEW_TEXT_MIN_LENGTH . 'caractères.');
  define('JS_REVIEW_RATING', '* Vous devez attribuer une note au produit.');

  define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Veuillez indiquer le Mode de Paiement pour Votre Commande.');

  define('JS_ERROR_SUBMITTED', 'Cette commande a déjà été envoyée. Veuillez cliquer sur Ok et veuillez attendre la fin du traitement en cours.');

  define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Veuillez indiquer le Mode de Paiement pour Votre Commande.');
  define('ERROR_CONDITIONS_NOT_ACCEPTED', 'Merci de lire Nos Conditions G&eacute;n&eacute;rales de Vente afin de les accepter.');
  define('ERROR_PRIVACY_STATEMENT_NOT_ACCEPTED', 'Veuillez confirmer votre Acceptation de Nos Dispositions.');

  define('CATEGORY_COMPANY', 'Entreprise');
  define('CATEGORY_PERSONAL', 'Votre Compte');
  define('CATEGORY_ADDRESS', 'Coordonn&eacute;es');
  define('CATEGORY_CONTACT', 'Contact');
  define('CATEGORY_OPTIONS', 'Options');
  define('CATEGORY_PASSWORD', 'Votre Mot de passe');
  define('CATEGORY_LOGIN', 'Identifiant');
  define('PULL_DOWN_DEFAULT', 'Veuillez choisir votre Pays');

  define('ENTRY_COMPANY', 'Soci&eacute;t&eacute;:');
  define('ENTRY_COMPANY_ERROR', 'Le nom de votre société doit contenir un minimum de ' . ENTRY_COMPANY_MIN_LENGTH . ' caractères.');
  define('ENTRY_COMPANY_TEXT', '');
  define('ENTRY_GENDER', 'Civilit&eacute;:');
  define('ENTRY_GENDER_ERROR', 'Votre Etat Civil.');
  define('ENTRY_GENDER_TEXT', '*');
  define('ENTRY_FIRST_NAME', 'Pr&eacute;nom:');
  define('ENTRY_FIRST_NAME_ERROR', 'Votre Prénom doit comporter un minimum de ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caractères.');
  define('ENTRY_FIRST_NAME_TEXT', '*');
  define('ENTRY_LAST_NAME', 'Nom:');
  define('ENTRY_LAST_NAME_ERROR', 'Votre Nom doit comporter un minimum de ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caractères.');
  define('ENTRY_LAST_NAME_TEXT', '*');
  define('ENTRY_DATE_OF_BIRTH', 'N&eacute;(e) le:');
  define('ENTRY_DATE_OF_BIRTH_ERROR', 'Votre Date de Naissance doit &ecirc;tre au format suivant: jj/mm/aaaa');
  define('ENTRY_DATE_OF_BIRTH_TEXT', '* (eg. 05/21/1970)');
  define('ENTRY_EMAIL_ADDRESS', 'E-mail:');
  define('ENTRY_EMAIL_ADDRESS_ERROR', 'Votre E-mail doit contenir un minimum de ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caractères.');
  define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Votre E-mail ne semble pas valide - merci de corriger.');
  define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Votre E-mail est pr&eacute;sente dans notre base de donn&eacute;es - veuillez vous connecter via votre compte.');
  define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
  define('ENTRY_NICK', 'Pseudo pour le Forum:');
  define('ENTRY_NICK_TEXT', ''); // note to display beside nickname input field
  define('ENTRY_NICK_DUPLICATE_ERROR', 'Ce Pseudo est d&eacute;j&agrave; retenu par un Membre !');
  define('ENTRY_NICK_LENGTH_ERROR', 'Le Pseudo doit contenir un minimum de ' . ENTRY_NICK_MIN_LENGTH . ' caractères.');
  define('ENTRY_STREET_ADDRESS', 'Votre Adresse:');
  define('ENTRY_STREET_ADDRESS_ERROR', 'Votre Adresse doit contenir un minimum de ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caractères.');
  define('ENTRY_STREET_ADDRESS_TEXT', '*');
  define('ENTRY_SUBURB', 'Etage/digicode:');
  define('ENTRY_SUBURB_ERROR', '');
  define('ENTRY_SUBURB_TEXT', '');
  define('ENTRY_POST_CODE', 'Code Postal:');
  define('ENTRY_POST_CODE_ERROR', 'Votre Code Postal doit contenir un minimum de ' . ENTRY_POSTCODE_MIN_LENGTH . ' caractères.');
  define('ENTRY_POST_CODE_TEXT', '*');
  define('ENTRY_CITY', 'Ville:');
  define('ENTRY_CUSTOMERS_REFERRAL', 'Code de Gratification:');

  define('ENTRY_CITY_ERROR', 'Votre ville doit contenir un minimum de ' . ENTRY_CITY_MIN_LENGTH . ' caractères.');
  define('ENTRY_CITY_TEXT', '*');
  define('ENTRY_STATE', 'Localisation:');
  define('ENTRY_STATE_ERROR', 'Le champ Localisation doit contenir un minimum de ' . ENTRY_STATE_MIN_LENGTH . ' caractères.');
  define('ENTRY_STATE_ERROR_SELECT', 'Merci de renseigner le champ Localisation.');
  define('ENTRY_STATE_TEXT', '*');
  define('ENTRY_COUNTRY', 'Pays:');
  define('ENTRY_COUNTRY_ERROR', 'Vous devez s&eacute;lectionner un Pays dans le menu.');
  define('ENTRY_COUNTRY_TEXT', '*');
  define('ENTRY_TELEPHONE_NUMBER', 'T&eacute;l&eacute;phone:');
  define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Votre Numéro de téléphone doit contenir un minimum de ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caractères.');
  define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
  define('ENTRY_FAX_NUMBER', 'Fax:');
  define('ENTRY_FAX_NUMBER_ERROR', '');
  define('ENTRY_FAX_NUMBER_TEXT', '');
  define('ENTRY_NEWSLETTER', 'Newsletter:');
  define('ENTRY_NEWSLETTER_TEXT', '');
  define('ENTRY_NEWSLETTER_YES', 'Souscrit');
  define('ENTRY_NEWSLETTER_NO', 'Non Souscrit');
  define('ENTRY_NEWSLETTER_ERROR', '');
  define('ENTRY_PASSWORD', 'Mot de Passe:');
  define('ENTRY_PASSWORD_ERROR', 'Votre Mot de Passe doit contenir un minimum de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caractères.');
  define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'La Confirmation ne correspond pas à votre Mot de Passe.');
  define('ENTRY_PASSWORD_TEXT', '* (min. ' . ENTRY_PASSWORD_MIN_LENGTH . ' caractères)');
  define('ENTRY_PASSWORD_CONFIRMATION', 'Confirmation:');
  define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
  define('ENTRY_PASSWORD_CURRENT', 'Mot de Passe Actuel:');
  define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
  define('ENTRY_PASSWORD_CURRENT_ERROR', 'Votre Mot de Passe doit contenir un minimum de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caractères.');
  define('ENTRY_PASSWORD_NEW', 'Nouveau Mot de Passe:');
  define('ENTRY_PASSWORD_NEW_TEXT', '*');
  define('ENTRY_PASSWORD_NEW_ERROR', 'Votre Nouveau Mot de passe doit contenir un minimum de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caractères.');
  define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Vos Mots de Passe doivent &ecirc;tre identiques.');
  define('PASSWORD_HIDDEN', '-- CACHER --');

  define('FORM_REQUIRED_INFORMATION', '* Information Requise');
  define('ENTRY_REQUIRED_SYMBOL', '*');

// constants for use in zen_prev_next_display function
  define('TEXT_RESULT_PAGE', '');
  define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> articles)');
  define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> commandes)');
  define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> avis)');
  define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> nouveaut&eacute;s)');
  define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> promotions)');
  define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_FEATURED_PRODUCTS', 'Afficher <strong>%d</strong> &agrave; <strong>%d</strong> (sur <strong>%d</strong> Coups de Coeur)');
  define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_ALL', 'Afficher <strong>%d</strong> &agrave; <strong>%d</strong> (sur <strong>%d</strong> produits)');

  define('PREVNEXT_TITLE_FIRST_PAGE', 'Premi&egrave;re Page');
  define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Page Pr&eacute;c&eacute;dente');
  define('PREVNEXT_TITLE_NEXT_PAGE', 'Page Suivante');
  define('PREVNEXT_TITLE_LAST_PAGE', 'Derni&egrave;re Page');
  define('PREVNEXT_TITLE_PAGE_NO', 'Page %d');
  define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Ensemble Pr&eacute;c&eacute;dent de %d Pages');
  define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Ensemble Suivant de %d Pages');
  define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;PREMIER');
  define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;Pr&eacute;c]');
  define('PREVNEXT_BUTTON_NEXT', '[Suiv&nbsp;&gt;&gt;]');
  define('PREVNEXT_BUTTON_LAST', 'Dernier&gt;&gt;');

  define('TEXT_BASE_PRICE','Depuis: ');

  define('TEXT_CLICK_TO_ENLARGE', 'Agrandir');

  define('TEXT_SORT_PRODUCTS', 'Classement ');
  define('TEXT_DESCENDINGLY', 'Descendant');
  define('TEXT_ASCENDINGLY', 'Ascendant');
  define('TEXT_BY', ' par ');

  define('TEXT_REVIEW_BY', 'par %s');
  define('TEXT_REVIEW_WORD_COUNT', '%s Mots');
  define('TEXT_REVIEW_RATING', 'Score: %s [%s]');
  define('TEXT_REVIEW_DATE_ADDED', 'Publication: %s');
  define('TEXT_NO_REVIEWS', 'Il n\'y a actuellement Aucun Avis.');

  define('TEXT_NO_NEW_PRODUCTS', 'De Nouveaux Produits seront bient&ocirc;t ajout&eacute;s. Nous vous invitons donc &agrave; consulter cette page r&eacute;guli&egrave;rement.');

  define('TEXT_UNKNOWN_TAX_RATE', 'Taux de Taxes Inconnu');

  define('TEXT_REQUIRED', '<span class="errorText">Requis</span>');

  define('ERROR_zen_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><b><small>erreur:</small> impossible d\'envoyer un E-mail via le serveur SMTP. Confirmez PHP.INI et corrigez au besoin le nom du serveur SMTP.</b></font>');
  define('WARNING_INSTALL_DIRECTORY_EXISTS', 'attention: le r&eacute;pertoire d\'installation existe: ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/install. Merci de supprimer ce r&eacute;pertoire pour des raisons de s&eacute;curit&eacute;.');
  define('WARNING_CONFIG_FILE_WRITEABLE', 'attention aux CHMODS sur le fichier de configuration: ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/includes/configure.php. Indiquez les bonnes permissions sur ce fichier !');
  define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'attention: le r&eacute;pertoire de session n\'existe pas: ' . zen_session_save_path() . '. Les sessions ne fonctionneront pas tant que ce r&eacute;pertoire n\'aura pas &eacute;t&eacute; cr&eacute;&eacute;.');
  define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'attention: il est impossible d\'&eacute;crire dans le r&eacute;pertoire de sessions: ' . zen_session_save_path() . '. Celles-ci ne fonctionneront pas tant que les permissions n\'auront pas &eacute;t&eacute; corrig&eacute;es.');
  define('WARNING_SESSION_AUTO_START', 'attention: session.auto_start est actif - d&eacute;sactiver cette fonctionnalit&eacute; dans php.ini et red&eacute;marrer le serveur.');
  define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'attention: le r&eacute;pertoire de t&eacute;l&eacute;chargement n\'existe pas: ' . DIR_FS_DOWNLOAD . '. Le t&eacute;l&eacute;chargement ne fonctionnera qu\'avec un r&eacute;pertoire valide.');
  define('WARNING_SQL_CACHE_DIRECTORY_NON_EXISTENT', 'attention: le r&eacute;pertoire de cache SQL est inexistant: ' . DIR_FS_SQL_CACHE . '. Le cache SQL ne peut fonctionner sans.');
  define('WARNING_SQL_CACHE_DIRECTORY_NOT_WRITEABLE', 'attention: il est impossible d\'&eacute;crire dans le r&eacute;pertoire de cache SQL: ' . DIR_FS_SQL_CACHE . '. Le cache SQL ne peut fonctionner sans.');
  define('WARNING_SQL_CACHE_DIRECTORY_NOT_WRITEABLE', 'Warning: I am not able to write to the SQL cache directory: ' . DIR_FS_SQL_CACHE . '. SQL caching will not work until the right user permissions are set.');
  define('WARNING_DATABASE_VERSION_OUT_OF_DATE', 'Your database appears to need patching to a higher level. See Admin->Tools->Server Information to review patch levels.');


  define('TEXT_CCVAL_ERROR_INVALID_DATE', 'Date d\'expiration de carte non valide. Veuillez recommencer.');
  define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'Num&eacute;ro de carte non valide. Veuillez recommencer.');
  define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'Les 4 premiers chiffres que vous avez saisis sont: %s. Si ces chiffres sont exacts, nous sommes au regret de vous informer que nous ne pouvons donner suite. Merci de v&eacute;rifier avant de recommencer.');

define('BOX_INFORMATION_DISCOUNT_COUPONS', 'Coupons rabais');
  define('BOX_INFORMATION_GV', 'FAQ ' . TEXT_GV_NAMES);
  define('VOUCHER_BALANCE', 'Balance ' . TEXT_GV_NAME);
  define('BOX_HEADING_GIFT_VOUCHER', 'Compte ' . TEXT_GV_NAME);
  define('GV_FAQ', 'FAQ ' . TEXT_GV_NAMES);
  define('ERROR_REDEEMED_AMOUNT', 'F&eacute;licitations, votre montant est valid&eacute;');
  define('ERROR_NO_REDEEM_CODE', 'Vous n\'avez pas renseign&eacute; votre ' . TEXT_GV_REDEEM);
  define('ERROR_NO_INVALID_REDEEM_GV', '' . TEXT_GV_REDEEM . ' ' . TEXT_GV_NAME . ' n\'est pas valide');
  define('TABLE_HEADING_CREDIT', 'Cr&eacute;dits Disponibles');
  define('GV_HAS_VOUCHERA', 'Votre ' . TEXT_GV_NAME . ' dispose de Fonds. Vous pouvez <br />
                         envoyer tout ou partie de cette somme par <a class="pageResults" href="');

  define('GV_HAS_VOUCHERB', '"><strong>E-mail</strong></a> &agrave; la personne de votre choix');
  define('ENTRY_AMOUNT_CHECK_ERROR', 'Vos Fonds disponibles ne sont pas assez importants pour envoyer ce montant.');
  define('BOX_SEND_TO_FRIEND', 'Envoyer un ' . TEXT_GV_NAME);

  define('VOUCHER_REDEEMED',  TEXT_GV_NAME . ' Valid&eacute;');
  define('CART_COUPON', 'Coupon: ');
  define('CART_COUPON_INFO', 'En Savoir Plus');
  define('TEXT_SEND_OR_SPEND','You have a balance available in your ' . TEXT_GV_NAME . ' account. You may spend it or send it to someone else. To send click the button below.');
  define('TEXT_BALANCE_IS', 'Your ' . TEXT_GV_NAME . ' balance is: ');
  define('TEXT_AVAILABLE_BALANCE', 'Your ' . TEXT_GV_NAME . ' Account');

// payment method is GV/Discount
  define('PAYMENT_METHOD_GV', 'Gift Certificate/Coupon');
  define('PAYMENT_MODULE_GV', 'GV/DC');

  define('TABLE_HEADING_CREDIT_PAYMENT', 'Fonds Disponibles');

  define('TEXT_INVALID_REDEEM_COUPON', 'Code de Coupon Non Valide');
  define('TEXT_INVALID_STARTDATE_COUPON', 'Ce coupon n\'est pas encore disponible');
  define('TEXT_INVALID_FINISDATE_COUPON', 'La Date de Validit&eacute; de Ce Coupon est d&eacute;pass&eacute;e');
  define('EXT_INVALID_USES_COUPON', 'Ce Coupon peut &ecirc;tre utilis&eacute; uniquement pour ');
  define('TIME', ' fois.');
  define('TIMES', ' fois.');
  define('TEXT_INVALID_USES_USER_COUPON', 'Vous avez d&eacute;j&agrave; utilis&eacute; Ce Coupon selon les Conditions Pr&eacute;vues.');
  define('REDEEMED_COUPON', 'un Coupon de R&eacute;duction d\'une Valeur de ');
  define('REDEEMED_MIN_ORDER', 'Sur des Commandes dont le Montant est Sup&eacute;rieur &agrave; ');
  define('REDEEMED_RESTRICTIONS', ' [application des restrictions cat&eacute;gories/Produits]');
  define('TEXT_ERROR', 'Une erreur est survenue');
//ke-added from forum
  define('TEXT_INVALID_COUPON_PRODUCT', 'Ce Coupon n\'est pas valable pour les Produits qui figurent actuellement dans Votre Panier');

// more info in place of buy now
  define('MORE_INFO_TEXT','... plus d\'infos');

// IP Address
  define('TEXT_YOUR_IP_ADDRESS','Votre adresse IP actuelle est: ');

//Generic Address Heading
  define('HEADING_ADDRESS_INFORMATION','Information Adresse');

// cart contents
  define('PRODUCTS_ORDER_QTY_TEXT_IN_CART','Quantit&eacute;s dans le Panier: ');
  define('PRODUCTS_ORDER_QTY_TEXT','Ajouter au Panier: ');

  define('TEXT_PRODUCT_WEIGHT_UNIT','kgs');

// Shipping
  define('TEXT_SHIPPING_WEIGHT','kgs');
  define('TEXT_SHIPPING_BOXES', 'Colis');

// Discount Savings
  define('PRODUCT_PRICE_DISCOUNT_PREFIX','Economisez:&nbsp;');
  define('PRODUCT_PRICE_DISCOUNT_PERCENTAGE','%');
  define('PRODUCT_PRICE_DISCOUNT_AMOUNT','&nbsp;de remise');

// Sale Maker Sale Price
  define('PRODUCT_PRICE_SALE','Prix:&nbsp;');

//universal symbols
  define('TEXT_NUMBER_SYMBOL', '# ');

// banner_box
  define('BOX_HEADING_BANNER_BOX','Partenaires');
  define('TEXT_BANNER_BOX','Rendez Visite &agrave; Nos Partenaires...');

// banner box 2
  define('BOX_HEADING_BANNER_BOX2','Connaissez-Vous ?');
  define('TEXT_BANNER_BOX2','A Voir Aujourd\'hui !');

  // banner_box - all
  define('BOX_HEADING_BANNER_BOX_ALL','Sponsors');
  define('TEXT_BANNER_BOX_ALL','Visitrez nos Sponsors ...');
  
// boxes defines
  define('PULL_DOWN_ALL','Votre Choix');
  define('PULL_DOWN_MANUFACTURERS','Votre Choix');
// shipping estimator
  define('PULL_DOWN_SHIPPING_ESTIMATOR_SELECT', 'Votre Choix');

// general Sort By
  define('TEXT_INFO_SORT_BY','Classement par: ');

// close window image popups
  define('TEXT_CLOSE_WINDOW',' - Cliquez sur l\'Image pour la Fermer');
// close popups
  define('TEXT_CURRENT_CLOSE_WINDOW','[ Fermer [x] ]');

// iii 031104 added:  File upload error strings
  define('ERROR_FILETYPE_NOT_ALLOWED', 'Erreur: type de fichier interdit.');
  define('WARNING_NO_FILE_UPLOADED', 'Erreur: &eacute;chec du t&eacute;l&eacute;chargement.');
  define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Succ&egrave;s: fichier sauvegard&eacute;.');
  define('ERROR_FILE_NOT_SAVED', 'Erreur: fichier non sauvegard&eacute;.');
  define('ERROR_DESTINATION_NOT_WRITEABLE', 'Erreur: impossible d\'&eacute;crire sur le fichier de destination.');
  define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Erreur: le fichier de destination est inexistant.');
// End iii added

  define('TEXT_BEFORE_DOWN_FOR_MAINTENANCE', 'Note: fermeture du Site pour Maintenance (jj/mm/aa) (hh-hh): ');
  define('TEXT_ADMIN_DOWN_FOR_MAINTENANCE', 'Note: le Site est actuellement en Maintenance');

  define('PRODUCTS_PRICE_IS_FREE_TEXT','C\'est Gratuit !');
  define('PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT','Prix sur Demande');
  define('TEXT_CALL_FOR_PRICE','Prix sur Demande');

  define('TEXT_INVALID_SELECTION_LABELED',' S&eacute;lection non Valide: ');
  define('TEXT_ERROR_OPTION_FOR',' de l\'Option pour: ');
  define('TEXT_INVALID_USER_INPUT', 'Information Requise');

// product_listing
  define('PRODUCTS_QUANTITY_MIN_TEXT_LISTING','Min:');
  define('PRODUCTS_QUANTITY_UNIT_TEXT_LISTING','Unit&eacute;s:');
  define('PRODUCTS_QUANTITY_IN_CART_LISTING','Dans le panier:');
  define('PRODUCTS_QUANTITY_ADD_ADDITIONAL_LISTING','Ajouter:');

  define('PRODUCTS_QUANTITY_MAX_TEXT_LISTING','Max:');

  define('TEXT_PRODUCTS_MIX_OFF','*Mix. OFF');
  define('TEXT_PRODUCTS_MIX_ON','*Mix. ON');

  define('TEXT_PRODUCTS_MIX_OFF_SHOPPING_CART','*les Valeurs d\'Options Mix. sont sur OFF');
  define('TEXT_PRODUCTS_MIX_ON_SHOPPING_CART','*les Valeurs d\'Options Mix. sont sur ON');

  define('ERROR_MAXIMUM_QTY','Qt&eacute; Ajust&eacute;e - Qt&eacute; Maximum Ajout&eacute;e au Panier ');
  define('ERROR_CORRECTIONS_HEADING','Veuillez corriger l\Info suivante: <br />');

// Downloads Controller
  define('DOWNLOADS_CONTROLLER_ON_HOLD_MSG','NOTE: les t&eacute;l&eacute;chargements autoris&eacute;s lorsque le paiement est valid&eacute;');
  define('TEXT_FILESIZE_BYTES', ' bytes');
  define('TEXT_FILESIZE_MEGS', ' MB');

// shopping cart errors
  define('ERROR_PRODUCT','Produit: ');
  define('ERROR_PRODUCT_STATUS_SHOPPING_CART','<br />We are sorry but this product has been removed from our inventory at this time.<br />This item has been removed from your shopping cart.');
  define('ERROR_PRODUCT_QUANTITY_MIN',' ... Erreurs Quantit&eacute;s minimum - ');
  define('ERROR_PRODUCT_QUANTITY_UNITS',' ... Erreurs Quantit&eacute;s des Unit&eacute;s - ');
  define('ERROR_PRODUCT_OPTION_SELECTION',' ... Choix des Options Non Valide ');
  define('ERROR_PRODUCT_QUANTITY_ORDERED','Vous avez command&eacute; un Total de: ');
  define('ERROR_PRODUCT_QUANTITY_MAX',' ... Erreurs Quantit&eacute;s Maximum - ');
  define('ERROR_PRODUCT_QUANTITY_MIN_SHOPPING_CART',' ... Erreurs Quantit&eacute;s Minimum - ');
  define('ERROR_PRODUCT_QUANTITY_UNITS_SHOPPING_CART',' ... Erreurs Quantit&eacute;s Unit&eacute;s - ');
  define('ERROR_PRODUCT_QUANTITY_MAX_SHOPPING_CART',' ... Erreurs Quantit&eacute;s Maximum - ');

  define('TABLE_HEADING_FEATURED_PRODUCTS','Produits Coup de Coeur');

  define('TABLE_HEADING_NEW_PRODUCTS', 'Nouveaut&eacute;s en %s');
  define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Produits Attendus');
  define('TABLE_HEADING_DATE_EXPECTED', 'Date Pr&eacute;vue');
  define('TABLE_HEADING_SPECIALS_INDEX', 'Promotions du mois de %s');

// meta tags special defines
  define('META_TAG_PRODUCTS_PRICE_IS_FREE_TEXT','C\'est Gratuit !');

// customer login
  define('TEXT_SHOWCASE_ONLY','Nous Contacter');
// set for login for prices
  define('TEXT_LOGIN_FOR_PRICE_PRICE','Prix Non Disponible');
  define('TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE','Se Connecter pour conna&icirc;tre le Prix');
// set for show room only
  define('TEXT_LOGIN_FOR_PRICE_PRICE_SHOWROOM', ''); // blank for prices or enter your own text
  define('TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE_SHOWROOM','Showroom Seul');

// authorization pending
  define('TEXT_AUTHORIZATION_PENDING_PRICE', 'Prix Non Disponible');
  define('TEXT_AUTHORIZATION_PENDING_BUTTON_REPLACE', 'APPROBATION EN ATTENTE');
  define('TEXT_LOGIN_TO_SHOP_BUTTON_REPLACE','Connexion Boutique');

// text pricing
  define('TEXT_CHARGES_WORD','Calcul des Frais:');
  define('TEXT_PER_WORD','<br />Prix par Mot: ');
  define('TEXT_WORDS_FREE',' Mot(s) Gratuit(s) ');
  define('TEXT_CHARGES_LETTERS','Calcul des Frais:');
  define('TEXT_PER_LETTER','<br />Prix par lettre: ');
  define('TEXT_LETTERS_FREE',' Lettre(s) Gratuite(s) ');
  define('TEXT_ONETIME_CHARGES','*paiement unique = ');
  define('TEXT_ONETIME_CHARGES_EMAIL',"\t" . '*paiement unique = ');
  define('TEXT_ATTRIBUTES_QTY_PRICES_HELP', 'Remises avec Options de Quantit&eacute;s');
  define('TABLE_ATTRIBUTES_QTY_PRICE_QTY','QTE');
  define('TABLE_ATTRIBUTES_QTY_PRICE_PRICE','PRIX');
  define('TEXT_ATTRIBUTES_QTY_PRICES_ONETIME_HELP', 'Remises sur Quantit&eacute;s d\'Options avec Paiement Unique');

// textarea attribute input fields
  define('TEXT_MAXIMUM_CHARACTERS_ALLOWED',' maximum characters allowed');
  define('TEXT_REMAINING','remaining');

// Shipping Estimator
  define('CART_SHIPPING_OPTIONS', 'Estimation des Frais de Livraison:');
  define('CART_SHIPPING_OPTIONS_LOGIN', 'Veuillez <a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '"><u>Vous Connecter</u></a>, pour afficher des Frais de Livraison personnalis&eacute;s.');
  define('CART_SHIPPING_METHOD_TEXT','Modes de Livraisons:');
  define('CART_SHIPPING_METHOD_RATES','Taux:');
  define('CART_SHIPPING_METHOD_TO','Livr&eacute; &agrave;: ');
  define('CART_SHIPPING_METHOD_TO_NOLOGIN', 'Livr&eacute; &agrave;: <a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '"><u>Connexion</u></a>');
  define('CART_SHIPPING_METHOD_FREE_TEXT','Livraison Gratuite');
  define('CART_SHIPPING_METHOD_ALL_DOWNLOADS','- T&eacute;l&eacute;chargements');
  define('CART_SHIPPING_METHOD_RECALCULATE','Recalculer');
  define('CART_SHIPPING_METHOD_ZIP_REQUIRED','true');
  define('CART_SHIPPING_METHOD_ADDRESS','Adresse:');
  define('CART_OT','Estimation du Co&ucirc;t Total:');
  define('CART_OT_SHOW','true'); // set to false if you don't want order totals
  define('CART_ITEMS','Produits dans le Panier: ');
  define('CART_SELECT','S&eacute;lectionnez');
  define('ERROR_CART_UPDATE', 'Veuillez actualiser Votre Commande...<br />');
  define('IMAGE_BUTTON_UPDATE_CART', 'actualiser');

// multiple product add to cart
  define('TEXT_PRODUCT_LISTING_MULTIPLE_ADD_TO_CART', 'Ajouter: ');
  define('TEXT_PRODUCT_ALL_LISTING_MULTIPLE_ADD_TO_CART', 'Ajouter: ');
  define('TEXT_PRODUCT_FEATURED_LISTING_MULTIPLE_ADD_TO_CART', 'Ajouter: ');
  define('TEXT_PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART', 'Ajouter: ');
  define('SUBMIT_BUTTON_ADD_PRODUCTS_TO_CART','Ajouter la S&eacute;lection au Panier');
  
// discount qty table
  define('TEXT_HEADER_DISCOUNT_PRICES_PERCENTAGE', 'Qt&eacute; de Pourcentages Remis&eacute;s');
  define('TEXT_HEADER_DISCOUNT_PRICES_ACTUAL_PRICE', 'Qt&eacute; de Nouveaux Prix Remis&eacute;s');
  define('TEXT_HEADER_DISCOUNT_PRICES_AMOUNT_OFF', 'Qt&eacute; de Prix Remis&eacute;s');
  define('TEXT_FOOTER_DISCOUNT_QUANTITIES', '* Les Prix Remis&eacute;s peuvent varier en fonction des &eacute;l&eacute;ments pr&eacute;cit&eacute;s');
  define('TEXT_HEADER_DISCOUNTS_OFF', 'Remises sur Qt&eacute; Non Disponibles...');

// sort order titles for dropdowns
  define('PULL_DOWN_ALL_RESET','- RESET - ');
  define('TEXT_INFO_SORT_BY_PRODUCTS_NAME', 'Nom du Produit');
  define('TEXT_INFO_SORT_BY_PRODUCTS_NAME_DESC', 'Nom du Produit - desc');
  define('TEXT_INFO_SORT_BY_PRODUCTS_PRICE', 'Prix - Bas vers Haut');
  define('TEXT_INFO_SORT_BY_PRODUCTS_PRICE_DESC', 'Prix - Haut vers Bas');
  define('TEXT_INFO_SORT_BY_PRODUCTS_MODEL', 'Mod&egrave;le');
  define('TEXT_INFO_SORT_BY_PRODUCTS_DATE_DESC', 'Publication - Nouveau vers Ancien');
  define('TEXT_INFO_SORT_BY_PRODUCTS_DATE', 'Publication - Ancien vers Nouveau');
  define('TEXT_INFO_SORT_BY_PRODUCTS_SORT_ORDER', 'Affichage par D&eacute;faut');

//added for Rich Text / Email Mod
  define('TABLE_HEADING_DOWNLOAD_DATE', 'Link Expires');
  define('TABLE_HEADING_DOWNLOAD_COUNT', 'Remaining');
  define('HEADING_DOWNLOAD', 'To download your files click the download button and choose "Save to Disk" from the popup menu.');
  define('TABLE_HEADING_DOWNLOAD_FILENAME','Filename');
  define('TABLE_HEADING_PRODUCT_NAME','Nom du produit');
  define('TABLE_HEADING_BYTE_SIZE','File Size');
  define('TEXT_DOWNLOADS_UNLIMITED', 'Unlimited');
  define('TEXT_DOWNLOADS_UNLIMITED_COUNT', '--- *** ---');

// misc
  define('COLON_SPACER', ':&nbsp;&nbsp;');

// table headings for cart display and upcoming products
  define('TABLE_HEADING_QUANTITY', 'Qté.');
  define('TABLE_HEADING_PRODUCTS', 'Nom du produit');
  define('TABLE_HEADING_TOTAL', 'Total');

// create account - login shared
  define('TABLE_HEADING_PRIVACY_CONDITIONS', 'Privacy Statement');
  define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION', 'Please acknowledge you agree with our privacy statement by ticking the following box. The privacy statement can be read <a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><span class="pseudolink">here</span></a>.');
  define('TEXT_PRIVACY_CONDITIONS_CONFIRM', 'I have read and agreed to your privacy statement.');
  define('TABLE_HEADING_ADDRESS_DETAILS', 'Adresse détaillée');
  define('TABLE_HEADING_PHONE_FAX_DETAILS', 'Coordonnées téléphoniques');
  define('TABLE_HEADING_DATE_OF_BIRTH', 'Verify Your Age');
  define('TABLE_HEADING_LOGIN_DETAILS', 'Informations de connexion');
  define('TABLE_HEADING_REFERRAL_DETAILS', 'Were You Referred to Us?');

  define('ENTRY_EMAIL_PREFERENCE','Pr&eacute;f&eacute;rence Format E-mail:');
  define('ENTRY_EMAIL_HTML_DISPLAY','HTML');
  define('ENTRY_EMAIL_TEXT_DISPLAY','texte');
  define('EMAIL_SEND_FAILED','ERREUR: Envoi impossible &agrave;: "%s" <%s> avec le sujet: "%s"');

  define('DB_ERROR_NOT_CONNECTED', 'Erreur - Connexion &agrave; la Base de Donn&eacute;es Impossible');

// EZ-PAGES Alerts
  define('TEXT_EZPAGES_STATUS_HEADER_ADMIN', 'Attention: EZ-PAGES HEADER - On for Admin IP Only');
  define('TEXT_EZPAGES_STATUS_FOOTER_ADMIN', 'Attention: EZ-PAGES FOOTER - On for Admin IP Only');
  define('TEXT_EZPAGES_STATUS_SIDEBOX_ADMIN', 'Attention: EZ-PAGES SIDEBOX - On for Admin IP Only');


///////////////////////////////////////////////////////////
// include email extras
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_EMAIL_EXTRAS)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_EMAIL_EXTRAS);

// include template specific header defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_HEADER)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_HEADER);

// include template specific button name defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_BUTTON_NAMES)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_BUTTON_NAMES);

// include template specific icon name defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_ICON_NAMES)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_ICON_NAMES);

// include template specific other image name defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_OTHER_IMAGES_NAMES)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_OTHER_IMAGES_NAMES);

// credit cards
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_CREDIT_CARDS)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select. FILENAME_CREDIT_CARDS);

// include template specific whos_online sidebox defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_WHOS_ONLINE . '.php')) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_WHOS_ONLINE . '.php');

// include template specific meta tags defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/meta_tags.php')) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . 'meta_tags.php');

// END OF EXTERNAL LANGUAGE LINKS
?>