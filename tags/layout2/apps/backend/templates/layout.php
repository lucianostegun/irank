<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php
sfContext::getInstance()->getResponse()->addStylesheet( '/index.php/home/stylesheet/css' );
include_http_metas();
include_metas();
include_title();

$userAdminId = $sf_user->getAttribute('userAdminId');
$username    = $sf_user->getAttribute('username');

$isAuthenticated = $sf_user->isAuthenticated();

$moduleName      = $sf_context->getModuleName();
$actionName      = $sf_context->getActionName();

$realActionName  = $sf_request->getParameterHolder()->get('action');

$moduleObj = ModulePeer::retrieveByModuleName( $moduleName, $actionName );

$dateAndUsername = date('d/m/Y H:i:s');
$dateAndUsername = ($username?'<b>'.$username.'</b> - ':'').$dateAndUsername;

$userAdminObj = UserAdmin::getCurrentUser();
$isMaster     = $userAdminObj->getMaster();
?>
<link rel="shortcut icon" href="/favicon.ico" />
<script type="text/javascript">
	var _webRoot      = '<?php echo $sf_request->getScriptName() ?>';
	var _imageRoot    = '<?php echo 'http://'.$sf_request->getHost() .'/images'; ?>';
	var _isReadOnly   = <?php echo (isset($readOnly)?$readOnly:'false') ?>;
	var _isDebug      = <?php echo Util::isDebug()?'true':'false'; ?>;
	var _moduleName   = '<?php echo $moduleName ?>';
		
	function handleError() {
		
		return true;
	}
	
	<?php if( !Util::isDebug() ): ?>//window.onerror = handleError;<?php endif; ?>
</script>
</head>

<?php
	echo input_hidden_tag('currentUserAdminId', $userAdminId );
?>
<body onresize="adjustTabHeight(); adjustGridboxHeight('gridboxObj', 'main')">
<?php
	echo getLoading();
	Util::getFormStatus();
?>
<div id="debugDiv"></div>
<div id="actionDescriptionDiv"><?php echo (isset($actionDescription)?$actionDescription:'') ?></div>

<div class="mainContent">

	<?php
		$options = array('userAdminId'=>$userAdminId, 'dateAndUsername'=>$dateAndUsername, 'actionName'=>$actionName, 'realActionName'=>$realActionName, 'isAuthenticated'=>$isAuthenticated, 'moduleObj'=>$moduleObj, 'isMaster'=>$isMaster);
		include_partial('home/layout/header1', $options);
//			sfContext::getInstance()->getResponse()->addStylesheet( 'backend/layout2' );
	?>
	
	<div align="center">
		<div align="left" id="mainLayout">
			<?php echo $sf_content ?>
		</div>
	</div>
	
</div>

<div style="clear: both; width: 100%"></div>
<table style="margin-top: 40px; height: 40px" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td width="20%" class="footer"></td>
		<td width="79%" class="footer" style="padding-right: 4px;; height: 40px">desenvolvido por <br/><b>Neway Software</b></td>
		<td width="27" class="footer" style="padding-right: 20px;; height: 40px">&nbsp;</td>
	</tr>
</table>


<?php
	if( $isAuthenticated )
		new DhtmlxMenu($userAdminId);
	
	$dhtmlxWindowsObj = new DhtmlxWindows();
	$dhtmlxWindowsObj->build();
?>
<script>
    setModuleName('<?php echo $moduleObj->getToolbarDescription() ?>', '<?php echo $moduleObj->getImageModule() ?>');
    releaseToolbar();
</script>
<?php
echo periodically_call_remote(array(
    'frequency'=>1830,
    'success'   =>'checkIsLogged(request.responseText)',
    'url'      =>'login/isLogged',
));
?>
</body>
</html>