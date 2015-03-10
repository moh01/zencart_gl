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
//  $Id: split_page_results.php 2839 2006-01-13 06:15:57Z drbyte $
//

  class splitPageResults {
    function splitPageResults(&$current_page_number, $max_rows_per_page, &$sql_query, &$query_num_rows) {
    
//      if ( ! $max_rows_per_page )
//        $max_rows_per_page = 100;
        
      global $db;
      if (empty($current_page_number)) $current_page_number = 1;

      $pos_to = strlen($sql_query);
     $query_lower = strtolower($sql_query);
     $pos_from = strpos($query_lower, ' from', 0);

     $pos_group_by = strpos($query_lower, ' group by', $pos_from);
     if (($pos_group_by < $pos_to) && ($pos_group_by != false)) $pos_to = $pos_group_by;

     $pos_having = strpos($query_lower, ' having', $pos_from);
     if (($pos_having < $pos_to) && ($pos_having != false)) $pos_to = $pos_having;

     $pos_order_by = strpos($query_lower, ' order by', $pos_from);
     if (($pos_order_by < $pos_to) && ($pos_order_by != false)) $pos_to = $pos_order_by;


      $reviews_count = $db->Execute("select count(*) as total " .
                                            substr($sql_query, $pos_from, ($pos_to - $pos_from)));

      $query_num_rows = $reviews_count->fields['total'];

      $num_pages = ceil($query_num_rows / $max_rows_per_page);
      if ($current_page_number > $num_pages) {
        $current_page_number = $num_pages;
      }
      $offset = ($max_rows_per_page * ($current_page_number - 1));

// fix offset error on some versions
      if ($offset < 0) { $offset = 0; }

      $sql_query .= " limit " . $offset . ", " . $max_rows_per_page;
    }

    function display_links($query_numrows, $max_rows_per_page, $max_page_links, $current_page_number, $parameters = '', $page_name = 'page') {
      global $PHP_SELF;

      if ( zen_not_null($parameters) && (substr($parameters, -1) != '&') ) $parameters .= '&';

// calculate number of pages needing links
      $num_pages = ceil($query_numrows / $max_rows_per_page);

      $pages_array = array();
      for ($i=1; $i<=$num_pages; $i++) {
        $pages_array[] = array('id' => $i, 'text' => $i);
      }

      if ($num_pages > 1) {
        $display_links = zen_draw_form('pages', basename($PHP_SELF), '', 'get');
/*
        if ($current_page_number > 1) {
          $display_links .= '<a href="' . zen_href_link(basename($PHP_SELF), $parameters . $page_name . '=' . ($current_page_number - 1), 'NONSSL') . '" class="splitPageLink">' . PREVNEXT_BUTTON_PREV . '</a>&nbsp;&nbsp;';
        } else {
          $display_links .= PREVNEXT_BUTTON_PREV . '&nbsp;&nbsp;';
        }
*/
        $display_links .= sprintf(TEXT_RESULT_PAGE, zen_draw_pull_down_menu($page_name, $pages_array, $current_page_number, 'onChange="this.form.submit();"'), $num_pages);
        $display_links .=  '<input type="hidden" name="source_db" value="'.$_SESSION['source_db'] . '">';
        $display_links .=  '<input type="hidden" name="order_numbers" value="'.$_SESSION['order_numbers'] . '">';
        $display_links .=  '<input type="hidden" name="el_pull_status" value="'.$_SESSION['el_pull_status'] . '">';
        $display_links .=  '<input type="hidden" name="customer_data" value="'.$_SESSION['customer_data'] . '">';
        $display_links .=  '<input type="hidden" name="customer_id" value="'.$_SESSION['customer_id'] . '">';
        $display_links .=  '<input type="hidden" name="numero_facture" value="'.$_SESSION['numero_facture'] . '">';
        $display_links .=  '<input type="hidden" name="critere_tri" value="'.$_SESSION['critere_tri'] . '">';
        $display_links .=  '<input type="hidden" name="what" value="'.$_SESSION['what'] . '">';
        $display_links .=  '<input type="hidden" name="critere_produit" value="'.$_SESSION['critere_produit'] . '">';
        $display_links .=  '<input type="hidden" name="site_internet" value="'.$_SESSION['site_internet'] . '">';
        $display_links .=  '<input type="hidden" name="ref_cmd" value="'.$_SESSION['ref_cmd'] . '">';
        $display_links .=  '<input type="hidden" name="type_piece" value="'.$_SESSION['type_piece'] . '">';
        $display_links .=  '<input type="hidden" name="zone_geo" value="'.$_SESSION['zone_geo'] . '">';

		
        if ($parameters != '') {
          if (substr($parameters, -1) == '&') $parameters = substr($parameters, 0, -1);
          $pairs = explode('&', $parameters);
          while (list(, $pair) = each($pairs)) {
            list($key,$value) = explode('=', $pair);
            $display_links .= zen_draw_hidden_field(rawurldecode($key), rawurldecode($value));
          }
        }

        if (SID) $display_links .= zen_draw_hidden_field(zen_session_name(), zen_session_id());

        $display_links .= '</form>';
      } else {
        $display_links = sprintf(TEXT_RESULT_PAGE, $num_pages, $num_pages);
      }

      return $display_links;
    }

    function display_count($query_numrows, $max_rows_per_page, $current_page_number, $text_output) {
      $to_num = ($max_rows_per_page * $current_page_number);
      if ($to_num > $query_numrows) $to_num = $query_numrows;
      $from_num = ($max_rows_per_page * ($current_page_number - 1));
      if ($to_num == 0) {
        $from_num = 0;
      } else {
        $from_num++;
      }

      return sprintf($text_output, $from_num, $to_num, $query_numrows);
    }
  }
?>