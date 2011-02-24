<?php
	$isAuthenticated = MyTools::isAuthenticated();
	$firstName       = MyTools::getAttribute('firstName');
?>
<div class="text">
<?php echo __('home.welcome', array('%firstName%'=>($firstName?' '.$firstName:''))) ?>
</div>
<br/>
<div align="center">
<table width="95%" cellpadding="0" cellspacing="0" class="menu">
	<tr onclick="goModule('ranking', 'index')">
		<td width="10" class="topLeft">&nbsp;</td>
		<td class="middle label"><?php echo image_tag('mobile/home/ranking', array('align'=>'middle')) ?><?php echo __('home.myRankings') ?></td>
		<td width="10" class="topRight">&nbsp;</td>
	</tr>
	<tr onclick="goModule('event', 'index')">
		<td width="10" class="left">&nbsp;</td>
		<td class="middle label"><?php echo image_tag('mobile/home/event', array('align'=>'middle')) ?><?php echo __('home.myEvents') ?></td>
		<td width="10" class="right">&nbsp;</td>
	</tr>
	<?php if( $isAuthenticated ): ?>
	<tr onclick="goModule('login', 'logout')">
		<td width="10" class="baseLeft">&nbsp;</td>
		<td class="base label"><?php echo image_tag('mobile/home/close', array('align'=>'middle')) ?><?php echo __('home.logout') ?></td>
		<td width="10" class="baseRight">&nbsp;</td>
	</tr>
	<?php else: ?>
	<tr onclick="goModule('login', 'index')">
		<td width="10" class="baseLeft">&nbsp;</td>
		<td class="base label"><?php echo image_tag('mobile/home/login', array('align'=>'middle')) ?><?php echo __('home.login') ?></td>
		<td width="10" class="baseRight">&nbsp;</td>
	</tr>
	<?php endif; ?>
</table>

<?php
	if( $isAuthenticated ){
	
		$resumeList       = People::getResumeBalance();
		$eventObjListNext = Event::getNextList(3);
		$eventObjListPrev = Event::getPreviousList(5);
		
		include_partial('home/include/bankRoll', $resumeList);
		include_partial('home/include/nextEvents', array('eventObjList'=>$eventObjListNext));
		include_partial('home/include/previousEvents', array('eventObjList'=>$eventObjListPrev));
	}
?>