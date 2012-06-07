<?php
	$rankingLiveId   = $rankingLiveObj->getId();
	$rankingName     = $rankingLiveObj->getRankingName();
	$clubObj         = $rankingLiveObj->getClub();
	$clubTagName     = $clubObj->getTagName();
	$clubName        = $clubObj->getClubName();
	$clubId          = $clubObj->getId();
	$addressQuarter  = $clubObj->getAddressQuarter();
	$city            = $clubObj->getCity()->getCityName();
	$state           = $clubObj->getCity()->getState()->getInitial();
	$description     = $rankingLiveObj->getDescription();
	$description     = str_replace(chr(10), '<br/>', $description);
	$startDate       = $rankingLiveObj->getStartDate('d/m/Y');
	$finishDate      = $rankingLiveObj->getFinishDate('d/m/Y');
	
	$description = preg_replace('/___*/i', '<hr/>', $description);
	
	$pathList = array('Rankings ao vivo'=>$moduleName.'/index', 
					  $clubName=>'#goToPage("'.$clubTagName.'", "", "", "")', 
					  $rankingName=>'#goToPage("ranking", "view", "rankingLiveId", '.$rankingLiveId.')', 
					  $rankingName=>null);
	
	$fileNameLogo = $rankingLiveObj->getFileNameLogo();
	
	if( $fileNameLogo=='noImage.png' )
		$fileNameLogo = 'club/original/'.$clubObj->getFileNameLogo();
	else
		$fileNameLogo = 'ranking/small/'.$fileNameLogo;
	
	include_partial('home/component/commonBar', array('pathList'=>$pathList));
?>
<div class="rankingDetailsArea" align="center">
	<table cellspacing="0" cellpadding="0" width="100%" class="rankingDetails">
		<tr>
			<td rowspan="5" class="logo"><?php echo image_tag($fileNameLogo) ?></td>
		</tr>
		<tr>
			<th valign="top"><h1><?php echo $rankingLiveObj->getRankingName() ?></h1></th>
			<td class="payInfo" align="center" rowspan="5">
				<div align="center">
				<table cellspacing="0" cellpadding="0">
					<tr>
						<th><?php echo image_tag('event/coins', array('title'=>'Buyin')) ?></th>
						<th><?php echo image_tag('event/timer', array('title'=>'Duração dos blinds')) ?></th>
						<th><?php echo image_tag('event/chips', array('title'=>'Stack inicial')) ?></th>
						<th><?php echo image_tag('event/players', array('title'=>'Jogadores que já participaram das etapas')) ?></th>
					</tr>
					<tr>
						<td><?php echo Util::formatFloat($rankingLiveObj->getBuyin(), true) ?></td>
						<td><?php echo $rankingLiveObj->getBlindTime('H:i') ?></td>
						<td><?php echo $rankingLiveObj->getStackChips(true) ?></td>
						<td id="rankingLive<?php echo $rankingLiveId ?>ResumePlayers"><?php echo $rankingLiveObj->getPlayers() ?></td>
					</tr>
					<tr>
						<td colspan="4" class="presence">
						</td>
					</tr>
				</table>
			</th>
		</tr>
		<tr class="clubInfo">
			<td><?php echo link_to(sprintf('@%s - %s, %s-%s', $clubName, $addressQuarter, $city, $state), '#goToPage("club", "details", "clubId", '.$clubId.')') ?></th>
		</tr>
		<tr class="info">
			<td valign="bottom">
				<b>Data início:</b> <?php echo $startDate ?>
				<b style="margin-left: 30px">Data término:</b> <?php echo ($finishDate?$finishDate:'-') ?>
			</th>
		</tr>
		<tr class="info">
			<td valign="top">
				<b>Formato:</b> <?php echo $rankingLiveObj->getGameStyle()->getDescription() ?>
				<b style="margin-left: 63px">Modalidade:</b> <?php echo $rankingLiveObj->getGameType()->getDescription() ?>
			</th>
		</tr>
	</table>
	<div class="separator"></div>
	<table cellspacing="0" cellpadding="0" class="channel">
		<tr>
			<td id="rankingLiveInfo" class="rankingLiveTab first active" onclick="showRankingLiveTab(this)" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Informações</td>
			<td id="rankingLiveEvents" class="rankingLiveTab" onclick="loadRankingLiveTab(this, <?php echo $rankingLiveId ?>); showRankingLiveTab(this)" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Etapas</td>
			<td id="rankingLiveClassify" class="rankingLiveTab" onclick="loadRankingLiveTab(this, <?php echo $rankingLiveId ?>); showRankingLiveTab(this)" class="last" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Classificação</td>
			<td id="rankingLivePerformance" class="rankingLiveTab last chart" onclick="loadRankingLiveTab(this, <?php echo $rankingLiveId ?>); showRankingLiveTab(this)" class="last" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Desempenho</td>
		</tr>
	</table>
	<div class="separator"></div>
	
	<div id="rankingLiveInfoContent" class="rankingLiveTabContent active">
		<?php echo $description ?>
	</div>
	<div id="rankingLiveEventsContent" class="rankingLiveTabContent">
		<?php include_partial('home/include/tabLoading', array()) ?>
	</div>
	<div id="rankingLiveClassifyContent" class="rankingLiveTabContent">
		<?php include_partial('home/include/tabLoading', array()) ?>
	</div>
	<div id="rankingLivePerformanceContent" class="rankingLiveTabContent">
		<?php include_partial('home/include/tabLoading', array()) ?>
	</div>
	<br/><br/>
</div>

