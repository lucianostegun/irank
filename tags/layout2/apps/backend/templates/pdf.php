<?php
$reportName      = (isset($reportName)?$reportName:'');
$fileName        = (isset($fileName)?$fileName:'');
$pageOrientation = (isset($pageOrientation)?$pageOrientation:'P');

$options = array();
$options['reportName']      = $reportName;
$options['headerContent']   = 'Emissão: '.date('d/m/Y H:i:s');
$options['pageOrientation'] = $pageOrientation;
ob_start();
?>
<style>
* {
	font-size: 8pt
}

.reportTable {

	margin-top: 	15px;
}

.reportTable td {

	border-bottom: 		1px solid #888888;
	border-right: 		1px solid #DDDDDD;
	padding-top: 		3px;
	padding-bottom: 	3px;
}

.reportTable .last {

	border-bottom: 		1px solid #888888;
	border-right: 		0px solid #FFFFFF;
	padding-top: 		3px;
	padding-bottom: 	3px;
}

.reportTable .totalRow {

	border: 			1px solid #AAAAAA;
	padding: 			5 15 5 15;
	background: 		#F0F0F0;
	font-weight: 		bold;
}
</style>
<table width="100%">
	<tr>
		<td style="padding: 15px; border-top: 2px solid #666666; border-bottom: 2px solid #666666">
			<?php echo $sf_content ?>
		</td>
	</tr>
</table>
<?php
	$content = ob_get_clean();
	Report::buildPDF($content, $fileName, $options);
	exit;
?>