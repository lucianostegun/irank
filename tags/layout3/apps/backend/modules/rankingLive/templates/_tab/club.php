	<div class="title"><span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span><h6><label for="titleCheck">Selecionar todos</label></h6></div>                          
	<table cellpadding="0" cellspacing="0" width="100%" class="display sTable withCheck" id="checkAll">
	    <tbody>
		<?php
			$clubIdList = $rankingLiveObj->getClubList('id');
			
			foreach(Club::getList() as $key=>$clubObj):
				$clubId = $clubObj->getId();
		?>
		<tr>
			<td width="10"><?php echo checkbox_tag('clubId[]', $clubId, in_array($clubId, $clubIdList), array('id'=>'titleCheck'.($key+2))) ?></td>
			<td><label for="titleCheck<?php echo ($key+2) ?>" class="checkbox"><?php echo $clubObj->toString() ?></label></td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
