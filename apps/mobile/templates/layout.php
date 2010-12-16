<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php
include_http_metas();
include_metas();
include_title();

$title = (isset($title)?$title:false);
?>
<link rel="shortcut icon" href="/favicon.ico" />
<script type="text/javascript">
	var _webRoot    = '<?php echo $sf_request->getScriptName() ?>';
	var _imageRoot  = '<?php echo 'http://'.$sf_request->getHost() .'/images'; ?>';
	var _isReadOnly = <?php echo (isset($readOnly)?$readOnly:'false') ?>;
	var _isDebug    = <?php echo Util::isDebug()?'true':'false'; ?>;
	var _isMobile  = false;
</script>
</head>
<body onload="autoScrool()">
<?php echo Util::getLoading(); ?>
<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="header" width="88" align="right">
			<?php
				if( $title )
					echo link_to(image_tag('mobile/layout/backTop'), '#history.back()');
				else
					echo image_tag('mobile/layout/heart');
			?>
		</td>
		<td class="header" width="483" align="center"><?php echo link_to(image_tag('mobile/layout/logo'), '/home/index') ?></td>
		<td class="header" width="69"><?php echo image_tag('mobile/layout/diamond') ?></td>
	</tr>
</table>

<?php if( $title ): ?>
<table width="100%" cellspacing="0" cellpadding="0" class="titleBar">
	<tr>
		<td valign="top" style="padding: 5 0 0 10; color: #FFFFFF; font-size: 20pt; font-weight: bold; text-shadow: #555555 2px -2px;"><?php echo $title ?></td>
	</tr>
</table>
<?php endif; ?>

<table width="100%" height="535" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top">
			<?php echo $sf_content ?>
		</td>
	</tr>
</table>

<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="footerBack"><?php echo link_to(image_tag('mobile/layout/back'), '#history.back()') ?></td>
		<td width="100%" class="footer" style="text-align: center"><?php echo link_to('Versão completa', 'home/classic') ?></td>
		<td class="footer" align="right"><?php echo image_tag('mobile/layout/logoFooter') ?></td>
	</tr>
</table>


</body>
</html>