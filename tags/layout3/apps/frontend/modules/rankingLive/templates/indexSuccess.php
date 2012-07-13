<?php
	$peopleId = $sf_user->getAttribute('peopleId');
	
	include_partial('home/component/commonBar', array('pathList'=>array('Rankings ao vivo'=>$moduleName.'/index')));
?>
<div class="moduleIntro">
	Confira abaixo os rankings gerenciados pelo <b>iRank</b>. 
</div>
<blockquote>
	<div id="rankingLiveList">
		<?php
			$rankingLiveObjList = RankingLive::getList();
			
			if( count($rankingLiveObjList)==0 ):
		?>
		<h3>Nenhum ranking encontrado!</h3>
		<?php
			endif;
			
			foreach($rankingLiveObjList as $rankingLiveObj):
				
				$rankingLiveId = $rankingLiveObj->getId();
				$fileNameLogo  = $rankingLiveObj->getFileNameLogo();
				
				$clubObj    = $rankingLiveObj->getClub();
				$startDate  = $rankingLiveObj->getStartDate('d/m/Y');
				$finishDate = $rankingLiveObj->getFinishDate('d/m/Y');
				$events     = $rankingLiveObj->getEventCount();
		?>
		<div class="ranking">
			<a href="javascript:void(0)" onclick="goToPage('rankingLive', 'details', 'id', <?php echo $rankingLiveId ?>)" title="Abrir detalhes do ranking">
				<div class="logo">
					<?php echo image_tag('ranking/small/'.$fileNameLogo) ?><br/>
					+ Detalhes
				</div>
			</a>
			<div class="info">
				<div class="profile">
					<h1><?php echo link_to($rankingLiveObj->getRankingName(), '#goToPage("rankingLive", "details", "id", '.$rankingLiveId.')') ?></h1>
					<h3>@ <?php echo (is_object($clubObj)?$clubObj->toString():'Múltiplos clubes') ?><?php echo (is_object($clubObj)?' - '.$rankingLiveObj->getClub()->getLocation():'') ?></h3>
					<h2><?php echo $startDate?'<b>Início:</b> '.$startDate:'' ?><?php echo $finishDate?'<b style="margin-left: 14px">Término:</b> '.$finishDate:'' ?></h2>
					<h2><b>Formato:</b> <?php echo $rankingLiveObj->getGameStyle()->getDescription() ?> <b style="margin-left: 34px">Modalidade:</b> <?php echo $rankingLiveObj->getGameType()->getDescription() ?></spa></h2>
					<h4 class="events"><b><?php echo $events ?></b> etapa<?php echo ($events==1?'':'s') ?></h4>
					<h4 class="players"><b><?php echo $rankingLiveObj->getPlayers() ?></b> jogadores</h4>
					<h4 class="prize"><b><?php echo Util::formatFloat($rankingLiveObj->getTotalPrize(), true) ?></b> em prêmios</h4>
					<?php echo button_tag('detailsButton'.$rankingLiveId, 'DETALHES', array('image'=>'result.png', 'class'=>'detailsButton', 'onclick'=>'goToPage("rankingLive", "details", "id", '.$rankingLiveId.')')); ?>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</blockquote>