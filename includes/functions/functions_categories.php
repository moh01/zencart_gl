<?php
/**
 * functions_categories.php
 *
 * @package functions
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: functions_categories.php 4135 2006-08-14 04:25:02Z drbyte $
 */

////
// Generate a path to categories
  function zen_get_path($current_category_id = '') {
    global $cPath_array, $db;

    if (zen_not_null($current_category_id)) {
      $cp_size = sizeof($cPath_array);
      if ($cp_size == 0) {
        $cPath_new = $current_category_id;
      } else {
        $cPath_new = '';
        $last_category_query = "select parent_id
                                from " . TABLE_CATEGORIES . "
                                where categories_id = '" . (int)$cPath_array[($cp_size-1)] . "'";

        $last_category = $db->Execute($last_category_query);

        $current_category_query = "select parent_id
                                   from " . TABLE_CATEGORIES . "
                                   where categories_id = '" . (int)$current_category_id . "'";

        $current_category = $db->Execute($current_category_query);

        if ($last_category->fields['parent_id'] == $current_category->fields['parent_id']) {
          for ($i=0; $i<($cp_size-1); $i++) {
            $cPath_new .= '_' . $cPath_array[$i];
          }
        } else {
          for ($i=0; $i<$cp_size; $i++) {
            $cPath_new .= '_' . $cPath_array[$i];
          }
        }
        $cPath_new .= '_' . $current_category_id;

        if (substr($cPath_new, 0, 1) == '_') {
          $cPath_new = substr($cPath_new, 1);
        }
      }
    } else {
      $cPath_new = implode('_', $cPath_array);
    }

    return 'cPath=' . $cPath_new;
  }

////
// Return the number of products in a category
// TABLES: products, products_to_categories, categories
  function zen_count_products_in_category($category_id, $include_inactive = false) {
    global $db;
    $products_count = 0;
    if ($include_inactive == true) {
      $products_query = "select count(*) as total
                         from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                         where p.products_id = p2c.products_id
                         and p2c.categories_id = '" . (int)$category_id . "'";

    } else {
      $products_query = "select count(*) as total
                         from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                         where p.products_id = p2c.products_id
                         and p.products_status = '1'
                         and p2c.categories_id = '" . (int)$category_id . "'";

    }
    $products = $db->Execute($products_query);
    $products_count += $products->fields['total'];

    $child_categories_query = "select categories_id
                               from " . TABLE_CATEGORIES . "
                               where parent_id = '" . (int)$category_id . "'";

    $child_categories = $db->Execute($child_categories_query);

    if ($child_categories->RecordCount() > 0) {
      while (!$child_categories->EOF) {
        $products_count += zen_count_products_in_category($child_categories->fields['categories_id'], $include_inactive);
        $child_categories->MoveNext();
      }
    }

    return $products_count;
  }

////
// Return true if the category has subcategories
// TABLES: categories
  function zen_has_category_subcategories($category_id) {
    global $db;
    $child_category_query = "select count(*) as count
                             from " . TABLE_CATEGORIES . "
                             where parent_id = '" . (int)$category_id . "'";

    $child_category = $db->Execute($child_category_query);

    if ($child_category->fields['count'] > 0) {
      return true;
    } else {
      return false;
    }
  }

////
  function zen_get_categories($categories_array = '', $parent_id = '0', $indent = '', $status_setting = '') {
    global $db;

    if (!is_array($categories_array)) $categories_array = array();

    // show based on status
    if ($status_setting != '') {
      $zc_status = " c.categories_status='" . (int)$status_setting . "' and ";
    } else {
      $zc_status = '';
    }

	              //                        and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'

				  
    $categories_query = "select c.categories_id, cd.categories_name, c.categories_status
                         from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
                         where " . $zc_status . "
                         parent_id = '" . (int)$parent_id . "'
                         and c.categories_id = cd.categories_id 
                         order by sort_order, cd.categories_name";

    $categories = $db->Execute($categories_query);

    while (!$categories->EOF) {
      $categories_array[] = array('id' => $categories->fields['categories_id'],
                                  'text' => $indent . $categories->fields['categories_name']);

      if ($categories->fields['categories_id'] != $parent_id) {
        $categories_array = zen_get_categories($categories_array, $categories->fields['categories_id'], $indent . '&nbsp;&nbsp;', '1');
      }
      $categories->MoveNext();
    }

    return $categories_array;
  }

////
// Return all subcategory IDs
// TABLES: categories
  function zen_get_subcategories(&$subcategories_array, $parent_id = 0) {
    global $db;
    $subcategories_query = "select categories_id
                            from " . TABLE_CATEGORIES . "
                            where parent_id = '" . (int)$parent_id . "'";

    $subcategories = $db->Execute($subcategories_query);

    while (!$subcategories->EOF) {
      $subcategories_array[sizeof($subcategories_array)] = $subcategories->fields['categories_id'];
      if ($subcategories->fields['categories_id'] != $parent_id) {
        zen_get_subcategories($subcategories_array, $subcategories->fields['categories_id']);
      }
      $subcategories->MoveNext();
    }
  }


////
// Recursively go through the categories and retreive all parent categories IDs
// TABLES: categories
  function zen_get_parent_categories(&$categories, $categories_id) {
    global $db;
    $parent_categories_query = "select parent_id
                                from " . TABLE_CATEGORIES . "
                                where categories_id = '" . (int)$categories_id . "'";

    $parent_categories = $db->Execute($parent_categories_query);

    while (!$parent_categories->EOF) {
      if ($parent_categories->fields['parent_id'] == 0) return true;
      $categories[sizeof($categories)] = $parent_categories->fields['parent_id'];
      if ($parent_categories->fields['parent_id'] != $categories_id) {
        zen_get_parent_categories($categories, $parent_categories->fields['parent_id']);
      }
      $parent_categories->MoveNext();
    }
  }

////
// Construct a category path to the product
// TABLES: products_to_categories
  function zen_get_product_path($products_id) {
    global $db;
    $cPath = '';

    $category_query = "select p2c.categories_id
                       from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                       where p.products_id = '" . (int)$products_id . "'
                       and p.products_status = '1'
                       and p.products_id = p2c.products_id limit 1";

    $category = $db->Execute($category_query);

    if ($category->RecordCount() > 0) {

      $categories = array();
      zen_get_parent_categories($categories, $category->fields['categories_id']);

      $categories = array_reverse($categories);

      $cPath = implode('_', $categories);

      if (zen_not_null($cPath)) $cPath .= '_';
      $cPath .= $category->fields['categories_id'];
    }

    return $cPath;
  }

////
// Parse and secure the cPath parameter values
  function zen_parse_category_path($cPath) {
// make sure the category IDs are integers
    $cPath_array = array_map('zen_string_to_int', explode('_', $cPath));

// make sure no duplicate category IDs exist which could lock the server in a loop
    $tmp_array = array();
    $n = sizeof($cPath_array);
    for ($i=0; $i<$n; $i++) {
      if (!in_array($cPath_array[$i], $tmp_array)) {
        $tmp_array[] = $cPath_array[$i];
      }
    }

    return $tmp_array;
  }

  function zen_product_in_category($product_id, $cat_id) {
    global $db;
    $in_cat=false;
    $category_query_raw = "select categories_id from " . TABLE_PRODUCTS_TO_CATEGORIES . "
                           where products_id = '" . (int)$product_id . "'";

    $category = $db->Execute($category_query_raw);

    while (!$category->EOF) {
      if ($category->fields['categories_id'] == $cat_id) $in_cat = true;
      if (!$in_cat) {
        $parent_categories_query = "select parent_id from " . TABLE_CATEGORIES . "
                                    where categories_id = '" . $category->fields['categories_id'] . "'";

        $parent_categories = $db->Execute($parent_categories_query);
//echo 'cat='.$category->fields['categories_id'].'#'. $cat_id;

        while (!$parent_categories->EOF) {
          if (($parent_categories->fields['parent_id'] !=0) ) {
            if (!$in_cat) $in_cat = zen_product_in_parent_category($product_id, $cat_id, $parent_categories->fields['parent_id']);
          }
          $parent_categories->MoveNext();
        }
      }
      $category->MoveNext();
    }
    return $in_cat;
  }

  function zen_product_in_parent_category($product_id, $cat_id, $parent_cat_id) {
    global $db;
//echo $cat_id . '#' . $parent_cat_id;
    if ($cat_id == $parent_cat_id) {
      $in_cat = true;
    } else {
      $parent_categories_query = "select parent_id from " . TABLE_CATEGORIES . "
                                  where categories_id = '" . (int)$parent_cat_id . "'";

      $parent_categories = $db->Execute($parent_categories_query);

      while (!$parent_categories->EOF) {
        if ($parent_categories->fields['parent_id'] !=0 && !$incat) {
          $in_cat = zen_product_in_parent_category($product_id, $cat_id, $parent_categories->fields['parent_id']);
        }
        $parent_categories->MoveNext();
      }
    }
    return $in_cat;
  }


////
// products with name, model and price pulldown
  function zen_draw_products_pull_down($name, $parameters = '', $exclude = '') {
    global $currencies, $db;

    if ($exclude == '') {
      $exclude = array();
    }

    $select_string = '<select name="' . $name . '"';

    if ($parameters) {
      $select_string .= ' ' . $parameters;
    }

    $select_string .= '>';

	// fv                               and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
    $products = $db->Execute("select p.products_id, pd.products_name, p.products_price
                              from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
                              where p.products_id = pd.products_id
                              order by products_name");

    while (!$products->EOF) {
      if (!in_array($products->fields['products_id'], $exclude)) {
        $display_price = zen_get_products_base_price($products->fields['products_id']);
        $select_string .= '<option value="' . $products->fields['products_id'] . '">' . $products->fields['products_name'] . ' (' . $currencies->format($display_price) . ')</option>';
      }
      $products->MoveNext();
    }

    $select_string .= '</select>';

    return $select_string;
  }

////
// product pulldown with attributes
  function zen_draw_products_pull_down_attributes($name, $parameters = '', $exclude = '') {
    global $db, $currencies;

    if ($exclude == '') {
      $exclude = array();
    }

    $select_string = '<select name="' . $name . '"';

    if ($parameters) {
      $select_string .= ' ' . $parameters;
    }

    $select_string .= '>';

    $new_fields=', p.products_model';

	// fv                               and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
    $products = $db->Execute("select distinct p.products_id, pd.products_name, p.products_price" . $new_fields ."
                              from " . TABLE_PRODUCTS . " p, " .
                                       TABLE_PRODUCTS_DESCRIPTION . " pd, " .
                                       TABLE_PRODUCTS_ATTRIBUTES . " pa " ."
                              where p.products_id= pa.products_id and p.products_id = pd.products_id
                              order by products_name");

    while (!$products->EOF) {
      if (!in_array($products->fields['products_id'], $exclude)) {
        $display_price = zen_get_products_base_price($products->fields['products_id']);
        $select_string .= '<option value="' . $products->fields['products_id'] . '">' . $products->fields['products_name'] . ' (' . TEXT_MODEL . ' ' . $products->fields['products_model'] . ') (' . $currencies->format($display_price) . ')</option>';
      }
      $products->MoveNext();
    }

    $select_string .= '</select>';

    return $select_string;
  }


////
// categories pulldown with products
  function zen_draw_products_pull_down_categories($name, $parameters = '', $exclude = '') {
    global $db, $currencies;

    if ($exclude == '') {
      $exclude = array();
    }

    $select_string = '<select name="' . $name . '"';

    if ($parameters) {
      $select_string .= ' ' . $parameters;
    }

    $select_string .= '>';
    // fv                                and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'

    $categories = $db->Execute("select distinct c.categories_id, cd.categories_name " ."
                                from " . TABLE_CATEGORIES . " c, " .
                                         TABLE_CATEGORIES_DESCRIPTION . " cd, " .
                                         TABLE_PRODUCTS_TO_CATEGORIES . " ptoc " ."
                                where ptoc.categories_id = c.categories_id
                                and c.categories_id = cd.categories_id
                                order by categories_name");

    while (!$categories->EOF) {
      if (!in_array($categories->fields['categories_id'], $exclude)) {
        $select_string .= '<option value="' . $categories->fields['categories_id'] . '">' . $categories->fields['categories_name'] . '</option>';
      }
      $categories->MoveNext();
    }

    $select_string .= '</select>';

    return $select_string;
  }

////
// categories pulldown with products with attributes
  function zen_draw_products_pull_down_categories_attributes($name, $parameters = '', $exclude = '') {
    global $db, $currencies;

    if ($exclude == '') {
      $exclude = array();
    }

    $select_string = '<select name="' . $name . '"';

    if ($parameters) {
      $select_string .= ' ' . $parameters;
    }

    $select_string .= '>';

	// fv                                and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
 
    $categories = $db->Execute("select distinct c.categories_id, cd.categories_name " ."
                                from " . TABLE_CATEGORIES . " c, " .
                                         TABLE_CATEGORIES_DESCRIPTION . " cd, " .
                                         TABLE_PRODUCTS_TO_CATEGORIES . " ptoc, " .
                                         TABLE_PRODUCTS_ATTRIBUTES . " pa " ."
                                where pa.products_id= ptoc.products_id
                                and ptoc.categories_id= c.categories_id
                                and c.categories_id = cd.categories_id
                                order by categories_name");

    while (!$categories->EOF) {
      if (!in_array($categories->fields['categories_id'], $exclude)) {
        $select_string .= '<option value="' . $categories->fields['categories_id'] . '">' . $categories->fields['categories_name'] . '</option>';
      }
      $categories->MoveNext();
    }

    $select_string .= '</select>';

    return $select_string;
  }

////
// look up categories product_type
  function zen_get_product_types_to_category($lookup) {
    global $db;

    $lookup = str_replace('cPath=','',$lookup);

    $sql = "select product_type_id from " . TABLE_PRODUCT_TYPES_TO_CATEGORY . " where category_id='" . (int)$lookup . "'";
    $look_up = $db->Execute($sql);

    if ($look_up->RecordCount() > 0) {
      return $look_up->fields['product_type_id'];
    } else {
      return false;
    }
  }

//// look up parent categories name
  function zen_get_categories_parent_name($categories_id) {
    global $db;

    $lookup_query = "select parent_id from " . TABLE_CATEGORIES . " where categories_id='" . (int)$categories_id . "'";
    $lookup = $db->Execute($lookup_query);

    $lookup_query = "select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id='" . (int)$lookup->fields['parent_id'] . "'";
    $lookup = $db->Execute($lookup_query);

    return $lookup->fields['categories_name'];
  }

////
// Get all products_id in a Category and its SubCategories
// use as:
// $my_products_id_list = array();
// $my_products_id_list = zen_get_categories_products_list($categories_id)
  function zen_get_categories_products_list($categories_id, $include_deactivated = false, $include_child = true) {
    global $db;
    global $categories_products_id_list;

    if ($include_deactivated) {

      $products = $db->Execute("select p.products_id
                                from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                                where p.products_id = p2c.products_id
                                and p2c.categories_id = '" . (int)$categories_id . "'");
    } else {
      $products = $db->Execute("select p.products_id
                                from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                                where p.products_id = p2c.products_id
                                and p.products_status = '1'
                                and p2c.categories_id = '" . (int)$categories_id . "'");
    }

    while (!$products->EOF) {
// categories_products_id_list keeps resetting when category changes ...
//      echo 'Products ID: ' . $products->fields['products_id'] . '<br>';
      $categories_products_id_list[] = $products->fields['products_id'];
      $products->MoveNext();
    }

    if ($include_child) {
      $childs = $db->Execute("select categories_id from " . TABLE_CATEGORIES . "
                              where parent_id = '" . (int)$categories_id . "'");
      if ($childs->RecordCount() > 0 ) {
        while (!$childs->EOF) {
          zen_get_categories_products_list($childs->fields['categories_id'], $include_deactivated);
          $childs->MoveNext();
        }
      }
    }
    $products_id_listing = $categories_products_id_list;
    return $products_id_listing;
  }

?>