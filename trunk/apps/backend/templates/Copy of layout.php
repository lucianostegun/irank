<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php
include_http_metas();
include_metas();
include_title();

$iRankAdmin = $sf_user->hasCredential('iRankAdmin');
$iRankSite  = $sf_user->hasCredential('iRankClub');
$messages   = 0;
$peopleName = $sf_user->getAttribute(($messages?'firstName':'fullName'));
$moduleName = $sf_context->getModuleName();
?>

	<!--[if lt IE 9]>
	<link rel="stylesheet" href="/css/backend/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<script type="text/javascript">

	var _ModuleName = '<?php echo $moduleName ?>';

	jQuery.noConflict();
	
	jQuery(document).ready(function() 
    	{ 
      	  jQuery(".tablesorter").tablesorter(); 
   	 } 
	);
	
	jQuery(document).ready(function() {

		//When page loads...
		jQuery(".tab_content").hide(); //Hide all content
		jQuery("ul.tabs li:first").addClass("active").show(); //Activate first tab
		jQuery(".tab_content:first").show(); //Show first tab content
	
		//On Click Event
		jQuery("ul.tabs li").click(function() {
	
			jQuery("ul.tabs li").removeClass("active"); //Remove any "active" class
			jQuery(this).addClass("active"); //Add "active" class to selected tab
			jQuery(".tab_content").hide(); //Hide all tab content
	
			var activeTab = jQuery(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
			jQuery(activeTab).fadeIn(); //Fade in the active ID content
			return false;
		});
	
	});

    jQuery(function(){
        jQuery('.column').equalHeight();
    });
</script>

<body>
	<div id="debugDiv"></div>
	<header id="header">
		<hgroup>
			<h1 class="site_title"><?php echo link_to(image_tag('backend/logo'), 'home/index') ?></h1>
			<h2 class="section_title">Resumo geral</h2>
			<div class="btn_view_site"><?php echo link_to('desconectar', 'login/logout') ?></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p><?php echo $peopleName ?> 
			<?php
				if( $messages )
					echo '('.link_to(sprintf('%d Mensage%s', $messages, ($messages==1?'m':'ns')), 'messages/index').')';
			?></p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs">
			<?php
				$pathList = (isset($pathList)?$pathList:array());
				echo link_to('Home', 'home/index');
				
				$key = 0;
				foreach($pathList as $pathName=>$pathLink){
					
					$key++;
					
					echo '<div class="breadcrumb_divider"></div>';
					echo link_to($pathName, $pathLink, array('class'=>($key==count($pathList)?'last':''), 'id'=>($key==count($pathList)?'lastPathName':'')));
				}
			?>
			</article>
		</div>
		<?php if( $moduleName!='home' ): ?>
		<div class="toolbar" style="float: right; padding: 5px 0px; text-align: right">
			<?php
				$hiddenToolbarList = isset($hiddenToolbarList)?$hiddenToolbarList:array();
				
				if( !in_array('new', $hiddenToolbarList) )
					echo button_tag('toolbarNew', 'Novo', array('image'=>'add', 'onclick'=>'goToNew(event)'));
				
				if( $actionName!='index' || $moduleName=='controlPanel' ){
					
					if( !in_array('save', $hiddenToolbarList) )
						echo button_tag('toolbarSave', 'Salvar', array('image'=>'save', 'onclick'=>'doSaveMain(false, event)'));
					
					if( !in_array('cancel', $hiddenToolbarList) )
						echo button_tag('toolbarCancel', 'Cancelar', array('image'=>'list', 'onclick'=>'goToList(event)'));
				}else{
					
					if( !in_array('delete', $hiddenToolbarList) )
						echo button_tag('toolbarDelete', 'Excluir', array('image'=>'delete', 'onclick'=>'doDeleteRecords()'));
				}
			?>
		</div>
		<?php endif; ?>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
		<form class="quick_search">
			<input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
		</form>
		<hr/>
		<h3>Clubes</h3>
		<ul class="toggle <?php echo ($moduleName=='club'?'visible':'hidden') ?>">
		<?php if( $iRankAdmin ): ?>
			<li class="icn_new_article"><?php echo link_to('Novo clube', 'club/new') ?></li>
		<?php endif; ?>
			<li class="icn_categories"><?php echo link_to('Lista de clubes', 'club/index') ?></li>
		</ul>
		<?php if( $iRankAdmin ): ?>
		<h3>Eventos - Home</h3>
		<ul class="toggle <?php echo ($moduleName=='event'?'visible':'hidden') ?>">
			<li class="icn_new_article"><?php echo link_to('Novo evento', 'eventLive/new') ?></li>
			<li class="icn_categories"><?php echo link_to('Lista de eventos', 'eventLive/index') ?></li>
		</ul>
		<?php endif; ?>
		<h3>Eventos - Live</h3>
		<ul class="toggle <?php echo ($moduleName=='eventLive'?'visible':'hidden') ?>">
			<li class="icn_new_article"><?php echo link_to('Novo evento', 'eventLive/new') ?></li>
			<li class="icn_categories"><?php echo link_to('Lista de eventos', 'eventLive/index') ?></li>
			<li class="icn_tags"><?php echo link_to('Templates', 'eventLive/templates') ?></li>
		</ul>
		<?php if( $iRankAdmin ): ?>
		<h3>Rankings - Home</h3>
		<ul class="toggle <?php echo ($moduleName=='ranking'?'visible':'hidden') ?>">
			<li class="icn_new_article"><a href="#">Novo ranking</a></li>
			<li class="icn_categories"><a href="#">Lista de rankings</a></li>
		</ul>
		<?php endif; ?>
		<h3>Rankings - Live</h3>
		<ul class="toggle <?php echo ($moduleName=='rankingLive'?'visible':'hidden') ?>">
			<li class="icn_new_article"><?php echo link_to('Novo ranking', 'rankingLive/new') ?></li>
			<li class="icn_categories"><?php echo link_to('Lista de rankings', 'rankingLive/index') ?></li>
		</ul>
		<?php if( $iRankAdmin ): ?>
		<h3>Usuários</h3>
		<ul class="toggle <?php echo ($moduleName=='userSite'?'visible':'hidden') ?>">
			<li class="icn_add_user"><?php echo link_to('Novo usuário', 'userSite/new') ?></li>
			<li class="icn_view_users"><?php echo link_to('Lista de usuários', 'userSite/index') ?></li>
		</ul>
		<h3>Media</h3>
		<ul class="toggle <?php echo ($moduleName=='media'?'visible':'hidden') ?>">
			<li class="icn_folder"><a href="#">File Manager</a></li>
			<li class="icn_photo"><a href="#">Gallery</a></li>
			<li class="icn_audio"><a href="#">Audio</a></li>
			<li class="icn_video"><a href="#">Video</a></li>
		</ul>
		<?php endif; ?>
		<h3>Admin</h3>
		<ul class="toggle visible">
		<?php if( $iRankAdmin ): ?>
			<li class="icn_add_user"><?php echo link_to('Novo usuário', 'userAdmin/new') ?></li>
			<li class="icn_view_users"><?php echo link_to('Lista de usuários', 'userAdmin/index') ?></li>
			<br/>		
			<li class="icn_settings"><?php echo link_to('Painel de controle', 'controlPanel/index') ?></li>
			<li class="icn_security"><a href="#">Security</a></li>
		<?php endif; ?>
			<li class="icn_profile"><a href="#">Meus dados</a></li>
		</ul>
		<br/>
		
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2011 Website Admin</strong></p>
			<p>Theme by <a href="http://www.medialoot.com" target="_blank">MediaLoot</a></p>
		</footer>
	</aside><!-- end of sidebar -->
	
	<section id="main" class="column">
		
	<?php echo $sf_data->getRaw('sf_content') ?>
		
	</section>
</body>

</html>