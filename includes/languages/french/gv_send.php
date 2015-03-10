<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: gv_send.php 3421 2006-04-12 04:16:14Z drbyte $
 */

define('HEADING_TITLE', 'Envoyer un ' . TEXT_GV_NAME);
define('HEADING_TITLE_CONFIRM_SEND', 'Envoyer ' . TEXT_GV_NAME . ' Confirmation');
define('HEADING_TITLE_COMPLETED', TEXT_GV_NAME . ' Confirmation re&ccedil;ue');
define('NAVBAR_TITLE', 'Envoyer un ' . TEXT_GV_NAME);
define('EMAIL_SUBJECT', 'Message de ' . STORE_NAME);
define('HEADING_TEXT','<br />Veuillez indiquer ci-dessous les d&eacute;tails concernant le ' . TEXT_GV_NAME . ' que vous souhaitez envoyer. Pour en savoir plus, veuillez consulter notre <a href="' . zen_href_link(FILENAME_GV_FAQ, '', 'NONSSL').'">' . GV_FAQ . '.</a><br />');
define('ENTRY_NAME', 'Nom du Destinataire:');
define('ENTRY_EMAIL', 'Adresse E-mail du Destinataire:');
define('ENTRY_MESSAGE', 'Message:');
define('ENTRY_AMOUNT', 'Montant en ' . TEXT_GV_NAME . ':');
define('ERROR_ENTRY_TO_NAME_CHECK', 'Nous n\'avons pas re&ccedil;ue le nom du destinataire. Remplissez le formulaire suivant. ');
define('ERROR_ENTRY_AMOUNT_CHECK', '&nbsp;&nbsp;<span class="errorText">Montant Invalide</span>');
define('ERROR_ENTRY_EMAIL_ADDRESS_CHECK', '&nbsp;&nbsp;<span class="errorText">Adresse E-mail Invalide</span>');
define('MAIN_MESSAGE', 'Vous avez choisi d\'envoyer un ' . TEXT_GV_NAME . ' d\'une valeur de %s &agrave; %s dont l\'adresse Email est %s<br /><br />Voici le texte qui figurera dans le corps du message<br /><br />Bonjour %s<br /><br />' .
                        'Vous venez de recevoir un ' . TEXT_GV_NAME . ' d\'une valeur de %s de la part de %s');
define('SECONDARY_MESSAGE', 'Bonjour %s,<br /><br />' . 'Vous avez envoy&eacute; un ' . TEXT_GV_NAME . ' worth %s by %s');
define('PERSONAL_MESSAGE', '%s &eacute;crit');
define('TEXT_SUCCESS', 'F&eacute;licitations, votre ' . TEXT_GV_NAME . ' a &eacute;t&eacute; adress&eacute; avec succ&egrave;s');
define('TEXT_SEND_ANOTHER', 'Voulez-vous envoyer un nouveau ' . TEXT_GV_NAME . '?');
define('TEXT_AVAILABLE_BALANCE','Balance disponible actuellement: ');

define('EMAIL_GV_TEXT_SUBJECT', 'un Cadeau de la part de %s');
define('EMAIL_SEPARATOR', '----------------------------------------------------------------------------------------');
define('EMAIL_GV_TEXT_HEADER', 'F&eacute;licitations, Vous venez de recevoir un ' . TEXT_GV_NAME . ' d\'une valeur de %s');
define('EMAIL_GV_FROM', 'Ce ' . TEXT_GV_NAME . ' vous est adress&eacute; par %s');
define('EMAIL_GV_MESSAGE', 'avec le message suivant: ');
define('EMAIL_GV_SEND_TO', 'Bonjour, %s');
define('EMAIL_GV_REDEEM', 'Pour encaisser ce ' . TEXT_GV_NAME . ', il vous suffit de suivre le lien qui figure ci-dessous. N\'oubliez-pas de conserver votre ' . TEXT_GV_REDEEM . ': %s  sur papier libre, afin de pr&eacute;venir toute erreur.');
define('EMAIL_GV_LINK', 'Cliquez ici pour l\'encaissement');
define('EMAIL_GV_VISIT', ' ou rendez-vous sur ');
define('EMAIL_GV_ENTER', ' afin d\'encaisser votre ' . TEXT_GV_REDEEM . ' ');
define('EMAIL_GV_FIXED_FOOTER', 'Si vous rencontrez un problème concernant ce ' . TEXT_GV_NAME . ' en utilisant le lien, ' . "\n" .
                                'nous vous informons que vous pourrez saisir le ' . TEXT_GV_REDEEM . ' de votre ' . TEXT_GV_NAME . ' en ligne.');
define('EMAIL_GV_SHOP_FOOTER', '');
?>