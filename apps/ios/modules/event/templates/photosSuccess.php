<style>
body {
	
	background: #303030;
}

a {
	color: #FFF
}
</style>
<a href="javascript:void(0)" onclick="alert('Alerta de teste')">Alerta de teste</a>
<div class="photoList">
<div class="photo">
<?php
	$eventObj = EventPeer::retrieveByPK( $eventId );

	$eventPhotoObjList = $eventObj->getPhotoList();
	
	foreach($eventPhotoObjList as $key=>$eventPhotoObj):

		$imageThumb = '/uploads/eventPhoto/event-'.$eventPhotoObj->getEventId().'/thumb/'.Util::getFileName($eventPhotoObj->getFile()->getFilePath());
		
		echo link_to(image_tag($imageThumb), url_for('event/photoView?eventPhotoId='.$eventPhotoObj->getId(), true));

	endforeach;
	
	if( count($eventPhotoObjList)==0 ):
?>
	</div>
<div class="commentArea">
	<div class="comment">
		<div class="message">Este evento não possui fotos</div>
	</div>
</div>
<?php endif; ?>
</div>