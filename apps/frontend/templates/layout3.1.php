<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-BR" lang="pt-BR">
<head>
<link rel="icon" href="/favicon.ico" type="image/x-icon"/>
<?php
include_http_metas();
include_metas();
include_title();

$culture = 'pt_BR';
?>
<script>

</script>
</head>
<body>
<div id="debugDiv"></div>
<div id="contentArea">
    	<div id="mainContent">
    		<div id="header">
    			<?php echo image_tag('frontend/layout/logo', array('id'=>'logo')) ?>
    			<?php echo image_tag('frontend/layout/cards', array('id'=>'cards')) ?>
    			<?php echo image_tag('frontend/layout/chipsHeader', array('id'=>'chips')) ?>
    			<div class="flags">
					<?php echo link_to(image_tag('flagBrazil'), '#changeDefaultLanguage("pt-BR")') ?>
					<?php echo link_to(image_tag('flagUsa'), '#changeDefaultLanguage("en-US")') ?>
    			</div>
    		</div>
    		<table cellspacing="0" cellpadding="0" id="borderTable">
    			<tr>
    				<td class="topLeft"><?php echo image_tag('frontend/layout/borderTopLeft') ?></td>
    				<td class="top"></td>
    				<td class="topRight"><?php echo image_tag('frontend/layout/borderTopRight') ?></td>
    			</tr>
    			<tr>
    				<td class="left"></td>
    				<td class="middle">
						<div id="topMenu">
							<div class="distinct">
								<?php echo image_tag('frontend/layout/culture/signUp') ?>
							</div>
							<div class="links">
								<?php include_partial('home/include/topMenu') ?>
							</div>
						</div>
    					<div id="innerContent">
    						<div class="leftContent">
    							<div class="leftContentTop">
	    							<?php include_partial('login/include/login', array()) ?>
	    							<?php include_partial('home/include/facebook', array()) ?>
	    							
						    		<?php echo link_to(image_tag('frontend/appstore'), 'http://itunes.apple.com/us/app/irank/id481129223', array('id'=>'appstore')) ?>
						    		
	    							<div class="social">
							    		<?php include_partial('home/include/partners', array()) ?>
						    		</div>
						    	</div>
					    		<?php include_partial('home/include/quiz', array()) ?>
    						</div>
				    		
    						<div class="rightContent">
    							<?php echo $sf_content ?>
    						</div>
    						
    						<div class="clear"></div>
    					</div> 
    				</td>
    				<td class="right"></td>
    			</tr>
    			<tr>
    				<td><?php echo image_tag('frontend/layout/borderBottomLeft') ?></td>
    				<td class="bottom">
    					<?php include_partial('home/include/addthis', array()) ?>
    				</td>
    				<td><?php echo image_tag('frontend/layout/borderBottomRight') ?></td>
    			</tr>
    		</table>
    	</div>
	</div>
	<div id="footer">
		<?php echo image_tag('frontend/layout/chipsFooter') ?>
		<div class="links">home | cadastro | meu iRank | convidar amigos | feedback | ajuda | contato</div>
		<div class="credit">desenvolvido por: <?php echo link_to('Newai software', 'http://www.newai.com.br', array('target'=>'_blank')) ?></div>
	</div>
</div>
<?php
//	$dhtmlxWindowsObj = new DhtmlxWindows();
//	$dhtmlxWindowsObj->build();
?>
</body>
</html>
