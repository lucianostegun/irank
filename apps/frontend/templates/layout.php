<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php
include_http_metas();
include_metas();
include_title();

$moduleName      = $sf_context->getModuleName();
$isAuthenticated = MyTools::isAuthenticated();
	
if( $isAuthenticated )
	$balance = People::getBalance();
?>
<script>
	var _webRoot   = '<?php echo $sf_request->getScriptName() ?>';
	var _imageRoot = '<?php echo 'http://'.$sf_request->getHost() .'/images'; ?>';
	var _isDebug   = <?php echo (Util::isDebug()?'true':'false') ?>;
	var _isMobile  = false;
</script>
</head>
<body>

<div id="contentArea">
	<div id="innerContent">
    	<div id="header">
    		<div id="logo"><?php echo link_to(image_tag('layout/logo', array('alt'=>'Voltar para a página inicial')), '/home') ?></div>
    		<div id="search">
    			<?php
    				echo form_tag('search/result', array('id'=>'mainSearchForm'));
    				echo input_tag('mainSearch', 'Procurar jogadores e eventos', array('onfocus'=>'handleMainSearchFocus(this)', 'onblur'=>'handleMainSearchBlur(this)'));
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
				    		<div id="topBar">
					    		<?php if( $isAuthenticated ): ?>
				    			<span>SALDO GERAL:</span> <span class="<?php echo ($balance<0?'negative':'positive') ?>Credit"><?php echo Util::formatFloat($balance, true) ?></span>
					    		<?php else: ?>
					    		<?php echo link_to(image_tag('layout/signIn'), '/sign') ?>
					    		<?php endif; ?>
				    		</div>
			    			<?php
			    				if( !$isAuthenticated )
			    					include_partial('login/include/login');
			    			?>
				    		<div id="leftMenu">
				    			<?php
				    				if( $isAuthenticated )
				    					include_partial('home/include/mainMenu');
			    					include_partial('home/include/leftBar');
				    			?>
				    		</div>
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
    		</table>
	    		
    	</div>
	</div>
</div>

<div id="footer">
	<?php echo link_to('home', '/') ?> | 
	<?php echo link_to('cadastro', '/sign') ?> | 
	<?php echo link_to('meu irank', '/myAccount') ?> | 
	<?php echo link_to('convidar amigos', '/friendInvite') ?> | 
	<?php echo link_to('feedback', '/feedBack') ?> | 
	<?php echo link_to('ajuda', '/help') ?> | 
	<?php echo link_to('contato', '/contact') ?> 
</div>

<?php
	$dhtmlxWindowsObj = new DhtmlxWindows();
	$dhtmlxWindowsObj->build();
?>
</body>
</html>
