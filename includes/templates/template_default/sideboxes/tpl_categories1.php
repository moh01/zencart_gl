<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_categories.php 4162 2006-08-17 03:55:02Z ajeh $
 */
  $content = "";

  // --- variables ajoutées pour gérer le double affichage de pop-list --- //
  $firstCateg = 1;
  $firstSubCateg = 1;


  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent">' . "\n";
  for ($i=0;$i<sizeof($box_categories_array);$i++) {
    switch(true) {
      case ($box_categories_array[$i]['top'] == 'true'):
        $new_style = 'category-top';
        break;
      case ($box_categories_array[$i]['has_sub_cat']):
        $new_style = 'category-subs';
        break;
      default:
        $new_style = 'category-products';
      }
     if (zen_get_product_types_to_category($box_categories_array[$i]['path']) == 3 or ($box_categories_array[$i]['top'] != 'true' and SHOW_CATEGORIES_SUBCATEGORIES_ALWAYS != 1)) {
        // skip if this is for the document box (==3)
      } else {
           // $content .= '<a class="' . $new_style . '" href="' . zen_href_link(FILENAME_DEFAULT, $box_categories_array[$i]['path']) . '">';

    switch(true) {
      case ($box_categories_array[$i]['top'] == 'true'):
        if ( $firstCateg )
        {
           $content .= '<select name="categ" onchange="msgbox(1);">';   
           $firstCateg = 0;        
        }
        $content .= '<option value="">' .$box_categories_array[$i]['name'];
        break;
      case ($box_categories_array[$i]['has_sub_cat']):
        $new_style = 'category-subs';
        break;
      default:
      }

/* 
     if ($box_categories_array[$i]['current']) {
          $content .= '<span class="category-subs-parent">' . $box_categories_array[$i]['name'] . '</span>';
      } else {
        $content .= $box_categories_array[$i]['name'];
      }

      if ($box_categories_array[$i]['has_sub_cat']) {
        $content .= CATEGORIES_SEPARATOR;
      }

            $content .= '</a>';
*/

      if (SHOW_COUNTS == 'true') {
        if ((CATEGORIES_COUNT_ZERO == '1' and $box_categories_array[$i]['count'] == 0) or $box_categories_array[$i]['count'] >= 1) {
          $content .= CATEGORIES_COUNT_PREFIX . $box_categories_array[$i]['count'] . CATEGORIES_COUNT_SUFFIX;
        }
      }

      $content .= '<br />' . "\n";
    }
  }
  if ( ! $firstCateg )
  {
      $content .= '</select>';
  }
  $content .= '</div>';
?>