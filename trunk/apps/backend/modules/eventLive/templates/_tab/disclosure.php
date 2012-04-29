	<div class="formRow">
		<br/>
		<?php echo link_to(image_tag('backend/icons/light/mail', array('class'=>'icon')).'<span>Divulgar por Email</span>', '#eventLiveEmailShare()', array('class'=>'button greyishB', 'style'=>'margin-left: 10px')) ?>
		<?php echo link_to(image_tag('backend/icons/light/facebook', array('class'=>'icon')).'<span>Divulgar no facebook</span>', '#eventLiveFacebookShare()', array('class'=>'button blueB', 'style'=>'margin-left: 10px')) ?>
		<?php echo link_to(image_tag('backend/icons/light/twitter', array('class'=>'icon')).'<span>Divulgar no twitter</span>', 'https://twitter.com/share', array('class'=>'button greenB', 'data-lang'=>'pt', 'data-count'=>'none', 'target'=>'_blank', 'style'=>'margin-left: 10px')) ?>
		
		<br/><br/>
		
		<div class="clear"></div>
	</div>
