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
						<th class="firstLine">Nome</th>
						<td class="firstLine"><?php echo $rankingObj->getRankingName() ?></td>
					</tr>
					<tr>
						<th>Estilo</th>
						<td><?php echo $rankingObj->getGameStyle()->getDescription() ?></td>
					</tr>
					<tr>
						<th>Início</th>
						<td><?php echo $rankingObj->getStartDate('d/m/Y') ?></td>
					</tr>
					<tr>
						<th>Término</th>
						<td><?php echo $rankingObj->getFinishDate('d/m/Y') ?></td>
					</tr>
					<tr>
						<th>Exibição</th>
						<td><?php echo ($rankingObj->getIsPrivate()?'Privado':'Público') ?></td>
					</tr>
					<tr>
						<th>Classificação</th>
						<td><?php echo $rankingObj->getRankingType()->getDescription() ?></td>
					</tr>
					<tr>
						<th>Bui-in padrão</th>
						<td><?php echo Util::formatFloat($rankingObj->getDefaultBuyin(), true) ?></td>
					</tr>
					<tr>
						<th>Eventos realizados</th>
						<td><?php echo sprintf('%02d', $rankingObj->getEvents()) ?></td>
					</tr>
					<tr>
						<th class="lastLine">Participantes</th>
						<td class="lastLine"><?php echo sprintf('%02d', $rankingObj->getPlayers()) ?></td>
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