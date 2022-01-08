<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<?php
sfConfig::set('sf_web_debug', false);
include_http_metas();
include_metas();
include_title();

$pageOrientation = (isset($pageOrientation)?$pageOrientation:'P');
$pageWidth       = ($pageOrientation=='P'?'750':'1050');
?>
<script type="text/javascript">
	var _isDebug    = <?php echo Util::isDebug()?'true':'false'; ?>;
</script>
</head>
<body>
	<table border="0" cellpadding="0" cellspacing="0" style="width: <?php echo $pageWidth ?>px; margin: 10 0 0 10">
		<tr>
			<td width="150" rowspan="3"><?php echo image_tag('layout/printLogo') ?></td>
			<td valign="top" align="right"><b>Emissão:</b> <?php echo date('d/m/Y H:i:s') ?></td>
		</tr>
		<tr>
			<td style="font-size: 16pt; font-weight: bold; color: #333333; padding-left: 25px" valign="bottom"><?php echo $reportName ?></td>
		</tr>
		<tr>
			<td style="font-size: 9pt; color: #666666; padding-left: 35px" valign="top"><?php echo (isset($subtitle)?$subtitle:'&nbsp;') ?></td>
		</tr>
		<tr>
			<td colspan="3" style="padding: 10 0 25 0"><?php echo $sf_content ?></td>
		</tr>
		<tr>
			<td colspan="3" align="right">
				<table border="0" cellpadding="0" cellspacing="0" width="90%">
					<tr>
						<td style="border-top: 2px solid #808080">
						<p align="right">Dados rodapé</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
<script>if( !isDebug() ) self.print()</script>
</html>