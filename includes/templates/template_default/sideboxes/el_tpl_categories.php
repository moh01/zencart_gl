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
  $lg_code = LG_CODE;

  // --- variables ajoutées pour gérer le double affichage de pop-list --- //
  $firstCateg = 1;
  $firstSubCateg = 1;


  $content .= '<table width="100%" border="0" cellspacing="0">
                <tr> 
                  <td align="right"> ';
   if ($lg_code==2)
    $content .= 'Constructeur &nbsp;&nbsp;&nbsp;&nbsp; ';
   else if ($lg_code==4)
    $content .= 'Hersteller &nbsp;&nbsp;&nbsp;&nbsp; ';

  $content .= '    </td>   <td  align="left"> ';

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
           $content .= '<select name="categ" onchange="document.location=this.value;">';   

           if ($lg_code==2)
              $content .= ' <option value=""> Marque ... ';  
           else if ($lg_code==4)
              $content .= ' <option value=""> Marke ... ';  
 
           
           $firstCateg = 0;        
        }
        $content .= '<option value="'. zen_href_link("advanced_search", $box_categories_array[$i]['path']).'"';
        if ( $box_categories_array[$i]['current'] )
        {
          $content .= ' SELECTED ';
        }
        $content .= '>' .$box_categories_array[$i]['name'];
        break;
      default:
        if ( $firstSubCateg )
        {
          $contentSub .= '<select name="subCateg" onchange="document.location=this.value;">';   
          $contentSub .= ' <option value=""> ';            
          $firstSubCateg = 0;        
        }
        $contentSub .= '<option value="'. zen_href_link(FILENAME_DEFAULT, $box_categories_array[$i]['path']).'"';
        if ( $box_categories_array[$i]['current'] )
        {
          $contentSub .= ' SELECTED ';
        }
        $contentSub .= '>' .$box_categories_array[$i]['name'];
      }
      $content .= '<br />' . "\n";
    }
  }
  if ( ! $firstCateg )
  {
    $content .= '</select>';
    $content .= '</td>
                </tr>
                <tr> ';
   if ($lg_code==2)
    $content .= '  <td align="right"> Videoprojecteur   </td>  ';
   else if ($lg_code==4)
    $content .= '  <td align="right"> Projektor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </td>  ' ;

    $content .= '   <td  align="left">'; 

  }
  if ( ! $firstSubCateg )
  {
      $content .= $contentSub .'</select>';
  } 
  else
  {
     if ($lg_code==2)
      $content .= '<select name="subCateg"><option value="">Modèle ...</select>';
     else if ($lg_code==4)
      $content .= '<select name="subCateg"><option value="">Model ...</select>';

  } 
   
  $content .= ' </td>
                </tr>
              </table>';

  $content .= '' . "\n";
?>