<?php
echo '
<script>
function push()
{
document.frm.enforce_orders_id.value=top.margin_criteria.document.frm.enforce_orders_id.value;
alert (document.frm.enforce_orders_id.value;
document.frm.treatment_date.value=top.margin_criteria.document.frm.treatment_date.value;
document.frm.sites.value=top.margin_criteria.document.frm.sites.value;
document.frm.submit();
}
</script>
';

echo '
<table>
<tr>
<td>
<form name="frm3" method="get" action="margin_summary.php" target="content">
<input type="hidden" name=treatment_date>
<input type="hidden" name=sites>
<input type="hidden" name=canal>
<input type="hidden" name=month>
<input type="hidden" name=year>
<input type="hidden" name=day>
<input type="hidden" value="0" name=montant>
<input type="hidden" name="vacherin" value=0>
<a href="javascript:document.frm3.year.value=top.margin_criteria.document.frm.year.value;document.frm3.month.value=top.margin_criteria.document.frm.month.value;document.frm3.day.value=top.margin_criteria.document.frm.day.value;document.frm3.submit();">Somm. Pièces</a>
&nbsp;&nbsp;&nbsp;
<a href="javascript:document.frm3.year.value=top.margin_criteria.document.frm.year.value;document.frm3.month.value=top.margin_criteria.document.frm.month.value;document.frm3.day.value=top.margin_criteria.document.frm.day.value;;document.frm3.montant.value=1;document.frm3.submit();">Somm. Montant</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

</form>
</td>
<td>
<form name="frm" method="get" action="margin_entry.php" target="content">
<input type="hidden" name=treatment_date>
<input type="hidden" name=sites>
<input type="hidden" name=canal>
<input type="hidden" name=enforce_orders_id>
<input type="hidden" name="vacherin" value=0>
<a href="el_margins.php" target="content">Sommaire</a>
&nbsp;&nbsp;&nbsp;<a href="javascript:document.frm.vacherin.value=0;push();">Data input</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:document.frm.vacherin.value=1;push();">LOCC</a>
&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:document.frm.vacherin.value=10;push();">RPT</a>
</form>
</td>
<td>
<form name="frm4" method="get" action="daily_mail.php" target="content">
<input type="hidden" name=treatment_date>
<input type="hidden" name=sites>
<input type="hidden" name=canal>
<input type="hidden" name=month>
<input type="hidden" name=year>
<input type="hidden" name="vacherin" value=0>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:document.frm4.treatment_date.value=top.margin_criteria.document.frm.treatment_date.value;document.frm4.submit();">Mail</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</form>
</td>


	';
?>