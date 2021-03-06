<?php
	echo form_remote_tag(array(
		'url'=>'event/saveResult',
		'success'=>'handleSuccessEventResult( request.responseText )',
		'failure'=>'enableButton("eventResultSubmit"); enableButton("calculatePrize"); handleFormFieldError( request.responseText, "eventResultForm", "eventResult", false, "eventResult" )',
		'encoding'=>'utf8',
		'loading'=>'showIndicator("eventResult")'
		), array( 'id'=>'eventResultForm' ));
	
	$savedResult = $eventObj->getSavedResult();
	
	echo input_hidden_tag('eventId', $eventObj->getId());
?>
	<table width="100%" height="<?php echo $windowHeight-17 ?>" cellspacing="1" cellpadding="0" class="windowForm">
		<tr>
			<td valign="top" align="center">
				<div id="eventResultTableDiv" style="height: 500px; overflow: auto; display: <?php echo ($savedResult?'block':'none') ?>">
					<?php include_partial('event/include/result', array('eventObj'=>$eventObj)) ?>
				</div>
				<div id="eventResultPlayerListDiv" style="height: 500px; overflow: auto; display: <?php echo ($savedResult?'none':'block') ?>">
					<?php include_partial('event/include/playerResult', array('eventObj'=>$eventObj)) ?>
				</div>
			</td>
		</tr>
	</table>
	<div class="windowButtonBar">
		<?php
			echo button_tag('eventResultCancel', __('button.cancel'), array('onclick'=>'windowEventResultHide()'));
			echo button_tag('eventResultSubmit', __('button.saveResult'), array('onclick'=>'doSubmitEventResult()', 'visible'=>$savedResult));
			echo button_tag('toggleResultButtonResult', __('button.launchResult'), array('onclick'=>'toggleEventResultView(true)', 'visible'=>(!$savedResult), 'style'=>'float: left'));
			echo button_tag('toggleResultButtonPlayer', __('button.playerList'), array('onclick'=>'toggleEventResultView(false)', 'visible'=>$savedResult, 'style'=>'float: left'));
			echo button_tag('calculatePrize', __('button.calculatePrize'), array('onclick'=>'doCalculatePrize()', 'visible'=>$savedResult, 'style'=>'float: left'));
			echo getFormWindowLoading('eventResult');
			echo getFormStatus('eventResult');
		?>
	</div>
</form>