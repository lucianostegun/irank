<div class="tabbarIntro">
	Jogadores convidados: <b><?php echo $eventObj->getInvites() ?></b><br/>
	Jogadores confirmados: <b><?php echo $eventObj->getPlayers() ?></b></div>
<div id="eventPlayerDiv">
	<table border="0" cellspacing="0" cellpadding="0" class="gridTable gridTabTable">
	  <tr class="header">
	    <th class="first"><?php echo __('Player') ?></th>
	    <th class="noBorder">&nbsp;</th>
	  </tr>
	  <?php
	  	$criteria = new Criteria();
		$criteria->add( EventPlayerPeer::ENABLED, true );
	  	$eventPlayerObjList = $eventObj->getPlayerList('result', $criteria);
	  	
	  	foreach($eventPlayerObjList as $eventPlayerObj):
	  		
	  		$peopleObj = $eventPlayerObj->getPeople();
	  ?>
	  <tr>
	    <td><?php echo $peopleObj->getFirstName() ?></td>
	    <td align="center" class="icon">
	    	<?php echo image_tag('icon/'.($eventPlayerObj->getEnabled()?'ok':'nok')); ?>
	    </td>
	  </tr>
	  <?php
	  	endforeach;
	  	
	  	if( count($eventPlayerObjList)==0 ):
	  ?>
	  <tr>
	    <td colspan="2"><?php echo __('event.playersTab.noPlayer') ?></td>
	  </tr>
	  <?php endif; ?>
	</table>
</div>