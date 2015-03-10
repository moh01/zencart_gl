<?php

class BI_REPORTER
{
   var $id;
   var $name;
   
   var $FETCH_ORDERS;
   var $orders_datefrom;
   var $orders_dateto;
   
   var $FETCH_LAMPS;
   var $lamps_datefrom;
   var $lamps_dateto;

   var $FETCH_MOUCHARDS;
   var $mouchards_datefrom;
   var $mouchards_dateto;
   
   var $number_of_reports;
   
   var $reports = array();
   var $report_columns = array();
   var $report_rows = array();

   var $output_data = array();
   var $output_mouchard_data = array();
   
   var $order_data=array();
   var $product_data=array();
   var $mouchard_data=array();   
   
   var $age_jour;
   var $limite_ligne;
   
    // fonction utilitaire ----------------
	function getExcelRef($xIndex) {
		if ( $xIndex == 1)
	      return "A";
		else if ( $xIndex == 2)
	      return "B";
	    else if ( $xIndex == 3)
	      return "C";
	    else if ( $xIndex == 4)
	      return "D";
	     else if ( $xIndex == 5)
	      return "E";
	     else if ( $xIndex == 6)
	      return "F";
	     else if ( $xIndex == 7)
	      return "G";
	     else if ( $xIndex == 8)
	      return "H";
	     else if ( $xIndex == 9)
	      return "I";
	     else if ( $xIndex == 10)
	      return "J";
	     else if ( $xIndex == 11)
	      return "K";
	     else if ( $xIndex == 12)
	      return "L";
	     else if ( $xIndex == 13)
	      return "M";
	     else if ( $xIndex == 14)
	      return "N";
	     else if ( $xIndex == 15)
	      return "O";
	     else if ( $xIndex == 16)
	      return "P";
	     else if ( $xIndex == 17)
	      return "Q";
	     else if ( $xIndex == 18)
	      return "R";
	     else if ( $xIndex == 19)
	      return "S";
	     else if ( $xIndex == 20)
	      return "T";
	     else if ( $xIndex == 21)
	      return "U";
	     else if ( $xIndex == 22)
	      return "V";
	     else if ( $xIndex == 23)
	      return "W";
	     else if ( $xIndex == 24)
	      return "X";
	     else if ( $xIndex == 25)
	      return "Y";
	     else if ( $xIndex == 26)
	      return "Z";
	     else if ( $xIndex == 27)
	      return "AA";
	     else if ( $xIndex == 28)
	      return "AB";
	     else if ( $xIndex == 29)
	      return "AC";
	     else if ( $xIndex == 30)
	      return "AD";
	     else if ( $xIndex == 31)
	      return "AE";
	     else if ( $xIndex == 32)
	      return "AF";
	     else if ( $xIndex == 33)
	      return "AG";
	     else if ( $xIndex == 34)
	      return "AH";
	     else if ( $xIndex == 35)
	      return "AI";
	     else if ( $xIndex == 36)
	      return "AJ";
	     else if ( $xIndex == 37)
	      return "AK";
	     else if ( $xIndex == 38)
	      return "AL";
	     else if ( $xIndex == 39)
	      return "AM";
	     else if ( $xIndex == 40)
	      return "AN";
	     else if ( $xIndex == 41)
	      return "AO";
	     else if ( $xIndex == 42)
	      return "AP";
	     else if ( $xIndex == 43)
	      return "AQ";
	     else if ( $xIndex == 44)
	      return "AR";
	     else if ( $xIndex == 45)
	      return "AS";
	     else if ( $xIndex == 46)
	      return "AT";
	     else if ( $xIndex == 47)
	      return "AU";
	     else if ( $xIndex == 48)
	      return "AV";
	     else if ( $xIndex == 49)
	      return "AW";
	     else if ( $xIndex == 50)
	      return "AX";
	     else if ( $xIndex == 51)
	      return "AY";
	     else if ( $xIndex == 52)
	      return "AZ";
	     else if ( $xIndex == 53)
	      return "BA";
	     else if ( $xIndex == 54)
	      return "BB";
	     else if ( $xIndex == 55)
	      return "BC";
	     else if ( $xIndex == 56)
	      return "BD";
	     else if ( $xIndex == 57)
	      return "BE";
	     else if ( $xIndex == 58)
	      return "BF";
	     else if ( $xIndex == 59)
	      return "BG";
	     else if ( $xIndex == 60)
	      return "BH";
	     else if ( $xIndex == 61)
	      return "BI";
	     else if ( $xIndex == 62)
	      return "BJ";
	     else if ( $xIndex == 63)
	      return "BK";
	     else if ( $xIndex == 64)
	      return "BL";
	     else if ( $xIndex == 65)
	      return "BM";
	     else if ( $xIndex == 66)
	      return "BN";
	     else if ( $xIndex == 67)
	      return "BO";
	     else if ( $xIndex == 68)
	      return "BP";
	     else if ( $xIndex == 69)
	      return "BQ";
	     else if ( $xIndex == 70)
	      return "BR";
	     else if ( $xIndex == 71)
	      return "BS";
	     else if ( $xIndex == 72)
	      return "BT";
	     else if ( $xIndex == 73)
	      return "BU";
	     else if ( $xIndex == 74)
	      return "BV";
	     else if ( $xIndex == 75)
	      return "BW";
	     else if ( $xIndex == 76)
	      return "BX";
	     else if ( $xIndex == 77)
	      return "BY";
	     else if ( $xIndex == 78)
	      return "BZ";
	     else if ( $xIndex == 79)
	      return "CA";
	     else if ( $xIndex == 80)
	      return "CB";
	     else if ( $xIndex == 81)
	      return "CC";
	     else if ( $xIndex == 82)
	      return "CD";
	     else if ( $xIndex == 83)
	      return "CE";
	     else if ( $xIndex == 84)
	      return "CF";
	     else if ( $xIndex == 85)
	      return "CG";
	     else if ( $xIndex == 86)
	      return "CH";
	     else if ( $xIndex == 87)
	      return "CI";
	     else if ( $xIndex == 88)
	      return "CJ";
	     else if ( $xIndex == 89)
	      return "CK";
	     else if ( $xIndex == 90)
	      return "CL";
	     else if ( $xIndex == 91)
	      return "CM";
	     else if ( $xIndex == 92)
	      return "CN";
	     else if ( $xIndex == 93)
	      return "CO";
	     else if ( $xIndex == 94)
	      return "CP";
	     else if ( $xIndex == 95)
	      return "CQ";
	     else if ( $xIndex == 96)
	      return "CR";
	     else if ( $xIndex == 97)
	      return "CS";
	     else if ( $xIndex == 98)
	      return "CT";
	     else if ( $xIndex == 99)
	      return "CU";
	     else if ( $xIndex == 100)
	      return "CV";
	     else if ( $xIndex == 101)
	      return "CW";
	     else if ( $xIndex == 102)
	      return "CX";
	     else if ( $xIndex == 103)
	      return "CY";
	     else if ( $xIndex == 104)
	      return "CZ";
	     else if ( $xIndex == 105)
	      return "DA";
	     else if ( $xIndex == 106)
	      return "DB";
	     else if ( $xIndex == 107)
	      return "DC";
	     else if ( $xIndex == 108)
	      return "DD";
	     else if ( $xIndex == 109)
	      return "DE";
	     else if ( $xIndex == 110)
	      return "DF";
	     else if ( $xIndex == 111)
	      return "DG";
	     else if ( $xIndex == 112)
	      return "DH";
	     else if ( $xIndex == 113)
	      return "DI";
	     else if ( $xIndex == 114)
	      return "DJ";
	     else if ( $xIndex == 115)
	      return "DK";
	     else if ( $xIndex == 116)
	      return "DL";
	     else if ( $xIndex == 117)
	      return "DM";
	     else if ( $xIndex == 118)
	      return "DN";
	     else if ( $xIndex == 119)
	      return "DO";
	     else if ( $xIndex == 120)
	      return "DP";
	     else if ( $xIndex == 121)
	      return "DQ";
	     else if ( $xIndex == 122)
	      return "DR";
	     else if ( $xIndex == 123)
	      return "DS";
	     else if ( $xIndex == 124)
	      return "DT";
	     else if ( $xIndex == 125)
	      return "DU";
	     else if ( $xIndex == 126)
	      return "DV";
	     else if ( $xIndex == 127)
	      return "DW";
	     else if ( $xIndex == 128)
	      return "DX";
	     else if ( $xIndex == 129)
	      return "DY";
	     else if ( $xIndex == 130)
	      return "DZ";
	     else if ( $xIndex == 131)
	      return "EA";
	     else if ( $xIndex == 132)
	      return "EB";
	     else if ( $xIndex == 133)
	      return "EC";
	     else if ( $xIndex == 134)
	      return "ED";
	     else if ( $xIndex == 135)
	      return "EE";
	     else if ( $xIndex == 136)
	      return "EF";
	     else if ( $xIndex == 137)
	      return "EG";
	     else if ( $xIndex == 138)
	      return "EH";
	     else if ( $xIndex == 139)
	      return "EI";
	     else if ( $xIndex == 140)
	      return "EJ";
	     else if ( $xIndex == 141)
	      return "EK";
	     else if ( $xIndex == 142)
	      return "EL";
	     else if ( $xIndex == 143)
	      return "EM";
	     else if ( $xIndex == 144)
	      return "EN";
	     else if ( $xIndex == 145)
	      return "EO";
	     else if ( $xIndex == 146)
	      return "EP";
	     else if ( $xIndex == 147)
	      return "EQ";
	     else if ( $xIndex == 148)
	      return "ER";
	     else if ( $xIndex == 149)
	      return "ES";
	     else if ( $xIndex == 150)
	      return "ET";
	     else if ( $xIndex == 151)
	      return "EU";
	     else if ( $xIndex == 152)
	      return "EV";
	     else if ( $xIndex == 153)
	      return "EW";
	     else if ( $xIndex == 154)
	      return "EX";
	     else if ( $xIndex == 155)
	      return "EY";
	     else if ( $xIndex == 156)
	      return "EZ";
	     else if ( $xIndex == 157)
	      return "FA";
	     else if ( $xIndex == 158)
	      return "FB";
	     else if ( $xIndex == 159)
	      return "FC";
	     else
	      return "B";
	}   
    function BI_REPORTER()
    {
        $this->FETCH_ORDERS = 0;
		$this->FETCH_LAMPS = 0;
		$this->number_of_reports = 0;
		$this->number_of_reports = 0;
		$this->age_jour = 0;
		$this->limite_ligne = 0;		
    }

    // }}}
    // {{{ destructor
    function _BI_REQUEST()
    {
    }
	//-----------------------------------------------------------------
	function load_reports()
	{
	    global $db;
        $sql="select sequence,
		             name,
	                 rowset_id,
					 columnset_id
			  from   bi_report 
			  where request_id =  " . $this->id;
        	
		$rs=$db->Execute($sql);
//echo '2'.$sql;		
		while (!$rs->EOF)
		{
//echo '3';		
			$this->number_of_reports++;

		    $this->reports['name'][$this->number_of_reports]=$rs->fields['name'];
//echo $rs->fields['name'];			
			$this->reports['rowset_id'][$this->number_of_reports]=$rs->fields['rowset_id'];
			$this->reports['columnset_id'][$this->number_of_reports]=$rs->fields['columnset_id'];
	  	    $rs->MoveNext();						
		}									   		 
	}  

    //------------------------------------
    function load_columns()
    {
	    // 
	    global $db;

	    for($i=1; $i<=$this->number_of_reports; $i++)
		{
	        $sql='SELECT id, name, 
			            metric, 
			            time_frame, 
						date_format(datefrom,"%Y%m%d") datefrom, 
						date_format(dateto,"%Y%m%d") dateto,
						date_format(DATE_ADD(subdate(now(), INTERVAL weekday(now()) DAY),INTERVAL -7 DAY),"%Y%m%d")  first_latest_week,
						date_format(DATE_ADD(adddate(now(), INTERVAL 6-weekday(now()) DAY),INTERVAL -6 DAY),"%Y%m%d")  last_latest_week						
				  FROM bi_column 
				  WHERE columnset_id='. $this->reports['columnset_id'][$i] .'
				  order by sequence';
//limit 1,1  ';
	        $j = 0;	
			$rs=$db->Execute($sql);
			while (!$rs->EOF)
			{
			    $j++;
			    $this->report_columns[$i]['name'][$j]=$rs->fields['name'];
				$this->report_columns[$i]['metric'][$j]=$rs->fields['metric'];
				if ( $this->report_columns[$i]['metric'][$j]==='lamp_sold_cnt' )
				{
				   $this->FETCH_LAMPS=1;
				}
				else if ( $this->report_columns[$i]['metric'][$j]==='ord_total' )
				{
				   $this->FETCH_ORDERS=1;
//echo "hello";exit;				   
				}
				else if ( $this->report_columns[$i]['metric'][$j]==='clic_cnt' )
				{
				   $this->FETCH_MOUCHARDS=1;
				}
//echo '<br>'.$this->report_columns[$i]['metric'][$j].'<br>';				
				$this->report_columns[$i]['time_frame'][$j]=$rs->fields['time_frame'];
				if ( $this->report_columns[$i]['time_frame'][$j] == 'latest_week' )
				{
				    $this->report_columns[$i]['datefrom'][$j]=$rs->fields['first_latest_week'] ;
				    $this->report_columns[$i]['dateto'][$j]=$rs->fields['last_latest_week'] ;									
				}
				else if  ( $this->report_columns[$i]['time_frame'][$j] == 'dates' )
				{
				    $this->report_columns[$i]['datefrom'][$j]=$rs->fields['datefrom'];								
				    $this->report_columns[$i]['dateto'][$j]=$rs->fields['dateto'];		
				}
		  	    $rs->MoveNext();						
			}
		}
    }  

    //------------------------------------
    function load_rows()
    {
	    global $db;
        include_once('includes/common_sets.php');
        include_once('el_fonctions_gestion.php');
		
	    for($i=1; $i<=$this->number_of_reports; $i++)
		{
//echo $this->reports['rowset_id'][$i].'rowset_id<br>';
		    if ( $this->reports['rowset_id'][$i] == 3 )
			{
			   if ( $this->age_jour> 0 )
			   {
			     $add_where = "  AND  ( DATE_SUB(CURDATE(),INTERVAL " . $this->age_jour  .  " DAY) <=  date_selection   )";
               }
			   
			   $sql = "select  manufacturer, lampe, sum(lampe_selectionnee)
			           from whos_online_digest 
					   where length(manufacturer)>0
					   and length(lampe)>0 ". $add_where . "
					   group by manufacturer, lampe
					   order by  sum(lampe_selectionnee) desc ";
//limit 1,90					   ";
echo $sql."<br>";
		        $j = 0;	
				$rs=$db->Execute($sql);
				while (!$rs->EOF)
				{
				    $j++;
				    $this->report_rows[$i]['name'][$j]=$rs->fields['manufacturer'].'  '.$rs->fields['lampe'];
					$this->report_rows[$i]['dimension1'][$j]="products_model";
					$this->report_rows[$i]['dimension1_values'][$j]=$rs->fields['lampe'];
					
					$this->report_rows[$i]['dimension2'][$j]="all";

					$rs->MoveNext();
                }
			}
		    else if ( $this->reports['rowset_id'][$i] == 4 )
			{
			   $sql = "SELECT customer_id, count( 1 )
						FROM `whos_online_digest`
						WHERE database_code = 'eu'
						AND  ( DATE_SUB(CURDATE(),INTERVAL " . $this->age_jour  .  " DAY) <=  date_selection   )
						AND customer_id >0
						GROUP BY customer_id
						ORDER BY count( 1 ) DESC
						";
				if ($this->limite_ligne>0)
				{
				   $sql .= "limit 1, ".$this->limite_ligne;
				}
//echo $sql;						
		        $j = 0;	
				$rs=$db->Execute($sql);
				while (!$rs->EOF)
				{
				    $j++;
					$dim_value = exec_select("select full_name value  from whos_online_digest where customer_id = ".$rs->fields['customer_id']);
				    $this->report_rows[$i]['name'][$j]=$dim_value;
					$this->report_rows[$i]['dimension1'][$j]="customer_id";					
					$this->report_rows[$i]['dimension1_values'][$j]=$rs->fields['customer_id'];
					
					$this->report_rows[$i]['dimension2'][$j]="all";

					$rs->MoveNext();
                }
			}			
			else
			{ // le cas normal
		        $sql='SELECT id,
							name,
							dimension1,
							dimension1_values,
							dimension2,
							dimension2_values
					  FROM bi_rowset_line 
					  WHERE rowset_id='. $this->reports['rowset_id'][$i] .'
					  order by sequence';
//echo '<br>'.$sql.'<br>';
		        $j = 0;	
				$rs=$db->Execute($sql);
				while (!$rs->EOF)
				{
				    $j++;
				    $this->report_rows[$i]['name'][$j]=$rs->fields['name'];
//echo 'nom'.$this->report_rows[$i]['name'][$j].'<br>';								
					$this->report_rows[$i]['dimension1'][$j]=$rs->fields['dimension1'];
					$this->report_rows[$i]['dimension1_values'][$j]=$rs->fields['dimension1_values'];
					
					$this->report_rows[$i]['dimension2'][$j]=$rs->fields['dimension2'];
//echo 'dim2'.$rs->fields['dimension2'];	
					$this->report_rows[$i]['dimension2_values'][$j]=$rs->fields['dimension2_values'];
					
					if ( $this->report_rows[$i]['dimension2'][$j]=="customers_country"  )
					{
					   $this->report_rows[$i]['dimension2_values'][$j]=$zone_geo_values[$this->report_rows[$i]['dimension2_values'][$j]];
//echo $this->report_rows[$i]['dimension2_values'][$j].'<br>';				   
					}
			  	    $rs->MoveNext();						
				}
			} // le cas normal
		}
    }  
	// ------------------------------------
    function load_detailed_data()
    {
	    global $db;    
		
		if ( $this->FETCH_ORDERS  )
		{
		   // ajouter une where clause -------------------
		   $sql = 'select o.customers_country,
		                  o.database_code,
		                  date_format(oi.invoice_date,"%Y%m%d") invoice_date,
						  (o.order_total-o.order_tax) totalht,
						  oi.invoice_type,
						  oi.orders_invoices_id,
						  o.customers_id
						  FROM orders o
							LEFT JOIN orders_total ot ON ( o.orders_id = ot.orders_id )
							LEFT OUTER JOIN orders_invoices oi ON ( o.orders_id = oi.orders_id )
							WHERE o.orders_id > 0 
							AND (
							ot.class = \'ot_total\'
							) AND oi.invoice_type IN (
							\'DB\', \'CR\'
							)';
            if ( $this->age_jour>0 )
            {
			   $sql .= "AND  ( DATE_SUB(CURDATE(),INTERVAL " . $this->age_jour  .  " DAY) <=  oi.invoice_date  )";
            }			
//echo '<br>'.$sql.'<br>';							
		   //  a compléter avec une restriction sur les dates
		   $rs = $db->Execute($sql);
		   $cnt_orders = 0;
		   while ( !$rs->EOF )
		   {
		      $cnt_orders++;
			  $this->order_data['customers_country'][$cnt_orders]=$rs->fields['customers_country'];
			  $this->order_data['database_code'][$cnt_orders]=$rs->fields['database_code'];
			  $this->order_data['customers_id'][$cnt_orders]=$rs->fields['customers_id'];
			  
			  if ($rs->fields['invoice_type']=="DB")
			     $multiplicateur = 1;
			  else
			     $multiplicateur = -1;
			     
			  $this->order_data['totalht'][$cnt_orders]=$rs->fields['totalht']*$multiplicateur;
			  $this->order_data['invoice_date'][$cnt_orders]=$rs->fields['invoice_date'];
			  $this->order_data['orders_invoices_id'][$cnt_orders]=$rs->fields['orders_invoices_id'];
			  
			  
		      $rs->MoveNext();
		   }		    
		}
		if ( $this->FETCH_LAMPS  )
		{
		   // ajouter une where clause -------------------
		   $sql = 'select o.customers_country,
		                  o.database_code,
						  o.customers_id,
		                  date_format(oi.invoice_date,"%Y%m%d") invoice_date,
						  (o.order_total-o.order_tax) totalht,
						  oi.invoice_type,
						  op.products_quantity,
						  op.final_price,
						  op.products_model
						  FROM orders o
							LEFT JOIN orders_products op ON ( o.orders_id = op.orders_id )						  
							LEFT JOIN orders_total ot ON ( o.orders_id = ot.orders_id )
							LEFT OUTER JOIN orders_invoices oi ON ( o.orders_id = oi.orders_id )		
							WHERE o.orders_id > 0 
							and length(products_model)>0
							and products_model not in (\'SHF\',\'CODF\',\'ECOF\',\'ESCF\',\'FRSH\',\'FRS\')
							AND (
							ot.class = \'ot_total\'
							) AND oi.invoice_type IN (
							\'DB\', \'CR\'
							)';
							
            if ( $this->age_jour>0 )
            {
			   $sql .= "AND  ( DATE_SUB(CURDATE(),INTERVAL " . $this->age_jour  .  " DAY) <=  oi.invoice_date  )";
            }			
							
		   //  a compléter avec une restriction sur les dates
		   $rs = $db->Execute($sql);
		   
		   $cnt_sold_products = 0;
		   while ( !$rs->EOF )
		   {
		      $cnt_sold_products++;
//echo "source".$rs->fields['customers_country'];exit;			  
			  $this->product_data['customers_country'][$cnt_sold_products]=$rs->fields['customers_country'];
//echo "source".$this->product_data['customers_country'][$cnt_sold_products];exit;			  			  
			  $this->product_data['database_code'][$cnt_sold_products]=$rs->fields['database_code'];
			  
			  if ($rs->fields['invoice_type']=="DB")
			     $multiplicateur = 1;
			  else
			     $multiplicateur = -1;
				 
			  $this->product_data['customers_id'][$cnt_sold_products]=$rs->fields['customers_id'];			     				 
			  $this->product_data['products_quantity'][$cnt_sold_products]=$rs->fields['products_quantity']*$multiplicateur;			     
			  $this->product_data['final_price'][$cnt_sold_products]=$rs->fields['final_price']*$multiplicateur;
			  $this->product_data['invoice_date'][$cnt_sold_products]=$rs->fields['invoice_date'];
			  $this->product_data['products_model'][$cnt_sold_products]=$rs->fields['products_model'];			     			  
			  
		      $rs->MoveNext();
		   }	// boucle while 	    
		}
		// 
		if ( $this->FETCH_MOUCHARDS  )
		{
		   // ajouter une where clause -------------------
		   if ( $this->id == 4 )
		   {
				$add_where = ' and database_code = "eu"  AND customer_id >0	';
		   }
		   $sql = 'select database_code,
		     	            date_selection,
		     	            customer_id,
		     	            full_name,
		     	            lampe_selectionnee cnt_clic, 								
		     	            lampe products_model
						  FROM whos_online_digest 
						  WHERE  length(manufacturer)>0
						  '. $add_where  . '
						   and length(lampe)>0 
						   and ( DATE_SUB(CURDATE(),INTERVAL ' . $this->age_jour . ' DAY) <=  date_selection )';
echo $sql."<br>";						  
		   //  a compléter avec une restriction sur les dates
		   $rs = $db->Execute($sql);
		   
		   $cnt_clics = 0;
		   while ( !$rs->EOF )
		   {
		      $cnt_clics++;
			  // $this->mouchard_data['customers_country'][$cnt_clics]=$rs->fields['customers_country'];
			  $this->mouchard_data['database_code'][$cnt_clics]=$rs->fields['database_code'];
			  $this->mouchard_data['customers_id'][$cnt_clics]=$rs->fields['customer_id'];			  				 
			  $this->mouchard_data['date_selection'][$cnt_clics]=$rs->fields['date_selection'];
			  $this->mouchard_data['cnt_clic'][$cnt_clics]=$rs->fields['cnt_clic'];
			  $this->mouchard_data['products_model'][$cnt_clics]=$rs->fields['products_model'];			     			  
			  
		      $rs->MoveNext();
		   }	// boucle while 	    
		}		
		
//		echo "cnt_orders".$cnt_orders;
    }  

	// ------------------------------------
    function prepare_data()
    {
	    global $db;    
		// pour chaque ligne et colonne ----------------------
		// foreach ((array)$_GET['orderlist'] as $k => $v ) 
	    for($i=1; $i<=$this->number_of_reports; $i++)
		{
//echo "aa<br>";
		   if (  (  $this->id == 3 ) ||  (  $this->id == 4 ) ) // exception MOUCHARD
		   {
			    // pour chaque colonne
				for ( $l=1; $l <=count($this->report_columns[$i]['name']);$l++ ) 
				{				
				    if ($this->report_columns[$i]['metric'][$l]=='lamp_sold_cnt')
					{
					   // on scrolle les orders-item 
//echo 'in';		   				   
					    for( $m=1; $m <=count($this->product_data['products_quantity']);$m++ ) 
						{
//echo 'amodèle'.$this->product_data['products_model'][$m].'..<br>';						
                            if (  $this->id == 3 )
								$this->output_mouchard_data[$i][$l][$this->product_data['products_model'][$m]]+=$this->product_data['products_quantity'][$m];
							else if (  $this->id == 4 )
								$this->output_mouchard_data[$i][$l][$this->product_data['customers_id'][$m]]+=$this->product_data['products_quantity'][$m];							

//echo  '//'.$this->product_data['customers_id'][$m].'\\<br>';

					
//echo 'ajout'.$this->product_data['products_quantity'][$m].'..<br>';							
					    }					   
					}
					else if ($this->report_columns[$i]['metric'][$l]=='clic_cnt')
					{
					   // on scrolle les orders-item 
					    for( $m=1; $m <=count($this->mouchard_data['products_model']);$m++ ) 
						{
// echo 'amodèle'.$this->mouchard_data['products_model'][$m].'..<br>';												
// echo 'ajout'.$this->mouchard_data['cnt_clic'][$m].'..<br>';							
                            if (  $this->id == 3 )
								$this->output_mouchard_data[$i][$l][$this->mouchard_data['products_model'][$m]]+=$this->mouchard_data['cnt_clic'][$m];
							else if (  $this->id == 4 )
								$this->output_mouchard_data[$i][$l][$this->mouchard_data['customers_id'][$m]]+=$this->mouchard_data['cnt_clic'][$m];															
					    }					   					   
					}					
					// pour toutes les lignes on récupère la valeur
					for($k=1;$k<=count($this->report_rows[$i]['name']);$k++) 
					{
					    if ($this->report_columns[$i]['metric'][$l]=='lamp_sold_cnt')
						{					
							$this->output_data[$i][$k][$l]=$this->output_mouchard_data[$i][$l][$this->report_rows[$i]['dimension1_values'][$k]];
//echo "ligne ". $k . ' modèle  ' .$this->report_rows[$i]['dimension1_values'][$k] . '   valeur:   '.$this->output_mouchard_data[$i][$this->report_rows[$i]['dimension1_values'][$k]];
//echo 'kk'.$this->report_rows[$i]['dimension1_values'][$k].'ll<br>';
						}					
					    if ($this->report_columns[$i]['metric'][$l]=='clic_cnt')
						{					
						   $this->output_data[$i][$k][$l]=$this->output_mouchard_data[$i][$l][$this->report_rows[$i]['dimension1_values'][$k]];
//echo "ligne ". $k . ' modèle  ' .$this->report_rows[$i]['dimension1_values'][$k] . '   valeur:   '.$this->output_mouchard_data[$i][$this->report_rows[$i]['dimension1_values'][$k]];
						}											
					}					
		        }				
		   }
		   else 
		   { // cas nominal
			for($k=1;$k<=count($this->report_rows[$i]['name']);$k++) 
			{
//echo  '-D01-'.$this->report_rows[$i]['dimension1'][$k].'.D02.'.$this->report_rows[$i]['dimension2'][$k].'<br>';																			   			
			    // pour chaque colonne
				for ( $l=1; $l <=count($this->report_columns[$i]['name']);$l++ ) 
				{				
				    if ($this->report_columns[$i]['metric'][$l]=='ord_total')
					{
					    // on balaye  les valeurs du CA
					    for( $m=1; $m <=count($this->order_data['totalht']);$m++ ) 
						{
						    // vérifier ici l'espace des dates
							$value_ok = 1;
//echo 	'<br>||'.$this->report_columns[$i]['datefrom'][$l].',,'.$invoice_date.',,'.$this->report_columns[$i]['dateto'][$l];							
							$invoice_date = $this->order_data['invoice_date'][$m];
							if ( ( $invoice_date > $this->report_columns[$i]['dateto'][$l] )
							     ||   $invoice_date < $this->report_columns[$i]['datefrom'][$l] )
							{
							    $value_ok=0;
//echo 'bad date';								
							}
else							
							{
							    $value_ok=1;
//echo 'good date';								
							}

							if ($value_ok)
							{						    
//echo  $this->report_rows[$i]['dimension1'][$k].'<br>';										
							    if($this->report_rows[$i]['dimension1'][$k]<>'all')
								{
								   $valeurs = $this->report_rows[$i]['dimension1_values'][$k];
								   $valeur = $this->order_data[$this->report_rows[$i]['dimension1'][$k]][$m];
// echo $valeurs.'/'.$valeur.'|<br>';
								   if (strpos($valeurs,$valeur)==0)
								   {
									  $value_ok = 0;
								   }
								   else
								   {
	                                   // test de la dimension 2							   
//echo  '-D1-'.$this->report_rows[$i]['dimension1'][$k].'.D2.'.$this->report_rows[$i]['dimension2'][$k].'<br>';																			   
									    if($this->report_rows[$i]['dimension2'][$k]<>'all')
										{
//echo 'dans le test dim2';										
										   $valeurs = $this->report_rows[$i]['dimension2_values'][$k];
										   $valeur = $this->order_data[$this->report_rows[$i]['dimension2'][$k]][$m];
// echo 'total'.$valeurs.'/'.$valeur.'|<br>';
										   if (strpos($valeurs,$valeur)==0)
										   {
											  $value_ok = 0;
										   }										   
										}									   									   
								   }								   
								}
								else
								{
//echo 'pas de critere dim';								
								}
							} // if $value_ok sur les dates ..
							
						   if ( $value_ok == 1 )
						   {
//echo '.ok.';						   
								$this->output_data[$i][$k][$l]+=$this->order_data['totalht'][$m];
//echo "<br>OUI|".$this->order_data['invoice_date']."|".$this->order_data['orders_invoices_id']."|".$this->order_data['totalht'];									
						   }
						   else
						   {
//echo "<br>NON|".$this->order_data['invoice_date']."|".$this->order_data['orders_invoices_id']."|".$this->order_data['totalht'];									
						   }							
						}
					}  // scroll sur le order total
					// exeption  pour les produit en mouchard
					if ($this->report_columns[$i]['metric'][$l]=='lamp_sold_cnt')
					{
//echo 	'lamp_sold_cnt<br>';
					    // on balaye  les valeurs du CA
					    for( $m=1; $m <=count($this->product_data['products_quantity']);$m++ ) 
						{
						    // vérifier ici l'espace des dates
							$value_ok = 1;
//echo 	'<br>||'.$this->report_columns[$i]['datefrom'][$l].',,'.$invoice_date.',,'.$this->report_columns[$i]['dateto'][$l];							
							$invoice_date = $this->product_data['invoice_date'][$m];
							if ( ( $invoice_date > $this->report_columns[$i]['dateto'][$l] )
							     ||   $invoice_date < $this->report_columns[$i]['datefrom'][$l] )
							{
							    $value_ok=0;
//echo 'bad date';								
							}
							else							
							{
							    $value_ok=1;
//echo 'good date';								
							}

							if ($value_ok)
							{						    
//echo '?'.$this->report_rows[$i]['dimension1'][$k].'?';							
							    if($this->report_rows[$i]['dimension1'][$k]<>'all')
								{
								   $valeurs = $this->report_rows[$i]['dimension1_values'][$k];
								   $valeur = $this->product_data[$this->report_rows[$i]['dimension1'][$k]][$m];
								   
//echo $this->report_rows[$i]['name'][$k];								   
//   echo $valeurs.'/'.$valeur.'|<br>'; 78-6966-9917-2
//echo 	'/'.$valeur.'|<br>';
//   echo strpos($valeurs,$valeur).'%';
                                   if (strlen($valeur)>0)
								       $position = strpos('-'.$valeurs,$valeur);
								   else
								       $position = 0;								   
								   
								   if ($position==0)
								   {
									  $value_ok = 0;
								   }
								   else
								   {
								        // test de la dimension 2
									    if($this->report_rows[$i]['dimension2'][$k]<>'all')
										{
//echo 'dans le test dim2';										
										   $valeurs = $this->report_rows[$i]['dimension2_values'][$k];
										   $valeur = $this->product_data[$this->report_rows[$i]['dimension2'][$k]][$m];
// echo 'prd$'.$this->report_rows[$i]['dimension2'][$k].'$'.$valeurs.'/'.$valeur.'|<br>';
										   if (strpos($valeurs,$valeur)==0)
										   {
											  $value_ok = 0;
										   }										   
										}
								   }
								   
								}
								else
								{
//echo 'pas de critere dim';								
								}
							} // if $value_ok sur les dates ..
							
						   if ( $value_ok == 1 )
						   {
//echo '.ok.';						   
								$this->output_data[$i][$k][$l]+=$this->product_data['products_quantity'][$m];							      
						   }
						   else
						   {
//echo '.ko.';						   						   
						   }							
						}
					}		// compte des ventes produit
				    if ($this->report_columns[$i]['metric'][$l]=='clic_cnt')
					{
//echo 	'lamp_sold_cnt<br>';
					    // on balaye  les valeurs du CA
					    for( $m=1; $m <=count($this->mouchard_data['products_model']);$m++ ) 
						{
						    // vérifier ici l'espace des dates
							$value_ok = 1;
//echo 	'<br>||'.$this->report_columns[$i]['datefrom'][$l].',,'.$date_selection.',,'.$this->report_columns[$i]['dateto'][$l];							
							$date_selection = $this->mouchard_data['date_selection'][$m];
							if ( ( $date_selection > $this->report_columns[$i]['dateto'][$l] )
							     ||   $date_selection < $this->report_columns[$i]['datefrom'][$l] )
							{
							    $value_ok=0;
//echo 'bad date';								
							}
							else							
							{
							    $value_ok=1;
//echo 'good date';								
							}

							if ($value_ok)
							{						    
//echo '?'.$this->report_rows[$i]['dimension1'][$k].'?';							
							    if($this->report_rows[$i]['dimension1'][$k]<>'all')
								{
								   $valeurs = $this->report_rows[$i]['dimension1_values'][$k];
								   $valeur = $this->mouchard_data[$this->report_rows[$i]['dimension1'][$k]][$m];

//echo $this->report_rows[$i]['name'][$k];								   
// echo $valeurs.'/'.$valeur.'|<br>';
//echo 	'/'.$valeur.'|<br>';
//   echo strpos($valeurs,$valeur).'%';
								   
                                   if (strlen($valeur)>0)
								       $position = strpos('-'.$valeurs,$valeur);
								   else
								       $position = 0;								   
									   
								   if ($position==0)
								   {
									  $value_ok = 0;
								   }
								   else
								   {
								        // test de la dimension 2
									    if($this->report_rows[$i]['dimension2'][$k]<>'all')
										{
//echo 'dans le test dim2';										
										   $valeurs = $this->report_rows[$i]['dimension2_values'][$k];
										   $valeur = $this->mouchard_data[$this->report_rows[$i]['dimension2'][$k]][$m];
// echo 'prd$'.$this->report_rows[$i]['dimension2'][$k].'$'.$valeurs.'/'.$valeur.'|<br>';
										   if (strpos($valeurs,$valeur)==0)
										   {
											  $value_ok = 0;
										   }										   
										}
								   }
								   
								}
								else
								{
//echo 'pas de critere dim';								
								}
							} // if $value_ok sur les dates ..
							
						   if ( $value_ok == 1 )
						   {
//echo '.ok.';						   
								$this->output_data[$i][$k][$l]+=$this->mouchard_data['cnt_clic'][$m];							      
						   }
						   else
						   {
//echo '.ko.';						   						   
						   }							
						}
					} // compte des click			
					echo 'k: '. $k . '  l: ' . $l . '  / '.date('H:i:s').'<br>';
	            }			    
			}
			//pour chaque colonne
		  }  // request exeptionnelle
        }		

    }  
	// ------------------------------------		
    function print_reports()	
    {
		require_once 'phpExcel/Classes/PHPExcel/IOFactory.php';
		require_once  'phpExcel/Classes/PHPExcel/RichText.php';
		require_once  'phpExcel/Classes/PHPExcel.php';


		$objPHPExcel = new PHPExcel();

		// Set properties
		echo date('H:i:s') . " Set properties\n<br>";
		$objPHPExcel->getProperties()->setCreator("Maarten Balliauw");
		$objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
		$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
		$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
		$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
		$objPHPExcel->getProperties()->setKeywords("office 2007 openxml php");
		$objPHPExcel->getProperties()->setCategory("Test result file");

		$number_of_worksheets = 0;
        for ($i=1;$i<=$this->number_of_reports;$i++)		
		{
  		   $number_of_worksheets++;
		   
           // au besoin création de la worksheet 
		   if ($number_of_worksheets>1)
		   {
				$objPHPExcel->createSheet();
				$objPHPExcel->setActiveSheetIndex($number_of_worksheets-1);
		   }
		   $objPHPExcel->getActiveSheet()->setTitle($this->reports['name'][$i]);
		   
		   $nb_lignes_entete = 0;
		   // on affiche l'entête du rapport
           // 
           if ($this->age_jour>0)
           {
		       $nb_lignes_entete++;
		       $titre_produit_le = "Rapport produit le: ". exec_select ( "select date_format(now(),\"%d/%c/%Y %H:%i\") value" );
		       $objPHPExcel->getActiveSheet()->setCellValue("A".$nb_lignes_entete, $titre_produit_le );
			   
		       $nb_lignes_entete++;
		       $titre_produit_le = "Donnees a partir de: ". exec_select ( "select date_format(DATE_ADD(subdate(now(), INTERVAL weekday(now()) DAY),INTERVAL - ". $this->age_jour ."  DAY),\"%d/%c/%Y %H:%i\") value" );
		       $objPHPExcel->getActiveSheet()->setCellValue("A".$nb_lignes_entete, $titre_produit_le );
           }		   
    	   $nb_lignes_entete++;
		   $nb_lignes_entete++;
		   
		   // on popule les rapport
		   // on affiche les entetes de colonne  --
	        for ($j=1;$j<=count($this->report_columns[$i]['name']);$j++)		
			{
				$objPHPExcel->getActiveSheet()->setCellValue($this->getExcelRef($j+1).$nb_lignes_entete, $this->report_columns[$i]['name'][$j]);			   
			}
		  			
 		    // pour chaque ligne 
			$objPHPExcel->getActiveSheet()->getColumnDimension("A")->setWidth(22);			
	        for ($k=1;$k<=count($this->report_rows[$i]['name']);$k++)		
			{			   
			   // entête de ligne --
				$objPHPExcel->getActiveSheet()->setCellValue("A".($k+$nb_lignes_entete), $this->report_rows[$i]['name'][$k]);		
                // pour chaque colonne on renvoie les data: 
		        for ($l=1;$l<=count($this->report_columns[$i]['name']);$l++)		
				{					
				    // le coeur des outputs
					$objPHPExcel->getActiveSheet()->setCellValue($this->getExcelRef($l+1).($k+$nb_lignes_entete), $this->output_data[$i][$k][$l] );						
				}
			}		   		   
		}
		// on affiche le détail des factures
		
		echo date('H:i:s') . " Write to Excel format\n<br>";
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$filename= "../outputs/".date('d-m-y_H-i-s') . '.xls'; 

		$objWriter->save($filename);
	
	    return $filename;
	
/*	
		require('excel/CWorksheet.class.php');
		require('excel/CWorkbook.class.php');

		$filename= date('d-m-y_H-i-s') . '.xls'; 
		
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=$filename" );
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
		header("Pragma: public");

		$workbook = new CWorkbook("-");	  
		$worksheet =& $workbook->add_worksheet("extraction");
				
		// pour chaque rapport on créer un onglet 
		// pour chaque datasource on crée un onglet
		
		
		// on popule les données
		
		// sauvegarde et renvoi du nom du fichier
		$workbook->close();     
		*/
    }	
	
	// ------------------------------------		
    function do_request($p_request_id)
    {
	    global $db;    
		$this->id=$p_request_id;
		$this->load_reports();
		$this->load_columns();
		$this->load_rows();
		$this->load_detailed_data();
		$this->prepare_data();
		$filename = $this->print_reports();
		
		return ($filename);
    }
}	
?>