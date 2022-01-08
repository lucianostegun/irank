<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php
include_http_metas();
include_metas();
include_title();

$moduleName = $sf_context->getModuleName();
?>
<script>
	var _webRoot   = '<?php echo $sf_request->getScriptName() ?>';
	var _imageRoot = '<?php echo 'http://'.$sf_request->getHost() .'/images'; ?>';
	var _isDebug   = <?php echo (Util::isDebug()?'true':'false') ?>;
	var _isMobile  = false;
</script>
</head>

<body>
	<div id="debugDiv"></div>
	<?php echo $sf_content ?>
</body>
</html>
