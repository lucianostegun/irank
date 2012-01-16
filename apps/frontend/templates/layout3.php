<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
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
</head>
<body>

<div id="contentArea">
	<div id="innerContent">
    	<div id="header">
    		<div id="logo"><?php echo link_to(image_tag('layout/logo', array('title'=>__('layout.backHome'))), '/home') ?></div>
    	</div>
    	<div id="mainContent">
    		<div id="leftContent">
    			<?php include_partial('home/include/leftBar', array('isAuthenticated'=>$isAuthenticated, 'culture'=>$culture, 'innerMenu'=>$innerMenu, 'innerObj'=>$innerObj)) ?>
    			<?php include_partial('login/include/login', array()) ?>
    			<?php include_partial('home/include/facebook', array()) ?>
    	<br/>
    	<br/>
    	<br/>
    	<br/>
    	<br/>
    	<br/>
    		</div>
    		<div id="rightContent">
	    		<div id="topMenu">
					<?php include_partial('home/include/topMenu') ?>
	    		</div>
	    		
    			<div id="menuCorner"></div>
    			<div id="addressBar">Home</div>
	    		<?php echo $sf_content ?>
    		</div>
    		<div class="clear"></div>
    	</div>
	</div>
</div>
<div id="footer">
	<div id="footerLinks">
		<?php echo link_to('home', '/') ?> | 
		<?php echo link_to(__('footerMenu.signUp'), '/sign') ?> | 
		<?php echo link_to(__('footerMenu.myiAccount'), '/myAccount') ?> | 
		<?php echo link_to(__('footerMenu.contact'), '/contact') ?>
		<?php echo ($forceClassic?'<br/><b>'.link_to(__('footerMenu.mobildeVersion'), '/home/mobile').'</b><br/>':'') ?>
		<br/>
		<br/>
		<br/>
		Desenvolvimento: <?php echo link_to('Newai Software', 'http://www.newai.com.br', array('target'=>'_blank', 'class'=>'newai')) ?>
	</div>
	<?php echo image_tag('layout/chips', array('style'=>'position: absolute; left: 20px; margin-top: -115px')) ?>
</div>

</body>
</html>