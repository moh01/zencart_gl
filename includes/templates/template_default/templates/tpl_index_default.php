<?php
/**
 * Page Template
 *
 * Main index page<br />
 * Displays greetings, welcome text (define-page content), and various centerboxes depending on switch settings in Admin<br />
 * Centerboxes are called as necessary
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_index_default.php 3464 2006-04-19 00:07:26Z ajeh $
 */

    require($template->get_template_dir('tpl_categories.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_categories.php');

    $main_category_tree = new category_tree;
    $row = 0;
    $box_categories_array = array();

    // don't build a tree when no categories
    $check_categories = $db->Execute("select categories_id from " . TABLE_CATEGORIES . " where categories_status=1 limit 1");
    if ($check_categories->RecordCount() > 0) {
       $box_categories_array = $main_category_tree->zen_category_tree();
    }

    require($template->get_template_dir('el_tpl_categories.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_categories.php');

    //$title = BOX_HEADING_CATEGORIES;
    $title = "Mouche";

    $title_link = false;

    require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);


?>

