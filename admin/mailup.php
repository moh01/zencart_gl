<?php

function mailup_mail($to, $mailID, $parameters){
	$url = 'http://www.easylamps.eu:9000/send-mail';
	$fields = array_merge(array('mail-id' => $mailID, 'email-adress' => $to), $parameters);

	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$result = curl_exec($ch);
	curl_close($ch);
}
?>

