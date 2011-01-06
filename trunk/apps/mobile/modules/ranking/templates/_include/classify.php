<div align="center">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr>
		<th>#</th>
		<th>Nome</th>
		<th>Pts</th>
	    <th class="hiddenColumn">BRA</th>
	    <th class="hiddenColumn">$$$</th>
		<th>Bal</th>
		<th>Méd</th>
	</tr>
	<?php
  	$rankingType          = $rankingObj->getRankingType(true);
	$rankingPlayerObjList = $rankingObj->getClassify();
  	$position = 0;
  	foreach($rankingPlayerObjList as $rankingPlayerObj):
  		
  		$peopleObj = $rankingPlayerObj->getPeople();
  		
  		$balance = $rankingPlayerObj->getTotalBalance();
  ?>
	<tr>
		<td>#<?php echo (($position++)+1) ?></td>
		<td><?php echo mail_to($peopleObj->getEmailAddress(), $peopleObj->getFirstName()) ?></td>
		<td align="right"><?php echo Util::formatFloat($rankingPlayerObj->getTotalScore(), true, 3) ?></td>
		<td align="right" class="hiddenColumn"><?php echo Util::formatFloat($rankingPlayerObj->getTotalPaid(), true) ?></td>
		<td align="right" class="hiddenColumn"><?php echo Util::formatFloat($rankingPlayerObj->getTotalPrize(), true) ?></td>
		<td align="right" style="color: <?php echo ($balance<0?'#800000':'000000') ?>"><?php echo Util::formatFloat($balance, true) ?></td>
		<td align="right" style="padding-right: 10px"><?php echo Util::formatFloat($rankingPlayerObj->getTotalAverage(), true, 3) ?></td>
	</tr>
	<?php endforeach; ?>
</table>
</div>

	<?php if( count($rankingPlayerObjList)==0 ): ?>
	<div class="text" align="center">Este ranking ainda não possui membros cadastrados</div>
	<?php else: ?>
	<br/>
	<table class="text">
		<tr><th align="right">Pts</th><td>Pontos ganhos</td></tr>
		<tr><th align="right">BRA</th><td>Buy-in + Rebuys + Add-ons</td></tr>
		<tr><th align="right">$$$</th><td>Ganhos</td></tr>
		<tr><th align="right">Bal</th><td>Balanço</td></tr>
		<tr><th align="right">Méd</th><td>Média (Ganhos/BRA)</td></tr>
	</table>
<?php endif; ?>
	<br/>