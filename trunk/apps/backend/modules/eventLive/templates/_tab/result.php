<?php if( $hasPendingResult=$eventLiveObj->hasPreviousPendingResult() ): ?>
<div class="nNote nWarning hideit">
    <p>
    	<strong>ATENÇÃO: </strong>Existem resultados de eventos anteriores que ainda não foram lançados.<br/>
    	O resultado desde evento só poderá ser salvo quando os resultadores anteriores forem lançados.
    </p>
</div>
<?php endif; ?>
	
<?php
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
<div class="widget form" id="resultTab">
    <ul class="tabs">
		<li><a href="#result">Resultado</a></li>
		<li><a href="#resultOptions">Opções de divulgação</a></li>
	</ul>
	<div class="tab_container">
		<div id="result" class="tab_content resultTabContent"><?php include_partial('eventLive/result/result', array('eventLiveObj'=>$eventLiveObj, 'hasPendingResult'=>$hasPendingResult)) ?></div>
		<div id="resultOptions" class="tab_content"><?php include_partial('eventLive/result/options', array('eventLiveObj'=>$eventLiveObj)) ?></div>
	</div>
</div>
</form>