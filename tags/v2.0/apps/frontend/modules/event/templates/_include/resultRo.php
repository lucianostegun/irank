<table border="0" cellspacing="1" cellpadding="2" class="gridTabTable">
  <tr class="header">
    <th><?php echo __('Player') ?></th>
    <th>Buy-in</th>
    <th><?php echo __('Position') ?></th>
    <th><?php echo __('Prize') ?></th>
    <th>Rebuy</th>
    <th>Add-on</th>
    <th><?php echo __('Score') ?></th>
  </tr>
  <?php
  	$buyin       = $eventObj->getBuyin();
  	$entranceFee = $eventObj->getEntranceFee();
  	
  	$orderByList = array(EventPlayerPeer::ENABLED=>'desc',
  						 EventPlayerPeer::EVENT_POSITION=>'asc');
  	
  	$eventPlayerObjList = $eventObj->getPlayerList($orderByList);
  	$recordCount        = count($eventPlayerObjList);
  	foreach($eventPlayerObjList as $key=>$eventPlayerObj):
  	
  		if( !$eventPlayerObj->getEnabled() )
  			continue;
  			
  		$peopleObj = $eventPlayerObj->getPeople();
  ?>
  <tr>
    <td><?php echo $peopleObj->getFullName() ?></td>
    <td align="right"><?php echo ($entranceFee?Util::formatFloat($entranceFee, true).'+':'') . Util::formatFloat($buyin, true) ?></td>
    <td>#<?php echo $eventPlayerObj->getEventPosition() ?></td>
    <td align="right"><?php echo Util::formatFloat($eventPlayerObj->getPrize(), true) ?></td>
    <td align="right"><?php echo Util::formatFloat($eventPlayerObj->getRebuy(), true) ?></td>
    <td align="right"><?php echo Util::formatFloat($eventPlayerObj->getAddon(), true) ?></td>
    <td align="right"><?php echo Util::formatFloat($eventPlayerObj->getScore(), true, 3) ?></td>
  </tr>
  <?php
  	endforeach;
  	
  	if( count($eventPlayerObjList)==0 ):
  ?>
  <tr>
    <td colspan="7"><?php echo __('event.resultTab.noPlayer') ?></td>
  </tr>
  <?php endif; ?>
</table>