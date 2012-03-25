<fieldset>
	<legend>Clubes relacionados</legend>
	<table>
		<?php
			$clubIdList = $rankingLiveObj->getClubList('id');
			
			foreach(Club::getList() as $clubObj):
				$clubId = $clubObj->getId();
		?>
		<tr>
			<td><?php echo checkbox_tag('clubId[]', $clubId, in_array($clubId, $clubIdList), array('id'=>'rankingLiveClubId'.$clubId)) ?><td>
			<td><label for="rankingLiveClubId<?php echo $clubId ?>" class="checkbox"><?php echo $clubObj->toString() ?></label><td>
		</tr>
		<?php endforeach; ?>
	</table>
</fieldset>