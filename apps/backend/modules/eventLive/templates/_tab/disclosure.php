	<div class="formRow">
		<div id="disclosureMenuShareDiv">
			<br/>
			<?php echo link_to(image_tag('backend/icons/light/mail', array('class'=>'icon')).'<span>Divulgar por Email</span>', '#showEventLiveEmailOptions()', array('class'=>'button greyishB', 'style'=>'margin-left: 10px')) ?>
			<?php echo link_to(image_tag('backend/icons/light/bubbles', array('class'=>'icon')).'<span>Divulgar por SMS</span>', '#showEventLiveSmsOptions()', array('class'=>'button redB', 'style'=>'margin-left: 10px')) ?>
			<?php echo link_to(image_tag('backend/icons/light/facebook', array('class'=>'icon')).'<span>Divulgar no facebook</span>', '#eventLiveFacebookShare()', array('class'=>'button blueB', 'style'=>'margin-left: 10px')) ?>
			<?php echo link_to(image_tag('backend/icons/light/twitter', array('class'=>'icon')).'<span>Divulgar no twitter</span>', 'http://twitter.com/home?status='.urlencode($eventLiveObj->getEventShortName().'. Em http://'.MyTools::getRequest()->getHost().'/index.php/eventLive/details/eventLiveId/'.$eventLiveObj->getId()), array('class'=>'button greenB', 'target'=>'_blank', 'style'=>'margin-left: 10px')) ?>
			<br/>
			<br/>
		</div>
		<?php include_partial('eventLive/disclosure/email', array('eventLiveObj'=>$eventLiveObj)); ?>
		<?php include_partial('eventLive/disclosure/sms', array('eventLiveObj'=>$eventLiveObj)); ?>
	</div>