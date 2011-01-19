<div id="infoDiv" align="center">
	
	<br/><br/>
	
	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td width="0" class="topLeft"><?php echo image_tag('mobile/form/topLeft') ?></td>
			<td width="100%" class="topMiddle"></td>
			<td width="0" class="topRight"><?php echo image_tag('mobile/form/topRight') ?></td>
		</tr>
	</table>
	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td colspan="3" class="formContent">
			
				<table cellpadding="0" cellspacing="0" width="100%" class="formTable">
					<tr>
						<th class="firstLine">Ranking</th>
						<td class="firstLine"><?php echo $eventObj->getRanking()->getRankingName() ?></td>
					</tr>
					<tr>
						<th>Título</th>
						<td><?php echo $eventObj->getEventName() ?></td>
					</tr>
					<tr>
						<th>Local</th>
						<td><?php echo $eventObj->getEventPlace() ?></td>
					</tr>
					<tr>
						<th>Data</th>
						<td><?php echo $eventObj->getEventDate('d/m/Y') ?></td>
					</tr>
					<tr>
						<th>Horário</th>
						<td><?php echo $eventObj->getStartTime('H:i') ?></td>
					</tr>
					<tr>
						<th>ITM</th>
						<td><?php echo $eventObj->getPaidPlaces() ?></td>
					</tr>
					<tr>
						<th>Bui-in</th>
						<td><?php echo Util::formatFloat($eventObj->getBuyin(), true) ?></td>
					</tr>
					<tr>
						<th>Convidados</th>
						<td><?php echo sprintf('%02d', $eventObj->getInvites()) ?></td>
					</tr>
					<tr>
						<th class="lastLine">Participantes</th>
						<td class="lastLine"><?php echo sprintf('%02d', $eventObj->getPlayers()) ?></td>
					</tr>
				</table>
							
			</td>
		</tr>
	</table>
	
	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td class="baseLeft" width="0" valign="bottom"><?php echo image_tag('mobile/form/baseLeft') ?></td>
			<td width="100%" class="baseMiddle"></td>
			<td class="baseRight" width="0" valign="bottom"><?php echo image_tag('mobile/form/baseRight') ?></td>
		</tr>
	</table>

</div>










