<?php
/*
//////////////////////////////////////////////////////////
//  SUPER ORDERS                                        //
//                                                      //
//  By Frank Koehl (PM: BlindSide)                      //
//                                                      //
//  Powered by Zen-Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2005 The Zen-Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
//  DESCRIPTION:   Replaces admin/orders.php, adding    //
//  new features, navigation options, and an advanced   //
//  payment management system.                          //
//////////////////////////////////////////////////////////685
// $Id: super_orders.php 43 2006-08-29 14:05:21Z BlindSide $
*/

//_TODO add admin account id to status history record
//_TODO form verifications on edit & payment popup forms
//_TODO payment_types table interface
//_TODO popup class to build/display help or additional data in new window
//_TODO make following replacements in all SO files...
//                 <br> --> <br />
//                  <b> --> <strong>
//        zen_db_output --> zen_db_scrub_out($x)
//         zen_db_input --> zen_db_scrub_in($x, true/false)
// zen_db_prepare_input --> zen_db_scrub_in($x, true/false)

  require('includes/application_top.php');
  require('../el_admin/el_functions.php');
  $db->connect($ext_db_server[$_SESSION['source_db']], $ext_db_username[$_SESSION['source_db']], $ext_db_password[$_SESSION['source_db']], $ext_db_database[$_SESSION['source_db']], USE_PCONNECT, false);  
  
function get_select ( $sql_stmt, $name, $value, $select_attributes='' )
{
  global $db;
    $start_html =  '';
    $end_html =  '';
//echo    $select_attributes;exit;
   $recordSet = $db->Execute( $sql_stmt );

   $html =  '<select  name="'.$name.'" '. $select_attributes .'>';
   $html .= '<option value=""></option>';
   
            while (!$recordSet->EOF) {
                 $html .=  '<option ';


                 if ($value)
                 {				 
                    if ($value==$recordSet->fields['code'])
                    {					
                         $html .=  ' SELECTED ';
                    }
                 }
                    $html .=  ' value="'.$recordSet->fields['code'].'">'. stripslashes ( $recordSet->fields['description'] ) ."\n";
                 $recordSet->MoveNext();
              };
      $html .=  '</select> ';

      return $start_html . $html . $end_html;
}
  
  $new_customer = 0;
  if ( $_GET['updating'] )
  {
     $saisie_ok=1;
	 
     // test de la saisie incomplete
     if ( strlen($_GET['countries_id'])	 
	      *strlen($_GET['nc_societe']) == 0	 )
	 {	     
		$saisie_ok=0;
	 }      
	if ( $saisie_ok == 0 )
	{
//echo $_GET['countries_id'];
	   echo  'Saisie incomplete <br><br> <a href="javascript:history.go(-1)"> Cliquez ici pour reprendre </a>';
	   exit;
	}		
  }
	    if ( $saisie_ok )	
		{
            // test de la nom existance du mail 
            $sql = "select customers_id from customers where customers_email_address = '". $_GET['nc_email']."'";		    
			$test = $db->Execute( $sql );
			
			if ( strlen($test->fields['customers_id'])>0 )
			{
			   echo  'Le email existe déjà pour le client '. $test->fields['customers_id'] . ' <br><br> <a href="javascript:history.go(-1)"> Cliquez ici pour reprendre </a>';
			   die();
			}
			   
		    $dml = " insert into customers  (
				         customers_gender, customers_firstname , customers_lastname ,
						 customers_email_address, customers_telephone, customers_fax,
						 customers_password, customers_authorization, sales_rep_code )
					 values (
				         '". $_GET['nc_genre'] . "', '". $_GET['nc_prenom'] . "' , '". $_GET['nc_nom'] . "' ,
						 '". $_GET['nc_email'] . "', '". $_GET['nc_telephone'] . "', '". $_GET['nc_fax'] . "',
						 '5dc850f7a6c8feb0760146f1dd4c0027:54', 1, '". $_GET['sales_rep'] . "' ) ";
				 
			$db->Execute($dml);
			$customers_id = mysql_insert_id();			
			
		    $dml = " insert into address_book  (
				         customers_id,  entry_gender, entry_company ,
						 entry_tva_intracom, entry_firstname, entry_lastname,
						 entry_street_address, entry_suburb, entry_postcode,
						 entry_city, entry_state, entry_country_id
						 )
					 values (
				         '". $customers_id . "', '". $_GET['nc_genre'] . "' , '". $_GET['nc_societe'] . "' ,
						 '". $_GET['nc_intracom'] . "', '". $_GET['nc_prenom'] . "', '". $_GET['nc_nom'] . "',
						 '". $_GET['nc_addr1'] . "', '". $_GET['nc_addr2'] . "', '". $_GET['nc_code_postal'] . "',
						 '". $_GET['nc_ville'] . "',  '". $_GET['nc_state'] . "', '". $_GET['countries_id'] . "' ) ";

			$db->Execute($dml);
			$address_id = mysql_insert_id();			
			
			$dml = "insert into customers_info ( customers_info_id , customers_info_date_account_created ) values ( " . $customers_id . " , now() ) ";
			$db->Execute($dml);
			
			$dml = "update customers set customers_default_address_id = " . $address_id . " where customers_id = " . $customers_id;
			$db->Execute($dml);
			echo 'Insertion enregistrée; sélectionner <a href="javascript:window.close();"> ce lien </a> pour fermer la fenêtre.';
			echo '<br>';
			echo '<br>';			
			echo '<hr>';
			echo 'Ou enregister un nouveau propect.';
			echo '<br>';
			echo '<br>';


		}

  if ($oID==0) 
  {
     if ( true )
	 {
    	echo '
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Nouveau client</title>
		<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
		</head>
		<body style=" { margin-top:10; margin-right:50; margin-bottom:50; margin-left:20; } ">
		<form> 
		<input type="hidden" value="1" name="updating">';
		echo '<table>';
		echo '<tr> <td> Pays</td>';
        echo '<td colspan=3> ';

			$sql = "select countries_id, countries_name
	                  from countries order by 2";
		 
		 echo '<select name="countries_id">';
         echo '<option value="">';		 
		 
		$ctry = $db->Execute($sql);
		while ( ! $ctry->EOF )
		{
		   echo '<option ';
		   if ( $ctry->fields['countries_id']==73 )
		      echo "SELECTED";
			  
		   echo ' value="'. $ctry->fields['countries_id'] .'">' . $ctry->fields['countries_name'];		
		   $ctry->MoveNext();
		}
		echo '</select>';
		echo '</td>';
		echo '</tr>';		

		echo '<tr>';		
		echo '<td>';		
		echo 'Vendeur';		
		echo '</td>';				
		echo '<td>';		
		echo  get_select ('select code, code  description from el_sales_rep', 'sales_rep',$_SESSION['sales_rep']);		
		echo '</td>';		
		echo '</tr>';		

		echo '<tr> <td> <font color=red> Entreprise / Société </font> </td>  <td colspan=3><Input type="text" name="nc_societe" size=50></td></tr>';
		echo '<tr> <td> Nº de TVA intracom</td>  <td colspan=3><Input type="text" name="nc_intracom"></td></tr>';		
		echo '<tr> <td> M.Mme </td>  
		      <td>
			  <select name="nc_genre">
			    <option value="m">Mr
			    <option value="f">Mme
              </select>
        	  </td>
              <td></td>  <td></td>';
		echo '<tr> <td> Prénom </td>  <td><Input type="text" name="nc_prenom"></td><td> Nom </td>  <td><Input type="text" name="nc_nom" size=40></td></tr>';
		$email_unique = gmmktime().'@easylamps.fr';
		
		echo '<tr> <td> Email </td>  <td colspan=3><Input type="text" name="nc_email" value='. $email_unique .' size=40></td></tr>';
        echo '<tr><td> Adresse 1</td>  <td colspan=3><Input type="text" name="nc_addr1" size=70></td></tr>';
        echo '<tr><td> Adresse 2 </td>  <td  colspan=3><Input type="text" name="nc_addr2" size=70></td></tr>';
		echo '<tr><td> Code Postal </td>  <td><Input type="text" name="nc_code_postal"></td>  <td> Ville </td> <td><Input type="text"  size=40 name="nc_ville"></td></tr></tr>';
		echo '<tr><td> County (UK) </td>  <td><Input type="text" name="nc_state"></td>  <td> &nbsp; </td> <td> &nbsp; </td></tr></tr>';	
		echo '<tr> <td> Téléphone </td>  <td><Input type="text" name="nc_telephone"></td> <td> Fax </td>  <td><Input type="text" name="nc_fax"></td></tr>';
		echo '<tr> <td> &nbsp; </td>  <td> &nbsp; </td> <td> &nbsp; </td><td> &nbsp; </td>  <td><input type="submit"></td></tr>';		
		echo '</table>';
		
				
		 
         }   
		 

			
	     echo '
		       </form>';
	     echo  '</body>';
	     echo  '</html>';

		 exit;
	 }
	 ?>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>