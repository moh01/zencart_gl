<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: freeoptions.php 3830 2006-06-04 17:15:51Z Deepmax $
 */

define('MODULE_SHIPPING_FREEOPTIONS_TEXT_TITLE', 'Opzioni per la SPEDIZIONE GRATUITA');
define('MODULE_SHIPPING_FREEOPTIONS_TEXT_DESCRIPTION', '
L\'opzione Free &egrave; utilizzata per mostrare l\'opzione di Spedizione Gratuita quando altri Moduli di Spedizione sono visualizzati.
Pu&ograve; essere basata su: Mostra sempre, Totale Ordine, Peso Ordine o Conteggio Voci Ordine.
Il modulo Opzione Free non viene visualizzato quando Free Shipper &egrave; visualizzato.<br /><br />
Impostando Totale a >= 0.00 e <= nothing (lasciato vuoto) attiver&agrave; questo modulo per essere visualizzato con tutti gli altri moduli di spedizione, eccetto che per Spedizione Gratuita - freeshipper.<br /><br />
NOTA: Lasciando tutti i settaggi per Totale, Peso e conteggio Voci vuoti questo modulo sar&agrave; disattivato.<br /><br />
NOTA: L\'opzione Spedizione Gratuita non viene visualizzata se Spedizione Gratuita &egrave; utilizzata basandosi sul fatto che Peso = 0 &egrave; Spedizione Gratuita.
Vedi: freeshipper
');
define('MODULE_SHIPPING_FREEOPTIONS_TEXT_WAY', 'SPEDIZIONE GRATUITA');

?>