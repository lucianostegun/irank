<?php
	foreach($rankingLiveObj->getClassify() as $rankingPosition=>$rankingLivePlayerObj):
		$rankingPosition++;
		$peopleName   = $rankingLivePlayerObj->getPeople()->getName();
		$emailAddress = $rankingLivePlayerObj->getPeople()->getEmailAddress();
		$score        = $rankingLivePlayerObj->getTotalScore();
		$prize        = $rankingLivePlayerObj->getTotalPrize();
		$events       = $rankingLivePlayerObj->getTotalEvents();
?>
<tr class="gradeB">
	<td><?php echo $rankingPosition ?></td> 
	<td><?php echo $peopleName ?></td>
	<td><?php echo $emailAddress ?></td>
	<td class="textR"><?php echo Util::formatFloat($score, true, 3) ?></td>
	<td class="textR"><?php echo Util::formatFloat($prize, true) ?></td>
	<td class="textR"><?php echo $events ?></td>
</tr>
<?php endforeach; ?>