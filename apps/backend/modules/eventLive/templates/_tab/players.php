<?php
	$players     = $eventLiveObj->getPlayers();
	$savedResult = $eventLiveObj->getSavedResult();
?>
<div class="widget form">
	<table cellpadding="0" cellspacing="0" width="100%" class="display sTable">
		<thead>
		    <tr id="playerIncluderRow">
				<th><div id="playerCountDiv"><?php echo $players.' Jogador'.($players==1?'':'es').' confirmado'.($players==1?'':'s') ?></div></td> 
				<th colspan="4">
					<?php if( !$savedResult ): ?>
					<label style="margin: 0 15px">
						Inclusão de jogador
						<?php echo input_autocomplete_tag('peopleName', null, 'eventLive/autoComplete?instanceName=players&eventLiveId='.$eventLiveObj->getId(), 'doSelectEventLivePlayer', array('size'=>'100%', 'maxlength'=>200, 'style'=>'margin-left: 10px', 'id'=>'eventLivePeopleName')) ?>
					</label>
					<?php endif; ?>
				</td> 
			</tr>
			<tr> 
				<td>Nome</td>
				<td>E-mail</td>
				<td style="width: 150px">Confirmação</td>
				<?php if( !$savedResult ): ?>
				<td style="width: 50px" class="playerRemoveColumn"></td>
				<?php endif; ?>
			</tr>
		</thead>
		<tbody id="eventLivePlayerIdTbody"> 
			<?php include_partial('eventLive/include/players', array('eventLiveObj'=>$eventLiveObj, 'savedResult'=>$savedResult)) ?>
		</tbody>
	</table>
</div>
