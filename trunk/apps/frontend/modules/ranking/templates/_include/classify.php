<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr class="rank_heading">
    <td>#</td>
    <td>Nome</td>
    <td>Eventos</td>
    <td>Pontos</td>
    <td>B+R+A</td>
    <td>Ganhos</td>
    <td>Balanço</td>
    <td>Média</td>
  </tr>
  <?php
  	$rankingType          = $rankingObj->getRankingType(true);
	$rankingPlayerObjList = $rankingObj->getClassify($rankingDate);
  	$position             = 0;
  	foreach($rankingPlayerObjList as $rankingPlayerObj):
  		
  		$peopleObj = $rankingPlayerObj->getPeople();
  ?>
  <tr class="boxcontent">
    <td>#<?php echo (($position++)+1) ?></td>
    <td><?php echo mail_to($peopleObj->getEmailAddress(), $peopleObj->getFullName()) ?></td>
    <td align="right"><?php echo $rankingPlayerObj->getTotalEvents() ?></td>
    <td align="right"><?php echo Util::formatFloat($rankingPlayerObj->getTotalScore(), true) ?></td>
    <td align="right"><?php echo Util::formatFloat($rankingPlayerObj->getTotalPaid(), true) ?></td>
    <td align="right"><?php echo Util::formatFloat($rankingPlayerObj->getTotalPrize(), true) ?></td>
    <td align="right"><?php echo Util::formatFloat($rankingPlayerObj->getTotalBalance(), true) ?></td>
    <td align="right"><?php echo Util::formatFloat($rankingPlayerObj->getTotalAverage(), true) ?></td>
  </tr>
  <?php
  	endforeach;
  	
  	if( count($rankingPlayerObjList)==0 ):
  ?>
  <tr class="boxcontent">
    <td colspan="5">Este ranking ainda não possui membros cadastrados</td>
  </tr>
  <?php endif; ?>
</table>
<br/>
<b>B+R+A</b> = Buy-in + Rebuys + Add-ons