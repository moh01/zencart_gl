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
//  $Id: french.php modified by www.fweb.biz
//

// added defines for header alt and text
define('HEADER_ALT_TEXT', 'Admin fweb');
define('HEADER_LOGO_WIDTH', '200px');
define('HEADER_LOGO_HEIGHT', '70px');
define('HEADER_LOGO_IMAGE', 'logo.gif');

// regardez dans votre r&eacute;pertoire local $PATH_LOCALE/locale pour les variables disponibles.
// sur RedHat6.0  utilisez 'fr_FR'
// sur FreeBSD 4.0 utilisez 'fr_FR.ISO_8859-1'
// ces fonctions peuvent ne pas fonctionner sous win32 OpenBSD.
  setlocale(LC_TIME, 'fr_FR.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'm/d/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
define('DATE_FORMAT_SPIFFYCAL', 'dd/MM/yyyy');  //Use only 'dd', 'MM' and 'yyyy' here in any order

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function zen_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 0, 2) . substr($date, 3, 2);
  }
}

// removed for meta tags
// page title
//define('TITLE', 'Zen Cart');

// include template specific meta tags defines
  if (file_exists(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/meta_tags.php')) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . 'meta_tags.php');
//die(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . 'meta_tags.php');

// meta tags
define('ICON_METATAGS_ON', 'Meta Tags D&eacute;finies');
define('ICON_METATAGS_OFF', 'Meta Tags Non D&eacute;finies');
define('TEXT_LEGEND_META_TAGS', 'Meta Tags D&eacute;finies :');
define('TEXT_INFO_META_TAGS_USAGE', '<strong>NOTE :</strong> La Tagline du Site repr&eacute;sente la d&eacute;finition pour le site dans le fichier the meta_tags.php.');

// Global entries for the <html> tag
  define('HTML_PARAMS','dir="ltr" lang="fr"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// header text in includes/header.php
  define('HEADER_TITLE_TOP', 'Admin Home');
  define('HEADER_TITLE_SUPPORT_SITE', 'Site Support');
  define('HEADER_TITLE_ONLINE_CATALOG', 'Catalogue en Ligne');
define('HEADER_TITLE_VERSION', 'Version');
  define('HEADER_TITLE_LOGOFF', 'Déconnexion');
//  define('HEADER_TITLE_ADMINISTRATION', 'Administration');

// Define the name of your Gift Certificate as Gift Voucher, Gift Certificate, Zen Cart Dollars, etc. here for use through out the shop
  define('TEXT_GV_NAME','Chèque Cadeau');
  define('TEXT_GV_NAMES','Chèque Cadeau');
  define('TEXT_DISCOUNT_COUPON', 'Discount Coupon');

// used for redeem code, redemption code, or redemption id
  define('TEXT_GV_REDEEM','Code');

// text for gender
  define('MALE', 'M.');
  define('FEMALE', 'Mme');

// text for date of birth example
  define('DOB_FORMAT_STRING', 'dd/mm/yyyy');

// configuration box text in includes/boxes/configuration.php
  define('BOX_HEADING_CONFIGURATION', 'Configuration');
  define('BOX_CONFIGURATION_MYSTORE', 'Ma Boutique');
  define('BOX_CONFIGURATION_LOGGING', 'Logging');
  define('BOX_CONFIGURATION_CACHE', 'Cache');

// modules box text in includes/boxes/modules.php
  define('BOX_HEADING_MODULES', 'Modules');
  define('BOX_MODULES_PAYMENT', 'Paiements');
  define('BOX_MODULES_SHIPPING', 'Livraisons');
  define('BOX_MODULES_ORDER_TOTAL', 'Total Commande');
  define('BOX_MODULES_PRODUCT_TYPES', 'Types de Produits');

// categories box text in includes/boxes/catalog.php
  define('BOX_HEADING_CATALOG', 'Catalogue');
  define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Catégories/Produits');
  define('BOX_CATALOG_PRODUCT_TYPES', 'Types de Produits');
  define('BOX_CATALOG_CATEGORIES_OPTIONS_NAME_MANAGER', 'Options des Produits');
  define('BOX_CATALOG_CATEGORIES_OPTIONS_VALUES_MANAGER', 'Valeurs d\'Options');
  define('BOX_CATALOG_MANUFACTURERS', 'Fabricants');
  define('BOX_CATALOG_REVIEWS', 'Avis');
  define('BOX_CATALOG_SPECIALS', 'Promotions');
  define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Produits Attendus');
  define('BOX_CATALOG_SALEMAKER', 'SaleMaker');
  define('BOX_CATALOG_PRODUCTS_PRICE_MANAGER', 'Gestion des Produits');

// customers box text in includes/boxes/customers.php
  define('BOX_HEADING_CUSTOMERS', 'Clients');
  define('BOX_CUSTOMERS_CUSTOMERS', 'Clients');
  define('BOX_CUSTOMERS_ORDERS', 'Commandes');
  define('BOX_CUSTOMERS_GROUP_PRICING', 'Prix par Groupe');
  define('BOX_CUSTOMERS_PAYPAL', 'PayPal IPN');

// taxes box text in includes/boxes/taxes.php
  define('BOX_HEADING_LOCATION_AND_TAXES', 'Lieux / Taxes');
  define('BOX_TAXES_COUNTRIES', 'Pays');
  define('BOX_TAXES_ZONES', 'Z&ocirc;nes');
  define('BOX_TAXES_GEO_ZONES', 'Définitions des Zônes');
  define('BOX_TAXES_TAX_CLASSES', 'Classes de Taxes');
  define('BOX_TAXES_TAX_RATES', 'Taux de Taxes');

// reports box text in includes/boxes/reports.php
  define('BOX_HEADING_REPORTS', 'Rapports');
  define('BOX_REPORTS_PRODUCTS_VIEWED', 'Consultations');
  define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Achats Effectifs');
  define('BOX_REPORTS_ORDERS_TOTAL', 'Meilleur Panier');
  define('BOX_REPORTS_PRODUCTS_LOWSTOCK', 'Gestion des Stocks');
  define('BOX_REPORTS_CUSTOMERS_REFERRALS', 'Clients de Référence');

// tools text in includes/boxes/tools.php
  define('BOX_HEADING_TOOLS', 'Outils');
  define('BOX_TOOLS_ADMIN', 'Réglages Admin');
  define('BOX_TOOLS_TEMPLATE_SELECT', 'Choix du Template');
  define('BOX_TOOLS_BACKUP', 'Sauvegarde de la Base');
  define('BOX_TOOLS_BANNER_MANAGER', 'Manager de Bannières');
  define('BOX_TOOLS_CACHE', 'Contr&ocirc;le du Cache');
  define('BOX_TOOLS_DEFINE_LANGUAGE', 'Définir les Langues');
  define('BOX_TOOLS_FILE_MANAGER', 'Manager de Fichiers');
  define('BOX_TOOLS_MAIL', 'Emails aux Clients');
  define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Manager de Newsletter');
  define('BOX_TOOLS_SERVER_INFO', 'Info Serveur');
  define('BOX_TOOLS_WHOS_ONLINE', 'Qui est en Ligne ?');
  define('BOX_TOOLS_STORE_MANAGER', 'Manager de Boutique');
  define('BOX_TOOLS_DEVELOPERS_TOOL_KIT', 'Outils du Développeur');
define('BOX_TOOLS_SQLPATCH','Installez des Patches SQL');
define('BOX_TOOLS_EZPAGES','EZ-Pages');

  define('BOX_HEADING_EXTRAS', 'Paiements');

// define pages editor files
  define('BOX_TOOLS_DEFINE_PAGES_EDITOR','Editeur de Pages');
  define('BOX_TOOLS_DEFINE_MAIN_PAGE', 'Page Principale');
  define('BOX_TOOLS_DEFINE_CONTACT_US','Nous Contacter');
  define('BOX_TOOLS_DEFINE_PRIVACY','Vie Privée');
  define('BOX_TOOLS_DEFINE_SHIPPINGINFO','Livraisons & Retours');
  define('BOX_TOOLS_DEFINE_CONDITIONS','Conditions Générales');
  define('BOX_TOOLS_DEFINE_CHECKOUT_SUCCESS','Succès');
  define('BOX_TOOLS_DEFINE_PAGE_2','Page 2');
  define('BOX_TOOLS_DEFINE_PAGE_3','Page 3');
  define('BOX_TOOLS_DEFINE_PAGE_4','Page 4');
	define('BOX_TOOLS_DEFINE_PAGE_5', 'Page 5');
	define('BOX_TOOLS_DEFINE_PAGE_6', 'Page 6');
	define('BOX_TOOLS_DEFINE_PAGE_7', 'Page 7');
	define('BOX_TOOLS_DEFINE_PAGE_8', 'Page 8');
	define('BOX_TOOLS_DEFINE_PAGE_9', 'Page 9');
	define('BOX_TOOLS_DEFINE_PAGE_10', 'Page 10');
	define('BOX_TOOLS_DEFINE_PAGE_11', 'Page 11');


// localizaion box text in includes/boxes/localization.php
  define('BOX_HEADING_LOCALIZATION', 'Localisation');
  define('BOX_LOCALIZATION_CURRENCIES', 'Devises');
  define('BOX_LOCALIZATION_LANGUAGES', 'Langues');
  define('BOX_LOCALIZATION_ORDERS_STATUS', 'Statuts des Commandes');

// gift vouchers box text in includes/boxes/gv_admin.php
  define('BOX_HEADING_GV_ADMIN', TEXT_GV_NAME . '/Coupons');
  define('BOX_GV_ADMIN_QUEUE',  TEXT_GV_NAMES . ' Queue');
  define('BOX_GV_ADMIN_MAIL', 'Mail ' . TEXT_GV_NAME);
  define('BOX_GV_ADMIN_SENT', TEXT_GV_NAMES . ' envoyées');
  define('BOX_COUPON_ADMIN','Admin des Coupons');

  define('IMAGE_RELEASE', 'Balance ' . TEXT_GV_NAME);

// javascript messages
  define('JS_ERROR', 'Des erreurs sont apparues lors du traitement de votre formulaire !\n merci de bien vouloir apporter les corrections suivantes :\n\n');

  define('JS_OPTIONS_VALUE_PRICE', '* Ce nouvel attribut de produit requiert une valeur de prix\n');
  define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Ce nouvel attribut de produit requiert un préfixe de prix\n');

  define('JS_PRODUCTS_NAME', '* Ce nouveau produit requiert un nom\n');
  define('JS_PRODUCTS_DESCRIPTION', '* Ce nouveau produit requiert une description\n');
  define('JS_PRODUCTS_PRICE', '* Ce nouveau produit requiert une valeur de prix\n');
  define('JS_PRODUCTS_WEIGHT', '* Ce nouveau produit requiert une valeur de poids\n');
  define('JS_PRODUCTS_QUANTITY', '* Ce nouveau produit requiert une valeur de quantité;\n');
  define('JS_PRODUCTS_MODEL', '* Ce nouveau produit requiert une valeur de modèle\n');
  define('JS_PRODUCTS_IMAGE', '* Ce nouveau produit requiert une image\n');

  define('JS_SPECIALS_PRODUCTS_PRICE', '* Un nouveau prix pour ce produit doit être établi\n');

  define('JS_GENDER', '* Vous devez indiquer la valeur de \'Civilité;\'.\n');
  define('JS_FIRST_NAME', '* Le champ \'Prénom\' doit comporter un minimum de ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caractères.\n');
  define('JS_LAST_NAME', '* Le champ \'Nom\' doit comporter un minimum de ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caractères.\n');
  define('JS_DOB', '* Le champ \'Date de Naissance\' doit être au format : xx/xx/xxxx (jour/mois/année).\n');
  define('JS_EMAIL_ADDRESS', '* Le champ \'Adresse E-Mail\' doit comporter un minimum de ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caractères.\n');
  define('JS_ADDRESS', '* Le champ \'Adresse\' doit comporter un minimum de ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caractères.\n');
  define('JS_POST_CODE', '* Le champ \'Code Postal\' doit comporter un minimum de ' . ENTRY_POSTCODE_MIN_LENGTH . ' caractères.\n');
  define('JS_CITY', '* Le champ \'Ville\' doit comporter un minimum de ' . ENTRY_CITY_MIN_LENGTH . ' caractères.\n');
  define('JS_STATE', '* Le champ \'Localisation\' doit être sélectionné.\n');
  define('JS_STATE_SELECT', '-- Sélectionnez --');
  define('JS_ZONE', '* Le champ \'Localisation\', selon la localisation, doit être renseigné; via la liste disponible pour ce Pays.');
  define('JS_COUNTRY', '* Le champ \'Pays\' doit être renseigné;.\n');
  define('JS_TELEPHONE', '* Le champ \'Numéro de téléphone\' doit comporter un minimum de ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caractères.\n');
  define('JS_PASSWORD', '* Les champs \'Mot de Passe\' et \'Confirmation\' doivent comporter au moins ' . ENTRY_PASSWORD_MIN_LENGTH . ' caractères.\n');

  define('JS_ORDER_DOES_NOT_EXIST', 'La Commande Numéro %s est inexistante !');

  define('CATEGORY_PERSONAL', 'Personnel');
  define('CATEGORY_ADDRESS', 'Adresse');
  define('CATEGORY_CONTACT', 'Contact');
  define('CATEGORY_COMPANY', 'Soci&eacute;t&eacute;');
  define('CATEGORY_OPTIONS', 'Options');

  define('ENTRY_GENDER', 'Civilit&eacute; :');
  define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">requis</span>');
  define('ENTRY_FIRST_NAME', 'Pr&eacute;nom :');
  define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caract&egrave;res</span>');
  define('ENTRY_LAST_NAME', 'Nom :');
  define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caract&egrave;res</span>');
  define('ENTRY_DATE_OF_BIRTH', 'Date de Naissance:');
  define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(ex. 01/04/1968)</span>');
  define('ENTRY_EMAIL_ADDRESS', 'Adresse E-Mail :');
  define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caract&egrave;res</span>');
  define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">Cette adresse E-Mail ne semble pas valide !</span>');
  define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Cette adresse E-Mail figure dans nos registres !</span>');
  define('ENTRY_COMPANY', 'Soci&eacute;t&eacute; :');
  define('ENTRY_COMPANY_ERROR', 'si soci&eacute;t&eacute;');
  define('ENTRY_PRICING_GROUP', 'Groupe de Prix Discount');
  define('ENTRY_STREET_ADDRESS', 'Adresse :');
  define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caract&egrave;res</span>');
  define('ENTRY_SUBURB', 'Compl&eacute;ment :');
  define('ENTRY_SUBURB_ERROR', '');
  define('ENTRY_POST_CODE', 'Code Postal :');
  define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' caract&egrave;res</span>');
  define('ENTRY_CITY', 'Ville :');
  define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' caract&egrave;res</span>');
  define('ENTRY_STATE', 'Localisation :');
  define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">requis</span>');
  define('ENTRY_COUNTRY', 'Pays :');
  define('ENTRY_COUNTRY_ERROR', '');
  define('ENTRY_TELEPHONE_NUMBER', 'Num&eacute;ro de T&eacute;l&eacute;phone :');
  define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caract&egrave;res</span>');
  define('ENTRY_FAX_NUMBER', 'Num&eacute;ro de Fax :');
  define('ENTRY_FAX_NUMBER_ERROR', '');
  define('ENTRY_NEWSLETTER', 'Newsletter :');
  define('ENTRY_NEWSLETTER_YES', 'Souscrite');
  define('ENTRY_NEWSLETTER_NO', 'Non souscrite');
  define('ENTRY_NEWSLETTER_ERROR', '');

// images
  define('IMAGE_ANI_SEND_EMAIL', 'envoi E-Mail');
  define('IMAGE_BACK', 'retour');
  define('IMAGE_BACKUP', 'sauvegarder');
  define('IMAGE_CANCEL', 'annuler');
  define('IMAGE_CONFIRM', 'confirmer');
  define('IMAGE_COPY', 'copier');
  define('IMAGE_COPY_TO', 'copier vers');
  define('IMAGE_DETAILS', 'd&eacute;tails');
  define('IMAGE_DELETE', 'effacer');
  define('IMAGE_EDIT', '&eacute;diter');
  define('IMAGE_EMAIL', 'E-mail');
  define('IMAGE_FILE_MANAGER', 'fichiers');
  define('IMAGE_ICON_STATUS_GREEN', 'actif');
  define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'activer');
  define('IMAGE_ICON_STATUS_RED', 'inactif');
  define('IMAGE_ICON_STATUS_RED_LIGHT', 'd&eacute;sactiver');
  define('IMAGE_ICON_INFO', 'info');
  define('IMAGE_INSERT', 'ins&eacute;rer');
  define('IMAGE_LOCK', 'verrouiller');
  define('IMAGE_MODULE_INSTALL', 'installer');
  define('IMAGE_MODULE_REMOVE', 'd&eacute;sinstaller');
  define('IMAGE_MOVE', 'd&eacute;placer');
  define('IMAGE_NEW_BANNER', 'nouvelle banni&egrave;re');
  define('IMAGE_NEW_CATEGORY', 'nouvelle cat&eacute;gorie');
  define('IMAGE_NEW_COUNTRY', 'nouveau pays');
  define('IMAGE_NEW_CURRENCY', 'nouvelle devise');
  define('IMAGE_NEW_FILE', 'nouveau fichier');
  define('IMAGE_NEW_FOLDER', 'nouveau r&eacute;pertoire');
  define('IMAGE_NEW_LANGUAGE', 'nouvelle langue');
  define('IMAGE_NEW_NEWSLETTER', 'nouvelle newsletter');
  define('IMAGE_NEW_PRODUCT', 'nouveau produit');
  define('IMAGE_NEW_SALE', 'nouvelle vente');
  define('IMAGE_NEW_TAX_CLASS', 'nouvelle classe de taxes');
  define('IMAGE_NEW_TAX_RATE', 'nouveau taux de taxes');
  define('IMAGE_NEW_TAX_ZONE', 'nouvelle z&ocirc;ne de taxes');
  define('IMAGE_NEW_ZONE', 'nouvelle z&ocirc;ne');
  define('IMAGE_OPTION_NAMES', 'classer les options');
  define('IMAGE_OPTION_VALUES', 'valeurs des options');
  define('IMAGE_ORDERS', 'commandes');
  define('IMAGE_ORDERS_INVOICE', 'factures');
  define('IMAGE_ORDERS_PACKINGSLIP', '&eacute;tiquettage');
  define('IMAGE_PREVIEW', 'pr&eacute;visualiser');
  define('IMAGE_RESTORE', 'restaurer');
  define('IMAGE_RESET', 'remettre &agrave; z&eacute;ro');
  define('IMAGE_SAVE', 'sauvegarder');
  define('IMAGE_SEARCH', 'chercher');
  define('IMAGE_SELECT', 's&eacute;lectionner');
  define('IMAGE_SEND', 'envoyer');
  define('IMAGE_SEND_EMAIL', 'envoyer E-mail');
  define('IMAGE_UNLOCK', 'd&eacute;verrouiller');
  define('IMAGE_UPDATE', 'actualiser');
  define('IMAGE_UPDATE_CURRENCIES', 'actualiser le taux de change');
  define('IMAGE_UPLOAD', 't&eacute;l&eacute;charger');
  define('IMAGE_TAX_RATES','taux de taxe');
  define('IMAGE_DEFINE_ZONES','d&eacute;finir les z&ocirc;nes');
  define('IMAGE_PRODUCTS_PRICE_MANAGER', 'prix des produits');
  define('IMAGE_UPDATE_PRICE_CHANGES', 'actualiser le prix des produits');
  define('IMAGE_ADD_BLANK_DISCOUNTS','ajouter une qt&eacute; de' . DISCOUNT_QTY_ADD . ' coupons de r&eacute;duction');
  define('IMAGE_CHECK_VERSION', 'v&eacute;rifier la version de Zen Cart');
  define('IMAGE_PRODUCTS_TO_CATEGORIES', 'Lien Manager de Cat&eacute;gories Multiple ');
  
  define('IMAGE_ICON_STATUS_ON', 'statut - activ&eacute;');
  define('IMAGE_ICON_STATUS_OFF', 'statut - d&eacute;sactiv&eacute;');
  define('IMAGE_ICON_LINKED', 'le produit est li&eacute;');

  define('IMAGE_REMOVE_SPECIAL','effacer info Promotion');
  define('IMAGE_REMOVE_FEATURED','effacer info Coup de Coeur');
  define('IMAGE_INSTALL_SPECIAL', 'ajouter info Promotion');
  define('IMAGE_INSTALL_FEATURED', 'ajouter info Coup de Coeur');

  define('ICON_PRODUCTS_PRICE_MANAGER','manager des produits');
  define('ICON_COPY_TO', 'copier vers');
  define('ICON_CROSS', 'faux');
  define('ICON_CURRENT_FOLDER', 'r&eacute;pertoire Courant');
  define('ICON_DELETE', 'effacer');
  define('ICON_EDIT', '&eacute;diter');
  define('ICON_ERROR', 'erreur');
  define('ICON_FILE', 'fichier');
  define('ICON_FILE_DOWNLOAD', 't&eacute;l&eacute;charger');
  define('ICON_FOLDER', 'r&eacute;pertoire');
  define('ICON_LOCKED', 'verrouiller');
  define('ICON_MOVE', 'd&eacute;placer');
  define('ICON_PREVIOUS_LEVEL', 'niveau pr&eacute;c&eacute;dent');
  define('ICON_PERMISSIONS', 'Permissions');
define('ICON_PREVIOUS_LEVEL', 'Previous Level');
  define('ICON_PREVIEW', 'pr&eacute;visualiser');
  define('ICON_RESET', 'remettre &agrave; z&eacute;ro');
  define('ICON_STATISTICS', 'statistiques');
  define('ICON_SUCCESS', 'succ&egrave;s');
  define('ICON_TICK', 'vrai');
  define('ICON_UNLOCKED', 'd&eacute;verrouiller');
  define('ICON_WARNING', 'attention');

// constants for use in zen_prev_next_display function
  define('TEXT_RESULT_PAGE', 'Page %s &agrave; %d');
  define('TEXT_DISPLAY_NUMBER_OF_ADMINS', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> admins)');
  define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> banni&egrave;res)');
  define('TEXT_DISPLAY_NUMBER_OF_CATEGORIES', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> cat&eacute;gories)');
  define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> pays)');
  define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> clients)');
  define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> devises)');
  define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> langues)');
  define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> fabricants)');
  define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> newsletters)');
  define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> commandes)');
  define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> &eacute;tats des commandes)');
  define('TEXT_DISPLAY_NUMBER_OF_PRICING_GROUPS', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> groupes de prix)');
  define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> produits)');
  define('TEXT_DISPLAY_NUMBER_OF_PRODUCT_TYPES', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> types de produits)');
  define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> articles attendus)');
  define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> avis)');
  define('TEXT_DISPLAY_NUMBER_OF_SALES', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> ventes)');
  define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> promotions)');
  define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> classes de taxes)');
  define('TEXT_DISPLAY_NUMBER_OF_TEMPLATES', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> associations de template)');
  define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> z&ocirc;nes de taxes)');
  define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> taux de taxes)');
  define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> z&ocirc;nes)');

  define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
  define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');


  define('TEXT_DEFAULT', 'd&eacute;faut');
  define('TEXT_SET_DEFAULT', 'D&eacute;finir par d&eacute;faut');
  define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Requis</span>');

  define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Erreur : aucune devise par d&eacute;faut sp&eacute;cifi&eacute;e. Veuillez consulter votre panneau Admin Outils->Localisation->Devises');

  define('TEXT_CACHE_CATEGORIES', 'Bloc des Cat&eacute;gories');
  define('TEXT_CACHE_MANUFACTURERS', 'Bloc des Fabricants');
  define('TEXT_CACHE_ALSO_PURCHASED', 'Module Achats Connexes');

  define('TEXT_NONE', '--aucun--');
  define('TEXT_TOP', 'Top');

  define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Erreur : destination inconnue %s');
  define('ERROR_DESTINATION_NOT_WRITEABLE', 'Erreur : destination non inscriptible %s');
  define('ERROR_FILE_NOT_SAVED', 'Erreur : fichier non sauvegard&eacute;.');
  define('ERROR_FILETYPE_NOT_ALLOWED', 'Erreur : %s est un type de fichiers interdit');
  define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Succ&egrave;s : fichier %s sauvegard&eacute;');
  define('WARNING_NO_FILE_UPLOADED', 'Attention : fichier non sauvegard&eacute;.');
  define('WARNING_FILE_UPLOADS_DISABLED', 'Attention : la fonction de t&eacute;l&eacute;chargement de fichiers est inactive dans le fichier php.ini.');
  define('ERROR_ADMIN_SECURITY_WARNING', 'Attention : Votre connexion en Admin est non s&eacute;curis&eacute;e... Soit vous avez un r&eacute;glage initial Admin admin, soit le mode : demo demoonly est encore en place<br />Le(s) login(s) doivent &ecirc;tre chang&eacute; pour des raisons de s&eacute;curit&eacute;<br />Pour de plus amples informations concernant la s&eacute;curit&eacute;, veuillez consulter le r&eacute;pertoire /docs');
  define('WARNING_DATABASE_VERSION_OUT_OF_DATE','Il semble que votre base de donn&eacute;es doivent &ecirc;tre patch&eacute;e (upgrade). Cf : Outils->Info Serveur.');
  define('WARN_DATABASE_VERSION_PROBLEM','true'); //set to false to turn off warnings about database version mismatches
define('WARNING_ADMIN_DOWN_FOR_MAINTENANCE', '<strong>WARNING:</strong> Site is currently set to Down for Maintenance ...<br />NOTE: You cannot test most Payment and Shipping Modules in Maintenance mode');

  define('_JANUARY', 'Janvier');
  define('_FEBRUARY', 'F&eacute;vrier');
  define('_MARCH', 'Mars');
  define('_APRIL', 'Avril');
  define('_MAY', 'Mai');
  define('_JUNE', 'Juin');
  define('_JULY', 'Juillet');
  define('_AUGUST', 'Ao&ucirc;t');
  define('_SEPTEMBER', 'Septembre');
  define('_OCTOBER', 'Octobre');
  define('_NOVEMBER', 'Novembre');
  define('_DECEMBER', 'D&eacute;cembre');

  define('TEXT_DISPLAY_NUMBER_OF_GIFT_VOUCHERS', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> Ch&egrave;ques Cadeaux)');
  define('TEXT_DISPLAY_NUMBER_OF_COUPONS', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> Coupons de r&eacute;ductions)');

  define('TEXT_VALID_PRODUCTS_LIST', 'Listes des Produits');
  define('TEXT_VALID_PRODUCTS_ID', 'ID des Produits');
  define('TEXT_VALID_PRODUCTS_NAME', 'Noms des Produits');
  define('TEXT_VALID_PRODUCTS_MODEL', 'Mod&egrave;les des Produits');

  define('TEXT_VALID_CATEGORIES_LIST', 'Listes des Cat&eacute;gories');
  define('TEXT_VALID_CATEGORIES_ID', 'ID de la Cat&eacute;gorie');
  define('TEXT_VALID_CATEGORIES_NAME', 'Nom de la Cat&eacute;gorie');

  define('DEFINE_LANGUAGE','Langage:');

  define('BOX_ENTRY_COUNTER_DATE','Activation');
  define('BOX_ENTRY_COUNTER','Compteur de Hits');

// not installed
  define('NOT_INSTALLED_TEXT','Non Install&eacute;');

// Product Options Values Sort Order - option_values.php
  define('BOX_CATALOG_PRODUCT_OPTIONS_VALUES','Valeurs des Options');

  define('TEXT_UPDATE_SORT_ORDERS_OPTIONS','<strong>Actualiser le Classement des Attributs sur la base des Valeurs par D&eacute;faut des Options</strong> ');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_UPDATES','<strong>Actualiser tous les Classements des Attributs de Produits</strong><br />sur la Base du Classement par D&eacute;faut des Valeurs des Options :<br />');

// Product Options Name Sort Order - option_values.php
  define('BOX_CATALOG_PRODUCT_OPTIONS_NAME','Classer les Options');

// Attributes only
  define('BOX_CATALOG_CATEGORIES_ATTRIBUTES_CONTROLLER','Contr&ocirc;le des Attributs');

// generic model
  define('TEXT_MODEL','Mod&egrave;le :');

// column controller
  define('BOX_TOOLS_LAYOUT_CONTROLLER','Contr&ocirc;le des Blocs');

// check GV release queue and alert store owner
  define('SHOW_GV_QUEUE',true);
  define('TEXT_SHOW_GV_QUEUE','%s en attente de validation ');
  define('IMAGE_GIFT_QUEUE', TEXT_GV_NAME . ' Queue');
  define('IMAGE_ORDER','Commande');

  define('BOX_TOOLS_EMAIL_WELCOME','E-mail de Bienvenue');

  define('IMAGE_DISPLAY','Afficher');
  define('IMAGE_UPDATE_SORT','Actualiser le classement');
  define('IMAGE_EDIT_PRODUCT','Editer un Produit');
  define('IMAGE_EDIT_ATTRIBUTES','Editer des Attributs');
  define('TEXT_NEW_PRODUCT', 'Produit dans Cat&eacute;gorie : &quot;%s&quot;');
  define('IMAGE_OPTIONS_VALUES','Noms et Valeurs des Options');
  define('TEXT_PRODUCTS_PRICE_MANAGER','MANAGER DU PRIX DES PRODUITS');
  define('TEXT_PRODUCT_EDIT','EDITER PRODUIT');
  define('TEXT_ATTRIBUTE_EDIT','EDITER ATTRIBUTS');
  define('TEXT_PRODUCT_DETAILS','VOIR DETAILS');

// sale maker
  define('DEDUCTION_TYPE_DROPDOWN_0', 'D&eacute;duire montant');
  define('DEDUCTION_TYPE_DROPDOWN_1', 'Pourcentage');
  define('DEDUCTION_TYPE_DROPDOWN_2', 'Nouveau Prix');

// Min and Units
  define('PRODUCTS_QUANTITY_MIN_TEXT_LISTING','Min :');
  define('PRODUCTS_QUANTITY_UNIT_TEXT_LISTING','Unit&eacute;s :');
  define('PRODUCTS_QUANTITY_IN_CART_LISTING','Dans le Panier :');
  define('PRODUCTS_QUANTITY_ADD_ADDITIONAL_LISTING','Ajouter :');

  define('TEXT_PRODUCTS_MIX_OFF','*Aucune Option Mix');
  define('TEXT_PRODUCTS_MIX_ON','*Options Mix');

// search filters
  define('TEXT_INFO_SEARCH_DETAIL_FILTER','Filtre de Recherche : ');
  define('HEADING_TITLE_SEARCH_DETAIL','Recherche : ');

  define('PREV_NEXT_PRODUCT', 'Produits : ');
  define('TEXT_CATEGORIES_STATUS_INFO_OFF', '<span class="alert">*La Categorie est D&eacute;sactiv&eacute;e</span>');
  define('TEXT_PRODUCTS_STATUS_INFO_OFF', '<span class="alert">*Le Produit est D&eacute;sactiv&eacute;</span>');

// admin demo
  define('ADMIN_DEMO_ACTIVE','Admin en D&eacute;mo est actuellement Actif. Certains r&eacute;glages seront d&eacute;sactiv&eacute;s');
  define('ADMIN_DEMO_ACTIVE_EXCLUSION','Admin en D&eacute;mo est actuellement Actif. Certains r&eacute;glages seront d&eacute;sactiv&eacute;s - <strong>NOTE : fonction de Suppression Admin Activ&eacute;e</strong>');
  define('ERROR_ADMIN_DEMO','Admin en D&eacute;mo est actif... La fonction que vous demandez est donc inactive');

// Version Check notices
  define('TEXT_VERSION_CHECK_NEW_VER','Nouvelle Version Disponible V');
  define('TEXT_VERSION_CHECK_NEW_PATCH','Nouveau PATCH Disponible : V');
  define('TEXT_VERSION_CHECK_PATCH','patch');
  define('TEXT_VERSION_CHECK_DOWNLOAD','T&eacute;l&eacute;charger Ici');
  define('TEXT_VERSION_CHECK_CURRENT','Votre Version de Zen Cart est actualis&eacute;e.');

// downloads manager
  define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_DOWNLOADS_MANAGER', 'Afficher <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> t&eacute;l&eacute;chargements)');
  define('BOX_CATALOG_CATEGORIES_ATTRIBUTES_DOWNLOADS_MANAGER', 'T&eacute;l&eacute;chargements');

  define('BOX_CATALOG_FEATURED','Coups de Coeur');

  define('ERROR_NOTHING_SELECTED', 'Aucune s&eacute;lection... donc aucun changement');
  define('TEXT_STATUS_WARNING','<strong>NOTE :</strong> le statut est activ&eacute;/d&eacute;sactiv&eacute; automatiquement lorsque les dates sont r&eacute;gl&eacute;es');

  define('TEXT_LEGEND_LINKED', 'Produit Li&eacute;');
  define('TEXT_MASTER_CATEGORIES_ID','Cat&eacute;gorie de Produit Principal :');
  define('TEXT_LEGEND', 'LEGENDE : ');
  define('TEXT_LEGEND_STATUS_OFF', 'Statut OFF ');
  define('TEXT_LEGEND_STATUS_ON', 'Statut ON ');

  define('TEXT_INFO_MASTER_CATEGORIES_ID', '<strong>NOTE : la Cat&eacute;gorie de Produit Principal est utilis&eacute;e pour fixer des prix lorsque<br />la Cat&eacute;gorie de Produits affecte le prix des Produits Li&eacute;s, example : Ventes</strong>');
  define('TEXT_YES', 'Oui');
  define('TEXT_NO', 'Non');

// shipping error messages
  define('ERROR_SHIPPING_CONFIGURATION', '<strong>Erreurs dans la configuration de la Livraison !</strong>');
  define('ERROR_SHIPPING_ORIGIN_ZIP', '<strong>Attention :</strong> le Code Postal de la Boutique est absent. Veuillez consulter les rubriques Configuration | Livraisons/Conditionnement.');
  define('ERROR_ORDER_WEIGHT_ZERO_STATUS', '<strong>Attention :</strong> le poids 0 est configur&eacute; pour les Livraisons Gratuites, et le Module des Livraisons Gratuites est d&eacute;sactiv&eacute;.');
  define('ERROR_USPS_STATUS', '<strong>Attention :</strong> USPS ne peut identifier cet utilisateur et/ou le mot de passe, ou la configuration du module ne soit en position TEST au lieu de PRODUCTION.<br />Si les estimations ne fonctionnent toujours pas, veuillez contacter USPS pour activer votre compte.');

// text pricing
  define('TEXT_CHARGES_WORD','Montant Calcul&eacute; : ');
  define('TEXT_PER_WORD','<br />Price par mot : ');
  define('TEXT_WORDS_FREE',' Mot(s) gratuit(s) ');
  define('TEXT_CHARGES_LETTERS','Montant Calcul&eacute; : ');
  define('TEXT_PER_LETTER','<br />Prix par Lettre : ');
  define('TEXT_LETTERS_FREE',' Lettre(s) gratuite(s) ');
  define('TEXT_ONETIME_CHARGES','*paiement unique = ');
  define('TEXT_ONETIME_CHARGES_EMAIL',"\t" . '*paiement unique = ');
  define('TEXT_ATTRIBUTES_QTY_PRICES_HELP', 'Remises avec Options de Quantit&eacute;s');
  define('TABLE_ATTRIBUTES_QTY_PRICE_QTY','QTE');
  define('TABLE_ATTRIBUTES_QTY_PRICE_PRICE','PRIX');
  define('TEXT_ATTRIBUTES_QTY_PRICES_ONETIME_HELP', 'Remises sur Quantit&eacute;s d\'Options avec Paiement Unique');
  define('TEXT_CATEGORIES_PRODUCTS', 'S&eacute;lectionnez une Cat&eacute;gorie de Produits... ou naviguez parmi les Produits');
  define('TEXT_PRODUCT_TO_VIEW', 'S&eacute;lectionnez un Produit pour le visualiser et appuyez sur afficher...');

define('TEXT_INFO_SET_MASTER_CATEGORIES_ID', 'ID de Cat&eacute;gorie Master Invalide');
define('TEXT_INFO_ID', ' ID# ');
define('TEXT_INFO_SET_MASTER_CATEGORIES_ID_WARNING', '<strong>ATTENTION :</strong> Ce Produit est li&eacute; &agrave; des Cat&eacute;gories Multiples mais aucune Cat&eacute;gorie Master d&eacute;finie !');

define('PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT', 'Le produit est en Prix sur Demande');
define('PRODUCTS_PRICE_IS_FREE_TEXT','Produit Gratuit');

define('TEXT_PRODUCT_WEIGHT_UNIT','kg');

// min, max, units
  define('PRODUCTS_QUANTITY_MAX_TEXT_LISTING', 'Max :');

// Discount Savings
  define('PRODUCT_PRICE_DISCOUNT_PREFIX','Economie :&nbsp;');
  define('PRODUCT_PRICE_DISCOUNT_PERCENTAGE','% d\'&eacute;conomie');
  define('PRODUCT_PRICE_DISCOUNT_AMOUNT','&nbsp;d\'&eacute;conomie');
// Sale Maker Sale Price
  define('PRODUCT_PRICE_SALE','Prix :&nbsp;');

// Rich Text / HTML resources
  define('TEXT_HTML_EDITOR_NOT_DEFINED','Si aucun &eacute;diteur HTML n\'est d&eacute;fini ou que la fonction JavaScript est d&eacute;sactiv&eacute;e, vous pouvez saisir du code HTML.');
  define('TEXT_WARNING_HTML_DISABLED','<span class = "main">Note : vous utilisez le format TEXTE seul pour vos emails. Si vous souhaitez poster vos courriers en mode HTML, vous devez activer la fonction "utiliser MIME HTML" dans les Options d\'Emails</span>');
  define('TEXT_WARNING_CANT_DISPLAY_HTML','<span class = "main">Note : vous utilisez le format TEXTE seul pour vos emails. Si vous souhaitez poster vos courriers en mode HTML, vous devez activer la fonction "utiliser MIME HTML" dans les Options d\'Emails</span>');
  define('TEXT_EMAIL_CLIENT_CANT_DISPLAY_HTML',"Vous visualisez ce texte car nous vous avons adress&eacute; un mail au format HTML que votre client mail ne peut restituer au format requis.");
  define('ENTRY_EMAIL_PREFERENCE','P&eacute;f de Format Email :');
  define('ENTRY_EMAIL_FORMAT_COMMENTS','Choisir "aucun" ou "d&eacute;sinscrire" d&eacute;sactive ALL mail, y compris les d&eacute;tails des commandes');
  define('ENTRY_EMAIL_HTML_DISPLAY','HTML');
  define('ENTRY_EMAIL_TEXT_DISPLAY','Texte');
  define('ENTRY_EMAIL_NONE_DISPLAY','Jamais');
  define('ENTRY_EMAIL_OPTOUT_DISPLAY','D&eacute;sinscription des Newsletters');
  define('ENTRY_NOTHING_TO_SEND','Vous n\'avez saisi aucun texte pour votre message');
  define('EMAIL_SEND_FAILED','ERREUR : Echec envoi Email &agrave; : "%s" <%s> avec le sujet : "%s"');
 
// toggle on/off
  define('TEXT_HTML_AREA', 'HTMLarea');
  define('TEXT_EDITOR_INFO', 'Editeur de Texte');
  define('TEXT_CATEGORIES_PRODUCTS_SORT_ORDER_INFO', 'Classement Produits');
  define('TEXT_SORT_PRODUCTS_SORT_ORDER_PRODUCTS_NAME', 'Classement Produits, Noms Produits');
  define('TEXT_SORT_PRODUCTS_NAME', 'Noms Produits');
  define('TEXT_SORT_PRODUCTS_MODEL', 'Mod&egrave;le');
  define('TEXT_SORT_PRODUCTS_QUANTITY', 'Quantit&eacute; de produit+, Noms Produits');
  define('TEXT_SORT_PRODUCTS_QUANTITY_DESC', 'Quantit&eacute; de produit-, Noms Produits');
  define('TEXT_SORT_PRODUCTS_PRICE', 'Prix du Produit+, Noms Produits');
  define('TEXT_SORT_PRODUCTS_PRICE_DESC', 'Prix du Produit-, Noms Produits');
  define('TEXT_SORT_CATEGORIES_SORT_ORDER_PRODUCTS_NAME', 'Classement de cat&eacute;gories, Nom de cat&eacute;gories');
  define('TEXT_SORT_CATEGORIES_NAME', 'Nom de cat&eacute;gories');



  define('TABLE_HEADING_YES','Oui');
  define('TABLE_HEADING_NO','Non');
  define('TEXT_IMAGES_OVERWRITE', 'Effacer l\'Image Actuelle ? Choisissez Non pour une saisie manuelle du texte');
  define('TEXT_IMAGE_OVERWRITE_WARNING','ATTENTION : LE FICHIER a &eacute;t&eacute; actualis&eacute; et non effac&eacute; ');

  define('ERROR_DEFINE_OPTION_NAMES', 'Attention : aucun nom d\'Option d&eacute;fini');
  define('ERROR_DEFINE_OPTION_VALUES', 'Attention : aucune Valeur d\'Option d&eacute;finie');
  define('ERROR_DEFINE_PRODUCTS', 'Attention : aucun Produit d&eacute;fini');
  define('ERROR_DEFINE_PRODUCTS_MASTER_CATEGORIES_ID', 'Attention: Aucune identification principale de catigories n\'a iti placie pour ce produit');

  define('BUTTON_ADD_PRODUCT_TYPES_SUBCATEGORIES_ON','Ajouter en incluant les Sous-Cat&eacute;gories');
  define('BUTTON_ADD_PRODUCT_TYPES_SUBCATEGORIES_OFF','Ajouter en excluant les Sous-Cat&eacute;gories');

  define('BUTTON_PREVIOUS_ALT','Produit Pr&eacute;c&eacute;dent');
  define('BUTTON_NEXT_ALT','Produit Suivant');

  define('BUTTON_PRODUCTS_TO_CATEGORIES', 'Manager de Liens Cat&eacute;gories Multiples');
  define('BUTTON_PRODUCTS_TO_CATEGORIES_ALT', 'Copier un Produit vers des Cat&eacute;gories Multiples');

  define('TEXT_INFO_OPTION_NAMES_VALUES_COPIER_STATUS', 'Copier toutes les Caract&eacute;ristiques Globales, ajouter et effacer le Statut des Caract&eacute;ristiques est actuellement sur OFF');
  define('TEXT_SHOW_OPTION_NAMES_VALUES_COPIER_ON', 'Afficher les Caract&eacute;ristiques Globales - ON');
  define('TEXT_SHOW_OPTION_NAMES_VALUES_COPIER_OFF', 'Afficher les Caract&eacute;ristiques Globales - OFF');

// moved from categories and all product type language files
  define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Erreur: impossible de lier les produits &aacute; la m&ecirc;me Cat&eacute;gorie.');
  define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Erreur: le r&eacute;pertoire Images du Catalog n\'est pas inscriptible: ' . DIR_FS_CATALOG_IMAGES);
  define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Erreur: le r&eacute;pertoire Images du Catalog n\'existe pas: ' . DIR_FS_CATALOG_IMAGES);
  define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Erreur: la Cat&eacute;gorie ne peut &ecirc;tre d&eacute;plac&eacute;e vers une Cat&eacute;gorie Enfant.');
  define('ERROR_CANNOT_MOVE_PRODUCT_TO_CATEGORY_SELF', 'Erreur: impossible de d&eacute;placer le Produit vers la m&ecirc;me Cat&eacute;gorie ou vers une Cat&eacute;gorie qui existe d&eacute;j&agrave;.');
  define('ERROR_CATEGORY_HAS_PRODUCTS', 'Error: Category has Products!<br /><br />While this can be done temporarily to build your Categories ... Categories hold either Products or Categories but never both!');
  define('SUCCESS_CATEGORY_MOVED', 'Succ&egrave;s ! La cat&eacute;gorie a &eacute;t&eacute; d&eacute;plac&eacute;e avec succ&egrave;s ...');
  define('ERROR_CANNOT_MOVE_CATEGORY_TO_CATEGORY_SELF', 'Erreur: Impossible de d&eacute;placer la cat&eacute;gorie &agrave; la m&ecirc;me cat&eacute;gorie ! ID#');

// EZ-PAGES Alerts
  define('TEXT_EZPAGES_STATUS_HEADER_ADMIN', 'Attention: EZ-PAGES HEADER - On for Admin IP Only');
  define('TEXT_EZPAGES_STATUS_FOOTER_ADMIN', 'Attention: EZ-PAGES FOOTER - On for Admin IP Only');
  define('TEXT_EZPAGES_STATUS_SIDEBOX_ADMIN', 'Attention: EZ-PAGES SIDEBOX - On for Admin IP Only');

// moved from product types
// warnings on Virtual and Always Free Shipping
define('TEXT_VIRTUAL_PREVIEW','Attention: Ce produit est marqu&eacute; - Livraison Gratuit et saute l\'adresse de livraison<br />Aucune adresse de livraison ne sera demand&eacute;e quand tous les produits command&eacute;s sont des produits virtuels');
define('TEXT_VIRTUAL_EDIT','Attention: Ce produit est marqu&eacute; - Livraison Gratuit et saute l\'adresse de livraison<br />Aucune adresse de livraison ne sera demand&eacute;e quand tous les produits command&eacute;s sont des produits virtuels');
define('TEXT_FREE_SHIPPING_PREVIEW','Ce produit est marqu&eacute; - Livraison Gratuit, Adresse de livraison Requise<br />Free Shipping Module is required when all products in the order are Always Free Shipping Products');
define('TEXT_FREE_SHIPPING_EDIT','Attention: Yes makes the product - Livraison Gratuit, Adresse de livraison Requise<br />Free Shipping Module is required when all products in the order are Always Free Shipping Products');

// admin activity log warnings
define('WARNING_ADMIN_ACTIVITY_LOG_DATE', 'Attention: La table de fichier de log d\'activit&amp;eacute; a plus de 2 mois d\'enregistrement et devrait &amp;ecirc;tre nettoy&amp;eacute;e... ');
define('WARNING_ADMIN_ACTIVITY_LOG_RECORDS', 'Attention: La table de fichier de log d\'activit&amp;eacute; a plus de 50,000 enregistrements et devrait &amp;ecirc;tre nettoy&amp;eacute;e... ');
define('RESET_ADMIN_ACTIVITY_LOG', 'Remettre &agrave; z&eacute;ro le fichier de log d\'activit&eacute; &agrave; partir de la configuration');

define('CATEGORY_HAS_SUBCATEGORIES', 'NOTE: Cat&eacute;gorie a une sous-cat&eacute;gorie<br />Impossible d\'ajouter des articles');  

///////////////////////////////////////////////////////////
// include additional files:
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . FILENAME_EMAIL_EXTRAS);
  include(zen_get_file_directory(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/', FILENAME_OTHER_IMAGES_NAMES, 'false'));


?>