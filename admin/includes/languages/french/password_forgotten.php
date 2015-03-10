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
// $Id: password_forgotten.php 1105 2005-04-04 22:05:35Z birdbrain $
//

  define('HEADING_TITLE', 'Envoi de mot de passe');

  define('TEXT_ADMIN_EMAIL', 'Adresse E-mail: ');

  define('ERROR_WRONG_EMAIL', '<p>Adresse E-mail invalide.</p>');
  define('ERROR_WRONG_EMAIL_NULL', '<p>Bien vu...:-P</p>');
  define('SUCCESS_PASSWORD_SENT', '<p>Succès: un nouveau mot de passe a été adressé;.</p>');

  define('TEXT_EMAIL_SUBJECT', 'Votre demande de modification');
  define('TEXT_EMAIL_FROM', EMAIL_FROM);
  define('TEXT_EMAIL_MESSAGE', 'Un Nouveau mot de passe est requis par ' . $_SESSION['REMOTE_ADDR'] . '.' . "\n\n" . 'Votre nouveau mot de passe pour \'' . STORE_NAME . '\' est:' . "\n\n" . '   %s' . "\n\n");

?>