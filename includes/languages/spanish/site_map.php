<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: site_map.php 3159 2006-03-11 01:35:04Z drbyte $
 */

define('NAVBAR_TITLE', 'Mapa de la web');
define('HEADING_TITLE', 'Mapa de la web');
define('TEXT_INFORMATION','');

define('PAGE_ACCOUNT', 'Mi cuenta');
if ($zurlan)
{
	define('PAGE_ACCOUNT_EDIT', 'Dirección de facturación');
	define('PAGE_ADDRESS_BOOK', 'Direcciones de envío');
}
else
{
	define('PAGE_ACCOUNT_EDIT', 'Información de la cuenta');
	define('PAGE_ADDRESS_BOOK', 'Agenda');
}

define('PAGE_ACCOUNT_HISTORY', 'Historial de pedidos');
define('PAGE_ACCOUNT_NOTIFICATIONS', 'Suscripción al boletín');
define('PAGE_SHOPPING_CART', 'Carro de la compra');
define('PAGE_CHECKOUT_SHIPPING', 'Comprar');
define('PAGE_ADVANCED_SEARCH', 'Buscar');
define('PAGE_PRODUCTS_NEW', 'Novevades');
define('PAGE_SPECIALS', 'Ofertas');
define('PAGE_REVIEWS', 'Comentarios');
?>