<div id="playerListDiv" style="display: none">
	<div class="text">
		<?php echo __('event.player.intro') ?>
	</div>
	<br/>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableMenu">
	  <?php
	  	$eventPlayerObjList = $eventObj->getPlayerList();
	  	foreach($eventPlayerObjList as $eventPlayerObj):
	  		
	  		$peopleObj = $eventPlayerObj->getPeople();
	  		
	  		$emailAddress      = $peopleObj->getEmailAddress();
	  		$inviteStatus      = $eventPlayerObj->getInviteStatus();
	  		$inviteStatusColor = ($inviteStatus=='yes'?'#3F8B07':'#B70606');
	  ?>
	  <tr>
	    <td onclick="location.href='mailto:<?php echo $emailAddress ?>'">
	    	<?php echo $peopleObj->getName() ?><br/>
	    	<span style="color: <?php echo $inviteStatusColor ?>"><?php echo $eventPlayerObj->getInviteStatusDescription() ?></span>
	    </td>
	  </tr>
	  <?php endforeach; ?>
	</table>
	
	<?php if( count($eventPlayerObjList)==0 ): ?>
	<div class="text" align="center"><?php echo __('ranking.noPlayers') ?></div>
	<?php endif; ?>
	<br/>
</div>