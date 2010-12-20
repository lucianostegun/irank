<?php
	$eventId = $eventObj->getId();
	echo input_hidden_tag('eventPhotoId', null, array('id'=>'eventCommentEventPhotoId'));
?>
<h1>
	<?php echo image_tag('icon/photo', array('align'=>'absmiddle', 'style'=>'margin-right: 10px')) ?> Fotos do evento
	<?php if( $eventObj->isMyEvent() ): ?>
	<div style="float: right; margin-top: -5px">
		<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="85" height="22" id="uploadEventPhoto" align="middle">
		<param name="allowScriptAccess" value="sameDomain" />
		<param name="allowFullScreen" value="false" />
		<param name="FlashVars" value="eventId=<?php echo $eventId ?>" />
		<param name="movie" value="/uploads/eventPhoto.swf?eventId=<?php echo $eventId ?>&time=<?php echo time() ?>" />
		<param name="quality" value="high" />
		<param name="bgcolor" value="#d9d8d9" />
		<embed src="/uploads/eventPhoto.swf?eventId=<?php echo $eventId ?>&time=<?php echo time() ?>" quality="high" bgcolor="#ffffff" width="85" height="22" name="uploadEventPhoto" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
		</object>
	</div>
	<?php endif; ?>
</h1>
<div id="eventPhotoListDiv" align="center">
	<?php include_partial('event/include/photoList', array('eventObj'=>$eventObj)); ?>
</div>

<div id="eventPhotoBackDiv"><?php echo link_to('<b>Clique aqui</b>', '#closeEventPhotoComments()') ?> para retornar as comentários do evento</div>
<div id="eventPhotoPreviewDiv" align="center"></div>