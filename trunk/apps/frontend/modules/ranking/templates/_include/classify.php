<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr class="rank_heading">
    <td>#</td>
    <td>Nome</td>
    <td>E-mail</td>
    <td>Eventos</td>
    <td>Pontos</td>
    <td>B+R+A</td>
    <td>Ganhos</td>
    <td>Balanço</td>
  </tr>
  <?php
  	$rankingType          = $rankingObj->getRankingType(true);
	$rankingMemberObjList = $rankingObj->getClassify();
  	$position = 0;
  	foreach($rankingMemberObjList as $rankingMemberObj):
  		
  		$peopleObj = $rankingMemberObj->getPeople();
  ?>
  <tr class="boxcontent">
    <td>#<?php echo (($position++)+1) ?></td>
    <td><?php echo $peopleObj->getFullName() ?></td>
    <td><?php echo $peopleObj->getEmailAddress() ?></td>
    <td align="right"><?php echo $rankingMemberObj->getEvents() ?></td>
    <td align="right"><?php echo $rankingMemberObj->getScore() ?></td>
    <td align="right"><?php echo Util::formatFloat($rankingMemberObj->getTotalPaid(), true) ?></td>
    <td align="right"><?php echo Util::formatFloat($rankingMemberObj->getTotalPrize(), true) ?></td>
    <td align="right"><?php echo Util::formatFloat($rankingMemberObj->getBalance(), true) ?></td>
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
<br/>
<b>B+R+A</b> = Buy-in + Rebuys + Add-ons