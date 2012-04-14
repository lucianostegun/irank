<?php
	$players = $eventLiveObj->getPlayers();
	
//	echo form_remote_tag(array(
//		'url'=>'eventLive/saveResult',
//		'success'=>'handleSuccessEventLiveResult(request.responseText)',
//		'failure'=>'handleFailureEventLiveResult(request.responseText)',
//		'encoding'=>'UTF8',
//	), array('id'=>'eventLiveResultForm'));
	
	echo input_hidden_tag('eventLiveId', $eventLiveObj->getId(), array('id'=>'eventLiveResultEventId'));
	echo input_hidden_tag('publish', false, array('id'=>'eventLiveResultPublish'));
?>
<div class="widget" id="drag">
	<table cellpadding="0" cellspacing="0" width="100%" class="display sTable">
		<colgroup>
			<col style="width: 30px" />
			<col width="30"/>
			<col width="100"/>
			<col width="100"/>
			<col width="80"/>
			<col width="100"/>
		</colgroup>
		<tbody id="eventLiveResultTbody">
			<tr class="thead">
				<th colspan="4" class="mark"><div id="playerResultCountDiv"><?php echo $players.' Jogador'.($players==1?'':'es').' confirmado'.($players==1?'':'s') ?></div></th> 
				<th class="calculateResult mark"></th> 
				<th class="publishResult mark"><input type="submit" value="Divulgar resultados" class="button blueB" onclick="publishEventLiveResult()"></th> 
			</tr>
			<tr class="thead"> 
				<th class="mark" style="width: 30px"></th>
				<th class="mark" style="width: 30px">#</th> 
				<th class="mark">Nome</th> 
				<th class="mark">Premiação</th> 
				<th class="mark">Pontos</th> 
				<th class="mark">E-mail</th> 
			</tr>
			<?php include_partial('eventLive/include/result', array('eventLiveObj'=>$eventLiveObj)) ?>
		</tbody>
	</table>
</div>