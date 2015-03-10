<?php
  require('includes/application_top.php');
  global $db;
  global $ext_bd_root;
  global $ext_db_name;
  
	require_once("http.class.php");
	$http =& new CHttp();
	$url = "http://linats.net/admin/infos_cmde.php";
	$response = $http->GetRequestArguments($url, $arguments);

	$source_db="eu";


	$arguments['RequestMethod'] = 'POST';

	$arguments["PostValues"] = array("source_db" => $_GET['source_db'],
	   "orders_id"=> $_GET['orders_id'] );

	$error = $http->Open($arguments);
	$error = $http->SendRequest($arguments);
	$error = $http->ReadReplyBody($body, 64000);

	 require('_obj_email.php');

	 $spam = new EMAIL;		  
	 $spam->set_email_language(2);  		   		   
	 $spam->set_sender_name($ext_bd_name[$_GET['source_db']],2);
	 $sender_email = 'info@'.str_replace('http://www.','',$ext_bd_root[$_GET['source_db']]);
	 $spam->set_sender_email_address( $sender_email );
	 $spam->set_email_title('Confimation de commande ' . $_GET['orders_id'],2);
	 $spam->set_email_content($body,2);

	 
	 $spam->set_receiver_email_address( 'fvaron@easylamps.fr' );
	 $spam->send_email();

	 echo '<html><body><script>top.document.location="http://linats.net/admin/el_orders.php?oID=0&action=edit&force_db='.$_GET['source_db'].'";</script></body></html>';
	 
	 
?>