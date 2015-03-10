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
  require('el_fonctions_gestion.php');  
  require('../el_admin/el_functions.php');
  $db->connect($ext_db_server[$_SESSION['source_db']], $ext_db_username[$_SESSION['source_db']], $ext_db_password[$_SESSION['source_db']], $ext_db_database[$_SESSION['source_db']], USE_PCONNECT, false);  
  
  
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
			if (strlen($_GET['short_name'])==0)
			{
	            $sql = "select customers_id from customers where customers_email_address = '". $_GET['nc_email']."'";		    
				$test = $db->Execute( $sql );
				
				if ( strlen($test->fields['customers_id'])>0 )
				{
				   echo  'Le email existe déjà pour le client '. $test->fields['customers_id'] . ' <br><br> <a href="javascript:history.go(-1)"> Cliquez ici pour reprendre </a>';
				   die();
				}
				   
			    $dml = " insert into customers  (
					         customers_gender, customers_firstname , customers_lastname ,
							 customers_email_address,customers_email_address2,customers_email_address3, customers_telephone, customers_fax,
							 customers_password, customers_authorization, model_orders_id, source_catalog,
	                         short_name	)
						 values (
					         '". $_GET['nc_genre'] . "', '". $_GET['nc_prenom'] . "' , '". $_GET['nc_nom'] . "' ,
							 '". $_GET['nc_email'] . "', '". $_GET['nc_email2'] . "','". $_GET['nc_email3'] . "', '".$_GET['nc_telephone'] . "', '". $_GET['nc_fax'] . "',
							 '5dc850f7a6c8feb0760146f1dd4c0027:54', 1 ,'". $_GET['model_orders_id'] . "', '". $_GET['source_catalog'] . "',
							 '". $_GET['nc_short_name'] . "' ) ";
					 
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
				
			}
			else
			{
			    $dml = " update customers  
				         set customers_gender =  '". $_GET['nc_genre'] . "',
						     customers_firstname  ='". $_GET['nc_prenom'] . "' ,
							 customers_lastname  = '". $_GET['nc_nom'] . "' ,
							 customers_email_address ='". $_GET['nc_email'] . "',
							 customers_email_address2 ='". $_GET['nc_email2'] . "',
							 customers_email_address3 ='". $_GET['nc_email3'] . "', 							 
							 customers_telephone ='".$_GET['nc_telephone'] . "',
							 customers_fax  = '". $_GET['nc_fax'] . "',
						     model_orders_id ='". $_GET['model_orders_id'] . "', 
							 source_catalog ='". $_GET['source_catalog'] . "',
	                         short_name	='". $_GET['nc_short_name']. "'
						 where  short_name	='" .$_GET['short_name']."'";							 ;
					         
					 
				$db->Execute($dml);
				
				$customers_id = exec_select("select customers_id value from customers where short_name = '".$_GET['nc_short_name']."'");			
				
			    $dml = " update  address_book  set
					         entry_gender = '". $_GET['nc_genre'] . "' , 
							 entry_company = '". $_GET['nc_societe'] . "' ,							 
							 entry_tva_intracom= '". $_GET['nc_intracom'] . "',
							 entry_firstname= '". $_GET['nc_prenom'] . "',
							 entry_lastname= '". $_GET['nc_nom'] . "',
							 entry_street_address=  '". $_GET['nc_addr1'] . "',
							 entry_suburb= '". $_GET['nc_addr2'] . "',
							 entry_postcode= '". $_GET['nc_code_postal'] . "',
							 entry_city= '". $_GET['nc_ville'] . "',
							 entry_state= '". $_GET['nc_state'] . "',
							 entry_country_id= '". $_GET['countries_id']."'
							where 
					         customers_id = ". $customers_id ; 

				$db->Execute($dml);
				$address_id = mysql_insert_id();			
			}
			echo 'Mise à jour enregistrée; sélectionner <a href="javascript:window.close();"> ce lien </a> pour fermer la fenêtre.';
			echo '<br>';
			echo '<br>';			
			echo '<hr>';


		}

  if ($oID==0) 
  {
     if ( true )
	 {
    	echo '
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Nouveau Fournisseur</title>
		<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
		</head>
		<body style=" { margin-top:10; margin-right:50; margin-bottom:50; margin-left:20; } ">';
		echo 'select supplier to modify ';
		$sql = 'select short_name from customers order by 1';
		$rs = $db->Execute($sql);
		while ( !$rs->EOF)
		{
		   echo '<a href=suppliers.php?short_name='.$rs->fields['short_name'].'>'.$rs->fields['short_name'].'</a>&nbsp;&nbsp;&nbsp;&nbsp;';
		   $rs->MoveNext();
		}
        if (strlen($_GET['short_name'])>0)
		{
			    $sql = "select
							customers_id,
							customers_gender,
						     customers_firstname,
							 customers_lastname,
							 customers_email_address,
							 customers_email_address2,
							 customers_email_address3,
							 customers_telephone,
							 customers_fax,
						     model_orders_id, 
							 source_catalog,
	                         short_name
						from  customers  
						 where  short_name	='". $_GET['short_name']."'";
					         			 
				$rs = $db->Execute($sql);
				
				$customers_id = $rs->fields['customers_id'];				
				$customers_gender = $rs->fields['customers_gender'];
				$customers_firstname = $rs->fields['customers_firstname'];
				$customers_lastname= $rs->fields['customers_lastname'];
				$customers_email_address= $rs->fields['customers_email_address'];
				$customers_email_address2= $rs->fields['customers_email_address2'];				
				$customers_email_address3= $rs->fields['customers_email_address3'];
				$customers_telephone= $rs->fields['customers_telephone'];
				$customers_fax= $rs->fields['customers_fax'];
				$model_orders_id= $rs->fields['model_orders_id'];
				$source_catalog= $rs->fields['source_catalog'];
//echo 	$customers_firstname;exit;			
			    $sql = "select
							 entry_gender,
							 entry_company,
							 entry_tva_intracom,
							 entry_firstname,
							 entry_lastname,
							 entry_street_address,
							 entry_suburb,
							 entry_postcode,
							 entry_city,
							 entry_state,
							 entry_country_id
						from  address_book  
						 where  customers_id=". $customers_id;
						 
				$rs = $db->Execute($sql);
						 
				 $entry_gender= $rs->fields['entry_gender'];
				 $entry_company= $rs->fields['entry_company'];
				 $entry_tva_intracom= $rs->fields['entry_tva_intracom'];
				 $entry_firstname= $rs->fields['entry_firstname'];
				 $entry_lastname= $rs->fields['entry_lastname'];
				 $entry_street_address= $rs->fields['entry_street_address'];
				 $entry_suburb= $rs->fields['entry_suburb'];
				 $entry_postcode= $rs->fields['entry_postcode'];
				 $entry_city= $rs->fields['entry_city'];
				 $entry_state= $rs->fields['entry_state'];
				 $entry_country_id= $rs->fields['entry_country_id'];
		}
		echo '<hr>
		<form> 
		<input type="hidden" value="1" name="updating">
		<input type="hidden" value="'.$_GET['short_name'].'" name="short_name">';		
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
		   if ( $ctry->fields['countries_id']== $entry_country_id )
		      echo "SELECTED";
			  
		   echo ' value="'. $ctry->fields['countries_id'] .'">' . $ctry->fields['countries_name'];		
		   $ctry->MoveNext();
		}
		echo '</select>';
		echo '</td>';
		echo '</tr>';		

		$db->connect($ext_db_server['gl'], $ext_db_username['gl'], $ext_db_password['gl'], $ext_db_database['gl'], USE_PCONNECT, false);  		
		echo '<tr>';		
		echo '<td>';		
		echo 'Modèle de commande ($/€)';		
		echo '</td>';				
		echo '<td>';	
	    echo get_select ( "select orders_id code, customers_name description from orders where orders_id<0 order by 1 desc", "model_orders_id", $model_orders_id );
		echo '</td>';		
		echo '</tr>';		
		
		

		echo '<tr> <td> <font color=red> Entreprise / Société </font> </td>  <td colspan=3>
		            <Input type="text" name="nc_societe" value="'.$entry_company.'" size=50></td></tr>';
		echo '<tr> <td> <font color=red> Non court  </font> </td>  <td colspan=3>
		            <Input type="text" name="nc_short_name"  value="'.$_GET['short_name'].'" size=5></td></tr>';
					
		echo '<tr> <td> Nº de TVA intracom</td>  <td colspan=3><Input type="text" value="'.$entry_tva_intracom.'" name="nc_intracom"></td></tr>';		
		$html = '<tr> <td> M.Mme </td>  
		      <td>
			  <select name="nc_genre">
			    <option value="m">Mr
			    <option value="f">Mme
              </select>
        	  </td>
              <td></td>  <td></td>
			  </tr>';
		echo  eregi_replace('"'.$customers_gender.'"' , '"'.$customers_gender.'" SELECTED' ,$html ); 
			  
		echo '<tr> <td> Prénom </td>  <td><Input type="text" value="'.$customers_firstname.'" name="nc_prenom"></td><td> Nom </td>  <td><Input type="text" value="'.$customers_lastname.'" name="nc_nom" size=40></td></tr>';
		
		echo '<tr> <td> <font color=red> Email principal </font></td>  <td colspan=3><Input type="text" name="nc_email" value="'.$customers_email_address.'" size=40></td></tr>';
		echo '<tr> <td> Email 2 </td>  <td colspan=3><Input type="text" name="nc_email2" value="'.$customers_email_address2.'" size=40></td></tr>';
		echo '<tr> <td> Email 3 </td>  <td colspan=3><Input type="text" name="nc_email3" value="'.$customers_email_address3.'" size=40></td></tr>';

		$html =  '<tr> <td> Type de produit </td>  
		      <td>
			  <select name="source_catalog">
			    <option value="eu">Lampes
			    <option value="bf">PCP
              </select>
        	  </td>
              <td></td>  <td></td>';
			  
		echo  eregi_replace('"'.$source_catalog.'"' , '"'.$source_catalog.'" SELECTED' ,$html ); 
			  

        echo '<tr><td> Adresse 1</td>  <td colspan=3><Input type="text" value="'. $entry_street_address .'" name="nc_addr1" size=70></td></tr>';
        echo '<tr><td> Adresse 2 </td>  <td  colspan=3><Input type="text"  value="'. $entry_suburb .'" name="nc_addr2" size=70></td></tr>';
		echo '<tr><td> Code Postal </td>  <td><Input type="text" value="'. $entry_postcode .'" name="nc_code_postal"></td>  <td> Ville </td> <td><Input type="text"  size=40 value="'.$entry_city.'" name="nc_ville"></td></tr></tr>';
		echo '<tr><td> State (US) County (UK) </td>  <td><Input type="text" value="'.$entry_state.'" name="nc_state"></td>  <td> &nbsp; </td> <td> &nbsp; </td></tr></tr>';	
		echo '<tr> <td> Téléphone </td>  <td><Input type="text" value="'. $customers_telephone .'" name="nc_telephone"></td> <td> Fax </td>  <td><Input type="text" value="'.$customers_fax.'" name="nc_fax"></td></tr>';
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