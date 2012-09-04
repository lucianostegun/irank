<table border="0" cellspacing="0" cellpadding="0" class="gridTable gridTabTable">
	<tr class="header">
		<th class="first">Nome</th>
		<?php if( !$readOnly ): ?>
		<th>E-mail</th>
		<?php endif; ?>
		<th style="width: 80px"><?php echo __('Events') ?></th>
		<?php if( !$readOnly ): ?>
		<th class="noBorder" colspan="2">&nbsp;</th>
		<?php endif; ?>
	</tr>
	<?php
		$peopleIdMe    = MyTools::getAttribute('peopleId');
		$peopleIdOwner = $rankingObj->getUserSite()->getId();
		
		$getPlayerNameFunction = ($readOnly?'getShareName':'getName');
		
		$rankingPlayerObjList = $rankingObj->getPlayerList();
		
		foreach($rankingPlayerObjList as $rankingPlayerObj):
			
			$peopleObj = $rankingPlayerObj->getPeople();
			$peopleId  = $peopleObj->getId();
	?>
	<tr class="boxcontent" id="rankingPlayer<?php echo $peopleId ?>Tr">
		<td><?php echo $peopleObj->$getPlayerNameFunction() ?></td>
		<?php if( !$readOnly ): ?>
		<td><?php echo $peopleObj->getEmailAddress() ?></td>
		<?php endif; ?>
		<td align="center"><?php echo sprintf('%02d', $rankingPlayerObj->getTotalEvents()) ?></td>
		<?php if( !$readOnly ): ?>
		<td align="center" class="icon">
			<?php 
				if( $rankingPlayerObj->getTotalEvents()==0 && $peopleId!==$peopleIdMe )
					echo link_to(image_tag('icon/delete'), '#deleteRankingPlayer('.$peopleId.')', array('title'=>__('ranking.playersTab.hint.removePlayer')));
				else
					echo image_tag('icon/disabled/delete', array('title'=>__('ranking.playersTab.hint.removePlayerUnabled')));
			?>
		</td>
		<td align="center" class="icon">
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
		<?php endif; ?>
	</tr>
	<?php
		endforeach;
		
		if( count($rankingPlayerObjList)==0 ):
	?>
	<tr class="boxcontent">
		<td colspan="6">Este ranking ainda não possui jogadores cadastrados</td>
	</tr>
	<?php endif; ?>
</table>