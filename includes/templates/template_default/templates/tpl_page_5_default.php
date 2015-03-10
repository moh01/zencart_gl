<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_page_5_default.php 3464 2006-04-19 00:07:26Z ajeh $
 */
?>
<div class="centerColumn" id="pageThree">
<h1 id="pageFiveHeading"><?php echo HEADING_TITLE; ?></h1>

<div id="pageFiveMainContent" class="content">
<?php
/**
 * require the html_define for the page_3 page
 */
  require($define_page);
?>
</div>
<div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
</div>
