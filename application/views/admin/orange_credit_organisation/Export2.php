<?php
/*
* =======================================================================
* FILE NAME:        Export2.php
* DATE CREATED:  	15-04-2020
* FOR TABLE:  		orange_credit_organisation
* PRODUCED BY:		SIMILLUSTRA  PHP CODE GENERATOR
* AUTHOR:			Simillustra (http://simillustra.com) info@simillustra.com
* =======================================================================
*/
if (!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
?>
<?php
$etype = get('etype');
$excel = '
	<p style="font-family:arial; font-size:18px;" align="left">
	<strong style="font-family:arial;">' . LANG_REPORT_TITLE . '</strong><br>' . LANG_REPORT_SUB_TITLE . '<br>
	<strong>' . LANG_REPORT_TABLE . '</strong> Orange Credit Organisation</p>';
$excel .= '
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Organisation Name</td>
	<td>' . $rows->organisation_name . '</td>
  	</tr>
    <tr>
	<td>Organisation Address</td>
	<td>' . $rows->organisation_address . '</td>
  	</tr>
    <tr>
	<td>Organisation Phone</td>
	<td>' . $rows->organisation_phone . '</td>
  	</tr>
    <tr>
	<td>Organisation Email</td>
	<td>' . $rows->organisation_email . '</td>
  	</tr>
    <tr>
	<td>Organisation Logo</td>
	<td>' . $rows->organisation_logo . '</td>
  	</tr>
    <tr>
	<td>Organisation Bank Name</td>
	<td>' . $rows->organisation_bank_name . '</td>
  	</tr>
    <tr>
	<td>Organisation Account Number</td>
	<td>' . $rows->organisation_account_number . '</td>
  	</tr>
    <tr>
	<td>Organisation Status</td>
	<td>' . $rows->organisation_status . '</td>
  	</tr>
    <tr>
	<td>Organisation CreatedAt</td>
	<td>' . $rows->organisation_createdAt . '</td>
  	</tr>
    <tr>
	<td>Organisation ModifiedAt</td>
	<td>' . $rows->organisation_modifiedAt . '</td>
  	</tr>
    <tr>
	<td>Userid</td>
	<td>' . $rows->userid . '</td>
  	</tr>';
$excel .= '</table>';

$filename1 = 'orange_credit_organisation_' . date('Y-m-d') . '.doc';
$filename2 = 'orange_credit_organisation_' . date('Y-m-d') . '.xls';
$pdf_output = 'orange_credit_organisation_' . date('Y-m-d') . '.pdf';
if ($etype == 'word') {
    header("Content-type: application/msword");
    header("Content-Disposition: attachment; filename=$filename1");
    header("Pragma: no-cache");
    header("Expires: 0");
    print $excel;
} elseif ($etype == 'excel') {
    header("Content-type: application/msexcel");
    header("Content-Disposition: attachment; filename=$filename2");
    header("Pragma: no-cache");
    header("Expires: 0");
    print $excel;
} elseif ($etype == 'printer') {
    print'<title>' . H_TITLE . '</title>
	<script type="text/javascript">
	window.onload = function () {
		window.print();
	}
	</script>
	';
    print $excel;
}
	