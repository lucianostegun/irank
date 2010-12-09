<?php
	$myEvent    = $eventObj->isMyEvent();
  	$peopleIdMe = MyTools::getAttribute('peopleId');
?>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr class="rank_heading">
    <td>Nome</td>
    <td>Sobrenome</td>
    <td>E-mail</td>
    <td></td>
    <?php if( $myEvent ): ?>
    <td></td>
    <?php endif; ?>
  </tr>
  <?php
  	$eventPlayerObjList = $eventObj->getPlayerList();
  	foreach($eventPlayerObjList as $eventPlayerObj):
  		
  		$peopleObj = $eventPlayerObj->getPeople();
  		$peopleId  = $peopleObj->getId();
  ?>
  <tr class="boxcontent">
    <td><?php echo $peopleObj->getFirstName() ?></td>
    <td><?php echo $peopleObj->getLastName() ?></td>
    <td><?php echo $peopleObj->getEmailAddress() ?></td>
    <td align="center">
    	<?php
    		$inviteStatus = $eventPlayerObj->getInviteStatus();
    		$icon = ($inviteStatus=='yes'?'ok':($inviteStatus=='no'?'nok':'help'));
    		$image = image_tag('icon/'.$icon, array('id'=>'presenceImage'.$peopleId));
    		
    		if( $myEvent )
    			echo link_to($image, '#togglePresence('.$peopleId.')', array('title'=>'Confirmar/Cancelar presença'));
    		else
    			echo $image;
    	?>
    </td>
    <?php if( $myEvent ): ?>
    <td align="center">
    	<?php echo link_to(image_tag('icon/delete'), '#removePlayer('.$peopleId.')', array('title'=>'Remover jogador do evento', 'style'=>'margin-left: 5px')); ?>
    </td>
    <?php endif; ?>
  </tr>
  <?php
  	endforeach;
  	
  	if( count($eventPlayerObjList)==0 ):
  ?>
  <tr class="boxcontent">
    <td colspan="5">Este ranking ainda não possui convidados</td>
  </tr>
  <?php endif; ?>
</table>