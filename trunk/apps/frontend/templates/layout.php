<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
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
    		<div id="flagList">
	    		<?php echo link_to(image_tag('flagBrazil'), '#changeLanguage("pt_BR")'); ?>
	    		<?php echo link_to(image_tag('flagUS'), '#changeLanguage("en_US")'); ?>
	    	</div>
    		<div id="search">
    			<?php
    				echo form_tag('search/result', array('id'=>'mainSearchForm'));
    				echo input_tag('mainSearch', __('layout.search'), array('onfocus'=>'handleMainSearchFocus(this)', 'onblur'=>'handleMainSearchBlur(this)'));
    				echo '</form>';
    			?>
    			<div class="mainSearchButton" onmouseover="this.className='mainSearchButtonHover'" onmouseout="this.className='mainSearchButton'"><?php echo link_to(image_tag('blank.gif', array('width'=>23, 'height'=>19)), '#doQuickSearch()') ?></div>
			</div>
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
    				<td valign="top" style="background: #F0F0F0; border-top: 0px solid; border-right: 1px solid #404040; height: 35px"><?php echo image_tag('blank.gif', array('width'=>200, 'height'=>1)) ?></td>
    				<td valign="top" style="background: #F6F6F6; border-top: 0px; border-right: 0px solid"><?php echo image_tag('layout/rightBarBorderBase') ?></td>
    			</tr>
    		</table>
    	</div>
	</div>
	<?php echo image_tag('layout/leftBarFooter', array('style'=>'position: relative; top: -2px')) ?>
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
