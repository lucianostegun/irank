<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php
include_http_metas();
include_metas();
include_title();

$moduleName = $sf_context->getModuleName();
?>
<script>
	var _webRoot = '<?php echo $sf_request->getScriptName() ?>';
	var _isDebug = <?php echo (Util::isDebug()?'true':'false') ?>;
</script>
</head>
<body>
	<div id="debugDiv"></div>
	<div class="mainTop">
		<table cellspacing="0" width="100%" cellpadding="0" border="0">
			<tr>
				<td><div class="homeLink"><?php echo link_to('Home', '/home') ?></div></td>
			</tr>
			<tr>
				<td>
					<div class="topMenu">
						<div class="item" style="background: none"><?php echo link_to('Cadastro', '/sign') ?></div>
						<div class="item"><?php echo link_to('Contato', '/home') ?></div>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div class="mainContent">
		<?php if( $moduleName!=='home' ): ?>
		<div class="pathIndicator">
			<div class="pageTitle"><?php echo (isset($pageTitle)?$pageTitle:null) ?></div>
		</div>
		<?php endif; ?>
		<?php echo $sf_content ?>
		<div class="footer">
			<table cellspacing="0" cellpadding="0" border="0" style="margin: 10px">
				<tr>
					<td><?php echo image_tag('frontend/layout/privacyPolicy') ?></td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>