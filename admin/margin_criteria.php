<?php
  require('includes/application_top.php');
  require('el_fonctions_gestion.php');
  global $db;
  $db->connect($ext_db_server["po"], $ext_db_username["po"], $ext_db_password["po"], $ext_db_database["po"], USE_PCONNECT, false);  

echo '
<html>
<body>
<br>
<br>
<form name="frm">
Dates:';

$sql = 'select distinct treatment_date code, treatment_date description
	  from   orders
	  order by treatment_date desc
	  limit 0,80';

echo  get_select ( $sql , 'treatment_date', '', '','', '' );


echo '
<br><br>
sites<br>
<select name=sites size=11>
<option>tous
<option>eu
<option>fr
<option>es
<option>en
<option>de
<option>it
<option>pl
<option>bf
<option>tb
<option value=hp>hpl
<option value=rq>rqdl
</select>

<br>
CMD #<br>
<input type="text" name="enforce_orders_id" size=3>
<br><br>An/Mois<br>
<input type="text" name="year" size=3 value="2012">
<input type="text" name="month" size=1 value="1">
<br>
Jour <input type="text" name="day" size=2 value="">
<br><br>
canal<br>
<select name=canal size=3>
<option>tous
<option>mkp
<option>direct
</select>
<br><br>
</form>
</body>
</html>
	';
?>