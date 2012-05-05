<div class="wrapper">
	<?php if( $eventLiveObj->getSavedResult() ): ?>
	<div class="nNote nWarning hideit">
	    <p><strong>ATENÇÃO: </strong>O resultado deste evento já foi salvo. As alterações na pontuação e premiação serão automaticamente atualizadas.</p>
	</div>
	<?php elseif( !$eventLiveObj->getIsNew() && $eventLiveObj->hasPreviousPendingResult() ): ?>
	<div class="nNote nWarning hideit" id="previousPendingResultWarning">
	    <p><strong>ATENÇÃO: </strong><?php echo __('eventLive.previousPendingResultAlert') ?></p>
	</div>
	<?php elseif( $eventLiveObj->isPendingResult() ): ?>
	<div class="nNote nWarning hideit" id="pendingResultWarning">
	    <p><strong>ATENÇÃO: </strong><?php echo __('eventLive.pendingResultAlert') ?></p>
	</div>
	<?php endif; ?>
	
	<!-- Fullscreen tabs -->
    <div class="widget form">    
	    <ul class="tabs">
			<li><a href="#tab1">Principal</a></li>
			<li><a href="#tab2">Jogadores</a></li>
			<li id="mainResultTab"><a href="#tab3" onclick="return activeResultTab()">Resultado</a></li>
			<li><a href="#tab4">Fotos</a></li>
			<li><a href="#tab5">Opções</a></li>
			<li class="<?php echo ($eventLiveObj->getIsNew()?'hidden':'') ?>" id="mainDisclosureTab"><a href="#tab6">Divulgação</a></li>
			<?php echo submit_tag('salvar', array('class'=>'button redB', 'style'=>'margin: 3px 10px', 'onclick'=>'$("#eventLiveForm").submit()')); ?>
		</ul>
		<div class="tab_container">
			<?php
				echo form_remote_tag(array(
					'url'=>'eventLive/save',
					'success'=>'handleSuccessEventLive(response)',
					'failure'=>'handleFailureEventLive(response.responseText)',
					'loading'=>'showIndicator()',
					),
					array('class'=>'form', 'id'=>'eventLiveForm'));
//				echo form_tag('eventLive/save', array('class'=>'form', 'id'=>'eventLiveForm'));
			?>
			<div id="tab1" class="tab_content"><?php include_partial('eventLive/tab/main', array('eventLiveObj'=>$eventLiveObj, 'clubId'=>$clubId, 'iRankAdmin'=>$iRankAdmin)) ?></div>
			<div id="tab5" class="tab_content"><?php include_partial('eventLive/tab/options', array('eventLiveObj'=>$eventLiveObj)) ?></div>
			</form>
			<div id="tab2" class="tab_content"><?php include_partial('eventLive/tab/players', array('eventLiveObj'=>$eventLiveObj)) ?></div>
			<div id="tab3" class="tab_content"><?php include_partial('eventLive/tab/result', array('eventLiveObj'=>$eventLiveObj)) ?></div>
			<div id="tab4" class="tab_content"><?php include_partial('eventLive/tab/photos', array('eventLiveId'=>$eventLiveObj->getId())) ?></div>
			<div id="tab6" class="tab_content"><?php include_partial('eventLive/tab/disclosure', array('eventLiveObj'=>$eventLiveObj)) ?></div>
		</div>
	</div>
</div>