	<div class="formRow">
		<label>Divulgar premiação</label>
		<div class="formRight">
			<?php echo checkbox_tag('publishPrize', true, $eventLiveObj->getPublishPrize(), array('id'=>'eventLivePublishPrize')) ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<div id="resultDisclosureMenuShareDiv">
			<br/>
			<?php echo link_to(image_tag('backend/icons/light/pdfDoc', array('class'=>'icon')).'<span>Gerar PDF do resultado</span>', '#buildEventResultPdf()', array('class'=>'button greyishB', 'style'=>'margin-left: 10px')) ?>
			<br/>
			<br/>
		</div>
		<?php #include_partial('eventLive/disclosure/email', array('eventLiveObj'=>$eventLiveObj)); ?>
		<?php #include_partial('eventLive/disclosure/sms', array('eventLiveObj'=>$eventLiveObj)); ?>
	</div>