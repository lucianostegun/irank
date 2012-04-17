<?php
	$players = $eventLiveObj->getPlayers();
	
	echo form_remote_tag(array(
		'url'=>'eventLive/saveResult',
		'success'=>'handleSuccessEventLiveResult(response)',
		'failure'=>'handleFailureEventLiveResult(response.responseText)',
		'encoding'=>'UTF8',
	), array('id'=>'eventLiveResultForm'));

//	echo form_tag('eventLive/saveResult', array('id'=>'eventLiveResultForm'));
	
	echo input_hidden_tag('eventLiveId', $eventLiveObj->getId(), array('id'=>'eventLiveResultEventId'));
	echo input_hidden_tag('publish', false, array('id'=>'eventLiveResultPublish'));
?>
<div class="eventResult">
	<div class="formRow">
		<label>Total Rebuys/Addons</label>
		<div class="formRight">
			<?php echo input_tag('totalRebuys', Util::formatFloat($eventLiveObj->getTotalRebuys(), true), array('maxlength'=>10, 'onblur'=>'updateMainBalance(this.value)', 'class'=>'decimal small100', 'id'=>'eventLiveTotalRebuys')) ?>
			<div class="formNote">Formato: 0000,00</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label>Divisão do prêmio</label>
		<div class="formRight">
			<span class="multi"><?php echo input_tag('prizeSplit', $eventLiveObj->getPrizeSplit(), array('onkeyup'=>'updatePrizeSplitLabel()', 'class'=>'decimal small300', 'id'=>'eventLivePrizeSplit')) ?></span>
			<span class="multi"><label id="prizeSplitTotalLabel"><?php echo Util::formatFloat($eventLiveObj->getTotalPercentPrizeSplit()) ?>%</label></span>
			<div class="clear"></div>
			<div class="formNote">Formato: 25%; 15%; 7,5%, ...</div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<div class="widget eventResult" id="drag">
	<table cellpadding="0" cellspacing="0" width="100%" class="display sTable">
		<colgroup>
			<col/>
			<col/>
			<col/>
			<col/>
			<col/>
			<col/>
		</colgroup>
		<tbody id="eventLiveResultTbody">
			<tr class="thead">
				<th colspan="4" class="mark"><div id="playerResultCountDiv"><?php echo $players.' Jogador'.($players==1?'':'es').' confirmado'.($players==1?'':'s') ?></div></th> 
				<th colspan="2" class="calculateScore mark"><input type="submit" value="Calcular pontuação" class="button greenB" onclick="calculateEventLiveScore()"></th> 
			</tr>
			<tr class="thead"> 
				<th class="mark"></th>
				<th class="mark">#</th> 
				<th class="mark">Nome</th> 
				<th class="mark">E-mail</th> 
				<th class="mark">Premiação</th> 
				<th class="mark">Pontos</th> 
			</tr>
			<?php include_partial('eventLive/include/result', array('eventLiveObj'=>$eventLiveObj)) ?>
			<tr class="thead">
				<th colspan="4" class="mark"></th> 
				<th colspan="2" class="publishResult mark"><input type="submit" value="Divulgar resultados" class="button blueB" onclick="publishEventLiveResult()"></th> 
			</tr>
		</tbody>
	</table>
</div>
</form>