<?php
/**
 * whos_online functions
 *
 * @package functions
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: whos_online.php 4134 2006-08-14 00:40:21Z drbyte $
 */
/**
 * zen_update_whos_online
 */
function zen_update_whos_online() {
  global $db;

  if (isset($_SESSION['customer_id']) && $_SESSION['customer_id']) {
    $wo_customer_id = $_SESSION['customer_id'];

    $customer_query = "select customers_firstname, customers_lastname
                         from " . TABLE_CUSTOMERS . "
                         where customers_id = '" . (int)$_SESSION['customer_id'] . "'";

    $customer = $db->Execute($customer_query);

    $wo_full_name = $customer->fields['customers_lastname'] . ', ' . $customer->fields['customers_firstname'];
  } else {
    $wo_customer_id = '';
    $wo_full_name = '&yen;' . 'Guest';
  }

  $wo_session_id = zen_session_id();
  $wo_ip_address = (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'Unknown');
  $wo_user_agent = zen_db_prepare_input($_SERVER['HTTP_USER_AGENT']);

	$_SERVER['QUERY_STRING'] = (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != '') ? $_SERVER['QUERY_STRING'] : zen_get_all_get_params();
  if (isset($_SERVER['REQUEST_URI'])) {
    $uri = $_SERVER['REQUEST_URI'];
   } else {
    if (isset($_SERVER['QUERY_STRING'])) {
     $uri = $_SERVER['PHP_SELF'] .'?'. $_SERVER['QUERY_STRING'];
    } else {
     $uri = $_SERVER['PHP_SELF'] .'?'. $_SERVER['argv'][0];
    }
  }
  if (substr($uri, -1)=='?') $uri = substr($uri,0,strlen($uri)-1);
  $wo_last_page_url = (zen_not_null($uri) ? $uri : 'Unknown');

  $current_time = time();
  $xx_mins_ago = ($current_time - 900);

  // remove entries that have expired
  if ( $_SERVER['SERVER_NAME'] == 'www.easylamps.eu' )
  {
	  $db->Execute("
					insert into whos_online_bckp 
	                select * from " . TABLE_WHOS_ONLINE . "
	                where  last_page_url like '%[%' 
					and time_last_click < '" . $xx_mins_ago . "'");	
  }				
  $sql = "delete from " . TABLE_WHOS_ONLINE . "
          where time_last_click < '" . $xx_mins_ago . "'";

  $db->Execute($sql);

  $stored_customer_query = "select count(*) as count
                              from " . TABLE_WHOS_ONLINE . "
                              where session_id = '" . zen_db_input($wo_session_id) . "' and ip_address='" . zen_db_input($wo_ip_address) . "'";

  $stored_customer = $db->Execute($stored_customer_query);

  if (empty($wo_session_id)) {
    $wo_full_name = '&yen;' . 'Spider';
  }

  if ($stored_customer->fields['count'] > 0) {

  if ( $_SERVER['SERVER_NAME'] == 'www.easylamps.eu' )
  {
	  $db->Execute("insert into whos_online_bckp 
	                select * from " . TABLE_WHOS_ONLINE . "
	                where last_page_url like '%[%'
					and session_id = '" . zen_db_input($wo_session_id) . "' and ip_address='" . zen_db_input($wo_ip_address) . "'");	
  }
  $parse_url = zen_db_input($wo_last_page_url);


//echo strpos( $parse_url, 'cPath');exit;
$content_indicator =  zen_db_input($wo_last_page_url);

if ( strpos( $parse_url, 'cPath')  ) 			
{
    $end_of_url = substr($parse_url,strpos( $parse_url, 'cPath') + 6 , 1000 );

if ( strpos( $end_of_url, '_')  )
{
	  $end_of_url = str_replace('&language=fr','',$end_of_url);
	  $end_of_url = str_replace('&language=es','',$end_of_url);
	  $end_of_url = str_replace('&language=de','',$end_of_url);
	  $end_of_url= str_replace('&language=en','',$end_of_url);
	  $end_of_url = str_replace('&language=it','',$end_of_url);

   $vp_id = substr($end_of_url,strpos( $end_of_url, '_') + 1 , 1000 );
  
 	     $vp_query = "select cat.categories_id, 
				      catd.categories_name vp,
			          ctrd.categories_name cstr
		         from   categories as cat,  
		                      categories as ctr,   
		                      categories_description as catd,
		                      categories_description as ctrd
		               where  cat.categories_id = catd.categories_id
		               and    cat.parent_id = ctr.categories_id
		               and    ctrd.categories_id = ctr.categories_id
					   and    cat.categories_id = " . $vp_id ;
					   
      if ($products = $db->Execute($vp_query)) {

        $cstr = $products->fields['cstr'];
        $vp = $products->fields['vp'];
        $content_indicator  = '['. $vp_id . ']' . $cstr . '-' . $vp  ;
		
      }		
}

$parse_url = $end_of_url;	
}


//echo zen_db_input($wo_last_page_url);
  
    $sql = "update " . TABLE_WHOS_ONLINE . "
              set customer_id = '" . (int)$wo_customer_id . "',
                  full_name = '" . zen_db_input($wo_full_name) . "',
                  ip_address = '" . zen_db_input($wo_ip_address) . "',
                  time_last_click = '" . zen_db_input($current_time) . "',
                  last_page_url = '" .  $content_indicator . "',
                  host_address = '" . zen_db_input($_SESSION['customers_host_address']) . "',
                  user_agent = '" . zen_db_input($wo_user_agent) . "'
              where session_id = '" . zen_db_input($wo_session_id) . "' and ip_address='" . zen_db_input($wo_ip_address) . "'";

    $db->Execute($sql);

  } else {
    $sql = "insert into " . TABLE_WHOS_ONLINE . "
                (customer_id, full_name, session_id, ip_address, time_entry,
                 time_last_click, last_page_url, host_address, user_agent)
              values ('" . (int)$wo_customer_id . "', '" . zen_db_input($wo_full_name) . "', '"
                         . zen_db_input($wo_session_id) . "', '" . zen_db_input($wo_ip_address)
                         . "', '" . zen_db_input($current_time) . "', '" . zen_db_input($current_time)
                         . "', '" . $content_indicator
                         . "', '" . zen_db_input($_SESSION['customers_host_address'])
                         . "', '" . zen_db_input($wo_user_agent)
                         . "')";

    $db->Execute($sql);
  }
}

function whos_online_session_recreate($old_session, $new_session) {
  global $db;

  $sql = "UPDATE " . TABLE_WHOS_ONLINE . "
          SET session_id = :newSessionID 
          WHERE session_id = :oldSessionID";
  $sql = $db->bindVars($sql, ':newSessionID', $new_session, 'string'); 
  $sql = $db->bindVars($sql, ':oldSessionID', $old_session, 'string'); 
  $db->Execute($sql);
}
?>