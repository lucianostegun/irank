<?php
	$players = $eventLiveObj->getPlayers();
?>
<div id="drag" class="inner_table">
	<table class="tablestatic hoHeader result" cellspacing="0">
	<colgroup>
		<col width="30"/>
		<col width="30"/>
		<col width="100"/>
		<col width="100"/>
		<col width="100"/>
	</colgroup>
	<tbody id="eventLiveResultTbody">
		<tr class="thead">
			<th colspan="4" class="mark"><div id="playerResultCountDiv"><?php echo $players.' Jogador'.($players==1?'':'es').' confirmado'.($players==1?'':'s') ?></div></th> 
			<th class="publishResult mark"><input type="submit" value="Divulgar resultados" class="save_btn" onclick="publishEventLiveResult()"></th> 
		</tr>
		<tr class="thead"> 
			<th class="mark"></th>
			<th class="mark" style="width: 30px">#</th> 
			<th class="mark">Nome</th> 
			<th class="mark">Premiação</th> 
			<th class="mark">E-mail</th> 
		</tr>
		<?php include_partial('eventLive/include/result', array('eventLiveObj'=>$eventLiveObj)) ?>
	</tbody>
	</table>
</div>