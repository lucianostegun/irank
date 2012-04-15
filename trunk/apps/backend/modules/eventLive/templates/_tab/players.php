<?php
	$players = $eventLiveObj->getPlayers();
?>
<div class="widget form">
	<table cellpadding="0" cellspacing="0" width="100%" class="display sTable">
		<thead>
		    <tr>
				<th><div id="playerCountDiv"><?php echo $players.' Jogador'.($players==1?'':'es').' confirmado'.($players==1?'':'s') ?></div></td> 
				<th colspan="3">
				
				<label style="margin: 0 15px">
					Inclusão de jogador
					<?php echo input_autocomplete_tag('pepleName', 'people/autoComplete', 'testFunction', array('size'=>'100%', 'maxlength'=>200, 'style'=>'margin-left: 10px', 'id'=>'eventLivePeopleName')) ?>
				</label>
				
				</td> 
			</tr>
			<tr> 
				<td>Nome</td>
				<td>E-mail</td>
				<td style="width: 150px">Confirmação</td>
				<td style="width: 50px"></td>
			</tr>
		</thead>
		<tbody id="eventLivePlayerIdTbody"> 
			<?php include_partial('eventLive/include/players', array('eventLiveObj'=>$eventLiveObj)) ?>
		</tbody>
	</table>
</div>
