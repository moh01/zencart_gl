<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_category_icon_display.php 4348 2006-09-02 20:50:32Z ajeh $
 */
  require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_CATEGORY_ICON_DISPLAY));

?>

<div align="<?php echo $align; ?>" id="categoryIcon" class="categoryIcon"><?php echo '<a href="' . zen_href_link(FILENAME_DEFAULT, $cPath_new, 'NONSSL') . '">' . $category_icon_display_image . $category_icon_display_name .  '</a>'; ?></div>