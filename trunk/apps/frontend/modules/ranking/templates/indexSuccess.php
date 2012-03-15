<?php
	if( $userSiteObj->getRankingCount()==0 )
		$messageList = array('!Você ainda não está participando de nenhum ranking. <b>'.link_to('Clique aqui', 'ranking/new', array('class'=>'red')).'</b> para criar e compartilhar seu primeiro ranking.');
	else
		$messageList = array();
	
	include_partial('home/component/commonBar', array('pathList'=>array('Rankings'=>'ranking/index'), 'messageList'=>$messageList));

//		if( $suppressOld )
//			echo link_to('Mostrar rankings ocultos', 'ranking/index?so=0', array('title'=>'Mostrar todos os rankings'));
//		else
//			echo link_to('Ocultar rankings finalizados', 'ranking/index', array('title'=>'Ocultar rankings finalizados'));
	?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr class="header">
		<th width="200" class="first"><?php echo __('ranking.name') ?></th>
		<th><?php echo __('ranking.style') ?></th>
		<th><?php echo __('ranking.start') ?></th>
		<th><?php echo __('ranking.finish') ?></th>
		<th>Buy-in</th>
		<th><?php echo __('ranking.players') ?></th>
		<th><?php echo __('ranking.events') ?></th>
	</tr>
	<?php
		$criteria = new Criteria();
		
		if( $suppressOld ){
			
			$criterion = $criteria->getNewCriterion( RankingPeer::FINISH_DATE, date('Y-m-d'), Criteria::GREATER_EQUAL );
			$criterion->addOr( $criteria->getNewCriterion( RankingPeer::FINISH_DATE, null ) );
			$criteria->add($criterion);
		}
		
		$rankingObjList = $userSiteObj->getRankingList($criteria);
		foreach($rankingObjList as $rankingObj):
			
			$link = 'goModule(\'ranking\', \'edit\', \'rankingId\', '.$rankingObj->getId().')';
	?>
	<tr onclick="<?php echo $link ?>" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">
		<td align="left"><?php echo $rankingObj->getRankingName() ?></td>
		<td align="left"><?php echo $rankingObj->getGameStyle()->getDescription() ?></td>
		<td align="center"><?php echo $rankingObj->getStartDate('d/m/Y') ?></td>
		<td align="center"><?php echo $rankingObj->getFinishDate('d/m/Y') ?></td>
		<td align="right"><?php echo Util::formatFloat($rankingObj->getDefaultBuyin(), true) ?></td>
		<td align="right"><?php echo $rankingObj->getPlayers() ?></td>
		<td align="right"><?php echo $rankingObj->getEvents() ?></td>
	</tr>
	<?php
		endforeach;
		
		if( count($rankingObjList)==0 ):
	?>
	<tr>
		<td colspan="7"><?php echo __('ranking.noRankings') ?></td>
	</tr>
	<?php endif; ?>
</table>