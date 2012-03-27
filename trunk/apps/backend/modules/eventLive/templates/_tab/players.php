<?php
	$players = $eventLiveObj->getPlayers();
?>
<div class="inner_table">
	<table class="tablesorter hoHeader playerList" cellspacing="0"> 
	<thead>
		<tr>
			<td><div id="playerCountDiv"><?php echo $players.' Jogador'.($players==1?'':'es').' confirmado'.($players==1?'':'s') ?></div></td> 
			<td colspan="3">
			
			<section class="addPlayer">
				<label>Adicionar jogador</label>
				<?php
					echo input_auto_complete_tag(
				      'peopleName',
				      null,
				      'people/autoComplete?instanceName=player&suggestNew='.Util::AUTO_COMPLETE_SUGGEST_NEW_IF_EMPTY,
				      array('autocomplete' => 'off', 'size'=>35, 'id'=>'eventLivePeopleName'),
				      array(
				        'use_style'             => true,
				        'after_update_element'  => 'function (inputField, selectedItem){ handleSelectEventLivePlayer(selectedItem.id, inputField.value, \'eventLive\', \'peopleId\', {searchFieldName:\'eventLivePeopleName\', quickModuleName:\'people\'}) }',
				      	'with'                  => ' value+\'?&peopleName=\'+$("eventLivePeopleName").value',
				      	'inTab'                 => false)
				    );
				?>
			</section>
			
			</td> 
		</tr>
		<tr> 
			<th>Nome</th> 
			<th>E-mail</th> 
			<th style="width: 150px">Confirmação</th> 
			<th style="width: 50px"></th> 
		</tr>
	</thead> 
	<tbody id="eventLivePlayerIdTbody"> 
		<?php include_partial('eventLive/include/players', array('eventLiveObj'=>$eventLiveObj)) ?>
	</tbody>
	</table>
</div>