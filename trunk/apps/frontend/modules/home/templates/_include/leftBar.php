<div id="topBar" id="topLeftBar">
	<?php
		if( $isAuthenticated )
			include_partial('home/component/generalCredit', array());
		else
			echo link_to(image_tag($culture.'/layout/signUp'), '/sign');
	?>
</div>
<?php
	if( !$isAuthenticated )
		include_partial('login/include/login');
?>
<div id="leftMenu">
	<?php
		if( $isAuthenticated )
			include_partial('home/include/mainMenu', array('innerMenu'=>$innerMenu, 'innerObj'=>$innerObj));
	?>

	<div class="separator"></div>
	<div class="item" style="background: url('/images/icon/photo.png') 10px 4px no-repeat"><?php echo link_to(__('home.photoWall'), 'photoWall/index', array('style'=>'background: none')) ?></div>
	<div class="item" style="background: url('/images/icon/guide.png') 10px 4px no-repeat"><?php echo link_to(__('home.quickGuide'), 'quickGuide/index', array('style'=>'background: none')) ?></div>
	<div class="separator"></div>
</div>