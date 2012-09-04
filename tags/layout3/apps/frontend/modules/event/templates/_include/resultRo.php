<table border="0" cellspacing="0" cellpadding="0" class="gridTable gridTabTable">
  <tr class="header">
    <th class="first" width="50"><?php echo __('Position') ?></th>
    <th><?php echo __('Player') ?></th>
    <?php if( $showPrize ): ?>
    <th>Buy-in</th>
    <th>Rebuy</th>
    <th>Add-on</th>
    <th><?php echo __('Prize') ?></th>
    <?php endif; ?>
    <th width="50"><?php echo __('Score') ?></th>
  </tr>
  <?php
  	$buyin       = $eventObj->getBuyin();
  	$entranceFee = $eventObj->getEntranceFee();
  	
  	$orderByList = array(EventPlayerPeer::ENABLED=>'desc',
  						 EventPlayerPeer::EVENT_POSITION=>'asc');
  						 
  	$getPlayerNameFunction = ($showPrize?'getFirstName':'getFullName');
  	
  	$eventPlayerObjList = $eventObj->getPlayerList($orderByList);
  	$players            = 0;
  	foreach($eventPlayerObjList as $key=>$eventPlayerObj):
  	
  		if( !$eventPlayerObj->getEnabled() )
  			continue;
  		
  		$players++;
  		$peopleObj = $eventPlayerObj->getPeople();
  ?>
  <tr>
    <td class="textR">#<?php echo $eventPlayerObj->getEventPosition() ?></td>
    <td><?php echo $peopleObj->$getPlayerNameFunction() ?></td>
    <?php if( $showPrize ): ?>
    <td class="textR"><?php echo ($entranceFee?Util::formatFloat($entranceFee, true).'+':'') . Util::formatFloat($buyin, true) ?></td>
    <td class="textR"><?php echo Util::formatFloat($eventPlayerObj->getRebuy(), true) ?></td>
    <td class="textR"><?php echo Util::formatFloat($eventPlayerObj->getAddon(), true) ?></td>
    <td class="textR"><?php echo Util::formatFloat($eventPlayerObj->getPrize(), true) ?></td>
    <?php endif; ?>
    <td class="textR"><?php echo Util::formatFloat($eventPlayerObj->getScore(), true, 3) ?></td>
  </tr>
  <?php
  	endforeach;

  	if( $players==0 ):
  ?>
  <tr>
    <td colspan="7" class="footer"><?php echo __('event.resultTab.noPlayer') ?></td>
  </tr>
  <?php endif; ?>
</table>