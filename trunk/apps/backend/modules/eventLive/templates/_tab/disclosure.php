	<div class="formRow">
		<br/>
		<?php echo link_to(image_tag('backend/icons/light/mail', array('class'=>'icon')).'<span>Divulgar por Email</span>', '#eventLiveEmailShare()', array('class'=>'button greyishB', 'style'=>'margin-left: 10px')) ?>
		<?php echo link_to(image_tag('backend/icons/light/facebook', array('class'=>'icon')).'<span>Divulgar no facebook</span>', '#eventLiveFacebookShare()', array('class'=>'button blueB', 'style'=>'margin-left: 10px')) ?>
		<?php echo link_to(image_tag('backend/icons/light/twitter', array('class'=>'icon')).'<span>Divulgar no twitter</span>', 'http://twitter.com/home?status='.urlencode($eventLiveObj->getEventShortName().'. Em http://'.MyTools::getRequest()->getHost().'/index.php/eventLive/details/eventLiveId/'.$eventLiveObj->getId()), array('class'=>'button greenB', 'target'=>'_blank', 'style'=>'margin-left: 10px')) ?>
		<br/><br/>
		
		<div class="clear"></div>
	</div>
