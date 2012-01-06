<?php
	$eventId    = $eventObj->getId();
	$userSiteId = MyTools::getAttribute('userSiteId');
	$culture    = MyTools::getCulture();
?>
<h1>
	<?php echo image_tag('icon/photo', array('align'=>'absmiddle', 'style'=>'margin-right: 10px')) ?> <?php echo __('event.commentsTab.eventPhotos') ?>
	<div style="float: right; margin-top: -10px; margin-top: -25px !ie">
		<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="96" height="22" id="uploadEventPhoto" align="middle">
		<param name="allowScriptAccess" value="sameDomain" />
		<param name="allowFullScreen" value="false" />
		<param name="FlashVars" value="eventId=<?php echo $eventId ?>" />
		<param name="FlashVars" value="usid=<?php echo $userSiteId ?>" />
		<param name="FlashVars" value="culture=<?php echo $culture ?>" />
		<param name="movie" value="/uploads/eventPhoto.swf?eventId=<?php echo $eventId ?>&usid=<?php echo $userSiteId ?>&culture=<?php echo $culture ?>&time=<?php echo time() ?>" />
		<param name="quality" value="high" />
		<param name="bgcolor" value="#E6E6E6" />
		<embed src="/uploads/eventPhoto.swf?eventId=<?php echo $eventId ?>&usid=<?php echo $userSiteId ?>&culture=<?php echo $culture ?>&time=<?php echo time() ?>" quality="high" bgcolor="#E6E6E6" width="96" height="22" name="uploadEventPhoto" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
		</object>
	</div>
</h1>
<div id="eventPhotoListDiv" align="center">
	<?php include_partial('event/include/photoList', array('eventObj'=>$eventObj)); ?>
</div>

<div id="eventPhotoBackDiv"><?php echo __('event.commentsTab.returnLink', array('%link%'=>link_to('<b>'.__('ClickHere').'</b>', '#closeEventPhotoComments()'))) ?></div>
<div id="eventPhotoPreviewDiv" align="center"></div>