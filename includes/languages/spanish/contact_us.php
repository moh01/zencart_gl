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
// $Id: contact_us.php,v 1.2 2006/01/09 23:50:03 gorkau Exp $
//

define('HEADING_TITLE', 'Contáctenos');
define('NAVBAR_TITLE', 'Contáctenos');
define('TEXT_SUCCESS', 'Su mensaje se ha enviado correctamente.');
define('EMAIL_SUBJECT', 'Mensaje de ' . STORE_NAME);

define('ENTRY_NAME', 'Nombre / Apellido:');
define('ENTRY_EMAIL', 'Correo electrónico:');
define('ENTRY_ENQUIRY', 'Mensaje:');


  define('CMM_TITRE_FORMULAIRE', 'Comentarios y sugerencias');
  define('LNF_TITRE_FORMULAIRE', 'Sírvase enviarnos los detalles.');
  define('NC_TITRE_FORMULAIRE', 'Sírvase enviarnos los detalles.');

  define('RMA_TITRE_FORMULAIRE', 'Formulario de solicitud de número de devolución R.M.A.');
  define('RMA_SERIAL_NUMBER', 'Número de serie');
  define('RMA_CONSTRUCTEUR', 'Fabricante');
  define('RMA_MODELE', 'Modelo');

  define('NC_PRIX', 'Precio');
  define('NC_TELEPHONE', 'Su número de teléfono');
  
  define('RMA_RAISON_RETOUR', 'Motivo de la devolución.');
  define('DESCRIPTION', 'Description');
  
  
  define('RMA_OPTION1','Rota durante el tránsito');
  define('RMA_OPTION2','Defectuosa y bajo garantía');
  define('RMA_OPTION3','La lámpara ya no es requerida');
  define('RMA_OPTION4','La lámpara incorrecta fue enviada');
  
  define('RMA_ACCEPT','Términos y condiciones');
  define('RMA_ACCEPT_TEXT','Acepto los términos y condiciones de devolución');
  define('RMA_INCOMPLETE_INPUT','Informacion incompleta');
 
  

define('SEND_TO_TEXT', 'Enviar email a:');
define('ENTRY_EMAIL_NAME_CHECK_ERROR', 'Por favor, no olvides escribir bien tu nombre. El sistema requiere un mínimo de ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caracteres para el nombre.');
define('ENTRY_EMAIL_CONTENT_CHECK_ERROR', 'Por favor, rellena el campo mensaje.');


?>
