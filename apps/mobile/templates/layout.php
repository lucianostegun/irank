<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php
include_http_metas();
include_metas();
include_title();
?>
<link rel="shortcut icon" href="/favicon.ico" />
<script type="text/javascript">
	var _webRoot    = '<?php echo $sf_request->getScriptName() ?>';
	var _imageRoot  = '<?php echo 'http://'.$sf_request->getHost() .'/images'; ?>';
	var _isReadOnly = <?php echo (isset($readOnly)?$readOnly:'false') ?>;
	var _isDebug    = <?php echo Util::isDebug()?'true':'false'; ?>;
</script>
</head>
<?php
	
	echo Util::getLoading();
?>
<body>
<table width="100%" height="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td id="header"><?php echo link_to(image_tag('mobile/layout/logo'), '/home/index') ?></td>
	</tr>
	<tr>
		<td valign="top" style="padding-top: 10px">
			<?php echo $sf_content ?>
		</td>
	</tr>
</table>
<table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 4px">
	<tr>
		<td class="footerBack"><?php echo link_to('Voltar', '#history.back()') ?></div>
		<td class="footer">iRank</div>
	</tr>
</table>
</body>
</html>