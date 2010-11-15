<table width="100%" cellspacing="1" cellpadding="0" style="margin-top: 5px" class="defaultForm">
	<tr>
		<td valign="top">
			<div class="row">
				<div class="label" id="eventRankingIdLabel">Ranking</div>
				<div class="textFlex"><?php echo $eventObj->getRanking()->getRankingName() ?></div>
			</div>
			<div class="row">
				<div class="label">Estilo</div>
				<div class="textFlex"><?php echo $eventObj->getVirtualTable()->getDescription() ?></div>
			</div>
			<div class="row">
				<div class="label">Título</div>
				<div class="textFlex"><?php echo $eventObj->getEventName() ?></div>
			</div>
			<div class="row">
				<div class="label">Local</div>
				<div class="textFlex"><?php echo $eventObj->getEventPlace() ?></div>
			</div>
			<div class="row">
				<div class="label">Data</div>
				<div class="textFlex"><?php echo $eventObj->getEventDate('d/m/Y') ?></div>
			</div>
			<div class="row">
				<div class="label">Horário</div>
				<div class="textFlex"><?php echo $eventObj->getStartTime('H:i') ?></div>
			</div>
			<div class="row">
				<div class="label">Posições pagas</div>
				<div class="textFlex"><?php echo $eventObj->getPaidPlaces() ?></div>
			</div>
			<div class="row">
				<div class="label">Buy-in</div>
				<div class="textFlex">R$ <?php echo Util::formatFloat($eventObj->getBuyIn(), true) ?></div>
			</div>
			<div class="rowTextArea">
				<div class="label">Observações</div>
				<div class="textFlex"><?php echo $eventObj->getComments() ?></div>
			</div>
		</td>
	</tr>
</table>