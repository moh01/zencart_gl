<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=advanced_search.<br />
 * Displays options fields upon which a product search will be run
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_advanced_search_default.php 2982 2006-02-07 07:56:41Z birdbrain $
 */
?>
<div class="centerColumn" id="advSearchDefault">

<?php echo zen_draw_form('advanced_search', zen_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get', 'onsubmit="return check_form(this);"') . zen_hide_session_id(); ?>
<?php echo zen_draw_hidden_field('main_page', FILENAME_ADVANCED_SEARCH_RESULT); ?>

<h1 id="advSearchDefaultHeading">Recherche par videoprojecteur</h1>
  
<fieldset>
<legend>&nbsp;&nbsp;&nbsp;Sélectionner &nbsp;&nbsp;&nbsp; 1- le constructeur &nbsp;&nbsp;&nbsp;&nbsp;  2 - le videoprojecteur.&nbsp;&nbsp;&nbsp;</legend>
<br class="clearBoth" />
    <div class="centeredContent">
    <?php

    $main_category_tree = new category_tree;
    $row = 0;
    $box_categories_array = array();

// don't build a tree when no categories
    $check_categories = $db->Execute("select categories_id from " . TABLE_CATEGORIES . " where categories_status=1 limit 1");
    if ($check_categories->RecordCount() > 0) {
       $box_categories_array = $main_category_tree->zen_category_tree();
    }

    require($template->get_template_dir('el_tpl_categories.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/el_tpl_categories.php');

    $title = "Mouche";

    $title_link = false;

  //  require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);

    ?>
<br class="clearBoth" />
</fieldset>

<br class="clearBoth" />

    
<h1 id="advSearchDefaultHeading">Recherche par référence de lampe</h1>
<?php if ($messageStack->size('search') > 0) echo $messageStack->output('search'); ?>  

<fieldset>
<legend>Rentrer la référence de la lampe</legend>
<br class="clearBoth" />
    <div class="centeredContent"><?php echo zen_draw_input_field('keyword', '', ''); ?>
<br class="clearBoth" />
</fieldset>

<br class="clearBoth" />


<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_SEARCH, BUTTON_SEARCH_ALT); ?></div>
<div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>

</form>
</div>