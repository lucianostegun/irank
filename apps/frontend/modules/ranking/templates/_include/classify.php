<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr class="rank_heading">
    <td>#</td>
    <td>Nome</td>
    <td>Sobrenome</td>
    <td>E-mail</td>
    <td>Eventos</td>
    <td>Pontuação</td>
  </tr>
  <?php
  	$rankingType          = $rankingObj->getRankingType(true);
	$rankingMemberObjList = $rankingObj->getClassify();
  	$position = 0;
  	foreach($rankingMemberObjList as $rankingMemberObj):
  		
  		$peopleObj = $rankingMemberObj->getPeople();
  		$score     = $rankingMemberObj->getScore();
  ?>
  <tr class="boxcontent">
    <td>#<?php echo (($position++)+1) ?></td>
    <td><?php echo $peopleObj->getFirstName() ?></td>
    <td><?php echo $peopleObj->getLastName() ?></td>
    <td><?php echo $peopleObj->getEmailAddress() ?></td>
    <td><?php echo $rankingMemberObj->getEvents() ?></td>
    <td align="right"><?php echo ($rankingType=='value'?Util::formatFloat($score, true):$score) ?></td>
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