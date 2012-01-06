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
	
	function handleError() {
		
		return true;
	}
	
	<?php if( !Util::isDebug() ): ?>window.onerror = handleError;<?php endif; ?>
</script>
</head>
<?php
	$isAuthenticated = $sf_user->isAuthenticated();
	$moduleName      = $sf_context->getModuleName();
	$actionName      = $sf_context->getActionName();
	$realActionName  = $sf_request->getParameterHolder()->get('action');
?>
<body>
	<div id="debugDiv"></div>
	<?php echo $sf_content ?>
</body>
</html>