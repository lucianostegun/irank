<?php
	$isMyEvent     = $eventObj->isMyEvent();
  	$peopleIdMe    = MyTools::getAttribute('peopleId');
  	$peopleIdOwner = null;
  	
  	$rankingObj = $eventObj->getRanking();
  	
  	if( is_object($rankingObj) )
  		$peopleIdOwner = $rankingObj->getUserSite()->getPeopleId();
?>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr class="rank_heading">
    <td>Nome</td>
    <td>E-mail</td>
    <td colspan="3"></td>
  </tr>
  <?php
  	$eventPlayerObjList = $eventObj->getPlayerList();
  	foreach($eventPlayerObjList as $eventPlayerObj):
  		
  		$peopleObj = $eventPlayerObj->getPeople();
  		$peopleId  = $peopleObj->getId();
  ?>
  <tr class="boxcontent">
    <td><?php echo $peopleObj->getFullName() ?></td>
    <td><?php echo $peopleObj->getEmailAddress() ?></td>
    <td align="center" style="padding-left: 0; padding-right: 0">
    	<?php
    		$inviteStatus = $eventPlayerObj->getInviteStatus();
    		$icon = ($inviteStatus=='yes'?'ok':($inviteStatus=='no'?'nok':'help'));
    		$image = image_tag('icon/'.$icon, array('id'=>'presenceImage'.$peopleId));
    		
    		if( $isMyEvent )
    			echo link_to($image, '#togglePresence('.$peopleId.')', array('title'=>'Confirmar/Cancelar presença'));
    		else
    			echo $image;
    	?>
    </td>
    <?php if( $isMyEvent ): ?>
    <td align="center" style="padding-left: 0; padding-right: 0">
    	<?php echo link_to(image_tag('icon/delete'), '#removePlayer('.$peopleId.')', array('title'=>'Remover jogador do evento')); ?>
    </td>
    <td align="center" style="padding-left: 0; padding-right: 0">
    	<?php
    		$allowEdit    = $eventPlayerObj->getAllowEdit();
    		$icon         = ($allowEdit?'unlock':'lock');
    		$shareMessage = ($allowEdit?'Desabilitar':'Habilitar');
    		
    		if( $peopleId==$peopleIdMe || $peopleId==$peopleIdOwner )
				echo image_tag('icon/disabled/unlock', array('title'=>'Não é possível desabilitar este convidado para edição do evento'));
			else
				echo link_to(image_tag('icon/'.$icon, array('title'=>$shareMessage.' convidado para edição do evento', 'id'=>'eventShare'.$peopleId)), '#toggleEventShare('.$peopleId.')', array());
    	?>
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