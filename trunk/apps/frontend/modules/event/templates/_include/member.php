<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr class="rank_heading">
    <td>Nome</td>
    <td>Sobrenome</td>
    <td>E-mail</td>
    <td>Pontuação</td>
    <td></td>
  </tr>
  <?php
  	$myEvent    = $eventObj->isMyEvent();
  	$peopleIdMe = MyTools::getAttribute('peopleId');
  	
  	$eventMemberObjList = $eventObj->getMemberList();
  	foreach($eventMemberObjList as $eventMemberObj):
  		
  		$peopleObj = $eventMemberObj->getPeople();
  		$peopleId  = $peopleObj->getId();
  ?>
  <tr class="boxcontent">
    <td><?php echo $peopleObj->getFirstName() ?></td>
    <td><?php echo $peopleObj->getLastName() ?></td>
    <td><?php echo $peopleObj->getEmailAddress() ?></td>
    <td><?php echo '-' ?></td>
    <td align="center">
    	<?php
    		$image = image_tag('icon/'.($eventMemberObj->getEnabled()?'ok':'nok'), array('id'=>'presenceImage'.$peopleId));
    		if( $myEvent && $peopleId!=$peopleIdMe )
    			echo link_to($image, '#togglePresence('.$peopleId.')', array('title'=>'Confirmar/Cancelar presença'));
    		else
    			echo $image;
    	?>
    </td>
  </tr>
  <?php
  	endforeach;
  	
  	if( count($eventMemberObjList)==0 ):
  ?>
  <tr class="boxcontent">
    <td colspan="5">Este ranking ainda não possui convidados</td>
  </tr>
  <?php endif; ?>
</table>