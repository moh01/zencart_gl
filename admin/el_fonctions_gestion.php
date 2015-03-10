<?php
function get_order_id ( $order_id )
{
//echo 'jjjjjjjjjjjjj'. 	$order_id; 
//0000001500977
	 if ( strpos(' '.strtoupper($order_id),'000006') 
				 || strpos(' '.strtoupper($order_id),'000003')
				 || strpos(' '.strtoupper($order_id),'000004')						 
				 || strpos(' '.strtoupper($order_id),'000009')						 )
	 {
//echo 'pppppppppppp'.$order_id;
	 
		$temp = str_replace('00000','',$order_id);
		$temp = floor($temp/100);								
	 }			 
	 else if ( strpos(' '.strtoupper($order_id),'00000') )
	 {
//echo 'iiiiiiiiiiiii'. 	$order_id; 

		$temp = str_replace('00000','',$order_id);
// 0000001500977		
//echo 'oooooooooooo'. 	$temp.'kkkkkkkkk'; 		
//echo 'xxxx'.strpos(strtoupper(' '.$temp),'15').'tttttttttt';
		// cmdes PLN
		if 	 (strpos(strtoupper(' '.$temp),'15')==1 )
		{
			$temp = floor($temp/100);
		}
		else
		{
			$temp = floor($temp/10);
		}		
	 }
	 else 
	 {
echo 'mmmm'. 	$order_id; 		
		return $order_id;
	 }
	 
	 return $temp;
}

function init_stock_virtuel()
{
	global $db;
	$sql = "SELECT DISTINCT	lamp_code
			from rv_lampe_eu.el_stock
			where (ctr_code,lamp_code) not in (select ctr_code2,lamp_code2 from el_equivalence)";
echo $sql.'<br>';			
	$rs = $db->Execute($sql);
	while(!$rs->EOF)
	{

   	 $lamp_code=$rs->fields['lamp_code'];
echo $lamp_code.'<br>';
		$dummy = get_stock_virtuel($lamp_code);
		$rs->MoveNext();
	}	 
}
function get_stock_virtuel($lamp_code)
{
    global $db;
    global $ext_db_name;
	
    $main_html = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <meta http-equiv="content-type"
 content="text/html; charset=ISO-8859-1">
  <title>D�tail stock virtuel</title>
  <link type="text/css" href="le.css" rel="stylesheet">
</head>
<body>
<table style="text-align: left; width: 100%;" border="1"
 cellpadding="2" cellspacing="2">
  <tbody>
    <tr>
      <td colspan="3" rowspan="1">
      <div style="text-align: center;"></div>
      <h1 style="text-align: center;">Lampe
LAMP_CODE&nbsp;</h1>
      </td>
    </tr>
    <tr>
      <td colspan="1" rowspan="2">
      <table style="text-align: left; width: 100%;" border="1"
 cellpadding="2" cellspacing="2">
        <tbody>
          <tr>
            <td colspan="1" rowspan="1"><span
 style="font-weight: bold; text-decoration: underline;"></span>&nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td colspan="1" rowspan="1" align="center"><span
 style="color: rgb(0, 0, 0); font-family: sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(229, 229, 229); display: inline ! important; float: none;"><span
 class="Apple-converted-space"></span></span><span
 class="syntax_quote syntax_quote_single"
 style="color: rgb(0, 128, 0); white-space: pre; font-family: sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; word-spacing: 0px; background-color: rgb(229, 229, 229);"></span>SUPPLY_HTML<br
 class="Apple-interchange-newline">
            </td>
          </tr>
          <tr>
          </tr>
        </tbody>
      </table>
      </td>
      <td>
      <h2>Stock : &nbsp;CURRENT_STOCK</h2>
      </td>
      <td colspan="1" rowspan="2">
      <table style="text-align: left; width: 100%;" border="1"
 cellpadding="2" cellspacing="2">
        <tbody>
          <tr style="font-weight: bold; text-decoration: underline;">
            <td colspan="1" rowspan="1"><br>
            </td>
          </tr>
          <tr>
            <td colspan="1" rowspan="1">
            <div style="text-align: center;"><br>
            </div>
SALES_HTML<br>
            <span class="syntax_alpha syntax_alpha_reservedWord"
 style="color: rgb(153, 0, 153); text-transform: uppercase; font-weight: bold; font-family: sans-serif; font-size: 10px; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; white-space: normal; word-spacing: 0px; background-color: rgb(229, 229, 229);"></span></td>
          </tr>
        </tbody>
      </table>
      </td>
    </tr>
    <tr>
      <td>
      <h2>Stock virtuel : &nbsp;VIRTUAL_STOCK</h2>
      </td>
    </tr>
  </tbody>
</table>
<br>
<br>
</body>
</html>';

    $main_html = str_replace ( 'LAMP_CODE', $lamp_code, $main_html );
	
	$sql = "select max(qty) value from rv_lampe_eu.el_stock where lamp_code = '".$lamp_code ."'";
	$current_stock = exec_select ($sql);
	
    $main_html = str_replace ( 'CURRENT_STOCK', $current_stock, $main_html );
	
	
	$supply_html = '<br>
            <table style="text-align: left; width: 100%;"
 border="1" cellpadding="2" cellspacing="2">
              <tbody border="0">
                <tr>
                  <td><span
 style="font-weight: bold; text-decoration: underline;">Deni�res
Commandes fournisseur</span></td>
                  <td style="background-color: rgb(153, 255, 153);">Attendues</td>
                  <td style="background-color: rgb(204, 204, 204);">recues</td>
                  <td style="background-color: rgb(255, 204, 102);">Tardives (sur 42 jours)</td>
                </tr>
              </tbody>
            </table>
            <span class="syntax_quote syntax_quote_single"
 style="color: rgb(0, 128, 0); white-space: pre; font-family: sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; word-spacing: 0px; background-color: rgb(229, 229, 229);"></span></div>
            <table id="table_results" class="data"
 style="color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13.3333px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; width: 278px; height: 121px;">
              <tbody>
              </tbody><thead></thead>
              <tbody>';


     $sql  = "
		   SELECT products_quantity, customers_company, c.short_name, date_format(date_purchased,'%Y-%c-%d') date_purchased, 
				 orders_products_id, (date_purchased >  DATE_SUB(CURDATE(),INTERVAL 42 DAY)) expected,
				 o.orders_id
			FROM bo_po.orders_products op, bo_po.orders o,bo_po.customers c
			WHERE products_model = '".$lamp_code."'
			AND o.orders_id = op.orders_id
			AND database_code = 'po'
			AND o.customers_id = c.customers_id
			and o.customers_id not in (29,28)			
			order by date_purchased desc
			limit 0,15";

//echo $sql;exit;
			
	$rs = $db->Execute($sql);
	$total_a_recevoir = 0;
	
    while (!$rs->EOF)
	{
	    // 
		$expected = $rs->fields['expected'];
	    $qte_recue = stock_items_lookup ($rs->fields['orders_products_id']);
		
//echo 'recue'.$qte_recue.'<br>';
//echo 'qty'.$rs->fields['products_quantity'].'<br>';
//echo 'orders_products_id'.$rs->fields['orders_products_id'].'<br>';
//echo '<br><br>';
		
		if ( $qte_recue < $rs->fields['products_quantity'] )
		{
			$a_recevoir = "";
			if ($expected)
			{
				$bgcolor = "204, 255, 204";
				$a_recevoir = $rs->fields['products_quantity']-$qte_recue;
				$total_a_recevoir += $a_recevoir;
			}
			else
			{
				$bgcolor = "255, 204, 51";
			}			
		}
		else
		{
			$a_recevoir = "";
			$bgcolor = "213, 213, 213";			
		}

		
		$supply_html .= '
                <tr class="odd"
 style="background-color: rgb('. $bgcolor . '); text-align: left; color: rgb(0, 0, 0);">
                  <td class="nowrap"
 style="margin: 0.1em; padding: 0.1em 0.5em; vertical-align: top; white-space: nowrap; background-color: rgb('. $bgcolor . '); text-align: center;">
                  '. $rs->fields['products_quantity'] .'
                  </td>
                  <td class=""
 style="margin: 0.1em; padding: 0.1em 0.5em; vertical-align: top; background-color: rgb('. $bgcolor . '); text-align: center;">
				'.$rs->fields['customers_company'].' '.$rs->fields['short_name'].
				'</td>
                  <td class="nowrap"
 style="margin: 0.1em; padding: 0.1em 0.5em; vertical-align: top; white-space: nowrap; background-color: rgb('. $bgcolor . '); text-align: center;">
 '.$rs->fields['date_purchased'].'</td>
                   <td class="nowrap"
 style="margin: 0.1em; padding: 0.1em 0.5em; vertical-align: top; white-space: nowrap; background-color: rgb('. $bgcolor . '); text-align: center;">
 '.$rs->fields['orders_id'].'</td>
                  <td
 style="background-color: rgb('. $bgcolor . '); text-align: center;">'.$a_recevoir .'</td>
                </tr>';
	
		$rs->MoveNext();
	}
		$supply_html .= '		
              </tbody>
            </table>';	
			
    // dispatch_tml 
    $sql_dispatch = "
			SELECT o.orders_id, products_quantity, orders_products_id, 
			       database_code,treatment_date, left(concat(o.customers_company,' ',o.customers_name),40) client,
				   o.po_status, (treatment_date <  DATE_SUB(CURDATE(),INTERVAL 90 DAY)) no_more_treat
			FROM bo_po.orders_products op, bo_po.orders o
			WHERE products_model = '".$_GET['lamp_code']."'	
			AND o.orders_id = op.orders_id
			AND database_code <> 'po'
			order by treatment_date desc 
			limit 0,25	";
			
	$sales_html = '
	<table>
	<tbody border="0">
                <tr>
                  <td><span
 style="font-weight: bold; text-decoration: underline;">Deni�res
Commandes clients</span></td>
                  <td style="background-color: rgb(153, 255, 153);">en
attente</td>
                  <td style="background-color: rgb(204, 204, 204);">exp�di�es</td>
                </tr>
              </tbody>
            <table id="table_results" class="data"
 style="color: rgb(0, 0, 0); font-family: sans-serif; font-size: 13.3333px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; text-align: left; margin-left: auto; margin-right: auto;">
              <thead></thead><tbody>';
	
	$total_unsent = 0;
	$rs = $db->Execute($sql_dispatch);
//echo $sql_dispatch;exit;
	while(!$rs->EOF)
	{
	
		
		$bgcolor = "229, 229, 229";

		$no_more_treat = $rs->fields['no_more_treat'];
		$check_sent = "select count(1) value  
					  from  rv_lampe_eu.el_product_supply 
					  where sent_date <> '0000-00-00'
					  and  po_orders_products_id = ". $rs->fields['orders_products_id'];

		$nb_sent = exec_select($check_sent);
		

		if (  ( $rs->fields['po_status']=='dispatched' ) || ( ($rs->fields['products_quantity']-$nb_sent)<=0 ) || ( $no_more_treat ) )
		{
			$display_unsent = "";
			$bgcolor = "229, 229, 229";
		}
		else
		{
			$display_unsent = $rs->fields['products_quantity']-$nb_sent;
			$total_unsent += $display_unsent;
			$bgcolor = "153, 255, 153";			
		}		
		
//echo 	$check_sent;exit;	  
		
		$sales_html .='
                <tr class="odd">
                  <td class="nowrap"
 style="margin: 0.1em; padding: 0.1em 0.5em; vertical-align: top; white-space: nowrap; background-color: rgb('.$bgcolor.');"
 align="right">
 '.  $rs->fields['products_quantity'].'
 </td>			
                  <td class="nowrap"
 style="margin: 0.1em; padding: 0.1em 0.5em; vertical-align: top; white-space: nowrap; background-color: rgb('.$bgcolor.');"
 align="left">
 '. $rs->fields['client'] .'
 </td>
 		  <td class="nowrap"
 style="margin: 0.1em; padding: 0.1em 0.5em; vertical-align: top; white-space: nowrap; background-color: rgb('.$bgcolor.');"
 align="right">
 '.  $rs->fields['orders_id'].'|'.  $rs->fields['orders_products_id'].'
 </td>		 

                  <td class="condition"
 style="border: 1px solid; margin: 0.1em; padding: 0.1em 0.5em; vertical-align: top; background-color: rgb('.$bgcolor.');">
 '.  $ext_db_name[$rs->fields['database_code']] .'
 </td>
                  <td class="nowrap"
 style="margin: 0.1em; padding: 0.1em 0.5em; vertical-align: top; white-space: nowrap; background-color: rgb('.$bgcolor.');">
 '.  $rs->fields['treatment_date'].'
 </td>
                  <td
 style="background-color: rgb('.$bgcolor.'); text-align: center;">
'. $display_unsent .'
                  </td>
                </tr>		
';
		$rs->MoveNext();
	}	
	$sales_html .='
             </tbody>
            </table>';
	
    $main_html = str_replace ( 'SUPPLY_HTML', $supply_html, $main_html );
    $main_html = str_replace ( 'SALES_HTML', $sales_html, $main_html );

	$virtual_stock = $current_stock +  $total_a_recevoir  - $total_unsent;
//	echo $virtual_stock ;
    $main_html = str_replace ( 'VIRTUAL_STOCK', $virtual_stock, $main_html );
	
	$dml = "delete from rv_lampe_eu.el_virtual_stock where lamp_code = '". $lamp_code ."'";
	$db->Execute($dml);
		
	$dml = "insert into rv_lampe_eu.el_virtual_stock (lamp_code,virtual_qty)
			values ('". $lamp_code ."',  ". $virtual_stock .")";
	$db->Execute($dml);
	
	
	return $main_html;
}
function today_leading_zeros()
{
   global $db;
   
   $sql = "select date_format(now(),'%c') value";
   $mois = exec_select ( $sql );
   if ($mois<10)
   {
	  $mois = "0".$mois;
   }

   $sql = "select date_format(now(),'%Y') value";
   $annee = exec_select ( $sql );

   $sql = "select date_format(now(),'%d') value";
   $jour = exec_select ( $sql );
   
//   if ($jour<10)
//   {
//
//	  $jour = "0".$jour;
//   }
   return $annee.$mois.$jour;
}
function update_po_status ($tag_id)
{
   global $db;
   global $ext_db_server;
   global $ext_db_username;   
   global $ext_db_server;
   global $ext_db_password;
   global $ext_db_database;
   
   // FV Plus besoin de d�bloquer
   // FV pour d�bloquer... 
   // return 1;
   
    $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  

   $sql = "select orders_products.orders_id value 
		  from el_tag,orders_products
		  where orders_products.orders_products_id=el_tag.po_orders_products_id
		  and id = ". $tag_id;
   
   $po_orders_id = exec_select($sql);
   
//echo    $po_orders_id . '  | '.$sql.'<br>';
   
   $sql = "select count(1) value 
	        from  el_tag
			where po_orders_products_id in ( select  orders_products_id
											from orders_products
											where orders_id = ".$po_orders_id . "
											and products_model <> 'SHF' )
			and  stock_entry_date <> '0000-00-00' ";
			
//echo $sql;
			
	$produits_sortis = exec_select ($sql);

    $sql = "select sum(products_quantity) value 
	        from  bo_po.orders_products 
			where orders_id = ".$po_orders_id . "
			and products_model <> 'SHF'  ";
			
	$produits_total = exec_select ($sql);

    $sql = "select orders_status value 
	        from  bo_po.orders
			where orders_id = ".$po_orders_id ;
			
	$from_status = exec_select ($sql);
	
	
	if  ($produits_total == $produits_sortis)
	{
		if ( $from_status == 15 ) 
			$to_status = 16;
		else if ( $from_status == 17 )
			$to_status = 18;			
		else 
			$to_status = 13;
			
		$dml = "update bo_po.orders set orders_status = ". $to_status . " where orders_id = ".$po_orders_id ;
		$db ->Execute($dml);
	}
	
}


function stock_items_lookup ($po_orders_products_id)
{
   global $db;
/*
   $sql = "select count(1) value 
	        from rv_lampe_eu.el_stock_items, bo_po.el_tag
			where po_orders_products_id = ".$po_orders_products_id . "
			and  el_tag.id =  el_stock_items.id
			and  stocj";
*/
   $sql = "select count(1) value 
	        from  bo_po.el_tag
			where po_orders_products_id = ".$po_orders_products_id . "
			and  stock_entry_date <> '0000-00-00' ";
			
//echo '<td>'.$sql.'</td>';			

	$cnt = exec_select($sql);		
	return $cnt;			
}


function add_field_collissimo($txt)
{
//   return utf8_encode($txt);
  return $txt;
}

function get_flux_collissimo($order_num,$db_code)
{
      global $db;
	  $texte="";
      $requete = "select orders_id, order_total, customers_id,
                         delivery_name,
                  delivery_company, delivery_street_address, delivery_suburb,
                  orders_id,delivery_postcode,delivery_city,
                  delivery_country,customers_telephone,customers_email_address,
                  payment_method, date_format(now(),'%d%m%Y') date_exped,delivery_state";
      $requete .= " from orders ";
      $requete .= " where orders_id = ".$order_num;
     
	  $rs = $db->Execute($requete);
	 
		$texte.= '"'. $rs->fields['orders_id'].'";';                    //orders_id ou ref
		$texte.= '"'. $rs->fields['delivery_name'].'";';                // nom 
		$texte.= '"";';                                                    //prenom inclu dans le nom
		if(!empty($rs->fields['delivery_company'])){
		   $texte.='"'.$rs->fields['delivery_company'].'";';            //adresse1
		   $texte.='"'.$rs->fields['delivery_street_address'].'";';     //adresse2
		   $texte.='"'.$rs->fields['delivery_suburb'].'";';             //adresse3
		}else{
		   $texte.='"'.	$rs->fields['delivery_street_address'].'";';      //adresse1
		   $texte.='"'.	$rs->fields['delivery_suburb'].'";';              //adresse2
		   $texte.='"";';                                                 //adresse3
		}
		$sql =  "select comments value from orders_status_history where comments not like '%@%'  and comments not like '%#%' and comments not like '%paypal%'  and orders_id=". $rs->fields['orders_id'] ;
		$temp = exec_select ( $sql ); 
//echo $temp;exit;		
		$temp = ereg_replace("[^A-Za-z0-9 @&����]", " ", $temp);
		
		$texte.='"'. $temp .'";';                                                  //adresse4	         
		$texte.= '"'. $rs->fields['delivery_postcode'].'";';            //code postale
		$texte.= '"'. $rs->fields['delivery_city'].'";';                //commune
		if(!empty($rs->fields['delivery_country'])){
		 $texte.='"'.get_country_code_common($rs->fields['delivery_country']).'";';  //code pays du destinataire                                    
		}else{
		   $texte.='"ZZ";';
		}
		$texte.= '"1000";';                                               //poids du colis en gramme
// 	$sql = "select comments from orders_status_history where orders_id=".$_SESSION['orders_id']." and comments not like '%#%' and comments not like '%paypal%'";

		
		$texte.= '"'. $rs->fields['customers_telephone'].'";';            // t�l�phone du destinataire du colis
		$texte.='"'.$temp.'"';    //pas de point virgule � la derni�re ligne.    //commentaire sur le colis
		
		$output .= add_field_collissimo($texte);

        $output .='
';
  return $output;
}

  function stock_info ( $chaine_scannee, $i  )
  {
     global $db;
	 global $ext_db_server;
	 global $ext_db_username;
	 global $ext_db_password;
	 global $ext_db_database;
	 global $ext_db_name;
	 
	 $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  
	 if (strlen($chaine_scannee)>3)
	 {
	  $to_fetch = $chaine_scannee;
	  $to_fetch = str_replace("rf " ,"" ,$to_fetch);
	  $to_fetch = str_replace(" si" ,"" ,$to_fetch);

	  $to_fetch = str_replace("RF " ,"" ,$to_fetch);
	  $to_fetch = str_replace(" SI" ,"" ,$to_fetch);
	  
	   $sql = " select lamp_code, in_stock, po_orders_products_id, print_date, consignment_stock
		from   el_tag t
		where  t.id = " . $to_fetch ;
//echo $sql.'<br>';		
		$rs=$db->Execute($sql);
		
		$sql = "select customers_company, date_purchased from orders, orders_products 
				where orders.orders_id = orders_products.orders_id
				and  orders_products_id = " . $rs->fields['po_orders_products_id'] ;
//echo $sql.'<br>';
		$rs2=$db->Execute($sql);
		if ( strlen($rs2->fields['customers_company'])>0 )
		{
			$po_info = '<br> Fournisseur : ' . $rs2->fields['customers_company']. '   Date achat : '. $rs2->fields['date_purchased']; 
		}				
		
		$consignment_stock = $rs->fields['consignment_stock'];
		if ( $consignment_stock )
		   $dsp_consignment_stock = 'CONSIGNMENT STOCK';
		else 
		   $dsp_consignment_stock = '';
		
 		echo '<font size=3>'.$to_fetch.' '.$rs->fields['lamp_code'].' En stock: '.$rs->fields['in_stock'].'  '. $dsp_consignment_stock .'  Date impression:'.$rs->fields['print_date']. $po_info .'</font><br><br>';		
		
		$sql2 = "select orders.database_code, sent_date, orders.orders_id 
				from  rv_lampe_eu.el_product_supply , bo_po.orders_products, bo_po.orders
				where  el_product_supply.stock_item_id =  ". $to_fetch . "
				and    el_product_supply.po_orders_products_id = orders_products.orders_products_id
				and    orders.orders_id = orders_products.orders_id
				order by sent_date desc ";		
		
		$rs2 = $db->Execute($sql2);
		$site_vendeur=$ext_db_name[$rs2->fields['database_code']];
		if (strlen($site_vendeur)>0)
		{
			$sent_date = $rs2->fields['sent_date'];
			echo "<font size=3 color=orange>Produit exp�di� le ".$sent_date. " sur site ".$site_vendeur. " num�ro de commande: ". $rs2->fields['orders_id'].'</font><br><br>';
		}		
				
	 }
		  
//		  echo $to_fetch;exit;
	
  }
  
  function stock_output ( $chaine_scannee, $i, $silent=0, $enforce_marquage_sortie=0 )
  {
// echo $chaine_scannee;exit; 
	// $enforce_marquage_sortie permet de sortir un produit une seconde fois si appel�e depuis le l'�cran de dispatch
     global $db;
	 global $ext_db_server;
	 global $ext_db_username;
	 global $ext_db_password;
	 global $ext_db_database;

	 
	if (strlen($chaine_scannee)>3)
	{
	  $to_fetch = $chaine_scannee;
	  $to_fetch = str_replace("rf " ,"" ,$to_fetch);
	  $to_fetch = str_replace(" si" ,"" ,$to_fetch);
	  
	  $to_fetch = str_replace("RF " ,"" ,$to_fetch);
	  $to_fetch = str_replace(" SI" ,"" ,$to_fetch);

//		$db->connect($ext_db_server["eu"], $ext_db_username["eu"], $ext_db_password["eu"], $ext_db_database["eu"], USE_PCONNECT, false);  
		$sql = "select exit_date, lamp_code, ctr_code, consignment_stock  from rv_lampe_eu.el_stock_items where id= ".$to_fetch;
//echo $sql;exit;		
		$rs=$db->Execute($sql);
		if ($rs->EOF)
		{
			echo '<font color=red>Sortie de stock non trouv�e pour '. $i . ', identifiant : '. $to_fetch .'</font><br>' ; 			
		}
		else
		{
			$exit_date = $rs->fields['exit_date'];			
			$lamp_code = $rs->fields['lamp_code'];			
			$ctr_code = $rs->fields['ctr_code'];		
			$consignment_stock= $rs->fields['consignment_stock'];			
			
			if  ( ($exit_date=="0000-00-00") || ($enforce_marquage_sortie==1) )
			{
			    if ( $_GET['delete']==1 )			
				{
					$dml = "delete from  rv_lampe_eu.el_stock_items where id = ". $to_fetch;								
				}
				else
				{
					$dml = "update rv_lampe_eu.el_stock_items set exit_date = now()  where id = ". $to_fetch;								
				}
				$db->Execute($dml);
				
			    if ( $_GET['delete']==1 )			
				{
					$dml = "delete from  bo_po.el_tag where id = ". $to_fetch;								
					$db->Execute($dml);
				}
								
				$dml = "update rv_lampe_eu.el_stock set qty=qty-1  where ctr_code='". $ctr_code."' and lamp_code='". $lamp_code."'";
				$db->Execute($dml);

				$sql = "select qty
						from rv_lampe_eu.el_stock 
						where  ctr_code = '". $ctr_code . "'
						and    lamp_code  = '". $lamp_code . "'"; 		
				
				$rs2=$db->Execute($sql);
				$new_qty = $rs2->fields["qty"];
				
				
				if ($consignment_stock==1)
				{
					$dml = "update rv_lampe_eu.el_external_stock set qty=qty-1  where ctr_code='". $ctr_code."' and lamp_code='". $lamp_code."'";					
//echo $exit_date;exit;
//9088				
					
					$db->Execute($dml);
				}				
				echo '<font color=green>Sortie de stock OK '. $i . ', identifiant : '. $to_fetch .' LAMPE: '. $lamp_code . '  STOCK: ' . $new_qty  .'</font><br>' ; 							
				
			}
			else
			{
				echo $enforce_marquage_sortie.'<font color=red>Ligne de stock non trouv�e pour '. $ctr_code."' and lamp_code='". $lamp_code . '</font><br>' ; 						   
			}
		}
    }
    else
    {
	   echo '<font color=red>Ligne vide pour '. $i . '</font><br>' ; 
    }	   
  }
  /* fin de la fonction  ----------------------------------------------------------------------------------------------- */
 
  function stock_input ( $chaine_scannee, $i, $silent=0, $second_entry=0 )
  {
     global $db;
	 global $ext_db_server;
	 global $ext_db_username;
	 global $ext_db_password;
	 global $ext_db_database;

	 
		 $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  
		 if (strlen($chaine_scannee)>3)
		 {
		  $to_fetch = $chaine_scannee;
		  $to_fetch = str_replace("rf " ,"" ,$to_fetch);
		  $to_fetch = str_replace(" si" ,"" ,$to_fetch);

		  $to_fetch = str_replace("RF " ,"" ,$to_fetch);
		  $to_fetch = str_replace(" SI" ,"" ,$to_fetch);

		  
//		  echo $to_fetch;exit;
		  
	   $sql = " select lamp_code products_model, in_stock, consignment_stock
	from   el_tag t
	where  t.id = " . $to_fetch ;
	
		 $rs=$db->Execute($sql);
		 
		 $products_model = $rs->fields['products_model'];
		 $in_stock = $rs->fields['in_stock'];
		 $consignment_stock = $rs->fields['consignment_stock'];
		 
//echo $consignment_stock;


		 if ( ( strlen($products_model)> 0) && ($in_stock == 0) )
		 {
			// on va chercher la marque au stock 
			$db->connect($ext_db_server["eu"], $ext_db_username["eu"], $ext_db_password["eu"], $ext_db_database["eu"], USE_PCONNECT, false);  
			$sql = "select ctr_code,  count(1) cnt from el_stock where ctr_code not in ('EIKI','ELMO','NOBO','COMPAQ','ASK','Promethean','BOXLIGHT','ELMO')  and lamp_code = '".$products_model."'  group by ctr_code";
//echo $sql;exit;			
			$rs=$db->Execute($sql);
			$ctr_code = $rs->fields['ctr_code'];
			$cnt = $rs->fields['cnt'];
			if ($cnt>0)
			{
				$stock_exists = 1;
			}
			else
			{
			    // cas bizzare PROMOTHEAN
				$sql = "select ctr_code,  count(1) cnt from el_stock where lamp_code = '".$products_model."'  group by ctr_code";
	//echo $sql;exit;			
				$rs=$db->Execute($sql);
				$ctr_code = $rs->fields['ctr_code'];
				$cnt = $rs->fields['cnt'];
				if ($cnt>0)
				{
					$stock_exists = 1;
				}
				else
				{
					$stock_exists = 0;
				}
			}
//echo $stock_exists;exit;			
			
			if ($cnt>1)
			{
				echo '<font color=red>Plusieurs possibilit�s de stock pour  '. $i . '  / '. $to_fetch . '  / '. $products_model .'</font><br>' ; 
			}
			else
			{
                if ($cnt==0)
				{
					$sql = "select count(distinct ctr_code) cnt 
					from el_price 
					where ctr_code not in ('EIKI','ELMO','NOBO','COMPAQ','ASK','Promethean','BOXLIGHT','ELMO')
					and   lamp_code = '".$products_model."'";
//echo $sql; exit;					
					$rs=$db->Execute($sql);
					
					$cnt = $rs->fields['cnt'];

					$sql = "select  ctr_code
					from el_price where lamp_code = '".$products_model."'";
//echo $sql; exit;					
					$rs=$db->Execute($sql);
					$ctr_code = $rs->fields['ctr_code'];

					
				}
				if ($cnt==0)
				{
					echo '<font color=red>Etiquette:'. $to_fetch .  ': le code produit   '.  $products_model .' n\'est pas reconnu dans le catalogue.</font><br>' ; 
				}
				else if ($cnt>1)
				{
					echo '<font color=red>Etiquette:'. $to_fetch .  ': plusieurs possibilit�s de catalogue  '. $i . '  / '. $products_model .'</font><br>' ; 
				}
				else
				{
/*				
				    if ( $_GET['external_stock']==1  )
					    $consignment_stock = 1;
					else
					    $consignment_stock = 0;
*/					
			$sql = "select 1 cnt
				from el_stock_items
				where id = ".$to_fetch;
//echo $sql;exit;			
					$rs=$db->Execute($sql);
					$cnt = $rs->fields['cnt'];
					if ($cnt==0)
					{
						$dml = " insert into el_stock_items (id, ctr_code, lamp_code, 
															entry_date, consignment_stock )
							   values ( ". $to_fetch .",'".$ctr_code."','".$products_model."', now(), ".  $consignment_stock  . "   )";
						
						 $db->Execute($dml);
					 }
					

//echo 'POST BUG <br>';
					 
					 // la mise � jour du niveau de stock
					 
					 if ( $stock_exists )
					 {
					    $dml = "update el_stock  set qty = qty  + 1 
						where ctr_code = '".$ctr_code . "' 
						and lamp_code = '". $products_model . "'"; 
					 }
					 else
					 {
					    $dml = "insert into  el_stock (qty, ctr_code, lamp_code )
						        values ( 1,  '". $ctr_code . "', '". $products_model . "')"; 					 
					 }
					 $db->Execute($dml);				
					 
					$sql = "select qty
							from el_stock 
							where  ctr_code = '". $ctr_code . "'
							and    lamp_code  = '". $products_model . "'"; 		
					
					$rs2=$db->Execute($sql);
					$new_qty = $rs2->fields["qty"];
					 if ( $consignment_stock ) 
					 {
						$sql = "select ctr_code,  count(1) cnt from el_external_stock where ctr_code not in ('EIKI','ELMO','NOBO','COMPAQ','ASK','Promethean','BOXLIGHT','ELMO')  and lamp_code = '".$products_model."'  group by ctr_code";
						
						$rs=$db->Execute($sql);
						$ctr_code = $rs->fields['ctr_code'];
						$cnt = $rs->fields['cnt'];
						
						if ($cnt>0)
						{
							$stock_exists = 1;
						}
						else
						{
							$stock_exists = 0;
						}
					 
						 if ( $stock_exists )
						 {
							$dml = "update el_external_stock  set qty = qty  + 1 
							where ctr_code = '".$ctr_code . "' 
							and lamp_code = '". $products_model . "'"; 
						 }
						 else
						 {
							$dml = "insert into  el_external_stock (qty, ctr_code, lamp_code )
									values ( 1,  '". $ctr_code . "', '". $products_model . "')"; 					 
						 }						
						 $db->Execute($dml);					 						 
					 }
					//
					 
					 $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  
					
					 $dml = " update el_tag set in_stock = 1, stock_entry_date=now()  where  id = " . $to_fetch;
					 
					 $db->Execute($dml);
					 if ($silent==0)
					 {
						echo '<font color=green>Stock  MAJ avec succ�s pour  '. $to_fetch . "-" . $products_model .' STOCK : ' . $new_qty . $sql  . ' </font><br>' ; 
					 }
				}
			}
			
		 }
		 else if ($in_stock == 1)
		 {
			if ($second_entry)
			{				
				//echo 'se';exit;
				if (  $consignment_stock  ) 
				{
					echo "<font color=red>ATTENTION PAS DE REPRISE  ETIQUETTE  CONSIGNMENT  STOCK ". $to_fetch . "-" . $products_model ." : </font>";
					return 0;
				}
				$db->connect($ext_db_server["eu"], $ext_db_username["eu"], $ext_db_password["eu"], $ext_db_database["eu"], USE_PCONNECT, false);  

				
				$sql = "select ctr_code,  count(1) cnt from el_stock where ctr_code not in ('EIKI','ELMO','NOBO','COMPAQ','ASK','Promethean','BOXLIGHT','ELMO')  and lamp_code = '".$products_model."'  group by ctr_code";
	//echo $sql;exit;			
				$rs=$db->Execute($sql);
				$ctr_code = $rs->fields['ctr_code'];
				$cnt = $rs->fields['cnt'];
				if ($cnt==1)
				{
					$dml = "update el_stock_items set exit_date='',reentry_date=now()
							where  id = ". $to_fetch ; 					 
					$db->Execute($dml);
				
					$dml = "update el_stock set qty=qty+1
							where  ctr_code = '". $ctr_code . "'
							and    lamp_code  = '". $products_model . "'"; 		
							
					$db->Execute($dml);				
					
					$sql = "select qty
							from el_stock 
							where  ctr_code = '". $ctr_code . "'
							and    lamp_code  = '". $products_model . "'"; 		
					
					$rs2=$db->Execute($sql);
					$new_qty = $rs2->fields["qty"];
					
//echo '22222222222'.$new_qty.'2222222222222';					 
					
					echo '<font color=green>Stock  MAJ avec succ�s pour  '. $to_fetch . "-" . $products_model . ' STOCK :'. $new_qty . ' </font><br>' ; 
				}
				else
				{
					echo '<font color=red>Probl�me rentr�e en stock pour  '. $to_fetch . "-" . $products_model .' </font><br>' ; 
				}								
			}			
			else
			{
				echo '<font color=red>Produit d�j� rentr� en stock   pour '. $i . '  / '. $chaine_scannee.'</font><br>' ;
			}
		 }
		 else
		 {
			echo '<font color=red>Num �tiquette non trouv�e  pour '. $i . '  / '. $chaine_scannee.'</font><br>' ; 
		 }
	   }
	   else
	   {
		   echo '<font color=red>Ligne vide pour '. $i . '</font><br>' ; 
	   }	 
	   if ($to_fetch>0)
	   {
		   // FVV 
		   update_po_status ($to_fetch);
	   }
  }
  /* fin de la fonction  ----------------------------------------------------------------------------------------------- */

function get_english_lamp_label($description2,$prdref)
{
        $vp_ok = 0;
		$separator = ' for ';
		$pos_pour = strpos($description2,$separator);
		if ($pos_pour>0)
		{
			$description2 = substr($description2,$pos_pour+strlen($separator),10000);
			$vp_ok = 1;			
		}
		
		$separator = ' pour ';
		$pos_pour = strpos($description2,$separator);
		if ($pos_pour>0)
		{
			$description2 = substr($description2,$pos_pour+strlen($separator),10000);
			$vp_ok = 1;			
		}

		$separator = ' f�r ';
		$pos_pour = strpos($description2,$separator);
		if ($pos_pour>0)
		{
			$description2 = substr($description2,$pos_pour+strlen($separator),10000);
			$vp_ok = 1;						
		}

		$separator = ' para ';
		$pos_pour = strpos($description2,$separator);
		if ($pos_pour>0)
		{
			$description2 = substr($description2,$pos_pour+strlen($separator),10000);
			$vp_ok = 1;						
		}


		$separator = ' per ';
		$pos_pour = strpos($description2,$separator);
		if ($pos_pour>0)
		{
			$description2 = substr($description2,$pos_pour+strlen($separator),10000);
			$vp_ok = 1;						
		}


		if ( $vp_ok )
		{
			$description2 = str_replace('.','',$description2);  
			$description2 = str_replace(',','',$description2);  
			$description2 = str_replace(':','',$description2);  
            $words=explode(" ",$description2);
			if (count($words)>2)
			{
				$description2 = $prdref . ' projector lamp.';  
			}
			else
			{
				$description2 = 'Lamp for '. strtoupper($description2) . ' projector.';  
			}
		}
		else
		{
			$description2 = 'Original projector lamp:  '. $prdref;  
		}
		
        return 	$description2;
}
function get_country_code_common($country)
{
    global $db;
    if (substr($country,0,6) == "France" )
   	$resultat = 'FR';
    else if ( $country == "Deutschland" )
   	$resultat = 'DE';
    else if ( $country == "Germany" )
   	$resultat = 'DE';	
    else if ( $country == "�sterreich" )
   	$resultat = 'AT';
    else if ( $country == "Austria" )
   	$resultat = 'AT';
    else if ( $country == "Schweiz" )
   	$resultat = 'CH';
    else if ( $country == "Switzerland" )
   	$resultat = 'CH';	
    else if ( $country == "Suisse" )
   	$resultat = 'CH';              			
    else if ( $country == "Belgique" )
   	$resultat = 'BE';    
    else if ( $country == "Belgium" )
   	$resultat = 'BE';   	
    else if ( $country == "Polska" )
   	$resultat = 'PL';   		
    else if ( $country == "UK - JERSEY" )
   	$resultat = 'JE';    							
    else if ( substr($country,0,2) =='UK' )
   	$resultat = 'GB';    						
    else if ( $country == "Luxembourg" )
   	$resultat = 'LU';    												
    else if ( $country == "Italia" )
   	$resultat = 'IT';  
    else if ( $country == "Italy" )
   	$resultat = 'IT';    			
    else if ( strpos(strtoupper($country),"CANARIAS")>0)
   	$resultat = 'IC';    		
    else if ( substr($country,0,4) =='Spai' )
      $resultat = 'ES';   	
    else if ( substr($country,0,4) =='Espa' )
      $resultat = 'ES';                   			          			
    else
	{
//	   $sql = "select 
//	   $rs = 
       $sql = "select countries_iso_code_2 value from countries where  countries_name='".$country."'";
       $resultat=exec_select($sql);                   			          			
	}	   
	return $resultat;	   
}
function get_code_produit($codepays)
{
// echo $codepays;
      if ($codepays=="FR")
		   $code_produit = "N";		   
		else if (strpos(" 'DE', 'AT','BE','GB', 'LU','IT','BS' , 'ES', 'IE','LU','DK','FI','NL','SE','PT','LT','PL','RO','GR','HU','CY','MT','LV','BG','EE','CZ','SK','SI'  " , $codepays ) > 0 )
		   $code_produit = "U";
		else 
		     $code_produit = "S";
			 
//echo $codepays.'|'.$code_produit.'br';

    return $code_produit;			 
}

Function removeaccents_common($string){ 
   $string= strtr($string,  "�����������������������������������������������������$&",
                  "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn  "); 
   $string= str_replace('�','ss',$string);
   $string = iconv("ISO-8859-1","UTF-8",$string);
   return $string; 
   } 
function add_field_common($pvalue)
{
  $value = str_replace(';',' ',$pvalue);
  $value = str_replace(',',' ',$value);
  $value = str_replace(',',' ',$value);
  return $value.';';
} 
function get_flux_dhl($order_num,$db_code)
{
      global $db;
      $requete = "select orders_id, order_total, order_tax, customers_id,
                         delivery_name,
                  delivery_company, delivery_street_address, delivery_suburb,
                  orders_id,delivery_postcode,delivery_city,
                  delivery_country,customers_telephone,customers_email_address,
                  payment_method, date_format(now(),'%d%m%Y') date_exped,delivery_state,database_code";
      $requete .= " from orders ";
      $requete .= " where orders_id = ".$order_num;

	  $rs = $db->Execute($requete);
	 
	  $customers_id  = $rs->fields['customers_id'];
	  $database_code = $rs->fields['database_code'];
      $output .= add_field_common($rs->fields['orders_id']);
      $output .= add_field_common("");   // Num�ro de r�c�piss� 26 8 2      
      $output .= add_field_common($rs->fields['date_exped']); //Date exp�dition 34 8 3 Format : JJMMAAAA. Par d�faut date du jour
      $output .= add_field_common($rs->fields['customers_id']);

      if ( strlen ( $rs->fields['delivery_company'] ) < 2  )
  			$output .= add_field_common("Individual");
      else
  			$output .=  add_field_common($rs->fields['delivery_company']);


      $output .= add_field_common($rs->fields['delivery_street_address']);

      $output .= add_field_common($rs->fields['delivery_suburb']);

  		$output .= add_field_common('');

      $output .= add_field_common($rs->fields['delivery_postcode']);      
      
      $output .= add_field_common($rs->fields['delivery_city']);


      $country=$rs->fields['delivery_country'];           
	  
      $codepays = get_country_code_common($country);
      $output .= add_field_common($codepays);
	  $contact_name = $rs->fields['delivery_name'];
//	  $output .= add_field_common(strlen($contact_name));
	  
      if (strlen($contact_name)>2)
	  {
        $output .= add_field_common($contact_name);
	  }
	  else
	  {
	        if ( strlen ( $rs->fields['delivery_company'] ) < 2  )
			{
	  			$output .= add_field_common("Individual");
			}
	        else
			{
	  			$output .=  add_field_common($rs->fields['delivery_company']);
			}
	  }
      $output .= add_field_common($rs->fields['customers_email_address']);
      if ( strlen ( $rs->fields['customers_telephone']>0 ) )
		$output .= add_field_common($rs->fields['customers_telephone']);
	  else
		$output .= add_field_common("01 01 01 01");
  

	//  pa?a - Baleares, Gibraltar, Ceuta 	LK
	//  Espa?a - Baleares 	BR
			 
		$code_produit = get_code_produit($codepays);

		//else if ( strpos(  " 'CH' ", $codepays )>0)
		//   $code_produit = "S";					   
			 
		   
		 // ,'IS'  ,'NO'
		 
      $temp = exec_select ( "select comments value from orders_status_history where comments not like '%@%'  and comments not like '%#%' and comments not like '%paypal%' and orders_id=". $rs->fields['orders_id'] ); 
      $temp = ereg_replace("[^A-Za-z0-9 @&����]", " ", $temp);
	  
      $temp = str_replace(chr(13), ' ', $temp);
      $output .= add_field_common($temp);
		$output .= add_field_common(""); // remarque
		$output .= add_field_common("1"); // nb colis
		$output .= add_field_common("0"); // nb  palette
		$output .= add_field_common("0"); // nb  palette consign�es					
		$output .= add_field_common("1"); // 1 kg
		$output .= add_field_common(""); //  volume
		$output .= add_field_common(""); // longueur
		$output .= add_field_common(""); // largeur 
		$output .= add_field_common(""); // hauteur
		$output .= add_field_common(""); // date demand�e
		$output .= add_field_common(""); // montant contre remb
		$output .= add_field_common(""); // devise contre rem
	//	$output .= add_field_common($rs->fields["order_total"]*100); // valeur 
		$output .= add_field_common(""); // valeur 
		
	//	$output .= add_field_common('EUR'); // devise valeur 
		$output .= add_field_common(""); // valeur 	
				
		if ($code_produit=='S')
		{
			$sql2 = "select sum(products_quantity*final_price) value
					from orders_products
					where products_model<>'SHF' and  orders_id = ". $rs->fields['orders_id'];
			$valeur = round(exec_select($sql2));
					
			$output .= add_field_common($valeur); // valeur d�clar�e

			$output .= add_field_common("EUR"); // devise valeur d�clar�e
		}
		else
		{
			$output .= add_field_common(""); // valeur d�clar�e
			$output .= add_field_common(""); // devise valeur d�clar�e
		}		
		$output .= add_field_common("Electronic material"); // Nature marchandise
		$output .= add_field_common("P"); // Port pay�
//  	    $output .= add_field_common('---'.$code_produit.'----'.$codepays.'----'); //  Incoterm		
		if ($code_produit=='S')
		{
			$output .= add_field_common("DDU"); //  Incoterm
		}
		else
		{
			$output .= add_field_common(""); //  Incoterm
		}
		
		$output .= add_field_common(""); // mauvais
		$output .= add_field_common(""); // Unit� taxable 
		$output .= add_field_common(""); // code pr�parateur
		$output .= add_field_common(""); // matieres dangereuses
		$output .= add_field_common(""); // code transporteur

		
//$output .= "merdum";

	    $output .= add_field_common($code_produit); // code produit
//return($db_code);
//return 'vvvvvvvvvvvvvvv|||'.$customers_id.'|||llllvvvv|||'.$database_code.'|||lllllll';		 			


		
		if ($database_code=="fr")
		 {
			$output .= add_field_common("LVP");       			         							 
		 }
		 else if ($database_code=="de")
		 {							
			$output .= add_field_common("APL");       			         							 							 
		 }								
		 else if ($database_code=="en")
		 {							
			$output .= add_field_common("JPL");       			         							 							  							 
		 }																
		 else if ($database_code=="it")
		 {							 							 							 
			$output .= add_field_common("LPI");       			         							 							  							 							 
		 }																								
		 else if ($database_code=="es")
		 {							 							 							 							 
			$output .= add_field_common("LPP");       			         							 							 
		 }																																
		 else if ($database_code=="eu" )
		 {					
			if ( $customers_id == 88299 )
			{
				$output .= add_field_common("AMC");       			         							 							 							 
			}
			else if ( $customers_id == 86036 )
			{
				$output .= add_field_common("Digital");       			         							 							 							 				
			}	
			else if ( $customers_id == 83552 )
			{
				$output .= add_field_common("OPENAV");       			         							 							 							 								
			}
			else
			{
				$output .= add_field_common("EL");       			         							 							 							 
			}
		 }																															

		$output .= add_field_common(""); // service point			
		$output .= add_field_common(""); // code service point				
		$output .= add_field_common(""); // code service point				

		$output .= add_field_common($rs->fields["delivery_state"]); // r�gion 
  
        $output .='
';
  return $output;
}
function get_flux_gls_p($order_num,$db_code)
{
      global $db;
      $requete = "select orders_id, order_total, customers_id,
                         delivery_name,
                  delivery_company, delivery_street_address, delivery_suburb,
                  orders_id,delivery_postcode,delivery_city,
                  delivery_country,customers_telephone,customers_email_address,
                  payment_method, date_format(now(),'%d%m%Y') date_exped,delivery_state";
      $requete .= " from orders ";
      $requete .= " where orders_id = ".$order_num;

	  $rs = $db->Execute($requete);
	 
	  
      $output .= add_field_common($rs->fields['orders_id']);
      $output .= add_field_common("");   // Num�ro de r�c�piss� 26 8 2      
      $output .= add_field_common($rs->fields['date_exped']); //Date exp�dition 34 8 3 Format : JJMMAAAA. Par d�faut date du jour
      $output .= add_field_common($rs->fields['customers_id']);

      if ( strlen ( $rs->fields['delivery_company'] ) < 2  )
  			$output .= add_field_common($rs->fields['delivery_name']);
      else
  			$output .=  add_field_common($rs->fields['delivery_company']);


      $output .= add_field_common($rs->fields['delivery_street_address']);

      $output .= add_field_common($rs->fields['delivery_suburb']);

  		$output .= add_field_common('');

      $output .= add_field_common($rs->fields['delivery_postcode']);      
      
      $output .= add_field_common($rs->fields['delivery_city']);


      $country=$rs->fields['delivery_country'];           
	  
      $codepays = get_country_code_common($country);
      $output .= add_field_common($codepays);
	  $contact_name = $rs->fields['delivery_name'];
//	  $output .= add_field_common(strlen($contact_name));
	  
      if (strlen($contact_name)>2)
	  {
        $output .= add_field_common($contact_name);
	  }
	  else
	  {
	        if ( strlen ( $rs->fields['delivery_company'] ) < 2  )
	  			$output .= add_field_common("Individual");
	        else
	  			$output .=  add_field_common($rs->fields['delivery_company']);
	  }
      $output .= add_field_common($rs->fields['customers_email_address']);
  
      $output .= add_field_common($rs->fields['customers_telephone']);
  

	//  pa?a - Baleares, Gibraltar, Ceuta 	LK
	//  Espa?a - Baleares 	BR
      if ($codepays=="FR")
		   $code_produit = "N";		   
		else if (strpos(" 'DE', 'AT','BE','GB', 'LX','IT', 'ES', 'IE','IS','LU','NO','DK','FI','NL','SE','PT','LT','PL','RO'  " , $codepays ) > 0 )
		   $code_produit = "U";
		else if ( strpos(  " 'CH' ", $codepays )>0)
		   $code_produit = "S";					   
		else 
		   $code_produit = "";
		   
      $temp = exec_select ( "select comments from orders_status_history where  comments not like '%@%' and orders_id=". $rs->fields['orders_id'] ); 
      $temp = ereg_replace("[^A-Za-z0-9 @&����]", " ", $temp);
	  
      $temp = str_replace(chr(13), ' ', $temp);
      $output .= add_field_common($temp);
		$output .= add_field_common(""); // remarque
		$output .= add_field_common("1"); // nb colis
		$output .= add_field_common("0"); // nb  palette
		$output .= add_field_common("0"); // nb  palette consign�es					
		$output .= add_field_common("1"); // 1 kg
		$output .= add_field_common(""); //  volume
		$output .= add_field_common(""); // longueur
		$output .= add_field_common(""); // largeur 
		$output .= add_field_common(""); // hauteur
		$output .= add_field_common(""); // date demand�e
		$output .= add_field_common(""); // montant contre remb
		$output .= add_field_common(""); // devise contre rem
	//	$output .= add_field_common($rs->fields["order_total"]*100); // valeur 
		$output .= add_field_common(""); // valeur 
		
	//	$output .= add_field_common('EUR'); // devise valeur 
		$output .= add_field_common(""); // valeur 	
		
		if ($codepays=='CH')
		{
			$output .= add_field_common($rs->fields["order_total"]-25); // valeur d�clar�e
			$output .= add_field_common("EUR"); // devise valeur d�clar�e
		}
		else
		{
			$output .= add_field_common(""); // valeur d�clar�e
			$output .= add_field_common(""); // devise valeur d�clar�e
		}		
		$output .= add_field_common("Electronic material"); // Nature marchandise
		$output .= add_field_common("P"); // Port pay�
//  	    $output .= add_field_common('---'.$code_produit.'----'.$codepays.'----'); //  Incoterm		
		if ($codepays == "CH")
		{
			$output .= add_field_common("DDU"); //  Incoterm
		}
		else
		{
			$output .= add_field_common(""); //  Incoterm
		}
		
		$output .= add_field_common(""); // mauvais
		$output .= add_field_common(""); // Unit� taxable 
		$output .= add_field_common(""); // code pr�parateur
		$output .= add_field_common(""); // matieres dangereuses
		$output .= add_field_common(""); // code transporteur

		
//$output .= "merdum";

	    $output .= add_field_common($code_produit); // code produit
//return($db_code);
		
		if ($db_code=="fr")
		 {
			$output .= add_field_common("LVP");       			         							 
		 }
		 else if ($db_code=="de")
		 {							
			$output .= add_field_common("APL");       			         							 							 
		 }								
		 else if ($db_code=="en")
		 {							
			$output .= add_field_common("JPL");       			         							 							  							 
		 }																
		 else if ($db_code=="it")
		 {							 							 							 
			$output .= add_field_common("LPI");       			         							 							  							 							 
		 }																								
		 else if ($db_code=="es")
		 {							 							 							 							 
			$output .= add_field_common("LPP");       			         							 							 
		 }																																
		 else if ($db_code=="eu" )
		 {							
			$output .= add_field_common("EL");       			         							 							 							 
		 }																															

		$output .= add_field_common(""); // service point			
		$output .= add_field_common(""); // code service point				
		$output .= add_field_common(""); // code service point				

		$output .= add_field_common($rs->fields["delivery_state"]); // r�gion 

		// 2014 rajout de 2 colonnes 
		/*
		01 - national    
		  code produit 2 Business Parcel
		  code produit 16 Express Parcel
		  code produit 17 Point Relais
		02 - europe
		  code produit 1 Business Parcel
		*/
		$output .= add_field_common("2503882301"); // code exploit 01 - national    02 
		$output .= add_field_common("2"); // r�gion 
		
		
        $output .='
';
  return $output;
}  
function get_flux_gls($order_num,$db_code)
{
      global $db;
      $requete = "select orders_id, order_total, customers_id,
                         delivery_name,
						 delivery_company, 
						 delivery_street_address, delivery_suburb,
                  orders_id,delivery_postcode,delivery_city,
                  delivery_country,customers_telephone,customers_email_address,
                  payment_method, date_format(now(),'%d%m%Y') date_exped,delivery_state";
      $requete .= " from orders ";
      $requete .= " where orders_id = ".$order_num;

	  $rs = $db->Execute($requete);
	 

      $output .= add_field_common("19927838");
      $output .= add_field_common("BP");
      $output .= add_field_common("");	  // Num�ro de colis , si vide incr�ment	
      $output .= add_field_common("1");    // Poids
      $output .= add_field_common("1");    // Nb de colis
      $output .= add_field_common($rs->fields['orders_id']);    // R�f destinataire

      if (strlen($rs->fields['delivery_company'])>0)
	  {
		$output .= add_field_common($rs->fields['delivery_company']);	      	  
	  }
	  else
	  {
		$output .= add_field_common($rs->fields['delivery_name']);	      	  
	  }
	  
	  
      $output .= add_field_common($rs->fields['delivery_street_address']);

      $output .= add_field_common($rs->fields['delivery_suburb']);

	  $output .= add_field_common('');

	  
      $output .= add_field_common($rs->fields['delivery_postcode']);      
      
      $output .= add_field_common($rs->fields['delivery_city']);

      $country=$rs->fields['delivery_country'];           
      $codepays = get_country_code_common($country);
      $output .= add_field_common($codepays);

	  
      $output .= add_field_common("ref1");
      $output .= add_field_common("ref2");
	  $sql = "select comments value from orders_status_history where comments not like '%@%' and orders_id=".$rs->fields['orders_id'];
      $temp = exec_select ( $sql );      				  
      $temp = ereg_replace("[^A-Za-z0-9 @&����]", " ", $temp);
      $temp = str_replace(chr(13), ' ', $temp);      		            
      $temp = removeaccents_common($temp);
      if (strlen($temp)==0)
      {
	     $temp = "-";
      }
	  $output .= add_field_common($rs->fields['delivery_name']);
	  
	  $output .= add_field_common($rs->fields['customers_telephone']);


	  $output .= add_field_common("Easylamps");
	  $output .= add_field_common("93100");
	  $output .= add_field_common("MONTREUIL");
	  $output .= add_field_common("FR");
	  
        $output .='
';
  return $output;
} 
function get_xml_ups($order_num,$db_code)
{
	  global $db;
	  global $ext_db_database;
	  
      $requete = "select orders_id, order_total , 
                         delivery_name,
                  delivery_company, delivery_street_address, delivery_suburb,
                  orders_id,delivery_postcode,delivery_city,
                  delivery_country,customers_telephone,customers_email_address,
                  payment_method,payment_module_code,shipping_module_code,database_code, currency";
      $requete .= " from orders ";
      $requete .= " where orders_id = ".$order_num;

	  $rs = $db->Execute($requete);
	  
	  
	  $shipping_module_code = $rs->fields['shipping_module_code'];
	  $database_code = $rs->fields['database_code'];
	
      $sql = "select comments value from orders_status_history where comments not like '%@%'  and comments not like '%#%' and comments not like '%paypal%' and orders_id=".$rs->fields['orders_id'];
      $temp = exec_select ( $sql );      			
	  
      $temp = ereg_replace("[^A-Za-z0-9 @&����]", " ", $temp);
      $temp = str_replace(chr(13), ' ', $temp);      		            
      $temp = removeaccents_common($temp);
	  
	  $comment = $temp;
// ShipFrom       
      $country=$rs->fields['delivery_country'];           
       			         
     	 if ($database_code=="fr")
		 {
             $tel_sender = "01 71 86 46 66";       			         							 
             $name_sender =   "Lampevideoprojecteur.fr";
		 }
     	 else if ($database_code=="de")
		 {							
             $tel_sender = "0212 958 430 01";       			         							 							 
             $name_sender = "Alleprojektorlampen";
		 }								
     	 else if ($database_code=="en")
		 {							
             $tel_sender = "0800 158 4425";       			         							 							  							 
             $name_sender = "JustProjectorLamps";								
		 }																
     	 else if ($database_code=="it")
		 {							 							 							 
             $tel_sender = "01 71 86 46 54";       			         							 							  							 							 
             $name_sender =  "LampadeProiettori";							                    	    
		 }																								
     	 else if ($database_code=="es")
		 {							 							 							 							 
             $tel_sender = "902 636 842";       			         							 							 
             $name_sender =  "Lamparasparaproyectores";
		 }																																
     	 else if ($database_code=="eu" )
		 {							
             $tel_sender = "01 71 86 46 61";       			         							 							 							 
             $name_sender =  "Easylamps";
		 }																																
     	 else if ($database_code=="hp" )
		 {							
             $tel_sender = "01 78 14 03 81";       			         							 							 							 
             $name_sender =  "HPL";
		 }																																
     	 else if ($database_code=="rq" )
		 {							
             $tel_sender = "01 78 14 03 81";       			         							 							 							 
             $name_sender =  "HPL";
		 }																																
     	 else if ($database_code=="pl" )
		 {							
             $tel_sender = "01 78 14 03 81";       			         							 							 							 
             $name_sender =  "LVP";
		 }																																
     	 else if ($database_code=="tb" )
		 {							
             $tel_sender = "01 76 70 02 16";       			         							 							 							 
             $name_sender =  "TBI Direct";
		 }																																

       $payment_method = $rs->fields["payment_method"];
	   $payment_module_code = $rs->fields["payment_module_code"];
	   // currency
         if ( ( $payment_module_code == "cod" ) || ( $payment_module_code == 'COD' )  )
         {
		   if ( $rs->fields["currency"]=="EUR" )
		   {
	   $cod_output = '<COD>				  
<Amount>'. $rs->fields["order_total"] .'</Amount>					
<Currency>EUR</Currency>					
</COD>';	
			}
			else
			{
				$rate = exec_select ( "select  value from ". $ext_db_database[$database_code] .".currencies where code = '". $rs->fields["currency"]."'" );
				$amount = round ( $rs->fields["order_total"] * $rate,2);
	   $cod_output = '<COD>				  
<Amount>'. $amount .'</Amount>					
<Currency>'. $rs->fields["currency"] .'</Currency>					
</COD>';	
			}
         }
    $addr1 = removeaccents_common($rs->fields['delivery_street_address']);
    $addr2 = removeaccents_common($rs->fields['delivery_suburb']);
	if (strlen($comment)>34)
	{
		$strt=34-strlen($addr2)-4;
		$addr2 .= ' '. substr($comment,0,34-strlen($addr2)-2);
		$addr3 = substr($comment,$strt,40);
	}
	else
	{
		$addr3 = $comment;	
	}
	
	if (strlen($rs->fields['delivery_company'])<3)
	{
	   $company = removeaccents_common($rs->fields['delivery_name']);	   	
	}
	else
	{
	   $company = removeaccents_common( $rs->fields['delivery_company'] );	
	}
	// contact 
	$contact = $rs->fields['delivery_name'];	
	if (strlen($contact)==0)
	{
		$contact = ".";		
	}
	// email 
	$email = $rs->fields['customers_email_address'];
	$email = str_replace(' ','',$email);
    
	
	if (strlen($email)==0)
	{
		$email = "noemail@linats.net";		
	}
	$place_arob = strpos(" ".$email,"@" );
	if ( ! $place_arob )
	{
		$email = "noemail@linats.net";				
	}
	if ( ! strpos(" ".$email,".",$place_arob ) )
	{
		$email = "noemail@linats.net";				
	}
// septembre 2013, changement de compte  UPS de 2A9663 pour AV2024	
	
	
//  $service_level f�v 2O14, le service level est alternativement express saver SV
//  juillet 2014
// zone 1
//,27,28,45,60,75,76,77,78,91,92,93,94,95,
     $dept = substr($rs->fields['delivery_postcode'], 0,2);
/*	 
echo 'dept'.$dept.'<br>';
echo 'pos';	 
echo ;exit;
*/
     if ( 
			( $shipping_module_code=='flat' ) && ( $database_code == "fr" ) 
		)
	{
		$service_level = 'SV';
	}
    else if ( 
			( strpos(',27,28,45,60,75,76,77,78,91,92,93,94,95,',$dept.',')==0 ) && ( $database_code == "eu" ) 
		)
	{
		$service_level = 'SV';
	}	
	else
	{
		$service_level = 'ST';
	}
//echo 'shipping_module_code'. $shipping_module_code . ' db_code  '.$db_code;

	
    $output_xml .='	  
<OpenShipment ShipmentOption="" ProcessStatus="">
<Receiver>
	<CompanyName>'.$company.'</CompanyName>
	<ContactPerson>'.removeaccents_common($contact).'</ContactPerson>
	<AddressLine1>'.$addr1.'</AddressLine1>
	<AddressLine2>'.$addr2.'</AddressLine2>
	<AddressLine3>'.$addr3.'</AddressLine3>
	<City>'.removeaccents_common($rs->fields['delivery_city']).'</City>
	<CountryCode>'.get_country_code_common($country).'</CountryCode>
	<PostalCode>'.$rs->fields['delivery_postcode'].'</PostalCode>
	<Phone>'.$rs->fields['customers_telephone'].'</Phone>
	<EmailAddress1>'.removeaccents_common($email).'</EmailAddress1>
</Receiver>
<Shipper>
	<UpsAccountNumber>AV2024</UpsAccountNumber>
</Shipper>
<Shipment>
	<ServiceLevel>'.$service_level.'</ServiceLevel>
	<PackageType>CP</PackageType>
	<NumberOfPackages>1</NumberOfPackages>
	<ShipmentActualWeight>1</ShipmentActualWeight>
	<DescriptionOfGoods>Projector lamp</DescriptionOfGoods>
	<Reference1>'.$rs->fields['orders_id'].'</Reference1>
	<Reference2></Reference2>
	<BillingOption>PP</BillingOption>
	<QuantumViewNotifyDetails>
		<QuantumViewNotify>
			<NotificationEMailAddress>poubelle@linats.net</NotificationEMailAddress>
			<NotificationRequest>5</NotificationRequest>
		</QuantumViewNotify>
		<FailureNotificationEMailAddress>ups@linats.net</FailureNotificationEMailAddress>
		<ShipperCompanyName>'.$name_sender.'</ShipperCompanyName>
		<SubjectLineOptions>SubjectLineOptions</SubjectLineOptions>
		<NotificationMessage>NotificationMessage</NotificationMessage>
	</QuantumViewNotifyDetails>
	'. $cod_output   .'
</Shipment>

</OpenShipment>';

// FVV pour satisfaire les exigences de AMAZON et envois de mail par Easylamps..

/*
	<QuantumViewNotifyDetails>
		<QuantumViewNotify>
			<NotificationEMailAddress>ups@linats.net</NotificationEMailAddress>
			<NotificationRequest>5</NotificationRequest>
		</QuantumViewNotify>
		<FailureNotificationEMailAddress>ups@linats.net</FailureNotificationEMailAddress>
		<ShipperCompanyName>'.$name_sender.'</ShipperCompanyName>
		<SubjectLineOptions>SubjectLineOptions</SubjectLineOptions>
		<NotificationMessage>NotificationMessage</NotificationMessage>
	</QuantumViewNotifyDetails>
*/

		return $output_xml;
}
function delete_order ( $p_old_order_id )
{
   global $db;
   
   global $ext_db_server;
   global $ext_db_username;   
   global $ext_db_password;
   global $ext_db_database;
   
   
   $sql =  "select database_code value from orders where orders_id = ".  $p_old_order_id;
   $sourcedb = exec_select ( $sql );
   
//  
   
   $db->Execute("delete from orders_status_history where orders_id = " . $p_old_order_id );
   $db->Execute("delete from orders_total where orders_id = " . $p_old_order_id );
   $db->Execute("delete from orders_products where orders_id = " . $p_old_order_id );
   $db->Execute("delete from orders where orders_id = " . $p_old_order_id );
   $dml = "update orders_invoices set ref_orders_id=null where ref_orders_id = " . $p_old_order_id ;
   $db->Execute($dml);   
 //  echo $dml;exit;
   // suppresion dans la source

   if ( $sourcedb != "gl" )
   {
	   $db->connect($ext_db_server[$sourcedb], $ext_db_username[$sourcedb], $ext_db_password[$sourcedb], $ext_db_database[$sourcedb], USE_PCONNECT, false);
	   $db->Execute("delete from orders_invoices where orders_id = " . $p_old_order_id );   
   }   
   
}
function clonage_order ( $p_old_order_id, $p_old_db, $p_new_db, $p_customer_database_code , $p_new_customers_id, $p_new_languages_id, $p_new_status )
{
   global $db;
   global $currency;
   global $ext_db_server;
   global $ext_db_username;
   global $ext_db_password;
   global $ext_db_database;
   
    // recherche du nouvel ID	
	if  (  ($p_new_db!="po") || ( $p_old_order_id < 0 ) )
	{
	    $db->connect($ext_db_server[$p_new_db], $ext_db_username[$p_new_db], $ext_db_password[$p_new_db], $ext_db_database[$p_new_db], USE_PCONNECT, false);
	    $maxQry = $db->Execute('select max(orders_id)+1 new_oid from orders') ; 
	    $oID = $maxQry->fields['new_oid']; 		  
	}
	else
	{
	    $oID = $p_old_order_id;
	}

    // recup�ration des informsations � lire
//echo 'podb'.$p_old_db;exit;	   	
    $db->connect($ext_db_server[$p_old_db], $ext_db_username[$p_old_db], $ext_db_password[$p_old_db], $ext_db_database[$p_old_db], USE_PCONNECT, false);
   
	// Duplicate order details from "orders" table
	$old_order = $db->Execute("SELECT * FROM " . TABLE_ORDERS. " WHERE orders_id = " . $p_old_order_id );

	  if ( $p_new_db=="po" ) 
	  {
	     $currency_value = $old_order->fields['currency_value'];
		 if ( ( $p_old_order_id < 0 ) 
		      && ( $old_order->fields['currency'] != 'EUR') )
		 {
			$db->connect($ext_db_server[$p_new_db], $ext_db_username[$p_new_db], $ext_db_password[$p_new_db], $ext_db_database[$p_new_db], USE_PCONNECT, false);		 
			$sql =  "select value from currencies where code='".$old_order->fields['currency']."'";
			$recordSet = $db->Execute($sql);
			$currency_value = $recordSet->fields['value'];
			$db->connect($ext_db_server[$p_old_db], $ext_db_username[$p_old_db], $ext_db_password[$p_old_db], $ext_db_database[$p_old_db], USE_PCONNECT, false);			
		 }
	  }
	  else if ( $old_order->fields['currency'] != 'EUR' )	 
	  {  	     
         $db->connect($ext_db_server[$old_order->fields['database_code']], $ext_db_username[$old_order->fields['database_code']], $ext_db_password[$old_order->fields['database_code']], $ext_db_database[$old_order->fields['database_code']], USE_PCONNECT, false);
		 $sql =  "select value from currencies where code='".$old_order->fields['currency']."'";
		 $recordSet = $db->Execute($sql);
		 $currency_value = $recordSet->fields['value'];
		 $db->connect($ext_db_server[$p_old_db], $ext_db_username[$p_old_db], $ext_db_password[$p_old_db], $ext_db_database[$p_old_db], USE_PCONNECT, false);
	  }
	  else
	  {
		 $currency_value = 1;
	  }
       if ( $p_new_customers_id != 0 )
       {	    
        $db->connect($ext_db_server[$p_customer_database_code], $ext_db_username[$p_customer_database_code], $ext_db_password[$p_customer_database_code], $ext_db_database[$p_customer_database_code], USE_PCONNECT, false);	
   		$sql = "select entry_company ,
   					 entry_tva_intracom,
   					 entry_street_address,
   					 entry_suburb,
   					 entry_postcode,
   					 entry_city,
   					 entry_state,
   					 countries_name,					 
   					 customers_firstname,
   					 customers_lastname,
   					 customers_email_address,
   					 customers_telephone,
					 entry_country_id
                     from address_book ab, customers c, countries
                     where ab.customers_id = ". $p_new_customers_id . "
                      and   ab.customers_id = c.customers_id
                      and   c.customers_default_address_id =  ab.address_book_id 
   				   and   entry_country_id = countries_id";
   				   
           $sqlCustomer = $db->Execute($sql);
   		
   		$entry_company = $sqlCustomer->fields['entry_company'];
   		$entry_tva_intracom = $sqlCustomer->fields['entry_tva_intracom'];
   		$entry_street_address = $sqlCustomer->fields['entry_street_address'];
   		$entry_suburb = $sqlCustomer->fields['entry_suburb'];
   		$entry_postcode = $sqlCustomer->fields['entry_postcode'];
   		$entry_city = $sqlCustomer->fields['entry_city'];
   		$entry_state = $sqlCustomer->fields['entry_state'];
   		$entry_country = $sqlCustomer->fields['countries_name'];
   
   		$customers_firstname = $sqlCustomer->fields['customers_firstname'];
   		$customers_lastname = $sqlCustomer->fields['customers_lastname'];
   		$customers_email_address = $sqlCustomer->fields['customers_email_address'];
   		$customers_telephone = $sqlCustomer->fields['customers_telephone'];
		$customers_countries_id = $sqlCustomer->fields['entry_country_id'];

         // affectation des addresses pour les groupes de champ
        $customers_name = $customers_firstname . ' ' . $customers_lastname;
        $entry_tva_intracom =  $entry_tva_intracom;							 
        $customers_company =  $entry_company;
        $customers_street_address =  $entry_street_address ;
        $customers_suburb =  $entry_suburb ;
        $customers_city =  $entry_city;
        $customers_postcode =  $entry_postcode;
        $customers_state =  $entry_state;
        $customers_country =  $entry_country;
        $customers_telephone =  $customers_telephone;
        $customers_email_address =  $customers_email_address;
        $delivery_name =  $customers_name;
        $delivery_company =   $entry_company;
        $delivery_street_address =  $entry_street_address ;
        $delivery_suburb =  $entry_suburb;
        $delivery_city =  $entry_city;
        $delivery_postcode =  $entry_postcode;
        $delivery_state =  $entry_state;
        $delivery_country =  $entry_country;
        $billing_name =  $customers_name;
        $billing_company =  $entry_company;
        $billing_street_address =  $entry_street_address ;
        $billing_suburb =  $entry_suburb ;
        $billing_city =  $entry_city;
        $billing_postcode =   $entry_postcode;
        $billing_state =  $entry_state;
        $billing_country =  $entry_country;   		       
		$date_purchased="now()";
		
        $db->connect($ext_db_server[$p_old_db], $ext_db_username[$p_old_db], $ext_db_password[$p_old_db], $ext_db_database[$p_old_db], USE_PCONNECT, false);
		
       }
       else
       {
	    $p_new_customers_id = $old_order->fields['customers_id'];
        $customers_name = $old_order->fields['customers_name'];
        $entry_tva_intracom =  $old_order->fields['entry_tva_intracom'];							 
        $customers_company =  $old_order->fields['customers_company'];
        $customers_street_address = $old_order->fields['customers_street_address'];
        $customers_suburb =  $old_order->fields['customers_suburb'];
        $customers_city =  $old_order->fields['customers_city'];
        $customers_postcode =  $old_order->fields['customers_postcode'];
        $customers_state =  $old_order->fields['customers_state'];
        $customers_country =  $old_order->fields['customers_country'];
        $customers_telephone =  $old_order->fields['customers_telephone'];
        $customers_email_address = $old_order->fields['customers_email_address'];
        $delivery_name =  $old_order->fields['delivery_name'];
        $delivery_company =  $old_order->fields['delivery_company'];
        $delivery_street_address = $old_order->fields['delivery_street_address'];
        $delivery_suburb =  $old_order->fields['delivery_suburb'];
        $delivery_city =  $old_order->fields['delivery_city'];
        $delivery_postcode =  $old_order->fields['delivery_postcode'];
        $delivery_state =  $old_order->fields['delivery_state'];
        $delivery_country =  $old_order->fields['delivery_country'];
        $billing_name =  $old_order->fields['billing_name'];
        $billing_company =  $old_order->fields['billing_company'];
        $billing_street_address =  $old_order->fields['billing_street_address'];
        $billing_suburb =  $old_order->fields['billing_suburb'];
        $billing_city = $old_order->fields['billing_city'];
        $billing_postcode = $old_order->fields['billing_postcode'];
        $billing_state = $old_order->fields['billing_state'];
        $billing_country = $old_order->fields['billing_country'];	  
        $customers_countries_id = $old_order->fields['customers_countries_id'];	  

		
		  if ( $p_new_db=="po" )
		  {
			$date_purchased = $old_order->fields['date_purchased'];
		  }
		  else
		  {
			$date_purchased = "now()";
		  }
		  
       }			 
          if ( strlen ($p_customer_database_code) == 0 )
		  {
		     $p_customer_database_code = $old_order->fields['database_code'];	              
		  }
		          
		  if ( $p_new_languages_id == 0)
		  {
		     $p_new_languages_id = $old_order->fields['languages_id'];	              
		  }
		  // traitement transformation du BL en facture 
		  if ( $old_order->fields['orders_status']==5 ) 
		  {
			  $payment_info = $old_order->fields['payment_info'];
			  $payment_amount = $old_order->fields['payment_amount'];			  
			  $payment_info2 = $old_order->fields['payment_info2'];
			  $payment_amount2 = $old_order->fields['payment_amount2'];			  			  
		  }
		  
		  $treatment_date = "now()";
		  $products_tax = $old_order->fields['products_tax'];
		  
		  if ( $products_tax==0 )
		  {
			$products_tax = exec_select ( "select max(products_tax) value from orders_products where orders_id = ".$oID );
		  }
          $new_order = array('orders_id' => $oID,
                             'customers_id' => $p_new_customers_id,
                             'customers_name' => $customers_name,
                             'entry_tva_intracom' => $entry_tva_intracom,							 
                             'customers_company' => $customers_company,
                             'customers_street_address' => $customers_street_address ,
                             'customers_suburb' => $customers_suburb ,
                             'customers_city' => $customers_city,
                             'customers_postcode' => $customers_postcode,
                             'customers_state' => $customers_state,
                             'customers_country' => $customers_country,
                             'customers_telephone' => $customers_telephone,
                             'customers_email_address' => $customers_email_address,
                             'customers_address_format_id' => $old_order->fields['customers_address_format_id'],
                             'delivery_name' => $delivery_name,
                             'delivery_company' =>  $delivery_company,
                             'delivery_street_address' => $delivery_street_address ,
                             'delivery_suburb' => $delivery_suburb,
                             'delivery_city' => $delivery_city,
                             'delivery_postcode' => $delivery_postcode,
                             'delivery_state' => $delivery_state,
                             'delivery_country' => $delivery_country,
                             'delivery_address_format_id' => $old_order->fields['delivery_address_format_id'],
                             'billing_name' => $billing_name,
                             'billing_company' => $billing_company,
                             'billing_street_address' => $billing_street_address ,
                             'billing_suburb' => $billing_suburb ,
                             'billing_city' => $billing_city,
                             'billing_postcode' =>  $billing_postcode,
                             'billing_state' => $billing_state,
                             'billing_country' => $billing_country,
                             'billing_address_format_id' => $old_order->fields['billing_address_format_id'],                            
                             'payment_method' => $old_order->fields['payment_method'],
                             'payment_conditions_code' => $old_order->fields['payment_conditions_code'],							 							 
                             'payment_conditions_desc' => $old_order->fields['payment_conditions_desc'],							 
                             'payment_module_code' => $old_order->fields['payment_module_code'],
                             'shipping_method' => $old_order->fields['shipping_method'],
                             'shipping_module_code' => $old_order->fields['shipping_module_code'],
                             'coupon_code' => $old_order->fields['coupon_code'],
                             'cc_type' => $old_order->fields['cc_type'],
                             'cc_owner' => $old_order->fields['cc_owner'],
                             'cc_number' => $old_order->fields['cc_number'],
                             'cc_expires' => $old_order->fields['cc_expires'],
                             'cc_cvv' => $old_order->fields['cc_cvv'],
                             'last_modified' => 'now()',
                             'date_purchased' => $date_purchased,
                             'orders_status' => $p_new_status,                             
                             'currency' => $old_order->fields['currency'],
                             'currency_value' => $currency_value,
                             'order_total' => $old_order->fields['order_total'],
                             'languages_id' => $p_new_languages_id,
                             'database_code' => $p_customer_database_code,							 
                             'products_tax' => $products_tax,							 							 
                             'ref_info' => $old_order->fields['ref_info'],	
                             'payment_info' => $payment_info,			
                             'payment_amount' => $payment_amount,			
                             'payment_info2' => $payment_info2,			
                             'payment_amount2' => $payment_amount2,										 							 
							 'orders_date_finished' => $orders_date_finished,
                             'order_tax' => $old_order->fields['order_tax'],
							 'treatment_date' => 'now()',
							 'customers_countries_id' =>$customers_countries_id);
//echo $products_tax;exit;		  
		  
          // les produits --------------------------------------
          $products_cnt = 0;
          $old_products = $db->Execute("SELECT * FROM orders_products WHERE products_quantity>0 and orders_id = '" . $p_old_order_id . "'");
		  
		  if  ( ($p_new_db=="po")  &&  ($p_old_db!="gl") )
		  {
		     
		     $sql = "select sum(final_price) value FROM orders_products WHERE products_quantity>0  and products_model in ('ESCF','ESCC') and orders_id = '" . $p_old_order_id . "'";		     
//echo $sql.'<br>';
		     $la_reduction = exec_select ( $sql );

			 if ( $la_reduction > 0)
			 {
				$sql = "select count(products_quantity) value FROM orders_products WHERE products_model not in ('SHF','CODF','ECOF','ESCF','ESCC','FRSH','FRS') and orders_id = '" . $p_old_order_id . "'";		     
//echo $sql.'<br>';
			    $cnt_products = exec_select ( $sql);
				if ( $cnt_products > 0)
					$la_reduction = $la_reduction/$cnt_products;
				else
					$la_reduction = 0;	
					
			 }
		  }
		  		  
				  
          while (!$old_products->EOF) 
		  {
		    if  ( ($p_new_db=="po")  &&  ($p_old_db!="gl") )
			{
			   $k = $old_products->fields['products_quantity'];
			   $products_model = $old_products->fields['products_model'];
			   // 'SHF','CODF','ECOF','ESCF','FRSH','FRS'
			   if (  ( $products_model != 'SHF' ) 
			         && ( $products_model != 'CODF' ) 
			         && ( $products_model != 'ECOF' ) 
			         && ( $products_model != 'ESCF' )
			         && ( $products_model != 'ESCC' ) 					 
			         && ( $products_model != 'FRSH' ) 
			         && ( $products_model != 'FRS' ) )
				{
			            $products_cnt++;  					  				
			    		$new_products[$products_cnt] = array('orders_id' => $oID,
			                                              'sort_order' => $old_products->fields['sort_order'],			
			                                              'products_id' => $old_products->fields['products_id'],
			                                              'products_model' => $old_products->fields['products_model'],
			                                              'products_name' => $old_products->fields['products_name'],
			                                              'final_price' => $old_products->fields['final_price']-$la_reduction,
			                                              'products_tax' => $old_products->fields['products_tax'],
			                                              'products_quantity' => $old_products->fields['products_quantity'],
			                                              'source_orders_products_id' => $old_products->fields['orders_products_id'],														  
			                                              'products_prid' => $old_products->fields['products_prid'] );
				
/*				
				   for ($iter=1; $iter<=$k; $iter++ )
				   {
			            $products_cnt++;  					  
			    		$new_products[$products_cnt] = array('orders_id' => $oID,
			                                              'sort_order' => $old_products->fields['sort_order'],			
			                                              'products_id' => $old_products->fields['products_id'],
			                                              'products_model' => $old_products->fields['products_model'],
			                                              'products_name' => $old_products->fields['products_name'],
			                                              'final_price' => $old_products->fields['final_price']-$la_reduction,
			                                              'products_tax' => $old_products->fields['products_tax'],
			                                              'products_quantity' => 1,
			                                              'products_prid' => $old_products->fields['products_prid'] );
				   }
*/				 
				
				}			        			
			}
			else
			{
	            $products_cnt++;  					  
	    		$new_products[$products_cnt] = array('orders_id' => $oID,
	                                              'sort_order' => $old_products->fields['sort_order'],			
	                                              'products_id' => $old_products->fields['products_id'],
	                                              'products_model' => $old_products->fields['products_model'],
	                                              'products_name' => $old_products->fields['products_name'],
	                                              'final_price' => $old_products->fields['final_price'],
	                                              'products_tax' => $old_products->fields['products_tax'],
	                                              'products_quantity' => $old_products->fields['products_quantity'],
	                                              'products_prid' => $old_products->fields['products_prid'] );
			}
            $old_products->MoveNext();
          }
		  /// les totaux --------------------------------------------
		  $order_total_cnt = 0;
		  $sql = "SELECT * FROM " . TABLE_ORDERS_TOTAL . " WHERE value <> 0 and orders_id = '" . $p_old_order_id . "'";
		  $old_order_total = $db->Execute( $sql );
//echo $sql.'<br>';		  
		  while (!$old_order_total->EOF) {
			$order_total_cnt++;
//echo $order_total_cnt.'<br>';			
			$new_order_total[$order_total_cnt] = array('orders_id' => $oID,
									 'title' => $old_order_total->fields['title'],
									 'text' => $old_order_total->fields['text'],
									 'value' => $old_order_total->fields['value'],
									 'class' => $old_order_total->fields['class'],
									 'sort_order' => $old_order_total->fields['sort_order']);

			$old_order_total->MoveNext();
		  }
			  
		  /// les commentaires --------------------------------------------
/*
orders_status_history_id,
orders_id,
orders_status_id,
date_added,
comments 
*/		  
		  $order_history_cnt = 0;		  
		  $old_order_history = $db->Execute("SELECT * FROM orders_status_history WHERE orders_id = '" . $p_old_order_id . "'");
		  
		  while (!$old_order_history->EOF) {
			$order_history_cnt++;
			$new_order_history[$order_history_cnt] = array('orders_id' => $oID,
									 'orders_status_id' => $old_order_history->fields['orders_status_id'],
									 'date_added' => $old_order_history->fields['date_added'],
									 'comments' => $old_order_history->fields['comments'],
									 'customer_notified' => $old_order_history->fields['customer_notified']);

			$old_order_history->MoveNext();
		  }
		  
   		/// insertions ---------------------------------------------------------------------------------------------------------------------------
         $db->connect($ext_db_server[$p_new_db], $ext_db_username[$p_new_db], $ext_db_password[$p_new_db], $ext_db_database[$p_new_db], USE_PCONNECT, false);
//echo $p_new_db;exit;
   		
         zen_db_perform(TABLE_ORDERS, $new_order);

		  // produits ---------------------------------------------------
		  $loop = true;
		  $iter = 1;
		  while ($loop) 
		  {
             zen_db_perform(TABLE_ORDERS_PRODUCTS, $new_products[$iter]);
		     $iter++;
		     if ( $iter > $products_cnt )
    		     $loop = false;
		  }
		  // history -------------------------------------
		  if ($order_history_cnt>0)
		  {
			  $loop = true;
			  $iter = 1;
			  while ($loop) 
			  {
				 zen_db_perform('orders_status_history', $new_order_history[$iter]);
				 $iter++;
				 if ( $iter > $order_history_cnt )
					 $loop = false;
			  }		  
		  }
		  // totaux -------------------------------------
		  $loop = true;
		  $iter = 1;		  
		  while ($loop) 
		  {
			 zen_db_perform(TABLE_ORDERS_TOTAL, $new_order_total[$iter]);
//echo 'zut'.	$iter . '<br>';		 exit;
			 $iter++;
			 if ( $iter > $order_total_cnt )
				 $loop = false;
		  }		  

//echo 'stop';exit;			  		  
		  if ( $old_order->fields['orders_status']==5 ) 
		  {
			  require_once(DIR_WS_CLASSES . 'super_order.php');		  
			  recalc_total($oID);
		  }
		  // fin des insertions -------------------------------------------------------------------------------------------------
//echo "merde";exit;		  
 		  
       return $oID;
}
// -----------------------------------------------------------------------------------------------------------------
function produire_double_from_po ( $p_old_order_id, $p_old_db, $p_new_db, $p_customer_database_code , $p_new_customers_id, $p_new_languages_id, $p_new_status )
{
  global $db;

   global $db;
   global $currency;
   global $ext_db_server;
   global $ext_db_username;
   global $ext_db_password;
   global $ext_db_database;
   
    // recherche du nouvel ID	
	if  (  ($p_new_db!="po") || ( $p_old_order_id < 0 ) )
	{
	    $db->connect($ext_db_server[$p_new_db], $ext_db_username[$p_new_db], $ext_db_password[$p_new_db], $ext_db_database[$p_new_db], USE_PCONNECT, false);
	    $maxQry = $db->Execute('select max(orders_id)+1 new_oid from orders') ; 
	    $oID = $maxQry->fields['new_oid']; 		  
	}
	else
	{
	    $oID = $p_old_order_id;
	}

    // recup�ration des informsations � lire
//echo 'podb'.$p_old_db;exit;	   	
    $db->connect($ext_db_server[$p_old_db], $ext_db_username[$p_old_db], $ext_db_password[$p_old_db], $ext_db_database[$p_old_db], USE_PCONNECT, false);
   
	// Duplicate order details from "orders" table
	$old_order = $db->Execute("SELECT * FROM " . TABLE_ORDERS. " WHERE orders_id = " . $p_old_order_id );

	  if ( $p_new_db=="po" ) 
	  {
	     $currency_value = $old_order->fields['currency_value'];
		 if ( ( $p_old_order_id < 0 ) 
		      && ( $old_order->fields['currency'] != 'EUR') )
		 {
			$db->connect($ext_db_server[$p_new_db], $ext_db_username[$p_new_db], $ext_db_password[$p_new_db], $ext_db_database[$p_new_db], USE_PCONNECT, false);		 
			$sql =  "select value from currencies where code='".$old_order->fields['currency']."'";
			$recordSet = $db->Execute($sql);
			$currency_value = $recordSet->fields['value'];
			$db->connect($ext_db_server[$p_old_db], $ext_db_username[$p_old_db], $ext_db_password[$p_old_db], $ext_db_database[$p_old_db], USE_PCONNECT, false);			
		 }
	  }
	  else if ( $old_order->fields['currency'] != 'EUR' )	 
	  {  	     
         $db->connect($ext_db_server[$old_order->fields['database_code']], $ext_db_username[$old_order->fields['database_code']], $ext_db_password[$old_order->fields['database_code']], $ext_db_database[$old_order->fields['database_code']], USE_PCONNECT, false);
		 $sql =  "select value from currencies where code='".$old_order->fields['currency']."'";
		 $recordSet = $db->Execute($sql);
		 $currency_value = $recordSet->fields['value'];
		 $db->connect($ext_db_server[$p_old_db], $ext_db_username[$p_old_db], $ext_db_password[$p_old_db], $ext_db_database[$p_old_db], USE_PCONNECT, false);
	  }
	  else
	  {
		 $currency_value = 1;
	  }
       if ( $p_new_customers_id != 0 )
       {	    
        $db->connect($ext_db_server[$p_customer_database_code], $ext_db_username[$p_customer_database_code], $ext_db_password[$p_customer_database_code], $ext_db_database[$p_customer_database_code], USE_PCONNECT, false);	
   		$sql = "select entry_company ,
   					 entry_tva_intracom,
   					 entry_street_address,
   					 entry_suburb,
   					 entry_postcode,
   					 entry_city,
   					 entry_state,
   					 countries_name,					 
   					 customers_firstname,
   					 customers_lastname,
   					 customers_email_address,
   					 customers_telephone,
					 entry_country_id
                     from address_book ab, customers c, countries
                     where ab.customers_id = ". $p_new_customers_id . "
                      and   ab.customers_id = c.customers_id
                      and   c.customers_default_address_id =  ab.address_book_id 
   				   and   entry_country_id = countries_id";
   				   
           $sqlCustomer = $db->Execute($sql);
   		
   		$entry_company = $sqlCustomer->fields['entry_company'];
   		$entry_tva_intracom = $sqlCustomer->fields['entry_tva_intracom'];
   		$entry_street_address = $sqlCustomer->fields['entry_street_address'];
   		$entry_suburb = $sqlCustomer->fields['entry_suburb'];
   		$entry_postcode = $sqlCustomer->fields['entry_postcode'];
   		$entry_city = $sqlCustomer->fields['entry_city'];
   		$entry_state = $sqlCustomer->fields['entry_state'];
   		$entry_country = $sqlCustomer->fields['countries_name'];
   
   		$customers_firstname = $sqlCustomer->fields['customers_firstname'];
   		$customers_lastname = $sqlCustomer->fields['customers_lastname'];
   		$customers_email_address = $sqlCustomer->fields['customers_email_address'];
   		$customers_telephone = $sqlCustomer->fields['customers_telephone'];
		$customers_countries_id = $sqlCustomer->fields['entry_country_id'];

         // affectation des addresses pour les groupes de champ
        $customers_name = $customers_firstname . ' ' . $customers_lastname;
        $entry_tva_intracom =  $entry_tva_intracom;							 
        $customers_company =  $entry_company;
        $customers_street_address =  $entry_street_address ;
        $customers_suburb =  $entry_suburb ;
        $customers_city =  $entry_city;
        $customers_postcode =  $entry_postcode;
        $customers_state =  $entry_state;
        $customers_country =  $entry_country;
        $customers_telephone =  $customers_telephone;
        $customers_email_address =  $customers_email_address;
        $delivery_name =  $customers_name;
        $delivery_company =   $entry_company;
        $delivery_street_address =  $entry_street_address ;
        $delivery_suburb =  $entry_suburb;
        $delivery_city =  $entry_city;
        $delivery_postcode =  $entry_postcode;
        $delivery_state =  $entry_state;
        $delivery_country =  $entry_country;
        $billing_name =  $customers_name;
        $billing_company =  $entry_company;
        $billing_street_address =  $entry_street_address ;
        $billing_suburb =  $entry_suburb ;
        $billing_city =  $entry_city;
        $billing_postcode =   $entry_postcode;
        $billing_state =  $entry_state;
        $billing_country =  $entry_country;   		       
		$date_purchased="now()";
		
        $db->connect($ext_db_server[$p_old_db], $ext_db_username[$p_old_db], $ext_db_password[$p_old_db], $ext_db_database[$p_old_db], USE_PCONNECT, false);
		
       }
       else
       {
	    $p_new_customers_id = $old_order->fields['customers_id'];
        $customers_name = $old_order->fields['customers_name'];
        $entry_tva_intracom =  $old_order->fields['entry_tva_intracom'];							 
        $customers_company =  $old_order->fields['customers_company'];
        $customers_street_address = $old_order->fields['customers_street_address'];
        $customers_suburb =  $old_order->fields['customers_suburb'];
        $customers_city =  $old_order->fields['customers_city'];
        $customers_postcode =  $old_order->fields['customers_postcode'];
        $customers_state =  $old_order->fields['customers_state'];
        $customers_country =  $old_order->fields['customers_country'];
        $customers_telephone =  $old_order->fields['customers_telephone'];
        $customers_email_address = $old_order->fields['customers_email_address'];
        $delivery_name =  $old_order->fields['delivery_name'];
        $delivery_company =  $old_order->fields['delivery_company'];
        $delivery_street_address = $old_order->fields['delivery_street_address'];
        $delivery_suburb =  $old_order->fields['delivery_suburb'];
        $delivery_city =  $old_order->fields['delivery_city'];
        $delivery_postcode =  $old_order->fields['delivery_postcode'];
        $delivery_state =  $old_order->fields['delivery_state'];
        $delivery_country =  $old_order->fields['delivery_country'];
        $billing_name =  $old_order->fields['billing_name'];
        $billing_company =  $old_order->fields['billing_company'];
        $billing_street_address =  $old_order->fields['billing_street_address'];
        $billing_suburb =  $old_order->fields['billing_suburb'];
        $billing_city = $old_order->fields['billing_city'];
        $billing_postcode = $old_order->fields['billing_postcode'];
        $billing_state = $old_order->fields['billing_state'];
        $billing_country = $old_order->fields['billing_country'];	  
        $customers_countries_id = $old_order->fields['customers_countries_id'];	  

		
		  if ( $p_new_db=="po" )
		  {
			$date_purchased = $old_order->fields['date_purchased'];
		  }
		  else
		  {
			$date_purchased = "now()";
		  }
		  
       }			 
          if ( strlen ($p_customer_database_code) == 0 )
		  {
		     $p_customer_database_code = $old_order->fields['database_code'];	              
		  }
		          
		  if ( $p_new_languages_id == 0)
		  {
		     $p_new_languages_id = $old_order->fields['languages_id'];	              
		  }
		  $payment_info = $old_order->fields['payment_info'];
		  $payment_amount = $old_order->fields['payment_amount'];			  
		  $orders_date_finished = $old_order->fields['orders_date_finished'];
		  $payment_info2 = $old_order->fields['payment_info2'];
		  $payment_amount2 = $old_order->fields['payment_amount2'];			  
		  
		  $treatment_date = "now()";
		  
          $new_order = array('orders_id' => $oID,
                             'customers_id' => $p_new_customers_id,
                             'customers_name' => $customers_name,
                             'entry_tva_intracom' => $entry_tva_intracom,							 
                             'customers_company' => $customers_company,
                             'customers_street_address' => $customers_street_address ,
                             'customers_suburb' => $customers_suburb ,
                             'customers_city' => $customers_city,
                             'customers_postcode' => $customers_postcode,
                             'customers_state' => $customers_state,
                             'customers_country' => $customers_country,
                             'customers_telephone' => $customers_telephone,
                             'customers_email_address' => $customers_email_address,
                             'customers_address_format_id' => $old_order->fields['customers_address_format_id'],
                             'delivery_name' => $delivery_name,
                             'delivery_company' =>  $delivery_company,
                             'delivery_street_address' => $delivery_street_address ,
                             'delivery_suburb' => $delivery_suburb,
                             'delivery_city' => $delivery_city,
                             'delivery_postcode' => $delivery_postcode,
                             'delivery_state' => $delivery_state,
                             'delivery_country' => $delivery_country,
                             'delivery_address_format_id' => $old_order->fields['delivery_address_format_id'],
                             'billing_name' => $billing_name,
                             'billing_company' => $billing_company,
                             'billing_street_address' => $billing_street_address ,
                             'billing_suburb' => $billing_suburb ,
                             'billing_city' => $billing_city,
                             'billing_postcode' =>  $billing_postcode,
                             'billing_state' => $billing_state,
                             'billing_country' => $billing_country,
                             'billing_address_format_id' => $old_order->fields['billing_address_format_id'],                            
                             'payment_method' => $old_order->fields['payment_method'],
                             'payment_conditions_code' => $old_order->fields['payment_conditions_code'],							 							 
                             'payment_conditions_desc' => $old_order->fields['payment_conditions_desc'],							 
                             'payment_module_code' => $old_order->fields['payment_module_code'],
                             'shipping_method' => $old_order->fields['shipping_method'],
                             'shipping_module_code' => $old_order->fields['shipping_module_code'],
                             'coupon_code' => $old_order->fields['coupon_code'],
                             'cc_type' => $old_order->fields['cc_type'],
                             'cc_owner' => $old_order->fields['cc_owner'],
                             'cc_number' => $old_order->fields['cc_number'],
                             'cc_expires' => $old_order->fields['cc_expires'],
                             'cc_cvv' => $old_order->fields['cc_cvv'],
                             'last_modified' => 'now()',
                             'date_purchased' =>$old_order->fields['date_purchased'],
                             'orders_status' => $p_new_status,                             
                             'currency' => $old_order->fields['currency'],
                             'currency_value' => $currency_value,
                             'order_total' => $old_order->fields['order_total'],
                             'languages_id' => $p_new_languages_id,
                             'database_code' => $p_customer_database_code,							 
                             'products_tax' => $old_order->fields['products_tax'],							 							 
                             'ref_info' => $old_order->fields['ref_info'],	
                             'payment_info' => $payment_info,			
                             'payment_amount' => $payment_amount,										 
                             'payment_info2' => $payment_info2,			
                             'payment_amount2' => $payment_amount2,										 							 
							 'orders_date_finished' => $orders_date_finished,
                             'order_tax' => $old_order->fields['order_tax'],
							 'treatment_date' => 'now()',
							 'customers_countries_id' =>$customers_countries_id);
		  
//echo $status;exit;payment_info
		  $tax = $old_order->fields['products_tax'];		  
		  
          // les produits --------------------------------------
          $products_cnt = 0;
          $old_products = $db->Execute("SELECT * FROM orders_products WHERE products_quantity>0 and orders_id = '" . $p_old_order_id . "'");
		  
		  if  ( ($p_new_db=="po")  &&  ($p_old_db!="gl") )
		  {
		     
		     $sql = "select sum(final_price) value FROM orders_products WHERE products_quantity>0  and products_model in ('ESCF','ESCC') and orders_id = '" . $p_old_order_id . "'";		     
//echo $sql.'<br>';
		     $la_reduction = exec_select ( $sql );

			 if ( $la_reduction > 0)
			 {
				$sql = "select count(products_quantity) value FROM orders_products WHERE products_model not in ('SHF','CODF','ECOF','ESCF','ESCC','FRSH','FRS') and orders_id = '" . $p_old_order_id . "'";		     
//echo $sql.'<br>';
			    $cnt_products = exec_select ( $sql);
				if ( $cnt_products > 0)
					$la_reduction = $la_reduction/$cnt_products;
				else
					$la_reduction = 0;	
					
			 }
		  }
		  		  
		  $somme_reliquat = 0;			  
		  $somme_produits = 0;
		  
          while (!$old_products->EOF) 
		  {
		    if  ( true )
			{
			   $k = $old_products->fields['products_quantity'];
			   $products_model = $old_products->fields['products_model'];
			   // 'SHF','CODF','ECOF','ESCF','FRSH','FRS'
			   if (  ( $products_model != 'SHF' ) 
			         && ( $products_model != 'CODF' ) 
			         && ( $products_model != 'ECOF' ) 
			         && ( $products_model != 'ESCF' )
			         && ( $products_model != 'ESCC' ) 					 
			         && ( $products_model != 'FRSH' ) 
			         && ( $products_model != 'FRS' ) )
				{
			            $products_cnt++;  			
// FV 
$sql = 'select count(1) value
		from rv_lampe_eu.el_product_supply 
		where po_orders_products_id='. $old_products->fields['orders_products_id'] . ' 
		and   date_format(sent_date,"%Y-%c-%d")=date_format(now(),"%Y-%c-%d")';
		
//echo $sql.'<br>';

	$products_quantity	= exec_select( $sql);

$sql = 'select count(1) value
		from rv_lampe_eu.el_product_supply 
		where po_orders_products_id='. $old_products->fields['orders_products_id'] . ' 
		and   date_format(sent_date,"%Y-%c-%d")<>date_format(now(),"%Y-%c-%d")';

	$anterieurs	= exec_select( $sql);
		
	$reliquat =  $old_products->fields['products_quantity']-$products_quantity-$anterieurs;
	$somme_reliquat += $reliquat;
	
	$somme_produits = $somme_produits + $products_quantity;
//echo $sql.'<br>';		
			    		$new_products[$products_cnt] = array('orders_id' => $oID,
			                                              'sort_order' => $old_products->fields['sort_order'],			
			                                              'products_id' => $old_products->fields['products_id'],
			                                              'products_model' => $old_products->fields['products_model'],
			                                              'products_name' => $old_products->fields['products_name'],
			                                              'final_price' => $old_products->fields['final_price']-$la_reduction,
			                                              'products_tax' => $old_products->fields['products_tax'],
			                                              'products_quantity' => $products_quantity,
			                                              'reliquat' => $reliquat,														  
			                                              'products_prid' => $old_products->fields['products_prid'] );				
														  
						$montantHT+=$products_quantity*($old_products->fields['final_price']-$la_reduction);
						
				}			        			
			}
            $old_products->MoveNext();
          }
		  // la reprise des frais sur les lignes de commande d'origine
		  
		 $sql = "select * from ".$ext_db_database[$p_customer_database_code] .".orders_products  
				where orders_id = ".  $p_old_order_id ." 
				and orders_products.products_model 
				IN (
				'SHF', 'CODF', 'ECOF', 'ESCF', 'FRSH', 'FRS','ESCC'
				)";
          $ord_products = $db->Execute($sql);
		  
          while (!$ord_products->EOF) 
		  {
		    if  ( true )
			{
//echo 'prd'.$ord_products->fields['products_model'].'<br>';			
			   $products_quantity = $ord_products->fields['products_quantity'];
			   $final_price = $ord_products->fields['final_price'];
			   $products_model = $ord_products->fields['products_model'];
			   // 'SHF','CODF','ECOF','ESCF','FRSH','FRS'
				$products_cnt++;
				if ( $products_model == 'ECOF' )
				{
					$products_quantity = $somme_produits;
					$final_price = 0.15;
				}
				
				if ( $products_model == 'SHF' )
				{
					 $sql = "select 1 value from bo_po.orders where orders_id=". $oID ." and po_status='partialydispatched'";
					 $chkDispatch = exec_select($sql);
					 // 
					 if ( $chkDispatch == 0)
					 {
						 $sql = "select 1 value from ".$ext_db_database[$p_customer_database_code] .".orders_total  
								where orders_id = ".  $p_old_order_id ." 
								and orders_total.class = 'ot_coupon' ";
											
								
						 $chkDispatch = exec_select($sql);
					 }

				}
				else
				{
					 $chkDispatch = 0;
				}			
				// v�rification de l'existence d'un coupon
				if ( $chkDispatch == 0)
				{
					$new_products[$products_cnt] = array('orders_id' => $oID,
													  'sort_order' => $ord_products->fields['sort_order'],			
													  'products_id' => $ord_products->fields['products_id'],
													  'products_model' => $ord_products->fields['products_model'],
													  'products_name' => $ord_products->fields['products_name'],
													  'final_price' => $final_price,
													  'products_tax' => $ord_products->fields['products_tax'],
													  'products_quantity' => $products_quantity,
													  'reliquat' => 0,														  
													  'products_prid' => $ord_products->fields['products_prid'] );		

					$montantHT+=$products_quantity*$final_price;		
				}
				
			}
            $ord_products->MoveNext();
          }
		  
//exit;		  
		  /// les totaux --------------------------------------------
/*		  
		  $order_total_cnt = 0;
		  $old_order_total = $db->Execute("SELECT * FROM " . TABLE_ORDERS_TOTAL . " WHERE value <> 0 and orders_id = '" . $p_old_order_id . "'");
		  while (!$old_order_total->EOF) {
			$order_total_cnt++;
			$new_order_total[$order_total_cnt] = array('orders_id' => $oID,
									 'title' => $old_order_total->fields['title'],
									 'text' => $old_order_total->fields['text'],
									 'value' => $old_order_total->fields['value'],
									 'class' => $old_order_total->fields['class'],
									 'sort_order' => $old_order_total->fields['sort_order']);

			$old_order_total->MoveNext();
		  }
*/		  

		$old_order_total = $db->Execute("SELECT * FROM " . TABLE_ORDERS_TOTAL . " WHERE value <> 0 and orders_id = '" . $p_old_order_id . "'");
		
		
		// -- g�rer l'�ventuelle absence de totaux...
		$order_total_cnt=0;
		
		// totaux -------------------------------------
//			try {		  
		  $loop = true;
		  
 //         if ( $order_total_cnt>0 )
		  if (!$old_order_total->EOF)
		  {
		  
					  $iter = 1;
			  $ot_coupon_exists = 0;
	          while (!$old_order_total->EOF) 
			  {  
			    // gestion specifique des frais de port, COD et eco-contribution --
	            if (  ( $old_order_total->fields['class']=='ot_shipping' )
	                 || ( $old_order_total->fields['class']=='ot_cod_fee' )
	                 || ( $old_order_total->fields['class']=='ot_coupon' )					 
	                 || ( $old_order_total->fields['class']=='ot_loworderfee' ) )
	            {
	                 // $p_product_type=="ot_shipping" || $p_product_type=="ot_cod_fee"
					 $new_name = strip_tags( $old_order_total->fields['title'] );
					 $new_name  = str_replace ( ":","",$new_name);
					 
					 
					 // on check sur PO si par hasard c'est pas d�j� envoy�s
//echo 'merde';					 
					 $sql = "select 1 value from bo_po.orders where orders_id=". $oID ." and po_status='partialydispatched'";
					 $chkDispatch = exec_select($sql);
					 if ( $chkDispatch == 0)
					 {
						 $sql = "select 1 value from ".$ext_db_database[$p_customer_database_code] .".orders_total  
								where orders_id = ".  $p_old_order_id ." 
								and orders_total.class = 'ot_coupon' ";
											
								
						 $chkDispatch = exec_select($sql);
//ECHO '||'.$chkDispatch.'||' . $sql;						
						 
					 }
	                 if (  ( $old_order_total->fields['class'] == 'ot_shipping' ) && ( $chkDispatch==0) )					 
					 {
//ECHO '|in|'.$chkDispatch.'|in|' . $sql;
					 
					   $new_model = 'SHF';
					   if ( $old_order->fields['languages_id'] == 4 )
					   {
					      $new_name = 'Versandkostenpauschale';
					   }					  
					 }
					 else if ( $old_order_total->fields['class'] == 'ot_cod_fee'  )
					 {
					   $new_model = 'CODF';
					 }
					 else if ( $old_order_total->fields['class'] == 'ot_loworderfee'  )
					 {
					   $new_model = 'ECOF';
	    			   $new_name  = "Eco-contribution"; 
					 }
					 // exclure les doubles facturation de frais de port
					 if ( ! ( ( $old_order_total->fields['class'] == 'ot_shipping' ) && ( $chkDispatch==1) ) )
					 {
//echo 'oooooooo';					 
						 $new_price = $old_order_total->fields['value'];				 				 				 
						 if ( $old_order->fields['database_code'] != 'eu' )
						 {
							$new_price = round ( $new_price / ( 1 + ( $tax / 100 ) ),2);
						 }	
						 if ( $old_order_total->fields['class'] == 'ot_shipping'  )
						 {
							$sql = "SELECT count(1) cnt FROM " . TABLE_ORDERS_TOTAL . " WHERE class='ot_coupon' and orders_id =" . $oID ;
							$rs3 = $db->Execute($sql);
							
							$ot_coupon_exists = $rs3->fields['cnt'];
							
						 }
						 if ( 
							   ! (
								  (  ( $old_order_total->fields['class'] == 'ot_coupon'  ) )
									|| 
								  (   ( ( $old_order_total->fields['class'] == 'ot_shipping'  ) && (  $ot_coupon_exists==1 )  ) )
								 )
							  )
						{
						 
							 $totalht += $new_price;
//ECHO '|insert|'.$new_model.'|in|';exit;
							 
							 $products_cnt++;  					  				 
							 $new_products[$products_cnt] = array('orders_id' => $oID,
															  'products_id' => -1,
															  'products_model' => $new_model,
															  'products_name' => $new_name,
															  'final_price' => $new_price,
															  'products_tax' => $tax,
															  'products_quantity' => 1,
															  'sort_order'=>$products_cnt*100,
															  'products_prid' => -1 );
															  
							$montantHT+=$new_price;												  
						}								  
					}
					else
					{
// echo 'ya'.$new_model;
					}
	            } 
	            else
	            {
	    		   $order_total_cnt++;
				   $new_title = $old_order_total->fields['title'];
				   if ( $old_order_total->fields['class'] == 'ot_subtotal' )
				   {
				      $new_title = str_replace('TTC','' ,$new_title );
				   }
//echo '<br>new cnt '. $order_total_cnt;				   
	               $new_order_total[$order_total_cnt] = array('orders_id' => $oID,
	                                        'title' => $new_title,
	                                        'text' => $old_order_total->fields['text'],
	                                        'value' => $old_order_total->fields['value'],
	                                        'class' => $old_order_total->fields['class'],
	                                        'sort_order' => $old_order_total->fields['sort_order']);
	            }
	            $old_order_total->MoveNext();
	          }
// Fv suite � plantage					  
				  //  if ( $old_order->fields['orders_status']==5 ) 

		}
			else
			{
				$chk = exec_select ( "select 1 value from bo_gl.orders_total where orders_id = ".$oID );
				if ($chk != 1)
				{
					$dml = "INSERT INTO bo_gl.orders_total  (
							`orders_total_id` ,
							`orders_id` ,
							`title` ,
							`text` ,
							`value` ,
							`class` ,
							`sort_order`
							)
							VALUES (
							NULL , ".$oID.", 'Total TTC:', '&euro;&nbsp;209,48', '209.4794', 'ot_total', '2'
							)";
					$db->Execute($dml);
				}
				
			}
		  // produits ---------------------------------------------------
   		 /// insertions ---------------------------------------------------------------------------------------------------------------------------
		 //echo $p_new_db;exit;
         $db->connect($ext_db_server[$p_new_db], $ext_db_username[$p_new_db], $ext_db_password[$p_new_db], $ext_db_database[$p_new_db], USE_PCONNECT, false);   		
         zen_db_perform(TABLE_ORDERS, $new_order);
		  
		  $loop = true;
		  $iter = 1;
		  while ($loop) 
		  {
             zen_db_perform(TABLE_ORDERS_PRODUCTS, $new_products[$iter]);
		     $iter++;
		     if ( $iter > $products_cnt )
    		     $loop = false;
		  }
		  // totaux -------------------------------------
		  $loop = true;
		  $iter = 1;		  
//echo count($new_order_total);  
          $order_total_cnt = count($new_order_total);
			
		  while (($loop)&&($order_total_cnt>0)) 
		  {
//echo '<br> iter '. $iter . ' iter ';		  
			 zen_db_perform(TABLE_ORDERS_TOTAL, $new_order_total[$iter]);
			 
			 
			 $iter++;
			 if ( $iter > $order_total_cnt )
				 $loop = false;
		  }		  
		  
			
//			catch (Exception $e)
//			{
//			}	
//			}
		  
		  // fin des insertions -------------------------------------------------------------------------------------------------
//$somme_reliquat
//$p_customer_database_code 		  
		  // modification du statut de la commande source pour envoy�e
		  if ($somme_reliquat == 0 )		  
		  {
			 $dml = "update ".$ext_db_database[$p_customer_database_code].".orders set orders_status = 3 where orders_id = " . $oID ;
			 $db->Execute( $dml );		  
		  }
		  else
		  {
			 $dml = "update ".$ext_db_database[$p_customer_database_code].".orders set orders_status = 4 where orders_id = " . $oID ;
			 $db->Execute( $dml );		 		  
		  }
		  
		  if ( true )
		  {
// FVV
//  $old_order->fields['currency'],
//                        'currency_value' => $currency_value		  
			  // recalc total ne donne que des zero...
//			  require_once(DIR_WS_CLASSES . 'super_order.php');		  
//			  recalc_total($oID);
			  // &euro;&nbsp;24,15	24.1500	
			  if ( $old_order->fields['currency'] != 'EUR' )
			  {
				  $montantHT = round($currency_value*$montantHT,2);
				  $dml = "update orders_total 
						  set value=".$montantHT.",
							  text= '".str_replace(".",",",$montantHT)."&nbsp;". $old_order->fields['currency'] ."'
						  where class='ot_subtotal'
						  and orders_id = ". $oID ;
	//echo $dml;					  
				  $db->Execute($dml);
				}
				else
			   {
				  $montantHT = round($montantHT,2);
				  $dml = "update orders_total 
						  set value=".$montantHT.",
							  text= '&euro;&nbsp;".str_replace(".",",",$montantHT)."'
						  where class='ot_subtotal'
						  and orders_id = ". $oID ;
	//echo $dml;					  
				  $db->Execute($dml);
				}				
		  }		  
		 // update du prix HT
/*		 
		 $dml = "update ".$ext_db_database[$p_customer_database_code].".orders_total set orders_status = 4 where orders_id = " . $oID ;
		 $db->Execute( $dml );				  
*/
       return $oID;
}
//-----------------------------------------------------------------------------------------------------------------
function get_invoice_id ( $p_order_id, $p_invoice_type, $p_force_numbering , $p_ref_orders_id=0, $p_orders_invoices_id_comment="" )
{
   global $db;
   global $ext_db_database;
   
   $invoice_id =0;
   $sql = "select orders_invoices_id 
           from ".$ext_db_database['gl'].".orders_invoices 
           where order_total <> 0 
		   and invoice_type = '". $p_invoice_type ."'
		   and orders_id = '" . $p_order_id  . "'";
		   
   $invoice_query  = $db->Execute( $sql );
   $invoice_id =  $invoice_query->fields['orders_invoices_id'];
   

   if ( ($invoice_id == 0) && ($p_force_numbering)   )
   {
       // r�cup�ration des trous
	   $sql = "select orders_invoices_id 
	           from bo_gl.orders_invoices 
	           where order_total = 0 
			   and invoice_type = '". $p_invoice_type ."'
			   order by orders_invoices_id";
			   
	   $invoice_query  = $db->Execute( $sql );
	   $invoice_id =  $invoice_query->fields['orders_invoices_id'];

       if ( $invoice_id )        
	   {	
	      $dml = "update bo_gl.orders_invoices 
		          set orders_id = " . $p_order_id . ", 
				      invoice_date = now(), 
					  order_total = 1
				  where orders_invoices_id = " . $invoice_id . "
				  and   invoice_type = '". $p_invoice_type ."'";

		  if ( $db->Execute( $dml )=== false )
		  {
		    echo 'Pb sql:'.$dml; exit;
		  }
				  
	   }
	   else
	   {
		   $sql = "select max(orders_invoices_id)+1 invoice_id
		           from bo_gl.orders_invoices 
		           where order_total <> 0
				   and invoice_type = '". $p_invoice_type ."'
				   order by orders_invoices_id";
		   $invoice_query  = $db->Execute( $sql );
		   $invoice_id =  $invoice_query->fields['invoice_id'];
		   
		   if ( $invoice_id ) 
		   {
		       $dml = "insert into bo_gl.orders_invoices ( orders_invoices_id ,invoice_type, orders_id, order_total, invoice_date, ref_orders_id, orders_invoices_id_comment )
			           values ( ". $invoice_id .",'".  $p_invoice_type ."',". $p_order_id. ", 1, now(), " . $p_ref_orders_id .  ", '".$p_orders_invoices_id_comment."' )";

//echo $dml.'..before<br>';					   
					   
 			  if ( $db->Execute( $dml )=== false )
			  {
			    echo 'Pb sql:'.$dml; exit;
			  }			 
//echo $dml.'..after<br>';					   
		   }
		   else
		   {
		      echo ' pb de num�rotation invoice_type:'. $p_invoice_type . ' order_id:'. $p_order_id; exit;
		   }	   	   
	   }	   
   }   
   return ($invoice_id);
}
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
function exec_select ( $sql_stmt  )
{
  global $db;
  $recordSet = $db->Execute( $sql_stmt );
  return $recordSet->fields['value'];
}
function get_list_select ( $sql_stmt, $name, $value, $select_attributes='' )
{
  global $db;
    $start_html =  '';
    $end_html =  '';
   
   $recordSet = $db->Execute( $sql_stmt );

   $html =  '<select size="10"  name="'.$name.'" '. $select_attributes .'>';
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
function init_stock_quantities()
{
   global $db;
   $_SESSION['init_quantities']=1;
}
function init_batch_items()
{
   global $db;
   // on va chercher le libelle  dans GL
   $sql = "select batch_name,batch_id from el_batch where active=1 and batch_type='gl'";
   $rs = $db->Execute($sql);
   while(!$rs->EOF)
   {
      $batches[]=$rs->fields['batch_name'];
	  $batches_ids[]=$rs->fields['batch_id'];
	  
	  $rs->MoveNext();
   }
   $batch_items = '';
   
   $sql = "select item_id 
                       from el_batch_items, el_batch 
					   where el_batch.batch_id = el_batch_items.batch_id
					   and   batch_type = 'gl'
					   and   el_batch.active=1";
					   
   $bi = $db->Execute($sql);
   $cntr = 0;
   while (!$bi->EOF)
   {
      $batch_items .= ',' . $bi->fields['item_id'];
	  $cntr++;
	  $bi->MoveNext();
   }
   $_SESSION['active_batch_items']=$batch_items;
   if ( count($batches) )
   {
 	  $_SESSION['active_batches'] = implode(',',$batches);
 	  $_SESSION['active_batches_ids'] = implode(',',$batches_ids);	  
   }
//echo   'aa'. $_SESSION['active_batches'];exit;
   $_SESSION['active_batch_items_counter']=$cntr;
   $_SESSION['init_batch']=1;
   
   // on initialise   toutes les variables de session
}
// la  gestion des reliquats a trois fonction et deux modes d'appel
//  fonctions : 1 recalcul  des reliquats (sur la commande et le dernier BL)
//                     2  en intitialisant les quantit�s livr�es par d�faut (sur le dernier BL )
//                     3  en appliquant des changements aux quantit�s livr�es (sur le dernier BL )
//   on l'appelle en deux mode
//    A initialisation du BL (1) et (2)
//    B  modification des quantit�s livr�es (1) et (3)
function gestion_reliquats ( $p_orders_id, $p_orders_products_id=0, $p_ajout=0 , $p_init=0  )
{
   global $db;

   global $currency;
   global $ext_db_server;
   global $ext_db_username;
   global $ext_db_password;
   global $ext_db_database;
   
   // on est en mode initialisation  on d�cide  de ne rien livrer par d�faut
   if ( $p_init )
   {
      $dml = "update orders_products 
	          set products_quantity = 0 
			  where products_model not in  ( 'SHF', 'CODF', 'ECOF', 'ESCF' , 'FRSH' )
			  and orders_id = ". $p_orders_id;
//echo $dml;	  
      $db->Execute( $dml );
   }
   else if ( $p_orders_products_id )
   {
       $dml = "update orders_products set products_quantity = products_quantity + " . $p_ajout .   " 
	                 where orders_products_id = ". $p_orders_products_id;   
//echo $dml;					 
      $db->Execute( $dml );
   }
   
   $sql = "select database_code, ref_orders_id 
           from orders_invoices, orders
		   where orders_invoices.orders_id = orders.orders_id
		   and   orders.orders_id = ". $p_orders_id;


//echo sql;	  		   

   $sf=$db->Execute($sql);
   
   
   $order_db = $sf->fields['database_code'];
   $ref_orders_id = $sf->fields['ref_orders_id'];
   
    
    // les qt� command�es
    $db->connect($ext_db_server[$order_db], $ext_db_username[$order_db], $ext_db_password[$order_db], $ext_db_database[$order_db], USE_PCONNECT, false);
$sql = "select products_quantity, products_model
                            from orders_products	
                            where products_model not in  ( 'SHF', 'CODF', 'ECOF', 'ESCF' , 'FRSH' )
							and orders_id = ". $ref_orders_id;	
//echo $sql;
 	
    $qty = $db->Execute(  $sql  ) ; 
	while ( !$qty->EOF )
	{
		$qty_ordered[$qty->fields['products_model']] = $qty->fields['products_quantity'];
//echo "qo".$qty_ordered[$qty->fields['products_model']];
	    $qty->MoveNext();
	}


	
    $db->connect($ext_db_server["gl"], $ext_db_username["gl"], $ext_db_password["gl"], $ext_db_database["gl"], USE_PCONNECT, false);
    $sql = "select sum(op.products_quantity) pd, op.products_model
                            from orders_products op, orders_invoices oi, orders o
                            where op.products_model not in  ( 'SHF', 'CODF', 'ECOF', 'ESCF' , 'FRSH' )
							and o.orders_status = 5
							and op.orders_id = o.orders_id
							and oi.orders_id = o.orders_id
							and oi.ref_orders_id  = ". $ref_orders_id . "
							group by op.products_model";	
//echo $sql;							
    $qty = $db->Execute( $sql ) ; 							
	while ( ! $qty->EOF )
	{
		$qty_delivered[$qty->fields['products_model']]= $qty->fields['pd'];
	    $qty->MoveNext();
	}
	
	// on applique le reliquat � la commande initiale  ------------------------------------------------------------------------------------------
    $db->connect($ext_db_server[$order_db], $ext_db_username[$order_db], $ext_db_password[$order_db], $ext_db_database[$order_db], USE_PCONNECT, false);
	$sql = "select orders_products_id, products_model
	        from orders_products 
			where products_model not in  ( 'SHF', 'CODF', 'ECOF', 'ESCF' , 'FRSH' )
			and  orders_id = " . $ref_orders_id;
//echo $sql;
			
    $qty = $db->Execute( $sql ) ; 
	$reliquat_total = 0;
							
	while ( ! $qty->EOF )
	{
		$reliquat =  $qty_ordered[$qty->fields['products_model']]  - $qty_delivered[$qty->fields['products_model']];
		$reliquat_total = $reliquat_total + $reliquat;
		
		$dml = "update orders_products 
		        set  reliquat = ". $reliquat . "
				where orders_products_id = " . $qty->fields['orders_products_id'];
// echo $dml;				
		$db->execute($dml);
	    $qty->MoveNext();
	}
    if ( $reliquat_total == 0 ) 
	{
	   $db->Execute("update orders set orders_status = 3 where orders_id = " . $ref_orders_id );
	}
	else
	{
	   $db->Execute("update orders set orders_status = 4 where orders_id = " . $ref_orders_id );
	}
	
	
    $db->connect($ext_db_server["gl"], $ext_db_username["gl"], $ext_db_password["gl"], $ext_db_database["gl"], USE_PCONNECT, false);	
	
	// on applique le reliquat au dernier BL------------------------------------------------------------------------------------------
	$sql = "select orders_products_id, products_model
	        from orders_products 
			where products_model not in  ( 'SHF', 'CODF', 'ECOF', 'ESCF' , 'FRSH' )
			and  orders_id = " . $p_orders_id;
//echo $sql;
			
    $qty = $db->Execute( $sql ) ; 
							
	while ( ! $qty->EOF )
	{
		$reliquat =  $qty_ordered[$qty->fields['products_model']]  - $qty_delivered[$qty->fields['products_model']];
		$dml = "update orders_products 
		        set  reliquat = ". $reliquat . "
				where orders_products_id = " . $qty->fields['orders_products_id'];
// echo $dml;				
		$db->execute($dml);
	    $qty->MoveNext();
	}
	return 1;

}

function get_tickets($enforce_closed,$first_only=0)
{
   global $db;

   if ( ( $enforce_closed == 0 ) || ( strlen($enforce_closed) == 0 ) )
   {
	   $condition = "	and   s.active = 1 ";
   }			 
   
   $sql = "select distinct customers_id
				from el_ticket t, el_ticket_status s
					where t.status = s.id " . $condition ;

   
	$rc1 = $db->Execute($sql);
	while (!$rc1->EOF)
    {	
	    $customers_id = $rc1->fields['customers_id'];
		$sql = " select t.id, t.ticket_type, t.date_created, t.recall_date, s.color,
		                DATEDIFF(t.recall_date,now()) rappel_dans
					from el_ticket t, el_ticket_status s
					where t.status = s.id
					" .  $condition .  " 
					and   t.customers_id = " . $customers_id .  "
					order by recall_date desc";
        if ( $first_only )
		{
			$sql .= ' limit 0,3 ';
		}
		$html_client = "<table><tr>";		 
		$recordSet = $db->Execute( $sql );
		while ( !$recordSet->EOF )
		{
		   $id  =  $recordSet->fields['id'];
	       $ticket_type = $recordSet->fields['ticket_type'];
	       $date_created = $recordSet->fields['date_created'];
	       $color= $recordSet->fields['color'];
		   $rappel_dans =  $recordSet->fields['rappel_dans'];
		   
		   if ( $rappel_dans <= 0 )
		   {
		      $rappel_dans = "";
		   }
		   else
		   {
		      $rappel_dans .= "j ";
		   }
		   if ( $ticket_type == "rma" )
		   {
		      $rappel_dans .= "#". $id;
		   }
		   
		   $html_client .= '<td bgcolor="'.$color.'">
				    <a href="javascript:popupWindow(\'ticket_frame.php?customers_id='. $customers_id.'&customer_db=fr&id='.$id.'\',\'height=400,width=800,screenX=400,screenY=400,top=400,left=400\')">
	    				<img border=0 src="'. $ticket_type .'_note.gif">
					</a>
			         '. $rappel_dans . '		 
				   </td>';
		    $recordSet->MoveNext();
		}
		$html_client .= "</tr></table>";		 
  	    $tickets[$customers_id] =  $html_client;
		
		$rc1->MoveNext();
	}		
	return $tickets;
} 
// permet de r�cup�rer les RMAS
function get_rma_ids($enforce_closed)
{
   global $db;
   if ( ( $enforce_closed == 0 ) || ( strlen($enforce_closed) == 0 ) )
   {
	   $condition = "	and   s.active = 1 ";
   }			 
   
   $sql = "select distinct customers_id
				from el_ticket t, el_ticket_status s
					where t.status = s.id " . $condition ;

   
	$rc1 = $db->Execute($sql);
	while (!$rc1->EOF)
    {	
	    $customers_id = $rc1->fields['customers_id'];
		$sql = " select t.id, t.ticket_type, t.date_created, t.recall_date, s.color,
		                DATEDIFF(t.recall_date,now()) rappel_dans
					from el_ticket t, el_ticket_status s
					where t.status = s.id
					and t.ticket_type = 'rma'
					" .  $condition .  " 
					and   t.customers_id = " . $customers_id .  "
					order by recall_date desc";

		$html_client = "<table><tr>";		 
		$recordSet = $db->Execute( $sql );
		while ( !$recordSet->EOF )
		{
		   $rma_ids[$customers_id][] = $recordSet->fields['id'];
		   $recordSet->MoveNext();
		}		
		$rc1->MoveNext();
	}		
//echo 'out'.count($rma_ids).'--zout';exit;	
	return $rma_ids;
} 
?>