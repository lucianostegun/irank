<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr class="rank_heading">
    <td>Nome</td>
    <td>Sobrenome</td>
    <td>E-mail</td>
    <td>Eventos</td>
    <td>Pontuação</td>
    <td></td>
  </tr>
  <?php
  	$rankingMemberObjList = $rankingObj->getMemberList();
  	foreach($rankingMemberObjList as $rankingMemberObj):
  		$peopleObj = $rankingMemberObj->getPeople();
  ?>
  <tr class="boxcontent">
    <td><?php echo $peopleObj->getFirstName() ?></td>
    <td><?php echo $peopleObj->getLastName() ?></td>
    <td><?php echo $peopleObj->getEmailAddress() ?></td>
    <td><?php echo $rankingMemberObj->getEvents() ?></td>
    <td><?php echo $rankingMemberObj->getScore() ?></td>
    <td align="center">
    	<?php 
    		if( $rankingMemberObj->getEvents()==0 )
    			echo link_to(image_tag('icon/delete'), '#deleteRankingMember('.$peopleObj->getId().')', array('title'=>'Remover este membro do grupo'));
    		else
    			echo image_tag('icon/disabled/delete', array('title'=>'Não é possível remover este membro do grupo'));
    	?>
    </td>
  </tr>
  <?php
  	endforeach;
  	
  	if( count($rankingMemberObjList)==0 ):
  ?>
  <tr class="boxcontent">
    <td colspan="5">Este ranking ainda não possui membros cadastrados</td>
  </tr>
  <?php endif; ?>
</table>