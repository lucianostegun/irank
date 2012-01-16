<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-BR" lang="pt-BR">
<head>
<link rel="icon" href="/favicon.ico" type="image/x-icon"/>
<?php
include_http_metas();
include_metas();
include_title();

$moduleName      = $sf_context->getModuleName();
$hasCredentials  = MyTools::hasCredential('iRankSite');
$isAuthenticated = (MyTools::isAuthenticated() && $hasCredentials);
$culture         = $sf_user->getCulture();
$innerMenu       = (isset($innerMenu)?$innerMenu:false);
$innerObj        = (isset($innerObj)?$innerObj:false);
$forceClassic    = MyTools::getAttribute('forceClassic');
?>
<script>
	var _ModuleName = '<?php echo $moduleName ?>';
	var _webRoot    = '<?php echo $sf_request->getScriptName() ?>';
	var _imageRoot  = '<?php echo 'http://'.$sf_request->getHost() .'/images'; ?>';
	var _isDebug    = <?php echo (Util::isDebug()?'true':'false') ?>;
	var _isMobile   = false;
</script>
</head>
<body>
<div id="debugDiv"></div>
<div id="contentArea">
	<div id="innerContent">
    	<div id="header">
    		<div id="logo"><?php echo link_to(image_tag('layout/logo', array('title'=>__('layout.backHome'))), '/home') ?></div>
    	</div>
    	<div id="mainContent">
    		
    		<table width="100%" cellspacing="0" cellpadding="0">
    			<tr>
    				<td valign="top" width="200" id="leftContent">
				    	<div id="leftBar">
				    		<?php include_partial('home/include/leftBar', array('isAuthenticated'=>$isAuthenticated, 'culture'=>$culture, 'innerMenu'=>$innerMenu, 'innerObj'=>$innerObj)) ?>
				    	</div>
				    	<div id="socialNetwork">
				    		<?php include_partial('home/include/facebook', array()) ?>
				    		<?php include_partial('home/include/addthis', array()) ?>
				    		<?php include_partial('home/include/partners', array()) ?>
				    	</div>
    				</td>
    				<td valign="top" id="rightContent">
    				
			    		<div id="topMenu">
							<?php include_partial('home/include/topMenu') ?>
			    		</div>
					
						<div id="middleContent">
							<?php echo Util::getLoading(); ?>
							<?php echo $sf_content ?>
						</div>
    				</td>
    			</tr>
    			<tr>
    				<td valign="top" style="background: #F0F0F0; border-top: 0px solid; border-right: 1px solid #404040; text-align: center; height: 35px">
    					<?php echo image_tag('appstore') ?>
    					<?php #echo image_tag('blank.gif') ?>
    				</td>
    				<td valign="top" style="background: #F6F6F6; border-top: 0px; border-right: 0px solid; padding-bottom: 70px"><?php echo image_tag('layout/rightBarBorderBase') ?></td>
    			</tr>
    		</table>
    	</div>
	</div>
</div>
<div id="footer">
	<table width="100%" cellspacing="0" cellpadding="0" border="0">
		<tr>
			<td width="33%" align="left"><?php echo image_tag('layout/chips', array('style'=>'position: relative; left: 20px; top: -45px; margin-bottom: -45px')) ?></td>
			<td>
				<?php echo link_to('home', '/') ?> | 
				<?php echo link_to(__('footerMenu.signUp'), '/sign') ?> | 
				<?php echo link_to(__('footerMenu.myiRank'), '/myAccount') ?> | 
				<?php echo link_to(__('footerMenu.inviteFriends'), '/friendInvite') ?> | 
				<?php echo link_to('feedback', '/feedBack') ?> | 
				<?php echo link_to(__('footerMenu.help'), '/help') ?> | 
				<?php echo link_to(__('footerMenu.contact'), '/contact') ?>
				<?php echo ($forceClassic?'<br/><b>'.link_to(__('footerMenu.mobildeVersion'), '/home/mobile').'</b><br/>':'') ?>
			</td> 
			<td width="33%">&nbsp;</td>
		</tr>
	</table>
</div>
<?php
	$dhtmlxWindowsObj = new DhtmlxWindows();
	$dhtmlxWindowsObj->build();
?>
</body>
</html>
