<?php
  include_once('el_admin/el_functions.php');

/**
 * Common Template - tpl_tabular_display.php
 *
 * This file is used for generating tabular output where needed, based on the supplied array of table-cell contents.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_tabular_display.php 3957 2006-07-13 07:27:06Z drbyte $
 */

$lg_code =  $_SESSION['languages_id'];

if ($lg_code==3)
{
  $file_extension = "_es";
  $esplc = "Más detalles sobre las lámparas compatibles.";
}
else if ($lg_code==2)
{
  $file_extension = "";
  $esplc = "En savoir plus sur les lampes compatibles.";
  $esoi = "En savoir plus sur les lampes original inside.";  
}
else if ($lg_code==4)
{
  $file_extension = "_de";
  $esplc = "Mehr Wissen über kompatiblen Lampen.";
}
else if ($lg_code==5)
{
  $file_extension = "_en";
  $esplc = "Learn more about compatible lamps.";
  $esoi = "Learn more about original inside lamps.";  
  
}


//print_r($list_box_contents);
  $cell_scope = (!isset($cell_scope) || empty($cell_scope)) ? 'col' : $cell_scope;
  $cell_title = (!isset($cell_title) || empty($cell_title)) ? 'list' : $cell_title;

?>
<table  width="100%" border="0" cellspacing="0" cellpadding="0" id="<?php echo 'cat' . $cPath . 'Table'; ?>" class="tabTable">
<tr><td align=center>
<?php
  for($row=1; $row<sizeof($list_box_contents); $row++) {
    $r_params = "";
    $c_params = "";
    if (isset($list_box_contents[$row]['params'])) $r_params .= ' ' . $list_box_contents[$row]['params'];
//#fbd49d saumon
// effac4  vert
// d5dfe9  bleu

?>
   
<?php
    for($col=0;$col<sizeof($list_box_contents[$row]);$col++) {
      $c_params = "";
      $cell_type = ($row==0) ? 'th' : 'td';
      if (isset($list_box_contents[$row][$col]['params'])) $c_params .= ' ' . $list_box_contents[$row][$col]['params'];
      if (isset($list_box_contents[$row][$col]['align']) && $list_box_contents[$row][$col]['align'] != '') $c_params .= ' align="' . $list_box_contents[$row][$col]['align'] . '"';
      if ($cell_type=='th') $c_params .= ' scope="' . $cell_scope . '" id="' . $cell_title . 'Cell' . $row . '-' . $col.'"';
      if (isset($list_box_contents[$row][$col]['text'])) {
?>
   <?php 
    if ( $col ==0 )
    {
      $radical = substr ( $list_box_contents[$row][$col]['text'] ,0,4 );

      if ( ( $radical == 'BCEL' ) || ( substr ( $radical,0,2 ) == 'BO' ) )
      {
          $color = "#bdd2e4"; 
      }
      else
      {
          $color = "#E9E9E9"; 
      }

       echo '<table width=400 bgcolor='. $color . ' border=0  cellspacing="0">';

       echo '<tr>'; 
       echo '<td align=left  style="padding: 5px 5px 5px 5px;">'; 
       if ($lg_code==3)
         echo "Referencia de la lámpara";
       else if ($lg_code==2)
         echo "Référence de la lampe	";
       else if ($lg_code==4)
         echo "Referenz der Lampe	";
       else if ($lg_code==5)
         echo "Lamp reference	";
       
       echo '</td>'; 
       echo '<td align=right style="padding: 5px 5px 5px 5px;">';   
    }
    else if ( $col == 5 )
    {

    }
    else if ( $col == 2 )
    {
       echo '<td align=left style="margin: 0px;padding: 5px 5px 5px 5px;border-bottom: 1px solid white;border-top: 1px solid white;">'; 
       echo '<font style="color:#FF6900">';

       if ($lg_code == 5)
       {
          echo 'Price without tax';
       }
       else if ($lg_code == 3)
       {
          echo 'Precio &euro;';
       }
       else if ($lg_code == 2)
       {
          echo  'Prix  HT';
       }
       else if ($lg_code == 4)
       {
          echo 'Preis &euro; exkl. MwSt';
       }

       echo '</font>';
       echo '</td>'; 
       echo '<td align=right  style="margin: 0px;padding: 0px 5px 0px 5px;border-bottom: 1px solid white;border-top: 1px solid white;">';   
       echo '<h3 style="color:#FF6900">';
       $prix = $list_box_contents[$row][$col]['text'];
       $prix = str_replace('&euro;','',  $prix  );
	   
	   if ( ! $_SESSION['main_price_list_id'] ) 
	   {
	       $prix  = "###";
       }
//echo '.'.$prix.'.';exit;	   
	   if ( $prix == '<br />' )
	   {
	      $prix = MISSING_PRICE_HINT;		  
	   }
      
//       $prix = str_replace(',',' ',  $prix  );
//       $prix = str_replace('.',',',  $prix  );

       echo  $prix; 
	   
       echo '</h3>';
       echo '</td>'; 

    }
    else if ( $col == 3 )
    {

       $args = explode("|", $list_box_contents[$row][1]['text']  );
       $categ_code = $args[0];
       $desc = $args[1];
       $id   = $args[2];


       echo '<tr> <td> ';
/*	   
       if ( $categ_code == "LO3" || $categ_code == "LO5" )
       {
          echo  '<img  VSPACE=10 HSPACE=10  src="includes/templates/template_default/images/lampeooptions'.$file_extension.'.gif"  border=0> ';
       }
       else if ( $categ_code == "LC5" )
       {
          echo  '<img  VSPACE=10 HSPACE=10   src="includes/templates/template_default/images/lampecptoptions'.$file_extension.'.gif"  border=0> ';
       }
       else if ( $categ_code == "BC5" )
       {
          echo  '<img  VSPACE=10 HSPACE=10   src="includes/templates/template_default/images/bulbcptoptions'.$file_extension.'.gif"  border=0> ';
       }

       $warranty_duration = 3;

       if    ( $categ_code == "LO3" || $categ_code == "LO5" )
       {     
         $sql = "select ct.categories_description 
                 from   products pd,
                        categories vi,
                        categories_description ct
                 where  pd.products_id=" . $id . " 
                   and  pd.master_categories_id = vi.categories_id
                   and  vi.parent_id = ct.categories_id "  ;
  
         $new_product_query = $db->Execute( $sql );
         $warranty_duration = $new_product_query->fields['categories_description'];          
       }         
       if (  $warranty_duration == 3 )
       {
           echo  '    <img    src="includes/templates/template_default/images/garantie3mois'.$file_extension.'.gif"  border=0>  ';   
       }
       else
       {
           echo  '    <img    src="includes/templates/template_default/images/garantie1mois'.$file_extension.'.gif"  border=0>  ';   
       }
*/

     echo '<td   align=right>';

    }
	


    if  ( (  $col != 1 ) && (  $col != 2 ) )
    {
       echo   $list_box_contents[$row][$col]['text']; 
	   /*
       if ($col == 0)  
       {
          if ( ( $radical == 'LCEL' ) || ( $radical == 'MCEL' ) )
          {
              echo '</td><tr><td colspan=2 align=right>
                             <a style="color: blue;"  href="javascript:popupWindow(\'page_4.htm#LC\');">'.$esplc.'</a>'; 
          }
          else if  ( $radical == 'BCEL' )
          {
              echo '</td><tr><td colspan=2 align=right><a style="color: blue;" href="javascript:popupWindow(\'page_4.htm#BC\');">'.$esplc.'</a>'; 
          }
          else if  ( substr($radical, 0, 3) == 'OI-' )
          {
              echo '</td><tr><td align=right><img src="includes/templates/template_default/images/original_inside.gif"></td><td align=right><a style="color: blue;" href="javascript:popupWindow(\'page_4.htm#OI\');">'.$esoi.'</a>'; 
          }		  
       }
	   */
       echo '</td>'; 
    }
    echo '</tr>'; 
   
   if ($col == 0)  
   {
   
       $lamp_code =  $list_box_contents[$row][$col]['text'];
	   
	  $args = explode("_", $cPath );
	  $model = $args[1];
	   
       $sql = "SELECT           man.manufacturers_name ,
                                catd.categories_name,
					cstr.categories_name constructeur
               FROM categories AS cat, categories_description AS catd, 
			        categories_description AS cstr,
                    products AS prd, products_description AS prdd,
                    manufacturers AS man
               WHERE cat.categories_id = catd.categories_id
               AND prdd.language_id =2
               AND catd.language_id =2
			   AND cstr.categories_id = cat.parent_id
			   AND cstr.language_id =2
               AND prdd.products_id = prd.products_id
               AND prd.master_categories_id = cat.categories_id
               AND prd.manufacturers_id = man.manufacturers_id
			   AND cat.categories_id = " . $model  . "
               AND prdd.products_name = '" .  $lamp_code . "'"  ;       

			   $lamp_check = $db->Execute($sql);
//echo $sql;exit;		
		$manu_code = $lamp_check->fields['manufacturers_name'];
		$ref_vp = $lamp_check->fields['categories_name'];

		$constructeur = $lamp_check->fields['constructeur'];
		
	   $desc = get_product_desc ($manu_code,$ref_vp, $lg_code, $constructeur);
	   $desc = str_replace ( 'Original Inside' , '"Original Inside" <img   src="includes/templates/template_default/images/original_inside.gif" >' ,  $desc );
 /*
<table><tr><td>'. $lampe_hybride_label[$lg_id] ;
				 $html_output .=  '</td><td><img   src="includes/templates/template_default/images/original_inside.gif" ></td>
*/				 
       echo '<td colspan=2 align=center style="margin: 0px;padding: 5px 5px 5px 5px;border-bottom: 1px solid white;border-top: 1px solid white;">'; 
  // substr($radical, 0, 2)
       $code_type = substr($radical, 0, 2);
	   if ( $code_type=='MC' )
	     $code_type = "LC";
	   else if ( ( $code_type=="BC" ) || ( $code_type=="BO" ) )
	     $code_type = "LC";
		 
	   echo '<table><tr><td valign=center><h2 style="color: rgb(116, 145, 182);">'.$desc.'</h2></td>
				                       <td width="30" valign=center>
									   <a href="javascript:popupWindow(\'page_4_'. $_SESSION['languages_id'] .'.htm#'.  $code_type  .'\');">
									   <img src="includes/templates/template_default/images/help.gif">
									   </a>
									   </td></tr></table>';
									             
       echo '</td>'; 
       echo '</tr>'; 

       echo '<tr>'; 
       echo '<td align=left style="padding: 5px 5px 5px 5px;border-bottom: 1px solid white;">'; 
       
       if ($lg_code == 5)
          echo "Delay";
       if ($lg_code == 3)
          echo "Entrega";
       else if ($lg_code == 2)
          echo "Délai";
       else if ($lg_code == 4)
         echo "Lieferfrist";

       echo '</td>'; 
       echo '<td align=right style="padding: 5px 5px 5px 5px;border-bottom: 1px solid white;">';  
	   

	   if ( ! $_SESSION['main_price_list_id'] ) 
	   {
	       echo "###";
       }
	   else
	   {
	      if ( $manu_code == 'BC5' )
		  {		  
               $stock_qty = 10;
		  }
		  else
		  {		     
			  $sql = "select qty from el_stock where lamp_code  = '" .  $lamp_code  ."'" ;
			  $stock_check = $db->Execute($sql);
			  $stock_qty = $stock_check->fields['qty'] ;
          }	   
	       if ( ! ( $stock_qty > 0 )  )
	       {
//echo $manu_code;
    		   if (  $manu_code == "LO9" )
			   {
			       $days_nbr = 9;
			   }
			   else
			   {
			       $days_nbr = 6;			   
			   }			   
	       }
	       else 
	       {
		       $days_nbr ='<img src="includes/templates/template_default/images/enstock.gif"  border=0> &nbsp;&nbsp;   2';			   		   
	       }
		   if (  $manu_code != "LO9" )
		   {
			   if ($lg_code == 5)
				  echo $days_nbr. ' days';
			   else if ($lg_code == 3)
				  echo $days_nbr.' días';
			   else if ($lg_code == 2)
				  echo $days_nbr.' jours';
			   else if ($lg_code == 4)
				  echo $days_nbr.' Tage';
		   }
		   else
		   {
		      echo DELAI_LO9;
		   }
		   
	   }
       echo '</td></tr>'; 	 

	   
       if ( $stock_qty > 0  )	   
	   {
	   
	       echo '<tr>'; 
	       echo '<td align=left style="padding: 5px 5px 5px 5px;">'; 
	   
		   if ($lg_code == 5)
			  echo 'Quantity in stock';
		   else if ($lg_code == 3)
			  echo 'stock';
		   else if ($lg_code == 2)
			  echo 'Quantité en stock';
		   else if ($lg_code == 4)
			  echo 'stock';	      

	       echo '</td>'; 
	       echo '<td align=right style="padding: 5px 5px 5px 5px;">';  
		   echo $stock_qty;
	       echo '</td>'; 
	       echo '</tr>'; 	   
			  
			  
			  }
   }

    ?>
<?php
      }
    }
?>
  </table> <br>
<?php
  }
?> 
</td></tr>
</table>