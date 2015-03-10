<?php
////////////////////////////////////////////////////////////////////////////
// $Id: Newsletter Unsubscribe, (/catalog/includes/languages/english/unsubscribe.php)v 1.2 2004/04/29
// Programed By: Christopher Bradley (www.wizardsandwars.com)
//  Modified by Jim Keebaugh
//  Modified for Zen-Cart by Chris Brown
//
// Developed for osCommerce, Open Source E-Commerce Solutions
// http://www.oscommerce.com
// Copyright (c) 2003 osCommerce
//
// Released under the GNU General Public License
//
///////////////////////////////////////////////////////////////////////////

define('NAVBAR_TITLE', 'Dar de baja suscripción');
define('HEADING_TITLE', 'Cancelar suscripción a nuestro boletín de noticias');

define('UNSUBSCRIBE_TEXT_INFORMATION', '<br />Nos apena saber que desea cancelar su suscripción a nuestro boletín de noticias. Si está preocupado por su privacidad, por favor, lea nuestra <a href="' . zen_href_link(FILENAME_PRIVACY,'','NONSSL') . '"><u>política de privacidad</u></a>.<br /><br />Los suscriptpres de nuestro boletín de noticias son avisados de nuestras novedades, ofertas especiales, y noticias de la página.<br /><br />Si pese a todo, no desea seguir recibiendo nuestro boletín de noticias, por favor, haga clic en el botón de la parte inferior');
define('UNSUBSCRIBE_TEXT_NO_ADDRESS_GIVEN', '<br />Nos apena saber que desea cancelar su suscripción a nuestro boletín de noticias. Si está preocupado por su privacidad, por favor, lea nuestra <a href="' . zen_href_link(FILENAME_PRIVACY,'','NONSSL') . '"><u>política de privacidad</u></a>.<br /><br />Los suscriptpres de nuestro boletín de noticias son avisados de nuestras novedades, ofertas especiales, y noticias de la página.<br /><br />Si pese a todo, no desea seguir recibiendo nuestro boletín de noticias, por favor, haga clic en el botón de la parte inferior. Se le dirigirá a la zona de preferencias de su cuenta, donde podrá editar sus suscripciones. Puede que necesite identificarse previamente.');
define('UNSUBSCRIBE_DONE_TEXT_INFORMATION', '<br />Su dirección de correo, mostrada más abajo, ha sido eliminada de nuestra base de datos del boletín de noticias, bajo su petición expresa de ello. <br /><br />');
define('UNSUBSCRIBE_ERROR_INFORMATION', '<br />No se encontró dicha dirección de correo en nuestra base de datos del boletín de noticias, o ya ha sido eliminada de la lista de distribución con anterioridad. <br /><br />');
?>