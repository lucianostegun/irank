<table border="0" cellspacing="1" cellpadding="2" class="gridTabTable">
	<tr class="header">
		<th><?php echo __('FirstName') ?></th>
		<th><?php echo __('LastName') ?></th>
		<th>E-mail</th>
		<th><?php echo __('Events') ?></th>
		<th colspan="2">&nbsp;</th>
	</tr>
	<?php
		$peopleIdMe    = MyTools::getAttribute('peopleId');
		$peopleIdOwner = $rankingObj->getUserSite()->getId();
		
		$rankingPlayerObjList = $rankingObj->getPlayerList();
		foreach($rankingPlayerObjList as $rankingPlayerObj):
			
			$peopleObj = $rankingPlayerObj->getPeople();
			$peopleId  = $peopleObj->getId();
	?>
	<tr class="boxcontent" id="rankingPlayer<?php echo $peopleId ?>Tr">
		<td><?php echo $peopleObj->getFirstName() ?></td>
		<td><?php echo $peopleObj->getLastName() ?></td>
		<td><?php echo $peopleObj->getEmailAddress() ?></td>
		<td align="center"><?php echo sprintf('%02d', $rankingPlayerObj->getTotalEvents()) ?></td>
		<td align="center" style="padding-left: 0; padding-right: 0">
			<?php 
				if( $rankingPlayerObj->getTotalEvents()==0 && $peopleId!==$peopleIdMe )
					echo link_to(image_tag('icon/delete'), '#deleteRankingPlayer('.$peopleId.')', array('title'=>__('ranking.playersTab.hint.removePlayer')));
				else
					echo image_tag('icon/disabled/delete', array('title'=>__('ranking.playersTab.hint.removePlayerUnabled')));
			?>
		</td>
		<td align="center" style="padding-left: 0; padding-right: 0">
			<?php
				$allowEdit    = $rankingPlayerObj->getAllowEdit();
				$icon         = ($allowEdit?'unlock':'lock');
				$shareMessage = ($allowEdit?'Deny':'Allow');
				
				if( $peopleId==$peopleIdMe || $peopleId==$peopleIdOwner )
				echo image_tag('icon/disabled/unlock', array('title'=>__('ranking.playersTab.hint.allowPlayerEditUnabled')));
			else
				echo link_to(image_tag('icon/'.$icon, array('title'=>__('ranking.playersTab.hint.allowPlayerEdit', array('%message%'=>__($shareMessage))), 'id'=>'rankingShare'.$peopleId)), '#toggleRankingShare('.$peopleId.')', array());
			?>
		</td>
	</tr>
	<?php
		endforeach;
		
		if( count($rankingPlayerObjList)==0 ):
	?>
	<tr class="boxcontent">
		<td colspan="6">Este ranking ainda não possui membros cadastrados</td>
	</tr>
	<?php endif; ?>
</table>