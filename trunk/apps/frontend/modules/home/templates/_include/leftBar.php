<div id="topBar" id="topLeftBar">
	<?php
		if( $isAuthenticated )
			include_partial('home/component/generalCredit', array('balance'=>$balance));
		else
			echo link_to(image_tag('layout/signIn'), '/sign');
	?>
</div>
<?php
	if( !$isAuthenticated )
		include_partial('login/include/login');
?>
<div id="leftMenu">
	<?php
		if( $isAuthenticated )
			include_partial('home/include/mainMenu');
	?>

	<div class="separator"></div>
	<div class="item" style="background: url('/images/icon/photo.png') 10px 4px no-repeat"><?php echo link_to('Mural de fotos', 'photoWall/index', array('style'=>'background: none')) ?></div>
	<div class="separator"></div>
</div>