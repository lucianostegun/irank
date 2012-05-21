<?php
	sfContext::getInstance()->getResponse()->addStylesheet('quickResume');
	
	$resumeInfo      = People::getFullResume();
	$eventLiveIdList = People::getPendingInvites(true);
?>
<div id="quickResume" class="home">
	<h1>Bankroll</h1>
	<div style="margin-top: 17px"></div>
	<div class="row">
		<div class="label">Buy-ins</div>
		<div class="value"><?php echo Util::formatFloat($resumeInfo['buyin'], true) ?></div>
		<div class="label">Rebuys</div>
		<div class="value"><?php echo Util::formatFloat($resumeInfo['rebuy'], true) ?></div>
		<div class="label">Add-ons</div>
		<div class="value"><?php echo Util::formatFloat($resumeInfo['addon'], true) ?></div>
	</div>
	<div class="row">
		<div class="label">Taxas</div>
		<div class="value"><?php echo Util::formatFloat($resumeInfo['fee'], true) ?></div>
		<div class="label">Ganhos</div>
		<div class="value"><?php echo Util::formatFloat($resumeInfo['prize'], true) ?></div>
		<div class="label">SALDO</div>
		<div class="value"><?php echo Util::formatFloat($resumeInfo['balance'], true) ?></div>
	</div>
	<div class="mt15"></div>
	<div class="separator"></div>
	<h2>
		Convites pendentes
		<?php
			if( !empty($eventLiveIdList) )
				echo link_to('ver todos', 'myAccount/invites', array('class'=>'seeAll'));
		?>
	</h2>
	<div class="separator"></div>
	<div class="pendingInviteList">
		<?php if( empty($eventLiveIdList) ): ?>
		Você não possui eventos com convites pendentes.
		<?php
			else:
			
			$criteria = new Criteria();
			$criteria->add( EventLivePeer::ID, $eventLiveIdList, Criteria::IN );
			$criteria->addAscendingOrderByColumn( EventLivePeer::EVENT_DATE_TIME );
			$criteria->setLimit(5);
			$eventLiveObjList = EventLive::getList($criteria);
			
			foreach($eventLiveObjList as $key=>$eventLiveObj):
		?>
			<a href="javascript:void(0)" onclick="goToPage('eventLive', 'details', 'id', <?php echo $eventLiveObj->getId() ?>)">
			<div class="pendingInvite <?php echo ($key==0?'first':'') ?>">
				<span class="eventDate"><?php echo $eventLiveObj->getEventDate('d/m') ?></span> - 
				<span class="eventName"><?php echo $eventLiveObj->getEventName() ?></span>
				<span class="eventPlace">@<?php echo $eventLiveObj->getClub()->toString() ?></span>
			</div>
			</a>
		<?php
			endforeach;
			endif;
		?>
	</div>
</div>