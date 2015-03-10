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