<table width="100%" cellspacing="1" cellpadding="0" style="margin-top: 5px" class="defaultForm">
	<tr>
		<td valign="top">
			<div class="row">
				<div class="halfLabel" id="eventRankingIdLabel">Ranking</div>
				<div class="textFlex"><?php echo $eventObj->getRanking()->getRankingName() ?></div>
			</div>
			<div class="row">
				<div class="halfLabel">Título</div>
				<div class="textFlex"><?php echo $eventObj->getEventName() ?></div>
			</div>
			<div class="row">
				<div class="halfLabel">Local</div>
				<div class="textFlex"><?php echo $eventObj->getEventPlace() ?></div>
			</div>
			<div class="row">
				<div class="halfLabel">Data</div>
				<div class="textFlex"><?php echo $eventObj->getEventDate('d/m/Y') ?></div>
			</div>
			<div class="row">
				<div class="halfLabel">Horário</div>
				<div class="textFlex"><?php echo $eventObj->getStartTime('H:i') ?></div>
			</div>
			<div class="row">
				<div class="halfLabel">ITM</div>
				<div class="textFlex"><?php echo $eventObj->getPaidPlaces() ?></div>
			</div>
			<div class="row">
				<div class="halfLabel">Buy-in</div>
				<div class="textFlex">R$ <?php echo Util::formatFloat($eventObj->getBuyin(), true) ?></div>
			</div>
		</td>
	</tr>
</table>