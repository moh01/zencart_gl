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
 /* 
  if ( $_SESSION['customer_id'] == '' )
  {
	  $content .= 
			'<form name="login"  action="index.php?main_page=login&amp;action=process&amp" method="post">
				<input style="background-color: rgb(255, 195, 102);" size="20" name="email_address" type="text"><br><br>
				<input style="background-color: rgb(255, 195, 102);" name="password" size="20" type="password"><br><br>
				<input name="submit" src="includes/templates/template_default/images/login.gif" type="image">
				</form> ';
  }
  */

  $content .= '<form name="frm">' . "\n";
  $content .= '<ul id="rechecheModele">
						<li id="rech_marque">';
						
  for ($i=0;$i<sizeof($box_categories_array);$i++) {
// echo $box_categories_array[$i]['name'];  
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

   // require('../' . DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . 'create_account.php');
    require(   DIR_WS_INCLUDES. '/languages/' . $_SESSION['language'] . '/' . 'el_libelles.php');
	
    switch(true) {
      case ($box_categories_array[$i]['top'] == 'true'):
        if ( $firstCateg )
        {
           $content .= '<select name="categ" onchange="document.location=this.value;">';  

		   $content .= ' <option value="">'. CHOIX_CONSTRUCTEUR . '...';   
   //        $content .= '<option value="'. zen_href_link(FILENAME_DEFAULT, $box_categories_array[$i]['path']).'"';  
   //        $content .= '>' .$box_categories_array[$i]['name'];
			   
           $firstCateg = 0;        
        }
        $content .= '<option value="'. zen_href_link(FILENAME_DEFAULT, $box_categories_array[$i]['path']).'"';
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
          $contentSub .= ' <option value=""> '.CHOIX_VIDEOPROJECTEUR;            
          $firstSubCateg = 0;        
        }
        $contentSub .= '<option value="'. zen_href_link(FILENAME_DEFAULT, $box_categories_array[$i]['path']).'"';
        if ( $box_categories_array[$i]['current'] )
        {
          $contentSub .= ' SELECTED ';
        }
        $contentSub .= '>' .$box_categories_array[$i]['name'];
      }
      // $content .= '<br />' . "\n";
    }
  }
  
  if ( ! $firstCateg )
  {
    $content .= '</select>';
    $content .= '</li>
				 <li id="rech_modele">'; 

  }
  if ( ! $firstSubCateg )
  {
      $content .= $contentSub .'</select>';
  } 
  else
  {
	   $content .= '<select name="subCateg"><option value="">'.CHOIX_VIDEOPROJECTEUR.'...</select>';
  } 
   
  $content .= ' </li>
				<li id="rech_soumettre">
					<a>'. COMMANDER . '</a>
				</li>

			</ul>
			<br>';

  $content .= '</form>' . "\n";
?>