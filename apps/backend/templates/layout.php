<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php
include_http_metas();
include_metas();
include_title();

$peopleName = 'Luciano Stegun';
?>

	<!--[if lt IE 9]>
	<link rel="stylesheet" href="/css/backend/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<script type="text/javascript">

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

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="index.html">iRank Admin</a></h1>
			<h2 class="section_title">Resumo geral</h2><div class="btn_view_site"><a href="http://www.irank.com.br">iRank Site</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p><?php echo $peopleName ?> (<a href="#">3 Messages</a>)</p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs">
			<?php
				$pathList = (isset($pathList)?$pathList:array());
				echo link_to('Home', 'home/index');
				
				foreach($pathList as $pathName=>$pathLink){
					
					echo '<div class="breadcrumb_divider"></div>';
					echo link_to($pathName, $pathLink);
				}
			?>
			</article>
		</div>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
		<form class="quick_search">
			<input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
		</form>
		<hr/>
		<h3>Eventos</h3>
		<ul class="toggle">
			<li class="icn_new_article"><?php echo link_to('Novo evento', 'eventLive/new') ?></li>
			<li class="icn_categories"><?php echo link_to('Lista de eventos', 'eventLive/index') ?></li>
			<li class="icn_tags"><?php echo link_to('Templates', 'eventLive/templates') ?></li>
		</ul>
		<h3>Rankings</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="#">Novo ranking</a></li>
			<li class="icn_categories"><a href="#">Lista de rankings</a></li>
		</ul>
		<?php if($sf_user->hasCredential('iRankAdmin')): ?>
		<h3>Clubes</h3>
		<ul class="toggle">
			<li class="icn_new_article"><?php echo link_to('Novo clube', 'club/new') ?></li>
			<li class="icn_categories"><?php echo link_to('Lista de clubes', 'club/index') ?></li>
		</ul>
		<?php endif; ?>
		<h3>Usuários</h3>
		<ul class="toggle">
			<li class="icn_add_user"><a href="#">Novo usuário</a></li>
			<li class="icn_view_users"><a href="#">Lista de usuários</a></li>
			<li class="icn_profile"><a href="#">Meus dados</a></li>
		</ul>
		<h3>Media</h3>
		<ul class="toggle">
			<li class="icn_folder"><a href="#">File Manager</a></li>
			<li class="icn_photo"><a href="#">Gallery</a></li>
			<li class="icn_audio"><a href="#">Audio</a></li>
			<li class="icn_video"><a href="#">Video</a></li>
		</ul>
		<h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_settings"><a href="#">Painel de controle</a></li>
			<li class="icn_security"><a href="#">Security</a></li>
			<li class="icn_jump_back"><?php echo link_to('Logout', 'login/logout') ?></li>
		</ul>
		
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2011 Website Admin</strong></p>
			<p>Theme by <a href="http://www.medialoot.com">MediaLoot</a></p>
		</footer>
	</aside><!-- end of sidebar -->
	
	<section id="main" class="column">
		
	<?php echo $sf_data->getRaw('sf_content') ?>
		
	</section>
</body>

</html>