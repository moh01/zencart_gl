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
// $Id: spanish.php,v 1.5 2006/01/18 19:17:05 gorkau Exp $
//
require(DIR_FS_CATALOG . 'includes/languages/spanish/extra_data.php');

// bof: removed for meta tags
// page title
//define('TITLE', 'Zen Cart!');

// Site Tagline
//define('SITE_TAGLINE', 'The Art of E-commerce');

// Custom Keywords
//define('CUSTOM_KEYWORDS', 'ecommerce, open source, shop, online shopping');
// eof: removed for meta tags

define('FOOTER_TEXT_BODY', 'Instalado por <a href="http://www.urlanheat.com">Urlan Heat - Soporte para comercio electrónico</a>');

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat try 'en_US'
// on FreeBSD try 'en_US.ISO_8859-1'
// on Windows try 'en', or 'English'
@setlocale(LC_TIME, 'es_ES.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function zen_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 0, 2) . substr($date, 3, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
  }
}


// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'EUR');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="es"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'páginas vistas desde');

// Define the name of your Gift Certificate as Gift Voucher, Gift Certificate, Zen Cart Dollars, etc. here for use through out the shop
  define('TEXT_GV_NAME','Vale de compra');
  define('TEXT_GV_NAMES','Vales de compras');

// used for redeem code, redemption code, or redemption id
  define('TEXT_GV_REDEEM','Cupón de descuento');

// text for gender
define('MALE', 'Sr.');
define('FEMALE', 'Sra.');
define('MALE_ADDRESS', 'Sr.');
define('FEMALE_ADDRESS', 'Sra.');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/yyyy');

//text for sidebox heading links
define('BOX_HEADING_LINKS', '&nbsp;&nbsp;');

// categories box text in sideboxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Categorías');

// manufacturers box text in sideboxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Fabricantes');

// whats_new box text in sideboxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'Novedades');
define('CATEGORIES_BOX_HEADING_WHATS_NEW', 'Nuevos productos');

define('BOX_HEADING_FEATURED_PRODUCTS', 'Destacado');
define('CATEGORIES_BOX_HEADING_FEATURED_PRODUCTS', 'Productos destacados');
define('TEXT_NO_FEATURED_PRODUCTS', 'En breve añadiremos más productos. Visítenos regularmente para conocer las novedades.');

define('TEXT_NO_ALL_PRODUCTS', 'En breve añadiremos más productos. Visítenos regularmente para conocer las novedades.');
define('CATEGORIES_BOX_HEADING_PRODUCTS_ALL', 'Todos los productos');

// quick_find box text in sideboxes/quick_find.php
define('BOX_HEADING_SEARCH', 'Buscar');
define('BOX_SEARCH_ADVANCED_SEARCH', 'Búsqueda avanzada');

// specials box text in sideboxes/specials.php
define('BOX_HEADING_SPECIALS', 'Ofertas');
define('CATEGORIES_BOX_HEADING_SPECIALS','Ofertas');

// reviews box text in sideboxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Comentarios');
define('BOX_REVIEWS_WRITE_REVIEW', 'Escriba un comentario de este producto.');
define('BOX_REVIEWS_NO_REVIEWS', 'Actualmente no hay comentarios de productos.');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s de 5 estrellas!');

// shopping_cart box text in sideboxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Cesta de la compra');
define('BOX_SHOPPING_CART_EMPTY', '0 artículos');
define('BOX_SHOPPING_CART_DIVIDER', '-&nbsp;');

// order_history box text in sideboxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', 'Compras recientes');

// best_sellers box text in sideboxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Los más vendidos');
define('BOX_HEADING_BESTSELLERS_IN', 'Los más vendidos en <br />&nbsp;&nbsp;');

// notifications box text in sideboxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', 'Avisos');
define('BOX_NOTIFICATIONS_NOTIFY', 'Avísenme cuando haya actualizaciones a <strong>%s</strong>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'No me notifiquen de actualizaciones a<strong>%s</strong>');

// manufacturer box text
define('BOX_HEADING_MANUFACTURER_INFO', 'Info. del fabricante');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', 'Web de %s');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Otros productos');


// languages box text in sideboxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Idiomas');

// currencies box text in sideboxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'Monedas');

// information box text in sideboxes/information.php
define('BOX_HEADING_INFORMATION', 'Información');
define('BOX_INFORMATION_PRIVACY', 'Aviso de privacidad');
define('BOX_INFORMATION_CONDITIONS', 'Condiciones de uso');
define('BOX_INFORMATION_SHIPPING', 'Envío y devoluciones');
define('BOX_INFORMATION_CONTACT', 'Contáctenos');
define('BOX_BBINDEX', 'Foro');
define('BOX_INFORMATION_UNSUBSCRIBE', 'Baja del boletín');
define('BOX_INFORMATION_SITE_MAP', 'Mapa de la web');
define('BOX_INFORMATION_DISCOUNT_COUPONS', 'Cupones descuento');


// information box text in sideboxes/more_information.php - were TUTORIAL_
define('BOX_HEADING_MORE_INFORMATION', 'Más información');
define('BOX_INFORMATION_PAGE_1', 'Página 1');
define('BOX_INFORMATION_PAGE_2', 'Página 2');
define('BOX_INFORMATION_PAGE_3', 'Página 3');
define('BOX_INFORMATION_PAGE_4', 'Página 4');
define('BOX_INFORMATION_PAGE_5', 'Página 5');
define('BOX_INFORMATION_PAGE_6', 'Página 6');
define('BOX_INFORMATION_PAGE_7', 'Página 7');
define('BOX_INFORMATION_PAGE_8', 'Página 8');
define('BOX_INFORMATION_PAGE_9', 'Página 9');
define('BOX_INFORMATION_PAGE_10', 'Página 10');
define('BOX_INFORMATION_PAGE_11', 'Página 11');

//paginas adicionales
define('BOX_INFORMATION_PAGE_5', 'Página 5');
define('BOX_INFORMATION_PAGE_6', 'Página 6');
define('BOX_INFORMATION_PAGE_7', 'Página 7');

// tell a friend box text in sideboxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'Recomendar');
define('BOX_TELL_A_FRIEND_TEXT', 'Recomiende este producto a un conocido.');

// wishlist box text in includes/boxes/wishlist.php
define('BOX_HEADING_CUSTOMER_WISHLIST', 'Mis favoritos');
define('BOX_WISHLIST_EMPTY', 'No tiene ningún articulo en sus favoritos');
define('IMAGE_BUTTON_ADD_WISHLIST', 'Añadir a favoritos');
define('TEXT_WISHLIST_COUNT', 'Actualmente %s articulos están en sus favoritos.');
define('TEXT_DISPLAY_NUMBER_OF_WISHLIST', 'Mostrando <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> articulos de sus favoritos)');

//New billing address text
define('SET_AS_PRIMARY' , 'Marcar como dirección principal');
define('NEW_ADDRESS_TITLE', 'Dirección de cobro');

// javascript messages
define('JS_ERROR', 'Ha ocurrido un error durante el procesamiento del formulario.\n\nPor favor realice las siguientes correcciones:\n\n');

define('JS_REVIEW_TEXT', '* El \'texto del comentario\' debe tener al menos ' . REVIEW_TEXT_MIN_LENGTH . ' caracteres.');
define('JS_REVIEW_RATING', '* Debes valorar el producto para tu comentario.');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Por favor seleccione un método de pago para su pedido.');

define('JS_ERROR_SUBMITTED', 'El formulario está siendo enviado. Por favor presione Ok y espere que el proceso sea completado.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Por favor seleccione un método de pago para su pedido.');
define('ERROR_CONDITIONS_NOT_ACCEPTED', 'Por favor confirme los términos y condiciones acerca de este pedido haciendo click en la casilla de abajo.');
define('ERROR_PRIVACY_STATEMENT_NOT_ACCEPTED', 'Por favor confirme la política de privacidad haciendo click en la casilla de abajo.');

define('CATEGORY_COMPANY', 'Empresa');
define('CATEGORY_PERSONAL', 'Datos personales');
define('CATEGORY_ADDRESS', 'Dirección');
define('CATEGORY_CONTACT', 'Información de contacto');
define('CATEGORY_OPTIONS', 'Opciones');
define('CATEGORY_PASSWORD', 'Contraseña');
define('CATEGORY_LOGIN', 'Entrar');
define('PULL_DOWN_DEFAULT', 'Selecciona tu país');

define('ENTRY_COMPANY', 'Nombre / Razón Social:');
define('ENTRY_COMPANY_ERROR', 'El nombre de la empresa debe tener al menos ' . ENTRY_COMPANY_MIN_LENGTH . ' caracteres.');
define('ENTRY_COMPANY_TEXT', '');
// UH - Taxid
define('ENTRY_TAXID_ERROR', 'CIF/NIF incorrecto.');
// UHFIN
define('ENTRY_GENDER', 'Saludo:');
define('ENTRY_GENDER_ERROR', 'Por favor escoge un titulo.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'Nombre:');
define('ENTRY_FIRST_NAME_ERROR', 'El nombre debe tener un mínimo de ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caracteres.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Apellido');
define('ENTRY_LAST_NAME_ERROR', 'El apellido debe tener un mínimo de ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caracteres.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Fecha de nacimiento:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'La Fecha de nacimiento debe estar en este formato: DD/MM/YYYY (ej. 21/05/1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (ej. 21/05/1970)');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'El E-Mail debe tener un mínimo de ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caracteres.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Este E-Mail parece no ser v&aacute;lido - por favor realice las correcciones necesarias.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Este E-Mail ya existe en nuestra base de datos - por favor ingrese con otro e-mail o cree otra cuenta con una dirección de e-mail diferente.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_NICK', 'Nick para el foro:');
define('ENTRY_NICK_TEXT', ''); // note to display beside nickname input field
define('ENTRY_NICK_DUPLICATE_ERROR', 'Ese Nick ya existe.');
define('ENTRY_NICK_LENGTH_ERROR', 'El nick debe tener un mínimo de ' . ENTRY_NICK_MIN_LENGTH . ' caracteres.');
define('ENTRY_STREET_ADDRESS', 'Dirección:');
define('ENTRY_STREET_ADDRESS_ERROR', 'La dirección debe tener un mínimo de  ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caracteres.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_SUBURB', 'Piso / digicode:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Código postal:');
define('ENTRY_POST_CODE_ERROR', 'El código postal debe tener un mínimo de ' . ENTRY_POSTCODE_MIN_LENGTH . ' caracteres.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', 'Población/Ciudad:');
define('ENTRY_CUSTOMERS_REFERRAL', 'Código de referencia:');

define('ENTRY_CITY_ERROR', 'La localidad debe tener un mínimo de ' . ENTRY_CITY_MIN_LENGTH . ' caracteres.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', 'Provincia:');
define('ENTRY_STATE_ERROR', 'El Estado debe tener un mínimo de ' . ENTRY_STATE_MIN_LENGTH . ' caracteres.');
define('ENTRY_STATE_ERROR_SELECT', 'Por favor selecciona un estado en el menú desplegable.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', 'País:');
define('ENTRY_COUNTRY_ERROR', 'Debe seleccionar un país en el menú desplegable.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', 'Teléfono:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'El Teléfono debe tener un mínimo de ' . ENTRY_TELEPHONE_MIN_LENGTH . ' números.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Boletín:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Suscribrirse');
define('ENTRY_NEWSLETTER_NO', 'Darse de baja');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Contraseña:');
define('ENTRY_PASSWORD_ERROR', 'La contraseña debe tener un mínimo de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'La confirmación de la contraseña y la contraseña deben ser iguales.');
define('ENTRY_PASSWORD_TEXT', '* (al menos ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres)');
define('ENTRY_PASSWORD_CONFIRMATION', 'Repite la contraseña:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Contraseña actual:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'La contraseña debe tener un mínimo de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.');
define('ENTRY_PASSWORD_NEW', 'Nueva contraseña:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'La nueva contraseña debe tener un mínimo de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'La confirmación de la contraseña debe ser igual a la nueva contraseña.');
define('PASSWORD_HIDDEN', '--OCULTO--');

define('FORM_REQUIRED_INFORMATION', '* Información necesaria');
  define('ENTRY_REQUIRED_SYMBOL', '*');

// constants for use in zen_prev_next_display function
define('TEXT_RESULT_PAGE', '');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Mostrando de <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> productos)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Mostrando de <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> pedidos)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Mostrando de <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> comentarios)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Mostrando de <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> nuevos productos)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Mostrando de <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> ofertas)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_FEATURED_PRODUCTS', 'Mostrando de <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> featured products)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_ALL', 'Mostrando de <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> products)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'Primera Página');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Página anterior');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Página siguiente');
define('PREVNEXT_TITLE_LAST_PAGE', 'Ultima Página');
define('PREVNEXT_TITLE_PAGE_NO', 'Página %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Listado anterior de %d Páginas');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Siguiente listado  de %d Páginas');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;PRIMERA');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;Anterior]');
define('PREVNEXT_BUTTON_NEXT', '[Siguiente&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', 'ULTIMA&gt;&gt;');

define('TEXT_BASE_PRICE','Starting at: ');

define('TEXT_CLICK_TO_ENLARGE', 'agrandar imagen');

define('TEXT_SORT_PRODUCTS', 'Ordenar productos ');
define('TEXT_DESCENDINGLY', 'descendentemente');
define('TEXT_ASCENDINGLY', 'ascendentemente');
define('TEXT_BY', ' por ');

define('TEXT_REVIEW_BY', 'por %s');
define('TEXT_REVIEW_WORD_COUNT', '%s palabras');
define('TEXT_REVIEW_RATING', 'Rating: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Date Added: %s');
define('TEXT_NO_REVIEWS', 'No hay comentarios de productos.');

define('TEXT_NO_NEW_PRODUCTS', 'Más productos nuevos estarán muy pronto disponibles. Por favor regresa.');

define('TEXT_UNKNOWN_TAX_RATE', 'IVA');

define('TEXT_REQUIRED', '<span class="errorText">Necesario</span>');

define('ERROR_zen_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><strong><small>ZEN ERROR:</small> No se puede enviar el email a través del servidor SMTP especificado. Por favor chequea la configuración del php.ini y corrija el servidor SMTP de ser necesario.</strong></font>');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Advertencia: El directorio de la instalación existe en: ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/zc_install. Por favor elimine este directorio por razones de seguridad.');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Advertencia: Puedo escribir en el archivo de la configuración: ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/includes/configure.php. Esto es un potencial riesgo de seguridad - por favor fije los permisos de derechos del usuario en este archivo.');
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Advertencia: The sessions directory does not exist: ' . zen_session_save_path() . '. Las sesiones no trabajarán hasta que se crea este directorio.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Advertencia: I am not able to write to the sessions directory: ' . zen_session_save_path() . '. Las sesiones no trabajarán hasta que se fijan los permisos derechos del usuario.');
define('WARNING_SESSION_AUTO_START', 'Advertencia: session.auto_start esta habilitado - inhabilite por favor esta característica del php en php.ini y reinicie el servidor.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Advertencia: El directorio para descargar los productos no existe: ' . DIR_FS_DOWNLOAD . '. Los productos descargables no trabajarán hasta que este directorio sea válido.');
define('WARNING_SQL_CACHE_DIRECTORY_NON_EXISTENT', 'Advertencia: El directorio del cache SQL no existe: ' . DIR_FS_SQL_CACHE . '. SQL cacheing no podra trabajar hasta que el directorio sea creado.');
define('WARNING_SQL_CACHE_DIRECTORY_NOT_WRITEABLE', 'Advertencia: No se puede escribir en el directorio SQL cache: ' . DIR_FS_SQL_CACHE . '. SQL cacheing no podrá trabajar hasta que los permisos del usuario sean establecidos.');
define('WARNING_DATABASE_VERSION_OUT_OF_DATE','Su base de datos parece necesitar pasar a un nivel alto  Your database appears to need patching to a higher level. Ver Admin->Tools->Server Information para revisar el patch levels.');


define('TEXT_CCVAL_ERROR_INVALID_DATE', 'La fecha de vencimiento de la tarjeta de crédito es invalido. Por favor revise la fecha e inténtelo de nuevo.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'El número de la tarjeta de crédito ingresado es invalido. Por favor revise el número e inténtelo de nuevo.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'Los primeros cuatro dígitos del número ingresado son: %s. Si este número es correcto, nosotros no aceptamos este tipo de tarjeta de crédito. Si esta equivocado, por favor intente de nuevo.');

define('BOX_INFORMATION_GV', TEXT_GV_NAME . ' FAQ');
define('VOUCHER_BALANCE', TEXT_GV_NAME . ' Balance ');
define('BOX_HEADING_GIFT_VOUCHER', TEXT_GV_NAME . ' Cuenta');
define('GV_FAQ', TEXT_GV_NAME . ' FAQ');
define('ERROR_REDEEMED_AMOUNT', 'Felicitaciones, you have redeemed ');
define('ERROR_NO_REDEEM_CODE', 'No ha ingresado a ' . TEXT_GV_REDEEM . '.');
define('ERROR_NO_INVALID_REDEEM_GV', 'Invalido ' . TEXT_GV_NAME . ' ' . TEXT_GV_REDEEM);
define('TABLE_HEADING_CREDIT', 'Créditos disponibles');
define('GV_HAS_VOUCHERA', 'No tiene fondos en su ' . TEXT_GV_NAME . ' cuenta. Si Ud. quiere <br />
                         Ud. puede enviar esos fonos por <a class="pageResults" href="');

define('GV_HAS_VOUCHERB', '"><strong>email</strong></a> a alguien');
define('ENTRY_AMOUNT_CHECK_ERROR', 'Usted no tiene suficiente fondos para enviarle está cantidad.');
define('BOX_SEND_TO_FRIEND', 'Enviar ' . TEXT_GV_NAME . ' ');

define('VOUCHER_REDEEMED',  TEXT_GV_NAME . ' Redimido');
define('CART_COUPON', 'Cupón :');
define('CART_COUPON_INFO', 'más info');

// payment method is GV/Discount
  define('PAYMENT_METHOD_GV', 'Vale de compra/Cupón');
  define('PAYMENT_MODULE_GV', 'GV/DC');

define('TABLE_HEADING_CREDIT_PAYMENT', 'Créditos disponibles');

define('TEXT_INVALID_REDEEM_COUPON', 'Código de cupón invaliddo');
define('TEXT_INVALID_STARTDATE_COUPON', 'Esta cupón no está disponible todavía');
define('TEXT_INVALID_FINISDATE_COUPON', 'Esta cupón está vencido');
define('TEXT_INVALID_USES_COUPON', 'Esta cupón podía ser una ves usado solamente');
define('TIMES', ' veces.');
define('TIME', ' ves.');
define('TEXT_INVALID_USES_USER_COUPON', 'Usted ha utilizado código de la cupón: %s . el número máximo de veces permitido por cliente');                                      
define('REDEEMED_COUPON', 'un valor del cupón ');
define('REDEEMED_MIN_ORDER', 'en pedidos por encima de ');
define('REDEEMED_RESTRICTIONS', ' [Producto-Categoría se aplican restricciones]');
define('TEXT_ERROR', 'Ha ocurrido un error');
//ke-added from forum
define('TEXT_INVALID_COUPON_PRODUCT', 'El código del cupón no es valido para ningún producto de los que están en su cesta`');

// more info in place of buy now
define('MORE_INFO_TEXT','... más info');

// IP Address
define('TEXT_YOUR_IP_ADDRESS','Su dirección IP es: ');

//Generic Address Heading
define('HEADING_ADDRESS_INFORMATION','Información de la dirección');

// cart contents
  define('PRODUCTS_ORDER_QTY_TEXT_IN_CART','Cantidad en la cesta: ');
  define('PRODUCTS_ORDER_QTY_TEXT','Añadir a la cesta: ');

  define('TEXT_PRODUCT_WEIGHT_UNIT','Kg.');
  
// Discount Savings
  define('PRODUCT_PRICE_DISCOUNT_PREFIX','Ahorre:&nbsp;');
  define('PRODUCT_PRICE_DISCOUNT_PERCENTAGE','% descuento');
  define('PRODUCT_PRICE_DISCOUNT_AMOUNT','&nbsp;descuento');
// Sale Maker Sale Price
  define('PRODUCT_PRICE_SALE','Venta:&nbsp;');

//universal symbols
  define('TEXT_NUMBER_SYMBOL', '# ');

// banner_box
  define('BOX_HEADING_BANNER_BOX','Patrocinador');
  define('TEXT_BANNER_BOX','Por favor viite a nuestros patrocinadore ...');

// banner box 2
  define('BOX_HEADING_BANNER_BOX2','Además puede ver...');
  define('TEXT_BANNER_BOX2','Vea hoy!');

// banner_box - all
  define('BOX_HEADING_BANNER_BOX_ALL','Patrocinador');
  define('TEXT_BANNER_BOX_ALL','Por favor viite a nuestros patrocinadores ...');

// boxes defines
  define('PULL_DOWN_ALL','Por favor selecciona');
  define('PULL_DOWN_MANUFACTURERS','- Reinicio -');
// shipping estimator
  define('PULL_DOWN_SHIPPING_ESTIMATOR_SELECT', 'Por favor seleccione');

// general Sort By
define('TEXT_INFO_SORT_BY','Elige por: ');

// close window image popups
  define('TEXT_CLOSE_WINDOW',' - Click en la imagen para cerrar');
// close popups
  define('TEXT_CURRENT_CLOSE_WINDOW','[ Cerrar ventana ]');

// iii 031104 added:  File upload error strings
define('ERROR_FILETYPE_NOT_ALLOWED', 'Error:  Tipo de fichero no permitido.');
define('WARNING_NO_FILE_UPLOADED', 'Advertencia:  no se cargo el fichero.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Éxito:  fichero guardado existosamente.');
define('ERROR_FILE_NOT_SAVED', 'Error:  fichero no guardado.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Error:  destino no rescribible.');
define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Error: el destino no existe.');
// End iii added

define('TEXT_BEFORE_DOWN_FOR_MAINTENANCE', 'AVISO: este sitio está actualmemte en mantenimiento: ');
define('TEXT_ADMIN_DOWN_FOR_MAINTENANCE', 'AVISO: este sitio está actualmente en mantenimiento para el público');

define('PRODUCTS_PRICE_IS_FREE_TEXT','Es gratis!');
define('PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT','Llame por su precio');
define('TEXT_CALL_FOR_PRICE','Llame por su precio');

define('TEXT_INVALID_SELECTION_LABELED',' Ud. marco una selección invalida: ');
define('TEXT_ERROR_OPTION_FOR','En la opción para: ');
define('TEXT_INVALID_USER_INPUT', 'Entrada del usuario requerida');

// product_listing
  define('PRODUCTS_QUANTITY_MIN_TEXT_LISTING','Min:');
  define('PRODUCTS_QUANTITY_UNIT_TEXT_LISTING','Unidades:');
  define('PRODUCTS_QUANTITY_IN_CART_LISTING','En la cesta:');
  define('PRODUCTS_QUANTITY_ADD_ADDITIONAL_LISTING','Añadir adicionalmente:');

  define('PRODUCTS_QUANTITY_MAX_TEXT_LISTING','Max:');

  define('TEXT_PRODUCTS_MIX_OFF','*Mixed ON');
  define('TEXT_PRODUCTS_MIX_ON','*Mixed OFF');

  define('TEXT_PRODUCTS_MIX_OFF_SHOPPING_CART','*Los Mixed de las opciones están en ON');
  define('TEXT_PRODUCTS_MIX_ON_SHOPPING_CART','*Los mixed de las opciones están OFF');

  define('ERROR_MAXIMUM_QTY','Ajustar la cantidad - Cantidad máxima para añadir a la cesta');
  define('ERROR_CORRECTIONS_HEADING','Por favor corrija lo siguiente: <br />');

// Downloads Controller
  define('DOWNLOADS_CONTROLLER_ON_HOLD_MSG','NOTA: Las descargas no están disponibles hasta que el pago haya sido comprobado');
  define('TEXT_FILESIZE_BYTES', ' bytes');
  define('TEXT_FILESIZE_MEGS', ' meg');

// shopping cart errors
  define('ERROR_PRODUCT','Product: ');
  define('ERROR_PRODUCT_QUANTITY_MIN',' ... Mínima cantidad de errores - ');
  define('ERROR_PRODUCT_QUANTITY_UNITS',' ... Errores de las unidades de la cantidad - ');
  define('ERROR_PRODUCT_OPTION_SELECTION',' ... Valores no válidos de la opción seleccionados ');
  define('ERROR_PRODUCT_QUANTITY_ORDERED','Usted pidió un total de: ');
  define('ERROR_PRODUCT_QUANTITY_MAX',' ... Maximum Quantity errors - ');
  define('ERROR_PRODUCT_QUANTITY_MIN_SHOPPING_CART',' ... Errores mínimos de la cantidad - ');
  define('ERROR_PRODUCT_QUANTITY_UNITS_SHOPPING_CART',' ... Errores de las unidades de la cantidad - ');
  define('ERROR_PRODUCT_QUANTITY_MAX_SHOPPING_CART',' ... Errores máximos de la cantidad - ');

  define('TEXT_SHIPPING_WEIGHT','Ks.');
  define('TEXT_SHIPPING_BOXES', 'Cajas');

define('TABLE_HEADING_FEATURED_PRODUCTS','Productos destacados  ');

define('TABLE_HEADING_NEW_PRODUCTS', 'Productos nuevos');
define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Prómimos productos');
define('TABLE_HEADING_DATE_EXPECTED', 'Fecha de espera');
define('TABLE_HEADING_SPECIALS_INDEX', 'Ofertas del mes en %s');

// meta tags special defines
define('META_TAG_PRODUCTS_PRICE_IS_FREE_TEXT','Es gratis!');

// customer login
define('TEXT_SHOWCASE_ONLY','Contáctenos');
// set for login for prices
define('TEXT_LOGIN_FOR_PRICE_PRICE','Precio no disponible');
define('TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE','Entrar para el precio');
// set for show room only
define('TEXT_LOGIN_FOR_PRICE_PRICE_SHOWROOM', ''); // blank for prices or enter your own text
define('TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE_SHOWROOM','Solo Show Room');

// authorization pending
define('TEXT_AUTHORIZATION_PENDING_PRICE', 'Precio no disponible');
define('TEXT_AUTHORIZATION_PENDING_BUTTON_REPLACE', 'PENDIENTE DE APROBACION');
define('TEXT_LOGIN_TO_SHOP_BUTTON_REPLACE','Entrar a la tienda');

// text pricing
define('TEXT_CHARGES_WORD','Calcular cargos:');
define('TEXT_PER_WORD','<br />Precio por palabra: ');
define('TEXT_WORDS_FREE',' Word(s) gratis ');
define('TEXT_CHARGES_LETTERS','Calcular cargos:');
define('TEXT_PER_LETTER','<br />Precio por letra: ');
define('TEXT_LETTERS_FREE',' Letra(s) gratis ');
define('TEXT_ONETIME_CHARGES','*solo una vez los cargos = ');
define('TEXT_ONETIME_CHARGES_EMAIL',"\t" . 'solo una vez los cargos = ');
define('TEXT_ATTRIBUTES_QTY_PRICES_HELP', 'Opción decuentos por cantidades');
define('TABLE_ATTRIBUTES_QTY_PRICE_QTY','CANTIDAD');
define('TABLE_ATTRIBUTES_QTY_PRICE_PRICE','PRECIO');
define('TEXT_ATTRIBUTES_QTY_PRICES_ONETIME_HELP', 'En la opción descuento por cantidades se aplica un solo cargo');


// Shipping Estimator
  define('CART_SHIPPING_OPTIONS', 'Estimación del envío:');
  define('CART_SHIPPING_OPTIONS_LOGIN', 'Por favor <a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '"><u>Entrar</u></a>, para mostrarle el costo de su envío.');
  define('CART_SHIPPING_METHOD_TEXT','Método de envío:');
  define('CART_SHIPPING_METHOD_RATES','Tasas:');
  define('CART_SHIPPING_METHOD_TO','Enviar a: ');
  define('CART_SHIPPING_METHOD_TO_NOLOGIN', 'Enviar a: <a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '"><u>Entrar/u></a>');
  define('CART_SHIPPING_METHOD_FREE_TEXT','Envío gratis');
  define('CART_SHIPPING_METHOD_ALL_DOWNLOADS','- Descargas');
  define('CART_SHIPPING_METHOD_RECALCULATE','Recalcular');
  define('CART_SHIPPING_METHOD_ZIP_REQUIRED','verdad');
  define('CART_SHIPPING_METHOD_ADDRESS','Drrección:');
  define('CART_OT','Total Cost Etimate:');
  define('CART_OT_SHOW','verdad'); // set to false if you don't want order totals
  define('CART_ITEMS','Artículos en la cesta: ');
  define('CART_SELECT','Seleccionar');
  define('ERROR_CART_UPDATE', 'Por favor actualice su pedido ...<br />');
  define('IMAGE_BUTTON_UPDATE_CART', 'Actualizar');

// multiple product add to cart
  define('TEXT_PRODUCT_LISTING_MULTIPLE_ADD_TO_CART', 'Añadir: ');
  define('TEXT_PRODUCT_ALL_LISTING_MULTIPLE_ADD_TO_CART', 'Añadir: ');
  define('TEXT_PRODUCT_FEATURED_LISTING_MULTIPLE_ADD_TO_CART', 'Añadir: ');
  define('TEXT_PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART', 'Añadir: ');
  define('SUBMIT_BUTTON_ADD_PRODUCTS_TO_CART','Añadir los productos seleccionados a la cesta');

// discount qty table
define('TEXT_HEADER_DISCOUNT_PRICES_PERCENTAGE', 'Qty Discounts off Price');
define('TEXT_HEADER_DISCOUNT_PRICES_ACTUAL_PRICE', 'Qty Discounts New Price');
define('TEXT_HEADER_DISCOUNT_PRICES_AMOUNT_OFF', 'Qty Discounts off Price');
define('TEXT_FOOTER_DISCOUNT_QUANTITIES', '* Discounts may vary based on Options above');
define('TEXT_HEADER_DISCOUNTS_OFF', 'Qty Discounts Unavailable ...');

// sort order titles for dropdowns
define('PULL_DOWN_ALL_RESET','- RESET - ');
define('TEXT_INFO_SORT_BY_PRODUCTS_NAME', 'Nombre del producto');
define('TEXT_INFO_SORT_BY_PRODUCTS_NAME_DESC', 'Productos en descuento');
define('TEXT_INFO_SORT_BY_PRODUCTS_PRICE', 'Precio - barato a caro');
define('TEXT_INFO_SORT_BY_PRODUCTS_PRICE_DESC', 'Precio - caro a barato');
define('TEXT_INFO_SORT_BY_PRODUCTS_MODEL', 'Modelo');
define('TEXT_INFO_SORT_BY_PRODUCTS_DATE_DESC', 'Fecha - Nuevo a viejo');
define('TEXT_INFO_SORT_BY_PRODUCTS_DATE', 'Date Added - Viejo a nuevo');
define('TEXT_INFO_SORT_BY_PRODUCTS_SORT_ORDER', 'Mostrar la predeterminada');

//added for Rich Text / Email Mod
 define('ENTRY_EMAIL_PREFERENCE','Formato de Email preferido:');
 define('ENTRY_EMAIL_HTML_DISPLAY','HTML');
 define('ENTRY_EMAIL_TEXT_DISPLAY','Texto');
 define('EMAIL_SEND_FAILED','ERROR: Fallo el envío del email a: "%s" <%s> con el asunto: "%s"');

  define('EDITOR_NONE', 'Editor de texto plano');
  define('TEXT_EDITOR_INFO', 'Editor de texto');
  define('ERROR_EDITORS_FOLDER_NOT_FOUND', 'You have an HTML editor selected in \'My Store\' but the \'/editors/\' folder cannot be located. Please disable your selection or move your editor files into the \''.DIR_WS_CATALOG.'editors/\' folder');
  define('TEXT_CATEGORIES_PRODUCTS_SORT_ORDER_INFO', 'Categories/Product Display Order: ');
  define('TEXT_SORT_PRODUCTS_SORT_ORDER_PRODUCTS_NAME', 'Products Sort Order, Products Name');
  define('TEXT_SORT_PRODUCTS_NAME', 'Nombre del producto');
  define('TEXT_SORT_PRODUCTS_MODEL', 'Modelo');
  define('TEXT_SORT_PRODUCTS_QUANTITY', 'Products Qty+, Products Name');
  define('TEXT_SORT_PRODUCTS_QUANTITY_DESC', 'Products Qty-, Products Name');
  define('TEXT_SORT_PRODUCTS_PRICE', 'Products Price+, Products Name');
  define('TEXT_SORT_PRODUCTS_PRICE_DESC', 'Products Price-, Products Name');
  define('TEXT_SORT_CATEGORIES_SORT_ORDER_PRODUCTS_NAME', 'Categories Sort Order, Categories Name');
  define('TEXT_SORT_CATEGORIES_NAME', 'Nombre de la categoría');
  
  
 define('DB_ERROR_NOT_CONNECTED', 'Error - No se pudo conectar a la base de datos');

// EZ-PAGES Alerts
define('TEXT_EZPAGES_STATUS_HEADER_ADMIN', 'AVISO: EZ-PAGES ENCABEZADO - Activado sólo para la IP del Administrador.');
define('TEXT_EZPAGES_STATUS_FOOTER_ADMIN', 'AVISO: EZ-PAGES PIE - Activado sólo para la IP del Administrador.');
define('TEXT_EZPAGES_STATUS_SIDEBOX_ADMIN', 'AVISO: EZ-PAGES CAJA LATERAL - Activado sólo para la IP del Administrador.');

// extra product listing sorter
define('TEXT_PRODUCTS_LISTING_ALPHA_SORTER', '');
define('TEXT_PRODUCTS_LISTING_ALPHA_SORTER_NAMES', 'Artículos que empiezan por ...');
define('TEXT_PRODUCTS_LISTING_ALPHA_SORTER_NAMES_RESET', '-- Quitar --');
  
define('ENTRY_TAXID','CIF/NIF');
define('ENTRY_TAXID_TEXT','*');


// misc
  define('COLON_SPACER', ':&nbsp;&nbsp;');

// table headings for cart display and upcoming products
  define('TABLE_HEADING_QUANTITY', 'Cantidad');
  define('TABLE_HEADING_PRODUCTS', 'Producto');
  define('TABLE_HEADING_TOTAL', 'Total');

// create account - login shared
  define('TABLE_HEADING_PRIVACY_CONDITIONS', 'Privacidad');
  define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION', 'Por favor, acepte nuestra declaración de privacidad marcando el siguiente casillero. Puede leer la declaración de privacidad <a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><u>aquí</u></a>.');
  define('TEXT_PRIVACY_CONDITIONS_CONFIRM', '<span class="privacyagree">He leído y acepto la declaración de privacidad.</span>');
  define('TABLE_HEADING_ADDRESS_DETAILS', 'Dirección');
  define('TABLE_HEADING_PHONE_FAX_DETAILS', 'Datos telefónicos');
  define('TABLE_HEADING_DATE_OF_BIRTH', 'Confirma tu edad');
  define('TABLE_HEADING_LOGIN_DETAILS', 'Información de conexión');
  define('TABLE_HEADING_REFERRAL_DETAILS', '¿Cómo nos conoció?');


// Nuevas claves

define('BOX_GV_REDEEM_INFO', 'Redemption code: ');
define('PLEASE_SELECT', 'Por favor, seleccione ...');
define('TYPE_BELOW', 'Type a choice below ...');
define('JS_STATE_SELECT', '-- Por favor, seleccione --');
define('TEXT_SEND_OR_SPEND', 'Tiene saldo disponible ' . TEXT_GV_NAME . '. Puede gastarlo o enviarlo a otra persona. Para enviarlo haga click es el botón de abajo.');
define('TEXT_BALANCE_IS', 'El saldo de su ' . TEXT_GV_NAME . ': ');
define('TEXT_AVAILABLE_BALANCE', 'Su ' . TEXT_GV_NAME . '');
define('TEXT_INVALID_REDEEM_COUPON_MINIMUM', 'Debe comprar al menos %s para usar este cupón.');
define('TEXT_VALID_COUPON', 'Congratulations you have redeemed the Discount Coupon');
define('TEXT_REMOVE_REDEEM_COUPON_ZONE', 'The coupon code you entered is not valid for the address you have selected.');
define('SUCCESS_ADDED_TO_CART_PRODUCT', 'Successfully added Product to the cart ...');
define('SUCCESS_ADDED_TO_CART_PRODUCTS', 'Successfully added selected Product(s) to the cart ...');
define('ERROR_FILE_TOO_BIG', 'Warning: File was too large to upload!<br />Order can be placed but please contact the site for help with upload');
define('TEXT_INVALID_SELECTION', ' You picked an Invalid Selection: ');
define('ERROR_QUANTITY_ADJUSTED', 'Quantity Error Adjustment<br />');
define('ERROR_PRODUCT_STATUS_SHOPPING_CART', '<br />We are sorry but this product has been removed from our inventory at this time.<br />This item has been removed from your shopping cart.');
define('ERROR_CUSTOMERS_ID_INVALID', 'Customer information cannot be validated!<br />Please login or recreate your account ...');
define('TEXT_MAXIMUM_CHARACTERS_ALLOWED', ' maximum characters allowed');
define('TEXT_REMAINING', 'remaining');
define('CART_SHIPPING_OPTIONS_LOGIN', 'Please <a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '"><span class="pseudolink">Log In</span></a>, to display your personal shipping costs.');
define('CART_SHIPPING_METHOD_TO_NOLOGIN', 'Ship to: <a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '"><span class="pseudolink">Log In</span></a>');
define('EMPTY_CART_TEXT_NO_QUOTE', 'Whoops! Your session has expired ... Please update your shopping cart for Shipping Quote ...');
define('TABLE_HEADING_DOWNLOAD_DATE', 'Link Expires');
define('TABLE_HEADING_DOWNLOAD_COUNT', 'Remaining');
define('HEADING_DOWNLOAD', 'To download your files click the download button and choose "Save to Disk" from the popup menu.');
define('TABLE_HEADING_DOWNLOAD_FILENAME', 'Filename');
define('TABLE_HEADING_PRODUCT_NAME', 'Item Name');
define('TABLE_HEADING_BYTE_SIZE', 'File Size');
define('TEXT_DOWNLOADS_UNLIMITED', 'Unlimited');
define('TEXT_DOWNLOADS_UNLIMITED_COUNT', '--- *** ---');
define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION', 'Please acknowledge you agree with our privacy statement by ticking the following box. The privacy statement can be read <a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><span class="pseudolink">here</span></a>.');



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