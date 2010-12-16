<div id="playerListDiv" style="display: none">
	<div class="text">
		Lista dos jogadores convidados para o evento
	</div>
	<br/>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableMenu">
	  <?php
	  	$eventPlayerObjList = $eventObj->getPlayerList();
	  	foreach($eventPlayerObjList as $eventPlayerObj):
	  		
	  		$peopleObj = $eventPlayerObj->getPeople();
	  		
	  		$emailAddress      = $peopleObj->getEmailAddress();
	  		$inviteStatus      = $eventPlayerObj->getInviteStatus();
	  		$inviteStatusColor = ($inviteStatus=='yes'?'#3f8b07':'#b70606');
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
	<div class="text" align="center">Este ranking ainda não possui membros cadastrados</div>
	<?php endif; ?>
	<br/>
</div>