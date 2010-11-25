<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr class="rank_heading">
    <td>#</td>
    <td>Nome</td>
    <td>Pts</td>
    <td>BRA</td>
    <td>$$$</td>
    <td>Bal</td>
    <td>Méd</td>
  </tr>
  <?php
  	$rankingType          = $rankingObj->getRankingType(true);
	$rankingPlayerObjList = $rankingObj->getClassify();
  	$position = 0;
  	foreach($rankingPlayerObjList as $rankingPlayerObj):
  		
  		$peopleObj = $rankingPlayerObj->getPeople();
  		
  		$balance = $rankingPlayerObj->getBalance();
  ?>
  <tr class="boxcontent">
    <td>#<?php echo (($position++)+1) ?></td>
    <td><?php echo mail_to($peopleObj->getEmailAddress(), $peopleObj->getFirstName()) ?></td>
    <td align="right"><?php echo Util::formatFloat($rankingPlayerObj->getScore(), true) ?></td>
    <td align="right"><?php echo Util::formatFloat($rankingPlayerObj->getTotalPaid(), true) ?></td>
    <td align="right"><?php echo Util::formatFloat($rankingPlayerObj->getTotalPrize(), true) ?></td>
    <td align="right" style="color: <?php echo ($balance<0?'#800000':'000000') ?>"><?php echo Util::formatFloat($balance, true) ?></td>
    <td align="right"><?php echo Util::formatFloat($rankingPlayerObj->getAverage(), true) ?></td>
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
<b>Pts</b> = Pontos ganhos<br/>
<b>BRA</b> = Buy-in + Rebuys + Add-ons<br/>
<b>$$$</b> = Ganhos<br/>
<b>Bal</b> = Balanço<br/>
<b>Méd</b> = Média (Ganhos/BRA)