<div id="homeWall">
<h1><?php echo __('home.whatsGoingOn') ?>...</h1>
	<div id="postList">
		<?php
			foreach(HomeWall::getLastPosts(10) as $homeWallObj):
			
				$icon = $homeWallObj->getIcon();
		?>
		<div style="background: url('/images/homeWall/<?php echo $icon ?>.png') no-repeat" class="post">
		<?php if( $homeWallObj->getShowWho() ): ?>
			<span class="who"><?php echo $homeWallObj->getPeopleName() ?></span> -
		<?php endif; ?> 
		<span class="when"><?php echo $homeWallObj->getTimeAgo() ?> <?php echo __('ago') ?></span><br/>
		<?php echo $homeWallObj->getMessage() ?></div>
		<?php endforeach; ?>
	</div>
</div>