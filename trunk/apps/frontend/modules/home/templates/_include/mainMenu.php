<?php
	include_partial('myAccount/include/photo', array());
?>

<div class="item"><?php echo link_to(__('leftBar.myRankings'), 'ranking/index') ?></div>
<div class="item" style="font-weight: bold"><?php echo link_to(__('leftBar.newEvent'), 'event/new') ?></div>
<div class="item"><?php echo link_to(__('leftBar.events'), 'event/index') ?></div>
<div class="item"><?php echo link_to(__('leftBar.personalEvents'), 'eventPersonal/index') ?></div>

<?php
	if( $innerMenu )
		include_partial($innerMenu, array('innerObj'=>$innerObj));
?>

<div class="item" style="padding-top: 20px; background: url('/images/icon/stats.png') 10px 22px no-repeat"><?php echo link_to(__('home.statistics'), 'statistic/index', array('style'=>'background: none')) ?></div>
<div class="item" style="background: url('/images/icon/options.png') 10px 6px no-repeat"><?php echo link_to(__('leftBar.config'), 'myAccount/index?tab=options', array('style'=>'background: none')) ?></div>
<div class="item" style="background: url('/images/icon/logout.png') 10px 6px no-repeat"><?php echo link_to(__('leftBar.logout'), 'login/logout', array('style'=>'background: none')) ?></div>