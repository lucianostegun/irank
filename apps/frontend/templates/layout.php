<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-BR" lang="pt-BR">
<head>
<link rel="icon" href="/favicon.ico" type="image/x-icon"/>
<?php
include_http_metas();
include_metas();

include_facebook_metas(isset($facebookMetaList)?$facebookMetaList:array());

include_title();

$culture = 'pt_BR';

$isAuthenticated = UserSite::isAuthenticated();
$innerObj = (isset($innerObj)?$innerObj:null);

$moduleName = $sf_context->getModuleName();
?>
<script>
var _ModuleName = '<?php echo $moduleName ?>';
</script>
</head>
<body>
<div id="debugDiv"></div>
<div id="contentArea">
    	<div id="mainContent">
    		<div id="header">
    			<?php echo link_to(image_tag('layout/logo', array('id'=>'logo')), '/home', array('title'=>'Voltar para a página inicial')) ?>
    			<div class="search">
					<?php
						echo form_tag('search/index', array('id'=>'mainSearchForm'));
						echo input_tag('mainSearch', $sf_request->getParameter('mainSearch'), array('placeholder'=>'Pesquisar eventos...', 'id'=>'mainSearchKeyWord'));
					?>
					</form>
    			</div>
    		</div>
    		<table cellspacing="0" cellpadding="0" id="borderTable">
    			<tr>
    				<td class="topLeft"><?php echo image_tag('layout/borderTopLeft') ?></td>
    				<td class="top"></td>
    				<td class="topRight"><?php echo image_tag('layout/borderTopRight') ?></td>
    			</tr>
    			<tr>
    				<td class="left"></td>
    				<td class="middle">
						<div id="topMenu">
							<div class="distinct" id="topMenuDistinct">
								<?php
									if( $isAuthenticated )
										include_partial('home/component/generalCredit', array());
									else
										echo link_to(image_tag('layout/'.$culture.'/signUp'), '/sign');
								?>
							</div>
							<div class="links">
								<?php include_partial('home/include/topMenu') ?>
							</div>
						</div>
    					<div id="innerContent">
    						<div class="leftContent">
    							<?php if( $moduleName!='login' ): ?>
    							<div class="leftContentTop">
    								<div id="loginResumeDiv">
	    							<?php
	    								if( $isAuthenticated ){

	    									include_partial('home/include/leftMenu', array('innerObj'=>$innerObj));
	    									
	    									if( $moduleName!='home' )
	    										include_partial('home/include/quickResume', array());
	    								}
	    								else
	    									include_partial('login/include/login', array());
	    							?>
	    							</div>
	    							<?php include_partial('home/include/facebook', array()); ?>
    							</div>
	    							<?php endif; ?>
    							<div>
						    		<?php include_partial('home/resume/calendar', array()) ?>
						    	</div>
    							<div class="leftContentBottom">
						    		<?php echo link_to(image_tag('appstore'), 'http://itunes.apple.com/us/app/irank/id481129223', array('id'=>'appstore')) ?>
						    	</div>
					    		<?php include_partial('home/include/partners', array()) ?>
					    		<?php include_partial('home/include/poll', array()) ?>
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
    				<td><?php echo image_tag('layout/borderBottomLeft') ?></td>
    				<td class="bottom">
    					<?php include_partial('home/include/addthis', array()) ?>
    				</td>
    				<td><?php echo image_tag('layout/borderBottomRight') ?></td>
    			</tr>
    		</table>
    	</div>
	</div>
	<div id="footer">
		<?php echo image_tag('layout/chipsFooter') ?>
		<div class="links">
			<?php echo link_to('home', '/home/index') ?> | 
			<?php echo link_to('cadastro', '/sign/index') ?> | 
			<?php echo link_to('minha conta', '/myAccount/index') ?> | 
			<?php echo link_to('mural de fotos', '/photoWall/index') ?> | 
			<?php echo link_to('onde jogar', '/club/index') ?><br/> 
			<?php echo link_to('agenda', '/eventLive/index') ?> | 
			<?php echo link_to('convidar amigos', '/friendInvite/index') ?> | 
			<?php echo link_to('feedback', '/feedback/index') ?> | 
			<?php echo link_to('contato', '/contact/index') ?>
			<?php echo link_to('loja virtual', '/store/index') ?>
		</div>
		<div class="credit">desenvolvido por: <?php echo link_to('Newai software', 'http://www.newai.com.br', array('target'=>'_blank')) ?></div>
	</div>
</div>
<?php
	$dhtmlxWindowsObj = new DhtmlxWindows();
	$dhtmlxWindowsObj->build();
?>
</body>
</html>
